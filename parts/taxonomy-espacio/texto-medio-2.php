<?php
/**
 * Página de espacio: texto medio 2.
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-taxonomy-gama taxonomy-gama-texto-medio-2">
	<div class="container-custom">
		<div class="row">
			<div class="col-md-6 izq">				
				<div class="titulo">
					<?php the_field( 'titulo_texto_medio_2', $tax_fields ); ?>
				</div>
			</div>
			<div class="col-md-6 der">				
				<div class="descripcion">
					<?php the_field( 'descripcion_texto_medio_2', $tax_fields ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
