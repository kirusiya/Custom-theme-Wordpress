<?php
/**
 * The template for displaying archive productos.
 *
 * @package materialwp
 */

get_header();

require get_stylesheet_directory() . '/blocks/cabecera-comun/template.php';
require get_stylesheet_directory() . '/parts/archive-productos/filtros.php';
require get_stylesheet_directory() . '/parts/archive-productos/posts-productos.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
