<?php if( get_field('mostrar_cifras') ): ?>

<!-- BLOQUE CIFRAS -->
<div class="bloque bloque-cifras <?php echo $block['className']; ?>">

	<h2><?php echo get_field('titulo'); ?></h2>

	<div class="container-custom container-cifras">
		
	<?php

	if( have_rows('cifras') ):

		$n = 1;

	 	while ( have_rows('cifras') ) : the_row();

	        $numero = get_sub_field('numero');
	        $texto  = get_sub_field('texto');
	?>

		<div class="cifra-<?php echo $n; ?>">
			
			<div class="numero counter" data-count="<?php echo $numero; ?>">0</div>

			<div class="texto">
				<?php echo $texto; ?>
			</div>

		</div>

	<?php
	        $n++;

	    endwhile;

	endif;

	?>

	</div>

	<script type="text/javascript">
	jQuery( document ).ready( function($) {
	    onlyOneFire = true;
	    
	    $(window).scroll(function(){
	        checkVisibility();    
	    });

	    function checkVisibility(){
	        if ( ( Utils.isElementInView( $('.container-cifras'), false) && onlyOneFire ) ){
	            onlyOneFire = false;
	            countUpAnimation( '.counter', 5000 );
	        }
	    }

	    checkVisibility();
	});
	</script>
	
</div>

<?php endif; ?>