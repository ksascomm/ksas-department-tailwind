<?php
/**
 * Displays the footer widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>

	<div class="footer-widget-area mt-12 relative bg-[url('../images/community-white-on-288.svg')] bg-no-repeat bg-[length:450px] bg-right w-full bg-blue px-6 py-10 md:grid md:gap-x-[calc(2_*_1rem)] md:grid-cols-2 lg:grid-cols-3 after:content-[''] after:table after:clear-both">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>

</div><!-- .widget-area -->

<?php endif; ?>
