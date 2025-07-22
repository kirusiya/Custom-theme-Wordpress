<?php
/**
 * Template Name: Página de contacto
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

<script>
	jQuery(document).ready(function($){

		<?php if ( isset( $_GET['form'] ) && 'profesional' === $_GET['form']) : //phpcs:ignore ?>

			$('.btn-profesional').addClass('active');
			$('.bloque-form-particular').hide();

		<?php else : ?>

			$('.btn-particular').addClass('active');
			$('.bloque-form-profesional').hide();

		<?php endif; ?>

		$('.btn-particular').on('click',function(e){
			$('.btn-profesional').removeClass('active');
			$('.btn-particular').addClass('active');
			$('.bloque-form-profesional').hide();
			$('.bloque-form-particular').fadeIn();
		});

		$('.btn-profesional').on('click',function(e){
			$('.btn-particular').removeClass('active');
			$('.btn-profesional').addClass('active');
			$('.bloque-form-particular').hide();
			$('.bloque-form-profesional').fadeIn();
		});

		$('input[type=hidden].your-previous-page').attr('value',document.referrer);
	});
</script>
