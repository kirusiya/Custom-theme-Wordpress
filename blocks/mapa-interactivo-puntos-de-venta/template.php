<?php
/**
 * Bloque Mapa puntos de venta.
 *
 * @package materialwp
 */

// Orden de los puntos.
$orden = get_field( 'orden_puntos' );
?>

<div class="bloque bloque-mapa-interactivo-puntos-de-venta">
	<div class="row">		
		<div class="col-md-4 colizq">			
			<div class="container-puntos-de-venta">

			<?php

			// Listado de puntos de venta.
			switch ( $orden ) {
				case 'fecha':
					$query = new WP_Query(
						array(
							'post_type'      => 'puntos-de-venta',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'order'			 =>'ASC',
						)
					);
					break;
				case 'nombre':
					$query = new WP_Query(
						array(
							'post_type'      => 'puntos-de-venta',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'orderby'        => 'post_title',
							'order'          => 'ASC',
						)
					);
					break;
				default:
					$query = new WP_Query(
						array(
							'post_type'      => 'puntos-de-venta',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'meta_key'       => 'pais',
							'orderby'        => 'meta_value',
							'order'          => 'ASC',
						)
					);
					break;
			}

			$n = 1;

			while ( $query->have_posts() ) :
				$query->the_post();
				$id_post          = get_the_ID();
				$ciudad           = get_the_title();
				$tipo_comercio    = get_field( 'tipo_comercio', get_the_ID() );
				$persona_contacto = get_field( 'persona_de_contacto', $id_post );
				$fondo_img        = get_field( 'fondo_cabecera', get_the_ID() );
				$direccion        = get_field( 'direccion', get_the_ID() );
				$email            = get_field( 'email', get_the_ID() );
				$telefono_fijo    = get_field( 'telefono', get_the_ID() );
				$fax              = get_field( 'fax', get_the_ID() );
				$location         = get_field( 'localizacion', get_the_ID() );
				$lat              = $location['lat'];
				$lng              = $location['lng'];

				include get_stylesheet_directory() . '/parts/loop/localizacion-punto-de-venta.php';

				$n++;

			endwhile;

			wp_reset_postdata();

			?>

			</div>
		</div>
		<div class="col-md-8 colder">			
			<div class="cupastone-map">

			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				$ciudad         = get_the_title();
				$slug           = get_post_field( 'post_name', get_the_ID() );
				$direccion      = get_field( 'direccion', get_the_ID() );
				$email          = get_field( 'email', get_the_ID() );
				$telefono       = get_field( 'telefono', get_the_ID() );
				$location       = get_field( 'localizacion', get_the_ID() );
				$data_direccion = wp_strip_all_tags( $direccion );

				if ( $location ) :
					?>
					<div 	class="marker"
							data-lat="<?php echo esc_attr( $location['lat'] ); ?>"
							data-lng="<?php echo esc_attr( $location['lng'] ); ?>"
							data-city="<?php echo esc_attr( $ciudad ); ?>"
							data-address="<?php echo esc_attr( $data_direccion ); ?>"
							data-slug="<?php echo esc_attr( $slug ); ?>">

						<div class="marker-html">
							<div class="logo">
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/cupastone-logo-localizaciones.png" alt="Logo">
							</div>

							<?php // @codingStandardsIgnoreStart ?>
							<?php if ( $ciudad ) : ?>
							<div class="ciudad">
								<?php echo $ciudad; ?>
							</div>
							<?php endif; ?>

							<?php if ( $direccion ) : ?>
							<div class="direccion">
								<?php echo $direccion; ?>
							</div>
							<?php endif; ?>

							<?php if ( $email ) : ?>
							<div class="email">
								<a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
							</div>
							<?php endif; ?>

							<?php if ( $telefono ) : ?>
							<div class="telefono">
								<a href="tel:<?php echo $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
							</div>
							<?php endif; ?>
							<?php // @codingStandardsIgnoreEnd ?>

						</div>

					</div>
				<?php endif; ?>

				<?php
			endwhile;
			wp_reset_postdata();
			?>

			</div>
		</div>
	</div>	
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXXXXXXXXXXXXXX"></script> <?php //phpcs:ignore ?>

<script type="text/javascript">

var activeInfoWindow;

