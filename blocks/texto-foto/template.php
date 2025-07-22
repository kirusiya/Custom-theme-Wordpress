
<?php

$myrand = rand();

$tween1 = 'tween1_'.$myrand;
$tween2 = 'tween2_'.$myrand;
$tween3 = 'tween3_'.$myrand;
$tween4 = 'tween4_'.$myrand;

$yatiene = false;

?>

<!-- BLOQUE TEXTO FOTO -->
<div class="bloque bloque-texto-foto bloque-texto-foto-<?php echo $myrand; ?>">

	<div class="container">
		
		<div class="row">
			
			<div class="col-md-6 izq">
				
				<div class="container-texto">
					
					<?php /* ?>
					<div class="subtitulo">
						<?php echo get_field( 'subtitulo' ); ?>
					</div>
					<?php */ ?>

					<h2 class="titulo <?php echo $tween1; ?>">
						<?php echo get_field( 'titulo' ); ?>
					</h2>

					<div class="descripcion <?php echo $tween2; ?>">
						<?php echo get_field( 'descripcion' ); ?>
					</div>

					<?php if( get_field( 'anadir_botones_de_descarga_stores' ) ): ?>
					<div class="botones-stores">

						<?php if( get_field( 'anadir_boton' ) ): ?>
						<?php $yatiene = true; ?>
						<div class="boton-cupa-blanco fondo">

							<a href="<?php echo get_field( 'enlace_boton' ); ?>">
								<?php echo get_field( 'texto_boton' ); ?>
								<span class="arrow-btn"></span>
							</a>

						</div>
						<?php endif; ?>

						<div class="container-botones-stores">
						
							<?php if( get_field( 'enlace_app_store' ) ): ?>
							<a href="<?php echo get_field( 'enlace_app_store' ); ?>" target="_blank">
								<img src="<?php echo get_stylesheet_directory_uri().'/images/download-appstore.jpg'; ?>" alt="<?php _e('Enlace APP STORE'); ?>">
							</a>
							<?php endif; ?>

							<?php if( get_field( 'enlace_play_store' ) ): ?>
							<a href="<?php echo get_field( 'enlace_play_store' ); ?>" target="_blank">
								<img src="<?php echo get_stylesheet_directory_uri().'/images/download-playstore.jpg'; ?>" alt="<?php _e('Enlace PLAY STORE'); ?>">
							</a>
							<?php endif; ?>

						</div>

					</div>
					<?php endif; ?>

					<?php if( get_field( 'anadir_boton' ) && ( $yatiene == false ) ): ?>
					<div class="boton-cupa-blanco fondo">

						<a href="<?php echo get_field( 'enlace_boton' ); ?>">
							<?php echo get_field( 'texto_boton' ); ?>
							<span class="arrow-btn"></span>
						</a>

					</div>
					<?php endif; ?>

				</div>

			</div>

			<div class="col-md-6 der">
				
				<div class="container-foto <?php echo $tween3; ?>">

					<?php if( get_field('enlazar_imagen') ): ?>
					<a href="<?php echo get_field('enlace') ?>">
					<?php endif; ?>
				
						<img src="<?php echo get_field('imagen'); ?>" alt="<?php _e('Cupastone'); ?>" />

						<?php if( get_field('anadir_imagen_central') && get_field('imagen_central') ): ?>
						<div class="imagen-central <?php echo $tween4; ?>">
							<img src="<?php echo get_field('imagen_central'); ?>" alt="<?php _e('Cupastone logo'); ?>" />
						</div>
						<?php endif; ?>

					<?php if( get_field('enlazar_imagen') ): ?>
					</a>
					<?php endif; ?>
					
				</div>

			</div>

		</div>

	</div>
	
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {

	<?php 
	$rnd = '_'.$myrand;
	$base = '.bloque-texto-foto-'.$myrand;
	?>

	var scrollMagicController<?php echo $rnd; ?> = new ScrollMagic.Controller();
    var timeline<?php echo $rnd; ?> = new TimelineMax();

    timeline<?php echo $rnd; ?>
	.from("<?php echo $base; ?> .<?php echo $tween1; ?> p", 0.5, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .<?php echo $tween1; ?>' ).height(),
	}, 'simultaneous' )
	.from("<?php echo $base; ?> .<?php echo $tween2; ?> p", 1.0, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .<?php echo $tween2; ?>' ).height(),
	}, 'simultaneous' )
	.from("<?php echo $base; ?> .<?php echo $tween3; ?>", 1.5, {
		right: -jQuery( '<?php echo $base; ?> .<?php echo $tween3; ?>' ).width(),
	}, 'simultaneous' )
	.from("<?php echo $base; ?> .<?php echo $tween4; ?>", 2.5, {
		opacity: '0',
	}, '+=0.1' );

	var scene<?php echo $rnd; ?> = new ScrollMagic.Scene({
	    triggerElement: '<?php echo $base; ?>',
	    offset: -50,
	    reverse: false,
	}).setTween( timeline<?php echo $rnd; ?> ).addTo( scrollMagicController<?php echo $rnd; ?> );

	//scene<?php echo $rnd; ?>.addIndicators();	// add indicators for developer times

});
</script>