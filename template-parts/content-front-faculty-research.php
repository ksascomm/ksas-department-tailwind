<?php
/**
 * Template part for displaying page content in front-blog.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'research-excerpt article-excerpt blog-excerpt prose sm:prose lg:prose-lg xl:prose-xl mx-auto mb-4 bg-white' ); ?>>
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
				'large',
				array(
					'class' => 'w-full h-48 object-cover object-left-top pr-0',
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
			<?php the_title( '<h3 class="entry-title !text-xl"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content px-4 leading-normal text-base">
			<?php
				the_excerpt();
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
