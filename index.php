<?php
/*
Plugin Name: My first plugin
*/
require_once 'MainPage.php';

add_action('admin_menu', 'create_custom_panel');
function create_custom_panel() {
    add_menu_page('menu page', 'Add data', 'manage_options', 'custom-panel', 'custom_panel');
}


