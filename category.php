<?php
/**
 * The template for displaying all archive category posts.
 *
 * @package materialwp
 */

get_header();

require get_stylesheet_directory() . '/blocks/cabecera-comun/template.php';
require get_stylesheet_directory() . '/parts/category/posts.php';
require get_stylesheet_directory() . '/blocks/prefooter/template.php';

get_footer();
