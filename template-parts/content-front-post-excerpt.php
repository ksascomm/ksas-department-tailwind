<?php
/**
 * Template part for displaying page content in front-blog.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

?>

<?php if ( is_sticky() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-excerpt blog-excerpt prose sm:prose lg:prose-lg xl:prose-xl mx-auto mb-4 wp-sticky' ); ?> aria-label="<?php the_title(); ?>">
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-excerpt blog-excerpt prose sm:prose lg:prose-lg xl:prose-xl mx-auto mb-4' ); ?> aria-label="<?php the_title(); ?>">
<?php endif; ?>
<?php
	/**
	 * This differs from theme's post_thumbnail()
	 *
	 * See inc/template-tags.php for that function
	 */
if ( has_post_thumbnail() ) :
	?>
		<div class="news-thumb ">
		<?php
			the_post_thumbnail(
				'news-thumb',
				array(
					'class' => 'w-full h-0 sm:h-56 object-cover pr-0',
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
		?>
		</div>
	<?php endif; ?>
		<header class="entry-header px-4 pt-4">
			<?php
			ksas_department_tailwind_posted_on();
			?>
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content px-4 leading-normal text-lg">
			<?php
				the_excerpt();
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
