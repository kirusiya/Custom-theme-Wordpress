<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package materialwp
 */

get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	require get_stylesheet_directory() . '/parts/cabecera-espaciado.php';
	require get_stylesheet_directory() . '/parts/cabecera-interiores.php';
	?>

	<div class="container">
		<div class="row">
			<div id="primary">
				<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							if ( is_post_type_archive( 'eventos' ) ) {
								include get_stylesheet_directory() . '/parts/loop/evento.php';
							} else {
								get_template_part( 'content', get_post_format() );
							}
						}
						include get_stylesheet_directory() . '/parts/paginacion.php';
					} else {
						get_template_part( 'content', 'none' );
					}
					?>

				</main>
			</div>
		</div>
	</div>
</article>

<?php get_footer(); ?>
