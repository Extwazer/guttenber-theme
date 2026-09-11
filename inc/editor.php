<?php

function theme_enqueue_block_editor_assets() {

	$theme_path = get_template_directory();
	$theme_uri  = get_template_directory_uri();

	$editor_js = '/assets/dist/editor/index.js';

	if (file_exists($theme_path . $editor_js)) {
		wp_enqueue_script(
			'theme-editor',
			$theme_uri . $editor_js,
			['wp-blocks', 'wp-block-editor', 'wp-element', 'wp-components', 'wp-compose', 'wp-hooks', 'wp-i18n'],
			filemtime($theme_path . $editor_js),
			true
		);
	}
}

add_action('enqueue_block_editor_assets', 'theme_enqueue_block_editor_assets');

/**
 * Wrap core blocks that support the custom "visibility" attribute
 * with a class that hides them on mobile/desktop via CSS.
 */
function theme_apply_block_visibility($block_content, $block) {

	$supported_blocks = ['core/spacer'];

	if (!in_array($block['blockName'] ?? '', $supported_blocks, true)) {
		return $block_content;
	}

	$visibility = $block['attrs']['visibility'] ?? '';

	if (!$visibility) {
		return $block_content;
	}

	return '<div class="' . esc_attr($visibility) . '">' . $block_content . '</div>';
}

add_filter('render_block', 'theme_apply_block_visibility', 10, 2);
