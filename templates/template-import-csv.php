<?php
/**
 * Template Name: Import CSV
 *
 * @package materialwp
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="primary" class="">
		<main id="main" class="site-main" role="main">
			<div class="content-page">
				<?php require get_stylesheet_directory() . '/parts/import-csv-productos.php'; ?>
			</div>
		</main>
	</div>
</article>

<?php get_footer(); ?>
