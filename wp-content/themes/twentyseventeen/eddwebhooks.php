<?php
	add_action('admin_menu', 'edd_webhooks');
	 
	function edd_webhooks(){
			add_menu_page( 'EDD Webhooks', 'EDD Webhooks', 'manage_options', 'edd-webhooks', 'edd_init' );
	}
	 
	function edd_init(){
			echo "<h1>EDD Webhooks</h1>";
			
		abstract class EDD_Webhook_Handler {
		/**
		 * Functions to get the name of this webhook (for display to the user) and an ID
		 */
		abstract function get_hook_name();
		abstract function get_hook_id();

		function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_item_id_metabox' ) );
			add_action( 'edd_metabox_fields_save', array( $this, 'save_item_id_metabox_fields' ) );
			
			// register the REST API endpoint to handle our sale notifications		
			add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
			
			register_activation_hook( __FILE__, array( $this, 'flush_rewrite_rules' ) );
		}
			
		/**
		 * Flush the rewrite rules on plugin activation so the rest API endpoint can take effect
		 */
		function flush_rewrite_rules() {
			flush_rewrite_rules();
		}
		
		/**
		  * Functions to add a meta box so we can put in the product or item ID of the ecommerce service, and match it up to an EDD download
		  */
		
		function add_item_id_metabox() {
			if ( current_user_can( 'edit_product', get_the_ID() ) ) {
				add_meta_box( 'edd_' . $this->get_hook_id() . '_item', sprintf( __( '%s Integration', 'edd-webhooks' ), $this->get_hook_name() ), array( $this, 'render_item_id_metabox' ), 'download', 'side' );
			}
		}	

		function render_item_id_metabox() {
			global $post;
			$item_id = get_post_meta( $post->ID, $this->get_hook_id() . '_item_id', true );
			?>
			<p><?php echo sprintf( esc_html__( 'Specify the %s product ID', $this->get_hook_id() . 'edd-webhooks' ), $this->get_hook_name() ); ?></p>
			<input type="text" name="<?= $this->get_hook_id() ?>_item_id" value="<?php esc_attr_e( $item_id ) ?>" />
			<?php
		}
		
		function save_item_id_metabox_fields( $fields ) {
			$fields[] = $this->get_hook_id() . '_item_id';
			return $fields;
		}
		
		/**
		  * Function to register any checks (ie. required parameters) for the endpoint
		  *
		  * @return array
		  */
		function get_endpoint_args() {
			return array();
		}
		
		function register_endpoints() {
			register_rest_route(
				'edd-' . $this->get_hook_id() . '-webhook/v1',
				'/purchase_notification',
				array(
					'methods' => 'POST,PUT',
					'callback' => array( $this, 'handle_purchase_notification' ),
					'args' => $this->get_endpoint_args(),
				)
			);
		}
		
		/**
		 * Get the EDD download ID for a given item id
		 *
		 * @param $item_id
		 * @return bool | EDD_Download
		 */
		function get_download_by_item_id( $item_id ) {
			if ( class_exists( 'EDD_Hide_Download' ) ) {
				remove_filter( 'edd_downloads_query', array( EDD_Hide_Download::get_instance(), 'shortcode_query' ) );
				remove_action( 'pre_get_posts', array( EDD_Hide_Download::get_instance(), 'pre_get_posts' ), 9999 );
			}
			$posts = get_posts( array(
					'post_type' => 'download',
					'post_status' => 'any',
					'suppress_filters' => true,
					'posts_per_page' => -1,
					'meta_key' => $this->get_hook_id() . '_item_id',
					'meta_value' => sanitize_text_field( $item_id )
				)
			);
			foreach ( $posts as $post ) {
				$download = new EDD_Download( $post->ID );
				return $download;
			}
			return false;
		}
		
		/**
		 * Function to check that the request we're getting is really from the ecommerce service
		 *
		 * @param $request WP_REST_Request
		 * @return bool
		 */
		abstract function verify_request( $request );
		
		/**
		 * Get the parameters the webhook sends to us.
		 * Override for webhooks that can't just get the params from the WP_REST_Request.
		 *
		 * @param WP_REST_Request
		 * @return array
		 */
		function get_webhook_params( $request ) {
			return $request->get_params();
		}
		
		/**
		 * Run any checks on the webhook parameters
		 *
		 * @param $params array
		 * @return bool
		 */
		abstract function verify_webhook_params( $params );
		
		/**
		 * Grab the customer email address from the parameters
		 * @param $params array
		 * @return string The email address
		 */
		abstract function get_buyer_email_address( $params );
		
		/**
		 * Get the ordered item ID
		 *
		 * @param $params array
		 * @return string
		 */
		abstract function get_item_id( $params );
		
		/**
		 * Get the unique order ID from the webhook params
		 *
		 * @param $params array
		 * @return string The order ID
		 */
		abstract function get_order_id( $params );
		
		/**
		 * Get the price of the item (without tax)
		 *
		 * @param $params array
		 * @return string
		 */
		abstract function get_item_price( $params );
		
		/**
		 * Get the tax charged on the item (if any)
		 *
		 * @param $params array
		 * @return string
		 */
		abstract function get_item_tax( $params );
		
		/**
		 * Get the currency of the order.  Defaults to the EDD currency but can override if needed.
		 *
		 * @param $params array
		 * @return string The currency code of the order
		 */
		function get_order_currency( $params ) {
			return edd_get_currency();
		}
		
		/**
		 * Handle a purchase notification
		 *
		 * @param WP_REST_Request $request
		 */
		function handle_purchase_notification( WP_REST_Request $request ) {
			$params = $this->get_webhook_params( $request );

			// Verify the required data is present
			if ( ! $this->verify_webhook_params( $params ) )
				return new WP_Error( 'invalid_alert', 'Invalid alert', array( 'status' => 404 ) );

			if ( ! $this->verify_request( $request ) ) {
				return new WP_Error( 'invalid_signature', 'Invalid signature', array( 'status' => 401 ) );
			}

			// Check and add the customer if needed
			$email = $this->get_buyer_email_address( $params );
			$customer = new EDD_Customer( $email, false );
			$first = $this->get_hook_name();
			$last = 'Customer';
			$user_id = 0;

			if ( ! $customer->id > 0 ) {
				$user = get_user_by( 'email', $email );
				if ( $user ) {
					$user_id = $user->ID;
					$email = $user->user_email;
				}

				$customer->create( array(
					'email' => $email,
					'name' => $first . ' ' . $last,
					'user_id' => $user_id
				) );
			} else {
				$email = $customer->email;
			}

			// See if there is a payment for the order ID already
			$payment = new EDD_Payment;
			foreach ( $customer->get_payments() as $customer_payment ) {
				if ( $customer_payment->transaction_id == $this->get_order_id( $params ) ) {
					$payment = $customer_payment;
					break;
				}
			}

			$payment->customer_id = $customer->id;
			$payment->user_id     = $user_id;
			$payment->first_name  = $first;
			$payment->last_name   = $last;
			$payment->email       = $email;

			// Make sure the user info data is set
			$payment->user_info = array(
				'first_name' => $first,
				'last_name'  => $last,
				'id'         => $user_id,
				'email'      => $email,
			);

			$download = $this->get_download_by_item_id( $this->get_item_id( $params ) );
			if ( ! $download )
				return new WP_Error( 'invalid_download', 'Invalid download', array( 'status' => 500 ) );

			// Only a single price for now
			$args = array(
				'quantity' => 1,
				'item_price' => edd_sanitize_amount( $this->get_item_price( $params ) ),
			);

			$args['tax'] = $this->get_item_tax( $params );

			// ensure download removed if already there
			$payment->remove_download( $download->ID, array( 'quantity' => 1 ) );
			$payment->add_download( $download->ID, $args );
			$payment->date = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
			$payment->status = 'pending';
			$payment->currency = $this->get_order_currency( $params );
			$payment->gateway = $this->get_hook_id();
			$payment->mode = 'live';
			$payment->transaction_id = $this->get_order_id( $params );

			$payment->save();

			// Now switch the status from pending to complete to trigger various actions, like generating a license key
			$payment->status = 'complete';
			$payment->save();

			return new WP_REST_Response( array( 'success' => true ) );
		}
	}
	}