<?php
/**
 * Template part for displaying Faculty Book cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

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
		<ul class="my-1! pl-4!">
			<?php
				$faculty_post_id  = get_post_meta( $post->ID, 'ecpt_pub_author', true );
				$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
			?>
			<li>
				<a class="hover:text-primary" href="<?php echo esc_url( get_permalink( $faculty_post_id ) ); ?>">
				<?php echo esc_html( get_the_title( $faculty_post_id ) ); ?></a>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ) : ?>
					<div class="capitalize inline">(<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ); ?>)</div>
				<?php endif; ?>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
					?>
					<span class="-ml-1">;</span>
					<a class="hover:text-primary" href="<?php echo esc_url( get_permalink( $faculty_post_id2 ) ); ?>">
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
</div>
