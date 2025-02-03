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
	<div class="flex">
		<div class="entry-content pl-4 pr-2 lg:pr-12 xl:pl-0 xl:pr-0">
			<h1 class="tracking-tight leading-10 sm:leading-none lg:text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-8">
				<?php the_title(); ?>
			</h1>
			<?php
			the_content();

			?>
		</div><!-- .entry-content -->
	<?php
$custom_sidebar_widget = get_field( 'custom_sidebar', false, false );
if ( is_active_sidebar( $custom_sidebar_widget ) ) :
	?>
	<aside id="secondary" class="sidebar xl:pl-4 widget-area w-full lg:w-1/4 mt-4 lg:mt-8">
		<?php dynamic_sidebar( $custom_sidebar_widget ); ?>
	</aside><!-- #secondary -->
<?php endif; ?>

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
