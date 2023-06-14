<?php
/**
 * Template part for displaying People post content in people-directory-columns.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

?>

<div class="people people-card item p-2 w-full lg:w-1/3 <?php echo esc_html( get_the_roles( $post ) ); ?> <?php echo esc_html( get_the_filters( $post ) ); ?>">
	<div class="h-full rounded-lg field mb-4 px-6 py-4 overflow-hidden bg-white research-project-card-outline">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php the_post_thumbnail( 'directory' ); ?>
		<?php } ?>
		<h2 class="font-heavy !text-2xl">
			<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
				<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" title="<?php the_title(); ?>'s webpage" target="_blank">
					<?php the_title(); ?>
				</a>
			<?php elseif ( get_post_meta( $post->ID, 'ecpt_bio', true ) || get_post_meta( $post->ID, 'ecpt_thesis', true ) ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>'s webpage">
				<?php the_title(); ?>
			</a>
		<?php else : ?>
			<?php the_title(); ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
					<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
				<?php endif; ?>
		<?php endif; ?>
		</h2>
		<ul class="!list-none">
		<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
			<li><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></li>
		<?php endif; ?>
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
		<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
			<li><strong>Research Interests:&nbsp;</strong>
			<?php
			echo esc_html( wp_trim_words( get_post_meta( $post->ID, 'ecpt_expertise', true ), 30, '[&hellip;]' ) );
			?>
			</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_thesis', true ) ) : ?>
			<li><strong>Thesis Title:</strong> "<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_thesis', true ) ); ?>"
			<?php if ( get_post_meta( $post->ID, 'ecpt_job_abstract', true ) ) : ?>
				&nbsp;- <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_job_abstract', true ) ); ?>">Download Abstract  <span class="fa-solid fa-file-pdf" aria-hidden="true"></span></a>
			<?php endif; ?>
			</li>
		<?php endif; ?>

		<?php if ( get_post_meta( $post->ID, 'ecpt_advisor', true ) ) : ?>
			<li><strong>Main Adviser: </strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_advisor', true ) ); ?></li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_fields', true ) ) : ?>
			<li><strong>Fields: </strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_fields', true ) ); ?></li>
		<?php endif; ?>
		</ul>
	</div>
</div>
