<?php

function theme_register_blocks() {

	$blocks = glob(get_template_directory() . '/blocks/*');

	foreach ($blocks as $block) {
		if (file_exists($block . '/block.json')) {
			register_block_type($block);
		}
	}
}

add_action('init', 'theme_register_blocks');