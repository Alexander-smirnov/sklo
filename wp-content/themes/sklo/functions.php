<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _tk_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_tk' ),
	) );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_tk_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _tk styles
	wp_enqueue_style( '_tk-style', get_stylesheet_uri() );

	// load _tk styles
	wp_enqueue_style( 'custom_style', get_template_directory_uri() . '/includes/css/style.css' );

	// load bootstrap js
	wp_enqueue_script('_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	//custom js
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/includes/js/custom.js' );

	wp_enqueue_script( '_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

require_once('includes/post-types/admin-type.php');


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
	echo '<style>
	#phone_sectionid .inside label img {
		width: 40px;vertical-align: sub;padding-right:5px;
	}
	#phone_sectionid .inside label {
		font-size: 20px;
		display:inline-block;
		width: 130px;
	}
	#phone_sectionid .inside input {
	    margin-left: 20px;
	    width: 130px;
	}
	#quest_sectionid label {
		width: 400px;
	    display: inline-block;
	    margin: 10px 0;
	}
	#quest_sectionid input {
	    width: 300px;
	}
  </style>';
}

function admin_ajax() {
	wp_localize_script( 'jquery', 'vars', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'admin_ajax' );


function send_custom_mail() {
	$from_name = 'site sklo';
	$from_email = get_option('mail_from');
	$admin_email = get_option('admin_email');
	$message = '
                <html>
                    <head>
                        <title>Вопрос с сайта</title>
                    </head>
                    <body>
                    	<p>Поступил вопрос от клиента на сайте <b>'. get_bloginfo( "name", "display" ) .'</b></p>
                        <p>Email пользователя: '.$_POST['form'].'</p>
                        <p>Сообщение: '.$_POST['message'].'</p>
                    </body>
                </html>';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8; '."\r\n";
	$headers .= 'From: =?utf-8?b?' . base64_encode($from_name) . "?= <$from_email>\r\n";

	wp_mail($admin_email, 'Вопрос с сайта', $message, $headers );
	die();
}

add_action( 'wp_ajax_send_custom_mail', 'send_custom_mail' );
add_action( 'wp_ajax_nopriv_send_custom_mail', 'send_custom_mail' );


function wpse_80236_Colorpicker(){
	wp_enqueue_style( 'wp-color-picker');
	//
	wp_enqueue_script( 'wp-color-picker');
}
add_action('admin_enqueue_scripts', 'wpse_80236_Colorpicker');



function custom_price() {

}
add_action( 'wp_ajax_send_custom_mail', 'custom_price' );
add_action( 'wp_ajax_nopriv_send_custom_mail', 'custom_price' );

@require_once ('includes/post-types/customize.php');