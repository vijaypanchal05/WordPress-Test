<?php
/*
Plugin Name: Customppl Post Tabs
Plugin URI: http://planpixels.com/
Description: Embed Youtube iframe. 
Version: 1.1.0
Author: planpixel
Author URI: http://planpixels.com
WordPress version supported: 3.5 and above
*/
if ( ! defined( 'WPTS_PRO_ACTIVE' ) ):
if ( ! defined( 'WPTS_PLUGIN_BASENAME' ) )
	define( 'WPTS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define("WPTS_VER","1.6.2",false);
define('WPTS_URLPATH', trailingslashit( WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) ) );
global $wpts,$wpts_db_version;
$wpts_db_version='1.6.2'; //current version of WordPress Post Tabs database 
$wpts = get_option('wpts_options');
function wpts_url( $path = '' ) {
	global $wp_version;
	if ( version_compare( $wp_version, '2.8', '<' ) ) { // Using WordPress 2.7
		$folder = dirname( plugin_basename( __FILE__ ) );
		if ( '.' != $folder )
			$path = path_join( ltrim( $folder, '/' ), $path );

		return plugins_url( $path );
	}
	return plugins_url( $path, __FILE__ );
}
//on activation, your WordPress Post Tabs options will be populated. Here a single option is used which is actually an array of multiple options
function activate_wpts() {
	global $wpts_db_version;
	$default_tab_settings = get_wpts_default_settings();
	$installed_ver = get_site_option( 'wpts_db_version' );
	if( $installed_ver != $wpts_db_version ) {
		$wpts_opts1 = get_option('wpts_options');
		$speed=(isset($wpts_opts1['speed'])?$wpts_opts1['speed']:'');
		if(isset($wpts_opts1) and $speed=='1'){
			$pages=$wpts_opts1['pages'];
			$posts=$wpts_opts1['posts'];
			if(empty($pages) or !isset($pages)) {
			  $wpts_opts1['pages']='0';
			}
			if(empty($posts) or !isset($posts)) {
			  $wpts_opts1['posts']='0';
			}
		}
		$wpts_opts2 = $default_tab_settings;
		if ($wpts_opts1) {
			$wpts = $wpts_opts1 + $wpts_opts2;
			update_option('wpts_options',$wpts);
		}
		else {
			$wpts_opts1 = array();	
			$wpts = $wpts_opts1 + $wpts_opts2;
			add_option('wpts_options',$wpts);		
		}
		update_site_option( 'wpts_db_version', $wpts_db_version );
	}
}

register_activation_hook( __FILE__, 'activate_wpts' );

/* Added for auto update - start */
function wpts_update_db_check() {
    global $wpts_db_version;
    if (get_site_option('wpts_db_version') != $wpts_db_version) {
        activate_wpts();
    }
}
add_action('plugins_loaded', 'wpts_update_db_check');
/* Added for auto update - end */

require_once (dirname (__FILE__) . '/tinymce/tinymce.php');

function wpts_wp_init() {
    global $post,$wpts;
	$wpts = wpts_populate_settings( $wpts );
	if(is_singular() or $wpts['enable_everywhere'] == '1') { 
		$enablewpts = get_post_meta($post->ID, 'enablewpts', true);
		if(isset($wpts['posts']))$wpposts=$wpts['posts'];
		else $wpposts='';
		if(isset($wpts['pages']))$wppages=$wpts['pages'];
		else $wppages='';
		// check whether cookie is set for last active tab
		if(isset($wpts['enablecookie'])) $enablecookie = $wpts['enablecookie'];
		else $enablecookie = '0';
		if( (is_page() and ((!empty($enablewpts) and $enablewpts=='1') or  $wppages != '0'  ) ) 
			or (is_single() and ((!empty($enablewpts) and $enablewpts=='1') or $wpposts != '0'  ) ) or $wpts['enable_everywhere'] == '1' ) 
		{
			$css="css/styles/".$wpts['stylesheet'].'/style.css';
			wp_enqueue_style( 'wpts_ui_css', wpts_url( $css ),false, WPTS_VER, 'all'); 
			if(isset($wpts['jquerynoload']) and $wpts['jquerynoload']=='1') {
			    wp_deregister_script( 'jquery' );
				wp_enqueue_script('jquery-ui-tabs', false, array('jquery-ui-core'), WPTS_VER, true);
			}
			else{
				wp_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), WPTS_VER, true);
			}
			if($enablecookie == '1') wp_enqueue_script('jquery-cookie', wpts_plugin_url( 'js/jquery.cookie.js' ), array('jquery'), WPTS_VER, true);
			// JS added			
			wp_enqueue_script('jquery-posttabs', wpts_plugin_url( 'js/jquery.posttabs.js' ), array('jquery'), WPTS_VER, true);
			global $wpts_count,$wpts_tab_count,$wpts_content,$wpts_prev_post;
			$wpts_count=0;
			$wpts_tab_count=0;
			$wpts_prev_post='';
			$wpts_content=array();
		}
	}
}
add_action( 'wp', 'wpts_wp_init' );

function wpts_edit_custom_box(){
	global $post;
	echo '<input type="hidden" name="enablewpts_noncename" id="enablewpts_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />'; 	?>
	<?php
	$enablewpts = get_post_meta($post->ID,'enablewpts',true);
	if($enablewpts=="1"){
		$checked = ' checked="checked" ';
	}else{
		$checked = '';
	}
	?>
	<p><input type="checkbox" id="enablewpts" name="enablewpts" value="1" <?php echo $checked;?> />&nbsp;<label for="enablewpts"><strong>Enable WP Post Tabs Feature</strong></label></p>
	<?php
}

