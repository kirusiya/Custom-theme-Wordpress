<?php
/**
 * Template Name: Página sostenibilidad
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
