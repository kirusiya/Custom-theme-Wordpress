<?php
/**
 * Botón pedir presupuesto
 *
 * @package materialwp
 */

if ( is_post_type_archive( 'productos' ) ) {
	$btn_presu        = get_field( 'btn_presu_productos', 'options' );
	$btn_presu_tiempo = get_field( 'btn_presu_tiempo_productos', 'options' );
} elseif ( is_post_type_archive( 'proyectos' ) ) {
	$btn_presu        = get_field( 'btn_presu_proyectos', 'options' );
	$btn_presu_tiempo = get_field( 'btn_presu_tiempo_proyectos', 'options' );
} elseif ( is_home() ) {
	$btn_presu        = get_field( 'btn_presu_blog', 'options' );
	$btn_presu_tiempo = get_field( 'btn_presu_tiempo_blog', 'options' );
} elseif ( is_tax( 'galeria' ) ) {
	$btn_presu        = get_field( 'btn_presu_galeria', 'options' );
	$btn_presu_tiempo = get_field( 'btn_presu_tiempo_galeria', 'options' );
} elseif ( get_queried_object()->term_id ) {
	$tax_             = get_queried_object();
	$btn_presu        = get_field( 'btn_presu', 'term_' . $tax_->term_id );
	$btn_presu_tiempo = get_field( 'btn_presu_tiempo', 'term_' . $tax_->term_id );
} else {
	$btn_presu        = get_field( 'btn_presu' );
	$btn_presu_tiempo = get_field( 'btn_presu_tiempo' );
}

if ( $btn_presu ) :
	?>

	<a id="btn-presupuesto-fixed" class="oculto" href="<?php echo esc_url( get_field( 'pedir_presupuesto_pagina', 'options' ) ); ?>">
		<?php esc_html_e( 'Pide presupuesto', 'materialwp' ); ?>
		<span class="arrow-btn"></span>
	</a>

	<script>
	$( document ).ready( function() {
		setTimeout( function() {
			$( '#btn-presupuesto-fixed' ).removeClass( 'oculto' );
		}, <?php echo esc_html( $btn_presu_tiempo ); ?> );
	} );
	</script>

<?php endif; ?>
