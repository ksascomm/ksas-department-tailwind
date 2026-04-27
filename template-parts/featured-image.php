<?php
/**
 * Template part for displaying featured images
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>

<div class="alignfull featured-image-area front-featured-image-area h-auto mt-0!  bg-white lg:bg-grey-lightest">
	<div class="flex h-auto lg:h-80 ">
		<div class="flex lg:pr-6 text-left pl-6 md:pl-[4%] 2xl:pl-[6%] 3xl:pl-[12%] 4xl:pl-[15%] lg:items-center lg:justify-start sm:w-full lg:w-2/5">
			<h1 class="tracking-tight leading-10 sm:leading-none lg:text-4xl xl:text-[44px] py-8 mb-0">
				<?php the_title(); ?>
			</h1>
		</div>
		<div class="hidden lg:block lg:w-3/5" style="clip-path:polygon(5% 0, 100% 0%, 100% 100%, 0 100%)">

		<?php
		$hero_classes = 'not-prose h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full';
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'full',
				array(
					'class' => $hero_classes,
					'title' => 'Feature image',
					'alt'   => ! empty( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) ? get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) : get_the_title(),
				)
			);
			else :
					// Otherwise, randomly display one of the following images.
				$theme_uri = get_template_directory_uri();
				$banners   = array();
				// Fill the array using a loop to keep it clean.
				for ( $i = 1; $i <= 9; $i++ ) {
					$banners[] = "{$theme_uri}/dist/images/header-images/interior-banner-{$i}.jpg";
				}

				$selected_image = $banners[ array_rand( $banners ) ];
				?>
				<img 
				src="<?php echo esc_url( $selected_image ); ?>" 
				alt="Random image of students on campus or a campus building on a sunny day." 
				class="<?php echo esc_attr( $hero_classes ); ?> stock-image"
				>
			<?php endif; ?>
		</div>
	</div>
</div>
