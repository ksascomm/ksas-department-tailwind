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
		if ( ! empty( $studyfield_data->post_meta_fields->ecpt_headline[0] ) ) {
			$studyfield_tagline = $studyfield_data->post_meta_fields->ecpt_headline[0];
		}
		if ( ! empty( $studyfield_data->post_meta_fields->ecpt_degreesoffered[0] ) ) {
			$studyfield_degrees = $studyfield_data->post_meta_fields->ecpt_degreesoffered[0];
		}
		if ( ! empty( $studyfield_data->post_meta_fields->ecpt_majors[0] ) ) {
			$studyfield_majors = $studyfield_data->post_meta_fields->ecpt_majors[0];
		}
		if ( ! empty( $studyfield_data->post_meta_fields->ecpt_minors[0] ) ) {
			$studyfield_minors = $studyfield_data->post_meta_fields->ecpt_minors[0];
		}
	endforeach;
	?>
<?php endif; ?>

<div class="flex hero bg-grey-lightest front-featured-image-area h-auto md:h-[28rem] lg:h-[30rem]">
	<div class="flex items-center px-8 pb-4 text-left md:px-12 md:py-0 lg:w-7/12">
		<div>
			<h2 class="mt-8 text-2xl font-bold text-primary md:text-3xl lg:text-4xl lg:mt-0 font-heavy">
				<?php if ( ! empty( $studyfield_tagline ) ) : ?>
					<?php echo esc_html( $studyfield_tagline ); ?>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h2>
			<div class="mt-2 text-primary text-lg md:text-xl tracking-tight leading-[1.5] backdrop-blur-md">
				<?php the_content(); ?>
			</div>
			<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_degreesoffered[0] ) || ! empty( $studyfield_data->post_meta_fields->ecpt_majors[0] ) || ! empty( $studyfield_data->post_meta_fields->ecpt_minors[0] ) ) : ?>
				<ul class="flex flex-wrap study-field list-none pl-0!">
				<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_degreesoffered[0] ) ) : ?>
					<li class="relative inline-block px-2 my-2 text-base leading-tight bg-white xl:text-lg">
						<span class="">Degrees Offered</span>
						<span class="block font-bold font-heavy"><?php echo esc_html( $studyfield_degrees ); ?></span>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_majors[0] ) ) : ?>
					<li class="relative inline-block px-2 my-2 text-base leading-tight bg-white xl:text-lg">
						<span class="">Major</span>
						<span class="block font-bold font-heavy"><?php echo esc_html( $studyfield_data->post_meta_fields->ecpt_majors[0] ); ?></span>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_minors[0] ) ) : ?>
					<li class="relative inline-block px-2 my-2 text-base leading-tight bg-white xl:text-lg">
						<span class="">Minor</span>
						<span class="block font-bold font-heavy"><?php echo esc_html( $studyfield_data->post_meta_fields->ecpt_minors[0] ); ?></span>
					</li>
				<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="hidden lg:block lg:w-5/12 front featured-image">
		<?php if ( have_rows( 'homepage_hero_images' ) ) : ?>
			<?php
			$random_images = get_field( 'homepage_hero_images' );
			shuffle( $random_images );
			// print("<pre>".print_r($random_images,true)."</pre>");
			$random_img_url   = $random_images[0]['homepage_hero_image']['url'];
			$random_img_alt   = $random_images[0]['homepage_hero_image']['alt'];
			$random_img_title = $random_images[0]['homepage_hero_image']['title'];
			?>
			<img class="mt-0! h-56 w-full object-cover sm:h-72 lg:w-full lg:h-full slide-<?php echo esc_html( $random_img_title ); ?>" src="<?php echo esc_url( $random_img_url ); ?>" alt="<?php echo esc_html( $random_img_alt ); ?>" />
		<?php else : ?>
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class' => 'mt-0! h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full',
				)
			);
			?>
		<?php endif; ?>
	</div>
</div>

