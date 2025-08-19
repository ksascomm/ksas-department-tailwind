<?php
/**
 * Template part for displaying People CPT content in people-direcory-sort.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>


<article id="post-<?php the_ID(); ?>" class="people item p-4 lg:px-0 lg:py-4 my-2 lg:my-0 lg:ml-4 w-11/12 lg:w-full <?php echo esc_html( get_the_roles( $post ) ); ?> <?php echo esc_html( get_the_filters( $post ) ); ?> border-grey border-solid border lg:border-none">

<div class="flex flex-wrap lg:flex-nowrap">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="flex-none hidden pl-4 md:block lg:pl-0 lg:pr-4 headshot lg:my-4 lg:mr-4 lg:ml-0 lg:relative lg:inline-block">
			<?php
				the_post_thumbnail(
					'directory',
					array(
						'class' => 'translate-x-1 my-0!',
						'alt'   => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			?>
		</div>
	<div class="break"></div> <!-- break -->
	<?php endif; ?>
	<div class="px-4 grow contact-info lg:px-0">
		<h3 class="font-heavy font-bold text-2xl!">
		<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
			<a class="hover:text-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>'s webpage">
				<?php the_title(); ?>
			</a>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
				<span class="text-lg">(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</span>
			<?php endif; ?>
		<?php elseif ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
			<a class="hover:text-primary" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" title="<?php the_title(); ?>'s webpage" target="_blank">
				<?php the_title(); ?>
			</a>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
				<span class="text-lg">(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</span>
			<?php endif; ?>
		<?php else : ?>
			<?php the_title(); ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
					<span class="text-lg">(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</span>
				<?php endif; ?>
		<?php endif; ?>
		</h3>
		<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
			<div class="position"><p class="leading-normal pr-2 text-xl my-3!"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></p></div>
		<?php endif; ?>

			<h4 class="sr-only">Contact Information</h4>

			<ul class="not-prose" role="list">
			<?php
			if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
				$email = get_post_meta( $post->ID, 'ecpt_email', true );
				?>
					<li><span class="fa-solid fa-envelope" aria-hidden="true"></span>
						<a class="text-blue hover:text-primary" href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>">
						<?php echo esc_html( $email ); ?>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
					<li><span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?></li>
				<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
					<li><span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?></li>
				<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
				<li><span class="fa-solid fa-earth-americas"></span> <a class="hover:text-primary" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" target="_blank" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
				<?php endif; ?>

			</ul>

			<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
				<p class="pr-2 my-3 leading-normal"><strong>Research Interests:&nbsp;</strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?></p>
			<?php endif; ?>
			<?php
			if ( is_object_in_term( $post->ID, 'role', 'carnegie faculty' ) ) :
				?>
				<div class="training-faculty-note">
					<?php echo '<span class="fa-regular fa-circle-exclamation"></span> ' . term_description( '86', 'role' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
				<p class="pr-2 my-3 leading-normal"><strong>Education:&nbsp;</strong><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_degrees', true ) ); ?></p>
			<?php endif; ?>
	</div>
</div>
	<?php if ( get_edit_post_link() ) : ?>
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
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
