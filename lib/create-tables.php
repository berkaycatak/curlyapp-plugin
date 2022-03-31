<?php
function create_tables()
{
    global $wpdb;
    if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}curlyapp_settings'") != $wpdb->prefix . 'curlyapp_settings') {
        $wpdb->query("CREATE TABLE {$wpdb->prefix}curlyapp_settings(
            id INT NOT NULL AUTO_INCREMENT,
            app_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
            logo_url TEXT CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
            post_style INT NOT NULL,
            cloud_messaging_server_key TEXT NULL,
            PRIMARY KEY (id)
        );");

        $wpdb->insert("{$wpdb->prefix}curlyapp_settings", array("app_name" => 'CurlyApp', "logo_url" => '', "style_id" => '1'));

    }

    if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}curlyapp_social'") != $wpdb->prefix . 'curlyapp_social') {
        $wpdb->query("CREATE TABLE {$wpdb->prefix}curlyapp_social(
            id INT NOT NULL AUTO_INCREMENT,
            instagram VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
            twitter VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
            pinterest VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
            facebook VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
            PRIMARY KEY (id)
        );");

        $wpdb->insert("{$wpdb->prefix}curlyapp_social", array(
            "instagram" => '',
            "twitter" => '',
            "pinterest" => '',
            "facebook" => ''
        ));

    }

    if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}curlyapp_categories'") != $wpdb->prefix . 'curlyapp_categories') {
        $wpdb->query("CREATE TABLE {$wpdb->prefix}curlyapp_categories(
            id INT NOT NULL AUTO_INCREMENT,
            category_id INT NOT NULL,
            PRIMARY KEY (id)
        );");
    }

    if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}curlyapp_pages'") != $wpdb->prefix . 'curlyapp_pages') {
        $wpdb->query("CREATE TABLE {$wpdb->prefix}curlyapp_pages(
            id INT NOT NULL AUTO_INCREMENT,
            page_id INT NOT NULL,
            PRIMARY KEY (id)
        );");
    }

    if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}curlyapp_category_settings'") != $wpdb->prefix . 'curlyapp_category_settings') {
        $wpdb->query("CREATE TABLE {$wpdb->prefix}curlyapp_category_settings(
            id INT NOT NULL AUTO_INCREMENT,
            manset INT NOT NULL,
            mansetAlt INT NOT NULL,
            hikayeBuyuk INT NOT NULL,
            hikayeAlt INT NOT NULL,
            PRIMARY KEY (id)
	    );");

        $wpdb->insert("{$wpdb->prefix}curlyapp_category_settings", array(
            "manset" => '',
            "mansetAlt" => '',
            "hikayeBuyuk" => '',
            "hikayeAlt" => ''
        ));

    }
}