<?php
/**
 * The template for displaying all single Spotlight Profiles
 *
 * @package KSAS_Department_Tailwind
 * @since KSAS_Department_Tailwind 1.0.0
 */

get_header();

?>
<style>

  @media (min-width: 1280px) and (max-width: 1400px) {
    .site-main {
      padding-left: 2rem;
    }
}
@media (min-width: 64rem) {
    .lg\:prose-lg {
      max-width: 110ch;
    }
  }
</style>
<main id="site-content" class="mx-auto prose site-main lg:prose-lg">
	<?php
	if ( function_exists( 'bcn_display' ) ) :
		?>
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
		<?php bcn_display(); ?>
	</div>
	<?php endif; ?>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'profile-full' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