function wpts_add_custom_box() {
	add_meta_box( 'wpts_box1', __( 'Post Tabs' ), 'wpts_edit_custom_box', 'post', 'side','high' );
	//add_meta_box( $id,   $title,     $callback,   $page, $context, $priority ); 
	add_meta_box( 'wpts_box2', __( 'Page Tabs' ), 'wpts_edit_custom_box', 'page', 'advanced' );
}
/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'wpts_add_custom_box');

function wpts_savepost(){
	global $post;
	if(isset($post))$post_id = $post->ID;
	else $post_id = '';
	// verify this came from the our screen and with proper authorization,
	  // because save_post can be triggered at other times
	if(isset($_POST['enablewpts_noncename'])){	  
		if ( !wp_verify_nonce( $_POST['enablewpts_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}	
	}
	else{
		return $post_id;		
	}
	
	  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	  // to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
	  // Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}
	  // OK, we're authenticated: we need to find and save the data
	$data =  ( isset ( $_POST['enablewpts'] ) and $_POST['enablewpts'] == "1") ? "1" : "0";
	update_post_meta($post_id, 'enablewpts', $data);
	return $data;
}
add_action('save_post', 'wpts_savepost');





function wpts_plugin_action_links( $links, $file ) {
	if ( $file != WPTS_PLUGIN_BASENAME )
		return $links;

	$url = wpts_admin_url( array( 'page' => 'customppl-post-tabs.php' ) );

	$settings_link = '<a href="' . esc_attr( $url ) . '">'
	. esc_html( __( 'Settings') ) . '</a>';

	array_unshift( $links, $settings_link );

	return $links;
}

// function for adding settings page to wp-admin
function wpts_settings() {
    // Add a new submenu under Options:
	add_options_page('WP Post Tabs', 'WP Post Tabs', 'manage_options', basename(__FILE__), 'wpts_settings_page');
}

function wpts_admin_head() {?>
<?php }
add_action('admin_head', 'wpts_admin_head');

//Function to add custom style on settings page - version 1.4
function wpts_custom_css() {
	global $wpts;	
	if( ( is_admin() and isset($_GET['page']) and 'customppl-post-tabs.php' == $_GET['page']) or !is_admin() ){	?>
	<script type="text/javascript">jQuery(document).ready(function() { jQuery("head").append("<style type=\"text/css\"><?php echo $css;?></style>"); }) </script>
	<?php 
}
}
add_action('wp_footer', 'wpts_custom_css');
add_action('admin_footer', 'wpts_custom_css');

function wpts_plugin_url( $path = '' ) {
	return plugins_url( $path, __FILE__ );
}

function wpts_admin_scripts() {
  if ( is_admin() ){ // admin actions
  // Settings page only
  	if ( isset($_GET['page']) && 'customppl-post-tabs.php' == $_GET['page'] ) {
  		wp_enqueue_script('jquery', false, false, false, false);
  		wp_enqueue_script( 'wpts_admin_js', wpts_plugin_url( 'js/admin.js' ),	array('jquery'), WPTS_VER, false);
  		wp_enqueue_style( 'wpts_admin_css', wpts_plugin_url( 'css/admin.css' ),
  			false, WPTS_VER, 'all');
  	}
  }
}

add_action( 'admin_init', 'wpts_admin_scripts' );

function wpts_qtag_enqueue_scripts() {
	global $wpts;			
	wp_localize_script('wptsqtag', 'wptsadminL10n', array(
		'tab' => ( isset( $wpts['tab_code'] ) ? $wpts['tab_code'] : 'wptab1' ),
		'end' => ( isset( $wpts['tab_end_code'] ) ? $wpts['tab_end_code'] : 'end_wptabset' )
	));
}



// Hook for adding admin menus
if ( is_admin() ){ // admin actions
	add_action('admin_menu', 'wpts_settings');
	add_action( 'admin_init', 'register_wpts_settings' ); 
} 
function register_wpts_settings() { // whitelist options
	register_setting( 'wpts-group', 'wpts_options' );
}

function get_wpts_default_settings() {
	$default_tab_settings=array('speed' => '1',
		'transition' => '',
		'pages' => '1',
		'posts' => '1',
		'stylesheet' => 'default',
		'reload' => '0',
		'tab_code' => 'wptab',
		'tab_end_code' => 'end_wptabset',
		'support' => '0', 
		'fade' => '0', 
		'jquerynoload' => '0',
		'disable_cookies'=>'0',
		'showtitle' =>'0',
		'linktarget' =>'0',
		'nav'=>'0',
		'next_text'=>'Next &#187;',
		'prev_text'=>'&#171; Prev',
		'enable_everywhere'=>'0',
		'disable_fouc'=>'0',
		'prettylinks'=>'0',
		'enablecookie' => '0',
		'css'=>''
	);
	return $default_tab_settings;
}
function wpts_populate_settings( $wpts ) {
	$default_tab_settings = get_wpts_default_settings();
	foreach( $default_tab_settings as $key => $value ){
		if( !isset( $wpts[$key] ) ) $wpts[$key] = '';
	}
	return $wpts;
}

else:
	add_action( 'admin_init', 'wpts_deactivate' );

	function wpts_deactivate() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
endif;
?>
