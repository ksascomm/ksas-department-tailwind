<?php
/**
 * Custom Default Template for The Events Calendar (Category Archives)
 * Overrides: [your-theme]/tribe/events/v2/default-template.php
 *
 * This uses your theme’s normal page layout.
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();
?>

<main id="site-content" class="mx-auto prose site-main sm:prose lg:prose-lg">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- Sidebar + Breadcrumbs -->
		<div class="ml-8 wayfinding md:mb-8 xl:pl-0 2xl:ml-[2%]">
			<?php get_template_part( 'template-parts/sidebar-menu' ); ?>
			<?php if ( function_exists( 'bcn_display' ) ) : ?>
				<div class="mt-8 breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php bcn_display(); ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- Main content -->
		<div class="pl-8 pr-4 2xl:pl-[2%] entry-content lg:pr-12 2xl:pr-0">
			<?php
			// ✅ Output the Events Calendar view inside your page layout
			echo tribe( Template_Bootstrap::class )->get_view_html();
			?>
		</div>

	</article>
</main>
<?php get_footer(); ?>
