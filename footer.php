<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KSAS_Department_Tailwind
 */

?>
<?php get_template_part( 'template-parts/widgets-site-footer' ); ?>
<footer class="site-footer bg-old-black text-white mt-20 relative">
	<div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 
	<?php
	if ( is_active_sidebar( 'sidebar-footer' ) ) :
		?>
		bg-blue <?php endif; ?>" style="height: 80px" >
		<svg
		alt=""
			class="absolute -bottom-px overflow-hidden"
			xmlns="http://www.w3.org/2000/svg"
			preserveAspectRatio="none"
			version="1.1"
			viewBox="0 0 2560 100"
			x="0"
			y="0"
		>
			<polygon
			class="text-old-black fill-old-black"
			points="2560 0 2560 100 0 100"
			></polygon>
		</svg>
	</div>
	<div class="py-6 px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
		<h2 class="sr-only">Footer</h2>
		<div class="col-span-4 lg:col-span-2 m-2 mt-6 lg:ml-6">
			<h3 class="text-xl font-sans font-light!"><div class="sr-only">Address:</div> <?php bloginfo( 'description' ); ?> <?php bloginfo( 'name' ); ?></h3>
		<?php if ( get_field( 'custom_address', 'option' ) ) : ?>
			<div class="font-sans font-light">
				Johns Hopkins University
				<?php the_field( 'custom_address', 'option' ); ?>
			</div>
			<?php else : ?>
			<p class="text-lg font-sans font-light">Johns Hopkins University<br>3400 N. Charles St<br>Baltimore, MD 21218</p>
			<?php endif; ?>
		</div>

		
		<div class="col-span-4 lg:col-span-1 m-2 mt-6">
		<?php
		$department_email    = get_field( 'department_email', 'option' );
		$department_phone    = get_field( 'department_phone', 'option' );
		$department_location = get_field( 'department_location', 'option' );
		$department_social   = get_field( 'department_social', 'option' );
		if ( $department_email || $department_phone || $department_location || $department_social ) :
			?>
			<h3 class="text-xl font-sans font-light!">Contact Us</h3>
			
			<ul class="text-lg">
			
			<?php if ( $department_email ) : ?>
				<li><span class="fa-solid fa-envelope"></span> <a class="font-sans font-light text-white hover:text-blue-light !underline !decoration-dotted" href="<?php echo esc_url( 'mailto:' . antispambot( get_field( 'department_email', 'option' ) ) ); ?>"><?php echo esc_html( antispambot( get_field( 'department_email', 'option' ) ) ); ?></a></li>
			<?php endif; ?>
			
			<?php if ( $department_phone ) : ?>
				<li><span class="fa-solid fa-phone-rotary"></span> <a class="font-sans font-light text-white hover:text-blue-light !underline !decoration-dotted" href="tel:<?php the_field( 'department_phone', 'option' ); ?>"><?php the_field( 'department_phone', 'option' ); ?></a></li>
			<?php endif; ?>

			<?php if ( $department_location ) : ?>
				<li>
					<?php
					// Gist Here: https://gist.github.com/mattradford/bb7679a2671b99ada655
					$building = $department_location['address'];
					$address  = urlencode_deep( "{$building}" );
					?>
					<span class="fa-solid fa-map"></span>
					<a class="font-sans text-white font-light hover:text-blue-light !underline !decoration-dotted" href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_html( $address ); ?>" target="_blank">
						Find Us on Google Maps
					</a>
				</li>
			<?php endif; ?>

			<?php if ( have_rows( 'department_social', 'option' ) ) : ?>
				<?php
				while ( have_rows( 'department_social', 'option' ) ) :
					the_row();
					?>
				<li>
					<?php $department_social_platform_selected_option = get_sub_field( 'department_social_platform' ); ?>
					<?php if ( $department_social_platform_selected_option ) : ?>
					<span class="fa-brands fa-<?php echo esc_html( $department_social_platform_selected_option['value'] ); ?>"></span>
					<?php endif; ?>
					<a class="text-white hover:text-blue-light !underline !decoration-dotted" href="<?php echo esc_attr( get_sub_field( 'department_social_link' ) ); ?>">
						Follow us on <?php echo esc_html( $department_social_platform_selected_option['label'] ); ?>
					</a>
				</li>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // No rows found ?>
			<?php endif; ?>
			</ul>
		<?php endif; ?>
		</div>
		
		<div class="m-2 lg:m-4 mt-6 col-span-4 lg:col-span-1 lg:mx-auto justify-end">
			<ul class="lg:flex lg:flex-wrap lg:justify-between text-lg" role="menu" aria-label="Social Media Accounts">
			<li><a class="text-white hover:text-blue-light" href="https://facebook.com/JHUArtsSciences"><span class="fa-brands fa-facebook fa-2x pr-2"></span><span class="sr-only">Follow us on Facebook</span></a></li>
			<li><a class="text-white hover:text-blue-light" href="https://www.instagram.com/JHUArtsSciences/"><span class="fa-brands fa-instagram fa-2x pr-2"></span><span class="sr-only">Follow us on Instagram</span></a></li>
			<li><a class="text-white hover:text-blue-light" href="https://bsky.app/profile/jhuartssciences.bsky.social"><span class="fa-brands fa-bluesky fa-2x pr-2"></span><span class="sr-only">Follow us on Bluesky</span></a></li>
			<li><a class="text-white hover:text-blue-light" href="https://www.youtube.com/user/jhuksas"><span class="fa-brands fa-youtube fa-2x pr-2"></span><span class="sr-only">Follow us on YouTube</span></a></li>
			<li><a class="text-white hover:text-blue-light" href="https://www.tiktok.com/@jhuartssciences"><span class="fa-brands fa-tiktok fa-2x"></span><span class="sr-only pr-2">Follow us on TikTok</span></a></li>
			</ul>
		</div>
	</div>
	<div class="flex flex-wrap bg-original-black py-6 px-4 justify-between">
		<div>
			<a href="https://www.jhu.edu/" class="hover:opacity-50">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/university.shield.svg" class="w-52 inline-block pl-4 mb-8 md:mb-0" alt="JHU shield in the footer">
			<div class="sr-only">Link to Johns Hopkins Univeristy main website</div>
			</a>
		</div>
		<div>
			<h2 class="sr-only">Legal Navigation</h2>
			<ul class="lg:flex lg:flex-wrap lg:justify-between text-lg" role="menu" aria-label="University Policies">
				<li class="pl-4 lg:pl-0 font-sans font-light" role="menuitem">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> </li>
				<li class="pl-4" role="menuitem"><a class="text-white font-sans font-light hover:text-blue-light !underline !decoration-dotted" href="https://accessibility.jhu.edu/">Accessibility</a></li>
				<li class="pl-4" role="menuitem"><a class="text-white font-sans font-light hover:text-blue-light !underline !decoration-dotted" href="https://it.johnshopkins.edu/policies/privacystatement">Privacy Statement</a></li>
				<li class="pl-4" role="menuitem"><a class="text-white font-sans font-light hover:text-blue-light !underline !decoration-dotted" href="https://policies.jhu.edu/">University Policy & Document Library</a></li>
			</ul>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
