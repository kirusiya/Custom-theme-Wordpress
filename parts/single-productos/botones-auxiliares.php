
<?php if( get_field( 'anadir_botones_auxiliares' ) ): ?>

<!-- BOTONES AUXILIARES -->
<div class="bloque bloque-single-productos subcabecera-productos botones-auxiliares">

	<div class="container-custom">
		
		<div class="row">
			
			<div class="col-md-12">

				<div class="botones">
				
				<?php

				if( have_rows('botones_auxiliares') ):

				 	while ( have_rows('botones_auxiliares') ) : the_row();

				        $texto 			= get_sub_field( 'texto_boton' );
				        $enlace 		= get_sub_field( 'enlace_boton' );
				        $nueva_pestana 	= ( get_sub_field( 'nueva_pestana' ) ) ? ' target="_blank" ' : '';
				?>

					<div class="boton-cupa-granate">
						<a href="<?php echo $enlace; ?>" <?php echo $nueva_pestana; ?>>
							<?php echo $texto; ?>
							<span class="arrow-btn"></span>
						</a>
					</div>

				<?php

				    endwhile;

				endif;

				?>

				</div>

			</div>

		</div>

	</div>
	
</div>

<?php endif; ?>