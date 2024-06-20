<?php
/**
 * Block Name: Testimonials
 *
 * This is the template that displays the testimonials loop block.
 */

$arg_type = get_field( 'loop_argument_type' );
if ( $arg_type == 'count' ) :
	$args = array(
		'orderby'        => 'rand',
		'post_type'      => array( 'testimonial', 'profile' ),
		'posts_per_page' => get_field( 'testimonial_count' ),
	);
else :
	$testimonials = get_field( 'select_testimonials' );
	$args         = array(
		'orderby'   => 'title',
		'post_type' => array( 'testimonial', 'profile' ),
		'post__in'  => $testimonials,
	);
endif;

$class_name = 'testimonial';

if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( $is_preview ) {
	$class_name .= ' is-admin';
}

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>
<div class="relative">
<div class="block-padding">
<div class="relative <?php echo esc_attr( $class_name ); ?>">
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		?>
	<div class="testimonial-container">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail(
				'large',
				array(
					'class' => 'inline max-w-full w-64 md:w-96 rounded z-20',
					'alt'   => esc_html( get_the_title() ),
				)
			);
		}
		?>
		<svg viewBox="0 0 1280 1280" class="testimonial-svg"><path d="M55 33.5C44.5 37 35 47.6 32.8 58.3c-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 33.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.4 25.5 19.4 4.1 39.5-14.2 37.5-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 33.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 33.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 33.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 33.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 33.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 33.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 33.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM1207 33.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM55 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 161.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.4 25.5 19.4 4.1 39.5-14.2 37.5-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 161.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 161.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM1207 161.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM55 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 289.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 417.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 545.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 673.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 801.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 801.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 801.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM439 801.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM567 801.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 801.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 801.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 801.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 801.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 801.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 929.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 929.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 929.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM439 929.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM567 929.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 929.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 929.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 929.5c-15.1 5-25.3 21.6-22.2 36.2 2.5 11.9 13.6 23 25.5 25.5 19.3 4.1 39.4-14.2 37.4-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 929.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 929.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 1057.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM439 1057.5c-10.5 3.5-20 14.1-22.2 24.8-2.5 11.7 3.2 24.4 14.2 31.9 10.7 7.4 22.9 7.5 33.7.3 17.7-11.8 20.1-33.8 5.3-48.5-8.5-8.6-20.7-11.9-31-8.5zM567 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 1057.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM55 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM183 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM311 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM439 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM567 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM695 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM823 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM951 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1079 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6zM1207 1185.5c-10.5 3.5-20 14.1-22.2 24.8-4.3 20.6 16.3 41.2 36.9 36.9 15.5-3.2 27.5-19 26-33.9-1.1-10.5-9-21.3-19-26.2-6.1-2.9-15.5-3.6-21.7-1.6z"></path></svg>
		<div class="testimonial-callout bg-grey-lightest">
			<div class="text-base">
				<?php
				global $post;
				if ( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ) :
					?>
					<?php echo get_post_meta( $post->ID, 'ecpt_pull_quote', true ); ?>
				<?php elseif ( get_post_meta( $post->ID, 'ecpt_quote', true ) ) : ?>
					<?php echo get_post_meta( $post->ID, 'ecpt_quote', true ); ?>
				<?php else : ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div>
			<p class="text-xl font-semi font-semibold"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></p>
			<p class="text-lg font-semi font-semibold">
			<?php
			global $post;
			echo wp_kses_post( the_field( 'fields_of_study', $post->ID ) );
			?>
			</p>
		</div>
	</div>
	<div class="testimonial-offset bg-blue-light"></div>
	<?php endwhile; ?>
</div>
</div>
				</div>
<?php endif; ?>