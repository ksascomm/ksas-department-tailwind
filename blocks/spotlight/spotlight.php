<?php
/**
 * Spotlight Block Template.
 *
 * @package KSAS_Department_Tailwind
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// 1. Logic & Arguments
$arg_type       = get_field( 'loop_argument_type' );
$spotlight_type = get_field( 'spotlight_type' );
$testimonials   = get_field( 'select_testimonials' );

if ( 'random' === $arg_type ) {
	$args = array(
		'orderby'        => 'rand',
		'post_type'      => 'profile',
		'posts_per_page' => 1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'profiletype',
				'field'    => 'term_id', // Specified field for clarity.
				'terms'    => $spotlight_type,
			),
		),
	);
} else {
	$args = array(
		'orderby'   => 'post__in', // Keep order as selected in ACF.
		'post_type' => array( 'testimonial', 'profile' ),
		'post__in'  => $testimonials ? $testimonials : array( 0 ), // Avoid global query if empty.
	);
}

// 2. Classes
$class_name = 'spotlight-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( $is_preview ) {
	$class_name .= ' is-admin';
}

$spotlight_block_query = new WP_Query( $args );

if ( $spotlight_block_query->have_posts() ) :
	while ( $spotlight_block_query->have_posts() ) :
		$spotlight_block_query->the_post();
		?>
	<div class="relative">
		<div class="block-padding">
			<div class="relative <?php echo esc_attr( $class_name ); ?> pt-8">
				<div class="relative z-10 max-w-lg text-left transition shadow-md cursor-pointer group bg-blue-light hover:bg-blue-medium fx fadeInUp" id="post-<?php the_ID(); ?>">
					<div class="-translate-x-5 -translate-y-5 bg-white shadow-md ">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="flex-none w-full overflow-hidden h-1/4 bg-gray aspect-video">
							<?php
							the_post_thumbnail(
								'large',
								array( 'class' => 'not-prose object-cover object-center h-full w-full' )
							);
							?>
						</div>
					<?php endif; ?>
						
						<div class="flex flex-col p-8 ">
							<div class="font-bold uppercase font-heavy">
								<?php
								$terms = get_the_terms( get_the_ID(), 'profiletype' );
								if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
									// Join terms with a space if there are multiple.
									$term_names = wp_list_pluck( $terms, 'name' );
									echo esc_html( implode( ' ', $term_names ) );
								endif;
								?>
								Spotlight
							</div>
							<div class="mb-5 text-2xl font-bold font-heavy"><?php the_title(); ?></div>
							<div class="text-lg leading-snug">
								<?php
								$pull_quote = get_post_meta( get_the_ID(), 'ecpt_pull_quote', true );
								$quote      = get_post_meta( get_the_ID(), 'ecpt_quote', true );

								if ( $pull_quote ) {
									echo wp_kses_post( $pull_quote );
								} elseif ( $quote ) {
									echo wp_kses_post( $quote );
								} else {
									the_excerpt();
								}
								?>
							</div>
						</div>
					</div>
					<div class="flex items-center gap-4 px-5 pb-5 font-bold text-white not-prose">
						<a class="flex items-center font-bold text-white font-heavy" href="<?php the_permalink(); ?>">
							<span>Learn More</span>
							<span class="relative inline-flex items-center justify-center ml-4 transition border-2 border-white rounded-full h-9 w-9 group-hover:rotate-90">
								<span class="bg-white absolute top-1/2 left-1/2 h-0.5 w-3 -translate-y-1/2 -translate-x-1/2"></span>
								<span class="bg-white absolute top-1/2 left-1/2 h-0.5 w-3 -translate-y-1/2 -translate-x-1/2 rotate-90"></span>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php
	endwhile;
	wp_reset_postdata(); // CRITICAL: Restore the global $post object!
endif;
?>