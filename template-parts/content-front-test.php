<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>
<?php
	$studyfieldacf  = get_field( 'studyfield' );
	//$studyfield_url = 'https://krieger.jhu.edu/wp-json/wp/v2/studyfields?slug=' . $studyfieldacf;
	$studyfield_url = 'https://krieger.jhu.edu/wp-json/wp/v2/studyfields?slug=history';
if ( WP_DEBUG || false === ( $studyfield = get_transient( 'studyfield_api_query' ) ) ) {
	$studyfield = wp_remote_get( $studyfield_url );
	set_transient( 'studyfield_api_query', $studyfield, 2419200 );
}

	// Display a error nothing is returned.
if ( is_wp_error( $studyfield ) ) {
	$error_string = $studyfield->get_error_message();
	echo '<script>console.log("Error:' . $error_string . '")</script>';

}
	// Get the body.
	$studyfield_response = json_decode( wp_remote_retrieve_body( $studyfield ) );

	// Display a warning nothing is returned.
if ( empty( $studyfield_response ) ) {
	echo '<script>console.log("Error: There is no API Response")</script>';
}

if ( ! empty( $studyfield_response ) ) :
	?>

	<?php
	foreach ( $studyfield_response as $studyfield_data ) :
		$studyfield_tagline = $studyfield_data->post_meta_fields->ecpt_headline[0];
		$studyfield_degrees = $studyfield_data->post_meta_fields->ecpt_degreesoffered[0];
		$studyfield_majors  = $studyfield_data->post_meta_fields->ecpt_majors[0];
		$studyfield_minors  = $studyfield_data->post_meta_fields->ecpt_minors[0];
	endforeach;
	?>
<?php endif; ?>

<div class="hero-background">

	<div class="container mx-auto flex flex-wrap flex-col md:flex-row items-center">
		<!--Left Col-->
		<div class="flex justify-center items-start px-6">
			<div class="basis-0 grow">
				<h2 class="my-4 text-5xl font-bold leading-tight text-white"><?php echo esc_html( $studyfield_tagline ); ?></h2>
				<div class="leading-normal text-xl mb-8 text-white">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksas-department-tailwind' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>
				<div class="flex items-center justify-center">
					<div class="inline-flex">
						<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_degreesoffered[0] ) ) : ?>
						<div class="inline-block rounded bg-white border-blue border-4 mx-2 px-6 pt-2.5 pb-2 uppercase leading-normal font-heavy font-bold transition duration-150 ease-in-out hover:bg-primary-600 focus:bg-primary-600 focus:outline-none focus:ring-0 active:bg-primary-700"
						data-te-ripple-init
						data-te-ripple-color="light"><?php echo $studyfield_degrees; ?></div>
						<?php endif; ?>
						<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_majors[0] ) ) : ?>
						<div class="inline-block rounded bg-white border-blue border-4 mx-2 px-6 pt-2.5 pb-2 uppercase leading-normal font-heavy font-bold transition duration-150 ease-in-out hover:bg-primary-600 focus:bg-primary-600 focus:outline-none focus:ring-0 active:bg-primary-700"
							data-te-ripple-init
							data-te-ripple-color="light">Major</div>
						<?php endif; ?>
						<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_minors[0] ) ) : ?>
						<div class="inline-block rounded bg-white border-blue border-4 mx-2 px-6 pt-2.5 pb-2 uppercase leading-normal font-heavy font-bold transition duration-150 ease-in-out hover:bg-primary-600 focus:bg-primary-600 focus:outline-none focus:ring-0 active:bg-primary-700"
							data-te-ripple-init
							data-te-ripple-color="light">Minor</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="sr-only">%s</span>', 'ksas-department-tailwind' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
				<?php endif; ?>
			</div>
		<!--Right Col-->
			<?php if ( have_rows( 'homepage_hero_images' ) ) : ?>
				<?php
				$repeater = get_field( 'homepage_hero_images' );
				// Get a random rows. Change the second parameter in array_rand() to how many rows you want.
				$random_rows = array_rand( $repeater, 2 );
				//shuffle( $random_images );
				//$random_img_url = $random_images[0]['homepage_hero_image']['url'];
				//$random_img_alt = $random_images[0]['homepage_hero_image']['alt'];
				// Loop through the random rows if more than one is returned
			if( is_array( $random_rows ) ) : ?>

			<?php foreach( $random_rows as $random_row ) :?>
					<div class="homepage-hero-image flex basis-0 grow">
						<img class="w-96 p-6" src="<?php echo $repeater[$random_row]['homepage_hero_image']['sizes']['large'];?>" alt="<?php echo $repeater[$random_row]['homepage_hero_image']['alt'];?>">
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php else : ?>
			<?php ksas_department_tailwind_post_thumbnail(); ?>
		<?php endif; ?>
		</div>
	</div>
</div>


<?php
if ( function_exists( 'get_field' ) && get_field( 'explore_the_department' ) ) :
	?>
	<?php
	if ( have_rows( 'explore_the_department' ) ) : ?>
		<?php $heading = get_field( 'buckets_heading' ); ?>
		<!--Print Heading if there-->
		<?php if ( $heading ) : ?>
			<div class="p-8">
				<header aria-label="<?php the_field( 'buckets_heading' ); ?>">
					<h2><?php echo esc_html( $heading ); ?></h2>
				</header>
			</div>
		<?php endif; ?>
		<div class="grid grid-cols-1 lg:grid-cols-3">
		<?php
		while ( have_rows( 'explore_the_department' ) ) :
			the_row();
			?>
			<div class="relative bucket-<?php echo get_row_index(); ?> hover:opacity-75" aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
			<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>">
				<?php
				$image = get_sub_field( 'explore_bucket_image' );
				if ( get_sub_field( 'explore_bucket_image' ) ) :
					?>
				<?php echo wp_get_attachment_image( $image['ID'], 'full', false, array( 'class' => '!my-0 w-half lg:w-full h-auto lg:h-64' )); ?>
				<?php endif; ?>
				<div class="p-8 bucket-text">
					<h3 class="!mt-4 !text-3xl">
						<?php the_sub_field( 'explore_bucket_heading' ); ?>
					</h3>
					<p class="text-xl leading-tight"><?php the_sub_field( 'explore_bucket_text' ); ?></p>
				</div>
			</a>
			</div>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
<?php endif; ?>
