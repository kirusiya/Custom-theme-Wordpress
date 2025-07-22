<?php
/**
 * The template for displaying espacio single taxonomy.
 *
 * @package materialwp
 */

get_header();

$term           = get_term( get_queried_object()->term_id ); //phpcs:ignore
$currentTaxID   = $term->term_id; //phpcs:ignore
$currentTaxName = $term->taxonomy; //phpcs:ignore
$currentTaxSlug = $term->slug; //phpcs:ignore
$tax_fields     = $currentTaxName . '_' . $currentTaxID; //phpcs:ignore

require get_stylesheet_directory() . '/parts/taxonomy-espacio/cabecera.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/texto-medio.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/texto-superpuesto-foto.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/texto-medio-2.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/productos.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/video.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/ventajas.php';
require get_stylesheet_directory() . '/parts/taxonomy-espacio/galeria.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
