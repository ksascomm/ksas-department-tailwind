<?php
/**
 * Advanced Custom Fields Compatibility File
 *
 * @package KSAS_Department_Tailwind
 */

/**
 * ACF Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Header Settings',
			'menu_title'  => 'Header',
			'parent_slug' => 'theme-general-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Footer Settings',
			'menu_title'  => 'Footer',
			'parent_slug' => 'theme-general-settings',
		)
	);

}


/**
 * ACF Google Maps API
 *
 * https://www.advancedcustomfields.com/resources/google-map/
 */
function my_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyCMgFggrsO_fNjrwxclh5I6ThdnyN5G9ZM' );
}
add_action( 'acf/init', 'my_acf_init' );
