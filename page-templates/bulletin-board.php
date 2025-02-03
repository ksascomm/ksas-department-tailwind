<?php
/**
 * Template Name: Bulletin Board
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

get_header();
?>

<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto pb-2">
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
		<div class="accordion">
				<?php
				while ( $bulletins->have_posts() ) :
					$bulletins->the_post();
					?>
				<div class="accordion-element">
					<h3 class="accordion-heading">
						<button type="button"
								aria-expanded="false"
								class="accordion-trigger"
								aria-controls="<?php the_ID(); ?>"
								id="accordion<?php the_ID(); ?>">
								<span class="accordion-title">
									<?php the_title(); ?>
									<span class="accordion-icon"></span>
								</span>
						</button>
					</h3>
					<div id="<?php the_ID(); ?>" role="region" aria-labelledby="accordion<?php the_ID(); ?>" class="accordion-panel" hidden="">
						<ul class="entry-meta mt-0 mb-2 uppercase font-semi font-semibold text-xl">
							<li>Posted: <?php the_time( 'F j, Y' ); ?></li>
							<?php if ( get_field( 'bulletin_deadline' ) ) : ?>
							<li>Deadline: <?php the_field( 'bulletin_deadline' ); ?></li>
							<?php endif; ?>
						</ul>
						<p>
							<?php echo esc_html( wp_trim_words( get_the_excerpt(), 65 ) ); ?>
							<a href="<?php the_permalink(); ?>">Read Full Posting &raquo</a>
						</p>
						<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit Document <span class="sr-only">%s</span>', 'ksas-blocks' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								),
								'<span class="edit-link">',
								'</span>'
							);
							?>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</div>
				</div>

			<?php endwhile; ?>
			</div>
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
