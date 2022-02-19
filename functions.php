<?php

/**
 * Plugin Name: Movie Library
 * Description: Create a Movie library with full user control.
 * Author: Roman 
 **/



// prevent direct acsess


if (!defined('ABSPATH')) {
    exit;
}

// scripts


require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-scripts.php');



// includes

require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-cpt.php');
// require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-settings.php');
require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-fields.php');
// require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-reorder.php');


// shortcodes

require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-shortcodes.php');