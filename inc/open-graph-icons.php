<?php
/**
 * Add Description Meta Tag and Open Graph Meta Info.
 *
 * @package KSAS_Department_Tailwind
 */
function meta_open_graph() {
	global $post;

	if ( ! is_singular() ) {
		return;
	}

	$excerpt = '';

	if ( is_page( 'Faculty Books' ) ) {
		$excerpt = 'Explore publications by our faculty';
	} elseif ( is_singular( 'people' ) ) {
		$longexcerpt = wp_strip_all_tags( get_post_meta( $post->ID, 'ecpt_bio', true ) );
		$excerpt     = wp_trim_words( $longexcerpt, 15, '...' );
	} elseif ( is_page_template( 'page-templates/people-directory-rows.php' ) ) {
		$excerpt = 'Use the filters or search box to explore our people directory';
	} elseif ( is_page_template( 'page-templates/people-directory-select.php' ) ) {
		$excerpt = 'Explore our ' . get_the_title();
	} elseif ( ! empty( $post->post_content ) ) {
		// Strip tags and trim the actual content if no specific case matches.
		$excerpt = wp_trim_words( wp_strip_all_tags( $post->post_content ), 55, '...' );
	} else {
		$excerpt = get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : get_bloginfo( 'title' );
	}

	// Standard Meta.
	echo '<meta name="description" content="' . esc_attr( $excerpt ) . '"/>' . "\n";

	// Open Graph.
	echo '<meta property="og:title" content="' . esc_attr( get_the_title() . ' | ' . get_bloginfo( 'title' ) ) . '"/>' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $excerpt ) . '"/>' . "\n";
	echo '<meta property="og:type" content="article"/>' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'title' ) ) . '"/>' . "\n";
	echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '"/>' . "\n";
	echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '"/>' . "\n";

	// Twitter.
	echo '<meta name="twitter:card" content="summary" />' . "\n";
	echo '<meta name="twitter:site" content="@JHUArtsSciences" />' . "\n";

	// Image Logic.
	if ( has_post_thumbnail( $post->ID ) ) {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		if ( $thumbnail_src ) {
			echo '<meta property="og:image" content="' . esc_url( $thumbnail_src[0] ) . '"/>' . "\n";
		}
	} else {
		$default_image = get_template_directory_uri() . '/dist/images/favicons/apple-touch-icon-180x180.png';
		echo '<meta property="og:image" content="' . esc_url( $default_image ) . '"/>' . "\n";
	}
}
add_action( 'wp_head', 'meta_open_graph', 5 );

/**
 * Create Site Icons using theme favicons.
 */
function ksas_default_site_icon() {
	if ( ! has_site_icon() && ! is_customize_preview() ) {
		$path = get_template_directory_uri() . '/dist/images/favicons/';

		echo '<link rel="shortcut icon" type="image/png" href="' . esc_url( $path . 'favicon.ico' ) . '" />' . "\n";
		echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url( $path . 'favicon-16x16.png' ) . '" />' . "\n";
		echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( $path . 'favicon-32x32.png' ) . '" />' . "\n";
		echo '<link rel="icon" type="image/png" sizes="96x96" href="' . esc_url( $path . 'favicon-96x96.png' ) . '" />' . "\n";
		echo '<link rel="apple-touch-icon" sizes="120x120" href="' . esc_url( $path . 'apple-touch-icon-120x120.png' ) . '" />' . "\n";
		echo '<link rel="apple-touch-icon" sizes="152x152" href="' . esc_url( $path . 'apple-touch-icon-152x152.png' ) . '" />' . "\n";
		echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url( $path . 'apple-touch-icon-180x180.png' ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'ksas_default_site_icon', 99 );
add_action( 'login_head', 'ksas_default_site_icon', 99 );
