<?php
/**
 * Template part for displaying People CPT content in people-direcory-sort.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

?>


<article id="post-<?php the_ID(); ?>" class="people item p-4 md:px-0 md:py-4 my-2 md:my-0 md:ml-4 w-full <?php echo esc_html( get_the_roles( $post ) ); ?> <?php echo esc_html( get_the_filters( $post ) ); ?> border-grey border-solid border md:border-none">

<div class="flex flex-wrap lg:flex-nowrap">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="hidden md:block pr-4 flex-none headshot my-4 mr-4 ml-0 lg:relative lg:inline-block">
			<?php
				the_post_thumbnail(
					'directory',
					array(
						'class' => ' translate-x-1',
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
		<h2 class="font-heavy !text-2xl">
		<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>'s webpage">
				<?php the_title(); ?>
			</a>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
				<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
			<?php endif; ?>
		<?php elseif ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
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
					<li><span class="fa-solid fa-envelope" aria-hidden="true"></span>
						<a href="<?php echo esc_url( 'mailto:' . antispambot( $email )); ?>">
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

</article><!-- #post-<?php the_ID(); ?> -->
