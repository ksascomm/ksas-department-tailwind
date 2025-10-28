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
				'page-templates/people-directory-rows.php',
				'page-templates/people-directory-select.php',
				'../templates/courses-undergrad-ksasblocks.php',
			)
		) ) :
		?>
		<div class="alignfull mt-0!" role="banner">
			<div class="flex h-auto bg-white lg:bg-grey-lightest front-featured-image-area lg:h-40">
				<div class="container flex px-6 section-inner xl:pl-0 lg:items-center xl:ml-12" style="max-width:123ch">
					<h1 class="tracking-tight leading-10 sm:leading-none lg:text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-8 mb-0!">
						<?php the_title(); ?>
					</h1>
				</div>
			</div>
		</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/featured-image' ); ?>
	<?php endif; ?>
	
	<div class="ml-8 wayfinding md:mb-8 xl:pl-0 2xl:ml-0">
		<?php get_template_part( 'template-parts/sidebar-menu' ); ?>
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="pl-8 pr-4 entry-content lg:pr-12 2xl:pr-0">
	<?php
	if (
		is_page_template(
			array(
				'page-templates/people-directory-rows.php',
				'page-templates/people-directory-select.php',
			)
		) ) :
		?>
		 
		<div class="sr-only">
			Use the filters and search box to explore our people directory.
		</div>
	<?php endif; ?>
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="sr-only">%s</span>', 'ksas-dept-tailwind' ),
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
