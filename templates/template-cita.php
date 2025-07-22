<?php
/**
 * Template Name: Página de cita previa
 *
 * @package materialwp
 */

get_header();

wp_enqueue_style( 'Flatpicker', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), '1.0.0' );
wp_enqueue_script( 'Flatpicker', 'https://cdn.jsdelivr.net/npm/flatpickr', array(), '1.0.0', true );
wp_enqueue_script( 'FlatpickerFR', 'https://npmcdn.com/flatpickr/dist/l10n/fr.js', array(), '1.0.0', true );

// Días bloqueados.
$dias = array();
if ( have_rows( 'dias_bloqueados', 'options' ) ) {
	while ( have_rows( 'dias_bloqueados', 'options' ) ) {
		the_row();
		array_push( $dias, get_sub_field( 'dia_bloqueado' ) );
	}
}
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

<script>
	jQuery(document).ready(function($){
		$('#cita-datetime').flatpickr({
			minDate: 'today',
			dateFormat: 'd/m/Y H:i',
			disableMobile: true,
			enableTime: true,
			time_24hr: true,
			locale: 'fr',
			minuteIncrement: 30,
			minTime: "09:00",
			maxTime: "17:00",

			<?php if ( count( $dias ) ) : ?>
			disable: [
				function(date) {
					return (date.getDay() === 0 || date.getDay() === 6);
				},
				<?php foreach ( $dias as $dia ) : ?>
				'<?php echo esc_html( $dia ); ?>',
				<?php endforeach; ?>
			],
			<?php endif; ?>

		});
	});
</script>
