<?php
/**
 * Hero block
 */
?>
<div class="hero-block">
	<?php if ( have_rows( 'slides' ) ) : ?>
		<div class="swiper hero-block__slider">
			<div class="swiper-wrapper">
				<?php while ( have_rows( 'slides' ) ) : the_row(); ?>
					<div class="swiper-slide hero-block__slide" <?php bg( get_sub_field( 'image' ), 'large' ); ?>>
						<div class="hero-block__content">
							<?php if ( $title = get_sub_field( 'title' ) ) : ?>
								<h2 class="hero-block__title"><?php echo esc_html( $title ); ?></h2>
							<?php endif; ?>

							<?php if ( $text = get_sub_field( 'text' ) ) : ?>
								<p class="hero-block__text"><?php echo esc_html( $text ); ?></p>
							<?php endif; ?>

							<?php acf_link( get_sub_field( 'link' ), 'button button--primary hero-block__button' ); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="swiper-pagination"></div>
			<button class="swiper-button-prev" aria-label="<?php esc_attr_e( 'Previous slide', 'theme' ); ?>"></button>
			<button class="swiper-button-next" aria-label="<?php esc_attr_e( 'Next slide', 'theme' ); ?>"></button>
		</div>
	<?php endif; ?>
</div>
