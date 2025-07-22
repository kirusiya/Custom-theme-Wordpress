<?php

if ( isset( $block ) ) {
	// Si viene de un bloque.
	$texto_prefooter = get_field( 'texto_prefooter' );
	$texto_boton     = get_field( 'texto_boton' );
	$enlace_boton    = get_field( 'enlace_boton' );

} elseif ( is_singular( 'proyectos' ) || is_singular( 'post' ) || is_archive( 'productos' ) || ( ! is_front_page() && is_home() ) ) {
	// Si es un post type concreto.
	$texto_prefooter = get_field( 'texto_prefooter_proyectos', 'options' );
	$texto_boton     = get_field( 'texto_boton_prefooter_proyectos', 'options' );
	$enlace_boton    = get_field( 'enlace_boton_prefooter_proyectos', 'options' );

} elseif ( is_singular( 'productos' ) ) {
	// Si es un post type concreto o su archive.
	$texto_prefooter = get_field( 'texto_prefooter_productos', 'options' );
	$texto_boton     = get_field( 'texto_boton_prefooter_productos', 'options' );
	$enlace_boton    = get_field( 'enlace_boton_prefooter_productos', 'options' );

} elseif ( is_tax( 'galeria' ) || is_singular( 'eventos' ) || is_tax( 'gama' ) ) {
	// Si es una taxonomía concreta.
	$texto_prefooter = get_field( 'texto_prefooter_galeria', 'options' );
	$texto_boton     = get_field( 'texto_boton_prefooter_galeria', 'options' );
	$enlace_boton    = get_field( 'enlace_boton_prefooter_galeria', 'options' );
}
?>

<!-- PREFOOTER -->
<div class="prefooter <?php echo $block['className']; ?>">
	<div class="container-custom">
		<div class="row">
			<div class="col-md-10 izq">
				<h2><?php echo $texto_prefooter; ?></h2>
			</div>
			<div class="col-md-2 der">
				<div class="boton-cupa-blanco">
					<a href="<?php echo $enlace_boton; ?>">
						<?php echo $texto_boton; ?>
						<span class="arrow-btn"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
