<?php

add_action("admin_menu","curlyApp_add_menu");
function curlyApp_add_menu(){
    add_menu_page( 'CurlyApp', 'CurlyApp', 'manage_options', 'curly-main', 'main_page_content');
    add_submenu_page( 'curly-main', 'Genel Ayarlar', 'Genel', 'manage_options', 'curly-general', 'general_settings_page_content' );
    add_submenu_page( 'curly-main', 'Kategori Ayarları', 'Kategoriler', 'manage_options', 'curly-categories', 'categories_settings_page_content' );
    add_submenu_page( 'curly-main', 'Anasayfa Bölümler Ayarları', 'Anasayfa Bölümleri', 'manage_options', 'curly-home-settings', 'home_settings_page_content' );
    add_submenu_page( 'curly-main', 'Sosyal Medya Ayarları', 'Sosyal Medya', 'manage_options', 'curly-social', 'social_media_settings_page_content' );
    add_submenu_page( 'curly-main', 'Sayfa Ayarları', 'Sayfalar', 'manage_options', 'curly-pages', 'pages_settings_page_content' );
}

