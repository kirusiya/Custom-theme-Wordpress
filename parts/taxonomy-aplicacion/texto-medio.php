
<?php if( get_field( 'texto_medio', $tax_fields ) ): ?>
<!-- TEXTO MEDIO -->
<div class="bloque bloque-taxonomy-gama taxonomy-gama-texto-medio">

	<?php
	$bg_texto_medio = '';
	if( get_field( 'imagen_de_fondo_texto_medio', $tax_fields ) ):
		$bg_texto_medio = ' style="background-image: url('.get_field( 'imagen_de_fondo_texto_medio', $tax_fields ).');" ';
	endif;
	?>

	<div class="container-custom" <?php echo $bg_texto_medio; ?>>
		
		<div class="texto-medio">
			
			<?php the_field( 'texto_medio', $tax_fields ); ?>

		</div>

	</div>

</div>
<?php endif; ?>