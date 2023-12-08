<?php
/**
 * Template Name: No Featured Image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>
	<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php get_sidebar(); ?>
<?php
get_footer();

