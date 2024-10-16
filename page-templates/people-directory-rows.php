<?php
/**
 * Template Name: People Directory (Rows)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

get_header();
?>

<main id="site-content" class="site-main prose sm:prose lg:prose-lg mx-auto">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
		<form class="isotope-to-sort bg-grey-lightest border-solid border-grey border-2 p-4 mx-2 lg:mx-0 my-4" id="filters">
		<?php
				$ids_to_exclude            = array();
				$faculty_titles_to_exclude = get_terms(
					'role',
					array(
						'fields' => 'ids',
						'slug'   => array( 'graduate', 'job-market-candidate', 'graduate-student', 'research' ),
					)
				);
				// Convert the role slug to corresponding IDs.
				if ( ! is_wp_error( $faculty_titles_to_exclude ) && count( $faculty_titles_to_exclude ) > 0 ) {
					$ids_to_exclude = $faculty_titles_to_exclude;
				}
				$faculty_titles = get_terms(
					array(
						'taxonomy'   => 'role',
						'orderby'    => 'ID',
						'order'      => 'ASC',
						'hide_empty' => true,
						'exclude'    => $ids_to_exclude,
					)
				);
				?>
			<?php if ( count( $faculty_titles ) > 1 ) : ?>	
			
			<fieldset class="flex flex-col lg:flex-row justify-start">
				<legend class="mb-2">Filter by Position or Title:</legend>
				<?php foreach ( $faculty_titles as $faculty_title ) : ?>
					<button class="all button bg-blue text-white text-lg hover:bg-blue-light hover:text-primary p-2 my-2 md:my-0" href="javascript:void(0)" data-filter=".<?php echo esc_html( $faculty_title->slug ); ?>"><?php echo esc_html( $faculty_title->name ); ?></button>
				<?php endforeach; ?>
				
			</fieldset>
			<?php endif;?>
			<?php
			$filters = get_terms(
				array(
					'taxonomy'   => 'filter',
					'orderby'    => 'slug',
					'order'      => 'ASC',
					'hide_empty' => true,
				)
			);
			if ( ! empty( $filters ) && ! is_wp_error( $filters ) ) :
				?>
				<?php if ( count( $filters ) > 1 ) : ?>
					<fieldset class="flex flex-col md:flex-row flex-wrap justify-start">
					<legend class="mt-6 mb-2">Filter by Area of Expertise:</legend>
						<?php foreach ( $filters as $filter ) : ?>
							<button class="all button bg-blue text-white text-lg hover:bg-blue-light hover:text-primary mb-2 p-2" href="javascript:void(0)" data-filter=".<?php echo esc_html( $filter->slug ); ?>"><?php echo esc_html( $filter->name ); ?></a>
						<?php endforeach; ?>
					</fieldset>
				<?php endif; ?>
			<?php endif; ?>
			<fieldset class="w-auto search-form my-2 px-2">
				<legend class="mt-4 mb-2">Search by name, title, or research interests:</legend>
				<label class="sr-only" for="id_search">Enter term</label>
				<input class="quicksearch ml-2 p-2 form-input w-full md:w-1/2" type="text" name="search" id="id_search" aria-label="Search Fields of Study" placeholder="Enter description keyword"/>
			</fieldset>
		</form>
		<div class="mt-8 ml-4 mr-2" id="isotope-list" >
			<div class="flex flex-wrap">
		<?php
			$positions = get_terms(
				'role',
				array(
					'orderby'    => 'ID',
					'order'      => 'ASC',
					'hide_empty' => true,
					'exclude'    => $ids_to_exclude,
				)
			);
			$position_slugs   = array();
			$position_classes = implode( ' ', $position_slugs );
			foreach ( $positions as $position ) :
				$position_slug = $position->slug;
				$position_name = $position->name;

				$people_query = new WP_Query(
					array(
						'post_type'      => 'people',
						'role'           => $position_slug,
						'meta_key'       => 'ecpt_people_alpha',
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
						'posts_per_page' => 100,
					)
				);

				if ( $people_query->have_posts() ) :
					?>
					<div class="item pt-2 w-full role-title quicksearch-match <?php echo esc_html( $position->slug ); ?>">
						<h2 class="uppercase"><?php echo esc_html( $position_name ); ?></h2>
					</div>
					<?php
					while ( $people_query->have_posts() ) :
						$people_query->the_post();
						?>

						<?php get_template_part( 'template-parts/content', 'people-sort' ); ?>

						<?php
							endwhile;
				endif;
			endforeach;
			?>
				<div id="noResult">
					<h2>No matching results</h2>
				</div>
			<?php
			wp_reset_postdata();
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
