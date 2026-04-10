<?php
/**
 * Single post
 */

get_header(); ?>

    <main class="main-content">
        <div class="container">

            <div class="single-layout">

                <!-- CONTENT -->
                <div class="single-content">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <article <?php post_class('entry'); ?>>

                            <header class="entry__header">

                                <h1 class="entry__title">
									<?php the_title(); ?>
                                </h1>

                                <div class="entry__meta">
									<?php printf(
										esc_html__('Written by %1$s on %2$s', 'theme'),
										get_the_author_posts_link(),
										get_the_date()
									); ?>
                                </div>

                            </header>

							<?php if (has_post_thumbnail()) : ?>
                                <div class="entry__thumb">
									<?php the_post_thumbnail('large'); ?>
                                </div>
							<?php endif; ?>

                            <div class="entry__content">
								<?php the_content(); ?>
                            </div>

                            <footer class="entry__footer">

                                <div class="entry__categories">
									<?php esc_html_e('Posted in:', 'theme'); ?>
									<?php the_category(', '); ?>
                                </div>

                            </footer>

                        </article>

						<?php comments_template(); ?>

					<?php endwhile; endif; ?>

                </div>

                <!-- SIDEBAR -->
                <aside class="single-sidebar">
					<?php get_sidebar('right'); ?>
                </aside>

            </div>

        </div>
    </main>

<?php get_footer(); ?>