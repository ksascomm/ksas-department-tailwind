<?php
/**
 * The template for displaying all single People posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>
<?php global $post;
$bio = get_post_meta( $post->ID, 'ecpt_bio', true ); ?>
	<main id="site-content" class="site-main prose sm:prose md:prose-md lg:prose-lg mx-auto <?php if ( empty( $bio ) ) : ?> no-bio -mb-20<?php else: ?> has-bio <?php endif; ?>
	">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-people-full' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
