<?php
/**
 * The template for displaying all single People posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package KSAS_Blocks
 */

get_header();
?>

	<main id="site-content" class="site-main prose sm:prose md:prose-md lg:prose-lg mx-auto">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-people-full' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
