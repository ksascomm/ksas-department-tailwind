<?php
/**
 * Displays the widgets below the Explore section.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

	<div class="container below-explore-widget-section prose flex flex-col lg:flex-row mx-auto w-full pt-10 <?php ksas_department_tailwind_sidebar_class( 'below-explore' ); ?>-widgets">
			<?php dynamic_sidebar( 'below-explore' ); ?>
	</div>
	<!-- .widget-area -->
