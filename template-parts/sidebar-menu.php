<?php
/**
 * The sidebar containing the main widget area
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<?php
if ( $post->post_parent ) {
	$children = wp_list_pages(
		array(
			'title_li' => '',
			'child_of' => $post->post_parent,
			'echo'     => 0,
		)
	);
} else {
	$children = wp_list_pages(
		array(
			'title_li' => '',
			'child_of' => $post->ID,
			'echo'     => 0,
		)
	);
}

if ( $children ) :
	?>

	<div class="relative text-left dropdown sidebar-menu lg:mr-8 hidden lg:inline-block" aria-hidden="true">
		<button class="inline-flex justify-center w-full px-4 py-2 !text-[.875rem] leading-5 font-semi font-semibold text-grey-darkest lg:bg-grey-cool lg:bg-opacity-20 lg:border lg:border-grey-cool uppercase" type="button">
			<span>In This Section</span>
			<svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
		</button>
		<div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-left -translate-y-2 scale-95 z-50">
			<div class="absolute left-0 w-80 mt-4 origin-top-right bg-white border border-primary divide-y divide-primary outline-none z-auto">
				<div class="py-1 lg:bg-grey-cool lg:bg-opacity-40">
					<ul class="nav">
						<?php echo $children; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
