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
	$studyfield_url = 'https://krieger.jhu.edu/wp-json/wp/v2/studyfields?slug=' . $studyfieldacf;
	// $studyfield_url = 'https://krieger.jhu.edu/wp-json/wp/v2/studyfields?slug=history';
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

<div class="flex border-t border-blue hero bg-grey-cool bg-opacity-50 front-featured-image-area h-auto" role="banner">
	<div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-7/12">
		<div>
			<h2 class="text-primary text-3xl md:text-3xl lg:text-4xl !mt-0 font-heavy font-bold">
				<?php if ( ! empty( $studyfield_tagline ) ) : ?>
					<?php echo esc_html( $studyfield_tagline ); ?>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h2>
			<div class="mt-2 text-primary text-lg md:text-xl tracking-tight"><?php the_content(); ?></div>
				<ul class="flex flex-wrap study-field list-none">
					<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_degreesoffered[0] ) ) : ?>
						<li class="leading-normal text-lg px-2">
							<span class="border-b-[3px] border-blue">Degrees Offered</span>
							<span class="block font-heavy font-bold pt-2"><?php echo esc_html( $studyfield_degrees ); ?></span></li>
					<?php endif; ?>
					<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_majors[0] ) ) : ?>
						<li class="leading-normal text-lg px-2">
							<span class="border-b-[3px] border-blue">Major</span>
							<span class="block font-heavy font-bold pt-2"><?php echo esc_html( $studyfield_data->post_meta_fields->ecpt_majors[0] ); ?></span></li>
					<?php endif; ?>
					<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_minors[0] ) ) : ?>
						<li class="leading-normal text-lg px-2">
							<span class="border-b-[3px] border-blue">Minor</span>
							<span class="block font-heavy font-bold pt-2"><?php echo esc_html( $studyfield_data->post_meta_fields->ecpt_minors[0] ); ?></span></li>
					<?php endif; ?>
				</ul>
			</div>
	</div>
	<div class="hidden lg:block lg:w-5/12 front featured-image">
		<?php if ( have_rows( 'homepage_hero_images' ) ) : ?>
				<?php
				$random_images = get_field( 'homepage_hero_images' );
				shuffle( $random_images );
				$random_img_url = $random_images[0]['homepage_hero_image']['url'];
				$random_img_alt = $random_images[0]['homepage_hero_image']['alt'];
				?>
			<img class="!mt-0 h-56 w-full object-cover sm:h-72 lg:w-full lg:h-full" src="<?php echo esc_url( $random_img_url ); ?>" alt="<?php echo esc_url( $random_img_alt ); ?>" />
		<?php else : ?>
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class' => 'h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full',
				)
			);
			?>
		<?php endif; ?>
	</div>
</div>

<?php
if ( function_exists( 'get_field' ) && get_field( 'explore_the_department' ) ) :
	?>
	<div class="container">
	<?php
	if ( have_rows( 'explore_the_department' ) ) :
		?>
		<?php $heading = get_field( 'buckets_heading' ); ?>
		<!--Print Heading if there-->
		<?php if ( $heading ) : ?>
			<div class="px-8 mt-24 mb-4">
				<header aria-label="<?php the_field( 'buckets_heading' ); ?>">
					<h2 class="!my-0  mx-auto"><?php echo esc_html( $heading ); ?></h2>
				</header>
			</div>
		<?php endif; ?>
		<div class="mx-auto grid grid-cols-1 lg:grid-cols-3 px-4 justify-items-center">
		<?php
		while ( have_rows( 'explore_the_department' ) ) :
			the_row();
			?>
			<div class="relative bucket-<?php echo get_row_index(); ?>" aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
				<?php
				$image = get_sub_field( 'explore_bucket_image' );
				if ( get_sub_field( 'explore_bucket_image' ) ) :
					?>
					<?php echo wp_get_attachment_image( $image['ID'], 'full', false, array( 'class' => '!my-0 w-half lg:w-full h-auto lg:h-56 object-cover' ) ); ?>
				<?php endif; ?>
				<div class="p-8 bucket-text">
					<h3 class="!mt-4 !text-3xl">
					<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>">
						<?php the_sub_field( 'explore_bucket_heading' ); ?>
						</a>
					</h3>
					<p class="text-xl leading-tight"><?php the_sub_field( 'explore_bucket_text' ); ?></p>
				</div>
			</div>
		<?php endwhile; ?>
		<?php if ( is_active_sidebar( 'explore-featured' ) ) : ?>
			<?php get_template_part( 'template-parts/explore-featured-widgets' ); ?>
		<?php endif; ?>
		</div>
	<?php endif; ?>
	</div>
<?php endif; ?>
