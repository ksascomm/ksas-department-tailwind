<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pl-6 lg:pl-8' ); ?>>

<?php
	// 1. Explicitly check age using DateTime
	$post_date    = get_the_date( 'Y-m-d' );
	$current_date = gmdate( 'Y-m-d' );
	$start_date   = new DateTime( $post_date );
	$end_date     = new DateTime( $current_date );
	$date_diff    = $start_date->diff( $end_date );
	$post_years   = $date_diff->y;

	// 2. Yoda Condition: Display disclaimer if post is 6 years or older
if ( 5 <= $post_years && is_single() ) :
	?>
		<div class="px-4 mt-4 mr-4 xl:mt-0 xl:mr-0 mb-6 border-2 border-solid bg-grey-lightest border-grey-cool xl:max-w-[90ch]" role="note">
			<p class="text-lg">
				<?php esc_html_e( 'This news post is more than five years old and the content may be out of date.', 'ksas-dept-tailwind' ); ?>
			</p>
		</div>
	<?php endif; ?>
	<header class="entry-header pr-2 xl:pl-0 xl:pr-0 max-w-[90ch]">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( get_post_type() === 'post' ) :
			?>
			<div class="mb-2 text-xl font-bold uppercase entry-meta font-heavy">
				<?php
				ksas_department_tailwind_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php elseif ( get_post_type() === 'bulletinboard' ) : ?>
			<ul class="mb-2 text-xl font-bold uppercase entry-meta font-heavy">
				<li>Posted: <?php the_time( 'F j, Y' ); ?></li>
				<?php if ( get_field( 'bulletin_deadline' ) ) : ?>
				<li>Deadline: <?php the_field( 'bulletin_deadline' ); ?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?><!-- .bulletin .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="max-w-100 md:max-w-93.75 mr-20 md:mr-8 md:float-left mb-10 pr-8">
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
			// Get the custom field value.
			$external_link = get_post_meta( get_the_ID(), 'ecpt_external_link', true );

			// Check if the link exists.
		if ( ! empty( $external_link ) ) :
			// Parse the URL to get the host (e.g., 'www.nytimes.com')
			$url_parts = parse_url( $external_link );
			$domain    = isset( $url_parts['host'] ) ? $url_parts['host'] : 'External Site';
			// Optional: Strip 'www.' for a cleaner look
			$clean_domain = str_replace( 'www.', '', $domain );
			?>
				<div class="my-8 wp-block-button">
					<a href="<?php echo esc_url( $external_link ); ?>" 
					target="_blank" 
					rel="noopener noreferrer" 
					class="inline-flex items-center px-6 py-3 text-base font-bold text-white transition-colors duration-200 border border-transparent bg-blue wp-block-button__link">
						<span>Read More on <?php echo esc_html( $clean_domain ); ?></span>
						<i class="ml-2 text-sm fa-solid fa-arrow-up-right-from-square"></i>
					</a>
				</div>
			<?php
		endif;
		else :
			the_excerpt();
		endif;
		?>
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<hr>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
