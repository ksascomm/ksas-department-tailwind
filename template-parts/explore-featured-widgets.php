<?php
/**
 * Displays the Explore section featured widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

	<div class="news-featured-widget-section w-full <?php ksas_department_tailwind_sidebar_class( 'explore-featured' ); ?>-widgets">
		<?php dynamic_sidebar( 'explore-featured' ); ?>
	</div>
	<!-- .widget-area -->
