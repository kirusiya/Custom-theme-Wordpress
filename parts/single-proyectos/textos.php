<?php
/**
 * Contenido de la página de detalles de Proyecto
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-single-proyectos textos">

	<?php
	$imagen_superior = get_field( 'imagen_superior' );
	$texto_destacado = get_field( 'texto_destacado' );

	if ( have_rows( 'textos_y_fotos' ) ) :
		$n_grupo     = 1;
		$total_count = count( get_field( 'textos_y_fotos' ) );

		while ( have_rows( 'textos_y_fotos' ) ) :
			the_row();
			$ladillo    = get_sub_field( 'ladillo' );
			$texto      = get_sub_field( 'texto' );
			$html_fotos = '';

			if ( have_rows( 'fotos' ) ) :
				$n_foto     = 1;
				$html_fotos = '<div class="fotos">';

				while ( have_rows( 'fotos' ) ) :
					the_row();
					$foto  = get_sub_field( 'foto' );
					$tween = '';

					if ( 2 === $n_foto ) {
						$rnd   = '_' . wp_rand();
						$tween = 'tween' . $rnd;
						$base  = '.grupo-' . $n_grupo;

						$html_fotos .= "
							<script>
								jQuery( document ).ready(function() {
									var scrollMagicController" . $rnd . " = new ScrollMagic.Controller();
									var timeline" . $rnd . " = new TimelineMax();

									timeline" . $rnd . "
									.from('" . $base . " .foto-1', 0.5, {
										display: 'none',
										opacity: '0',
									}, 'simultaneous' )
									.from('" . $base . " ." . $tween . "', 0.5, {
										display: 'inline-block',
										opacity: '1',
									}, 'simultaneous');

									var width" . $rnd . " = (window.innerWidth > 0) ? window.innerWidth : screen.width;
									
									if( width" . $rnd . " > 767 ) {
										var scene" . $rnd . " = new ScrollMagic.Scene({
											triggerElement: '" . $base . "',
											offset: ( jQuery('" . $base . "').height() / 2 ),
										}).setTween( timeline" . $rnd . " ).addTo( scrollMagicController" . $rnd . " );
									}
								});
							</script>";
					}

					$html_fotos .= "
						<div class='foto-" . $n_foto . " div-ampliar " . $tween . "' foto='" . $n_foto . "'>
							<img class='ampliar' src='" . $foto . "'>
						</div>
					";

					$html_caja_datos = "";

					if ( ( $n_grupo === $total_count ) && ( have_rows( 'datos_pie' ) ) ) {

						while ( have_rows( 'datos_pie' ) ) :
							the_row();

							$interiorista    = get_sub_field( 'interiorista' );
							$constructora    = get_sub_field( 'empresa_constructora' );
							$fotografo       = get_sub_field( 'copyright_fotografias' );
							$incluir_tags    = get_sub_field( 'incluir_etiquetas' );
							$html_caja_datos = "<div class='caja-datos'>";

							if ( $interiorista ) {
								$html_caja_datos .= "
									<div class='dato interiorista'>
										<div class='tit'>" . __('Interiorista', 'materialwp') . "</div>
										<div class='txt'>&nbsp;/&nbsp;" . $interiorista . "</div>
									</div>";
							}

							if ( $constructora ) {
								$html_caja_datos .= "
									<div class='dato constructora'>
										<div class='tit'>" . __('Empresa constructora', 'materialwp') . "</div>
										<div class='txt'>&nbsp;/&nbsp;" . $constructora . "</div>
									</div>";
							}

							if ( $fotografo ) {
								$html_caja_datos .= "
									<div class='dato fotografo'>
										<div class='tit'>© " . __('Fotografías', 'materialwp') . "</div>
										<div class='txt'>&nbsp;/&nbsp;" . $fotografo . "</div>
									</div>";
							}

							$post_tags = wp_get_post_terms( get_the_ID(), 'tag_proyectos' );
							if ( $incluir_tags && $post_tags ) {
								$mytags           = "";
								$total_count_tags = count( $post_tags );
								$count_tags       = 1;

								foreach ( $post_tags as $_tag ) {
									$mytags .= $_tag->name;
									$mytags .= ( $total_count_tags !== $count_tags ) ? ', ' : '';
									$count_tags++;
								}

								$html_caja_datos .= "
									<div class='dato etiquetas'>
										<div class='tit'>" . __('Etiquetas', 'materialwp') . "</div>
										<div class='txt'>&nbsp;/&nbsp;" . $mytags . "</div>
									</div>";
							}

							$html_caja_datos .= "</div>";
						endwhile;
					}

					$n_foto++;
				endwhile;

				$html_fotos .= "</div>";
			endif;
			?>

			<div class="row grupo-<?php echo $n_grupo; ?>">
				<div class="col-md-6 izq">

					<?php if ( 1 === $n_grupo ) : ?>
					<div class="texto-destacado">
						<?php echo $texto_destacado; ?>
					</div>
					<?php endif; ?>

					<div class="ladillo-texto">			
						<div class="ladillo"><?php echo $ladillo; ?></div>
						<div class="texto"><?php echo $texto; ?></div>
						<?php echo $html_caja_datos; ?>
					</div>
				</div>
				<div class="col-md-6 der">
					<?php echo $html_fotos; ?>
				</div>
			</div>

			<?php if ( $n_grupo < $total_count ) : ?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {

					grupo_height_<?php echo $n_grupo; ?> = jQuery('.grupo-<?php echo $n_grupo; ?>').height();
					fotos_height_<?php echo $n_grupo; ?> = jQuery('.grupo-<?php echo $n_grupo; ?> .fotos').height();

					function check_grupo_<?php echo $n_grupo; ?>(){
						nav_height = 0;
						scrollTop_<?php echo $n_grupo; ?> = jQuery(window).scrollTop();
						elementOffset_<?php echo $n_grupo; ?> = jQuery('.grupo-<?php echo $n_grupo; ?>').offset().top;
						distance_initial_<?php echo $n_grupo; ?> = (elementOffset_<?php echo $n_grupo; ?> - scrollTop_<?php echo $n_grupo; ?>);

						// Si ya toca el contenedor con el tope de la página => fixed
						if ( (distance_initial_<?php echo $n_grupo; ?> - nav_height) <= 0 ){
							jQuery('.grupo-<?php echo $n_grupo; ?> .fotos').removeClass('absolute-bottom').addClass('fixed-it-top');
						} else if ( distance_initial_<?php echo $n_grupo; ?> + nav_height > 0 && ( jQuery('.grupo-<?php echo $n_grupo; ?> .fotos').hasClass('fixed-it-top') ) ) {
							jQuery('.grupo-<?php echo $n_grupo; ?> .fotos').removeClass('fixed-it-top');
						}

						/*if ( (getVisiblePart( '.grupo-<?php echo $n_grupo; ?>' ) <= (fotos_height_<?php echo $n_grupo; ?> + nav_height)) && (jQuery(window).scrollTop() >= (fotos_height_<?php echo $n_grupo; ?> + nav_height) ) && ( jQuery('.grupo-<?php echo $n_grupo; ?> .fotos').hasClass('fixed-it-top') ) ){
							jQuery('.grupo-<?php echo $n_grupo; ?> .fotos').removeClass('fixed-it-top').addClass('absolute-bottom');
						}*/
					}

					jQuery(window).scroll(function() {
						if ( jQuery(document).width() > 767 ){
							check_grupo_<?php echo $n_grupo; ?>();
						}				
					});

					if ( jQuery(document).width() > 767 ){
						check_grupo_<?php echo $n_grupo; ?>();
					}

				});
			</script>
			<?php endif; ?>

			<?php
			$n_grupo++;
		endwhile;
	endif;
	?>

</div>

<script type="text/javascript">	
	/* Get visible part of div */
	function getVisiblePart(elem){
		var windowHeight = jQuery(window).height();
		var overviewHeight = jQuery(elem).height();
		var overviewStaticTop = jQuery(elem).offset().top;
		var overviewScrollTop = overviewStaticTop - jQuery(window).scrollTop();
		var overviewStaticBottom = overviewStaticTop + jQuery(elem).height();
		var overviewScrollBottom = windowHeight - (overviewStaticBottom - jQuery(window).scrollTop());
		var visibleArea;
		if ((overviewHeight + overviewScrollTop) < windowHeight) {
			// alert("bottom is showing!");
			visibleArea = windowHeight - overviewScrollBottom;
			// alert(visibleArea);
		} else {
			if (overviewScrollTop < 0) {
				// alert("is full height");
				visibleArea = windowHeight;
				// alert(visibleArea);
			} else {
				// alert("top is showing");
				visibleArea = windowHeight - overviewScrollTop;
				// alert(visibleArea);
			}
		}
		return visibleArea;
	}
</script>
