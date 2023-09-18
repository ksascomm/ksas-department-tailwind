<?php
/**
 * Displays the widget area below Front page news section.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<div class="below-news-widget-section grid grid-flow-row lg:grid-flow-col auto-cols-auto lg:-mb-20 pt-10 <?php ksas_department_tailwind_sidebar_class( 'below-news' ); ?>-widgets">
	<?php dynamic_sidebar( 'below-news' ); ?>
</div>
<!-- .widget-area -->