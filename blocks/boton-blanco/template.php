<?php
/**
 * Bloque Boton.
 *
 * @package materialwp
 */

$enlace        = get_field( 'enlace' );

?>

<div class="bloque bloque-mapa-puntos-de-venta">


	<div class="row align-items-center">		
		<div class="col-xl-12 der">
			<div class="der-content">
				<?php echo get_field( 'texto' ); ?>
				<?php if ( $enlace ) : ?>
				<div class="boton-cupa-granate">
					<a href="<?php echo esc_url( $enlace['url'] ); ?>">
						<?php echo esc_html( $enlace['title'] ); ?>
						<span class="arrow-btn"></span>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>


	</div>	
</div>
