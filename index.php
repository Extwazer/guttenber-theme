<?php
/**
 * Index (fallback)
 */

get_header(); ?>

    <main class="main-content">
        <div class="container">

            <div class="archive-layout">

                <div class="archive-content">

					<?php if (have_posts()) : ?>

                        <div class="posts-list">
							<?php while (have_posts()) : the_post(); ?>
								<?php get_template_part('parts/loop', 'post'); ?>
							<?php endwhile; ?>
                        </div>

						<?php the_posts_pagination([
							'mid_size'  => 1,
							'prev_text' => '←',
							'next_text' => '→',
						]); ?>

					<?php else : ?>

                        <p><?php esc_html_e('No content found.', 'theme'); ?></p>

					<?php endif; ?>

                </div>

                <aside class="archive-sidebar">
					<?php get_sidebar('right'); ?>
                </aside>

            </div>

        </div>
    </main>

<?php get_footer(); ?>