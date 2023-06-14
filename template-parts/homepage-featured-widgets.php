<?php
/**
 * Displays the homepage featured widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

	<div class="homepage-featured-widget-section lg:grid lg:grid-cols-2 lg:gap-8 w-full -mb-20 <?php ksas_department_tailwind_sidebar_class( 'homepage-featured' ); ?>-widgets pt-10">
		<?php dynamic_sidebar( 'homepage-featured' ); ?>
	</div>
	<!-- .widget-area -->
