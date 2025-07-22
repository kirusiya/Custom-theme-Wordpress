
<?php

$tax_id = get_queried_object()->term_id;
$term = get_term( $tax_id );
$nombre_galeria = $term->name;

?>

<!-- MIGA DE PAN -->
<div class="miga-de-pan taxonomy-galeria">

	<ul>
				
		<li><a href="<?php echo get_home_url(); ?>"><?php _e('Inicio', 'materialwp'); ?></a> / </li>

		<li><a href="<?php echo get_permalink(1299); ?>"><?php _e('Galería', 'materialwp'); ?></a> / </li>
		
		<li class="ultimo"><?php echo $nombre_galeria; ?></li>

	</ul>
	
</div>