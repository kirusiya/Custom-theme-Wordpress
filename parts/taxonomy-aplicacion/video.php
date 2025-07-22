
<?php if( get_field( 'video_zona_media', $tax_fields ) ): ?>
<!-- VIDEO -->
<div class="bloque bloque-taxonomy-gama taxonomy-gama-video">

	<div class="container-custom">
		
		<div class="video">
			
			<video id="myVideo2" controls loop muted>
				<source src="<?php the_field( 'video_zona_media', $tax_fields ); ?>" type="video/mp4">
			  	Your browser does not support HTML5 video.
			</video>

		</div>

	</div>

	<script type="text/javascript">
	jQuery( window ).on( 'load', function($) {
	    onlyOneFire = true;
	    var myVideo2 = document.getElementById("myVideo2");

	    jQuery( window ).scroll( function(){
	        checkVisibility();    
	    });

	    function checkVisibility(){
	        if ( ( Utils.isElementInView( jQuery('video#myVideo2'), false) && onlyOneFire ) ){
	            onlyOneFire = false;
	            myVideo2.play();
	        }
	    }

	    checkVisibility();
	});
	</script>

</div>
<?php endif; ?>