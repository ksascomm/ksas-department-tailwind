<?php
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="text-2xl font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="text-2xl font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
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
			'before_title'  => '<h2 class="font-bold widget-title font-heavy">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ksas_department_tailwind_widgets_init' );

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
