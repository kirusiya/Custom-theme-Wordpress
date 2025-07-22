
<!-- BLOQUE MODELOS BIM -->
<div class="bloque bloque-modelos-bim">

	<div class="container">
		
		<div class="row">
			
			<div class="col-md-9 izq">
				
				<div class="texto">
					
					<?php echo get_field( 'titulo' ); ?>

				</div>

			</div>

			<div class="col-md-3 der">

				<?php if( get_field( 'anadir_boton' ) ): ?>
				<div class="boton-cupa-granate">
					<a href="<?php echo get_field( 'enlace_boton' ); ?>">
						<?php echo get_field( 'texto_boton' ); ?>
						<span class="arrow-btn"></span>
					</a>
				</div>
				<?php endif; ?>
				
			</div>

		</div>

	</div>
	
</div>