<?php
/**
 * Search results
 */

get_header(); ?>

    <main class="main-content">
        <div class="container">

            <header class="archive-header">
                <h1 class="archive-title">
					<?php printf(
						esc_html__('Search results for: %s', 'theme'),
						'<span>' . esc_html(get_search_query()) . '</span>'
					); ?>
                </h1>

                <div class="search-form-wrapper">
					<?php get_search_form(); ?>
                </div>
            </header>

            <div class="archive-layout">

                <!-- CONTENT -->
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

                        <div class="search-empty">
                            <p>
								<?php esc_html_e(
									'Sorry, nothing matched your search. Try different keywords.',
									'theme'
								); ?>
                            </p>
                        </div>

					<?php endif; ?>

                </div>

                <!-- SIDEBAR -->
                <aside class="archive-sidebar">
					<?php get_sidebar('right'); ?>
                </aside>

            </div>

        </div>
    </main>

<?php get_footer(); ?>