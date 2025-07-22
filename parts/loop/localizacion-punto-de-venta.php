<?php
/**
 * Item de Mapa puntos de venta.
 *
 * @package materialwp
 */

?>
<div 	class="localizacion-<?php echo esc_html( $n ); ?> loc-<?php echo esc_html( get_post_field( 'post_name', $id_post ) ); ?>"
		lat="<?php echo esc_attr( $lat ); ?>"
		lng="<?php echo esc_attr( $lng ); ?>"
		id_post="<?php echo esc_attr( $id_post ); ?>"
		ciudad="<?php echo esc_html( get_post_field( 'post_name', $id_post ) ); ?>">

	<!-- Parte visible en el listado -->
	<div class="outer" style="background-image: url(<?php echo esc_url( $fondo_img ); ?>);">
		<div class="izq">
			<div class="titulo">
				<?php
				if ( $tipo_comercio ) {
					echo esc_html( $tipo_comercio );
				} else {
					esc_html_e( 'CUPA STONE', 'cupastone' );
				}
				?>
			</div>
			<div class="ciudad">
				<?php echo $ciudad; //phpcs:ignore ?>
			</div>
			<div class="direccion">
				<?php echo $direccion; //phpcs:ignore ?>
			</div>
		</div>
		<div class="der hide-it-on-foreground">

			<?php if ( $email ) : ?>
			<div class="email">
				<a href="mailto:<?php echo esc_html( $email ); ?>" target="_blank">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/images/email-loc.png'; ?>" alt="Email">
				</a>
			</div>
			<?php endif; ?>

			<?php if ( $telefono_fijo ) : ?>
			<div class="telefono">
				<a href="tel:<?php echo esc_html( $telefono_fijo ); ?>" target="_blank">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/images/telefono-loc.png'; ?>" alt="Teléfono">
				</a>
			</div>
			<?php endif; ?>

			<?php if ( $fax ) : ?>
			<div class="fax">
				<a href="tel:<?php echo esc_html( $fax ); ?>" target="_blank">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/images/fax-loc.png'; ?>" alt="Fax">
				</a>
			</div>
			<?php endif; ?>

		</div>
	</div>

	<!-- Detalles -->
	<div class="resto-datos show-it-on-foreground">

		<!-- Detalles: datos de contacto -->
		<div class="contacto">
			<h2><?php esc_html_e( 'Contacto', 'materialwp' ); ?></h2>
			<ul>

				<?php if ( $persona_contacto ) : ?>
				<li class="persona">
					<?php echo $persona_contacto; //phpcs:ignore ?>
				</li>
				<?php endif; ?>

				<?php if ( $email ) : ?>
				<li class="email">
					<a href="mailto:<?php echo esc_html( $email ); ?>" target="_blank">
						<?php echo $email; //phpcs:ignore ?>
					</a>
				</li>
				<?php endif; ?>

				<?php if ( $telefono_movil ) : ?>
				<li class="telefono-movil">
					<a href="tel:<?php echo esc_html( $telefono_movil ); ?>" target="_blank">
						<?php echo $telefono_movil; //phpcs:ignore ?>
					</a>
				</li>
				<?php endif; ?>

				<?php if ( $telefono_fijo ) : ?>
				<li class="telefono-fijo">
					<a href="tel:<?php echo esc_html( $telefono_fijo ); ?>" target="_blank">
						<?php echo $telefono_fijo; //phpcs:ignore ?>
					</a>
				</li>
				<?php endif; ?>

				<?php if ( $fax ) : ?>
				<li class="fax">
					<?php echo $fax; //phpcs:ignore ?>
				</li>
				<?php endif; ?>

			</ul>
		</div>

		<!-- Detalles: horario -->
		<?php if ( $horario ) : ?>
		<div class="horario">
			<h2><?php esc_html_e( 'Horario', 'materialwp' ); ?></h2>
			<ul>				
				<li class="horario">
					<?php echo $horario; //phpcs:ignore ?>
				</li>
			</ul>
		</div>
		<?php endif; ?>

		<!-- Detalles: contactar -->
		<div class="contactar">
			<div class="boton-cupa-blanco fondo ">
				<a href="<?php echo esc_url( get_field( 'contacto_pagina', 'options' ) ); ?>">
					<?php esc_html_e( 'Contacta', 'materialwp' ); ?>
					<span class="arrow-btn"></span>
				</a>
			</div>
		</div>

		<!-- Detalles: avanzar a descripción -->
		<?php if ( $descripcion || $imagenes ) : ?>
		<div class="aspa-abajo">
			<img class="animated bounce" src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/images/aspa-abajo-granate.png'; ?>" alt="Aspa">
		</div>
		<script type="text/javascript">
			jQuery( document ).ready(function() {
				var ajuste    = 50;
				var distancia = jQuery('#next').offset().top - jQuery('.bloque-cabecera-puntos-de-venta').height() - ajuste;
				jQuery('.aspa-abajo img').click( function(){				
					jQuery(".container-puntos-de-venta").animate({
						scrollTop: distancia,
					}, 800);
				});
			});
		</script>
		<?php endif; ?>

		<!-- Detalles: descripción -->
		<?php
		if ( $descripcion ) :
			$next = '';
			?>
			<div id="next" class="descripcion">
				<?php echo $descripcion; //phpcs:ignore ?>
			</div>
			<?php
		else :
			$next = ' id="next" ';
		endif;
		?>

		<!-- Detalles: galería -->
		<?php if ( $imagenes ) : ?>
			<div <?php echo $next; //phpcs:ignore ?> class="imagenes">

				<?php foreach ( $imagenes as $_img ) : ?>
				<div class="div-ampliar">
					<img class="ampliar" src="<?php echo esc_url( $_img['imagen'] ); ?>" alt="Imagen" />
				</div>
				<?php endforeach; ?>

			</div>
			<script type="text/javascript">
				jQuery('.div-ampliar').on( 'click', function(e){
					e.preventDefault();
					var src = jQuery(this).find('.ampliar').attr('src');
					jQuery('.mymodal .img-modal img').attr('src', src);
					jQuery('.mymodal').show('slow');
				});

				jQuery('.mymodal .close').on( 'click', function(e){
					jQuery('.mymodal').hide('slow');
					jQuery('.mymodal .img-modal img').attr('src', '');
				});

				jQuery( document ).mouseup( function(e) {
					if ( jQuery('.mymodal').is(":visible") ) {
						var container = jQuery(".mymodal .img-modal");
						if ( !container.is(e.target) && container.has(e.target).length === 0 ) {
							jQuery('.mymodal .close').click();
						}
					}
				});

				jQuery( document ).keyup( function(e) {
					if ( e.key === "Esc" || e.key === "Escape" || e.key === "27" || e.key === 27 ) {
						if ( jQuery('.mymodal').is(":visible") ) {
							jQuery('.mymodal .close').click();
						}
					}
				});
			</script>

		<?php endif; // IF Imágenes. ?>

	</div>
</div>
