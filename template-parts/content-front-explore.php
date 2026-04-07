<?php
/**
 * Template part for displaying Explore Department widget & content in front-page.php
 *
 * @package KSAS_Department_Tailwind
 */

if ( is_active_sidebar( 'above-explore' ) ) :
	get_template_part( 'template-parts/widgets-above-explore' );
	wp_reset_postdata();
endif;

// Use a variable to avoid multiple get_field calls.
$explore_buckets = get_field( 'explore_the_department' );

if ( $explore_buckets ) :
	$section_heading      = get_field( 'buckets_heading' );
	$bucket_count         = count( $explore_buckets );
	// Dynamic grid classes: centered if 2, 3-column if more.
	$grid_class = ( 2 === $bucket_count ) ? 'md:grid-cols-2 lg:max-w-5xl' : 'md:grid-cols-2 xl:grid-cols-3';
	?>
	
	<div class="container pt-6 mx-auto section-inner">
		<?php if ( $section_heading ) : ?>
			<div class="px-4 mb-8 mt-14">
				<h2 class="my-0! mx-auto font-bold font-heavy text-3xl"><?php echo esc_html( $section_heading ); ?></h2>
			</div>
		<?php endif; ?>

		<div class="grid grid-cols-1 gap-6 px-4 mx-auto justify-items-center <?php echo esc_attr( $grid_class ); ?>">
		<?php
		if ( have_rows( 'explore_the_department' ) ) :
			while ( have_rows( 'explore_the_department' ) ) :
				the_row();
				// Pull sub-fields into variables for clean escaping.
				$b_img   = get_sub_field( 'explore_bucket_image' );
				$b_icon  = get_sub_field( 'explore_bucket_icon' );
				$b_link  = get_sub_field( 'explore_bucket_link' );
				$b_head  = get_sub_field( 'explore_bucket_heading' );
				$b_text  = get_sub_field( 'explore_bucket_text' );
				$b_index = get_row_index();
				?>
				<?php if ( $b_img ) : ?>
					<div class="w-full bucket-<?php echo (int) $b_index; ?>">
						<div class="h-full border shadow-sm bucket not-prose border-grey-light">
							<?php echo wp_get_attachment_image( $b_img['ID'], 'full', false, array( 'class' => 'w-full h-72 object-cover' ) ); ?>
							<div class="p-6 bucket-text">
								<h3 class="mb-4 text-2xl font-bold not-prose font-heavy 2xl:text-3xl">
									<?php
									if ( $b_link ) :
										?>
										<a href="<?php echo esc_url( $b_link ); ?>"><?php endif; ?>
										<?php echo esc_html( $b_head ); ?>
									<?php
									if ( $b_link ) :
										?>
										</a><?php endif; ?>
								</h3>
								<p class="mx-0 text-lg font-normal leading-normal 2xl:text-xl"><?php echo esc_html( $b_text ); ?></p>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="w-full h-full p-2 group plain-bucket-<?php echo (int) $b_index; ?>">
						<div class="h-full p-2 group">
							<div class="h-full px-6 py-8 transition-all border-2 rounded-lg shadow-xs bg-grey-lightest border-grey hover:border-primary">
								<h3 class="my-4 text-2xl font-bold not-prose font-heavy 2xl:text-3xl">
									<?php
									if ( $b_link ) :
										?>
										<a class="text-blue hover:text-primary border-b-grey!" href="<?php echo esc_url( $b_link ); ?>"><?php endif; ?>
										<?php if ( $b_icon ) : ?>
											<?php echo wp_get_attachment_image( $b_icon['ID'], 'thumbnail', false, array( 'class' => 'bucket-icon group-hover:scale-110 mb-2' ) ); ?>
										<?php endif; ?>
										<span class="block"><?php echo esc_html( $b_head ); ?></span>
									<?php
									if ( $b_link ) :
										?>
										</a><?php endif; ?>
								</h3>
								<p class="mx-0 text-lg font-normal leading-normal 2xl:text-xl"><?php echo esc_html( $b_text ); ?></p>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php
			endwhile;
		endif;
		?>
		</div>
	</div>
<?php endif; ?>