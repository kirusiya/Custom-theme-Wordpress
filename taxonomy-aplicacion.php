<?php
/**
 * The template for displaying aplicacion single taxonomy.
 *
 * @package materialwp
 */

get_header();

$term           = get_term( get_queried_object()->term_id ); //phpcs:ignore
$currentTaxID   = $term->term_id; //phpcs:ignore
$currentTaxName = $term->taxonomy; //phpcs:ignore
$currentTaxSlug = $term->slug; //phpcs:ignore
$tax_fields     = $currentTaxName . '_' . $currentTaxID; //phpcs:ignore

require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/cabecera.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/texto-medio.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/texto-superpuesto-foto.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/texto-medio-2.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/productos.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/video.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/ventajas.php';
require get_stylesheet_directory() . '/parts/taxonomy-aplicacion/galeria.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
