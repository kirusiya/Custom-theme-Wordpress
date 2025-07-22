<?php if( get_field('mostrar_logos') ): ?>

<!-- BLOQUE LOGOS -->
<div class="bloque bloque-logos <?php echo $block['className']; ?>">

	<div class="container-logos">
		
	<?php

	if( have_rows('logos') ):

		$n = 1;
		$count = count( get_field('logos') );

	 	while ( have_rows('logos') ) : the_row();

	        $logo = get_sub_field('logo');
	?>

		<div class="logo-<?php echo $n; ?>">
			
			<img src="<?php echo $logo; ?>" alt="<?php echo __('Logo ').$n; ?>">

		</div>

	<?php

			if( $n != $count ){

				echo '<div class="separa"></div>';
				
			}

	        $n++;

	    endwhile;

	endif;

	?>

	</div>
	
</div>

<?php endif; ?>