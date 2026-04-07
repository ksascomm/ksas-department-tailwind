<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @package KSAS_Department_Tailwind
 */

// Initialize variables to avoid "undefined" notices.
$studyfield_tagline = '';
$studyfield_degrees = '';
$studyfield_majors  = '';
$studyfield_minors  = '';

$studyfieldacf  = get_field( 'studyfield' );
$slug           = sanitize_title( $studyfieldacf );
$studyfield_url = 'https://krieger.jhu.edu/wp-json/wp/v2/studyfields?slug=' . $slug;

// --- PERMANENT FIX 1: Unique Cache Key per Department ---
// Using md5($slug) ensures the key is unique and safe for Memcached length limits.
$transient_key = 'studyfields_api_cache_' . md5( $slug );

// --- PERMANENT FIX 2: Manual Refresh via URL ---
// If you visit compthoughtlit.jhu.edu/?refresh=1, it wipes the cache.
// Check if 'refresh' is requested AND if the user has permission to manage options.
if ( isset( $_GET['refresh'] ) && current_user_can( 'manage_options' ) ) {
	delete_transient( $transient_key );
	// Optional: Log it to the console so you know it worked.
	echo "<script>console.log('Transient Cache Cleared for " . esc_js( $slug ) . "');</script>";
}

// Cache strategy: Bypass on debug, otherwise cache for 1 month.
$cache_time = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? 1 : MONTH_IN_SECONDS;

$studyfield_raw = get_transient( $transient_key );

if ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || false === $studyfield_raw ) {
	$studyfield_raw = wp_remote_get( $studyfield_url );

	// --- PERMANENT FIX 3: Don't Cache Failures ---
	if ( ! is_wp_error( $studyfield_raw ) && 200 === wp_remote_retrieve_response_code( $studyfield_raw ) ) {
		$body = json_decode( wp_remote_retrieve_body( $studyfield_raw ) );

		// Only save to transient if the API actually found a post (not an empty array []).
		if ( ! empty( $body ) && is_array( $body ) ) {
			set_transient( $transient_key, $studyfield_raw, $cache_time );
		}
	}
}

// Process the data (using either the fresh fetch or the cached transient).
if ( ! is_wp_error( $studyfield_raw ) ) {
	$studyfield_response = json_decode( wp_remote_retrieve_body( $studyfield_raw ) );

	if ( ! empty( $studyfield_response ) && is_array( $studyfield_response ) ) {
		$studyfield_data = $studyfield_response[0];

		if ( isset( $studyfield_data->acf ) ) {
			$studyfield_tagline = $studyfield_data->acf->ecpt_headline ?? '';
			$studyfield_degrees = $studyfield_data->acf->ecpt_degreesoffered ?? '';
			$studyfield_majors  = $studyfield_data->acf->ecpt_majors ?? '';
			$studyfield_minors  = $studyfield_data->acf->ecpt_minors ?? '';
		}
	}
}
?>

<div class="flex h-auto hero bg-grey-lightest front-featured-image-area md:h-112 lg:h-120">
	<div class="flex items-center px-8 pb-4 text-left md:px-12 md:py-0 lg:w-7/12">
		<div>
			<h2 class="mt-8 text-2xl font-bold text-primary md:text-3xl lg:text-4xl lg:mt-0 font-heavy">
				<?php echo ! empty( $studyfield_tagline ) ? esc_html( $studyfield_tagline ) : esc_html( get_the_title() ); ?>
			</h2>
			<div class="mt-2 text-lg leading-normal tracking-tight text-primary md:text-xl backdrop-blur-md">
				<?php the_content(); ?>
			</div>

			<?php if ( $studyfield_degrees || $studyfield_majors || $studyfield_minors ) : ?>
				<ul class="flex flex-wrap study-field list-none pl-0!">
					<?php if ( $studyfield_degrees ) : ?>
						<li class="relative inline-block px-2 my-2 text-base leading-tight bg-white xl:text-lg">
							<span class="block text-xs uppercase">Degrees Offered</span>
							<span class="block font-bold font-heavy"><?php echo esc_html( $studyfield_degrees ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( $studyfield_majors ) : ?>
						<li class="relative inline-block px-2 my-2 text-base leading-tight bg-white xl:text-lg">
							<span class="block text-xs uppercase">Major</span>
							<span class="block font-bold font-heavy"><?php echo esc_html( $studyfield_majors ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( $studyfield_minors ) : ?>
						<li class="relative inline-block px-2 my-2 text-base leading-tight bg-white xl:text-lg">
							<span class="block text-xs uppercase">Minor</span>
							<span class="block font-bold font-heavy"><?php echo esc_html( $studyfield_minors ); ?></span>
						</li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="hidden lg:block lg:w-5/12 front featured-image">
		<?php if ( have_rows( 'homepage_hero_images' ) ) : ?>
			<?php
			$random_images = get_field( 'homepage_hero_images' );
			shuffle( $random_images );
			$hero_img = $random_images[0]['homepage_hero_image'];
			?>
			<img class="mt-0! h-56 w-full object-cover sm:h-72 lg:w-full lg:h-full" 
				src="<?php echo esc_url( $hero_img['url'] ); ?>" 
				alt="<?php echo esc_html( $hero_img['alt'] ); ?>" />
		<?php else : ?>
			<?php the_post_thumbnail( 'full', array( 'class' => 'mt-0! h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full' ) ); ?>
		<?php endif; ?>
	</div>
</div>