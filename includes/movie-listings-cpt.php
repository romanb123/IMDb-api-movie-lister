<?php

// Create Movie Listing Post Type
function ml_register_movie_listing()
{
    $singular_name = apply_filters('ml_label_single', 'Movie Listing');
    $plural_name = apply_filters('ml_label_plural', 'Movie Listings');

    $labels = array(
        'name'                  => $plural_name,
        'singular_name'         => $singular_name,
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New ' . $singular_name,
        'edit'                  => 'Edit',
        'edit_item'             => 'Edit ' . $singular_name,
        'new_item'              => 'New ' . $singular_name,
        'view'                  => 'View',
        'view_item'             => 'View ' . $singular_name,
        'search_items'          => 'Search ' . $plural_name,
        'not_found'             => 'No ' . $plural_name . ' Found',
        'not_found_in_trash'    => 'No ' . $plural_name . ' Found',
        'parent_item_colon'     => 'Parent ' . $singular_name,
        'menu_name'             => $plural_name,
    );

    $args = apply_filters('ml_movie_listing_args', array(
        'labels'                => $labels,
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-video-alt2',
        'show_in_nav_menus'     => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'has_archive'           => true,
        'query_var'             => true,
        'can_export'            => true,
        'rewrite'               => true,
        'capability_type'       => 'post',
        'supports'              => array(
            'title',
            'thumbnail'
        )
    ));

    // Register The Movie Listing Post Type
    register_post_type('movie_listing', $args);
}

add_action('init', 'ml_register_movie_listing');





// Load Template
function ml_load_templates($template)
{
    if (get_query_var('post_type') == 'movie_listing') {
        $new_template = plugin_dir_path(__FILE__) . 'single-movie-listing.php';
        if ('' != $new_template) {
            return $new_template;
        }
    }

    return $template;
}

add_filter('template_include', 'ml_load_templates');