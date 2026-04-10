<?php

function theme_enqueue_assets() {

	$theme_path = get_template_directory();
	$theme_uri  = get_template_directory_uri();

	$main_css = '/assets/dist/global/main.css';
	$main_js  = '/assets/dist/global/main.js';

	if (file_exists($theme_path . $main_css)) {
		wp_enqueue_style(
			'theme-main',
			$theme_uri . $main_css,
			[],
			filemtime($theme_path . $main_css)
		);
	}

	if (file_exists($theme_path . $main_js)) {
		wp_enqueue_script(
			'theme-main',
			$theme_uri . $main_js,
			[],
			filemtime($theme_path . $main_js),
			true
		);
	}
}

add_action('wp_enqueue_scripts', 'theme_enqueue_assets');