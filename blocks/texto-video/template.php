<!-- BLOQUE TEXTO VIDEO -->
<div class="bloque bloque-texto-video <?php echo $block['className']; ?>">
	<div class="container-custom">
		<div class="row">
			<div class="col-md-8 offset-md-4 outer-video">
				<div class="container-video">
					<?php echo get_field( 'youtube_iframe' ); ?>
				</div>
			</div>
		</div>

		<div class="container-texto">
			<div class="titulo">
				<?php echo get_field( 'titulo' ); ?>
			</div>
			<div class="descripcion">
				<?php echo get_field( 'descripcion' ); ?>
			</div>
		</div>
	</div>
</div>
