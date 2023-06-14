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
// Set Faculty Bokoks Query Parameters.
$faculty_books_query = new WP_Query(
	array(
		'post_type'      => 'faculty-books',
		'posts_per_page' => 100,
		'meta_key'       => 'ecpt_pub_date',
		'orderby'        => 'meta_value date',
		'order'          => 'DESC',
	)
);
?>

<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto pb-2">

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
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
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
	<?php endif; ?>
	<?php
	// Return to main loop.
	wp_reset_postdata();
	?>


</main><!-- #main -->

<?php
get_footer();
