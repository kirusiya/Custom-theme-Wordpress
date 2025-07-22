<?php
/**
 * The template for displaying all single posts.
 *
 * @package materialwp
 */

get_header();

require get_stylesheet_directory() . '/parts/single-post/cabecera.php';

$currenCategory      = get_the_category(); //phpcs:ignore
$currentCategorySlug = $currentCategory[0]->slug; //phpcs:ignore

if ( ( 'evento' === $currentCategorySlug ) && ( eventNotExpired( get_field( 'cuando' ) ) ) && ( get_field( 'cuando' ) || get_field( 'donde' ) ) ) : //phpcs:ignore
	include get_stylesheet_directory() . '/parts/single-post/cuando-donde.php';
endif;

require get_stylesheet_directory() . '/parts/single-post/contenido.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
