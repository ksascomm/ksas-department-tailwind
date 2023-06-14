<?php
/**
 * KSAS Blocks Custom Post Types functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KSAS_Blocks
 */

add_action( 'wp_enqueue_scripts', 'ksas_blocks_custom_posts_scripts' );
	/**
	 * Conditionally add isotope scripts to Research Projects page
	 *
	 * Note that this function is hooked into the wp_enqueue_scripts
	 */
function ksas_blocks_custom_posts_scripts() {
	if ( is_page_template( 'page-templates/research-projects.php' ) || is_page_template( 'page-templates/people-directory-rows.php' ) || is_page_template( 'page-templates/people-directory-columns.php' ) ) :
		wp_enqueue_script( 'isotope-packaged', 'https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js', array(), '3.0.6', true );
	endif;
}

/**
 * Create function to print Role taxonomy on people-sort template part
 *
 * @param int/object $post ID or object of the post.
 */
function get_the_roles( $post ) {
	$roles = get_the_terms( $post->ID, 'role' );
	if ( $roles && ! is_wp_error( $roles ) ) :
		$role_names = array();
		foreach ( $roles as $role ) {
			$role_names[] = $role->slug;
		}
		$role_name = join( ' ', $role_names );

		endif;
		return $role_name;
}
/**
 * Create function to print Filter taxonomy on people-sort template part
 *
 * @param int/object $post ID or object of the post.
 */
function get_the_filters( $post ) {
	$directory_filters = get_the_terms( $post->ID, 'filter' );
	if ( ! empty( $directory_filters ) && ! is_wp_error( $directory_filters ) ) {
		$directory_filter_names = array();
		foreach ( $directory_filters as $directory_filter ) {
			$directory_filter_names[] = $directory_filter->slug;
		}
		$directory_filter_name = join( ' ', $directory_filter_names );
		return $directory_filter_name;
	}
}

/**
 * Redirect empty People CPT 'ecpt_bio' meta fields
 * to whats in 'ecpt_website' meta
 */
function redirect_empty_bios() {
	if ( is_singular( 'people' ) ) {
		global $post;
		$bio  = get_post_meta( $post->ID, 'ecpt_bio', true );
		$link = get_post_meta( $post->ID, 'ecpt_website', true );
		if ( has_term( array( 'faculty', 'tenured-and-tenure-track-faculty', 'joint-faculty', 'advisory-board' ), 'role' ) ) {
			if ( empty( $bio ) && isset( $link ) ) {
				wp_safe_redirect( esc_url( $link ), 301 );
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'redirect_empty_bios' );


add_image_size( 'directory', 150, 217, true );
