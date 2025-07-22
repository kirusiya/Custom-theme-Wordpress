
<!-- BLOQUE BLOG POSTS -->
<div class="bloque bloque-blog-posts">

	<div class="container-custom">
		
		<div class="container-texto">
			
			<h2 class="titulo mb-5 <?php /* tween1 */ ?>">
				<?php echo get_field('titulo'); ?>
			</h2>

		</div>

		<?php if( get_field('anadir_boton_ver_todas') ): ?>
		<div class="boton-cupa-granate">
			<a href="<?php echo get_field('enlace_ver_todas'); ?>">
				<?php echo get_field('texto_enlace_ver_todas'); ?>
				<span class="arrow-btn"></span>
			</a>
		</div>
		<?php endif; ?>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
		<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.helper.ie8.js"></script><![endif]-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>

		<?php $rand = rand(); ?>
		<?php $tween1 = 'tween1_'.$rand; ?>

		<div class="myslider-<?php echo $rand; ?> container-posts <?php echo $tween1; ?>">			

		<?php

        	$my_posts = new WP_Query( array(
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'posts_per_page'    => 3,
            ));

            if ( $my_posts->have_posts() ):

                $n = 1;

                while( $my_posts->have_posts() ): $my_posts->the_post();

                	$fecha 	= strtoupper( get_the_date( 'd M Y', get_the_ID() ) );
                	                	
                	$categorias = '';
                	$cats = get_the_terms( get_the_ID(), 'category' );
                	if ( $cats ):
                		foreach( $cats as $_cat ):
                			$categorias .= '<a href="' .get_category_link($_cat). '">' .$_cat->name . '</a>, ';
                		endforeach;
                	endif;
                	$categorias = substr( $categorias, 0, -2 );

                	$titulo = get_the_title( get_the_ID() );
	                $imagen = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	                $texto = substr( get_the_content(), 0, 200 ) . ' [...]';
	                $enlace = get_permalink( get_the_ID() );	                
	                
	    ?>

	    	<div class="mypost-<?php echo $n; ?> fake-a-last">
			                	
				                <div class="image-container" style="background-image:url(<?php echo $imagen; ?>);">

				                	<!--<div class="card-info">
				                	
				                		<div class="fecha">
				                			<?php echo $fecha; ?>
				                		</div>
				                	
				                		<div class="categorias">
				                			<?php echo $categorias; ?>
				                		</div>
				                	
				                		<div class="titulo">
				                			<a href="<?php echo $enlace; ?>">
				                				<?php echo $titulo; ?>
				                			</a>
				                		</div>

				                	</div>-->

				                </div>
				                	
				                		<div class="titulo mt-4 pr-4">
				                			<a href="<?php echo $enlace; ?>">
				                				<strong><?php echo $titulo; ?></strong>
				                			</a>
				                		</div>
				                
			</div>



<?php /* ?>
	    	<div class="post-<?php echo $n; ?>">
	    		
	    		<div class="fecha">
	    			<?php echo $fecha; ?>
	    		</div>

	    		<div class="categorias">
	    			<?php echo $categorias; ?>
	    		</div>

	    		<a href="<?php echo $enlace; ?>">

	    			<div class="container-img-post">
	    				<div class="img-post" style="background-image: url(<?php echo $imagen; ?>);"></div>
	    			</div>
		    		
		    		<div class="titulo">
		    			<?php echo $titulo; ?>
		    		</div>

		    		<div class="texto">
		    			<?php echo $texto; ?>
		    		</div>

		    	</a>

	    	</div>
<?php */ ?>

	    <?php
	    			$n++;
				endwhile;

				wp_reset_postdata();

			endif;	    	
	    ?>

		</div>

		<script type="module">
		jQuery( document ).ready( function(){
			var slider = tns({
	            container: '.myslider-<?php echo $rand; ?>',
	            items: 1,
	            controls: false,
	            autoplayButtonOutput: false,
	            nav: false,
	            slideBy: 'page',
	          	autoplay: true,
	            controls: false,
	            mouseDrag: true,

	          	responsive: {
	            	768: {
	                    items: 2
	                },
	                992: {
	                    items: 3
	                }
	            },

	        });

			/* Animation */
			<?php 
			$rnd = '_'.rand(); 
			$base = '.bloque-blog-posts';
			?>

			var scrollMagicController<?php echo $rnd; ?> = new ScrollMagic.Controller();
		    var timeline<?php echo $rnd; ?> = new TimelineMax();

		    timeline<?php echo $rnd; ?>			
			.from("<?php echo $base; ?> <?php echo $tween1; ?>", 1.5, {
				opacity: 0,
			});

			var scene<?php echo $rnd; ?> = new ScrollMagic.Scene({
			    triggerElement: '<?php echo $base; ?>',
			    offset: -50,
			    reverse: false,
			}).setTween( timeline<?php echo $rnd; ?> ).addTo( scrollMagicController<?php echo $rnd; ?> );

			//scene<?php echo $rnd; ?>.addIndicators();	// add indicators for developer times

		});
        </script> 

	</div>
	
</div>

<?php /* ?>
<script type="text/javascript">
jQuery( document ).ready(function() {

	<?php 
	$rnd = '_'.rand(); 
	$base = '.bloque-blog-posts';
	?>

	var scrollMagicController<?php echo $rnd; ?> = new ScrollMagic.Controller();
    var timeline<?php echo $rnd; ?> = new TimelineMax();

    var tween1 = TweenMax.from("<?php echo $base; ?> .tween1 p", 0.8, {
		position: 'relative',
		top: jQuery( '<?php echo $base; ?> .tween1' ).height(),
	});	

	timeline<?php echo $rnd; ?>.add( tween1 );

	var scene<?php echo $rnd; ?> = new ScrollMagic.Scene({
	    triggerElement: '<?php echo $base; ?>',
	    offset: -50,	    
	}).setTween( timeline<?php echo $rnd; ?> ).addTo( scrollMagicController<?php echo $rnd; ?> );

	//scene<?php echo $rnd; ?>.addIndicators();	// add indicators for developer times

});
</script>
<?php */ ?>