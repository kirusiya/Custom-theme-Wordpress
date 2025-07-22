
<!-- GALERÍA -->
<div class="bloque bloque-taxonomy-gama taxonomy-gama-galeria">

	<div class="titulo">
		
		<?php the_field( 'titulo_galeria', $tax_fields ); ?>

	</div>

	<div class="row">

		<?php

		if( have_rows( 'imagenes_galeria_gama', $tax_fields ) ):
		?>

		<script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>

		<div class="container-imagenes dragscroll">

		<?php

			$n = 1;

		 	while ( have_rows( 'imagenes_galeria_gama', $tax_fields ) ) : the_row();

		 		$imagen = get_sub_field( 'imagen' );
		?>
		
		<div class="imagen-<?php echo $n; ?> div-ampliar">

			<img class="ampliar" src="<?php echo $imagen; ?>" alt="<?php echo $imagen. ' ' .$n; ?>" imagen="<?php echo $n; ?>">
			<div class="overlay"></div>

		</div>

		<?php

				$n++;

		    endwhile;
		?>

			<script type="text/javascript">
				jQuery( document ).ready(function() {

					var lastScrollLeft = 0;
					jQuery('.container-imagenes').scroll(function() {
					    var documentScrollLeft = jQuery(this).scrollLeft();
					    if ( lastScrollLeft != documentScrollLeft ) {
					        lastScrollLeft = documentScrollLeft;
					        if( ! jQuery('.container-imagenes .div-ampliar').hasClass('pointer-events-none') ){
							    jQuery('.container-imagenes .div-ampliar').addClass('pointer-events-none');
							}
					    } else {
					    	jQuery('.container-imagenes .div-ampliar').removeClass('pointer-events-none');
					    }
					});

					jQuery('.container-imagenes').mouseup(function() {
						jQuery('.container-imagenes .div-ampliar').removeClass('pointer-events-none');
					});

					var totalImagenes = <?php echo ($n-1) ?>;
					var currentImagen = 1;

					jQuery('.container-imagenes .div-ampliar').click( function(e){
						e.preventDefault;
						jQuery('.mymodal .img-modal .botones').show();
						currentImagen = jQuery(this).find('.ampliar').attr('imagen');
					});

					jQuery('.mymodal .img-modal .botones .anterior').click( function(){
						if ( currentImagen == 1 ){
							currentImagen = totalImagenes;
						}
						mostrarImagen('prev');
					});

					jQuery('.mymodal .img-modal .botones .siguiente').click( function(){
						if ( currentImagen == totalImagenes ){
							currentImagen = 0;
						}
						mostrarImagen('next');
					});

					function mostrarImagen( direction ){
						if ( direction == 'next' ){
							currentImagen++;
						} else if( direction == 'prev' ){
							currentImagen--;
						}
						
						var src = jQuery('.container-imagenes .div-ampliar .ampliar[imagen='+currentImagen+']').attr('src');
						console.log(src);
						jQuery('.mymodal .img-modal img').attr('src', src);
					}

				});
			</script>

		</div>

		<?php

		endif;

		?>

	</div>

</div>