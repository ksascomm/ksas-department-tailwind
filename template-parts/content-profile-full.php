<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content flex flex-wrap flex-col md:flex-row">
		<div class="flex-initial">
		<?php
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
			?>
		</div>
		<div class="flex-1">
		<?php if ( have_rows( 'custom_profile_fields' ) ) : ?>
			<?php
			while ( have_rows( 'custom_profile_fields' ) ) :
				the_row();
				?>
			<h2 class="!text-2xl"><span class="custom-title"><?php the_sub_field( 'custom_title' ); ?></span>&nbsp;<span class="custom-content"><?php the_sub_field( 'custom_content' ); ?></span></h2>
			<?php endwhile; ?>
		<?php else : ?>
			<?php // No rows found! ?>
		<?php endif; ?>

		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksas-department-tailwind' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="sr-only">%s</span>', 'ksas-department-tailwind' ),
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
