<?php
/**
 * Template part for displaying singular Faculty Books posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'faculty-book' ); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="float-left mr-6">
				<div class="relative aspect-w-4 aspect-h-5 sm:aspect-w-16 sm:aspect-h-9 w-20 sm:w-64">
				<?php
					the_post_thumbnail(
						'full',
						array(
							'class' => 'object-cover',
							'alt'   => esc_html( get_the_title() ),
						)
					);
				?>
				</div>
			</div>
	<?php endif; ?>
	<ul class="!list-none">
		<?php
			$faculty_post_id  = get_post_meta( $post->ID, 'ecpt_pub_author', true );
			$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
		?>
		<li>
			<a href="<?php echo esc_url( get_permalink( $faculty_post_id ) ); ?>">
			<?php echo esc_html( get_the_title( $faculty_post_id ) ); ?></a>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ) : ?>
				<div class="capitalize inline">(<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ); ?>)</div>
			<?php endif; ?>
			<?php
			if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
				?>
				<br>
				<a href="<?php echo esc_url( get_permalink( $faculty_post_id2 ) ); ?>">
					<?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?></a>
					<div class="capitalize inline">(<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role2', true ) ); ?>)</div>
		<?php } ?>
		</li>
		<li>
		<?php if ( get_post_meta( $post->ID, 'ecpt_publisher', true ) ) : ?>
			<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_publisher', true ) ); ?>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ) : ?>
			<div class="inline -ml-1">,</div>
			<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ); ?>
		<?php endif; ?>
		</li>
		<li>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ) : ?>
			<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ); ?>" aria-label="Purchase Online">
				Purchase Online <span class="fa-solid fa-square-arrow-up-right"></span>
			</a>
			<?php endif; ?>
		</li>
	</ul>
	<?php
	if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="sr-only"> "%s"</span>', 'ksas-department-tailwind' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
		else :
			the_excerpt();
		endif;

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksas-department-tailwind' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
