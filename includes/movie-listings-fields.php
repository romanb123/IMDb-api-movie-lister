<?php
function ml_add_fields_metabox()
{
	add_meta_box(
		'ml_listing_info',
		__('Listing Info'),
		'ml_add_fields_callback',
		'movie_listing',
		'normal',
		'default'
	);
}

add_action('add_meta_boxes', 'ml_add_fields_metabox');

function ml_add_fields_callback($post)
{
	wp_nonce_field(basename(__FILE__), 'ml_movie_listings_nonce');
	$ml_stored_meta = get_post_meta($post->ID);
?>


	<button id="<?php echo get_the_ID(); ?>" class="update_data_button">Get data from OMDb</button>

	<div class="wrap movie-listing-form">

		<!-- 1. title -->
		<div class="form-group">
			<label for="movie_title"><?php esc_html_e(' Movie Title', 'ml-domain'); ?></label>
			<input type="text" name="movie_title" id="movie_title" value="<?php if (!empty($ml_stored_meta['movie_title'])) echo esc_attr($ml_stored_meta['movie_title'][0]); ?>">

		</div>



		<!-- 2. Release date -->
		<div class="form-group">
			<label for="release_date"><?php esc_html_e('Release date', 'ml-domain'); ?></label>
			<input type="text" name="release_date" id="release_date" value="<?php if (!empty($ml_stored_meta['release_date'])) echo esc_attr($ml_stored_meta['release_date'][0]); ?>">

		</div>
		<!-- 3. Poster -->
		<div class="form-group">
			<label for="poster"><?php esc_html_e('Poster', 'ml-domain'); ?></label>
			<input type="text" name="poster" id="poster" value="<?php if (!empty($ml_stored_meta['poster'])) echo esc_attr($ml_stored_meta['poster'][0]); ?>">

		</div>
		<!-- 4. Director -->
		<div class="form-group">
			<label for="director"><?php esc_html_e('Director', 'ml-domain'); ?></label>
			<input type="text" name="director" id="director" value="<?php if (!empty($ml_stored_meta['director'])) echo esc_attr($ml_stored_meta['director'][0]); ?>">

		</div>
		<!-- 5. Runtime -->
		<div class="form-group">
			<label for="runtime"><?php esc_html_e('Runtime', 'ml-domain'); ?></label>
			<input type="text" name="runtime" id="runtime" value="<?php if (!empty($ml_stored_meta['runtime'])) echo esc_attr($ml_stored_meta['runtime'][0]); ?>">

		</div>

		<!-- 6. Actors -->
		<div class="form-group">
			<label for="actors"><?php esc_html_e('Actors', 'ml-domain'); ?></label>
			<input type="text" name="actors" id="actors" value="<?php if (!empty($ml_stored_meta['actors'])) echo esc_attr($ml_stored_meta['actors'][0]); ?>">

		</div>





	</div>
<?php
}

function ml_meta_save($post_id)
{
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['ml_movie_listings_nonce']) && wp_verify_nonce($_POST['ml_movie_listings_nonce'], basename(__FILE__))) ? 'true' :  'false';

	if ($is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}



	if ($_POST['movie_title']) {
		update_post_meta($post_id, 'movie_title', sanitize_text_field($_POST['movie_title']));
	}
	if ($_POST['release_date']) {
		update_post_meta($post_id, 'release_date', sanitize_text_field($_POST['release_date']));
	}

	if ($_POST['poster']) {
		update_post_meta($post_id, 'poster', sanitize_text_field($_POST['poster']));
	}

	if ($_POST['director']) {
		update_post_meta($post_id, 'director', sanitize_text_field($_POST['director']));
	}

	if ($_POST['runtime']) {
		update_post_meta($post_id, 'runtime', sanitize_text_field($_POST['runtime']));
	}

	if ($_POST['actors']) {
		update_post_meta($post_id, 'actors', sanitize_text_field($_POST['actors']));
	}
}

add_action('save_post', 'ml_meta_save');

?>