<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("pl-4"); ?>>
	<header class="entry-header pr-2 xl:pl-0 xl:pr-0 max-w-[90ch]">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( get_post_type() === 'post') :
			?>
			<div class="entry-meta mb-2 uppercase font-semi font-semibold text-xl">
				<?php
				ksas_department_tailwind_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php elseif ( get_post_type() === 'bulletinboard'): ?>
			<ul class="entry-meta mb-2 uppercase font-semi font-semibold text-xl">
				<li>Posted: <?php the_time( 'F j, Y' ); ?></li>
				<?php if ( get_field( 'bulletin_deadline' ) ) : ?>
				<li>Deadline: <?php the_field( 'bulletin_deadline' ); ?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?><!-- .bulletin .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php if ( has_post_thumbnail() ) :?>
		<div class="lg:max-w-[375px] lg:mr-8 lg:float-left mb-10">
			<?php
			the_post_thumbnail(
				'large',
				array(
					'class' => 'block mb-0 w-full lg:w-auto',
				)
			);
			?>
		</div>
	<?php endif; ?>
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
		?>
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
