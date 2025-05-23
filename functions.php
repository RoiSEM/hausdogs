<?php
/**
 * huasdogs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package huasdogs
 */

function huasdogs_enqueue_styles()
{
	wp_enqueue_style(
		'huasdogs-style',
		get_template_directory_uri() . '/assets/css/style.css',
		[],
		filemtime(get_template_directory() . '/assets/css/style.css')
	);
}
add_action('wp_enqueue_scripts', 'huasdogs_enqueue_styles');

function doghause_enqueue_fonts()
{
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@300;400;500&display=swap', false);
}
add_action('wp_enqueue_scripts', 'doghause_enqueue_fonts');


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function huasdogs_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on huasdogs, use a find and replace
		* to change 'huasdogs' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'huasdogs', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'huasdogs' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'huasdogs_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'huasdogs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function huasdogs_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'huasdogs_content_width', 640 );
}
add_action( 'after_setup_theme', 'huasdogs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function huasdogs_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'huasdogs' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'huasdogs' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'huasdogs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function huasdogs_scripts() {
	wp_enqueue_style( 'huasdogs-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'huasdogs-style', 'rtl', 'replace' );

	// Navigation script
	wp_enqueue_script( 'huasdogs-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// Theme scripts
	wp_enqueue_script( 'jquery' ); // Use WordPress built-in jQuery
	wp_enqueue_script( 'jquery-scrollex', get_template_directory_uri() . '/js/jquery.scrollex.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'jquery-scrolly', get_template_directory_uri() . '/js/jquery.scrolly.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'browser', get_template_directory_uri() . '/js/browser.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'breakpoints', get_template_directory_uri() . '/js/breakpoints.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'util', get_template_directory_uri() . '/js/util.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery', 'jquery-scrollex', 'jquery-scrolly', 'browser', 'breakpoints', 'util'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'huasdogs_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

