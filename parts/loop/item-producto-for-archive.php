<?php
/**
 * Loop de producto.
 *
 * @package materialwp
 */

$imagen_url = wp_get_attachment_image_src( $imagen_producto, 'large', false );
?>

<div class="producto-<?php echo esc_html( $n ); ?>">
	<div class="inner">
		<a href="<?php echo esc_url( $enlace_producto ); ?>">
			<div class="imagen-producto">
				<img src="<?php echo esc_url( $imagen_url[0] ); ?>" alt="<?php echo esc_html( $titulo_producto ); ?>">
			</div>
			<div class="titulo-producto">
				<?php echo $titulo_producto; //phpcs:ignore ?>
			</div>
		</a>
	</div>
</div>
