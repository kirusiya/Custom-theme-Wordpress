<?php
/**
 * The template for displaying archive proyectos.
 *
 * @package materialwp
 */

get_header();

require get_stylesheet_directory() . '/blocks/cabecera-comun/template.php';
require get_stylesheet_directory() . '/parts/archive-proyectos/filtros.php';
require get_stylesheet_directory() . '/parts/archive-proyectos/posts-proyectos.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
