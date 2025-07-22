<?php
/**
 * Faqs
 *
 * @package materialwp
 */

$categorias_faqs = get_terms(
	array(
		'taxonomy'   => 'faqs',
		'hide_empty' => true,
	)
);

?>

<div class="bloque bloque-faqs"></div>
