<?php
/**
 * Displays the Featured Events widget area
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

	<div class="container px-4 py-12 mx-auto events-widget-section section-inner">
		<div class="2xl:max-w-[1800px] 2xl:mx-auto">
			<?php dynamic_sidebar( 'events-featured' ); ?>
		</div>
	</div>
	<!-- .widget-area -->
