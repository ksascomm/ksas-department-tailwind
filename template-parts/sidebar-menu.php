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
		$ancestors = get_post_ancestors( $post->ID );

		if ( count( $ancestors ) == 0 ) {
			// Top level page.
			echo esc_html( $post->post_title );
		} elseif ( count( $ancestors ) == 1 ) {
			// Child page - show parent.
			$parent_page = get_post( $post->post_parent );
			echo esc_html( $parent_page->post_title );
		} elseif ( count( $ancestors ) >= 2 ) {
			// Grandchild or deeper - show grandparent.
			$parent_id      = $post->post_parent;
			$parent_post    = get_post( $parent_id );
			$grandparent_id = $parent_post->post_parent;

			$grandparent_title = get_the_title( $grandparent_id );
			$current_title     = get_the_title( $post->ID );

			if ( $grandparent_title !== $current_title ) {
				echo esc_html( $grandparent_title );
			} else {
				// FIXED: Added missing 'echo'.
				echo esc_html( get_the_title( $parent_id ) );
			}
		}
		?>
	</span>
	<i class="ml-2 text-xs fa-solid fa-chevron-down"></i>
</button>
	<div id="section-menu" role="menu">
		<?php internal_page_submenu(); ?>
	</div>
</div>
<?php endif; ?>