var styles = [
	{
		"featureType": "administrative",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#6c516a"
			},
			{
				"visibility": "on"
			}
		]
	},
	{
		"featureType": "administrative.country",
		"elementType": "all",
		"stylers": [
			{
				"color": "#6c516a"
			},
			{
				"visibility": "simplified"
			}
		]
	},
	{
		"featureType": "administrative.province",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "simplified"
			},
			{
				"color": "#6c516a"
			}
		]
	},
	{
		"featureType": "administrative.locality",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "simplified"
			},
			{
				"color": "#6c516a"
			}
		]
	},
	{
		"featureType": "administrative.neighborhood",
		"elementType": "all",
		"stylers": [
			{
				"color": "#6c516a"
			},
			{
				"visibility": "simplified"
			}
		]
	},
	{
		"featureType": "administrative.land_parcel",
		"elementType": "all",
		"stylers": [
			{
				"color": "#6c516a"
			},
			{
				"visibility": "simplified"
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "all",
		"stylers": [
			{
				"color": "#EBE0E6"
			}
		]
	},
	{
		"featureType": "landscape.man_made",
		"elementType": "all",
		"stylers": [
			{
				"color": "#e9d5d3"
			}
		]
	},
	{
		"featureType": "poi",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "off"
			},
			{
				"color": "#ffeeee"
			}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "off"
			},
			{
				"color": "#b7a0a0"
			}
		]
	},			    
	{
		"featureType": "transit",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "transit.station",
		"elementType": "all",
		"stylers": [
			{
				"color": "#ad9cab"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "all",
		"stylers": [
			{
				"color": "#F4F4F4"
			},
			{
				"visibility": "on"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"visibility": "on"
			},
			{
				"color": "#F4F4F4"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "labels.text.stroke",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	}
];

function initMap( $el ) {
	var $markers = $el.find('.marker');

	var styledMapType = new google.maps.StyledMapType(styles, {name: 'Cupastone'});

	var mapArgs = {
		zoom : $el.data('zoom') || 16,
		mapTypeControlOptions : {
			mapTypeIds	: [google.maps.MapTypeId.TERRAIN, 'Cupastone']
		},
		disableDefaultUI: true,
		zoomControl: true,
	};
	var map = new google.maps.Map( $el[0], mapArgs );
	map.mapTypes.set('Cupastone', styledMapType);
	map.setMapTypeId('Cupastone');

	map.markers = [];
	$markers.each(function(){
		initMarker( $(this), map );
	});

	centerMap( map );

	return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {

	// Get position from marker.
	var lat 	= $marker.data('lat');
	var lng 	= $marker.data('lng');
	var city 	= $marker.data('city');
	var slug 	= $marker.data('slug');
	var address = $marker.data('address');
	var latLng = {
		lat: parseFloat( lat ),
		lng: parseFloat( lng )
	};

	var iconBase = '<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/marker_active.png';
	var iconHover = '<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/marker_normal.png';

	// Create marker instance.
	var marker = new google.maps.Marker({
		position : latLng,
		map 	 : map,
		city 	 : city,
		slug 	 : slug,
		address  : address,
		icon     : iconBase,
	});

	// Append to reference for later use.
	map.markers.push( marker );

	// If marker contains HTML, add it to an infoWindow.
	if( $marker.html() ){

		// Create info window.
		var infowindow = new google.maps.InfoWindow({
			content: $marker.html()
		});

		// Show info window when marker is clicked.
		google.maps.event.addListener(marker, 'click', function() {
			if( activeInfoWindow  ){
				activeInfoWindow.close();			        		
			}			        	
			infowindow.open( map, marker );			            
			activeInfoWindow = infowindow;

			//setTimeout( function(){
				jQuery( '.container-puntos-de-venta .loc-'+marker['slug'] ).click();
			//}, 500);

		});

		// Hover in marker
		google.maps.event.addListener(marker, 'mouseover', function() {
			marker.setIcon( iconHover );
		});

		// Hover out marker
		google.maps.event.addListener(marker, 'mouseout', function() {
			marker.setIcon( iconBase );
		});
	}

}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap( map ) {

	// Create map boundaries from all map markers.
	var bounds = new google.maps.LatLngBounds();
	map.markers.forEach(function( marker ){
		bounds.extend({
			lat: marker.position.lat(),
			lng: marker.position.lng()
		});
	});

	// Case: Single marker.
	if( map.markers.length == 1 ){
		google.maps.event.trigger(map.markers[0], 'click');
		map.setCenter( bounds.getCenter() );

	// Case: Multiple markers.
	} else{
		map.fitBounds( bounds );
	}
}

// Render maps on page load.
jQuery(document).ready(function(){
	jQuery('.cupastone-map').each(function(){
		var map = initMap( jQuery(this) );
	});			    
});

</script>
