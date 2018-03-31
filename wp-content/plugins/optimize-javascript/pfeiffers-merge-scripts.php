<?php
/**
 * Plugin Name: Minify Javascript
 * Description: Minify and Optimize your Javascript by clicking one button and place it in the footer or header.
 * Version: 3.0
 * Author: peterpfeiffer
 */
 
// Helper for shared function used by backend and frontend
require_once 'includes/pfeiffersms-config.php';

// Notice manager
require_once 'includes/pfeiffersms-admin-notices.php';
require_once 'includes/pfeiffersms-admin.php';
new pfeiffersms_Admin();

// ADMIN BAR
require_once 'includes/pfeiffersms-admin-bar.php';
$merge = new pfeiffersms_Admin_Bar();
$merge->init();

// FRONT (MERGE SCRIPTS)
require_once 'includes/pfeiffersms-front.php';
$merge = new pfeiffersms_Front();
$merge->init();
?>