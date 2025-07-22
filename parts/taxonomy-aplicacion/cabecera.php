<?php
/**
 * Página de gamas: cabecera.
 *
 * @package materialwp
 */

$prod_slug = get_option( 'cupa_cpt_productos' );
if ( ! $prod_slug ) {
	$prod_slug = 'productos';
}
?>

<div class="bloque bloque-taxonomy-gama taxonomy-gama-cabecera">
	<div class="row">
		<div class="col-md-6 izq">
			<div class="inner">

				<?php if ( get_field( 'logo_principal', $tax_fields ) ) : ?>
				<div class="logo-principal">
					<img src="<?php the_field( 'logo_principal', $tax_fields ); ?>" alt="<?php echo esc_html( $currentTaxName ); //phpcs:ignore ?>">
				</div>
				<?php endif; ?>

				<div class="claim">
					<?php the_field( 'texto_claim', $tax_fields ); ?>
				</div>

				<?php if ( get_field( 'anadir_boton_cabecera', $tax_fields ) ) : ?>
				<div class="boton-cupa-granate">
					<?php $enlace_gama = '/' . esc_html( $prod_slug ) . '/?tax=' . esc_html( $currentTaxName ) . '&term_id=' . esc_html( $currentTaxID ); //phpcs:ignore ?>
					<a href="<?php echo esc_url( $enlace_gama ); ?>">
						<?php the_field( 'texto_boton_cabecera', $tax_fields ); ?>
						<span class="arrow-btn"></span>
					</a>
				</div>
				<?php endif; ?>

			</div>
		</div>
		<div class="superpuesta"></div>
	</div>
	<div class="imagen-estatica" style="background-image: url(<?php the_field( 'imagen_cabecera', $tax_fields ); ?>);"></div>

	<?php if ( get_field( 'video_cabecera', $tax_fields ) ) : ?>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<video id="myVideo" controls loop muted>
					<source src="<?php the_field( 'video_cabecera', $tax_fields ); ?>" type="video/mp4">
					Este navegador no soporta videos en HTML5.
				</video>
			</div>
		</div>
	</div>
	<button id="button-play" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
	<script type="text/javascript">
		jQuery( window ).on( 'load', function() {
			var myVideo = document.getElementById("myVideo");
			jQuery('.bloque-taxonomy-gama .superpuesta').on( 'click', function(){
				jQuery('#button-play').click();
				myVideo.play();
			});
			jQuery("#myModal").on('hide.bs.modal', function(){
				myVideo.pause();
			});
		});
	</script>
	<style type="text/css">
		.bloque-taxonomy-gama.taxonomy-gama-cabecera .row .superpuesta{ display: block; }
	</style>
	<?php endif; ?>

</div>
