
<!-- DATOS PRODUCTO -->
<div class="bloque bloque-single-productos datos-producto">

	<div class="container-custom">

		<?php

		$gama 				= getTaxonomiesForProducts( get_the_ID(), 'gama', true );
		$espacio 			= getTaxonomiesForProducts( get_the_ID(), 'espacio', true );
		$origen 			= get_field( 'origen' );
		$aplicacion 		= getTaxonomiesForProducts( get_the_ID(), 'aplicacion', true );
		//$color_principal 	= get_field( 'color_principal' );
		$color_principal 	= getTaxonomiesForProducts( get_the_ID(), 'color', true );
		$acabado			= getTaxonomiesForProducts( get_the_ID(), 'acabado', true );
		$formato 			= get_field( 'formato' );
		$opciones			= get_field( 'opciones' );

		$ficha_tecnica 		= false;
		if( have_rows('ficha_tecnica') ):

			$tieneContenido = false;

			while ( have_rows('ficha_tecnica') ) : the_row();

				if ( get_sub_field( 'elemento' ) != "" ){
					$tieneContenido = true;
		        	$ficha_tecnica .= '<li>' .get_sub_field( 'elemento' ). '</li>';
		        }

		    endwhile;

		    if( $tieneContenido ){
		    	$ficha_tecnica = '<ul class="elementos">' .$ficha_tecnica. '</ul>';
		    }

		endif;

		?>

		<div class="row row1">

			<div class="contenido">
			
				<?php echo get_the_content(); ?>

			</div>

		</div>
		
		<div class="row row2">
			
			<div class="col-md-6 izq">
				
				<?php if( $gama ): ?>
				<div class="elemento gama">
					
					<div class="titulo">
						<?php _e( 'Gama:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo str_replace( '®', '<sup>®</sup>', $gama ); ?>
					</div>

				</div>
				<?php endif; ?>

				<?php if( $espacio ): ?>
				<div class="elemento espacio">
					
					<div class="titulo">
						<?php _e( 'Espacios:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $espacio; ?>
					</div>

				</div>
				<?php endif; ?>

			</div>

			<div class="col-md-6 der">
				
				<?php if( $origen ): ?>
				<div class="elemento origen">
					
					<div class="titulo">
						<?php _e( 'Origen:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $origen; ?>
					</div>

				</div>
				<?php endif; ?>

				<?php if( $aplicacion ): ?>
				<div class="elemento aplicacion">
					
					<div class="titulo">
						<?php _e( 'Aplicación:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $aplicacion; ?>
					</div>

				</div>
				<?php endif; ?>

			</div>

		</div>

		<div class="row row3">
			
			<div class="col-md-6 izq">
				
				<?php if( $color_principal ): ?>
				<div class="elemento color-principal">
					
					<div class="titulo">
						<?php _e( 'Color principal:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $color_principal; ?>
					</div>

				</div>
				<?php endif; ?>

				<?php if( $acabado ): ?>
				<div class="elemento acabado">
					
					<div class="titulo">
						<?php _e( 'Acabado:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $acabado; ?>
					</div>

				</div>
				<?php endif; ?>

				<?php if( $formato ): ?>
				<div class="elemento formato">
					
					<div class="titulo">
						<?php _e( 'Formatos:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $formato; ?>
					</div>

				</div>
				<?php endif; ?>

				<?php if( $opciones ): ?>
				<div class="elemento opciones">
					
					<div class="titulo">
						<?php _e( 'Opciones:', 'materialwp' ) ?>
					</div>

					<div class="descripcion">
						<?php echo $opciones; ?>
					</div>

				</div>
				<?php endif; ?>

			</div>

			<div class="col-md-6 der">

				<?php if( $ficha_tecnica && $ficha_tecnica!="" ): ?>

					<div class="elemento">

						<div class="titulo">
							<?php _e( 'Ficha técnica:', 'materialwp' ) ?>
						</div>

						<?php echo $ficha_tecnica; ?>

					</div>

				<?php endif; ?>

			</div>

		</div>

	</div>
	
</div>