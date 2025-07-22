<?php
/**
 * Bloque Cabecera puntos de venta.
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-single-proyectos cabecera bloque-cabecera-puntos-de-venta">

	<div class="row row1">
		<div class="col-md-12 izq">
			<div class="row row-miga">
				<div class="col-md-9 col-miga">
					<?php /*require get_stylesheet_directory() . '/parts/miga-de-pan-simple.php';*/ //phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row row2">
		<div class="container">
			<h1 class="titulo">
				<?php echo get_field( 'titulo' ); //phpcs:ignore ?>
			</h1>
			<div class="buscador">
				<input type="text" placeholder="<?php esc_html_e( 'Introduce tu ciudad', 'materialwp' ); ?>" class="input-ciudad">
			</div>
		</div>
	</div>	
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {

	var country = 'ES';
	var datos   = {
		'action' : '',
		'ciudad' : '',
		'lat'	 : '',
		'lng'	 : '',
	};

	// Buscar y centrar el mapa
	jQuery('.input-ciudad').on('keypress', function(e) {
		if(e.which == 13) {
			if ( jQuery(this).val().length <= 3 ) {
				alert('Escriba más de tres caracteres');
			} else {
				jQuery(this).prop("disabled", true);
				datos['ciudad'] = jQuery(this).val();
				getLatLng_items( jQuery(this).val() );
				getLatLng_map( jQuery(this).val() );
				jQuery(this).prop("disabled", false);
				jQuery(this).focus();			
			}
		}
	});

	// Buscar listado por ciudad
	function getLatLng_items( city ) {
		city = city.replace( " ", "%20" );
		jQuery.getJSON( 'https://maps.googleapis.com/maps/api/geocode/json?components=locality:'+city,
			{
				'sensor' : 'false',
				'types'  : '(regions)',
				'key'    : 'XXXXXXXXXXXXXXXXXXXXXXXXXXX',
			}, 
			function( data ) {
				if( data.results[0] ) {
					datos['action'] = 'get_localizaciones_items';
					datos['lat'] = data.results[0].geometry.location.lat;
					datos['lng'] = data.results[0].geometry.location.lng;
					launchAjax_items();
				} else {
					launchAjax_todo();
				}
			}
		);
	}

	// Buscar en mapa por ciudad
	function getLatLng_map( city ) {
		city = city.replace( " ", "%20" );
		jQuery.getJSON( 'https://maps.googleapis.com/maps/api/geocode/json?components=locality:'+city,
			{
				'sensor' : 'false',
				'types'  : '(regions)',
				'key'    : 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
			}, 
			function( data ) {
				if( data.results[0] ) {
					datos['action'] = 'get_localizaciones_map';
					datos['lat'] = data.results[0].geometry.location.lat;
					datos['lng'] = data.results[0].geometry.location.lng;
					launchAjax_map();
				} else {
					launchAjax_todo();
				}
			}
		);
	}

	// Recargar mapa
	function launchAjax_map() {
		jQuery.ajax({
			type: 'post',
			url:  '/wp-admin/admin-ajax.php',
			data: datos,
			beforeSend: function(){
				jQuery(".cupastone-map").html("");
				jQuery(".cupastone-map").append("<div class='searching'></div>");
			},
			success: function(res){
				jQuery(".cupastone-map").html(res);
				initMap( jQuery('.cupastone-map') );
			}
		});
	}

	// Recargar listado
	function launchAjax_items() {
		jQuery.ajax({
			type: 'post',
			url:  '/wp-admin/admin-ajax.php',
			data: datos,
			beforeSend: function(){
				jQuery(".container-puntos-de-venta").html("");
				jQuery(".container-puntos-de-venta").append("<div class='searching'></div>");
			},
			success: function(res){
				jQuery(".container-puntos-de-venta").html(res);
			}
		});
	}

	// Recargar mapa y listado
	function launchAjax_todo() {
		datos = {						
			'action' : '',
			'ciudad' : '',
			'lat'	 : '',
			'lng'	 : '',
		};
		jQuery.ajax({
			type: 'post',
			url:  '/wp-admin/admin-ajax.php',
			data: {
				'action' : 'get_all_localizaciones_items',
			},			
			beforeSend: function(){
				jQuery(".container-puntos-de-venta").html("");
				jQuery(".container-puntos-de-venta").append("<div class='searching'></div>");
			},
			success: function(res){
				jQuery(".container-puntos-de-venta").html(res);
			}
		});
		jQuery.ajax({
			type: 'post',
			url:  '/wp-admin/admin-ajax.php',
			data: {
				'action' : 'get_all_localizaciones_map',
			},			
			beforeSend: function(){
				jQuery(".cupastone-map").html("");
				jQuery(".cupastone-map").append("<div class='searching'></div>");
			},
			success: function(res){
				jQuery(".cupastone-map").html(res);
				initMap( jQuery('.cupastone-map') );
			}
		});
		jQuery('.buscador input').val('');
	}

	// Recargar todos los puntos
	jQuery( document ).on( 'click', '.ver-todos a', function() {
		launchAjax_todo();
	});

	// Abrir detalles de unpunto
	jQuery( document ).on( 'click', '.container-puntos-de-venta div[class^=localizacion-]', function() {
		if ( !jQuery(this).hasClass('primer-plano') ){
			datos['id_post'] = jQuery(this).attr('id_post');
			launchAjax_item_single();
			launchAjax_map_single();
		}
	});

	// Cargar info de un punto
	function launchAjax_item_single() {
		datos['action']  = 'get_single_localizacion_item';
		jQuery.ajax({
			type: 'post',
			url:  '/wp-admin/admin-ajax.php',
			data: datos,
			beforeSend: function(){
				jQuery(".container-puntos-de-venta").html("");
				jQuery(".container-puntos-de-venta").append("<div class='searching'></div>");
			},
			success: function(res){
				jQuery(".container-puntos-de-venta").html(res);
				jQuery(".container-puntos-de-venta .localizacion-1").addClass('primer-plano');
				jQuery(".container-puntos-de-venta .close-loc").css({'display':'flex'});
			}
		});
	}

	// Cargar localización en mapa de un punto
	function launchAjax_map_single() {
		datos['action']  = 'get_single_localizacion_map';
		jQuery.ajax({
			type: 'post',
			url:  '/wp-admin/admin-ajax.php',
			data: datos,			
			beforeSend: function(){
				jQuery(".cupastone-map").html("");
				jQuery(".cupastone-map").append("<div class='searching'></div>");
			},
			success: function(res){
				jQuery(".cupastone-map").html(res);
				initMap( jQuery('.cupastone-map') );
			}
		});
	}

	// Carrar detalles de punto y mostrar todo
	jQuery( document ).on( 'click', '.container-puntos-de-venta .close-loc', function() {
		jQuery('.container-puntos-de-venta .localizacion-1').removeClass('primer-plano');
		jQuery(".container-puntos-de-venta .close-loc").hide();		
		launchAjax_todo();
	});

	<?php
	// Cargar un punto de venta por URL al cargar página.
	$slug = strtolower( $_SERVER['QUERY_STRING'] );	//phpcs:ignore
	if ( slugExists( $slug, 'puntos-de-venta' ) ) :
		?>

	jQuery('.container-puntos-de-venta div[ciudad=<?php echo $slug;	//phpcs:ignore ?>]').click();

	<?php endif; ?>

});

</script>
