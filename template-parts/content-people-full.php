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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'people py-4 ml-4' ); ?>>
	<div class="flex flex-wrap lg:flex-nowrap">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="pr-4 flex-none headshot">
				<?php
					the_post_thumbnail(
						'full',
						array(
							'class' => '',
							'alt'   => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</div>
		<?php endif; ?>
		<div class="flex-grow contact-info">
			<h2 class="font-heavy">
			<?php if ( is_singular( 'people' ) ) : ?> 
				<?php the_title(); ?> 
				<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
					<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
				<?php endif; ?>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>'s webpage">
					<?php the_title(); ?>
				</a>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
					<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
				<?php endif; ?>
			<?php endif; ?>
			</h2>

			<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
				<div class="position"><p class="leading-normal pr-2"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></p></div>
			<?php endif; ?>

			<h3 class="sr-only">Contact Information</h3>

			<ul>
			<?php
			if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
				$email = get_post_meta( $post->ID, 'ecpt_email', true );
				?>
				<li><span class="fa-solid fa-at" aria-hidden="true"></span>
				<?php if ( function_exists( 'email_munge' ) ) : ?>
					<a class="munge" href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;<?php echo email_munge( $email ); ?>">
						<?php echo email_munge( $email ); ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
				<?php endif; ?>
				</li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_leave', true ) ) : ?>
				<li><span class="fa-solid fa-calendar-circle-exclamation" aria-hidden="true"></span> <strong>On Leave: <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_leave', true ) ); ?></strong></li>
			<?php endif; ?>
			<?php if ( get_field( 'ecpt_cv' ) ) : ?>
				<li><span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a href="<?php the_field( 'ecpt_cv' ); ?>">Curriculum Vitae</a></li>
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

			<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
				<li><span class="fa-solid fa-earth-americas"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" target="_blank" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'ecpt_google_id', true ) ) : ?>
				<li><span class="fa-brands fa-google"></span> <a href="https://scholar.google.com/citations?user=<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_google_id', true ) ); ?>" target="_blank">Google Scholar Profile</a></li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_twitter', true ) ) : ?>
				<li><span class="fa-brands fa-twitter"></span> <a href="https://twitter.com/<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?>" target="_blank"> @<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?></a></li>
			<?php endif; ?>

			</ul>

			<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
				<p class="leading-normal pr-2"><strong>Research Interests:&nbsp;</strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?></p>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
				<p class="leading-normal pr-2"><strong>Education:&nbsp;</strong><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_degrees', true ) ); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( is_singular( 'people' ) ) : ?>
		<div class="lg:mr-20 accordion">
		<ul aria-label="Accordion Control Group Buttons" class="accordion-controls !list-none">
		<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-1" aria-expanded="false" id="accordion-control-1">
			Biography</button>
			<div aria-hidden="true" id="content-1" class="hidden px-5 py-2">
			<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_bio', true ) ); ?>
			</div>
		</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-2" aria-expanded="false" id="accordion-control-1">Research</button>
			<div aria-hidden="true" id="content-2" class="hidden px-5 py-2">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_research', true ) ); ?>
			</div>
			</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-3" aria-expanded="false" id="accordion-control-3">Teaching</button>
			<div aria-hidden="true" id="content-3" class="hidden px-5 py-2">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_teaching', true ) ); ?>
				</div>
			</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-4" aria-expanded="false" id="accordion-control-4">Publications</button>
			<div aria-hidden="true" id="content-4" class="hidden px-5 py-2">
			<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_publications', true ) ); ?>
			</div>
			</li>
		<?php endif; ?>
		<?php
		if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) :
			?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-5" aria-expanded="false" id="accordion-control-5">Faculty Books</button>
			<div aria-hidden="true" id="content-5" class="hidden px-5 py-2">
			<?php get_template_part( 'template-parts/content', 'faculty-books-people-cpt' ); ?>
			</div>
			</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ) : ?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-6" aria-expanded="false" id="accordion-control-6"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ); ?></button>
			<div aria-hidden="true" id="content-6" class="hidden px-5 py-2">
			<?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) ); ?>
			</div>
			</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ) : ?>
			<li class="border border-solid border-grey">
			<button class="text-left w-full block p-5 leading-normal cursor-pointer font-semi font-semibold " aria-controls="content-7" aria-expanded="false" id="accordion-control-7"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ); ?></button>
			<div aria-hidden="true" id="content-7" class="hidden px-5 py-2">
			<?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) ); ?>
			</div>
			</li>
		<?php endif; ?>
		</ul>
		</div>
	<?php endif; ?>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="sr-only">%s</span>', 'ksas-blocks' ),
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
