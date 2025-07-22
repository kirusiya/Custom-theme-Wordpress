<?php
/**
 * The template for displaying all single posts.
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

	<div class="container">
		<div class="row">

			<div id="primary" class="col-md-8 col-lg-8">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'content', 'single' );
					endwhile;
					?>

				</main>
			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

</article>

<?php get_footer(); ?>
