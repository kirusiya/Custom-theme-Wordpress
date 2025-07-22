<?php
/**
 * Bloque Simulador home.
 *
 * @package materialwp
 */

$myrand = rand();
$tween1 = 'tween1_' . $myrand;
$tween2 = 'tween2_' . $myrand;
$tween3 = 'tween3_' . $myrand;
$enlace = get_field( 'enlace' );

?>

<div class="bloque bloque-simulador-home bloque-texto-foto-<?php echo esc_html( $myrand ); ?>">
	<div class="container-custom">
		<div class="row align-items-center">
			<div class="col-xl-5 order-xl-last <?php echo esc_html( $tween2 ); ?>">
				<div class="container-texto">
					<h2 class="titulo right text-right b-white">
						<?php echo get_field( 'titulo' ); //phpcs:ignore ?>
					</h2>
				</div>
			</div>

			<div class="col-xl-4">
				<div class="container-foto <?php echo esc_html( $tween3 ); ?>">
					<img src="<?php echo esc_url( get_field( 'imagen' ) ); ?>">
				</div>
			</div>

			<div class="col-xl-3 col-descripcion px-0 py-3 <?php echo esc_html( $tween1 ); ?>">
				<h4>
					<?php echo get_field( 'texto' ); //phpcs:ignore ?>
				</h4>

				<?php if ( $enlace ) : ?>
				<div class="boton-cupa-blanco fondo">
					<a href="<?php echo esc_url( $enlace['url'] ); ?>">
						<?php echo esc_html( $enlace['title'] ); ?>
						<span class="arrow-btn"></span>
					</a>

				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {

	<?php
		$rnd  = '_' . $myrand;
		$base = '.bloque-texto-foto-' . $myrand;
	?>

	var scrollMagicController<?php echo esc_html( $rnd ); ?> = new ScrollMagic.Controller();
	var timeline<?php echo esc_html( $rnd ); ?> = new TimelineMax();

	timeline<?php echo esc_html( $rnd ); ?>
	.from("<?php echo esc_html( $base ); ?> .<?php echo esc_html( $tween1 ); ?>", 0.5, {
		position: 'relative',
		top: jQuery( '<?php echo esc_html( $base ); ?> .<?php echo esc_html( $tween1 ); ?>' ).height(),
	}, 'simultaneous' )
	.from("<?php echo esc_html( $base ); ?> .<?php echo esc_html( $tween2 ); ?>", 1.0, {
		position: 'relative',
		top: jQuery( '<?php echo esc_html( $base ); ?> .<?php echo esc_html( $tween2 ); ?>' ).height(),
	}, 'simultaneous' )
	.from("<?php echo esc_html( $base ); ?> .<?php echo esc_html( $tween3 ); ?>", 1.5, {
		left: -2 * jQuery( '<?php echo esc_html( $base ); ?> .<?php echo esc_html( $tween3 ); ?>' ).width(),
	}, 'simultaneous' );

	var scene<?php echo esc_html( $rnd ); ?> = new ScrollMagic.Scene({
		triggerElement: '<?php echo esc_html( $base ); ?>',
		offset: -50,
		reverse: false,
	}).setTween( timeline<?php echo esc_html( $rnd ); ?> ).addTo( scrollMagicController<?php echo esc_html( $rnd ); ?> );

});
</script>
