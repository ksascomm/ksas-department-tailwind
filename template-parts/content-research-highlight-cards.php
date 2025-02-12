<?php
/**
 * Template part for displaying Research Highlight cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<div class="shadow-md p-2">
	
	<div class="h-full px-3 py-2">
	<?php
	$research_highlight_categories = get_categories(
		array(
			'taxonomy' => 'research-highlight-category',
			'orderby' => 'name',
			'order'   => 'ASC'
		)
	);
	foreach ( $research_highlight_categories as $research_highlight_category ) : ?>
		<div class="uppercase font-bold font-heavy">
			<?php echo $research_highlight_category->name; ?>
		</div>
	<?php endforeach; ?>
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'faculty-book',
				array(
					'class' => 'h-80 w-60 lg:mx-auto',
					'alt'   => esc_html( 'Publication art for ' . get_the_title() ),
				)
			);
		endif;
			?>
		<h2 class="leading-tight! text-xl!">
			<?php
				if ( get_post_meta( $post->ID, 'publication_link', true ) ) :
				?>
				<a href="<?php echo esc_url( get_post_meta( $post->ID, 'publication_link', true ) ); ?>"><?php the_title(); ?> <i class="fa-solid fa-square-up-right"></i></a>
			<?php else : ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
		<ul class="my-1! pl-4!">
		<?php
					if ( get_post_meta( $post->ID, 'publication_name', true ) ) :
						?>
						<li><em><?php echo esc_html( get_post_meta( $post->ID, 'publication_name', true ) ); ?></em>, <?php echo esc_html( get_post_meta( $post->ID, 'publication_year', true ) ); ?></li>
					<?php endif; ?>
					<?php
					$faculty_post_id = get_post_meta( $post->ID, 'publication_author', true );
					if ( get_post_meta( $post->ID, 'publication_author', true ) ) :
						?>
						<li>
						<a href="<?php echo esc_html( get_the_permalink( $faculty_post_id ) ); ?>"><?php echo esc_html( get_the_title( $faculty_post_id ) ); ?></a>
						<?php if ( get_post_meta( $post->ID, 'publication_author_other', true ) ) : ?>
							and <?php echo esc_html( get_post_meta( $post->ID, 'publication_author_other', true ) ); ?>
						<?php endif; ?>
						</li>
					<?php endif; ?>
		</ul>
	</div>
</div>
