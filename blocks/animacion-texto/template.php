
<!-- BLOQUE ANIMACIÓN TEXTO -->
<div class="bloque bloque-animacion-texto <?php echo $block['className']; ?>">

	<div class="container">
		
		<div class="row">

			<div class="col-md-6 izq">

				<?php

				if ( get_field( 'seleccionar_animacion' ) == 'home' ){

					include(get_stylesheet_directory().'/parts/animations/animation-home.php');
					$target_blank = '';

				} elseif ( get_field( 'seleccionar_animacion' ) == 'stonepanel' ){

					include(get_stylesheet_directory().'/parts/animations/animation-stonepanel.php');
					$target_blank = ' target="_blank" ';

				}

				?>

			</div>
			
			<div class="col-md-6 der">
				
				<div class="container-texto">
					
					<?php /* ?>
					<div class="subtitulo">
						<?php echo get_field( 'subtitulo' ); ?>
					</div>
					<?php */ ?>

					<h2 class="titulo tween1">
						<?php echo get_field( 'titulo' ); ?>
					</h2>

					<div class="descripcion tween2">
						<?php echo get_field( 'descripcion' ); ?>
					</div>

					<?php if( get_field( 'anadir_2_boton' ) ): ?>
					<div class="botones">
					<?php endif; ?>

						<?php if( get_field( 'anadir_boton' ) ): ?>
							<?php 
							$clase_descargar = '';
							if ( strtoupper( get_field( 'texto_boton' ) ) == 'CATÁLOGO' ){ 
								$clase_descargar = ' boton-descarga ';
							}
							?>
						<div class="boton-cupa-blanco fondo <?php echo $clase_descargar; ?>">
							<a href="<?php echo get_field( 'enlace_boton' ); ?>" <?php echo $target_blank; ?>>
								<?php echo get_field( 'texto_boton' ); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>
						<?php endif; ?>

						<?php if( get_field( 'anadir_2_boton' ) ): ?>
						<div class="boton-cupa-blanco fondo">
							<a href="<?php echo get_field( 'enlace_2_boton' ); ?>">
								<?php echo get_field( 'texto_2_boton' ); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>
						<?php endif; ?>

						<?php if( get_field( 'anadir_3_boton' ) ): ?>
						<div class="boton-cupa-blanco fondo">
							<a href="<?php echo get_field( 'enlace_3_boton' ); ?>">
								<?php echo get_field( 'texto_3_boton' ); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>
						<?php endif; ?>

					<?php if( get_field( 'anadir_2_boton' ) ): ?>
					</div>
					<?php endif; ?>

				</div>

			</div>			

		</div>

	</div>
	
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {

	<?php 
	$rnd = '_'.rand(); 
	$base = '.bloque-animacion-texto';
	?>

	var scrollMagicController<?php echo $rnd; ?> = new ScrollMagic.Controller();
    var timeline<?php echo $rnd; ?> = new TimelineMax();

/*
    var tween1 = TweenMax.from("<?php echo $base; ?> .tween1 p", 0.5, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween1' ).height(),
	}, "simultaneous" );

	var tween2 = TweenMax.from("<?php echo $base; ?> .tween2 p", 0.5, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween2' ).height(),
	}, "simultaneous" );

	timeline<?php echo $rnd; ?>.add( tween1 ).add( tween2 );
*/

	timeline<?php echo $rnd; ?>
	.from("<?php echo $base; ?> .tween1 p", 0.5, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween1' ).height(),
	}, "simultaneous" )
	.from("<?php echo $base; ?> .tween2 p", 1.0, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween2' ).height(),
	}, "simultaneous" );




	var scene<?php echo $rnd; ?> = new ScrollMagic.Scene({
	    triggerElement: '<?php echo $base; ?>',
	    offset: -50,
	    reverse: false,
	}).setTween( timeline<?php echo $rnd; ?> ).addTo( scrollMagicController<?php echo $rnd; ?> );

	//scene<?php echo $rnd; ?>.addIndicators();	// add indicators for developer times

});
</script>