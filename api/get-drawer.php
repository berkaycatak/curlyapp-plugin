<?php

function cr_get_drawer()
{
    global $wpdb;

    $settings       = array();
    $pages          = array();
    $categories     = array();
    $social         = array();

    $git_settings    = $wpdb->prefix . "curlyapp_settings";
    $git_pages       = $wpdb->prefix . "curlyapp_pages";
    $git_categories  = $wpdb->prefix . "curlyapp_categories";
    $git_social      = $wpdb->prefix . "curlyapp_social";

    $get_settings = $wpdb->get_results("SELECT * FROM  {$git_settings} WHERE id = 1");
    foreach ($get_settings as $settings_f) {
        $settings[] = array(
            "app_name" => $settings_f->app_name,
            "logo_url" => $settings_f->logo_url,
            "post_style" => $settings_f->post_style
        );
    }

    $get_categories = $wpdb->get_results("SELECT * FROM  {$git_categories}");
    foreach ($get_categories as $category_f) {
        $categories[] = array(
            "category_id" => $category_f->category_id,
            "category_name" => get_cat_name($category_f->category_id),
        );
    }


    $get_pages = $wpdb->get_results("SELECT * FROM  {$git_pages}");
    foreach ($get_pages as $page) {
        $pages[] = array(
            "title" => get_the_title($page->page_id),
            "content" => get_post($page->page_id)->post_content,
            "imæge" => wp_get_attachment_url( get_post_thumbnail_id($page->page_id), 'thumbnail' ) == false ? "none" : wp_get_attachment_url( get_post_thumbnail_id($page->page_id), 'thumbnail' )
        );
    }

    $get_social = $wpdb->get_results("SELECT * FROM  {$git_social} WHERE id = 1");
    foreach ($get_social as $social_f) {
        $social[] = array(
            "instagram" => $social_f->instagram == "" ? "none" : $social_f->instagram,
            "twitter"   => $social_f->twitter == "" ? "none" : $social_f->twitter,
            "facebook"  => $social_f->facebook == "" ? "none" : $social_f->facebook,
            "pinterest" => $social_f->pinterest == "" ? "none" : $social_f->pinterest,
        );
    }


    wp_reset_postdata();

    return array($settings, $pages, $categories, $social);

}