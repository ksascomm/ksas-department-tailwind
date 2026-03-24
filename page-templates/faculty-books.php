<?php
/**
 * Template Name: Faculty Books
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>

<?php
// Set Faculty Books Query Parameters.
$faculty_books_query = new WP_Query(
	array(
		'post_type'      => 'faculty-books',
		'posts_per_page' => 100,
		'meta_query'     => array(
			'relation'          => 'OR',
			'book_year_exists'  => array(
				'key'     => 'ecpt_pub_date',
				'compare' => 'EXISTS',
			),
			'book_year_missing' => array(
				'key'     => 'ecpt_pub_date',
				'compare' => 'NOT EXISTS',
			),
		),
		'orderby'        => array(
			'book_year_exists' => 'DESC', // Sort by year newest to oldest.
			'title'            => 'ASC',  // Secondary sort by title A-Z.
		),
	)
);
?>

<main id="site-content" class="pb-2 mx-auto prose site-main sm:prose lg:prose-lg">

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

endwhile; // End of the loop.
?>

<?php
if ( $faculty_books_query->have_posts() ) :
	?>
	<div class="mt-8">
		<div class="grid grid-cols-1 gap-8 lg:max-w-6xl lg:grid-cols-3">
		<?php
		while ( $faculty_books_query->have_posts() ) :
			$faculty_books_query->the_post();
			?>
			<?php get_template_part( 'template-parts/content', 'faculty-books-cards' ); ?>
				<?php
				endwhile;
		?>
		</div>
	</div>
	<?php else : ?>
		<div class="p-8 mt-8 bg-white border border-blue">
			<p class="text-xl font-bold font-heavy text-primary">No books found.</p>
			<p class="mt-2 text-primary">We haven't added any faculty publications for this section yet.</p>
		</div>
	<?php endif; ?>
	<?php
	// Return to main loop.
	wp_reset_postdata();
	?>


</main><!-- #main -->

<?php
get_footer();
