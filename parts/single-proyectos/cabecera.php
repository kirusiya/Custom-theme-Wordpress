<!-- CABECERA -->
<div class="bloque bloque-single-proyectos cabecera">
	<div class="row row-top">
		<div class="col-md-12 izq">
			<div class="row row-miga">
				<div class="col-md-9 col-miga">				
					<?php //include(get_stylesheet_directory().'/parts/single-proyectos/miga-de-pan.php'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-down">		
		<div class="col-md-6 izq">
			<div class="row row-titulo-claim">
				<div class="col-md-9 col-titulo-claim pr-md-5">			
					<h1 class="titulo-claim">
						<?php echo get_the_title(); ?>
					</h1>
					<h2><?php echo get_field('claim'); ?></h2>
				</div>
			</div>
			<div class="row row-datos">
				<div class="col-md-6 caja-datos">

					<?php if( get_field('lugar') ): ?>
					<div class="dato lugar">
						<img class="icono" src="<?php echo get_stylesheet_directory_uri(); ?>/images/lugar.png" alt="<?php _e('Lugar', 'materialwp'); ?>">
						<div class="tit"><?php esc_html_e( 'Lugar', 'materialwp' ) ?> </div>						
						<div class="txt">&nbsp;/&nbsp;<?php echo get_field('lugar'); ?></div>
					</div>
					<?php endif; ?>

					<?php if( get_field('ano') ): ?>
					<div class="dato ano">
						<img class="icono" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ano.png" alt="<?php _e('Año', 'materialwp'); ?>">
						<div class="tit"><?php esc_html_e( 'Año', 'materialwp' ) ?></div>
						<div class="txt">&nbsp;/&nbsp;<?php echo get_field('ano'); ?></div>
					</div>
					<?php endif; ?>

					<?php if( get_field('diseno') ): ?>
					<div class="dato diseno">
						<img class="icono" src="<?php echo get_stylesheet_directory_uri(); ?>/images/diseno.png" alt="<?php _e('Diseño', 'materialwp'); ?>">
						<div class="tit"><?php esc_html_e( 'Diseño', 'materialwp' ) ?> </div>
						<div class="txt">&nbsp;/&nbsp;<?php echo get_field('diseno'); ?></div>
					</div>
					<?php endif; ?>

					<?php if( get_field('productos_utilizados') ): ?>
					<div class="dato producto">
						<img class="icono" src="<?php echo get_stylesheet_directory_uri(); ?>/images/producto.png" alt="<?php _e('Producto', 'materialwp'); ?>">
						<div class="tit"><?php esc_html_e( 'Producto', 'materialwp' ) ?> </div>

						<?php
						$productos_utilizados = get_field('productos_utilizados');
						$titulo = "";
						if( $productos_utilizados ){
							$titulo = get_the_title( $productos_utilizados[0]->ID );
							?>
						<div class="txt">&nbsp;/&nbsp;<?php echo $titulo; ?></div>
						<?php } ?>

					</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
		<div class="col-md-6 der">			
			<div class="div-ampliar  <?php if(!get_field('video_youtube_cabecera')): echo "open"; endif;?> ">
			<?php if(get_field('video_youtube_cabecera')):?>		
			<a href="#" class="openvideo" data-izimodal-open="modal-youtube">
				<img  src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt="<?php echo get_the_title(); ?>">
				</a>	
				<?php else:?>	
					<img class="ampliar" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt="<?php echo get_the_title(); ?>">
			<?php endif;?>	
			

			
			
			</div>

			
		</div>
	</div>	
</div>

<?php if(get_field('video_youtube_cabecera')):?>
	<div id="modal-youtube" class="modalyoutube"  data-izimodal-transitionin="fadeInDown" data-izimodal-title="CUPA STONE" data-izimodal-iframeURL="https://www.youtube.com/embed/<?php echo get_field('video_youtube_cabecera');?>?autoplay=1"></div>ç
	<?php endif;?>	