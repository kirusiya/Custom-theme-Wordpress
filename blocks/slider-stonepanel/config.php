<?php

HacceBlocks::register(array(

	/*
	 * Propiedades obligatorias
	 */

	//el nombre tiene que ser el mismo al de la carpeta
	'name'				=> 'slider-stonepanel',

	//título y descripción a mostrar en la lista de bloques
	'title'				=> __('Slider Stonepanel', 'hacce'),
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
	'icon'			=> 'slides',
	//'keywords'		=> array( 'hacce', 'prueba' ),
	//'render_callback' => function($block){}

));

//wp_enqueue_script( 'bloque_slide', get_template_directory_uri() . '/blocks/slide/slide.js', array('jquery'), '1.0', true );

function separateOneByOne( $text ){
	if( strlen($text) > 0 ){
		$text = trim($text);
		$html = '';
		for( $i=0; $i<strlen($text); $i++ ) {
			$char = mb_substr( $text, $i, 1 );
			if ( $char == ' ' ){
				$html .= '<span class="normal">&nbsp;</span>';
			} else if( $char == '®' ){
				$html .= '<span class="normal copyright"><sup>' .$char. '</sup></span>';
			} else {
				$html .= '<span class="normal">' .$char. '</span>';
			}			
		}
		return $html;
	}
	return false;
}