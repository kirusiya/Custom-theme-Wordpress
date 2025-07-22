
<?php 

//$proyectos_relacionados = get_field( 'proyectos_relacionados' );

if ( ! get_field( 'ocultar_bloque_proyectos_relacionados' ) ):

/*
	$array_proyectos = [];

	foreach ( $proyectos_relacionados as $_proyecto ) {
		$array_proyectos[] = $_proyecto->ID;
	}

	$args = array(
	    'post_type' 	=> 'proyectos',
	    'post_status'	=> 'publish',
	    'post__in' 		=> $array_proyectos,
	    'orderby' 		=> 'rand',
	);

	$posts = new WP_Query( $args );
*/
/*
	$args = array(
	    'post_type' 		=> 'proyectos',
	    'post_status' 		=> 'publish',
	    'posts_per_page' 	=> 4,
	    'orderby' 			=> 'rand',
	    'meta_query'		=> array(
	    	array(
		    	'key'		=> 'productos_utilizados',
		    	'compare'	=> 'LIKE',
		    	'value'		=> get_the_ID(),
		    ),
	    ),
	);

	$posts = new WP_Query( $args );

	if ( $posts->found_posts > 0 ):
*/

	$featured_posts = get_field('proyectos_relacionados');

	if( $featured_posts ):

?>

<!-- PROYECTOS RELACIONADOS -->
<div class="bloque-single-proyectos cabecera-productos-relacionados">

	<div class="row">

		<div class="col-md-10 unico">
		
			<div class="titulo">

				<?php

				$gama = '';				
				$terms = get_the_terms( get_the_ID(), 'gama' );
			    if ( $terms ):
			        foreach( $terms as $_term ) {
			            $gama = $_term->name;
			        }			        
			    endif;

				?>

				<?php echo __( 'Proyectos ' ) . '<span>' .$gama. '</span>'; ?>

			</div>

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
/*
			$args = array(
			    'post_type' 		=> 'proyectos',
			    'post_status' 		=> 'publish',
			    'posts_per_page' 	=> 4,
			    'orderby' 			=> 'rand',
			    'meta_query'		=> array(
			    	array(
				    	'key'		=> 'productos_utilizados',
				    	'compare'	=> 'LIKE',
				    	'value'		=> get_the_ID(),
				    ),
			    ),
			);

			$posts = new WP_Query( $args );
*/
			if ( $featured_posts ) {

			    $html_fondos = '';

			    $n = 0;

			    //while ( $posts->have_posts() ) { $posts->the_post();
			    foreach( $featured_posts as $post ) {

			    	setup_postdata($post);

			    	$n++;			        
			        //$id_post = get_the_ID(); 
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

<?php endif; ?>