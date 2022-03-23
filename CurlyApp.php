<?php

/*
Plugin Name: CurlyApp
Plugin URI: https://github.com/berkaycatak/curlyapp-plugin/
Description: Wordpress plugin required for CurlyApp to work
Version: 1.0
Author: Berkay Çatak
Author URI: http://berkaycatak.com
License: A "Slug" license name e.g. GPL2
*/

// init dosyası import ediliyor
require_once __DIR__ . "/init.php";

// gerekli tablolar oluşturuluyor
create_tables();

add_action( 'rest_api_init', 'add_thumbnail_to_JSON' );
add_action( 'rest_api_init', 'add_posts_api' );
add_action( 'rest_api_init', 'add_category_posts_api' );
add_action( 'rest_api_init', 'add_drawer_api' );

function add_thumbnail_to_JSON() {
//Add featured image
    register_rest_field(
        ['post', 'search'], // Where to add the field (Here, blog posts. Could be an array)
        'featured_image_src', // Name of new field (You can call this anything)
        array(
            'get_callback'    => 'get_image_src',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}


function get_image_src( $object, $field_name, $request ) {
    $feat_img_array = wp_get_attachment_image_src(
        $object['featured_media'], // Image attachment ID
        'thumbnail',  // Size.  Ex. "thumbnail", "large", "full", etc..
        true // Whether the image should be treated as an icon.
    );
    return $feat_img_array[0];
}

function add_posts_api() {
    register_rest_route( 'curlyapp/v1', '/posts', array(
        'methods'  => WP_REST_Server::READABLE,
        'callback' => 'cr_get_posts',
        'args'     => array(),
    ) );
}

function add_category_posts_api() {
    register_rest_route( 'curlyapp/v1', '/category-posts', array(
        'methods'  => WP_REST_Server::READABLE,
        'callback' => 'cr_get_category_posts',
        'args'     => array(),
    ) );
}

function add_drawer_api() {
    register_rest_route( 'curlyapp/v1', '/drawer', array(
        'methods'  => WP_REST_Server::READABLE,
        'callback' => 'cr_get_drawer',
        'args'     => array(),
    ) );
}