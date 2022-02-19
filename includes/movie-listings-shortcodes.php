<?php

// List Movies
function ml_list_movies($atts, $content = null)
{
	$atts = shortcode_atts(array(
		'title' => 'Latest Movies',
		'count' => 12,
		'pagination' => 'off'
	), $atts);





	// Query Args
	$args = array(
		'post_type' => 'movie_listing',
		'post_status'	=> 'publish',
		'orderby' => 'menu_order',
		'order'		=> 'ASC',
		'posts_per_page' => $atts['count'],
	);

	// Get Movies From DB
	$movies = new WP_Query($args);

	// Check For Movies
	if ($movies->have_posts()) {

		$output = '<div class="movie-list">';
		while ($movies->have_posts()) {
			$movies->the_post();


			// custom fields values

			$shrocode_movie_title = get_post_custom_values('movie_title');
			$shrocode_movie_image = get_post_custom_values('poster');





			$output .= '<div class="movie-col">';
			$output .= '<img class="feat-image" src="' . $shrocode_movie_image[0] . '"';
			$output .= '<h5 class="movie-title">' . $shrocode_movie_title[0] . '</h5><br>';
			$output .= '<a href="' . get_permalink() . '">View Details</a>';
			$output .= '</div>';
		}
		$output .= '</div>';

		// Clear Float
		$output .= '<div style="clear:both"></div>';

		// Reset Post Data
		wp_reset_postdata();

		// Pagination
		if ($movies->max_num_pages > 1 && is_page()) {
			$output .= '<nav class="prev-next-posts">';
			$output .= '<div class="nav-previous">';
			$output .= get_next_posts_link(__('<span class="meta-nav">&larr;</span> Previous'), $movies->max_num_pages);
			$output .= '</div>';

			$output .= '<div class="next-posts-link">';
			$output .= get_previous_posts_link(__('<span class="meta-nav">&rarr;</span> Next'));
			$output .= '</div>';
			$output .= '</nav';
		}

		return $output;
	} else {
		return '<p>No Movies Found</p>';
	}
}

add_shortcode('movies', 'ml_list_movies');