<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>

	<main id="site-content" class="mx-auto prose site-main sm:prose lg:prose-lg">
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
		<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			<?php bcn_display(); ?>
		</div>
	<?php endif; ?>
		<?php if ( have_posts() ) : ?>

			<header class="py-6 prose page-header">
				<?php
				the_archive_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</header><!-- .page-header -->
			<div class="mt-8">
				<div class="grid grid-cols-1 gap-8 lg:max-w-6xl lg:grid-cols-3">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', 'faculty-books-cards' );

					endwhile;
					?>
				</div>
			</div>
			<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
