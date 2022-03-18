<?php

function cr_get_posts() {
    global $wpdb;

    $git = $wpdb->prefix."curlyapp_settings";
    $get_settings = $wpdb->get_results("SELECT * FROM  {$git} WHERE id = 1" );
    foreach ($get_settings as $settings_f) {
        $settings[] = array(
            'id' =>  $settings_f->id,
            'app_name' => $settings_f->app_name,
            'logo_url' => $settings_f->logo_url,
            'post_style' => $settings_f->post_style
        );
        $logo_url = $settings_f->logo_url;
        $post_style = $settings_f->post_style;
    }

    $git = $wpdb->prefix."curlyapp_category_settings";
    $data = $wpdb->get_results("SELECT * FROM  {$git}" );

    if ( $data ){
        $args_query = array(
            'order'          => 'DESC',
            'cat'            => $data[0]->manset, // Kategori ID si
            'posts_per_page' => 3, // Çekilecek yazı adeti
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
                    'logo_url' => $logo_url, //
                    'post_style' => $post_style, //
                    'content' => $icerik, //
                    'thumbnail_small' => $yazi_gorseli_medium, //
                    'thumbnail_full' => $yazi_gorseli_normal, //
                    'date' => $tarih, //
                    'cat_id' => $kategori_id, //
                    'cat_name' => $kategori_adi, //
                    'author_name' => $yazar_adi, //
                    'author_image' => $yazar_gorseli, //
                );
            }
        }

        $args_query = array(
            'order'          => 'DESC',
            'cat'            => $data[0]->mansetAlt, // Kategori ID si
            'posts_per_page' => 3, // Çekilecek yazı adeti
        );
        $query = new WP_Query( $args_query );
        $mansetalt = array();
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
                $mansetalt[] = array(
                    'id' =>  $icerik_id, //
                    'title' => $title, //
                    'url' => $url, //
                    'logo_url' => $logo_url, //
                    'post_style' => $post_style, //
                    'content' => $icerik, //
                    'thumbnail_small' => $yazi_gorseli_medium, //
                    'thumbnail_full' => $yazi_gorseli_normal, //
                    'date' => $tarih, //
                    'cat_id' => $kategori_id, //
                    'cat_name' => $kategori_adi, //
                    'author_name' => $yazar_adi, //
                    'author_image' => $yazar_gorseli, //
                );
            }
        }

        $args_query = array(
            'order'          => 'DESC',
            'cat'            => $data[0]->hikayeBuyuk, // Kategori ID si
            'posts_per_page' => 3, // Çekilecek yazı adeti
        );
        $query = new WP_Query( $args_query );
        $hikayeBuyuk = array();
        if( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                // Post bilgileri başlangıç
                $icerik_id = get_the_ID();
                $title = get_the_title();
                $icerik = get_the_content();
                $url = get_permalink();
                $yazi_gorseli_medium = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                $yazi_gorseli_normal = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                $tarih = get_the_date();
                $kategori_id = wp_get_post_categories( get_the_ID() ); // Array döndürür
                $kategori_adi = get_cat_name( $kategori_id[ 0 ] );
                $yazar_adi = get_the_author_meta( 'display_name' );
                $yazar_gorseli = get_avatar( get_the_author_meta( 'email' ), 100 ); // 100 değeri boyut. Gravatar dan çekilir.
                // Post bilgileri bitiş
                $hikayeBuyuk[] = array(
                    'id' =>  $icerik_id, //
                    'title' => $title, //
                    'url' => $url, //
                    'logo_url' => $logo_url, //
                    'post_style' => $post_style, //
                    'content' => $icerik, //
                    'thumbnail_small' => $yazi_gorseli_medium, //
                    'thumbnail_full' => $yazi_gorseli_normal, //
                    'date' => $tarih, //
                    'cat_id' => $kategori_id, //
                    'cat_name' => $kategori_adi, //
                    'author_name' => $yazar_adi, //
                    'author_image' => $yazar_gorseli, //
                );
            }
        }


        # code...
        $args_query = array(
            'order'          => 'DESC',
            'cat'            => $data[0]->hikayeAlt, // kategori ID si
            'posts_per_page' => 3, // Çekilecek yazı adeti
        );
        $query = new WP_Query( $args_query );
        $hikayeAlt = array();
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
                $hikayeAlt[] = array(
                    'id' =>  $icerik_id, //
                    'title' => $title, //
                    'url' => $url, //
                    'logo_url' => $logo_url, //
                    'post_style' => $post_style, //
                    'content' => $icerik, //
                    'thumbnail_small' => $yazi_gorseli_medium, //
                    'thumbnail_full' => $yazi_gorseli_normal, //
                    'date' => $tarih, //
                    'cat_id' => $kategori_id, //
                    'cat_name' => $kategori_adi, //
                    'author_name' => $yazar_adi, //
                    'author_image' => $yazar_gorseli, //
                );
            }
        }

    }

    wp_reset_postdata();

    $son[] = array(
        $manset,
        $mansetalt,
        $hikayeBuyuk,
        $hikayeAlt,
        $settings
    );
    return $son;
}
