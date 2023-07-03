<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<!-- Put conditional here to print page title when no featured image -->
	<?php
	if (
		is_page_template(
			array(
				'page-templates/no-featured-image.php',
				'page-templates/faculty-books.php',
				'page-templates/people-directory-columns.php',
				'page-templates/people-directory-rows.php',
				'page-templates/people-directory-select.php',
				'../templates/courses-undergrad-ksasblocks.php',
			)
		) ) :
		?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title tracking-tight leading-10 sm:leading-none py-8">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php else : ?>
			<?php get_template_part( 'template-parts/featured-image' ); ?>
	<?php endif; ?>
	
	<div class="wayfinding md:mb-8 ml-4 xl:ml-0">
		<?php get_template_part( 'template-parts/sidebar-menu' ); ?>
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksas-department-tailwind' ),
				'after'  => '</div>',
			)
		);
		?>
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
