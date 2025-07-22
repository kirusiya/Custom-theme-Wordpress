<?php
/**
 * The template for displaying 403 pages.
 *
 * @package materialwp
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="col-md-12 col-lg-12">
			<main id="main" class="site-main" role="main">
				<div class="card">
					<div class="entry-container">
						<section class="error-404 not-found">
							<header>
								<h1 class="page-title"><?php esc_html_e( 'Acceso no permitido.', 'materialwp' ); ?></h1>
							</header>
							<div class="page-content">
								<p><?php esc_html_e( 'Acceso No Permitido. No tiene permiso para acceder a esta sección.', 'materialwp' ); ?></p>
								<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Intenta iniciar sesión primero.', 'materialwp' ); ?></a></p>
							</div>
						</section>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>
