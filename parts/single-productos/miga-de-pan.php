<?php
/**
 * Página de producto: breadcrumb.
 *
 * @package materialwp
 */

$prod_slug = get_option( 'cupa_cpt_productos' );
if ( ! $prod_slug ) {
	$prod_slug = 'productos';
}

?>

<div class="miga-de-pan">
	<ul>
		<li><a href="<?php echo esc_url( get_home_url() ); ?>"><?php esc_html_e( 'Inicio', 'materialwp' ); ?></a> / </li>
		<li><a href="/<?php echo esc_html( $prod_slug ); ?>/"><?php esc_html_e( 'Productos', 'materialwp' ); ?></a> / </li>
		<li class="ultimo"><?php the_title(); ?></li>
	</ul>	
</div>
