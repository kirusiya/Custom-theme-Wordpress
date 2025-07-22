<?php
/**
 * The template for displaying gama single taxonomy.
 *
 * @package materialwp
 */

get_header();

$term           = get_term( get_queried_object()->term_id ); //phpcs:ignore
$currentTaxID   = $term->term_id; //phpcs:ignore
$currentTaxName = $term->taxonomy; //phpcs:ignore
$currentTaxSlug = $term->slug; //phpcs:ignore
$tax_fields     = $currentTaxName . '_' . $currentTaxID; //phpcs:ignore

require get_stylesheet_directory() . '/parts/taxonomy-gama/cabecera.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/texto-medio.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/texto-superpuesto-foto.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/texto-medio-2.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/productos.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/video.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/ventajas.php';
require get_stylesheet_directory() . '/parts/taxonomy-gama/galeria.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
