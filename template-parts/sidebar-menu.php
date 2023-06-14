<?php
/**
 * The sidebar containing the main widget area
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<?php
		global $post;
		$ancestors = get_post_ancestors( $post->ID ); // Get the array of ancestors.
			// Get the top-level page slug for sidebar/widget content conditionals.
			$ancestor_id   = ( $ancestors ) ? $ancestors[ count( $ancestors ) - 1 ] : $post->ID;
			$the_ancestor  = get_page( $ancestor_id );
			$ancestor_slug = $the_ancestor->post_name;
			$children      = get_pages(
				array(
					'child_of' => $post->ID,
				)
			);
			?>

	<div class="hidden lg:flex lg:float-left dropdown lg:mr-8">
		<button class="inline-flex justify-center w-full px-4 py-2 !text-[.875rem] leading-5 font-semi font-semibold  text-grey-darkest lg:bg-grey-cool lg:bg-opacity-20 lg:border lg:border-grey-cool uppercase" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
			<span>In This Section</span>
			<svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
		</button>
		<div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-left -translate-y-2 scale-95 z-50">
			<div class="absolute left-0 w-80 mt-12 origin-top-left bg-white border border-primary divide-y divide-primary outline-none z-auto" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
				<div class="py-1">
					<?php
					// If there are no ancestors display a menu of children. If no children, hide menu.
					if ( count( $ancestors ) == 0 && is_front_page() == false ) {
						?>
						<?php
						if ( count( $children ) < 1 ) :
							echo '<style>.dropdown{display:none}</style>';
							endif;
						?>
							<?php
							$page_name     = $post->post_title;
								$test_menu = wp_nav_menu(
									array(
										'theme_location' => 'main-nav',
										'menu_class'     => 'nav',
										'submenu'        => $page_name,
										'depth'          => 1,
										'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
									)
								);
							// If you are on a CHILD Page then do this...
					} elseif ( count( $ancestors ) == 1 ) {
							$parent_page = get_post( $post->post_parent );
							$parent_url  = get_permalink( $post->post_parent );
							$parent_name = $parent_page->post_title;

								wp_nav_menu(
									array(
										'theme_location' => 'main-nav',
										'menu_class'     => 'nav',
										'submenu'        => $parent_name,
										'depth'          => 2,
										'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
									)
								);
						// If you are on a grandchild page 3 levels deep, then...
					} elseif ( count( $ancestors ) >= 2 ) {
						$current               = $post->ID;
						$parent                = $post->post_parent;
						$parent_link           = get_permalink( $parent );
						$get_grandparent       = get_post( $parent );
						$grandparent           = $get_grandparent->post_parent;
						$grandparent_name      = get_the_title( $grandparent );
						$grandparent_link      = get_permalink( $grandparent );
						$get_greatgrandparent  = get_post( $grandparent );
						$greatgrandparent      = $get_greatgrandparent->post_parent;
						$greatgrandparent_name = get_the_title( $greatgrandparent );

						wp_nav_menu(
							array(
								'theme_location' => 'main-nav',
								'menu_class'     => 'nav',
								'submenu'        => $grandparent_name,
								'depth'          => 3,
								'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
							)
						);
					}
					?>
				</div>
			</div>
		</div>
	</div>
