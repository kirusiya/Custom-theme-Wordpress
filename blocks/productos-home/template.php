<?php
/**
 * Bloque Productos home.
 *
 * @package materialwp
 */

$img_izq  = get_field( 'imagen_izquierda' );
$logo_izq = get_field( 'logo_izquierda' );
$link_izq = get_field( 'enlace_izquierda' );
$img_der  = get_field( 'imagen_derecha' );
$logo_der = get_field( 'logo_derecha' );
$txt_der  = get_field( 'texto_derecha' );
$link_der = get_field( 'enlace_derecha' );
$img_der2 = get_field( 'imagen_derecha_2' );
$btn_der  = get_field( 'boton_derecha' );
?>

<div class="bloque bloque-productos-home">
	<div class="container">
		<div class="row">
			<div class="col-xl izq p-0 fake-a mb-4 mb-xl-0">

				<?php
				if ( $img_izq ) {
					echo wp_get_attachment_image( $img_izq, 'large', false, array( 'class' => 'fondo' ) );
				}
				?>

				<div class="dentro px-5">
					<a href="<?php echo $link_izq ? esc_url( $link_izq ) : '#'; ?>">
						<?php
						if ( $logo_izq ) {
							echo wp_get_attachment_image( $logo_izq, 'large', false, array( 'class' => 'logo' ) );
						}
						?>
					</a>
				</div>

			</div>
			<div class="col-xl der p-0">
				<div class="arriba fake-a">

					<?php
					if ( $img_der ) {
						echo wp_get_attachment_image( $img_der, 'large', false, array( 'class' => 'fondo' ) );
					}
					?>

					<div class="dentro px-5">

						<?php if ( $txt_der ) : ?>

						<div class="boton-cupa-blanco">
							<a href="<?php echo $link_der ? esc_url( $link_der ) : '#'; ?>">
								<?php echo esc_html( $txt_der ); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>

						<?php elseif ( $logo_der ) : ?>

						<a href="<?php echo $link_der ? esc_url( $link_der ) : '#'; ?>">
							<?php echo wp_get_attachment_image( $logo_der, 'large', false, array( 'class' => 'logo' ) ); ?>
						</a>

						<?php endif; ?>
					</div>

				</div>
				<div class="abajo fake-a">

					<?php
					if ( $img_der2 ) {
						echo wp_get_attachment_image( $img_der2, 'large', false, array( 'class' => 'fondo' ) );
					}
					?>

					<div class="dentro px-5">
						<?php if ( $btn_der ) : ?>
						<div class="boton-cupa-blanco">
							<a href="<?php echo esc_url( $btn_der['url'] ); ?>" target="<?php echo esc_attr( $btn_der['target'] ); ?>">
								<?php echo esc_html( $btn_der['title'] ); ?>
								<span class="arrow-btn"></span>
							</a>
						</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
