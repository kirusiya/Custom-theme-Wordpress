<?php
/**
 * Search Form Template
 *
 * @package materialwp
 */

?>

<div class="md-form">
	<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" id="s" class="form-control" name="s" /><label for="s"><?php esc_html_e( 'Buscar', 'materialwp' ); ?></label>
		<button type="submit" class="btn btn_lupa"><i class="fa fa-search"></i></button>
	</form>
</div>
