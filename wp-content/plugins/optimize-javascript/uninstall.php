<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

require_once 'includes/pfeiffersms-config.php';
delete_option(pfeiffersMS_OPTION);
delete_option(pfeiffersMS_OPTION_NOTICE);
delete_option(pfeiffersMS_OPTION_VERSION);
?>