<?php
/**
 * Template part for displaying Faculty Books excerpts (e.g., on Single-People Template)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>
<?php
// Use a specific variable to avoid global collisions.
$person_id = get_the_ID();

$faculty_book_tab_query = new WP_Query(
	array(
		'post_type'              => 'faculty-books',
		'posts_per_page'         => 50,
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'no_found_rows'          => true, // Performance: skip pagination count.
		'update_post_term_cache' => false, // Performance: skip term cache if not needed.
		'meta_query'             => array(
			'relation' => 'OR',
			array(
				'key'     => 'ecpt_pub_author',
				'value'   => $person_id,
				'compare' => '=', // ACF stores as ID, so default string comparison is fine.
			),
			array(
				'key'     => 'ecpt_pub_author2',
				'value'   => $person_id,
				'compare' => '=',
			),
		),
	)
);

if ( $faculty_book_tab_query->have_posts() ) :
	?>
	<div class="mt-8 not-prose">
		<div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
			<?php
			while ( $faculty_book_tab_query->have_posts() ) :
				$faculty_book_tab_query->the_post();
				$book_id    = get_the_ID();
				$role1      = get_post_meta( $book_id, 'ecpt_pub_role', true );
				$role2      = get_post_meta( $book_id, 'ecpt_pub_role2', true );
				$author2_id = get_post_meta( $book_id, 'ecpt_pub_author2', true );
				$publisher  = get_post_meta( $book_id, 'ecpt_publisher', true );
				$pub_date   = get_post_meta( $book_id, 'ecpt_pub_date', true );
				$has_second = wp_validate_boolean( get_post_meta( $book_id, 'ecpt_author_cond', true ) );
				?>
				<article id="post-<?php echo (int) $book_id; ?>" <?php post_class( 'p-2 border-b border-solid border-grey lg:border-none lg:shadow-md' ); ?>>
					<div class="grid h-full grid-cols-1 gap-4 px-3 py-2 sm:grid-cols-3 lg:grid-cols-1">
						<div class="flex items-start justify-center">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'faculty-book', array( 'class' => 'h-auto max-w-full lg:mx-auto shadow-sm' ) ); ?>
							<?php endif; ?>
						</div>
						
						<div class="py-2 sm:col-span-2">
							<h2 class="mb-1 font-bold leading-tight font-heavy text-xl!">
								<a class="hover:text-primary" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							
							<ul class="list-none!">
								<li class="capitalize">
									<?php echo esc_html( $role1 ); ?>
									<?php if ( $has_second && $author2_id ) : ?>
										<span class="normal-case"> (with <?php echo esc_html( get_the_title( $author2_id ) ); ?>, <?php echo esc_html( $role2 ); ?>)</span>
									<?php endif; ?>
								</li>
								
								<?php if ( $publisher || $pub_date ) : ?>
									<li class="mt-1 ps-0!">
										<?php
										$meta_output = array_filter( array( trim( (string) $publisher ), trim( (string) $pub_date ) ) );
										echo esc_html( implode( ', ', $meta_output ) );
										?>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
endif;
?>
