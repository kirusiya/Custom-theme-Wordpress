
<!-- BLOQUE HERO HOME -->
<div class="bloque bloque-hero-home">

	<div class="container-hero">

		<div class="fondos" style="background-image: url(<?php echo get_field( 'fondo_base_home', 'options' ); ?>);"></div>

		<div class="cajas">

			<script type="text/javascript">
				function hoverAsincrono(n){
					if ( (n != 1) && (n != 8) ){
						jQuery('.container-hero .fondos').css({'background-image':'unset'});
					}
					jQuery('.container-hero .fondos div[class^=fondo-]').hide();
					jQuery('.container-hero .fondos .fondo-' + n ).fadeIn(1400);
				}
			</script>

			<div class="caja-1" fondo="1">
				
				<div class="texto-caja1">
					<?php _e( '<span>Piedra</span> <span>Natural</span>', 'materialwp' ); ?>
				</div>

			</div>

			<?php

			$html_fondos = '';

			$html_fondos .= '<div class="fondo-1" style="background-image: url(' .get_field( 'fondo_base_home', 'options' ). ')"></div>';

			$posts = get_field( 'proyectos' );

			if( $posts ):

				$n = 1;

			    foreach( $posts as $post ): // variable must be called $post (IMPORTANT)
			    	$n++;
			        setup_postdata( $post );
			        $id_post = $post->ID; 

			        $titulo 	= get_the_title( $id_post );
			        $contenido 	= get_the_content( $id_post );
			        $imagen 	= get_the_post_thumbnail_url( $id_post, 'full' );
			        $enlace		= get_permalink( $id_post );

			        $html_fondos .= '<div class="fondo-' .$n. '" style="background-image: url(' .$imagen. ')"></div>';
			?>

			<div class="caja-<?php echo $n; ?>" fondo="<?php echo $n; ?>">

				<a href="<?php echo $enlace ?>">
					
					<div class="texto-inferior">
						<?php echo $titulo; ?>
					</div>

					<div class="div-hover">
							
						<?php /* ?>
						<div class="cabecera">
							<?php _e( 'Proyecto', 'materialwp' ); ?>
						</div>
						<?php */ ?>

						<div class="titulo">
							<?php echo $titulo; ?>
						</div>

						<div class="contenido">
							<?php
							$contenido = ( strlen($contenido) < 100 ) ? $contenido : substr( $contenido, 0, 100 ) . '...';
							echo $contenido;
							?>
						</div>

						<div class="aspa"></div>

					</div>

				</a>

			</div>

			<?php		    
			    endforeach;
			    
			    wp_reset_postdata();

			endif;

			?>

			<div class="caja-8" fondo="8">

				<div class="texto-caja8 boton-cupa-blanco">
					<a href="<?php echo get_field('enlace_ver_mas_proyectos'); ?>">
						<?php echo get_field( 'texto_enlace_ver_mas_proyectos' ); ?>
						<span class="arrow-btn"></span>
					</a>
				</div>

			</div>

			<?php

			$html_fondos .= '<div class="fondo-8" style="background-image: url(' .get_field( 'fondo_base_home', 'options' ). ')"></div>';

			$html_fondos .= '<div class="velo-completo-negro"></div>';

			?>

			<script type="text/javascript">
				jQuery( document ).ready(function() {

					jQuery('.container-hero .fondos').append( '<?php echo $html_fondos; ?>' );

					jQuery('div[class^=caja-]').hover( function(){
						nfondo = jQuery(this).attr('fondo');
						setTimeout( "hoverAsincrono(" +nfondo+ ")", 300 );
					});

					jQuery('.texto-caja1').each(function() {
						words = jQuery(this).text().split(' ');
						jQuery(this).empty().html(function() {
							for (i = 0; i < words.length; i++) {
								if (i == 0) {
									jQuery(this).append('<span>' + words[i] + '</span>');
								} else {
									jQuery(this).append(' <span>' + words[i] + '</span>');
								}
							}					
						});
					});					
				});
			</script>

		</div>

	</div>	
	
</div>