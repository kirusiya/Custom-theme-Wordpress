<?php if( !get_field('ocultar_bloque') ): ?>

<!-- PROYECTOS RELACIONADOS -->
<div class="bloque bloque-gama-completa">

	<div class="titulos container-custom">
		
		<?php /* ?>
		<div class="sup">
			<?php echo get_field( 'titulo_superior' ); ?>
		</div>
		<?php */ ?>

		<div class="inf">
			<?php echo get_field( 'titulo_inferior' ); ?>
		</div>

	</div>

</div>

<div class="bloque bloque-hero-home bloque-single-proyectos proyectos-relacionados">

	<div class="container-hero">

		<div class="fondos" style="background-image: url(<?php echo get_field( 'fondo_base_home', 'options' ); ?>);"></div>

		<div class="cajas">

			<script type="text/javascript">
				function hoverAsincrono(n){
					jQuery('.container-hero .fondos div[class^=fondo-]').hide();
					jQuery('.container-hero .fondos .fondo-' + n ).show();					
				}
				function hoverAsincronoTodos(){
					jQuery('.container-hero .fondos div[class^=fondo-]').hide();
				}
			</script>

			


			<?php 

			$args = array(
			    'post_type' 		=> 'proyectos',
			    'post_status' 		=> 'publish',
			    //'post__not_in' 		=> array( get_the_ID() ),
			    'posts_per_page' 	=> 4,
			    'orderby' 			=> 'rand',

			    'meta_query'     	=> array(
			        'key'      	=> 'productos_utilizados',
			        'compare'	=> 'IN',
			        'value'    	=> get_the_ID(),
			    ),

			);

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) {

			    $html_fondos = '';

			    $n = 0;

			    while ( $posts->have_posts() ) { $posts->the_post();

			    	$n++;			        
			        $id_post = get_the_ID(); 

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
							<?php echo substr( $contenido, 0, 100 ) . '...'; ?>
						</div>

						<div class="aspa"></div>

					</div>

				</a>

			</div>

			<?php		    
			    }
			    
			    wp_reset_postdata();

			    $html_fondos .= '<div class="velo-completo-negro"></div>';

			}

			?>

			<script type="text/javascript">
				jQuery( document ).ready(function() {

					jQuery('.container-hero .fondos').append( '<?php echo $html_fondos; ?>' );

					jQuery('div[class^=caja-]').hover( function(){
						nfondo = jQuery(this).attr('fondo');
						setTimeout( "hoverAsincrono(" +nfondo+ ")", 300 );
					});

				});
			</script>

		</div>

	</div>	
	
</div>

<?php endif; ?>