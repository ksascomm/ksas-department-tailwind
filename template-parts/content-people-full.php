<?php
/**
 * Template part for displaying People CPT with 'ecpt_bio' in
 * people-direcory.php and single-people.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'people pl-4 lg:pl-0' ); ?>>
	<div class="alignfull lg:bg-grey-cool lg:bg-opacity-50">
		<div class="flex flex-wrap justify-start container mx-auto contact-info">
		<?php
		if ( has_post_thumbnail() ) :
			?>
			<div class="w-full lg:w-1/4 py-10 pr-10">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class' => 'sm:max-w-xs md:max-w-sm lg:max-w-full',
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
			?>
			</div>
			<?php
			endif;
		?>
			<div class="w-full lg:w-3/4 py-8">
			<?php if ( !get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
				<?php
				if ( function_exists( 'bcn_display' ) ) :
					?>
						<div class="breadcrumbs bg-white mb-4" typeof="BreadcrumbList" vocab="https://schema.org/">
							<?php bcn_display(); ?>
					</div>
					<?php endif; ?>
				<?php endif;?>
				<header class="entry-header">
					<h1 class="tracking-tight leading-10 sm:leading-none pt-2 pb-4">
						<?php the_title(); ?> 
						<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
							<small class="font-heavy">(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
						<?php endif; ?>
					</h1>
				</header>
			<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
				<div class="position"><h2 class="pr-2"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></h2></div>
			<?php endif; ?>
			<h3 class="sr-only">Contact Information</h3>

			<ul>
			<?php
			if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
				$email = get_post_meta( $post->ID, 'ecpt_email', true );
				?>
					<li><span class="fa-solid fa-envelope" aria-hidden="true"></span>
						<a href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>">
					<?php echo esc_html( $email ); ?>
						</a>
					</li>
				<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_leave', true ) ) : ?>
				<li><span class="fa-solid fa-calendar-circle-exclamation" aria-hidden="true"></span> <strong>On Leave: <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_leave', true ) ); ?></strong></li>
			<?php endif; ?>
			<?php if ( get_field( 'ecpt_cv' ) ) : ?>
				<li><span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a href="<?php echo wp_kses_post( the_field( 'ecpt_cv' ) ); ?>">Curriculum Vitae</a></li>
				<?php endif; ?>
				<?php
				$file = get_field( 'cv_file' );
				if ( $file ) :
					?>
				<li><span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a href="<?php echo esc_url( $file['url'] ); ?>">Curriculum Vitae</a></li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
					<li><span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?></li>
				<?php endif; ?>
				<!-- Do not display Office Hours if Person is On Leave -->
				<?php
				if ( empty( get_post_meta( $post->ID, 'ecpt_leave', true ) ) ) :
					?>
					<?php if ( get_post_meta( $post->ID, 'ecpt_hours', true ) ) : ?>
						<li><span class="fa-solid fa-door-open" aria-hidden="true"></span> 
						<?php if ( get_post_meta( $post->ID, 'ecpt_hours_link', true ) ) : ?>
							<a href="<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours_link', true ) ); ?>">
								<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours', true ) ); ?>
							</a>
						<?php else : ?>
							<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours', true ) ); ?>
						<?php endif; ?>
						</li>
					<?php endif; ?>
				<?php endif; ?>
				<!-- End On Leave Conditional -->

			<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
				<li><span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
				<li><span class="fa-solid fa-earth-americas" aria-hidden="true"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>">Personal Website</a></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
				<li><span class="fa-solid fa-earth-americas"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_google_id', true ) ) : ?>
				<li><span class="fa-brands fa-google"></span> <a href="https://scholar.google.com/citations?user=<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_google_id', true ) ); ?>">Google Scholar Profile</a></li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_twitter', true ) ) : ?>
				<li><span class="fa-brands fa-x-twitter"></span> <a href="https://twitter.com/<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?>"> @<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?></a></li>
			<?php endif; ?>

			</ul>

			<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
				<p class="leading-normal pr-2 text-xl"><strong>Research Interests:&nbsp;</strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?></p>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
				<p class="leading-normal pr-2 text-xl"><strong>Education:&nbsp;</strong><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_degrees', true ) ); ?></p>
			<?php endif; ?>
			</div>
			</div>
		</div>
	</div>


<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
<?php
if ( function_exists( 'bcn_display' ) ) :
	?>
		<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			<?php bcn_display(); ?>
	</div>
	<?php endif; ?>
<?php endif;?>
	<?php
	if ( is_singular( 'people' ) ) :
		?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
		<div class="tabbed my-4 people-content">
			<ul class="pr-6 lg:pr-0">
			<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
				<li>
				<a href="#section1">Biography</a>
				</li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
				<li>
				<a href="#section2">Research</a>
				</li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
				<li>
				<a href="#section3">Teaching</a>
				</li>
				<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
				<li>
				<a href="#section4">Publications</a>
				</li>
			<?php endif; ?>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) :
					?>
				<li>
				<a href="#section5">Faculty Books</a>
				</li>
							<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ) : ?>
				<li><a href="#section6"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ); ?></a></li>
				<?php endif; ?>
					<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ) : ?>
				<li><a href="#section7"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ); ?></a></li>
				<?php endif; ?>
			</ul>
			<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
			<section class="section-content" id="section1">
					<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_bio', true ) ); ?>
			</section>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
			<section class="section-content" id="section2">
					<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_research', true ) ); ?>
			</section>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
			<section class="section-content" id="section3">
					<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_teaching', true ) ); ?>
			</section>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
			<section class="section-content" id="section4">
					<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_publications', true ) ); ?>
			</section>
			<?php endif; ?>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) :
					?>
			<section class="section-content" id="section5">
					<?php get_template_part( 'template-parts/content', 'faculty-books-people-cpt' ); ?>
			</section>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) : ?>
			<section class="section-content" id="section6">
					<?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) ); ?>
			</section>
			<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) : ?>
			<section class="section-content" id="section7">
					<?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) ); ?>
			</section>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	<?php endif; ?>
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
</article><!-- #post-<?php the_ID(); ?> -->
