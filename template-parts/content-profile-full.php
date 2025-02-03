<?php
/**
 * Template part for displaying profile content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header pl-4 pr-2 xl:pl-0 xl:pr-0">
		<?php the_title( '<h1 class="entry-title py-8">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content flex flex-wrap flex-col md:flex-row pl-4 pr-2 lg:pr-12 xl:pl-0 xl:pr-0">
		<div class="flex-initial">
		<?php
			the_post_thumbnail(
				'large',
				array(
					'class' => 'max-w-sm mr-6',
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
