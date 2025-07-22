<?php
/**
 * Filtros proyectos
 *
 * @package materialwp
 */

?>

<div class="filtros-productos">
	<div class="container-custom">
		<div class="all-selects">

			<?php

			$args = array(
				'post_type'      => 'proyectos',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			);

			$query_proyectos = new WP_Query( $args );

			?>

			<div class="container-select gama">
				<?php echo getSelectForGamasDeProyecto( $query_proyectos ); //phpcs:ignore ?>
			</div>

			<div class="container-select producto">
				<?php echo getSelectForProductoDeProyecto( $query_proyectos, __( 'Producto', 'materialwp' ), 'Producto' ); //phpcs:ignore ?>
			</div>

			<div class="container-select localizacion">
				<?php echo getSelectForLocalizacionDeProyecto( $query_proyectos, __( 'Localización', 'materialwp' ), 'Localización' ); //phpcs:ignore ?>
			</div>

			<div class="container-select aplicacion">
				<?php echo getSelectForAplicacionesDeProyecto( $query_proyectos ); //phpcs:ignore ?>
			</div>

		</div>
	</div>
</div>

<div class="filters-used">
	<div class="container-custom">
		<div class="all-filters">
			<div class="clean-filters">
				<a href="#"><?php esc_html_e( 'Limpiar filtros', 'materialwp' ); ?></a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" defer>
	jQuery( document ).ready( function() {

		var arrayFilters = [];
		arrayFilters['gama']     = 0;
		arrayFilters['producto']     = 0;
		arrayFilters['localizacion'] = 0;
		arrayFilters['aplicacion'] = 0;

		jQuery('.all-selects select').change( function() {

			var idselect  = jQuery(this).attr( 'id' );
			var idoption = jQuery(this).find( 'option:selected' ).val();
			var text = jQuery(this).find( 'option:selected' ).text();

			if ( arrayFilters[ idselect ] > 0 ) {
				jQuery( '.all-filters .filter#' + idselect ).remove();
				arrayFilters[ idselect ] = 0;
			}

			arrayFilters[idselect] = 1;

			jQuery( this ).parent().addClass('active');

			jQuery( '.all-filters' ).prepend( '<div id="'+idselect+'" class="filter" content="'+idoption+'"><div class="close">+</div>'+text+'</div>' );
			jQuery( '.all-filters .clean-filters' ).show('slow');

			getCustomData();

		});

		function getCustomData(){

			var idgama       = jQuery('.all-filters .filter#gama').attr( 'content' );
			var idproducto   = jQuery('.all-filters .filter#producto').attr( 'content' );
			var idproyecto   = jQuery('.all-filters .filter#localizacion').attr( 'content' );
			var idaplicacion = jQuery('.all-filters .filter#aplicacion').attr( 'content' );

			launchAjax( idgama, idproducto, idproyecto, idaplicacion );
		}

		function launchAjax( _idgama, _idprod, _idproy, _idapl ) {

			var datos = {						
				'action'       : 'get_all_proyectos',
				'idgama'       : _idgama,
				'idproducto'   : _idprod,
				'idproyecto'   : _idproy,
				'idaplicacion' : _idapl,
			};

			jQuery.ajax({
				type : 'post',
				url  : '/wp-admin/admin-ajax.php',
				data : datos,

				beforeSend: function(){
					jQuery( '.posts-proyectos .posts' ).html("");
					jQuery( '.posts-proyectos .posts' ).append( "<div class='searching'></div>");
				},

				success: function( res ){
					if ( res=="" ){						
						res = '<div class="no-results"><?php _e( 'No existen proyectos con los filtros que has seleccionado.<br><br>¿Necesitas ayuda? <div class="boton-cupa-granate"><a href="/contacto/">CONTACTA<span class="arrow-btn"></span></a></div>', 'materialwp' ); //phpcs:ignore ?></div>';
					}
					jQuery( '.posts-proyectos .posts' ).html( res );
				}
			});
		}

		jQuery( document ).on( 'click', '.all-filters .filter .close', function() {
			var id_parent = jQuery(this).parent().attr('id');
			jQuery( '.all-selects select#'+id_parent )[0].selectedIndex = 0;
			jQuery('.all-selects select#'+id_parent).parent().removeClass('active');
			jQuery( this ).parent().remove();
			getCustomData();
			if( jQuery( '.all-filters .filter' ).length == 0 ){
				jQuery( '.all-filters .clean-filters' ).hide();
			}
		});

		jQuery( '.all-filters .clean-filters a' ).click( function() {
			jQuery( '.all-selects select' ).each( function(){
				jQuery( this )[0].selectedIndex = 0;
				jQuery( this ).parent().removeClass('active');
			});			
			jQuery( '.all-filters .filter' ).remove();
			getCustomData();
			jQuery( this ).parent().hide();
		});

		<?php

		$idproducto_pa = $_GET['producto']; //phpcs:ignore

		if ( isset( $idproducto_pa ) && ( '' !== $idproducto_pa ) ) {
			?>

			jQuery('select#producto').val('<?php echo esc_html( $idproducto_pa ); ?>').trigger('change');

			<?php
		}
		?>

		getCustomData();

	});
</script>
