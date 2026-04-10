<?php


// Theme supports
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

add_theme_support( 'html5', [
	'comment-list',
	'search-form',
	'comment-form',
	'gallery',
	'caption',
	'script',
	'style'
] );

add_theme_support( 'custom-background', [
	'default-color' => 'fff'
] );

add_theme_support( 'custom-logo', [
	'height'      => 150,
	'flex-height' => true,
	'flex-width'  => true,
] );

// Menus
register_nav_menus( [
	'header-menu' => 'Header Menu',
	'footer-menu' => 'Footer Menu'
] );

// Excerpt for pages
add_post_type_support( 'page', 'excerpt' );

// WP 5.2 fallback
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}


add_filter('acf/settings/save_json', function () {
	return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
});