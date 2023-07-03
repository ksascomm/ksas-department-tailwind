<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KSAS_Department_Tailwind
 */

?>


<!-- ACF Custom Widget Sidebar -->
<?php
$custom_sidebar_widget = get_field( 'custom_sidebar', false, false );
if ( is_active_sidebar( $custom_sidebar_widget ) ) :
	?>
	<aside id="secondary" class="sidebar widget-area w-full lg:w-1/4 mt-4 lg:mt-8">
		<?php dynamic_sidebar( $custom_sidebar_widget ); ?>
	</aside><!-- #secondary -->
<?php endif; ?>

<?php /** Widgetized Sidebars  */ ?>

	<?php

	if ( function_exists( 'get_field' ) && get_field( 'ecpt_page_sidebar' ) ) :
		?>

	<aside class="custom page-widgets" aria-labelledby="custom-sidebar-content">
		<!-- ACF Page Specific Sidebar -->
		<div class="widget ecpt-page-sidebar" id="custom-sidebar-content">
			<?php
			$content = get_field( 'ecpt_page_sidebar', false, false );
			echo apply_filters( 'acf_the_content', wp_kses_post( $content ) );
			?>
		</div>
	</aside>
		<?php
	endif;
	?>
	<?php
	// Get the array of ancestors!
		$ancestors     = get_post_ancestors( $post->ID );
		$ancestor_id   = ( $ancestors ) ? $ancestors[ count( $ancestors ) - 1 ] : $post->ID;
		$the_ancestor  = get_page( $ancestor_id );
		$ancestor_slug = $the_ancestor->post_name;
		if ( is_page( 'graduate' ) || 'graduate' == $ancestor_slug ) : ?>
			<!-- Graduate Sidebar -->
			<div class="graduate-sidebar sidebar widget-area container prose sm:prose lg:prose-lg mx-auto mt-4 lg:mt-8">
				<?php dynamic_sidebar( 'graduate-sb' ); ?>
			</div>
		<?php elseif ( is_page( 'undergraduate' ) || 'undergraduate' == $ancestor_slug ) : ?>
			<!-- Undergraduate Sidebar -->
			<div class="undergraduate-sidebar sidebar container prose sm:prose lg:prose-lg mx-auto mt-4 lg:mt-8">
				<?php dynamic_sidebar( 'undergrad-sb' ); ?>
			</div>
		<?php endif; ?>