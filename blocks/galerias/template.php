
<?php

$terms = get_terms( array(
	'taxonomy' 	 => 'galeria',
	'parent'     => 0,
	'hide_empty' => true,
	'orderby' 	 => 'id',
    'order' 	 => 'ASC',
) );

if ( $terms ):
?>

<!-- BLOQUE GALERÍAS -->
<div class="bloque bloque-galerias <?php echo $block['className']; ?>">

	<div class="container-custom">

		<div class="container-galerias">

<?php
	foreach( $terms as $_galeria ) {
		$id_galeria 	= $_galeria->term_id;
		$nombre_galeria = $_galeria->name;
		$enlace_galeria = get_term_link( $id_galeria );
?>

			<div class="galeria-<?php echo $id_galeria; ?>">

				<h2 class="nombre">
					<a href="<?php echo $enlace_galeria; ?>" title="<?php echo $nombre_galeria; ?>">
						<?php echo $nombre_galeria; ?>
					</a>
				</h2>

				<a href="<?php echo $enlace_galeria; ?>">
					<div class="imagen" style="background-image: url(<?php echo get_field( 'imagen', 'galeria_'.$id_galeria ); ?> );">
						<img src="<?php echo get_field( 'imagen', 'galeria_'.$id_galeria ); ?>" alt="Galería <?php echo $nombre_galeria; ?>">
					</div>
				</a>

			</div>

<?php

	}
?>

		</div>

	</div>
	
</div>

<?php

endif;

?>
