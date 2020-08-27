<?php
/*
Plugin Name: My first plugin
*/


function pluginprefix_setup_post_types()
{
    register_post_type('book', ['public'=>'true']);
}
add_action('init','pluginprefix_setup_post_types');

function admin_add_menu(){ 

    add_menu_page( 'My Page Title', 'My First Plugin', 'edit_others_posts', 'my_page_slug', 'my_page_function', '' ); 

}
 
add_action("admin_menu", "admin_add_menu");
 
function pluginprefix_install()
{
    pluginprefix_setup_post_types();
    admin_add_menu();
    flush_rewrite_rules();  
}

register_activation_hook(__FILE__, 'pluginprefix_install');

function pluginprefix_deactivation()
{
    flush_rewrite_rules();  
}
register_deactivation_hook(__FILE__, 'pluginprefix_deactivation');

