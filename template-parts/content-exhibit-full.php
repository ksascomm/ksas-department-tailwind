<?php
/**
 * Template part for displaying singular Exhibits posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header pl-4 pr-2 xl:pl-0 xl:pr-0">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content pl-4 pr-2 lg:pr-12 xl:pl-0 xl:pr-0 xl:max-w-[85ch]">
		<ul class="exhibit-meta list-none! pl-0!">
			<?php if ( get_post_meta( $post->ID, 'ecpt_location', true ) ) : ?>
				<li class="pl-0!"><strong>Location:</strong> <?php echo get_post_meta( $post->ID, 'ecpt_location', true ); ?></li>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_dates', true ) ) : ?>
				<li class="pl-0!"><strong>Dates:</strong> <?php echo get_post_meta( $post->ID, 'ecpt_dates', true ); ?></li>
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

		?>
	<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'large',
				array(
					'class' => 'max-w-(--breakpoint-lg)',
				)
			);
		endif
			?>	
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
