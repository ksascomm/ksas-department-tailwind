<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>

	<main id="site-content" class="mx-auto prose site-main sm:prose lg:prose-lg">

		<?php if ( have_posts() ) : ?>

			<header class="px-12 py-6 prose page-header">
				<h1 class="entry-title font-semibold! font-semi!">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'ksas-dept-tailwind' ), '<span class="font-bold font-serifbold">' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			if ( function_exists( 'ksas_department_tailwind_pagination' ) ) :

				ksas_department_tailwind_pagination();

			else :

				the_posts_navigation();

			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