<?php if ( is_active_sidebar( 'above-explore' ) ) : ?>
	<?php
	get_template_part( 'template-parts/widgets-above-explore' );
	wp_reset_query();
	?>
<?php endif; ?>


<?php
if ( function_exists( 'get_field' ) && get_field( 'explore_the_department' ) ) :
	?>
	
	<div class="container pt-6 section-inner">
	<?php
	if ( have_rows( 'explore_the_department' ) ) :
		$count = count( get_field( 'explore_the_department' ) );
		?>
		<?php $heading = get_field( 'buckets_heading' ); ?>
		<!--Print Heading if there-->
		<?php if ( $heading ) : ?>
			<div class="px-4 mb-8 mt-14">
				<h2 class="my-0! mx-auto font-bold font-heavy"><?php echo esc_html( $heading ); ?></h2>
			</div>
		<?php endif; ?>
		<!--Show Columns Dynamically-->
		<?php if ( $count == 2 ) : ?>
			<div class="grid grid-cols-1 gap-4 px-4 mx-auto xl:grid-cols-3 justify-items-center">
		<?php elseif ( $count >= 3 ) : ?>
			<div class="grid grid-cols-1 gap-4 px-4 mx-auto xl:grid-cols-3 justify-items-center">
		<?php endif; ?>
		<?php
		while ( have_rows( 'explore_the_department' ) ) :
			the_row();
			?>
			<?php
			// If there's an image for the bucket, do CSS magic.
			if ( get_sub_field( 'explore_bucket_image' ) ) :
				?>
					
			<div class="bucket not-prose w-auto mt-4 bucket-<?php echo get_row_index(); ?>">
				<?php
				$image = get_sub_field( 'explore_bucket_image' );
				if ( get_sub_field( 'explore_bucket_image' ) ) :
					?>
					<?php echo wp_get_attachment_image( $image['ID'], 'full', false, array( 'class' => 'w-full' ) ); ?>
				<?php endif; ?>
				<div class="p-6 bucket-text">
					<h3 class="mb-4 text-2xl font-bold 2xl:text-3xl not-prose font-heavy">
					<?php if ( get_sub_field( 'explore_bucket_link' ) ) : ?>
						<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>">
							<?php the_sub_field( 'explore_bucket_heading' ); ?>
						</a>
						<?php else : ?>
							<?php the_sub_field( 'explore_bucket_heading' ); ?>
						<?php endif; ?>
					</h3>
					<p class="text-lg 2xl:text-xl leading-[1.5] tracking-wide font-normal mx-0"><?php the_sub_field( 'explore_bucket_text' ); ?></p>
				</div>
			</div>
				<?php
				// Otherwise, display content in a card.
			else :
				?>
				<div class="group p-2 plain-bucket-<?php echo get_row_index(); ?>">
					<div class="h-full px-6 py-4 mb-4 overflow-hidden border-2 rounded-lg shadow-xs field bg-grey-lightest grey-card-outline border-grey">
						<h3 class="text-2xl 2xl:text-3xl not-prose font-heavy font-bold mt-0!">
							<?php if ( get_sub_field( 'explore_bucket_link' ) ) : ?>
							<a class="text-blue hover:text-primary" href="<?php the_sub_field( 'explore_bucket_link' ); ?>">
								<?php
								$image = get_sub_field( 'explore_bucket_icon' );
								if ( get_sub_field( 'explore_bucket_icon' ) ) :
									?>
									<?php echo wp_get_attachment_image( $image['ID'], 'full', false, array( 'class' => 'bucket-icon group-hover:scale-110' ) ); ?>
								<?php endif; ?>
								<?php the_sub_field( 'explore_bucket_heading' ); ?>
							</a>
							<?php else : ?>
								<?php the_sub_field( 'explore_bucket_heading' ); ?>
							<?php endif; ?>
						</h3>
						<p class="text-lg 2xl:text-xl leading-[1.5] tracking-wide font-normal mb-0!"><?php the_sub_field( 'explore_bucket_text' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
	</div>
<?php endif; ?>
