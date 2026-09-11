<?php
/**
 * Bundled fallback copy of ACF PRO.
 *
 * Plugins load before the theme, so by the time this file runs, class_exists('ACF')
 * reliably tells us whether the ACF PRO plugin is already active — if so, it wins
 * and this bundled copy is skipped entirely.
 *
 * ACF computes its own asset URL via plugin_dir_url(__FILE__), which WordPress
 * always resolves relative to wp-content/plugins/ regardless of the file's real
 * location — so loaded from a theme, that URL is wrong and its CSS/JS/icons 404.
 * ACF_PATH (filesystem path, used for includes) doesn't have this problem — only
 * the browser-facing URL needs to be corrected.
 */

if ( ! class_exists( 'ACF' ) ) {
	include_once get_stylesheet_directory() . '/acf/acf.php';

	add_filter( 'acf/settings/url', function () {
		return get_stylesheet_directory_uri() . '/acf/';
	} );
}
