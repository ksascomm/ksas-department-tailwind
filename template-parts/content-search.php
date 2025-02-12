<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'px-12 py-8' ); ?>>
	<header class="entry-header pr-2 pl-0 xl:pr-0">
		<div class="post-type font-heavy font-bold border-l-2 border-blue pl-2 text-xl leading-none">
		<?php
			$current_post_type = get_post_type_object( $post->post_type );
			echo esc_html( $current_post_type->labels->singular_name );
		?>
		</div>
		<?php the_title( sprintf( '<h2 class="entry-title text-3xl!"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta mb-2 uppercase font-semi font-semibold text-xl">
			<?php
			ksas_department_tailwind_posted_on();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-summary">
	<?php
	if ( 'people' === get_post_type() ) :
		$people_excerpt_long  = wp_strip_all_tags( get_post_meta( $post->ID, 'ecpt_bio', true ) );
		$people_excerpt_short = wp_trim_words( $people_excerpt_long, 30, '...' );
		echo esc_html( $people_excerpt_short );
		?>
	<?php else : ?>
		<?php the_excerpt(); ?>
		<?php
	endif;
	?>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->
