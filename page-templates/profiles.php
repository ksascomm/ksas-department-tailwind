<?php
/**
 * Template Name: Profiles
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

get_header();
?>

<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
			<div class="flex flex-wrap">
		<?php

		$profile_type = get_field( 'profile_type_selector' );
		if ( $profile_type ) {
			if ( ! is_array( $profile_type ) ) {
				$profile_type = array( $profile_type );
			}
			$args                = array(
				'post_type'      => 'profile',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => 100,
				'tax_query'      => array(
					array(
						'taxonomy' => 'profiletype',
						'terms'    => $profile_type,
					),
				),
			);
			$select_profile_query = new WP_Query( $args );
			if ( $select_profile_query->have_posts() ) :
				while ( $select_profile_query->have_posts() ) :
					$select_profile_query->the_post();
					?>

					<?php get_template_part( 'template-parts/content', 'profile-card' ); ?>

							<?php
						endwhile;
			endif;
			?>
			<?php
			wp_reset_postdata();
		}
		?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
