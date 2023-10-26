<?php
/**
 * Spotlight Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

$arg_type         = get_field( 'loop_argument_type' );
$testimonial_type = get_field( 'testimonial_type' );
$spotlight_type   = get_field( 'spotlight_type' );
if ( $arg_type == 'random' ) :
	$args = array(
		'orderby'        => 'rand',
		'post_type'      => 'profile',
		'posts_per_page' => 1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'profiletype',
				'terms'    => $spotlight_type,
			),
		),
	);
else :
	$testimonials = get_field( 'select_testimonials' );
	$args         = array(
		'orderby'   => 'title',
		'post_type' => array( 'testimonial', 'profile' ),
		'post__in'  => $testimonials,
	);
endif;

// Create class attribute allowing for custom "className" and "align" values.
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
	<div class="<?php echo esc_attr( $class_name ); ?> mx-auto flex max-w-md overflow-hidden rounded-lg shadow-sm p-8 border-2 border-grey">
	<?php if ( has_post_thumbnail() ) :?>
		<div class="w-full lg:w-1/3">
			<?php the_post_thumbnail(
				'large',
				array(
					'alt'   => get_the_title(),
				)
			); 
			?>
		</div>
		<?php endif; ?>
		<div class="w-full lg:w-2/3 p-4 md:p-4">
			<h3 class="text-2xl font-bold text-gray-800 dark:text-white">
				<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>
			<p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
			<?php
			if ( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ) {
				echo esc_html( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) );
			} else {
				echo wp_trim_words( get_the_excerpt(), 40, '...' ); }
			?>
			</p>
			
		</div>
	</div>
	<?php endwhile;
endif;
?>
