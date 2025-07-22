<?php
/**
 * Página de espacio: foto.
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-taxonomy-gama taxonomy-gama-texto-superpuesto-foto">

	<?php
	$bg_texto_superpuesto = '';
	if ( get_field( 'imagen_de_fondo_texto_superpuesto', $tax_fields ) ) {
		$bg_texto_superpuesto = ' style="background-image: url(' . get_field( 'imagen_de_fondo_texto_superpuesto', $tax_fields ) . ');" ';
	}
	?>

	<div class="container-custom" <?php echo $bg_texto_superpuesto; //phpcs:ignore ?>>		
		<div class="div-flotante">			
			<div class="titulo">
				<?php the_field( 'titulo_texto_superpuesto', $tax_fields ); ?>
			</div>
			<div class="descripcion">
				<?php the_field( 'descripcion_texto_superpuesto', $tax_fields ); ?>
			</div>
		</div>
	</div>
</div>
