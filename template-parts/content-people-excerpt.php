<?php
/**
 * Template part for displaying People CPT without 'ecpt_bio' in people-direcory.php
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
					'medium',
					array(
						'alt' => the_title_attribute(
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
		<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
			<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" title="<?php the_title(); ?>'s webpage" target="_blank">
				<?php the_title(); ?>
			</a>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
				<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
			<?php endif; ?>
		<?php else : ?>
			<?php the_title(); ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
					<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
				<?php endif; ?>
		<?php endif; ?>
		</h2>

		<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
				<div class="position"><p class="leading-normal pr-2"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></p></div>
			<?php endif; ?>

			<h3 class="sr-only">Contact Information</h3>

			<ul role="list">
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
				<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
					<li><span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?></li>
				<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
					<li><span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?></li>
				<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
				<li><span class="fa-solid fa-earth-americas"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" onclick="ga('send', 'event', 'People Directory', 'Group/Lab Website', '<?php the_title(); ?> | <?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>')" target="_blank" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
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
