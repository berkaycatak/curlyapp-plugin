<?php


function cr_get_posts() {
    global $wpdb;

    $git = $wpdb->prefix."mobilAppSettings";
    $settingsAnaCek = $wpdb->get_results("SELECT * FROM  {$git} WHERE id = 1" );
    foreach ($settingsAnaCek as $listele) {
        $settings[] = array(
            'id' =>  $listele->id,
            'app_name' => $listele->uygAdi,
            'logo_url' => $listele->logourl,
            'post_style' => $listele->postStil
        );
        $id = $listele->id;
        $uygAdi = $listele->uygAdi;
        $logourl = $listele->logourl;
        $postStil = $listele->postStil;
    }

    $git = $wpdb->prefix."mobilAppKategoriAyarSettings";
    $data = $wpdb->get_results("SELECT * FROM  {$git}" );

    if ( $data ){

        # code...
        $args_query = array(
            'order'          => 'DESC',
            'cat'            => $data[0]->manset, // Buraya kategori ID si
            'posts_per_page' => 3, // Burayı unutmuşuz. Çekilecek yazı adeti
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
            'cat'            => $data[0]->mansetAlt, // Buraya kategori ID si
            'posts_per_page' => 3, // Burayı unutmuşuz. Çekilecek yazı adeti
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
                    'url' => $url, //
                    'title' => $title, //
                    'postStil' => $postStil, //
                    'logourl' => $logourl, //
                    'icerik' => $icerik, //
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
            'cat'            => $data[0]->hikayeBuyuk, // Buraya kategori ID si
            'posts_per_page' => 3, // Burayı unutmuşuz. Çekilecek yazı adeti
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
                    'logourl' => $logourl, //
                    'postStil' => $postStil, //
                    'icerik' => $icerik, //
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
            'cat'            => $data[0]->hikayeAlt, // Buraya kategori ID si
            'posts_per_page' => 3, // Burayı unutmuşuz. Çekilecek yazı adeti
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
                    'id' =>  $icerik_id,
                    'url' => $url, //
                    'title' => $title, //
                    'logourl' => $logourl, //
                    'postStil' => $postStil, //
                    'icerik' => $icerik, //
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
