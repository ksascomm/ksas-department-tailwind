<?php
/**
 * Widget: Events List Event Title
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/widgets/widget-events-list/event/title.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.2.1
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */
?>
<h3 class="tribe-events-widget-events-list__event-title tribe-common-h7">
	<a
		href="<?php echo esc_url( $event->permalink ); ?>"
		title="<?php echo esc_attr( $event->title ); ?>"
		rel="bookmark"
		class="tribe-events-widget-events-list__event-title-link tribe-common-anchor-thin"
	>
	<?php if ( is_active_sidebar( 'events-featured' ) || is_active_sidebar( 'below-news' )  ) : ?>
		<?php
		$thetitle =  $event->title; /* or you can use get_the_title() */
		$getlength = strlen($thetitle);
		$thelength = 70;
		echo substr($thetitle, 0, $thelength);
		if ($getlength > $thelength) echo "...";
		?>
	<?php else: ?>
		<?php
		// phpcs:ignore
		echo $event->title;
		?>
	<?php endif;?>
	</a>
</h3>
