<?php
/**
 * Bloque Aplicaciones.
 *
 * @package materialwp
 */

$prod_slug = get_option( 'cupa_cpt_productos' );
if ( ! $prod_slug ) {
	$prod_slug = 'productos';
}

?>

<div class="bloque bloque-aplicaciones <?php echo esc_html( $block['className'] ); ?>">
	<div class="container-custom">
		<div class="copy">
			<?php echo get_field( 'descripcion_taxonomia_aplicaciones', 'options' ); //phpcs:ignore ?>
		</div>
		<div class="container-aplicaciones">

		<?php
		$terms = get_terms(
			'aplicacion',
			array(
				'hide_empty' => false,
			)
		);

		if ( $terms ) :

			$n = 1;

			foreach ( $terms as $_term ) :
				$id_aplicacion = $_term->term_id;
				$slug          = $_term->slug;
				$nombre        = $_term->name;
				$descripcion   = term_description( $id_aplicacion );
				$imagen        = get_field( 'imagen', 'aplicacion_' . $id_aplicacion );
				$ocultar       = get_field( 'ocultar_landing', 'aplicacion_' . $id_aplicacion );

				if ( ! $ocultar ) :
					?>

			<div class="aplicacion-<?php echo esc_html( $n ); ?> <?php echo esc_html( $slug ); ?>">
				<h2><?php echo esc_html( $nombre ); ?></h2>
				<div class="inner" style="background-image: url(<?php echo esc_url( $imagen ); ?>);">
					<div class="velo-tax"></div>
					<div class="izq">
						<?php echo $descripcion; //phpcs:ignore ?>
					</div>
					<div class="der">		  				
						<div class="boton-cupa-blanco">
							<a href="<?php echo esc_url( get_term_link( $id_aplicacion, 'aplicacion' ) ); ?>">
								<?php esc_html_e( 'Ver aplicación', 'materialwp' ); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>
					</div>
				</div>
			</div>

					<?php
					endif;

				$n++;
			endforeach;

		endif;
		?>

		</div>
	</div>	
</div>

<script type="text/javascript">
jQuery( document ).ready( function() {

	function isScrolledIntoView(elem) {
		var elemTop 	= elem[0].getBoundingClientRect().top;
		var elemBottom 	= elem[0].getBoundingClientRect().bottom;
		var isVisible   = false;

		if( elemTop < window.innerHeight ){
			if( elemBottom >= 0 ){
				isVisible = true;
			}
		}

		return isVisible;
	}

	document.addEventListener( 'scroll', function (event) {
		checkShowHide();	    
	}, true );

	function checkShowHide(){
		if( document.body.clientWidth <= 768 ) {	    	
			jQuery( '.bloque-aplicaciones .container-aplicaciones div[class^=aplicacion-]' ).each( function(){
				if ( isScrolledIntoView( jQuery(this) ) ) {
					if ( !jQuery(this).hasClass('showData') ) {
						jQuery(this).addClass( 'showData' );
					}
				} else {
					jQuery(this).removeClass( 'showData' );
				}
			});
		}
	}

	checkShowHide();

});
</script>
