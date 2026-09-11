<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Set up Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
	<!-- Remove Microsoft Edge's & Safari phone-email styling -->
	<meta name="format-detection" content="telephone=no,email=no,url=no">

	<!-- Add external fonts below (GoogleFonts / Typekit) -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap">

	<?php wp_head(); ?>
</head>

<body <?php body_class('no-outline'); ?>>
<?php wp_body_open(); ?>


<!-- BEGIN of header -->
<header class="header">
    <div class="container">
        <div class="header__inner">

            <!-- LOGO -->
            <div class="header__logo">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
						<?php bloginfo('name'); ?>
                    </a>
				<?php endif; ?>
            </div>

            <!-- BURGER -->
            <button class="header__burger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- MENU -->
            <nav class="header__nav">
				<?php
				wp_nav_menu([
					'theme_location' => 'header-menu',
					'menu_class'     => 'menu',
					'container'      => false,
					'walker'         => new Header_Menu_Walker(),
				]);
				?>
            </nav>

        </div>
    </div>
</header>
<!-- END of header -->
