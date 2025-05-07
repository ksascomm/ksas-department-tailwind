<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KSAS_Department_Tailwind
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="date" content="<?php the_modified_date(); ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
	<script>
		var host = window.location.hostname;
		if(host != "stage.krieger.jhu.edu") {
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-WZTH3HXT');
		}
	</script>
	<!-- End Google Tag Manager -->
	<?php
	if ( get_field( 'siteimprove', 'option' ) ) :
		?>
	<!-- Siteimprove Analytics -->
	<script async src="https://siteimproveanalytics.com/js/siteanalyze_11464.js"></script>
	<!-- End Siteimprove Analytics -->
	<?php endif; ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTH3HXT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
	<header id="site-header" class="w-full shadow-md header-footer-group sm:justify-between sm:items-baseline" role="banner">
		<div class="flex justify-end">
			<div class="container relative hidden lg:inline">
				<div class="z-10 float-right py-2 pr-2 font-bold text-white bg-blue jhu-link font-heavy ">
					<a class="mr-3 text-white hover:text-blue-light hover:border-b-2 hover:border-white" href="https://www.jhu.edu/">Johns Hopkins University</a>
				</div>
			</div>
		</div>
		<div class="header-titles-wrapper">
			<div class="container header-inner section-inner">
				<div class="grid grid-cols-1 header-titles lg:grid-cols-3 gap-x-5">
					<div class="h-auto shield lg:pl-4">
					<a href="https://krieger.jhu.edu" class="hover:opacity-50 block max-w-[200px] sm:max-w-2xs lg:max-w-xs mx-auto lg:mx-0">
						<?php echo file_get_contents( get_template_directory() . '/dist/images/krieger.logo.horizontal.blue.svg' ); ?>
						<span class="sr-only">Krieger School of Arts & Sciences shield, to the KSAS homepage</span>
					</a>
					</div>
					<div class="lg:col-span-2">
						<h1 class="site-title font-serifbold font-medium text-4xl lg:text-[42px] xl:text-[48px] mt-4 lg:mt-0 mb-12 md:mb-0 pt-2 lg:pt-0 text-center lg:text-left">
						<?php
							$ksas_department_tailwind_description = get_bloginfo( 'description', 'display' );
						if (
							$ksas_department_tailwind_description || is_customize_preview() ) :
							$ksas_department_tailwind_description = get_bloginfo( 'description', 'display' );
							echo '<span class="block py-2 font-serif text-xl font-medium lg:pt-0 xl:text-2xl">' . $ksas_department_tailwind_description . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?>
							<?php endif; ?>
						<a class="text-blue hover:text-blue-light" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
						</h1>
					</div>
				</div><!-- .header-titles -->
				<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false" type="button">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg( 'search' ); ?>
						</span>
						<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'ksas-department-tailwind' ); ?></span>
					</span>
				</button><!-- .search-toggle -->
				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle" type="button">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
						</span>
						<span class="toggle-text"><?php _e( 'Menu', 'ksas-department-tailwind' ); ?></span>
					</span>
				</button><!-- .nav-toggle -->
			</div><!-- .header-inner -->
		</div><!-- .header-titles-wrapper -->
		<div class="bg-white header-navigation-wrapper">
			<div class="container flex justify-between header-inner section-inner">
				<div class="menu-container">
					<button class="menu-button" aria-expanded="false" aria-controls="site-header-menu" aria-label="<?php esc_attr_e( 'Menu', 'textdomain' ); ?>"></button>
					<div id="site-header-menu" class="site-header-menu text-primary">
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'ksas-department-tailwind' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'main-nav',
									'menu_id'         => 'primary-menu',
									'container_class' => 'nav-primary',
									'depth'           => 3,
								)
							);
							?>
						</nav>
					</div>
				</div>

				<div class="header-toggles hide-no-js">

					<div class="toggle-wrapper search-toggle-wrapper">

						<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false" type="button">
							<span class="toggle-inner">
							<?php twentytwenty_the_theme_svg( 'search' ); ?>
								<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'ksas-department-tailwind' ); ?></span>
							</span>
						</button><!-- .search-toggle -->

					</div>

				</div><!-- .header-toggles -->
			</div><!-- .header-inner -->

		</div><!-- .header-navigation-wrapper -->

		<?php
			get_template_part( 'inc/modal-search' );
		?>
	</header><!-- #site-header -->
	<?php
	get_template_part( 'inc/modal-menu' );
