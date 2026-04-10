<?php
/**
 * Theme functions
 */

// ==============================
// LOAD CORE FILES
// ==============================

$includes = [
	'inc/helpers.php',
	'inc/menu-walker.php',
	'inc/setup.php',
	'inc/assets.php',
	'inc/blocks.php',
	'inc/widgets.php',
	'inc/cleanup.php',
	'inc/admin.php',
	'inc/media.php',
	'inc/woocommerce.php',
	'inc/acf-placeholder.php',
];

foreach ($includes as $file) {
	$path = get_stylesheet_directory() . '/' . $file;

	if (file_exists($path)) {
		require_once $path;
	}
}

// ==============================
// CONSTANTS
// ==============================

define('IMAGE_PLACEHOLDER', get_stylesheet_directory_uri() . '/app/css/images/placeholder.jpg');