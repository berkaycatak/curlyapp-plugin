<?php

add_action("admin_menu","curlyApp_add_menu");
function curlyApp_add_menu(){

    add_menu_page( 'CurlyApp', 'CurlyApp', 'manage_options', 'curly-main', 'main_page_content');
    add_submenu_page( 'curly-main', 'Genel', 'Genel', 'manage_options', 'curly-general', 'general_settings_page_content' );

}

