
<?php

$productos_utilizados = get_field('productos_utilizados');

if( $productos_utilizados ) {

	$rand = rand();
?>

<!-- PRODUCTOS UTILIZADOS -->
<div class="bloque bloque-single-proyectos productos-utilizados">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
	<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.helper.ie8.js"></script><![endif]-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
	
	<div class="myslider-<?php echo $rand; ?>">

	<?php
	
	if(count($productos_utilizados) == 1){
		foreach( $productos_utilizados as $_producto ){

		    $enlace = get_permalink( $_producto->ID );
		    $titulo = get_the_title( $_producto->ID );
		    $imagen = get_the_post_thumbnail_url( $_producto->ID, 'full' );
	?>

		<div class="slide">
			
			<div class="row">
				
				<div class="col-md-6 izq">

					<div class="inner-izq">
					
						<div class="cabecera">
							<?php _e('Producto<br><b>utilizado</b>', 'materialwp'); ?>
						</div>

						<div class="titulo">
							<?php echo $titulo; ?>
						</div>

						<div class="boton-cupa-granate">
							<a href="<?php echo $enlace; ?>">
								<?php _e('VER PRODUCTO', 'materialwp'); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>

					</div>

				</div>

				<div class="col-md-6 der">

					<div class="container-imagen">
						
						<img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>">
						
					</div>
					
				</div>

			</div>

		</div>

	<?php		    	
		}
	}else{

			
		?>
	
			<div class="slide grid">
				
				<div class="row">
					
					<div class="col-md-12 izq" style="display:block">
	
						<div class="inner-izq">
						
							<div class="cabecera">
								<?php
									
									// Obtiene el nombre del dominio
									$domain = $_SERVER['HTTP_HOST'];
									
									// Determina el idioma en base al dominio
									if (strpos($domain, 'cupastone.es') !== false) {
										_e('Productos <b>utilizados</b>', 'materialwp'); // Español
									} elseif (strpos($domain, 'cupastone.fr') !== false) {
										_e('Produits <b>utilisés</b>', 'materialwp'); // Francés
									} elseif (strpos($domain, 'cupastone.pt') !== false) {
										_e('Produtos <b>utilizados</b>', 'materialwp'); // Portugués
									} elseif (strpos($domain, 'cupastone.de') !== false) {
										_e('Verwendete <b>Produkte</b>', 'materialwp'); // Alemán
									} else {
										_e('Products <b>used</b>', 'materialwp'); // Inglés para cualquier otro caso o dominio genérico
									}
									?>
								
								
							</div>
	
							
	
						</div>
	
					</div>
					<?php
					foreach( $productos_utilizados as $_producto ){

						$enlace = get_permalink( $_producto->ID );
						$titulo = get_the_title( $_producto->ID );
						$imagen = get_the_post_thumbnail_url( $_producto->ID, 'full' );
					?>
	
					<div class="col-md-4 der">
	
						<div class="container-imagen grid">
							<a href="<?php echo $enlace; ?>">
								<img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>">
								<span><?php echo $titulo; ?></span>
							</a>
							
						</div>
						
					</div>
					<?php
					}
					?>
	
				</div>
	
			</div>

		
	<?php
			
	};
	?>

	</div>

	<script type="module">
		jQuery( document ).ready( function(){
			var slider = tns({
	            container: '.myslider-<?php echo $rand; ?>',
	            items: 1,
	            controls: false,
	            autoplayButtonOutput: false,
	            nav: false,
	            slideBy: 1,
	         	autoplay: true,
	            controls: true,
	            mouseDrag: true,
				/*
	          	responsive: {
	                768: {
	                    items: 2
	                },
					992: {
	                	items: 3
	              	}
	            },
				*/
	        });
		});        
    </script>
	
</div>

<?php

}

?>