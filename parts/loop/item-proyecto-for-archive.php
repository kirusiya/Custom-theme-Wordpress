<?php
/**
 * Loop de proyecto.
 *
 * @package materialwp
 */

?>

<div class="producto-<?php echo esc_html( $n ); ?>">
	<div class="inner">
		<a href="<?php echo esc_url( $enlace_producto ); ?>">
			<div class="imagen-producto">
				<img
					src="<?php echo esc_url( $imagen_producto ); ?>"
					alt="<?php echo esc_html( $titulo_producto ); ?>"
					title="<?php echo esc_html( $titulo_producto ); ?>">
			</div>
			<div class="titulo-producto" title="<?php echo esc_html( $titulo_producto ); ?>">
				<?php echo esc_html( $titulo_producto ); ?>
			</div>
		</a>
	</div>
</div>
