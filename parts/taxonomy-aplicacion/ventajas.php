
<?php

$ventajas = get_field( 'ventajas', $tax_fields );

if( $ventajas ) {

?>

<!-- VENTAJAS -->
<div class="bloque bloque-taxonomy-gama taxonomy-gama-ventajas">

	<div class="container-custom">
		
		<div class="row row-sup">
			
			<div class="col-12 col-md-6">
				
				<div class="titulo-sup">					
					<?php echo get_field( 'titulo_ventajas', $tax_fields ); ?>
				</div>

			</div>

			<div class="col-12 col-md-6 col-descripcion">
				
				<?php if( get_field( 'descripcion_ventajas', $tax_fields ) ): ?>
				<div class="descripcion">					
					<?php echo get_field( 'descripcion_ventajas', $tax_fields ); ?>
				</div>
				<?php endif; ?>

			</div>

		</div>

	</div>

	<div class="container-fluid">
		
		<div class="row">
		
			<div class="col-12">

				<div class="container-ventajas">
				
				<?php

				foreach( $ventajas as $IDVentaja ) {

					$imagen = get_the_post_thumbnail_url( $IDVentaja, 'thumbnail' );
					$titulo = get_the_title( $IDVentaja );
				?>

					<div class="ventaja">

						<div class="inner-ventaja">
						
							<div class="imagen">
								<img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" title="<?php echo $titulo; ?>">
							</div>

							<div class="titulo">
								<?php echo $titulo; ?>
							</div>

						</div>

					</div>

				<?php

				}

				?>

				</div>

			</div>

		</div>

	</div>

</div>

<?php
}
?>