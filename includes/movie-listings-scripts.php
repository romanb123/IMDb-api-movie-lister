<?php

// Add Admin Scripts
function ml_add_admin_scripts()
{
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('ml-style', plugins_url() . '/Move-Library-Plugin/css/style-admin.css');
	wp_register_script('ajaxcalls', plugins_url() . '/Move-Library-Plugin/javascript/ajax-calls.js', array(), '1.0.0', true);


	wp_localize_script('ajaxcalls', 'ajax_object', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'ajaxnonce' => wp_create_nonce('ajax_post_validation')
	));
	wp_enqueue_script('ajaxcalls', plugins_url() . '/Move-Library-Plugin/javascript/ajax-calls.js', array(), '1.0.0', true);

	// wp_enqueue_script('ml-script', plugins_url() . '/Move-Library-Plugin/javascript/ajax-calls.js', array('jquery', 'jquery-ui-sortable'));
}

add_action('admin_init', 'ml_add_admin_scripts');


// Add Scripts
function ml_add_scripts()
{
	wp_enqueue_style('ml-style', plugins_url() . '/Move-Library-Plugin/css/style.css');
	// wp_enqueue_script('ml-script', plugins_url() . '/Move-Library-Plugin/javascript/ajax-calls.js', array('jquery'));
}



add_action('wp_enqueue_scripts', 'ml_add_scripts');

function custom_update_post()
{
	$post_id = $_POST['post_id'];



	update_post_meta($post_id, 'movie_title', $_POST['movie_title']);
	update_post_meta($post_id, 'runtime', $_POST['runtime']);
	update_post_meta($post_id, 'release_date', $_POST['release_date']);
	update_post_meta($post_id, 'poster', $_POST['poster']);
	update_post_meta($post_id, 'director', $_POST['director']);
	update_post_meta($post_id, 'runtime', $_POST['runtime']);
	update_post_meta($post_id, 'actors', $_POST['actors']);
	wp_die();
}

add_action('wp_ajax_custom_update_post', 'custom_update_post');