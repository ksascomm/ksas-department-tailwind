<?php
/**
 * Template Name: Page With Sidebar Right
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>
<div class="flex flex-wrap p-1 sm:p-2 md:p-4">
	<main id="site-content" class="site-main prose sm:prose lg:prose-lgpage-with-sidebar w-full lg:w-3/4 mx-auto">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_sidebar();
	?>
</div>
<?php
get_footer();

