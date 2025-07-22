
<!-- BLOQUE FOTO TEXTO -->
<div class="bloque bloque-foto-texto <?php echo $block['className']; ?>">

	<div class="row">
		
		<div class="col-lg-6 izq">
			
			<div class="container-foto">
				
				<img class="tween3" src="<?php echo get_field('background'); ?>" alt="Background Cupastone" />

				<div class="imagen-superpuesta tween4">
					
					<?php if( get_field('imagen_superpuesta') ): ?>

					<img class="tween5" src="<?php echo get_field('imagen_superpuesta'); ?>" alt="StonePanel by CupaGroup">

					<?php elseif ( get_field( 'n_imagenes' ) ):

						if( have_rows('n_imagenes') ):

							$n = 1;

						    while ( have_rows('n_imagenes') ) : the_row();

   						        $imagen = get_sub_field('imagen');
   					?>

   					<img class="pseudoslider foto-<?php echo $n; ?>" src="<?php echo $imagen; ?>" alt="<?php _e('Cupastone'); ?>">

					<?php
								$n++;

						    endwhile;
					?>

						<div class="titulo">
							<?php _e( 'Stonepanel Sylvestre', 'materialwp' ); ?>
						</div>

						<script type="text/javascript">
							jQuery( document ).ready(function() {
							    function changeImage(){
							    	if ( jQuery('.pseudoslider.foto-1').is(":visible") ){
							    		jQuery('.pseudoslider.foto-1').css({
							    			'opacity' : '0',
							    			'display' : 'none',							    			
							    		});							    		
							    		jQuery('.pseudoslider.foto-2').css({
							    			'opacity' : '1',
							    			'display' : 'inline',
							    			'transition' : 'opacity 0.3s ease',
							    		});
							    		
							    	} else {
							    		jQuery('.pseudoslider.foto-2').css({
							    			'opacity' : '0',
							    			'display' : 'none',							    			
							    		});							    		
							    		jQuery('.pseudoslider.foto-1').css({
							    			'opacity' : '1',
							    			'display' : 'inline',
							    			'transition' : 'opacity 0.3s ease',
							    		});
							    	}
							    }

							    setInterval( function(){ changeImage(); }, 5000 );
							});
						</script>

					<?php

						endif;

					endif; ?>

				</div>

			</div>

		</div>

		<div class="col-lg-6 der">
			
			<div class="container-texto">
					
				<?php /* ?>
				<div class="subtitulo">
					<?php echo get_field( 'subtitulo' ); ?>
				</div>
				<?php */ ?>

				<h2 class="titulo tween1">
					<?php echo get_field( 'titulo' ); ?>
				</h2>

				<?php if( get_field( 'imagen_superior' ) ): ?>
				<div class="imagen-superior tween1">
					<p>
						<img src="<?php echo get_field( 'imagen_superior' ); ?>" alt="<?php _e('Cupastone'); ?>"/>
					</p>
				</div>
				<?php endif; ?>

				<div class="descripcion tween2">
					<?php echo get_field( 'descripcion' ); ?>
				</div>

				<?php
				if( get_field( 'anadir_boton' ) ): 

					$clase_ancla 	= '';
					$ancla 			= '';

					$enlace = get_field( 'enlace_boton' );

					if ( get_field( 'anadir_ancla' ) ){
						$clase_ancla 	= 'ancla';
						$ancla 			= get_field('ancla');
						$enlace = '#';
					}					

				?>
				
					<div class="boton-cupa-blanco fondo <?php echo $clase_ancla; ?> ">
						<a href="<?php echo $enlace; ?>">
							<?php echo get_field( 'texto_boton' ); ?>
							<span class="arrow-btn"></span>
						</a>
					</div>

					<?php if ( get_field( 'anadir_ancla' ) ): ?>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery("div.boton-cupa-blanco.<?php echo $clase_ancla; ?> a").click(function(e) {
		e.preventDefault;
		jQuery([document.documentElement, document.body]).animate({
			scrollTop: jQuery("<?php echo $ancla; ?>").offset().top
		}, 2000);
	});
});
</script>
					<?php endif; ?>

				<?php endif; ?>

			</div>

		</div>

	</div>
	
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {

	<?php 
	$rnd = '_'.rand(); 
	$base = '.bloque-foto-texto';
	?>

	var scrollMagicController<?php echo $rnd; ?> = new ScrollMagic.Controller();
    var timeline<?php echo $rnd; ?> = new TimelineMax();

    timeline<?php echo $rnd; ?>
	.from("<?php echo $base; ?> .tween1 p", 0.8, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween1 p' ).height(),
	}, 'simultaneous' )
	.from("<?php echo $base; ?> .tween2 p", 1, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween2' ).height(),
	}, 'simultaneous' )
	/*.from("<?php echo $base; ?> .tween3", 1.5, {
		position: 'relative',
		left: -jQuery( '<?php echo $base; ?> .tween3' ).width(),
	}, 'simultaneous' )*/
	.from("<?php echo $base; ?> .tween4", 1, {		
		maxWidth: '0px',
	}, '+=0' )
	.from("<?php echo $base; ?> .tween5", 2, {
		opacity: '0',
	}, '+=0' );
	//.add( tween1 ).add( tween2 ).add( tween3 ).add( tween4 ).add( tween5 );

	var scene<?php echo $rnd; ?> = new ScrollMagic.Scene({
	    triggerElement: '<?php echo $base; ?>',
	    offset: -50,
	    reverse: false,
	}).setTween( timeline<?php echo $rnd; ?> ).addTo( scrollMagicController<?php echo $rnd; ?> );

	//scene<?php echo $rnd; ?>.addIndicators();	// add indicators for developer times

});
</script>