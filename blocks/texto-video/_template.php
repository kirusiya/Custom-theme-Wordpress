
<!-- BLOQUE TEXTO VIDEO -->
<div class="bloque bloque-texto-video <?php echo $block['className']; ?>">

	<div class="container-custom">

		<div class="row">
		
			<div class="col-md-8 offset-md-4 outer-video">

				<div class="container-video">
					
					<iframe src="https://www.youtube-nocookie.com/embed/OGsFyt0tKyc?controls=0&amp;autoplay=1&amp;start=4&amp;disablekb=1&amp;fs=0&amp;loop=1&amp;modestbranding=0&amp;rel=0&amp;showinfo=0&amp;mute=1&amp;mode=opaque&amp;autohide=1&amp;wmode=transparent&amp;playlist=OGsFyt0tKyc" frameborder="0"></iframe>

				</div>

			</div>

		</div>

		<div class="container-texto">
					
			<?php /* ?>
			<div class="subtitulo">
				<?php echo get_field( 'subtitulo' ); ?>
			</div>
			<?php */ ?>

			<div class="titulo">
				<?php echo get_field( 'titulo' ); ?>
			</div>

			<div class="descripcion">
				<?php echo get_field( 'descripcion' ); ?>
			</div>

		</div>

	</div>
	
</div>