<?php
/**
 * Template part for displaying Faculty Books excerpts
 * Like on Single-People Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>
<?php
	$author_id              = get_the_ID();
	$faculty_book_tab_query = new WP_Query(
		array(
			'post_type'      => 'faculty-books',
			'posts_per_page' => 50,
			'orderby'        => 'date',
			'meta_query'     => array(
				'relation' => 'OR',
				array(
					'key'     => 'ecpt_pub_author',
					'value'   => $author_id,
					'type'    => 'NUMERIC',
					'compare' => '=',
				),
				array(
					'key'     => 'ecpt_pub_author2',
					'value'   => $author_id,
					'type'    => 'NUMERIC',
					'compare' => '=',
				),
			),
		)
	);
	?>

<?php
if ( $faculty_book_tab_query->have_posts() ) :
	?>
<div class="mt-8">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
	<?php
	while ( $faculty_book_tab_query->have_posts() ) :
		$faculty_book_tab_query->the_post();
		?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="border-b border-solid border-grey lg:border-none lg:shadow-md p-2">
	<div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-4 h-full px-3 py-2">
		<div>
		<?php
			the_post_thumbnail(
				'faculty-book',
				array(
					'class' => 'h-80 w-60 lg:mx-auto',
					'alt'   => esc_html( 'Book Cover art for ' . get_the_title() ),
				)
			);
			?>
		</div>
		<div class="sm:col-span-2 py-2">
			<h2 class="leading-tight! text-xl!">
				<a class="hover:text-primary" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h2>
			<p class="not-prose">
				<span class="capitalize pb-2"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ); ?></span>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
					$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
					?>
					(with <span class="capitalize"><?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?>,&nbsp;<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role2', true ) ); ?></span>)
				<?php } ?>
				<br>
				<?php if ( get_post_meta( $post->ID, 'ecpt_publisher', true ) ) : ?>
					<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_publisher', true ) ); ?>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ) : ?>
					<span class="inline -ml-1">,</span>
					<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ); ?>
				<?php endif; ?>
			</p>
		</div>
	</div>
</div>

	</article><!-- #post-<?php the_ID(); ?> -->
			<?php
		endwhile;
		?>
	</div>
</div>
<?php endif;
		wp_reset_postdata()
?>
