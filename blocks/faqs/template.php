<?php

$count_categorias_faqs = wp_count_terms(
	'categoria-faqs',
	array(
		'hide_empty'	=> true,		
	)
);

if ( intval($count_categorias_faqs) <= 0 ):

?>
<!-- FAQS -->
<div class="bloque bloque-faqs">
	<div class="no-faqs">
		<?php _e('No hay FAQs en este momento.', 'materialwp'); ?>
	</div>
</div>

<?php else: ?>

<!-- FAQS -->
<div class="bloque bloque-faqs">

	<div class="container-custom">

	<?php

	$categorias_faqs = get_terms(
		array(
			'taxonomy'		=> 'categoria-faqs',
			'hide_empty'	=> true,
		)
	);

	$n = 1;

	foreach( $categorias_faqs as $_catfaq ){

		$categoria_faq = $_catfaq->name;

		$query = new WP_Query( array(
		    'post_type' 	=> 'faq',
		    'post_status'	=> 'publish',
		    'tax_query' 	=> array(
		        array (
		            'taxonomy' 	=> 'categoria-faqs',
		            'field' 	=> 'term_id',
		            'terms' 	=> $_catfaq->term_id,
		        )
		    ),
		));
	?>

		<div class="grupo-<?php echo $n; ?>">
			
			<h2 class="categoria-faq">
				<?php echo $categoria_faq; ?>
			</h2>

		

	<?php

		$nfaq = 1;

		while ( $query->have_posts() ) : $query->the_post();

			$titulo 	= get_the_title();
			$contenido 	= get_the_content();
	?>

			<div class="faq-<?php echo $nfaq; ?>">
				
				<div class="titulo accordion">
					<?php echo str_replace( '®', '<sup>®</sup>', $titulo ); ?>
				</div>

				<div class="panel">
					<?php echo str_replace( '®', '<sup>®</sup>', $contenido ); ?>
				</div>

			</div>

	<?php
			$nfaq++;

		endwhile;

		wp_reset_query();

		$n++;
	?>

		</div>

	<?php

	}

	?>
	</div>

	<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
	    	this.classList.toggle("active");
	    	var panel = this.nextElementSibling;
	    	if (panel.style.maxHeight) {
	      		panel.style.maxHeight = null;
	    	} else {
	      		panel.style.maxHeight = panel.scrollHeight + "px";
	    	}
	  	});
	}
	</script>

</div>

<?php endif; ?>