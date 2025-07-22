<?php
/**
 * Doble CTA de producto
 *
 * @package materialwp
 */

$texto_cta_1       = get_field( 'texto_prefooter_productos', 'options' );
$texto_boton_cta_1 = get_field( 'texto_boton_prefooter_productos', 'options' );

if ( has_term( array( 27 ), 'gama', get_the_ID() ) ) {
	$texto_cta_2        = get_field( 'texto_prefooter_productos_cta2', 'options' );
	$texto_boton_cta_2  = get_field( 'texto_boton_prefooter_productos_cta2', 'options' );
	$enlace_boton_cta_2 = get_field( 'enlace_boton_prefooter_productos_cta2', 'options' );
} else {
	$texto_cta_2        = get_field( 'texto_prefooter_productos_cta2_contacto', 'options' );
	$texto_boton_cta_2  = get_field( 'texto_boton_prefooter_productos_cta2_contacto', 'options' );
	$enlace_boton_cta_2 = get_field( 'enlace_boton_prefooter_productos_cta2_contacto', 'options' );
}

$prod_slug = get_option( 'cupa_cpt_productos' );
if ( ! $prod_slug ) {
	$prod_slug = 'productos';
}

$enlace_boton_cta_1 = '/' . $prod_slug . '/';

?>

<div class="bloque bloque-single-productos prefooter doble-cta <?php echo esc_attr( $block['className'] ); ?>">

	<div class="container-fluid p-0">		
		<div class="row">
			<div class="col-12 arriba">
				<div class="div-cta-2">
					<h2><?php echo $texto_cta_2; //phpcs:ignore ?></h2>
					<div class="boton-cupa-blanco">
						<a href="<?php echo esc_url( $enlace_boton_cta_2['url'] ); ?>" target="<?php echo esc_attr( $enlace_boton_cta_2['target'] ); ?>">
							<?php echo $texto_boton_cta_2; //phpcs:ignore ?>
							<span class="arrow-btn"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-custom p-0">
		<div class="row">
			<div class="col-12 abajo">
				<div class="div-cta-1">
					<div class="col-md-9 col-sm-12">
						<h2><?php echo $texto_cta_1; //phpcs:ignore ?></h2>
					</div>
					<div class="boton-cupa-blanco" style="margin-right:25px">
						<a href="<?php echo esc_url( $enlace_boton_cta_1 ); ?>">
							<?php echo $texto_boton_cta_1; //phpcs:ignore ?>
							<span class="arrow-btn"></span>
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
