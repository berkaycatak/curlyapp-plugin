<?php

function cr_get_category_posts()
{
    global $wpdb;
    $category_id = $_GET['category_id'];
    $page    = $_GET['page'];
    $post_count = 10;

    if (isset($_GET["page"]))
    {
        $post_count = ((($post_count % 10) + $page) * 10);
    }

    $git = $wpdb->prefix."curlyapp_settings";
    $get_settings = $wpdb->get_results("SELECT * FROM  {$git} WHERE id = 1" );
    foreach ($get_settings as $settings) {
        $logourl = $settings->logo_url;
        $postStil = $settings->post_style;
    }

    $args_query = array(
        'order'          => 'DESC',
        'cat'            => $category_id, // kategori ID si
        'posts_per_page' => 30, //Çekilecek yazı adeti
        'paged' => $page
    );
    $query = new WP_Query( $args_query );
    $manset = array();
    if( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            // Post bilgileri başlangıç
            $icerik_id = get_the_ID();
            $title = get_the_title();
            $url = get_permalink();
            $icerik = get_the_content();
            $yazi_gorseli_medium = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            $yazi_gorseli_normal = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            $tarih = get_the_date();
            $kategori_id = wp_get_post_categories( get_the_ID() ); // Array döndürür
            $kategori_adi = get_cat_name( $kategori_id[ 0 ] );
            $yazar_adi = get_the_author_meta( 'display_name' );
            $yazar_gorseli = get_avatar( get_the_author_meta( 'email' ), 100 ); // 100 değeri boyut. Gravatar dan çekilir.
            // Post bilgileri bitiş
            $manset[] = array(
                'id' =>  $icerik_id, //
                'title' => $title, //
                'url' => $url, //
                'logourl' => $logourl, //
                'postStil' => $postStil, //
                'icerik' => $icerik, //
                'thumbnail_small' => !$yazi_gorseli_medium ? get_site_url() . "/wp-content/plugins/CurlyApp/assets/img/image-not-found.jpeg" : $yazi_gorseli_medium, //
                'thumbnail_full' => !$yazi_gorseli_normal ? get_site_url() .  "/wp-content/plugins/CurlyApp/assets/img/image-not-found.jpeg" : $yazi_gorseli_normal, //
                'date' => $tarih, //
                'cat_id' => $kategori_id[0], //
                'cat_name' => $kategori_adi, //
                'author_name' => $yazar_adi, //
                'author_image' => $yazar_gorseli, //
            );
        }
    }
    $son[] = array(
        $manset,
    );

    return $manset;

}