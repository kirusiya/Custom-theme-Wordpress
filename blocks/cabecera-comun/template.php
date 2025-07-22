<?php
/**
 * Bloque Cabecera Común
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-cabecera-comun <?php echo esc_attr( $block['className'] ); ?>">
	<div class="row row-top">
		<div class="col-md-12 izq">
			<div class="row row-miga">
				<div class="col-md-9 col-miga">				
					<?php require get_stylesheet_directory() . '/parts/miga-de-pan-simple.php'; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-titulo">		
		<div class="col-md-12 izq">
			<div class="row row-titulo">
				<div class="col-md-9 col-titulo">				
					<h1 class="titulo">

						<?php
						if ( is_category() ) {
							echo single_cat_title();
						} elseif ( is_archive() ) {
							$post_type_obj = get_post_type_object( get_post_type() );
							echo esc_html( $post_type_obj->labels->name );
						} elseif ( is_home() ) {
							echo get_the_title( get_option( 'page_for_posts', true ) );
						} else {
							if ( get_field( 'titulo_personalizado' ) ) {
								echo get_field( 'titulo_personalizado' );
							} else {
								echo get_the_title();
							}
						}
						?>

					</h1>
				</div>
			</div>
		</div>
	</div>
</div>
