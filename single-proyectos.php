<?php
/**
 * The template for displaying all single proyectos.
 *
 * @package materialwp
 */

get_header();

require get_stylesheet_directory() . '/parts/single-proyectos/cabecera.php';
require get_stylesheet_directory() . '/parts/single-proyectos/textos.php';
require get_stylesheet_directory() . '/parts/single-proyectos/productos-utilizados.php';
require get_stylesheet_directory() . '/parts/single-proyectos/proyectos-relacionados.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
