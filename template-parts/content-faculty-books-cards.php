<?php
/**
 * Template part for displaying Faculty Book cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

// Fetch all meta up front to keep the template clean.
$book_id          = get_the_ID();
$faculty_post_id  = get_post_meta( $book_id, 'ecpt_pub_author', true );
$faculty_post_id2 = get_post_meta( $book_id, 'ecpt_pub_author2', true );
$primary_role     = get_post_meta( $book_id, 'ecpt_pub_role', true );
$second_role      = get_post_meta( $book_id, 'ecpt_pub_role2', true );
$publisher        = get_post_meta( $book_id, 'ecpt_publisher', true );
$pub_date         = get_post_meta( $book_id, 'ecpt_pub_date', true );

// Handle legacy 'on' and ACF '1' for the conditional.
$has_second = wp_validate_boolean( get_post_meta( $book_id, 'ecpt_author_cond', true ) );
?>

<div class="p-2 m-8 border-b border-solid 2xl:mx-0 border-grey lg:border-none lg:shadow-md">
	<div class="grid h-full grid-cols-1 gap-4 px-3 py-2 sm:grid-cols-3 lg:grid-cols-1">
		
		<div class="flex items-center justify-center">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php
				the_post_thumbnail(
					'faculty-book',
					array(
						'class' => 'not-prose h-auto max-w-full lg:mx-auto', // Changed to h-auto to prevent stretching.
						'alt'   => esc_html( 'Book Cover art for ' . get_the_title() ),
					)
				);
				?>
			<?php endif; ?>
		</div>

		<div class="py-2 sm:col-span-2">
			<h2 class="leading-tight! text-xl!">
				<a class="transition-colors duration-200 hover:text-primary" href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			
			<ul class="my-1! ps-0! list-none!">
				<?php if ( $faculty_post_id ) : ?>
					<li class="ps-0!">
						<a class="hover:text-primary" href="<?php echo esc_url( get_permalink( $faculty_post_id ) ); ?>">
							<?php echo esc_html( get_the_title( $faculty_post_id ) ); ?>
						</a>
						<?php if ( $primary_role ) : ?>
							<span class="inline capitalize">(<?php echo esc_html( $primary_role ); ?>)</span>
						<?php endif; ?>

						<?php if ( $has_second && $faculty_post_id2 ) : ?>
							<br>
							<a class="hover:text-primary" href="<?php echo esc_url( get_permalink( $faculty_post_id2 ) ); ?>">
								<?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?>
							</a>
							<?php if ( $second_role ) : ?>
								<span class="inline capitalize">(<?php echo esc_html( $second_role ); ?>)</span>
							<?php endif; ?>
						<?php endif; ?>
					</li>
				<?php endif; ?>

				<?php if ( $publisher || $pub_date ) : ?>
					<li class="mt-1 ps-0!">
						<?php
						$meta_parts = array_filter( array( trim( (string) $publisher ), trim( (string) $pub_date ) ) );
						echo esc_html( implode( ', ', $meta_parts ) );
						?>
					</li>
				<?php endif; ?>
			</ul>
		</div>

	</div>
</div>