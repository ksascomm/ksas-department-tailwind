<?php
/**
 * Template part for displaying featured images
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>

<div class="alignfull featured-image-area" role="banner">
	<div class="flex bg-white lg:bg-grey-cool lg:bg-opacity-50 h-20 lg:h-80">
		<div class="flex lg:items-center lg:justify-start xl:justify-center text-left px-6 sm:w-full lg:w-2/5">
			<h1 class="tracking-tight leading-10 sm:leading-none lg:text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-8">
				<?php the_title(); ?>
			</h1>
		</div>
		<div class="hidden lg:block lg:w-3/5" style="clip-path:polygon(5% 0, 100% 0%, 100% 100%, 0 100%)">

		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'full',
				array(
					'class' => 'h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full',
					'title' => 'Feature image',
				)
			);
			else :
					// Otherwise, randomly display one of the following images.
				$theme = get_template_directory_uri();
				$bg    = array(
					$theme . '/dist/images/header-images/deptThemeStandard01.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard02.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard03.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard04.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard05.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard06.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard07.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard08.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard09.jpg',
					$theme . '/dist/images/header-images/deptThemeStandard10.jpg',
				);

				$i              = wp_rand( 0, count( $bg ) - 1 ); // Generate random number size of the array.
				$selected_image = "$bg[$i]"; // Set variable equal to which random filename was chosen.
				?>
				<img src="<?php echo esc_url( $selected_image ); ?>" alt="Hero Image of Students on Campus" class="h-56 w-full object-cover sm:h-72 lg:w-full lg:h-full stock-image">
				<?php
		endif;
			?>
		</div>
	</div>
</div>
