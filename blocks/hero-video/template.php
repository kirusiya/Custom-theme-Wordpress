<?php
/**
 * Bloque Hero home video.
 *
 * @package materialwp
 */

$boton_cta = get_field( 'boton_cta' );
?>

<div class="bloque bloque-hero-home-video">
	<div class="container-fluid p-0">
		<div class="container-video">

			<?php
			if ( get_field( 'imagen' ) ) :
				echo wp_get_attachment_image( get_field( 'imagen' ), 'full' );
			elseif ( get_field( 'video_1' ) ) :
				?>
				<video id="video1" n="1" muted autoplay loop>
					<source src="<?php echo esc_url( get_field( 'video_1' ) ); ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<?php
			endif;
			?>

			<div class="velo"></div>

			<div class="textos">

				<?php if ( get_field( 'titulo' ) ) : ?>
				<h1><?php echo get_field( 'titulo' ); //phpcs:ignore ?></h1>
				<?php endif; ?>

				<?php if ( get_field( 'mostrar_cta' ) ) : ?>
				<div class="boton-cupa-blanco">
					<a href="<?php echo esc_url( $boton_cta['url'] ); ?>" target="<?php echo esc_attr( $boton_cta['target'] ); ?>">
						<?php echo esc_html( $boton_cta['title'] ); ?>
						<span class="arrow-btn"></span>
					</a>
				</div>
				<?php endif; ?>

			</div>

		</div>
	</div>
</div>
