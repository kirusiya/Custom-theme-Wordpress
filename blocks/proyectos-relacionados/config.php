<?php

HacceBlocks::register(array(

	/*
	 * Propiedades obligatorias
	 */

	//el nombre tiene que ser el mismo al de la carpeta
	'name'				=> 'proyectos-relacionados',

	//título y descripción a mostrar en la lista de bloques
	'title'				=> __('Proyectos relacionados', 'hacce'),
	'description'		=> __('', 'hacce'),

	/*
	 * Propiedades personalizadas
	 */
	//'enqueue_styles'            => array('assets/style.css'),
	//'enqueue_scripts'           => array('assets/script.js'),

	/*
	 * Propiedades opcionales
	 * (si no se asignan funcionarán por defecto)
	 */
	//'category'		=> 'formatting',
	'icon'			=> 'list-view',
	//'keywords'		=> array( 'hacce', 'prueba' ),
	//'render_callback' => function($block){}

));

//wp_enqueue_script( 'bloque_slide', get_template_directory_uri() . '/blocks/slide/slide.js', array('jquery'), '1.0', true );
