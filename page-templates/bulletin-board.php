<?php
/**
 * Template Name: Bulletin Board
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

get_header();
?>

<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto pb-2">
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

		get_template_part( 'template-parts/content', 'page' );

	endwhile; // End of the loop.
	?>
	<?php
	$bulletin_types = get_object_taxonomies( 'bulletinboard' );
	foreach ( $bulletin_types as $bulletin_type ) :
		$bulletin_terms = get_terms( $bulletin_type );
		foreach ( $bulletin_terms as $bulletin_term ) :

			$bulletins = new WP_Query(
				array(
					'taxonomy' => $bulletin_type,
					'term'     => $bulletin_term->slug,
				)
			);

			if ( $bulletins->have_posts() ) :
				?>
		<h2 class="bulletin-category-title" id="<?php echo esc_html( $bulletin_term->slug ); ?>">
				<?php echo esc_html( $bulletin_term->name ); ?>
		</h2>
				<?php
				while ( $bulletins->have_posts() ) :
					$bulletins->the_post();
					?>
			<div class="bulletin">
				<details>
					<summary class="block p-5 leading-normal cursor-pointer font-semi font-semibold"><?php the_title(); ?></summary>
					<ul class="entry-meta">
						<li>Posted: <?php the_time( 'F j, Y' ); ?></li>
						<?php if ( get_field( 'bulletin_deadline' ) ) : ?>
						<li>Deadline: <?php the_field( 'bulletin_deadline' ); ?></li>
						<?php endif; ?>
					</ul>
					<p>
						<?php echo esc_html( wp_trim_words( get_the_excerpt(), 65 ) ); ?>
						<a href="<?php the_permalink(); ?>" aria-label="Link to '<?php the_title(); ?>'">Read Full Posting &raquo</a>
					</p>
				</details>
			</div>
			<?php endwhile; ?>
		<?php endif; ?>
			<?php
			endforeach;
		endforeach;
	?>
	<?php
	// Return to main loop.
	wp_reset_postdata();
	?>
</main><!-- #main -->

<?php
get_footer();
