<?php
/**
 * Template part for displaying Research Highlight posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'large',
				array(
					'class' => 'max-w-sm',
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
		endif	
			?>
			<ul>
			<?php
					if ( get_post_meta( $post->ID, 'publication_name', true ) ) :
						?>
					<?php
					if ( get_post_meta( $post->ID, 'publication_link', true ) ) :
						?>
						<li>
							<a href="<?php echo esc_url( get_post_meta( $post->ID, 'publication_link', true ) ); ?>">
								<em><?php echo esc_html( get_post_meta( $post->ID, 'publication_name', true ) ); ?></em>, <?php echo esc_html( get_post_meta( $post->ID, 'publication_year', true ) ); ?>&nbsp;<i class="fa-sharp fa-solid fa-square-arrow-up-right"></i>
							</a>	
						</li>
					<?php else : ?>
						<li><em><?php echo esc_html( get_post_meta( $post->ID, 'publication_name', true ) ); ?></em>, <?php echo esc_html( get_post_meta( $post->ID, 'publication_year', true ) ); ?></li>
					<?php endif; ?>
				<?php endif; ?>
					<?php
					$faculty_post_id = get_post_meta( $post->ID, 'publication_author', true );
					if ( get_post_meta( $post->ID, 'publication_author', true ) ) :
						?>
						<li>
						<a href="<?php echo esc_html( get_the_permalink( $faculty_post_id ) ); ?>"><?php echo esc_html( get_the_title( $faculty_post_id ) ); ?></a>
						<?php if ( get_post_meta( $post->ID, 'publication_author_other', true ) ) : ?>
							and <?php echo esc_html( get_post_meta( $post->ID, 'publication_author_other', true ) ); ?>
						<?php endif; ?>
						</li>
					<?php endif; ?>
			</ul>
		</div>
	<?php
	if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="sr-only"> "%s"</span>', 'ksas-department-tailwind' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
		else :
			the_excerpt();
		endif;

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksas-department-tailwind' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
