<?php
/**
 * Template Name: Tabla de productos para exportar
 *
 * @package materialwp
 */

$query = new WP_Query(
	array(
		'post_type'      => 'productos',
		'post_status'    => 'any',
		'posts_per_page' => -1,
	)
);
?>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Título</th>
			<th>Descripción</th>
			<th>Formato</th>
			<th>Opciones</th>
		</tr>
	</thead>

<?php
while ( $query->have_posts() ) :
	$query->the_post();
	?>
	<tr>
		<td><?php the_ID(); ?></td>
		<td><?php the_title(); ?></td>
		<td><?php the_content(); ?></td>
		<td><?php echo esc_html( get_field( 'formato', get_the_ID() ) ); ?></td>
		<td><?php echo esc_html( get_field( 'opciones', get_the_ID() ) ); ?></td>
	</tr>
	<?php
endwhile;
