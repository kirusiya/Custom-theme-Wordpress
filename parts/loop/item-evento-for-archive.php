<?php
/**
 * Loop de Evento.
 *
 * @package materialwp
 */

$id_evento       = $idEvento; //phpcs:ignore
$imagen_post     = get_the_post_thumbnail_url( $id_evento, 'full' );
$fecha_post      = strtoupper( get_the_date( 'd M Y', get_the_ID() ) );
$taxonomies_post = '';

$tax_tipo = get_the_terms( $id_evento, 'tipos-de-evento' );
$tax_pais = get_the_terms( $id_evento, 'paises' );

if ( $tax_tipo ) :
	foreach ( $tax_tipo as $_tipo ) :
		$taxonomies_post .= $_tipo->name . ', ';
	endforeach;
endif;

if ( $tax_pais ) :
	foreach ( $tax_pais as $_pais ) :
		$taxonomies_post .= $_pais->name . ', ';
	endforeach;
endif;

$taxonomies_post = substr( $taxonomies_post, 0, -2 );
$enlace_post     = get_permalink( $id_evento );
$titulo_post     = get_the_title( $id_evento );

?>

<div class="mypost-<?php echo esc_html( $n ); ?>">
	<div class="image-container fake-a" style="background-image:url(<?php echo esc_url( $imagen_post ); ?>);">
		<div class="card-info">
			<div class="fecha">
				<?php echo esc_html( $fecha_post ); ?>
			</div>
			<div class="categorias">
				<?php echo esc_html( $taxonomies_post ); ?>
			</div>
			<div class="titulo">
				<a href="<?php echo esc_url( $enlace_post ); ?>">
					<?php echo esc_html( $titulo_post ); ?>
				</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery('.fake-a').on('click',function(e){
	document.location.href = jQuery(this).find('a')[0].href;
});
</script>
