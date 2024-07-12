<?php
function event_management_create_post_type() {
    register_post_type('event',
        array(
            'labels' => array(
                'name' => __('Events'),
                'singular_name' => __('Event')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'custom-fields'),
            'show_in_menu' => false, // This will hide the post type from the admin menu
        )
    );
}
add_action('init', 'event_management_create_post_type');

// Register Custom Post Type for Guests
function event_management_register_guests_cpt() {
    $args = array(
        'public' => true,
        'labels' => array(
            'name' => __('Guests'),
            'singular_name' => __('Guests')
        ),
        'supports' => array('title', 'editor', 'custom-fields'),
        'show_in_menu' => false, // Use a Dashicon for the menu
    );
    register_post_type('event_guests', $args);
}
add_action('init', 'event_management_register_guests_cpt');

// Add Meta Boxes for Guest Details

