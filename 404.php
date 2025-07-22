<?php
/**
 * The template for displaying 404 (Not Found) pages.
 *
 * @package materialwp
 */

get_header();
?>

<div id="page" class="error py-5">
	<article class="article p-5">
		<div id="content_box" class="p-4">
			<div class="col-md-8 offset-md-2 error404">

				<header>
					<h1 class="page-title"><?php _e( 'Error <span>404</span>', 'materialwp' ); //phpcs:ignore ?></h1>
					<p><?php esc_html_e( 'La página que está buscando no existe', 'materialwp' ); ?></p>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'Intente buscarla de nuevo', 'materialwp' ); ?></p>
					<form class="busqueda" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="d-flex justify-content-center align-items-end">
							<div class="col-sm-7 caja-busqueda">
								<div class=" md-form form-sm">
								<input  type="text" name="s" class="form-control" />
								<label for="s"><?php esc_html_e( 'Buscar', 'materialwp' ); ?></label>
								</div>
							</div>
							<div class="boton-buscar">
								<input type="submit" class="btn" value="<?php esc_html_e( 'Buscar', 'materialwp' ); ?>" />
							</div>
						</div>
					</form>

					<div class="items_404 d-flex justify-content-center">
						<div class="col-md-2 col-xs-4 bordegris">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/anterior.png" />
							<a href="javascript:history.back(1)"><?php esc_html_e( 'Anterior', 'materialwp' ); ?></a>
						</div>
						<div class=" col-md-2 col-xs-4 bordegris ">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/inicio.png" />
							<a href="<?php echo esc_url( get_site_url() ); ?>"><?php esc_html_e( 'Inicio', 'materialwp' ); ?></a>
						</div>
						<div class=" col-md-2 col-xs-4 ">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/enviar.png" />
							<a href="<?php echo esc_url( get_site_url() ); ?>/contacto/"><?php esc_html_e( 'Contáctanos', 'materialwp' ); ?></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</article>
</div>

<?php get_footer(); ?>
