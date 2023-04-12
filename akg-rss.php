<?php
/*
Plugin Name: AKG RSS
Plugin URI: https://amirkarimi.ir
Description: A simple plugin to display an RSS feed with a shortcode.
Version: 1.0
Author: Amir Karimi Garmsiri
Author URI: https://amirkarimi.ir
License: GPL2
*/

// Register the shortcode
function akg_rss_shortcode($atts) {
    $atts = shortcode_atts(array(
        'url' => ''
    ), $atts);

    // Fetch the RSS feed
    $rss = fetch_feed($atts['url']);

    if (is_wp_error($rss)) {
        return "Error fetching RSS feed: " . $rss->get_error_message();
    }

    // Output the feed
    $output = '<div class="akg-rss-plugin">';
    $output .= '<h2>' . $rss->get_title() . '</h2>';
    $output .= '<ul>';

    foreach ($rss->get_items() as $item) {
        $output .= '<li><a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a></li>';
    }

    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}
add_shortcode('akg_rss', 'akg_rss_shortcode');
