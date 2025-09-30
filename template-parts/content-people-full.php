<?php
/**
 * Template part for displaying People CPT with 'ecpt_bio' in
 * people-direcory.php and single-people.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>
<?php
global $post;
$bio = get_post_meta( $post->ID, 'ecpt_bio', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'people pl-4 lg:pl-0 pb-8' ); ?>>
	<div class="alignfull mt-0! 
	<?php if ( ! empty( $bio ) ) : ?>
		md:bg-grey-lightest
	<?php endif; ?>">
		<div class="container flex flex-wrap justify-start lg:mx-auto contact-info">
		<?php
		if ( has_post_thumbnail() ) :
			?>
			<div class="w-full py-6 lg:py-10 lg:pr-10 md:w-1/2 lg:w-1/4">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class' => 'w-2xs sm:w-xs md:max-w-sm lg:max-w-full',
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
			<div class="w-full md:py-8 md:w-1/2 lg:w-3/4">
			<?php if ( ! get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
				<?php
				if ( function_exists( 'bcn_display' ) ) :
					?>
						<div class="mb-4 bg-white breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
							<?php bcn_display(); ?>
					</div>
					<?php endif; ?>
				<?php endif; ?>
				<header class="pl-0 pr-2 entry-header">
					<h1 class="tracking-tight leading-10 sm:leading-none pt-2 pb-4 mb-0! ">
						<?php the_title(); ?> 
						<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
							<small class="font-heavy">(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
						<?php endif; ?>
					</h1>
				</header>
				<div class="position not-prose">
					<h2 class="pr-2 my-4 font-sans text-2xl font-normal leading-normal">
					<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
						<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?>
					<?php else : ?>
						<span class="capitalize"><?php echo wp_strip_all_tags( get_the_term_list( $post->ID, 'role', '', ', ' ) ); ?></span>
					<?php endif; ?>	
					</h2>
				</div>
			
			<h3 class="sr-only">Contact Information</h3>

			<ul class="not-prose">
			<?php
			if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
				$email = get_post_meta( $post->ID, 'ecpt_email', true );
				?>
					<li class="text-xl"><span class="fa-solid fa-envelope" aria-hidden="true"></span>
						<a class="text-blue hover:text-primary" href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>">
					<?php echo esc_html( $email ); ?>
						</a>
					</li>
				<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_leave', true ) ) : ?>
				<li class="text-xl"><span class="fa-solid fa-calendar-circle-exclamation" aria-hidden="true"></span> <strong class="font-heavy">On Leave: <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_leave', true ) ); ?></strong></li>
			<?php endif; ?>
			<?php if ( get_field( 'ecpt_cv' ) ) : ?>
				<li class="text-xl"><span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a class="text-blue hover:text-primary" href="<?php echo wp_kses_post( the_field( 'ecpt_cv' ) ); ?>">Curriculum Vitae</a></li>
				<?php endif; ?>
				<?php
				$file = get_field( 'cv_file' );
				if ( $file ) :
					?>
				<li class="text-xl"><span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a class="text-blue hover:text-primary" href="<?php echo esc_url( $file['url'] ); ?>">Curriculum Vitae</a></li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
					<li class="text-xl"><span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?></li>
				<?php endif; ?>
				<!-- Do not display Office Hours if Person is On Leave -->
				<?php
				if ( empty( get_post_meta( $post->ID, 'ecpt_leave', true ) ) ) :
					?>
					<?php if ( get_post_meta( $post->ID, 'ecpt_hours', true ) ) : ?>
						<li class="text-xl"><span class="fa-solid fa-door-open" aria-hidden="true"></span> 
						<?php if ( get_post_meta( $post->ID, 'ecpt_hours_link', true ) ) : ?>
							<a class="text-blue hover:text-primary" href="<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours_link', true ) ); ?>">
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
				<li class="text-xl"><span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
				<li class="text-xl"><span class="fa-solid fa-earth-americas" aria-hidden="true"></span> <a class="text-blue hover:text-primary" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>">Personal Website</a></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
				<li class="text-xl"><span class="fa-solid fa-earth-americas"></span> <a class="text-blue hover:text-primary" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_google_id', true ) ) : ?>
				<li class="text-xl"><span class="fa-brands fa-google"></span> <a class="text-blue hover:text-primary" href="https://scholar.google.com/citations?user=<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_google_id', true ) ); ?>">Google Scholar Profile</a></li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_twitter', true ) ) : ?>
				<li class="text-xl"><span class="fa-solid fa-circle-user"></span> <a class="text-blue hover:text-primary" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?>"> Follow Me on Social Media</a></li>
			<?php endif; ?>

			</ul>

			<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
				<p class="leading-normal pr-2 text-xl my-3!"><strong>Research Interests:&nbsp;</strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?></p>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
				<p class="leading-normal pr-2 text-xl my-3!"><strong>Education:&nbsp;</strong><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_degrees', true ) ); ?></p>
			<?php endif; ?>
			</div>
			</div>
		</div>
	</div>


<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
	<?php
	if ( function_exists( 'bcn_display' ) ) :
		?>
		<div class="ml-4 wayfinding md:mb-8 2xl:ml-6">
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
	<?php
	if ( is_singular( 'people' ) ) :
		?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
		<div class="my-4 ml-4 2xl:ml-6 tabbed people-content">
			<ul class="pr-6 lg:pr-0 section-headings">
			<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
				<li class="text-xl">
				<a href="#section1">Biography</a>
				</li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
				<li class="text-xl">
				<a href="#section2">Research</a>
				</li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
				<li class="text-xl">
				<a href="#section3">Teaching</a>
				</li>
				<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
				<li class="text-xl">
				<a href="#section4">Publications</a>
				</li>
			<?php endif; ?>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) :
					?>
				<li class="text-xl">
				<a href="#section5">Faculty Books</a>
				</li>
							<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ) : ?>
				<li class="text-xl"><a href="#section6"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ); ?></a></li>
				<?php endif; ?>
					<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ) : ?>
				<li class="text-xl"><a href="#section7"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ); ?></a></li>
				<?php endif; ?>
			</ul>
			<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
			<div class="section-content" id="section1">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_bio', true ) ); ?>
			</div>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
			<div class="section-content" id="section2">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_research', true ) ); ?>
			</div>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
			<div class="section-content" id="section3">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_teaching', true ) ); ?>
			</div>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
			<div class="section-content" id="section4">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_publications', true ) ); ?>
			</div>
			<?php endif; ?>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) :
					?>
			<div class="section-content" id="section5">
				<?php get_template_part( 'template-parts/content', 'faculty-books-people-cpt' ); ?>
			</div>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) : ?>
			<div class="section-content" id="section6">
				<?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) ); ?>
			</div>
			<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) : ?>
			<div class="section-content" id="section7">
				<?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) ); ?>
			</div>
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
						__( 'Edit <span class="sr-only">%s</span>', 'ksas-dept-tailwind' ),
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
