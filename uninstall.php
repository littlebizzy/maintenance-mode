<?php
//Checking trigger for uninstall
if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

/**
 * Cleaning DB, removing options
 *
 * @since 1.0
*/
function mml_uninstall()
{
  delete_option('mml_enabled');
  delete_option('mml_mode');
}

mml_uninstall();
?>
