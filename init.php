<?php

//lib
require_once __DIR__ . '/lib/add-menu-items.php';

//pages
require_once __DIR__ . "/pages/main.php";
require_once __DIR__ . "/pages/general-settings.php";
require_once __DIR__ . "/pages/social-media-settings.php";
require_once __DIR__ . "/pages/categories-settings.php";
require_once __DIR__ . "/pages/pages-settings.php";
require_once __DIR__ . "/pages/home-settings.php";

//assets
if (!file_exists("api"))
{
    //echo '<link rel="stylesheet" href="/wp-content/plugins/CurlyApp/assets/css/style.css">';
    //echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
}

// api
require_once __DIR__ . "/api/home-page.php";
require_once __DIR__ . "/api/get-category-posts.php";
require_once __DIR__ . "/api/get-drawer.php";

//database
require_once __DIR__ . '/lib/create-tables.php';
?>
