<?php
/**
 * KSAS_Department_Tailwind functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KSAS_Department_Tailwind
 */

if ( ! defined( 'KSAS_DEPARTMENT_TAILWIND_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'KSAS_DEPARTMENT_TAILWIND_VERSION', '8.0.0' );
}

if ( ! function_exists( 'ksas_department_tailwind_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ksas_department_tailwind_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on KSAS_Department_Tailwind, use a find and replace
		 * to change 'ksas-dept-tailwind' to the name of your theme in all the template files.
		 */

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
				'main-nav'    => esc_html__( 'The Main Menu', 'ksas-dept-tailwind' ),
				'quick_links' => esc_html__( 'Quick Links', 'ksas-dept-tailwind' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Set content-width.
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1000;
		}

		/*
		* Adds `async` and `defer` support for scripts registered or enqueued
		* by the theme.
		*/
		$loader = new TwentyTwenty_Script_Loader();
		add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );
	}
endif;
add_action( 'after_setup_theme', 'ksas_department_tailwind_setup' );

/**
 * Custom sidebar functions for this theme.
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Custom post type functions.
 */
require get_template_directory() . '/inc/custom-post-types.php';

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
 * Custom Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Block Patterns
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Gutenberg Editor
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Various clean up functions
 */
require get_template_directory() . '/inc/cleanup.php';

/**
 * Handle SVG icons
 */
require get_template_directory() . '/inc/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Custom script loader class
 */
require get_template_directory() . '/inc/class-twentytwenty-script-loader.php';

/**
 * Open Graph Meta Tags
 */
require get_template_directory() . '/inc/open-graph-icons.php';

/**
 * Load ACF compatibility file.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	require get_template_directory() . '/inc/acf-options.php';
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function ksas_skip_link() {
	echo '<div role="navigation" aria-label="Skip to main content"><a class="skip-link screen-reader-text" href="#site-content">' . esc_html__( 'Skip to the content', 'ksas-dept-tailwind' ) . '</a></div>';
}

add_action( 'wp_body_open', 'ksas_skip_link', 5 );

/**
 * Enqueue scripts and styles.
 */
function ksas_department_tailwind_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'ksas-department-tailwind-style', get_template_directory_uri() . '/dist/css/style.css', array(), filemtime( get_template_directory() . '/dist/css/style.css' ), false );
	wp_style_add_data( 'ksas-department-tailwind-style', 'rtl', 'replace' );

	wp_enqueue_script( 'ksas-department-tailwind-script', get_template_directory_uri() . '/dist/js/bundle.min.js', array( 'jquery' ), KSAS_DEPARTMENT_TAILWIND_VERSION, true );
	wp_script_add_data( 'ksas-department-tailwind-script', 'defer', true );

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/72c92fef89.js', array(), '6.1.2', true );
	wp_script_add_data( 'fontawesome', array( 'crossorigin' ), array( 'anonymous' ) );
}
add_action( 'wp_enqueue_scripts', 'ksas_department_tailwind_scripts' );

/**
 * Enqueue Siteimprove Analytics script.
 */
function ksas_enqueue_siteimprove() {
	// Only enqueue if the ACF option is set.
	if ( get_field( 'siteimprove', 'option' ) ) {
		wp_enqueue_script(
			'siteimprove-analytics',
			'https://siteimproveanalytics.com/js/siteanalyze_11464.js',
			array(),
			null,
			array( 'strategy' => 'async' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'ksas_enqueue_siteimprove' );

/** Add defer attribute to specific scripts */
function add_defer_attribute( $tag, $handle ) {
	// Add script handles to the array below.
	$scripts_to_defer = array( 'font-awesome' );

	foreach ( $scripts_to_defer as $defer_script ) {
		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}
	return $tag;
}

add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

/** Add async attribute to specific scripts */
function add_async_attribute( $tag, $handle ) {
	// Add script handles to the array below.
	$scripts_to_async = array( 'google-tag-manager' );

	foreach ( $scripts_to_async as $async_script ) {
		if ( $async_script === $handle ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}
	}
	return $tag;
}

add_filter( 'script_loader_tag', 'add_async_attribute', 10, 2 );


// Register Custom Blocks.
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/spotlight' );
}
