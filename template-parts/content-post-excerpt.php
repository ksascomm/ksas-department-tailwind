<?php
/**
 * Template part for displaying posts on blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>
<?php if ( is_sticky() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-excerpt prose sm:prose lg:prose-lg xl:prose-xl mx-auto pt-4 mb-4 wp-sticky bg-grey-lightest border-2 border-solid border-grey m-4 block p-4' ); ?> aria-label="<?php the_title(); ?>">
	<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-excerpt prose sm:prose lg:prose-lg xl:prose-xl mx-auto border-b border-solid border-grey pt-4 mb-4' ); ?> aria-label="<?php the_title(); ?>">
	<?php endif; ?>
	<?php
	/**
	 * This differs from theme's post_thumbnail()
	 *
	 * See inc/template-tags.php for that function
	 */
	if ( has_post_thumbnail() ) :
		?>
		<div class="h-full grid grid-cols-1 lg:grid-cols-4 gap-4">
			<div class="not-prose">
				<?php
					the_post_thumbnail(
						'full',
						array(
							'class' => 'lg:mb-4 lg:mt-0 w-80 lg:w-auto pl-4 pr-2',
							'alt'   => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</div>
		<div class="col-span-3 px-4">
			<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta mb-2 uppercase font-semi font-semibold text-xl">
					<?php
					ksas_department_tailwind_posted_on();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
				<?php if ( get_post_meta( get_the_ID(), 'ecpt_external_link', true ) ) : ?>
					<?php the_title( '<h2 class="entry-title !mt-2"><a class="archive-post" href="' . esc_url( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) . '" rel="bookmark">', ' <i class="fa-regular fa-square-arrow-up-right"></i></a></h2>' ); ?>
						</a>
					<?php else : ?>
						<?php the_title( '<h2 class="entry-title !mt-2"><a class="archive-post" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<?php endif; ?>
			</header><!-- .entry-header -->
			<div class="entry-content xl:px-2">
				<?php
					the_excerpt();
				?>
			</div><!-- .entry-content -->
		</div>
	<?php else : ?>
		<header class="entry-header">
			<?php

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta mb-2 uppercase font-semi font-semibold text-xl">
					<?php
					ksas_department_tailwind_posted_on();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_external_link', true ) ) : ?>
				<?php the_title( '<h2 class="entry-title !mt-2"><a class="archive-post" href="' . esc_url( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) . '" rel="bookmark">', ' <i class="fa-regular fa-square-arrow-up-right"></i></a></h2>' ); ?>
					</a>
				<?php else : ?>
					<?php the_title( '<h2 class="entry-title !mt-2"><a class="archive-post" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content w-full pl-4 pr-2 lg:pr-12 xl:pl-0 xl:pr-0">
			<?php
				the_excerpt();
			?>
		</div><!-- .entry-content -->

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
