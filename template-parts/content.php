<?php
/**
 * Template part for displaying posts
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

		if ( get_post_type() === 'post') :
			?>
			<div class="entry-meta">
				<?php
				ksas_department_tailwind_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php elseif ( get_post_type() === 'bulletinboard'): ?>
			<ul class="entry-meta">
				<li>Posted: <?php the_time( 'F j, Y' ); ?></li>
				<?php if ( get_field( 'bulletin_deadline' ) ) : ?>
				<li>Deadline: <?php the_field( 'bulletin_deadline' ); ?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?><!-- .bulletin .entry-meta -->
	</header><!-- .entry-header -->

	<?php ksas_department_tailwind_post_thumbnail(); ?>

	<div class="entry-content">
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
