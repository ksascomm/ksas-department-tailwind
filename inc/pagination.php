<?php
/**
 * Custom Numeric Pagination.
 *
 * @package KSAS_Department_Tailwind
 */

if ( ! function_exists( 'ksas_department_tailwind_pagination' ) ) :
	/**
	 * Display numeric pagination for archives.
	 *
	 * @param WP_Query|null $query Custom query object if not using the main loop.
	 */
	function ksas_department_tailwind_pagination( $query = null ) {
		// Support for custom queries, otherwise fall back to global $wp_query.
		if ( ! $query ) {
			global $wp_query;
			$query = $wp_query;
		}

		// Stop execution if there's only 1 page or if it's a single post.
		if ( is_singular() || $query->max_num_pages <= 1 ) {
			return;
		}

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $query->max_num_pages );
		$links = array();

		/** 1. Build the list of pages to show */
		$links[] = $paged;
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<nav class="my-8 navigation" aria-label="Pagination">' . "\n";
		echo '<ul class="page-numbers">' . "\n";

		/** 2. Previous Post Link */
		if ( get_previous_posts_link() ) {
			$prev_link = get_previous_posts_link( '&laquo; Previous' );
			// Inject Tailwind classes into the anchor tag.
			$prev_link = str_replace( '<a ', '<a class="px-4 py-2 transition-colors border border-gray-300 rounded hover:bg-gray-100" ', $prev_link );

			// We use wp_kses_post because the string contains a safe <a> tag.
			echo '<li class="pagination-prev">' . wp_kses_post( $prev_link ) . '</li>' . "\n";
		}

		/** 3. First Page + Ellipsis */
		if ( ! in_array( 1, $links, true ) ) {
			printf( '<li><a href="%s" class="px-3 py-2 border rounded">1</a></li>' . "\n", esc_url( get_pagenum_link( 1 ) ) );
			if ( ! in_array( 2, $links, true ) ) {
				echo '<li class="px-2">…</li>';
			}
		}

		/** 4. Main Page Loop */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$is_active  = ( $paged === (int) $link );
			$active_val = $is_active ? 'active' : '';
			printf(
				'<li class="%s"><a href="%s" class="px-4 py-2 transition-colors border border-gray-300 rounded hover:bg-gray-100">%s</a></li>' . "\n",
				esc_attr( $active_val ), // Escape just the value.
				esc_url( get_pagenum_link( $link ) ),
				absint( $link )
			);
		}

		/** 5. Last Page + Ellipsis */
		if ( ! in_array( $max, $links, true ) ) {
			if ( ! in_array( $max - 1, $links, true ) ) {
				echo '<li class="px-2">…</li>' . "\n";
			}
			printf( '<li><a href="%s" class="px-3 py-2 border rounded">%s</a></li>' . "\n", esc_url( get_pagenum_link( $max ) ), absint( $max ) );
		}

		/** 6. Next Post Link */
		if ( get_next_posts_link() ) :?>
			<li class="pagination-next">
				<?php
				// We use wp_kses_post because the function returns a safe <a> tag.
				echo wp_kses_post( get_next_posts_link( 'Next &raquo;' ) );
				?>
			</li>
			<?php
		endif;

		echo '</ul></nav>' . "\n";
	}
endif;
