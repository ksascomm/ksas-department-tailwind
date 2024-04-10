<?php
/**
 * Template part for displaying Exhibits posts
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
		endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<ul class="exhibit-meta">
			<?php if ( get_post_meta( $post->ID, 'ecpt_location', true ) ) : ?>
				<li><strong>Location:</strong> <?php echo get_post_meta( $post->ID, 'ecpt_location', true ); ?></li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_dates', true ) ) : ?>
				<li><strong>Dates:</strong> <?php echo get_post_meta( $post->ID, 'ecpt_dates', true ); ?></li>
			<?php endif; ?>
		</ul>
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
	<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'large',
				array(
					'class' => 'max-w-screen-lg',
				)
			);
		endif
			?>	
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
