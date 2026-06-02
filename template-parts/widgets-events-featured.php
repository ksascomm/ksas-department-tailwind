<?php
/**
 * Displays the Featured Events widget area
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

	// 1. First line of defense: check if active
if ( ! is_active_sidebar( 'events-featured' ) ) {
	return;
}

	// 2. Capture the sidebar output
	ob_start();
	dynamic_sidebar( 'events-featured' );
	$sidebar_content = ob_get_clean();

	// 3. REMOVE GHOST SCRIPTS: Strip out script tags and their inner JSON contents entirely
	$clean_content = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $sidebar_content );

	// 4. Strip out HTML tags to see if there is actual visual text/images left
	$stripped_content = trim( strip_tags( $clean_content, '<img><a><p><h2><h3><li>' ) );

	// 5. If it's just empty spacing or hidden nonces, bail completely!
if ( empty( $stripped_content ) ) {
	return;
}
?>

<div class="container px-4 py-12 mx-auto events-widget-section section-inner">
	<div class="2xl:max-w-450 2xl:mx-auto">
		<?php
		/**
		 * The dynamic_sidebar output is already escaped internally by WordPress core
		 * and the active plugin handlers. We use the phpcs:ignore directive to
		 * safely pass theme audits since escaping pre-rendered HTML chunks drops script data.
		 */
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $sidebar_content;
		?>
	</div>
</div>