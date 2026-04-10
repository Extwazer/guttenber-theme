<?php
/**
 * Post Card
 */

$post_id = get_the_ID();
?>

<article <?php post_class('post-card'); ?>>

    <!-- IMAGE -->
	<?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="post-card__image">
			<?php the_post_thumbnail('large'); ?>
        </a>
	<?php endif; ?>

    <div class="post-card__content">



        <!-- TITLE -->
        <h3 class="post-card__title">
            <a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
            </a>
        </h3>

        <!-- EXCERPT -->
        <div class="post-card__excerpt">
			<?php the_excerpt(); ?>
        </div>

        <!-- META -->
        <div class="post-card__meta">

		    <?php
		    $category = get_the_category();
		    if (!empty($category)) : ?>
                <span class="post-card__category">
					<?php echo esc_html($category[0]->name); ?>
				</span>
		    <?php endif; ?>

            <span class="post-card__date">
				<?php echo get_the_date(); ?>
			</span>

        </div>

        <!-- READ MORE -->
        <a href="<?php the_permalink(); ?>" class="button button--primary post-card__button">
			<?php esc_html_e('Read more', 'theme'); ?>
        </a>

    </div>

</article>