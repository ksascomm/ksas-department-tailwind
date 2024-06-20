<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>

	<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto">
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
		<div class="breadcrumbs my-4" typeof="BreadcrumbList" vocab="https://schema.org/">
			<?php bcn_display(); ?>
		</div>
		<?php endif; ?>
		<section class="error-404 not-found prose p-6">
			<header class="page-header">
				<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ksas-department-tailwind' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable', 'ksas-department-tailwind' ); ?></p>

				<p><?php esc_html_e( 'Please try the following:', 'ksas-department-tailwind' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Check your spelling', 'ksas-department-tailwind' ); ?></li>
					<li>
						<?php
							/* translators: %s: home page url */
							printf(
								__(
									'Return to the <a href="%s">home page</a>',
									'ksas-department-tailwind'
								),
								esc_html( home_url() )
							);
							?>
					</li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'ksas-department-tailwind' ); ?></li>
					<li><?php esc_html_e( 'Use the search box in the menu', 'ksas-department-tailwind' ); ?></li>
				</ul>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
