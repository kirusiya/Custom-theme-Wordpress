<?php
/**
 * The template for displaying all single productos.
 *
 * @package materialwp
 */

get_header();

require get_stylesheet_directory() . '/parts/single-productos/cabecera.php';
require get_stylesheet_directory() . '/parts/single-productos/subcabecera.php';
require get_stylesheet_directory() . '/parts/single-productos/botones-auxiliares.php';
require get_stylesheet_directory() . '/parts/single-productos/datos-producto.php';
require get_stylesheet_directory() . '/parts/single-productos/proyectos-relacionados.php';
require get_stylesheet_directory() . '/parts/single-productos/doble-cta.php';

get_footer();
