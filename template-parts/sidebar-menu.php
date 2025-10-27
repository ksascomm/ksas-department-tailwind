<?php
/**
 * The sidebar containing the main widget area
 *
 * @package KSAS_Department_Tailwind
 * @since KSAS_Department_Tailwind 1.0.0
 */

?>

<?php
if ( ! $post->post_parent ) {
	// get the child of the top-level page.
	$children = wp_list_pages(
		array(
			'sort_column' => 'post_title',
			'sort_order'  => 'ASC',
			'echo'        => 0,
			'title_li'    => '',
			'child_of'    => $post->ID,
		)
	);
} else {
	// get the child pages if we are on the first page of the child level.
	// $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");.
	$ancestors = $post->ancestors;
	if ( ! empty( $ancestors ) ) {
		// now get an ID of the first page.
		// WordPress collects ID in reverse order, so the "first" will be the last page.
		$ancestors = end( $ancestors );
		$children  = wp_list_pages(
			array(
				'sort_column' => 'post_title',
				'sort_order'  => 'ASC',
				'echo'        => 0,
				'title_li'    => '',
				'child_of'    => $ancestors,
			)
		);
	}
}

if ( $children ) :
	?>
	 
 
<div class="relative hidden text-left menu-button-links lg:mr-8 lg:inline-block">
	<button 
		class="justify-center inline-block px-4 py-2 text-base font-bold leading-5 text-white font-heavy lg:bg-blue lg:border lg:border-grey-cool"
		type="button"
		id="menu-button"
		aria-haspopup="true"
		aria-controls="section-menu"
		aria-expanded="false">
		<span><i class="fa-solid fa-bars"></i>&nbsp; Inside
			<?php
			global $post;
			$ancestors = get_post_ancestors( $post->ID );
			if ( count( $ancestors ) == 0 ) {
				echo esc_html( $page_name = $post->post_title );
			} elseif ( count( $ancestors ) == 1 ) {
				$parent_page = get_post( $post->post_parent );
				$parent_url  = get_permalink( $post->post_parent );
				$parent_name = $parent_page->post_title;
				echo esc_html( $parent_name );
			} elseif ( count( $ancestors ) >= 2 ) {
				$current         = $post->ID;
				$parent          = $post->post_parent;
				$get_grandparent = get_post( $parent );
				$grandparent     = $get_grandparent->post_parent;
				if ( $root_parent = get_the_title( $grandparent ) !== $root_parent = get_the_title( $current ) ) {
					echo esc_html( get_the_title( $grandparent ) );
				} else {
					esc_html( get_the_title( $parent ) );
				}
			}
			?>
		</span>
		<svg class="inline-block w-5 h-5 ml-2 -mr-1 down" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
	</button>
	<div id="section-menu">
		<?php internal_page_submenu(); ?>
	</div>
</div>
<?php endif; ?>
