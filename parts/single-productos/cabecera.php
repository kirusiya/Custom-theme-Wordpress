<?php
/**
 * Cabecera de producto
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-single-proyectos cabecera bloque-single-productos cabecera-productos">

	<div class="row row1">
		<div class="col-md-12 izq">
			<div class="row row-miga">
				<div class="col-md-9 col-miga">				
					<?php require get_stylesheet_directory() . '/parts/single-productos/miga-de-pan.php'; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row row2">

	<?php if ( have_rows( 'imagenes' ) ) : ?>

		<div class="container-imagenes dragscroll">

		<?php
		$n = 1;
		while ( have_rows( 'imagenes' ) ) :
			the_row();
			$imagen = get_sub_field( 'imagen' );
			?>

			<div class="imagen-<?php echo esc_html( $n ); ?>" style="background-image: url(<?php echo esc_url( $imagen ); ?>);">
				<img 	class="ampliar d-none"
						src="<?php echo esc_url( $imagen ); ?>"
						alt="<?php echo esc_html( get_the_title() . ' ' . $n ); ?>"
						imagen="<?php echo esc_html( $n ); ?>">

				<?php if ( 1 === intval( $n ) ) : ?>
				<div class="titulo">
					<h1><?php echo str_replace( '®', '<sup>®</sup>', get_the_title() ); //phpcs:ignore ?></h1>
					<div class="boton-cupa-blanco">
						<a href="#" class="show-gallery">
							<?php esc_html_e( 'Ver galería', 'materialwp' ); ?>
							<span class="arrow-btn"></span>
						</a>
					</div>
				</div>
				<?php endif; ?>

				<div class="overlay"></div>
			</div>

			<?php
			$n++;
		endwhile;
		?>

			<script type="text/javascript">
				jQuery( document ).ready(function() {

					var totalImagenes = <?php echo esc_html( ( $n - 1 ) ); ?>;
					var currentImagen = 1;

					jQuery('.mymodal .img-modal .botones .anterior').click( function(){
						if ( currentImagen == 1 ){
							currentImagen = totalImagenes;
						}
						mostrarImagen('prev');
					});

					jQuery('.mymodal .img-modal .botones .siguiente').click( function(){
						if ( currentImagen == totalImagenes ){
							currentImagen = 0;
						}
						mostrarImagen('next');
					});

					function mostrarImagen( direction ){
						if ( direction == 'next' ){
							currentImagen++;
						} else if( direction == 'prev' ){
							currentImagen--;
						}

						var src = jQuery('.cabecera-productos .ampliar[imagen='+currentImagen+']').attr('src');
						jQuery('.mymodal .img-modal img').attr('src', src);
					}

					<?php if ( 1 < $n ) : ?>
					jQuery('.show-gallery').on( 'click', function(){
						var src = jQuery('.cabecera-productos .ampliar[imagen=1]').attr('src');
						jQuery('.mymodal .img-modal img').attr('src', src);
						jQuery('.mymodal .img-modal .botones').show();
						jQuery('.mymodal').show();
					});
					<?php endif; ?>

				});
			</script>

		</div>

	<?php endif; ?>

	</div>	
</div>
