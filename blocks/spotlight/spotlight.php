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

$template = array(
	array(
		'core/button',
		array(
			'url' => wp_get_attachment_url( 561 ),
		),
	),
	array(
		'core/heading',
		array(
			'level'     => 5,
			'content'   => 'Heading goes here.',
			'align'     => 'center',
			'className' => 'card-heading text-red-500',
		),
	),
	array(
		'core/paragraph',
		array(
			'content' => 'Describe here.',
			'align'   => 'left',
		),
	),
);

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
	<div class="relative">
	<div class="block-padding">
		<div class="relative <?php echo esc_attr( $class_name ); ?> pt-8">
			<div
				class="relative z-10 max-w-lg text-left transition shadow-md cursor-pointer group bg-blue-light hover:bg-blue-medium fx fadeInUp" id="post-<?php the_ID(); ?>">
				<div class="-translate-x-5 -translate-y-5 bg-white shadow-md ">
				<?php
				if ( has_post_thumbnail() ) :
					?>
					<div class="flex-none w-full overflow-hidden h-1/4 bg-gray aspect-video">
						<?php
						the_post_thumbnail(
							'large',
							array(
								'class' => 'object-cover object-center h-full w-full',
							)
						);
						?>
					</div>
					<?php
					endif;
				?>
					<div class="flex flex-col p-8 ">
						<div class="font-bold uppercase font-heavy">
							<?php
								global $post;
								$terms = get_the_terms( $post->ID, 'profiletype' );
							foreach ( $terms as $term ) {
								echo $term->name;
							}
							?>
							Spotlight
						</div>
						<div class="mb-5 text-2xl font-bold font-heavy"><?php the_title(); ?></div>
						<div class="text-lg leading-snug">
							<?php
							global $post;
							if ( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ) :
								?>
								<?php echo get_post_meta( $post->ID, 'ecpt_pull_quote', true ); ?>
							<?php elseif ( get_post_meta( $post->ID, 'ecpt_quote', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_quote', true ); ?>
							<?php else : ?>
								<?php the_excerpt(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="flex items-center gap-4 px-5 pb-5 font-bold text-white not-prose">
					<a class="flex items-center font-bold text-white font-heavy" href="<?php echo esc_url( get_permalink() ); ?>"><span>Learn More</span>
					<span
						class="relative inline-flex items-center justify-center ml-4 transition border-2 border-white rounded-full h-9 w-9 group-hover:rotate-90"><span
							class="bg-white absolute top-1/2 left-1/2 h-[2px] w-3 -translate-y-1/2 -translate-x-1/2"></span><span
							class="bg-white absolute top-1/2 left-1/2 h-[2px] w-3 -translate-y-1/2 -translate-x-1/2 rotate-90"></span></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php endwhile;
endif;
?>
