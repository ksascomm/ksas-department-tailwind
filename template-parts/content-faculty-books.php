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
	<header class="pl-12 2xl:pl-[2%] pr-4 entry-header xl:pr-8">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="py-4 entry-title lg:py-4">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="pl-12 2xl:pl-[2%] pr-4 entry-content lg:pr-12 xl:pr-0">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="mr-6 md:float-left">
				<div class="relative sm:w-64">
				<?php
					the_post_thumbnail(
						'full',
						array(
							'class' => 'not-prose object-cover',
							'alt'   => esc_html( get_the_title() ),
						)
					);
				?>
				</div>
			</div>
	<?php endif; ?>
	<ul class="list-none! not-prose">
		<li class="py-2">
			<?php
			// Get Author IDs.
			$faculty_post_id  = get_post_meta( get_the_ID(), 'ecpt_pub_author', true );
			$faculty_post_id2 = get_post_meta( get_the_ID(), 'ecpt_pub_author2', true );
			$primary_role     = get_post_meta( get_the_ID(), 'ecpt_pub_role', true );
			$second_role      = get_post_meta( get_the_ID(), 'ecpt_pub_role2', true );

			// Validate condition for both legacy 'on' and ACF '1'.
			$has_second_author = wp_validate_boolean( get_post_meta( get_the_ID(), 'ecpt_author_cond', true ) );

			// Display Primary Author.
			if ( $faculty_post_id ) :
				?>
				<a href="<?php echo esc_url( get_permalink( $faculty_post_id ) ); ?>">
					<?php echo esc_html( get_the_title( $faculty_post_id ) ); ?>
				</a>
				<?php if ( $primary_role ) : ?>
					<div class="inline capitalize">(<?php echo esc_html( $primary_role ); ?>)</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			// Display Second Author only if condition is true AND we have a valid ID.
			if ( $has_second_author && $faculty_post_id2 ) :
				?>
				<br>
				<a href="<?php echo esc_url( get_permalink( $faculty_post_id2 ) ); ?>">
					<?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?>
				</a>
				<?php if ( $second_role ) : ?>
					<span class="inline capitalize">(<?php echo esc_html( $second_role ); ?>)</span>
				<?php endif; ?>
			<?php endif; ?>
		</li>
		<?php
		$publisher = get_post_meta( get_the_ID(), 'ecpt_publisher', true );
		$pub_date  = get_post_meta( get_the_ID(), 'ecpt_pub_date', true );

		// Only render the <li> if either variable has a value.
		if ( $publisher || $pub_date ) :
			?>
			<li class="py-2">
				<?php if ( $publisher ) : ?>
					<?php echo esc_html( $publisher ); ?>
				<?php endif; ?>

				<?php if ( $publisher && $pub_date ) : ?>
					<span class="inline -ml-1">, </span>
				<?php endif; ?>

				<?php if ( $pub_date ) : ?>
					<?php echo esc_html( $pub_date ); ?>
				<?php endif; ?>
			</li>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ) : ?>
			<li class="py-2">
			<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ); ?>" aria-label="Purchase Online">
				Purchase Online <span class="fa-solid fa-square-arrow-up-right"></span>
			</a>
			</li>
		<?php endif; ?>
	</ul>
	<?php
	if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="sr-only"> "%s"</span>', 'ksas-dept-tailwind' ),
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

		?>
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
