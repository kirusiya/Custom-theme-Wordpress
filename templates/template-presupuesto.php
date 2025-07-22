<?php
/**
 * Template Name: Presupuesto
 *
 * @package materialwp
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	require get_stylesheet_directory() . '/parts/cabecera-espaciado.php';
	require get_stylesheet_directory() . '/parts/cabecera-interiores.php';
	?>

	<div id="primary" class="">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
				if ( '' !== $post->post_content ) :
					?>
					<div class="content-page">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			<?php endwhile; ?>

		</main>
	</div>

</article>

<?php get_footer(); ?>


<script type="text/javascript">
$( document ).ready(function() {
	$( '.btn-cambiar' ).on( 'click', function() {
		var paso = $( this ).data( 'paso' );
		cambiarPaso( paso );
	} );
	$( '.btn-proyecto' ).on( 'click', function() {
		console.log('hace click')
		var respuesta_val = $( this ).data( 'respuesta' );
		var respuesta_txt = $( this ).data('valor');
		$( '#field-proyecto' ).val( respuesta_txt );
		$( '#field-proyecto-pro' ).val( respuesta_txt );
		cambiarPaso( 2 );
		switch ( respuesta_val ) {
			case 'a':
			case 'b':
				$('input[name="presupuesto"][value="Hasta 5000"]').prop('checked', true);
				$('.paso-3 .presupuesto').removeClass('cd').addClass('ab');
				break;
			case 'c':
			case 'd':
				$('input[name="presupuesto"][value="Entre 5000 y 15000"]').prop('checked', true);
				$('.paso-3 .presupuesto').removeClass('ab').addClass('cd');
				break;
		}
	} );
});

function cambiarPaso( paso ) {
	$( '#form-presupuesto .pasos' ).hide();
	$( '#form-presupuesto .pasos.paso-' + paso ).fadeIn();
}
</script>
