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
	define( 'KSAS_DEPARTMENT_TAILWIND_VERSION', '6.3.0' );
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
		// load_theme_textdomain( 'ksas-dept-tailwind', get_template_directory() . '/languages' );

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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ksas_department_tailwind_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Above Explore Area', 'ksas-dept-tailwind' ),
			'id'            => 'above-explore',
			'description'   => esc_html__( 'This sidebar will appear above the "Explore" section of homepage.', 'ksas-dept-tailwind' ),
			'before_widget' => '<div class="widget-area"><aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Below Explore Area', 'ksas-dept-tailwind' ),
			'id'            => 'below-explore',
			'description'   => esc_html__( 'This sidebar will appear below the "Explore" section of homepage.', 'ksas-dept-tailwind' ),
			'before_widget' => '<div class="widget-area"><aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Events Featured', 'ksas-dept-tailwind' ),
			'id'            => 'events-featured',
			'description'   => esc_html__( 'This widget area will only appear on the homepage and should only be used for the Events Calendar! It is located below Explore area and above news', 'ksas-dept-tailwind' ),
			'before_widget' => '<div class="widget-area"><aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Below News Section', 'ksas-dept-tailwind' ),
			'id'            => 'below-news',
			'description'   => esc_html__( 'Add a maximum of two widgets to appear only on homepage here, below news', 'ksas-dept-tailwind' ),
			'before_widget' => '<div class="widget-area"><aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h2 class="text-2xl font-semibold widget-title font-semi">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Site Footer', 'ksas-dept-tailwind' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Add widgets here to appear in your site-wide footer.', 'ksas-dept-tailwind' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-wrapper">',
			'after_widget'  => '</div></aside>',
			'before_title'  => '<h2 class="text-2xl font-semibold widget-title font-semi">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Graduate Sidebar',
			'id'            => 'graduate-sb',
			'description'   => 'This sidebar will appear on pages under Graduate',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Undergraduate Sidebar',
			'id'            => 'undergrad-sb',
			'description'   => 'This sidebar will appear on pages under Undergraduate',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar 1', 'ksas-dept-tailwind' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ksas-dept-tailwind' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar 2', 'ksas-dept-tailwind' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'ksas-dept-tailwind' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar 3', 'ksas-dept-tailwind' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'ksas-dept-tailwind' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ksas_department_tailwind_widgets_init' );

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
	echo '<div role="navigation" aria-label="Skip to main content"><a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'ksas-dept-tailwind' ) . '</a></div>';
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

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/72c92fef89.js', array(), '6.1.2', false );
	wp_script_add_data( 'fontawesome', array( 'crossorigin' ), array( 'anonymous' ) );
}
add_action( 'wp_enqueue_scripts', 'ksas_department_tailwind_scripts' );

/**
 * Dequeue KSAS-SIS-Courses plugin assets on non-SIS Courses template
 *
 * Hooked to the wp_print_scripts action, with a late priority (100),
 * so that it is after the script was enqueued.
 */
function dequeue_sis_scripts() {
	if ( ! is_page_template( array( '../templates/courses-undergrad-ksasblocks.php', 'page-templates/language-program-courses.php' ) ) ) {
		wp_dequeue_style( 'data-tables' );
		wp_dequeue_style( 'data-tables-searchpanes' );
		wp_dequeue_style( 'data-tables-responsive' );
		wp_dequeue_style( 'courses-css' );
		wp_dequeue_script( 'data-tables' );
		wp_dequeue_script( 'data-tables-searchpanes' );
		wp_dequeue_script( 'data-tables-select' );
		wp_dequeue_script( 'data-tables-responsive' );
		wp_dequeue_script( 'courses-js' );
	}
}
add_action( 'wp_enqueue_scripts', 'dequeue_sis_scripts', 100 );


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


// Register Custom Blocks
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/spotlight' );
}


/**
 * Count the number of widgets in a sidebar
 * Works for up to ten widgets
 * Usage <?php ksas_department_tailwind_sidebar_class( 'sidebar-footer' ); ?> where sidebar-footer is the name of the sidebar
 */
function ksas_department_tailwind_sidebar_class( $sidebar_name ) {
	global $sidebars_widgets;
	$count = count( $sidebars_widgets[ $sidebar_name ] );
	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
		default:
			$class = '';
			break;
	}
	if ( $class ) :
			echo esc_html( $class );
	endif;
}

/**
 * Get the top ancestor ID
 * Used to only show child & grandchild pages in sidebar dropdown menu
 */
function get_the_top_ancestor_id() {
	global $post;
	if ( $post->post_parent ) {
		$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
		return $ancestors[0];
	} else {
		return $post->ID;
	}
}

/**
 * WP_nav_menu separate submenu output.
 *
 * Optional $args contents:
 *
 * string theme_location - The menu that is desired.  Accepts (matching in order) id, slug, name. Defaults to blank.
 * string xpath - Optional. xPath syntax.
 * string before - Optional. Text before the menu tree.
 * string after - Optional. Text after the menu tree.
 * bool echo - Optional, default is TRUE. Whether to echo the menu or return it.
 *
 * @param array $args Arguments
 * @return String If $echo value is set to FALSE.
 *
 * @link https://www.isitwp.com/wp_nav_menu-separate-submenu-output/
 */
function internal_page_submenu( $args = array() ) {
	$defaults = array(
		'theme_location' => 'main-nav',
		'xpath'          => "./li[contains(@class,'current-menu-item') or contains(@class,'current-menu-ancestor')]/ul",
		'before'         => '',
		'after'          => '',
		'echo'           => true,
	);
	$args     = wp_parse_args( $args, $defaults );
	$args     = (object) $args;

	$output = array();

	$menu_tree     = wp_nav_menu(
		array(
			'theme_location' => $args->theme_location,
			'container'      => '',
			'echo'           => false,
		)
	);
	$menu_tree_XML = new SimpleXMLElement( $menu_tree );
	$path          = $menu_tree_XML->xpath( $args->xpath );

	$output[] = $args->before;

	if ( ! empty( $path ) ) {
		$output[] = $path[0]->asXML();
	}

	$output[] = $args->after;

	if ( $args->echo ) {
		echo implode( '', $output );
	} else {
		return implode( '', $output );
	}
}

/**
 * Deactivate Optimize critical images feature
 * introduced in WP Rocket v3.16
 *
 * @link https://docs.wp-rocket.me/article/1816-optimize-critical-images?utm_source=wp_plugin&utm_medium=wp_rocket
 */
add_filter( 'rocket_above_the_fold_optimization', '__return_false' );
