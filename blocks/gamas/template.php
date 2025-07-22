<?php
/**
 * Bloque Gamas.
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-gamas <?php echo esc_html( $block['className'] ); ?>">
	<div class="container-custom">
		<div class="copy">
			<?php echo get_field( 'copy_gamas' ); //phpcs:ignore ?>
		</div>
		<div class="container-gamas">

		<?php
		$terms = get_terms( 'gama', array( 'hide_empty' => false ) );

		if ( $terms ) :
			$n = 1;

			foreach ( $terms as $_term ) :
				$id_gama     = $_term->term_id;
				$slug        = $_term->slug;
				$nombre      = $_term->name;
				$descripcion = term_description( $id_gama );
				$imagen      = get_field( 'imagen', 'gama_' . $id_gama );
				$ocultar     = get_field( 'ocultar_landing', 'gama_' . $id_gama );

				if ( ! $ocultar ) :
					?>

			<div class="gama-<?php echo esc_html( $n ); ?> <?php echo esc_html( $slug ); ?>">
				<h2><?php echo str_replace( '®', '<sup>®</sup>', $nombre ); //phpcs:ignore ?></h2>
				<div class="inner" style="background-image: url(<?php echo esc_url( $imagen ); ?>);">
					<div class="velo-tax"></div>
					<div class="izq">
						<?php echo str_replace( '®', '<sup>®</sup>', $descripcion ); //phpcs:ignore ?>
					</div>
					<div class="der">		  				
						<div class="boton-cupa-blanco">

							<?php
							if ( 29 === intval( $id_gama ) ) {
								$enlace_gama = get_permalink( 473 );
							} else {
								$enlace_gama = get_term_link( $id_gama, 'gama' );
							}
							?>

							<a href="<?php echo esc_url( $enlace_gama ); ?>">
								<?php esc_html_e( 'Ver Productos', 'materialwp' ); ?>
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
		var elemTop     = elem[0].getBoundingClientRect().top;
		var elemBottom  = elem[0].getBoundingClientRect().bottom;
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
			jQuery( '.bloque-gamas .container-gamas div[class^=gama-]' ).each( function(){
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
