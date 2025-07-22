<?php
/**
 * Bloque Mapa puntos de venta.
 *
 * @package materialwp
 */

$enlace        = get_field( 'enlace' );
$enlace_puntos = get_field( 'enlace_puntos' );
?>

<div class="bloque bloque-mapa-puntos-de-venta">
	<div class="container">		
		<div class="container-texto">
			<h2 class="titulo">
				<?php echo get_field( 'titulo' ); //phpcs:ignore ?>
			</h2>
		</div>
	</div>

	<div class="row align-items-center">		
		<div class="col-xl-5 der">
			<div class="der-content">
				<?php echo get_field( 'texto' ); ?>
				<?php if ( $enlace ) : ?>
				<div class="boton-cupa-granate">
					<a href="<?php echo esc_url( $enlace['url'] ); ?>">
						<?php echo esc_html( $enlace['title'] ); ?>
						<span class="arrow-btn"></span>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-xl-7 izq <?php echo $enlace_puntos ? 'sin-puntos' : ''; ?>">			
			<div class="mapa">
				<img class="mapa-desktop" src="<?php echo esc_url( get_field( 'mapa_desktop' ) ); ?>" alt="<?php esc_html_e( 'Mapa Puntos de venta', 'materialwp' ); ?>">
				<img class="mapa-mobile" src="<?php echo esc_url( get_field( 'mapa_mobile' ) ); ?>" alt="<?php esc_html_e( 'Mapa Puntos de venta', 'materialwp' ); ?>">
				<div class="markers"></div>
			</div>

			<?php if ( $enlace_puntos ) : ?>
			<div class="boton-cupa-blanco fondo btn-movil-puntos">
				<a href="<?php echo esc_url( $enlace_puntos['url'] ); ?>">
					<?php echo esc_html( $enlace_puntos['title'] ); ?>
					<span class="arrow-btn"></span>
				</a>
			</div>
			<?php endif; ?>

			<?php
			$posts = get_field( 'localizaciones' ); //phpcs:ignore
			if ( $posts ) :
				?>

				<div class="puntos-de-venta">

					<?php
					$n            = 1;
					$html_markers = '';
					$css_markers  = '';

					foreach ( $posts as $post ) : //phpcs:ignore
						setup_postdata( $post );
						$id_post = $post->ID;
						?>

						<div class="punto-<?php echo esc_html( $n ); ?>">
							<img class="cerrarPunto" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/close-menu-search.png">
							<div class="logo">

								<?php $imagen = get_the_post_thumbnail_url( $id_post, 'full' ); ?>

								<?php if ( $imagen ) : ?>
								<img src="<?php echo esc_url( $imagen ); ?>" alt="<?php esc_html_e( 'Logo', 'materialwp' ); ?>" />
								<?php else : ?>
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/cupastone-logo-localizaciones.png" alt="<?php esc_html_e( 'Cupastone logo', 'materialwp' ); ?>"/>
								<div class="nombre-localizacion"><?php echo esc_html( get_the_title( $id_post ) ); ?></div>
								<?php endif; ?>

							</div>

							<?php if ( get_field( 'direccion', $id_post ) ) : ?>
							<div class="direccion">
								<?php echo get_field( 'direccion', $id_post ); //phpcs:ignore ?>
							</div>
							<?php endif; ?>

							<?php if ( get_field( 'email', $id_post ) ) : ?>
							<div class="email">
								<p>
									<a href="mailto:<?php echo get_field( 'email', $id_post ); //phpcs:ignore ?>">
										<?php echo get_field( 'email', $id_post ); //phpcs:ignore ?>
									</a>
								</p>
							</div>
							<?php endif; ?>

							<?php if ( get_field( 'telefono', $id_post ) ) : ?>
							<div class="telefono">
								<p>
									<a href="tel:<?php echo get_field( 'telefono', $id_post ); //phpcs:ignore ?>">
										<?php echo get_field( 'telefono', $id_post ); //phpcs:ignore ?>
									</a>
								</p>
							</div>
							<?php endif; ?>

							<div class="boton-cupa-blanco fondo">
								<a href="<?php echo esc_url( get_field( 'contacto_pagina', 'options' ) ); ?>">
									<?php esc_html_e( 'Contacta', 'materialwp' ); ?>
									<span class="arrow-btn"></span>
								</a>
							</div>

							<?php
							$html_markers .= '<div class="marker-' . $n . '" n="' . $n . '" style="top:' . get_field( 'top_desktop', $id_post ) . 'px;left:' . get_field( 'left_desktop', $id_post ) . 'px;" title="' . get_the_title( $id_post ) . '"></div>';
							$css_markers  .= '.mapa.in-mobile .marker-' . $n . '{top:' . get_field( 'top_mobile', $id_post ) . 'px !important;left:' . get_field( 'left_mobile', $id_post ) . 'px !important;}';
							?>

						</div>

						<?php
						$n++;
					endforeach;
					wp_reset_postdata();
					?>

				</div>

				<script type="text/javascript">
					jQuery( document ).ready(function() {
						jQuery( '.mapa .markers' ).append( '<?php echo $html_markers . "<style>" . $css_markers . "</style>"; //phpcs:ignore ?>' );

						jQuery( '.mapa .markers div[class^=marker-]' ).click( function(){

							if ( ! jQuery(this).hasClass('active') ){

								n = jQuery( this ).attr( 'n' );
								desactivaTodo();
								activalo( n );

								if ( jQuery( window ).width() < 769 ) {
									jQuery( [document.documentElement, document.body] ).animate({		                            
										scrollTop: jQuery( window ).scrollTop() + 300		                            
									}, 1200);
								}
							}
						});

						jQuery( '.cerrarPunto' ).click( function(){
							desactivaTodo();
						});

						function desactivaTodo(){
							jQuery( '.mapa .markers div[class^=marker-]' ).removeClass( 'active animated1s bounce' );
							jQuery( '.puntos-de-venta div[class^=punto-]' ).hide();
						}

						function activalo(n){
							jQuery( '.mapa .markers .marker-' +n ).addClass( 'active animated1s bounce' );
							jQuery( '.puntos-de-venta .punto-' +n ).show( 'slow' );
						}

						function checkWidth(){
							if( jQuery( 'body' ).width() <= 1250 ){
								jQuery( '.bloque-mapa-puntos-de-venta .mapa' ).addClass( 'in-mobile' );
							} else {
								jQuery( '.bloque-mapa-puntos-de-venta .mapa' ).removeClass( 'in-mobile' );
							}
						}

						function elementInView(elem){
							return ( jQuery(window).height() + jQuery(window).scrollTop()) > jQuery(elem).offset().top;
						};

						jQuery(window).scroll( function(){

							if( !elementInView( jQuery('.bloque-mapa-puntos-de-venta .puntos-de-venta') ) ){
								// do nothing
							} else if ( elementInView( jQuery('.bloque-mapa-puntos-de-venta .puntos-de-venta') ) && ( jQuery(document).width() > 1440 ) ){
								jQuery('.bloque-mapa-puntos-de-venta .puntos-de-venta').removeClass('quieto')
								jQuery( '.bloque-mapa-puntos-de-venta .puntos-de-venta' ).css( 'top', ( jQuery(window).scrollTop() - ( 3.6 * jQuery(this).height() ) ) * -.20 );					  		
							}else {
								if ( !jQuery('.bloque-mapa-puntos-de-venta .puntos-de-venta').hasClass('quieto') ){
									jQuery('.bloque-mapa-puntos-de-venta .puntos-de-venta').addClass('quieto')
								}
							}
						});

						jQuery( window ).resize( function(){
							checkWidth();
						});

						checkWidth();

						/*jQuery( '.mapa .markers .marker-1' ).addClass( 'active animated1s bounce' );
						jQuery( '.puntos-de-venta .punto-1' ).show( 'slow' );*/
					});
				</script>

			<?php endif; ?>
		</div>
	</div>	
</div>
