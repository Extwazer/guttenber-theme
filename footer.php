<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
    <div class="container">
        <div class="footer__inner">

            <!-- LOGO -->
            <div class="footer__logo">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
						<?php bloginfo('name'); ?>
                    </a>
				<?php endif; ?>
            </div>

            <!-- MENU -->
			<?php if ( has_nav_menu('footer-menu') ) : ?>
                <nav class="footer__nav">
					<?php
					wp_nav_menu([
						'theme_location' => 'footer-menu',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'depth'          => 1
					]);
					?>
                </nav>
			<?php endif; ?>

        </div>
    </div>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
