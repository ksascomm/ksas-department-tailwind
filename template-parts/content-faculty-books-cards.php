<?php
/**
 * Template part for displayingFaculty Book cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

?>

<div class="shadow-md p-2">
	<div class="h-full px-3 py-2">
		<?php
			the_post_thumbnail(
				'large',
				array(
					'class' => 'h-auto w-60 lg:mx-auto',
					'alt'   => esc_html( get_the_title() ),
				)
			);
			?>
		<h3 class="!leading-tight !text-xl">
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
		</h3>
		<ul class="!my-1 !pl-4">
			<?php
				$faculty_post_id = get_post_meta( $post->ID, 'ecpt_pub_author', true );
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
		</ul>
	</div>
</div>
