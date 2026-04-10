<?php

function theme_widgets_init() {

	register_sidebar([
		'id'            => 'sidebar-right',
		'name'          => __('Sidebar Right'),
		'description'   => __('Right sidebar'),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget__title">',
		'after_title'   => '</h5>',
	]);

}

add_action('widgets_init', 'theme_widgets_init');