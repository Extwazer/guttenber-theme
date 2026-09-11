<?php

// Remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Clean up <head>
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');

// Remove comments feed
add_filter('feed_links_show_comments_feed', '__return_false');
add_filter('post_comments_feed_link', '__return_null');

// Remove #more
add_filter('the_content_more_link', function ($link) {
	return preg_replace('/#more-\d+/', '', $link);
});

// Limit revisions
add_filter('wp_revisions_to_keep', fn() => 10);


function theme_youtube_embed( $html, $url, $args ) {

	if ( strpos( $html, 'youtube.com/embed/' ) !== false ) {

		preg_match( '|embed/(.*)\?|', $html, $match );

		$id = $match[1] ?? '';

		$html = str_replace(
			'?feature=oembed',
			"?feature=oembed&enablejsapi=1&autoplay=1&mute=1&loop=1&playlist=$id",
			$html
		);
	}

	return $html;
}

add_filter( 'oembed_result', 'theme_youtube_embed', 10, 3 );