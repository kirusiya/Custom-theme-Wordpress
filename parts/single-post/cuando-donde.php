<?php
/**
 * Datos de post
 *
 * @package materialwp
 */

?>

<?php if ( get_field( 'cuando' ) || get_field( 'donde' ) ) : ?>

<div class="bloque-cuando-donde">
	<div class="container-blog">
		<div class="cuando-donde">

			<?php if ( get_field( 'cuando' ) ) : ?>
			<div class="cuando">
				<span class="titulo"><?php esc_html_e( 'CUÁNDO: ', 'materialwp' ); ?></span>

				<?php
				$event_date = explode( ' ', trim( get_field( 'cuando' ) ) );
				$event_date = $event_date[0] . ' de ' . ucfirst( $event_date[1] ) . ' de ' . $event_date[2] . ' a las ' . $event_date[3];
				?>
				<span class="texto"><?php echo esc_html( $event_date ); ?></span>
			</div>
			<?php endif; ?>

			<?php if ( get_field( 'donde' ) ) : ?>
			<div class="donde">
				<span class="titulo"><?php esc_html_e( 'DÓNDE: ', 'materialwp' ); ?></span>
				<span class="texto"><?php echo esc_html( get_field( 'donde' ) ); ?></span>
			</div>
			<?php endif; ?>

		</div>

		<div class="boton-asistir">
			<div class="boton-cupa-granate">
				<a href="#">
					<?php esc_html_e( 'Asistir', 'materialwp' ); ?>
					<span class="arrow-btn"></span>
				</a>
			</div>
		</div>

		<script type="text/javascript">
		jQuery( document ).ready(function() {

			jQuery('.bloque-cuando-donde .boton-asistir a').click( function(e) {
				e.preventDefault();
				jQuery('html,body').animate({
					scrollTop: jQuery('.form-asistir').offset().top - 80
				}, 1200);
				if( jQuery('.form-single-evento').hasClass('hide-elements') ) {		    		
					showFormSingleEvento();
					jQuery('.form-asistir').find('input[type=text],textarea,select').filter(':visible:first').focus();
				}
			});

			jQuery('.form-single-evento').click( function(e){
				if( jQuery('.form-single-evento').hasClass('hide-elements') ) {		    		
					showFormSingleEvento();
					jQuery('.form-asistir').find('input[type=text],textarea,select').filter(':visible:first').focus();
				}
			});

			function showFormSingleEvento(){
				jQuery('.form-single-evento').removeClass('hide-elements').show('slow');
			}

		});
		</script>

	</div>
</div>

<?php endif; ?>
