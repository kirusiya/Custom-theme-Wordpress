<?php
/**
 * Bloque Nosotros.
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-nosotros <?php echo esc_html( $block['className'] ); ?>">

	<div class="img-fondo" style="background-image: url(<?php echo esc_url( get_field( 'imagen' ) ); ?>);">
		<div class="container-custom">

			<div class="izq"></div>

			<div class="der">

				<?php if ( get_field( 'titulo' ) ) : ?>
				<div class="titulo">
					<?php echo get_field( 'titulo' ); //phpcs:ignore ?>
				</div>
				<?php endif; ?>

				<?php if ( get_field( 'subtitulo' ) ) : ?>
				<div class="subtitulo">
					<?php echo get_field( 'subtitulo' ); //phpcs:ignore ?>
				</div>
				<?php endif; ?>

			</div>

		</div>
	</div>

	<div class="container-custom">
		<div class="descripcion-dos-columnas" style="background-image: url(<?php echo esc_url( get_field( 'fondo' ) ); ?>);">

			<?php if ( get_field( 'descripcion' ) ) : ?>
			<div class="descripcion">
				<?php echo get_field( 'descripcion' ); //phpcs:ignore ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
