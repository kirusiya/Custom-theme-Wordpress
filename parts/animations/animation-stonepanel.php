<?php
/**
 * Animaciones para Stone Panel
 *
 * @package materialwp
 */

?>

<div class="animation animation-home animation-stonepanel">
	<img class="pic pic1" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/animations/animation-stonepanel/animation-1.png" alt="Animación 1">
	<img class="pic pic2" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/animations/animation-stonepanel/animation-2.png" alt="Animación 2">
	<img class="pic pic3" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/animations/animation-stonepanel/animation-3.png" alt="Animación 3">
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {

	<?php
	$rnd  = '_' . wp_rand();
	$base = '.animation-stonepanel';
	?>

	var scrollMagicController<?php echo esc_html( $rnd ); ?> = new ScrollMagic.Controller();
	var timeline<?php echo esc_html( $rnd ); ?> = new TimelineMax();

	var tween1 = TweenMax.to("<?php echo esc_html( $base ); ?> .pic1", 0.5, {
		opacity: 1,
		x: function(index, target) { return (index + 1) - 100 },
		y: function(index, target) { return (index + 1) - 100 }
	});

	var tween2 = TweenMax.to("<?php echo esc_html( $base ); ?> .pic2", 0.5, {
		opacity: 1,
		x: function(index, target) { return (index + 1) - 60 },
		y: function(index, target) { return (index + 1) - 60 }
	});

	var tween3 = TweenMax.to("<?php echo esc_html( $base ); ?> .pic3", 0.5, {
		opacity: 1,
		x: function(index, target) { return (index + 1) - 20 },
		y: function(index, target) { return (index + 1) - 20 }
	});

	timeline<?php echo esc_html( $rnd ); ?>.add(tween1).add(tween2).add(tween3);

	var scene<?php echo esc_html( $rnd ); ?> = new ScrollMagic.Scene({
		triggerElement: '<?php echo esc_html( $base ); ?> ',
		offset: -100,
		reverse: false,
	}).setTween(timeline<?php echo esc_html( $rnd ); ?>).addTo(scrollMagicController<?php echo esc_html( $rnd ); ?>);

});
</script>
