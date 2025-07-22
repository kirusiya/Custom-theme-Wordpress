<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package materialwp
 */

?>

</div><!-- #content -->

<?php if ( ! is_tax( 'galeria' ) ) : ?>

	<footer id="colophon" class="site-footer my-footer" role="contentinfo">
		<div class="container-custom">
			<div class="row">

				<div class="col-sm-6 col-lg-3 col-logos">
					<img src="<?php echo esc_url( get_field( 'logotipo_color', 'options' ) ); ?>" class="logo-cupastone">
					<a href="https://www.cupagroup.com/" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/logo-cupagroup-footer.png" class="logo-cupagroup">
					</a>
				</div>

				<div class="col-sm-6 col-lg-4 col-enlaces">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'depth'          => 1,
								'container'      => false,
								'menu_class'     => 'navbar-nav',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
					?>
				</div>

				<div class="col-sm-6 col-lg-2 col-redes">
					<?php
					$instagram = get_field( 'instagram', 'options' );
					$facebook  = get_field( 'facebook', 'options' );
					$twitter   = get_field( 'twitter', 'options' );
					$pinterest = get_field( 'pinterest', 'options' );
					$youtube   = get_field( 'youtube', 'options' );
					$linkedin  = get_field( 'linkedin', 'options' );
					$houzz     = get_field( 'houzz', 'options' );
					?>

					<?php if ( $instagram ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/instagram-2.png" alt="Instagram" />
						Instagram
					</a>
					<?php endif; ?>

					<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/facebook-2.png" alt="Facebook" />
						Facebook
					</a>
					<?php endif; ?>

					<?php if ( $twitter ) : ?>
					<a href="<?php echo esc_url( $twitter ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/x.png" alt="X" />
						X (Twitter)
					</a>
					<?php endif; ?>

					<?php if ( $pinterest ) : ?>
					<a href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/pinterest-2.png" alt="Pinterest" />
						Pinterest
					</a>
					<?php endif; ?>

					<?php if ( $youtube ) : ?>
					<a href="<?php echo esc_url( $youtube ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/youtube-2.png" alt="Youtube" />
						Youtube
					</a>
					<?php endif; ?>

					<?php if ( $linkedin ) : ?>
					<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/linkedin-2.png" alt="Linkedin" />
						Linkedin
					</a>
					<?php endif; ?>

					<?php if ( $houzz ) : ?>
					<a href="<?php echo esc_url( $houzz ); ?>" target="_blank">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/tiktok.png" alt="Tik TikTok" />
						TikTok
					</a>
					<?php endif; ?>
				</div>

				<div class="col-sm-6 col-lg-3 col-news">
					<div class="container-form">				
						<?php echo do_shortcode( '[contact-form-7 id="' . get_field( 'formulario_newsletter_footer', 'options' ) . '"]' ); ?>
					</div>
					<script type="text/javascript">
						jQuery( document ).ready(function() {
							var cerrado = true;

							// Abrir formulario de newsletter en footer
							jQuery('.form-cupa-footer').click( function(){
								if ( cerrado ){
									jQuery('html, body').animate({scrollTop: jQuery('body').prop("scrollHeight")-jQuery(window).height()}, 500);
									jQuery(this).addClass('its-open');
									jQuery('.form-cupa-footer .hide').show('slow');
									jQuery('.form-cupa-footer input[type=submit]').css({'pointer-events':'unset'});
									jQuery(this).find('input').first().focus();
									jQuery('.prefooter, footer').addClass('velo-oscuro');
									cerrado = false;
								}
							});

							// Cerrar formulario de newsletter en footer
							jQuery( document ).mouseup( function(e) {
								var container = jQuery('.form-cupa-footer');
								// if the target of the click isn't the container nor a descendant of the container
								if (!container.is(e.target) && container.has(e.target).length === 0) {
									jQuery(container).find('.hide').hide('slow');
									setTimeout( function(){
										jQuery(container).removeClass('its-open');
										jQuery(container).find('div.wpcf7-response-output').hide();
										jQuery('.prefooter, footer').removeClass('velo-oscuro');
										cerrado = true;    
									}, 500 );
								}
							});
						});
					</script>
				</div>

			</div>

			<div class="row">

				<div class="col-lg-12 col-sep">
					<hr>
				</div>

				<div class="col-xl-6 col-legal">
					<p><?php echo esc_html( gmdate( 'Y' ) ) . esc_html__( ' ® Todos los derechos reservados', 'materialwp' ); ?></p>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'legal',
								'depth'          => 1,
								'container'      => false,
								'menu_class'     => 'navbar-nav',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
					?>
				</div>

				<div class="col-xl-6 col-certificados">					
					<?php
					if ( have_rows( 'certificados', 'options' ) ) :
						while ( have_rows( 'certificados', 'options' ) ) :
							the_row();
							$imagen = get_sub_field( 'certificado' );
							$enlace = get_sub_field( 'enlace' );
							?>

							<?php if ( $enlace ) : ?>
							<a href="<?php echo esc_url( $enlace ); ?>" target="_blank">
							<?php endif; ?>

								<img src="<?php echo esc_url( $imagen ); ?>">

							<?php if ( $enlace ) : ?>
							</a>
							<?php endif; ?>

							<?php
						endwhile;
					endif;
					?>
				</div>

			</div>
		</div>
	</footer><!-- #colophon -->

	<div class="mymodal">
		<div class="img-modal">
			<div class="close">+</div>
			<img src="" alt="<?php esc_html_e( 'Imagen', 'materialwp' ); ?>">
			<div class="botones">
				<div class="anterior"></div>
				<div class="siguiente"></div>
			</div>
		</div>
	</div>

<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php

/* Hacce plugin cookies */
if ( shortcode_exists( 'rgpd-custom-scripts' ) ) {
	echo do_shortcode( '[rgpd-custom-scripts]' );
}

/* Botón de pedir presupuesto */
require get_stylesheet_directory() . '/parts/pedir-presupuesto.php';

?>

</body>
</html>
