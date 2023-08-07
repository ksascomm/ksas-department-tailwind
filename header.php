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
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PDL5K37');</script>
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDL5K37"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
	<header id="site-header" class="header-footer-group sm:justify-between shadow-md sm:items-baseline w-full" role="banner">
		<div class="flex justify-end">
			<div class="container relative hidden lg:inline">
				<div class="text-white float-right bg-blue jhu-link z-10 py-2 pr-2 font-heavy font-bold ">
					<a class="mr-3 hover:text-blue-light hover:border-b-2 hover:border-white" href="https://www.jhu.edu/">Johns Hopkins University</a>
				</div>
			</div>
		</div>
		<div class="header-titles-wrapper">
			<div class="header-inner section-inner container">
				<div class="header-titles grid grid-cols-1 lg:grid-cols-3 gap-x-5">
					<div class="h-auto shield pl-4">
					<?php if ( get_field( 'shield', 'option' ) == 'jhu' ) : ?>
						<a href="https://www.jhu.edu/" title="Johns Hopkins University">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/university.shield.svg" class="h-auto w-full p-2" alt="JHU Shield" role="img">
						</a>
					<?php else : ?>
						<a href="https://krieger.jhu.edu" rel="home" class="hover:opacity-50">
							<?php echo file_get_contents( get_template_directory() . '/dist/images/krieger.logo.horizontal.blue.svg' ); ?>
							<span class="sr-only">Krieger School of Arts & Sciences</span>
						</a>
					<?php endif; ?>
					</div>
					<div class="lg:col-span-2">
						<h1 class="site-title font-serif font-bold text-4xl lg:text-[42px] xl:text-[48px] mt-4 lg:mt-0 mb-12 md:mb-0 pt-2 text-center lg:text-left">
						<?php
								$ksas_department_tailwind_description = get_bloginfo( 'description', 'display' );
						if (
								$ksas_department_tailwind_description || is_customize_preview() ) :
							$ksas_department_tailwind_description = get_bloginfo( 'description', 'display' );
							echo '<span class="block font-normal sm:pt-4 lg:pt-0 text-xl">' . $ksas_department_tailwind_description . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
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
		<div class="header-navigation-wrapper bg-white">
			<div class="header-inner section-inner flex container justify-between">
				<div class="menu-container">
					<button class="menu-button" aria-controls="site-header-menu" type="button"><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'ksas-department-tailwind' ); ?></span></button>
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
