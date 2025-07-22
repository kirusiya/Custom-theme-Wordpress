
<!-- BLOQUE SLIDER STONE PANEL -->
<div class="bloque bloque-slider-stonepanel <?php echo $block['className']; ?>">

	<div class="row row1">
		
		<div class="col-md-12 izq">

			<div class="row row-miga">

				<div class="col-md-9 col-miga">
				
					<?php //include(get_stylesheet_directory().'/parts/single-productos/miga-de-pan.php'); ?>

				</div>

			</div>

		</div>

	</div>

	<?php /* ?>
	<div class="logo-stone-panel">
		<img src="<?php echo get_stylesheet_directory_uri().'/images/logo-stonepanel-1.png'; ?>" alt="<?php _e( 'Stonepanel&copy;' ); ?>" />
	</div>
	<?php */ ?>

	<div class="slider-stonepanel">

		<div class="outer-slider">

			<div class="tns-controls controles">
				<button data-controls="prev" tabindex="-1" aria-controls="tns1" type="button">prev</button>
				<button data-controls="next" tabindex="-1" aria-controls="tns1" type="button">next</button>
			</div>

			<div class="slides">

				<?php

				$my_posts = new WP_Query( array(
	                'post_type'         => 'productos',
	                'post_status'       => 'publish',
	                'posts_per_page'    => -1,
	                'tax_query'		=> array(
				    	array(
					    	'taxonomy'	=> 'gama',
					    	'field'		=> 'slug',
					    	'terms'		=> 'stonepanel',
					    ),
				    ),
	            ));

	            if ( $my_posts->have_posts() ):

	                $n = 1;

	                while( $my_posts->have_posts() ): $my_posts->the_post();

	                	$titulo 		= get_the_title( get_the_ID() );
	                	$contenido		= get_the_content( get_the_ID() );
		                $imagen_slider 	= get_field( 'imagen_para_slider', get_the_ID() );	                
		                $enlace 		= get_permalink( get_the_ID() );
		        ?>

		        <div class="imagen-<?php echo $n; ?>" imagen="<?php echo $n; ?>">
		        	
		        	<div class="inner-imagen">

			        	<div class="titulo titulo-detras">
			        		<?php echo separateOneByOne($titulo); ?>
			        		<div class="titulo-mobile">
			        			<?php echo $titulo; ?>
			        		</div>			        		
			        	</div>

			        	<div class="img-principal">
			        		<img src="<?php echo $imagen_slider; ?>" alt="<?php echo $titulo; ?>" data-speed="0.02"/>
			        	</div>

			        	<div class="titulo titulo-delante">
			        		<?php echo separateOneByOne($titulo); ?>
			        		<div class="titulo-mobile">
			        			<?php echo $titulo; ?>
			        		</div>
			        	</div>

			        	<div class="container-contenido">
			        		<?php /* ?>
			        		<div class="contenido">
			        			<?php echo $contenido; ?>
			        		</div>
			        		<?php */ ?>
			        		<div class="boton-cupa-granate">
			        			<a href="<?php echo $enlace; ?>">
	                        		<?php _e('Ver ficha', 'materialwp') ?>
	                        		<span class="arrow-btn"></span>
	                    		</a>
	                		</div>
			        	</div>

			        </div>

		        </div>

		        <?php

		                $n++;

		            endwhile;

		        endif;

				?>

			</div>

		</div>

		<script type="module">
		jQuery( document ).ready( function(){
			var slider = tns({
	            container: '.slides',
	            items: 3,
	            controls: false,
	            autoplayButtonOutput: false,
	            nav: false,
	            slideBy: 1,
	          	autoplay: false,			// AUTOPLAY!!!!	            
	            mouseDrag: false,
	            edgePadding: -500,
	            speed: 2000,
	            loop: true,
	        });

	        var pulsa = false;

	        jQuery('.tns-controls button[data-controls=prev]').click( function(){ 
	        	pulsa = 'prev';	        	
	        	fire();      	
	        });
	        jQuery('.controles button[data-controls=next]').click( function(){
	        	pulsa = 'next';
	        	fire();
	        });


	        function fire(){
	        	salidaLetras();

	        	setTimeout( function(){
		        	slider.goTo( pulsa );		        	
		        	borraClasesPrincipales();
		        	ponClasesPrincipales();
		        	
		        }, 250);

		        setTimeout( function(){
		        	entradaLetras();		        	
		        }, 2500);

		        setTimeout( function(){
		        	return true;
		        }, 2501);
	        }


			function borraClasesPrincipales() {
				jQuery('.slides .tns-item.anterior').removeClass('anterior');
				jQuery('.slides .tns-item.active').removeClass('active');
				jQuery('.slides .tns-item.siguiente').removeClass('siguiente');
				//console.log('borraClasesPrincipales');
	        }

	        function ponClasesPrincipales() {
	        	var list = document.querySelectorAll('.slides .tns-slide-active');
	        	list[0].classList.add('anterior');
	        	list[1].classList.add('active');
	        	list[2].classList.add('siguiente');
	        	//console.log('ponClasesPrincipales');
	        }

	        function salidaLetras() {
	        	var elem1 = '.slides div[class^=imagen-].active .inner-imagen .titulo-detras span';
	        	var elem2 = '.slides div[class^=imagen-].active .inner-imagen .titulo-delante span';
	        	
	        	var time = 0;
	        	var pixels = 500;
	        	jQuery( jQuery(elem1).get().reverse() ).each( function(){
	        		time += 0.05;
	        		pixels += 25;
	        		jQuery(this).css({
	        			'opacity'				: '1',
	        			'transform'				: 'translate3d(' +pixels+ 'px, 0px, 0px)',
	        			'transition' 			: 'all ' +time+ 's linear',
	        			'transform-duration' 	: time + 's',
	        		});
	        	});
	        	time = 0;
	        	pixels = 500;
	        	jQuery( jQuery(elem2).get().reverse() ).each( function(){
	        		time += 0.05;
	        		pixels += 25;
	        		jQuery(this).css({
	        			'opacity'				: '1',
	        			'transform'				: 'translate3d(' +pixels+ 'px, 0px, 0px)',
	        			'transition' 			: 'all ' +time+ 's linear',
	        			'transform-duration' 	: time + 's',
	        		});
	        	});
	        	//console.log('salidaLetras');
	        }

	        function entradaLetras() {
	        	var elem1 = '.slides div[class^=imagen-].active .inner-imagen .titulo-detras span';
	        	var elem2 = '.slides div[class^=imagen-].active .inner-imagen .titulo-delante span';
	        	jQuery( elem1 +','+ elem2 ).removeClass( 'normal' );
	        	jQuery('.slides div[class^=imagen-].active .inner-imagen .titulo-delante').show();
	        	
	        	var time = 0;
	        	var pixels = 1;
	        	jQuery( jQuery(elem1).get().reverse() ).each( function(){
	        		time += 0.3;
	        		pixels += 5;
	        		jQuery(this).css({
	        			'opacity'				: '1',
	        			'transform'				: 'translate3d(10px, 0px, 0px)',
	        			'transition' 			: 'all ' +time+ 's ease',
	        			'transform-duration' 	: time + 's',
	        		}).delay(time);
	        	});
	        	var init = 0;
	        	jQuery( jQuery(elem2).get().reverse() ).each( function(){
	        		init += 0.3;
	        		jQuery(this).css({
	        			'opacity'				: '1',
	        			'transform'				: 'translate3d(10px, 0px, 0px)',
	        			'transition' 			: 'all ' +init+ 's ease',
	        			'transform-duration' 	: init + 's',
	        		}).delay(init);
	        	});
	        	//console.log('entradaLetras');
	        }

	        /*
	        function resetLetras() {
	        	var elem = '.slides div[class^=imagen-]:not(.active) .inner-imagen .titulo span';
	        	jQuery( elem ).addClass( 'normal' );
	        	//console.log('resetLetras');
	        }
	        */
	        
	        window.onload = (function(){

	        	document.body.style.opacity='1'

	        	/* Loaded slider */
		        ponClasesPrincipales();

		        entradaLetras();	        	

		        jQuery('#preloader-slider').hide('slow');
		        jQuery('.slider-stonepanel').show('slow');
	        });

	        
	        


	        /* Image parallax */
			document.querySelector(".bloque-slider-stonepanel").addEventListener('mousemove', imageParallax);

			function imageParallax( e = new Event() ){
			    var wx = jQuery(window).width();
				var wy = jQuery(window).height();							
				var x = e.pageX - this.offsetLeft;
				var y = e.pageY - this.offsetTop;							
				var newx = x - wx/2;
				var newy = y - wy/2;
				jQuery('.active .img-principal img').each(function(){
					var speed = jQuery(this).attr('data-speed');
					if( jQuery(this).attr('data-revert')) speed *= -1;
					TweenMax.to( jQuery(this), 1, {x: (1 + newx*speed), y: (1 + newy*speed)});
				});	
			}

		});
        </script> 

	</div>

	<div id="preloader-slider">
		<img src="<?php echo get_stylesheet_directory_uri().'/images/preloader.gif'; ?>" alt="<?php _e('Preloader'); ?>">
	</div>

</div>