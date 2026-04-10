<?php
/**
 * 404 template
 */

get_header(); ?>

    <section class="not-found">
        <div class="container">
            <div class="not-found__inner">

                <h1 class="not-found__title">
					<?php esc_html_e( '404 — Page not found', 'theme' ); ?>
                </h1>

                <p class="not-found__text">
					<?php esc_html_e( 'Looks like this page doesn’t exist or was moved.', 'theme' ); ?>
                </p>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button--primary">
					<?php esc_html_e( 'Go to homepage', 'theme' ); ?>
                </a>

            </div>
        </div>
    </section>

<?php get_footer(); ?>