<?php
/**
 * Loop de Cronología.
 *
 * @package materialwp
 */

if ( get_the_post_thumbnail_url() ) {
	$style = 'background-image: url(' . get_the_post_thumbnail_url() . ')';
} else {
	$style = '';
}

?>

<div class="cronologia-<?php echo esc_html( get_field( 'ano', get_the_ID() ) ); ?>">
	<div class="inner" style="<?php echo $style; //phpcs:ignore ?>">
		<div class="wrap-inner">
			<div class="ano"><?php echo esc_html( get_field( 'ano', get_the_ID() ) ); ?></div>
			<div class="titulo">
				<?php echo esc_html( get_the_title( get_the_ID() ) ); ?>
			</div>
			<div class="descripcion">
				<?php echo get_field( 'descripcion', get_the_ID() ); //phpcs:ignore ?>
			</div>
		</div>
		<div class="capa-overlay"></div>
	</div>
</div>
