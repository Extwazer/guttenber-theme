<?php

/**
 * Output HTML markup of template with passed args
 *
 * @param string $file File name without extension (.php)
 * @param array $args Array with args ($key=>$value)
 * @param string $default_folder Requested file folder
 *
 * */
function show_template( $file, $args = null, $default_folder = 'parts' ) {
	echo return_template( $file, $args, $default_folder );
}

/**
 * Return HTML markup of template with passed args
 *
 * @param string $file File name without extension (.php)
 * @param array $args Array with args ($key=>$value)
 * @param string $default_folder Requested file folder
 *
 * @return string template HTML
 * */
function return_template( $file, $args = null, $default_folder = 'parts' ) {
	$file = $default_folder . '/' . $file . '.php';
	if ( $args ) {
		extract( $args );
	}
	if ( locate_template( $file ) ) {
		ob_start();
		include( locate_template( $file ) ); //Theme Check free. Child themes support.
		$template_content = ob_get_clean();

		return $template_content;
	}

	return '';
}

/**
 * Get Post Featured image
 *
 * @var int $id Post id
 * @var string $size = 'full' featured image size
 *
 * @return string Post featured image url
 * @author DimonPDAA
 */
function get_attached_img_url( $id = 0, $size = "medium_large" ) {
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );

	return $img[0];
}


/**
 * Output background image style
 *
 * @param array|string $img Image array or url
 * @param string $size Image size to retrieve
 * @param bool $echo Whether to output the the style tag or return it.
 *
 * @return string|void String when retrieving.
 */
function bg( $img = '', $size = '', $echo = true ) {

	if ( empty( $img ) ) {
		return false;
	}

	if ( is_array( $img ) ) {
		$url = $size ? $img['sizes'][$size] : $img['url'];
	} else {
		$url = $img;
	}

	$string = 'style="background-image: url(' . $url . ')"';

	if ( $echo ) {
		echo $string;
	} else {
		return $string;
	}
}

/**
 * Format phone number, trim all unnecessary characters
 *
 * @param string $string Phone number
 *
 * @return string Formatted phone number
 */
function sanitize_number( $string ) {
	return preg_replace( '/[^+\d]+/', '', $string );
}


/**
 * Return/Output SVG as html
 *
 * @param array|string $img Image link or array
 * @param string $class Additional class attribute for img tag
 * @param string $size Image size if $img is array
 *
 * @return void
 */
function display_svg( $img, $class = '', $size = 'medium' ) {
	echo return_svg( $img, $class, $size );
}

function return_svg( $img, $class = '', $size = 'medium' ) {
	if ( ! $img ) {
		return '';
	}

	$file_url = is_array( $img ) ? $img['url'] : $img;

	$file_info = pathinfo( $file_url );
	if ( $file_info['extension'] == 'svg' ) {
		$file_path         = convert_url_to_path( $file_url );

		if ( ! $file_path ) {
			return '';
		}

		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer"      => false,
				"verify_peer_name" => false,
			),
		);
		$image             = file_get_contents( $file_path, false, stream_context_create( $arrContextOptions ) );
		if ( $class ) {
			$image = str_replace( '<svg ', '<svg class="' . esc_attr( $class ) . '" ', $image );
		}
		$image = preg_replace('/^(.*)?(<svg.*<\/svg>)(.*)?$/is', '$2', $image);

	} elseif ( is_array( $img ) ) {
		$image = wp_get_attachment_image( $img['id'], $size, false, array( 'class' => $class ) );
	} else {
		$image = '<img class="' . esc_attr( $class ) . '" src="' . esc_url( $img ) . '" alt="' . esc_attr( $file_info['filename'] ) . '"/>';
	};

	return $image;
}

/**
 * Check if URL is YouTube or Vimeo video
 * @param string $url Link to video
 *
 * @return bool
 */
function is_embed_video( $url ) {
	if ( ! $url ) {
		return false;
	}

	$yt_pattern    = '#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#';
	$vimeo_pattern = '#^https?://(.+\.)?vimeo\.com/.*#';

	$is_vimeo   = ( preg_match( $vimeo_pattern, $url ) );
	$is_youtube = ( preg_match( $yt_pattern, $url ) );

	return ( $is_vimeo || $is_youtube );
}


/**
 * Show link from acf link field
 * @param $acf_link
 * @param string $class
 * @param array $atts
 */
function acf_link($acf_link, $class = '', $atts = array()){
    if(!$acf_link || !isset($acf_link['url'])){
        return;
    }
    $attr_str = '';
    if($atts){
        foreach ($atts as $k => $v){
            $attr_str .= esc_attr($k).'="'.esc_attr($v).'" ';
        }
    }
    ?>
    <a href="<?php echo esc_url($acf_link['url']); ?>" <?php echo $attr_str; ?> <?php echo $class ? 'class="' . esc_attr($class) . '"' : ''; ?> <?php echo !empty($acf_link['target']) ? 'target="' . esc_attr($acf_link['target']) . '"' : ''; ?>><?php echo esc_html($acf_link['title']); ?></a>
    <?php
}