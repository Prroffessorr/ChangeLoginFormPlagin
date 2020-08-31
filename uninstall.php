<?php

if(!undefine('WP_UNINSTALL_PLUGIN')){
    die;
}

function pluginprefix_function_to_run()
{

}
register_uninstall_hook(__FILE__, 'pluginprefix_function_to_run');
