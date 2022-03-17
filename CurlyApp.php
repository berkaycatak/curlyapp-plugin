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

global $wpdb;
require_once __DIR__ . "/init.php";
require_once __DIR__ . '/lib/menu.php';

add_action( 'rest_api_init', 'add_thumbnail_to_JSON' );
add_action( 'rest_api_init', 'add_posts_api' );

function add_thumbnail_to_JSON() {
//Add featured image
    register_rest_field(
        'post', // Where to add the field (Here, blog posts. Could be an array)
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

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}mobilAppSettings'") != $wpdb->prefix . 'mobilAppSettings') {
    $wpdb->query("CREATE TABLE {$wpdb->prefix}mobilAppSettings(
		id INT NOT NULL AUTO_INCREMENT,
		uygAdi VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
		logourl TEXT CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
		postStil INT NOT NULL,
		PRIMARY KEY (id)
	);");

    $wpdb->insert("{$wpdb->prefix}mobilAppSettings", array("uygAdi" => '', "logourl" => ''));

}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}mobilAppSosyalMedyaSettings'") != $wpdb->prefix . 'mobilAppSosyalMedyaSettings') {
    $wpdb->query("CREATE TABLE {$wpdb->prefix}mobilAppSosyalMedyaSettings(
		id INT NOT NULL AUTO_INCREMENT,
		instagram VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
		twitter VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
		pinterest VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
		facebook VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
		PRIMARY KEY (id)
	);");

    $wpdb->insert("{$wpdb->prefix}mobilAppSosyalMedyaSettings", array(
        "instagram" => '',
        "twitter" => '',
        "pinterest" => '',
        "facebook" => ''
    ));

}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}mobilAppKategorilerSettings'") != $wpdb->prefix . 'mobilAppKategorilerSettings') {
    $wpdb->query("CREATE TABLE {$wpdb->prefix}mobilAppKategorilerSettings(
		id INT NOT NULL AUTO_INCREMENT,
		kategoriid INT NOT NULL,
		PRIMARY KEY (id)
	);");
}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}mobilAppSayfalarSettings'") != $wpdb->prefix . 'mobilAppSayfalarSettings') {
    $wpdb->query("CREATE TABLE {$wpdb->prefix}mobilAppSayfalarSettings(
		id INT NOT NULL AUTO_INCREMENT,
		sayfaid INT NOT NULL,
		PRIMARY KEY (id)
	);");
}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}mobilAppKategoriAyarSettings'") != $wpdb->prefix . 'mobilAppKategoriAyarSettings') {
    $wpdb->query("CREATE TABLE {$wpdb->prefix}mobilAppKategoriAyarSettings(
		id INT NOT NULL AUTO_INCREMENT,
		manset INT NOT NULL,
		mansetAlt INT NOT NULL,
		hikayeBuyuk INT NOT NULL,
		hikayeAlt INT NOT NULL,
		PRIMARY KEY (id)
	);");

    $wpdb->insert("{$wpdb->prefix}mobilAppKategoriAyarSettings", array(
        "manset" => '',
        "mansetAlt" => '',
        "hikayeBuyuk" => '',
        "hikayeAlt" => ''
    ));



}

