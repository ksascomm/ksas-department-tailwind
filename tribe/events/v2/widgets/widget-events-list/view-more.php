<?php
/**
 * Widget: Events List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/widgets/widget-events-list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.2.1
 *
 * @var string $view_more_link The URL to view all events.
 *
 * @see tribe_get_event() For the format of the event object.
 */

if ( empty( $view_more_link ) ) {
	return;
}
?>
<div class="!mt-0 tribe-events-widget-events-list__view-more tribe-common-b1 tribe-common-b2--min-medium">
	<a
		href="<?php echo esc_url(home_url('/events/')); ?>"
		class="font-bold tribe-events-widget-events-list__view-more-link tribe-common-anchor-thin"
	>
		<?php esc_html_e( 'View More Events', 'ksas-dept-tailwind' ); ?>
		&nbsp;<span class="fa-solid fa-circle-chevron-right" aria-hidden="true"></span>
	</a>
</div>
