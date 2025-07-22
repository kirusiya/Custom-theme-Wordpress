<?php
include_once ('acf.php');

// Añadimos los CPTs
foreach (glob(get_stylesheet_directory()."/hincludes/cpt/cpt_*.php") as $filename){
    include_once $filename;
}

include(get_stylesheet_directory().'/hincludes/variables.php');

// Incluimos los bloques custom
add_action('hacce_blocks', function(){    
    foreach(glob(get_stylesheet_directory().'/blocks/*/config.php') as $filename){
        include_once($filename);
    }
});

// Idiomas de plantilla
function materialwp_language() {
    load_theme_textdomain( 'materialwp', get_template_directory() . '/languages' );

    $locale      = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";

    if ( is_readable( $locale_file ) ) {
        require_once( $locale_file );
    }
}
add_action( 'after_setup_theme', 'materialwp_language' );

// Idiomas de slugs
function cupastone_load_permalinks() {
    if( isset( $_POST['cupa_cpt_productos'] ) ) {
        update_option( 'cupa_cpt_productos', sanitize_title_with_dashes( $_POST['cupa_cpt_productos'] ) );
    }
    if( isset( $_POST['cupa_cpt_proyectos'] ) ) {
        update_option( 'cupa_cpt_proyectos', sanitize_title_with_dashes( $_POST['cupa_cpt_proyectos'] ) );
    }
    if( isset( $_POST['cupa_cpt_aplicaciones'] ) ) {
        update_option( 'cupa_cpt_aplicaciones', sanitize_title_with_dashes( $_POST['cupa_cpt_aplicaciones'] ) );
    }
    if( isset( $_POST['cupa_cpt_espacios'] ) ) {
        update_option( 'cupa_cpt_espacios', sanitize_title_with_dashes( $_POST['cupa_cpt_espacios'] ) );
    }
    if( isset( $_POST['cupa_cpt_gamas'] ) ) {
        update_option( 'cupa_cpt_gamas', sanitize_title_with_dashes( $_POST['cupa_cpt_gamas'] ) );
    }
    add_settings_field( 'cupa_cpt_productos', __( 'CPT Productos', 'materialwp' ), 'cupastone_cpt_productos_callback', 'permalink', 'optional' );
    add_settings_field( 'cupa_cpt_proyectos', __( 'CPT Proyectos', 'materialwp' ), 'cupastone_cpt_proyectos_callback', 'permalink', 'optional' );
    add_settings_field( 'cupa_cpt_aplicaciones', __( 'TAX Aplicación', 'materialwp' ), 'cupa_cpt_aplicaciones_callback', 'permalink', 'optional' );
    add_settings_field( 'cupa_cpt_espacios', __( 'TAX Espacio', 'materialwp' ), 'cupa_cpt_espacios_callback', 'permalink', 'optional' );
    add_settings_field( 'cupa_cpt_gamas', __( 'TAX Gama', 'materialwp' ), 'cupa_cpt_gamas_callback', 'permalink', 'optional' );
}
add_action( 'load-options-permalink.php', 'cupastone_load_permalinks' );

function cupastone_cpt_productos_callback() {
    $value = get_option( 'cupa_cpt_productos' );
    echo '<input type="text" value="' . esc_attr( $value ) . '" name="cupa_cpt_productos" id="cupa_cpt_productos" class="regular-text" />';
}

function cupastone_cpt_proyectos_callback() {
    $value = get_option( 'cupa_cpt_proyectos' );
    echo '<input type="text" value="' . esc_attr( $value ) . '" name="cupa_cpt_proyectos" id="cupa_cpt_proyectos" class="regular-text" />';
}

function cupa_cpt_aplicaciones_callback() {
    $value = get_option( 'cupa_cpt_aplicaciones' );
    echo '<input type="text" value="' . esc_attr( $value ) . '" name="cupa_cpt_aplicaciones" id="cupa_cpt_aplicaciones" class="regular-text" />';
}

function cupa_cpt_espacios_callback() {
    $value = get_option( 'cupa_cpt_espacios' );
    echo '<input type="text" value="' . esc_attr( $value ) . '" name="cupa_cpt_espacios" id="cupa_cpt_espacios" class="regular-text" />';
}

function cupa_cpt_gamas_callback() {
    $value = get_option( 'cupa_cpt_gamas' );
    echo '<input type="text" value="' . esc_attr( $value ) . '" name="cupa_cpt_gamas" id="cupa_cpt_gamas" class="regular-text" />';
}

/**
 * CSS Admin.
 */
function admin_style() {
    wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/style-admin.css', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'admin_style' );

// Limitar cantidad de palabras en el excerpt
function extracto($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

// Obtener idiomas
function get_languages() {
    $langs = array();

    if ( have_rows( 'idiomas', 'options' ) ) {
        while ( have_rows( 'idiomas', 'options' ) ) {
            the_row();
            $url    = get_sub_field( 'enlace' );
            $lang   = get_sub_field( 'acronimo' );
            $langs[] = array(
                'url'  => $url,
                'lang' => $lang,
            );
        }
    }

    return $langs;
}

// Obtener idioma activado
function get_actual_language() {
    $urls_lang = get_languages();
    $lang_btn  = '';
    foreach ( $urls_lang as $lang ) {
        if ( $lang['url'] === 'https://' . $_SERVER['SERVER_NAME'] ) { //phpcs:ignore
            $lang_btn = $lang['lang'];
        }
    }
    return $lang_btn;
}

// Limpiar un string, muy util para las anclas custom
function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


/* Funcion para traducir con wpml, pensada para el contact form 7 traducible */
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');
function my_wpcf7_form_elements($form) {
    return do_shortcode($form);
}


/* Paginacion */
if ( ! function_exists( 'material_pagination' ) ) :
    /**
     * Paginación.
     *
     * @param array $wp_query Consulta.
     */
    function material_pagination( $wp_query ) {
        echo paginate_links(
            array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $wp_query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'add_args'     => true,
                'add_fragment' => '',
                'prev_text'    => '<span class="fas fa-chevron-left"></span>',
                'next_text'    => '<span class="fas fa-chevron-right"></span>'
            )
        );
    }
endif;


/* Añadir opciones personalizadas generales */
if( function_exists('acf_add_options_page')){
    acf_add_options_page(array(
        'page_title' => 'Opciones',
        'menu_title' => 'Opciones de plantilla',
        'menu_slug' => 'opciones',
        'position' => 2,
        'icon_url' => 'dashicons-admin-tools',
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Header',
        'menu_title' => 'Header',
        'menu_slug' => 'opciones-header',
        'parent_slug' => 'opciones',
        'position' => false,
        'icon_url' => false,
    ));
   /* acf_add_options_sub_page(array(
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'menu_slug' => 'opciones-footer',
        'parent_slug' => 'opciones',
        'position' => false,
        'icon_url' => false,
    )); */
    acf_add_options_sub_page(array(
        'page_title' => 'Generales',
        'menu_title' => 'Generales',
        'menu_slug' => 'opciones-generales',
        'parent_slug' => 'opciones',
        'position' => false,
        'icon_url' => false,
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Single productos',
        'menu_title' => 'Single productos',
        'menu_slug' => 'opciones-single-productos',
        'parent_slug' => 'opciones',
        'position' => false,
        'icon_url' => false,
    ));
}


/* Añadir menús */
register_nav_menus(
    array(
        'topbar' => __( 'Menú topbar', 'materialwp' ),
        'footer' => __( 'Menú footer', 'materialwp' ),
        'legal'  => __( 'Menú legal', 'materialwp' ),
    )
);


/* Sacar id */
function Seccion_ID($id){
    if($id):
        $id=$id;
        $html=' id='.$id;
    else:
        $id_seccion=get_sub_field('id');
        if($id_seccion):
            $id=$id_seccion;
            $html=' id='.$id;
        else:
            $id="";
            $html="";
        endif;
    endif;
    return $html;
}


/* ACF PRO hook to set up google maps API key */
add_action('acf/init', 'my_acf_init');
function my_acf_init() {    
    acf_update_setting('google_api_key', 'XXXXXXXXXXXXXXXXXXXX');
}


/* Return url taxonomy */
function getURLTaxonomyForSingleProduct( $id_post, $taxonomy ){
    $link = '';    
    $terms = get_the_terms( $id_post, $taxonomy );
    if ( $terms ):
        foreach( $terms as $_term ) {
            $mytax = str_replace( " ", "-", strtolower( changeVocals($taxonomy) ) );
            $link = get_home_url().'/' . get_option( 'cupa_cpt_productos' ) . '/?tax='.$mytax.'&term_id='.$_term->term_id;
        }
        return $link;
    endif;
    return false;
}

/* Return hmtl from taxonomies */
function getTaxonomiesForProducts( $id_post, $taxonomy, $withLink ){
    $result = '';    
    $terms = get_the_terms( $id_post, $taxonomy );
    if ( $terms ):
        foreach( $terms as $_term ) {
            if ( $withLink ){
                $mytax = str_replace( " ", "-", strtolower( changeVocals($taxonomy) ) );
                $link = get_home_url().'/' . get_option( 'cupa_cpt_productos' ) . '/?tax='.$mytax.'&term_id='.$_term->term_id;
                $result .= '<a href="' .$link. '">' .$_term->name. '</a>, ';
            } else {
                $result .= $_term->name .', ';
            }
        }
        $result = substr( $result, 0, -2 );
        return $result;
    endif;
    return false;
}


/* getSelectForLocalizacionDeProyecto */
function getSelectForLocalizacionDeProyecto( $query, $name, $nameid ){

    $result = '<select id="' .changeVocals( str_replace( " ", "-", strtolower($nameid) ) ). '">';

    $result .= '<option selected="true" disabled="disabled">'.$name.'</option>';

    $array = array();

    if( $query ){

        while ( $query->have_posts() ) : $query->the_post();

            $lugar = get_field( 'lugar', get_the_ID() );

            if( !in_array( $lugar, $array ) ) {

                array_push( $array, $lugar );

            }

        endwhile;

        wp_reset_query();

    }

    sort( $array );

    foreach ( $array as $item ) {
        $result .= '<option value="' .$item. '">' .$item. '</option>';
    }

    $result .= '</select>';

    return $result;
}



/* Get html select for producto proyectos */
function getSelectForProductoDeProyecto( $query, $name, $nameid ){

    $result = '<select id="' .changeVocals( str_replace( " ", "-", strtolower($nameid) ) ). '">';

    $result .= '<option selected="true" disabled="disabled">'.$name.'</option>';

    $productos = array();

    if( $query ){

        $array_ids = array();

        while ( $query->have_posts() ) : $query->the_post();

            $producto_asociado = get_field( 'productos_utilizados', get_the_ID() );

            foreach ( $producto_asociado as $_prod ) {

                if( !in_array( $_prod->ID, $array_ids ) ) {

                    array_push( $array_ids, $_prod->ID );

                    $productos[] = array(
                        'id'   => $_prod->ID,
                        'name' => $_prod->post_title
                    );

                }

            }

        endwhile;

        wp_reset_query();

    }

    $sortArray = array();

    foreach($productos as $producto){
        foreach($producto as $key=>$value){
            if(!isset($sortArray[$key])){
                $sortArray[$key] = array();
            }
            $sortArray[$key][] = $value;
        }
    }

    $orderby = "name";

    array_multisort($sortArray[$orderby],SORT_ASC,$productos);

    foreach ( $productos as $producto ) {
        $result .= '<option value="' .$producto['id']. '">' .$producto['name']. '</option>';
    }

    $result .= '</select>';

    return $result;
}



/* Get html select from terms */
function getSelectFromTerms( $terms, $name, $nameid ) {

    $result = '<select id="' .changeVocals( str_replace( " ", "-", strtolower($nameid) ) ). '">';

    $result .= '<option selected="true" disabled="disabled">'.$name.'</option>';

    if ( $terms ):

        foreach( $terms as $_term ) {
            $result .= '<option value="' .$_term->term_id. '">' .$_term->name. '</option>';
        }
        $result .= '</select>';
        return $result;

    endif;

    return false;
}


/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function haversineGreatCircleDistance( $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000 ) {
    // Convert from degrees to radians
    $latFrom  = deg2rad($latitudeFrom);
    $lonFrom  = deg2rad($longitudeFrom);
    $latTo    = deg2rad($latitudeTo);
    $lonTo    = deg2rad($longitudeTo);
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;
    $angle    = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}


/* Change characters acented to normal */
function changeVocals( $str ){
    $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',  'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');
    return strtr( $str, $unwanted_array );
}


/* Return spanish large month */
function getLargeMonth($acronym){
    switch ( strtolower($acronym) ) {
        case 'ene':
            return 'enero';
            break;

        case 'feb':
            return 'febrero';
            break;

        case 'mar':
            return 'marzo';
            break;

        case 'abr':
            return 'abril';
            break;

        case 'may':
            return 'mayo';
            break;

        case 'jun':
            return 'junio';
            break;

        case 'ago':
            return 'agosto';
            break;

        case 'sep':
            return 'septiembre';
            break;

        case 'oct':
            return 'octubre';
            break;

        case 'nov':
            return 'noviembre';
            break;

        case 'dic':
            return 'diciembre';
            break;

        default:
            return '';
            break;
    }
}


/* Get $_POST locations for map on punto-de-venta by ajax */
add_action( 'wp_ajax_nopriv_get_localizaciones_map', 'get_localizaciones_map' );
add_action( 'wp_ajax_get_localizaciones_map', 'get_localizaciones_map' );
function get_localizaciones_map() {

    $lat_from = $_POST['lat'];
    $lng_from = $_POST['lng'];

    $distance = 300000; // 300 km

    $query = new WP_Query( array(
        'post_type'      => 'puntos-de-venta',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ));

    $count = 0;

    while ( $query->have_posts() ) : $query->the_post();

        $location = get_field( 'localizacion' );

        if( $location ) {

            $ciudad     = get_the_title( get_the_ID() );
            $slug       = get_post_field( 'post_name', get_the_ID() );
            $direccion  = get_field( 'direccion', get_the_ID() );
            $email      = get_field( 'email', get_the_ID() );
            $telefono   = get_field( 'telefono', get_the_ID() );

            $data_direccion  = strip_tags( $direccion );

            $lat_to = $location['lat'];
            $lng_to = $location['lng'];

            $round_distance = round( haversineGreatCircleDistance( $lat_from, $lng_from, $lat_to, $lng_to ) );

            if( $round_distance <= $distance ):

                $count++;
            ?>
                <div class="marker" data-lat="<?php echo esc_attr($lat_to); ?>" data-lng="<?php echo esc_attr($lng_to); ?>" data-city="<?php echo esc_attr($ciudad); ?>" data-address="<?php echo esc_attr($data_direccion); ?>" data-slug="<?php echo esc_attr($slug); ?>">
                    
                    <div class="marker-html">

                        <div class="logo">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cupastone-logo-localizaciones.png" alt="<?php _e('Logo'); ?>">
                        </div>

                        <?php if( $ciudad ): ?>
                        <div class="ciudad">
                            <?php echo $ciudad; ?>
                        </div>
                        <?php endif; ?>

                        <?php if( $direccion ): ?>
                        <div class="direccion">
                            <?php echo $direccion; ?>
                        </div>
                        <?php endif; ?>

                        <?php if( $email ): ?>
                        <div class="email">
                            <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
                        </div>
                        <?php endif; ?>

                        <?php if( $telefono ): ?>
                        <div class="telefono">
                            <a href="tel:<?php echo $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
                        </div>
                        <?php endif; ?>

                    </div>

                </div>
            <?php
            endif;

        }

    endwhile;

    wp_reset_query();

    if ( $count == 0 ) {

        while ( $query->have_posts() ) : $query->the_post();

            $location = get_field( 'localizacion' );

            if( $location ) {

                $ciudad     = get_the_title( get_the_ID() );
                $slug       = get_post_field( 'post_name', get_the_ID() );
                $direccion  = get_field( 'direccion', get_the_ID() );
                $email      = get_field( 'email', get_the_ID() );
                $telefono   = get_field( 'telefono', get_the_ID() );

                $data_direccion  = strip_tags( $direccion );

                $lat_to = $location['lat'];
                $lng_to = $location['lng'];

                ?>
                    
                    <div class="marker" data-lat="<?php echo esc_attr($lat_to); ?>" data-lng="<?php echo esc_attr($lng_to); ?>" data-city="<?php echo esc_attr($ciudad); ?>" data-address="<?php echo esc_attr($data_direccion); ?>" data-slug="<?php echo esc_attr($slug); ?>">
                    
                        <div class="marker-html">

                            <div class="logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cupastone-logo-localizaciones.png" alt="<?php _e('Logo'); ?>">
                            </div>

                            <?php if( $ciudad ): ?>
                            <div class="ciudad">
                                <?php echo $ciudad; ?>
                            </div>
                            <?php endif; ?>

                            <?php if( $direccion ): ?>
                            <div class="direccion">
                                <?php echo $direccion; ?>
                            </div>
                            <?php endif; ?>

                            <?php if( $email ): ?>
                            <div class="email">
                                <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
                            </div>
                            <?php endif; ?>

                            <?php if( $telefono ): ?>
                            <div class="telefono">
                                <a href="tel:<?php echo $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
                            </div>
                            <?php endif; ?>

                        </div>

                    </div>

                <?php

            }

        endwhile;

    }

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response
}


/* Get $_POST locations for items on punto-de-venta by ajax */
add_action( 'wp_ajax_nopriv_get_localizaciones_items', 'get_localizaciones_items' );
add_action( 'wp_ajax_get_localizaciones_items', 'get_localizaciones_items' );
function get_localizaciones_items() {
    
    $lat_from = $_POST['lat'];
    $lng_from = $_POST['lng'];

    $distance = 300000; // 300 km

    $query = new WP_Query( array(
        'post_type'         => 'puntos-de-venta',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'meta_key'          => 'pais',
        'orderby'           => 'meta_value',
        'order'             => 'ASC',
    ));

    $count = 0;
    $n = 1;

    while ( $query->have_posts() ) : $query->the_post();

        $id_post          = get_the_ID();
        $ciudad           = get_the_title();
        $direccion        = get_field( 'direccion' );
        $persona_contacto = get_field( 'persona_de_contacto' );
        $email            = get_field( 'email' );
        $telefono_movil   = get_field( 'telefono_movil' );
        $telefono_fijo    = get_field( 'telefono' );
        $fax              = get_field( 'fax' );
        $horario          = get_field( 'horario' );
        $descripcion      = get_field( 'descripcion' );
        $imagenes         = get_field( 'imagenes' );
        $location         = get_field( 'localizacion' );

        if( $n==1 ) {
            echo '<div class="ver-todos"><a href="#">'.__('Ver Todos').'</a></div>';
        }
        
        if( $location ) {

            $lat_to = $location['lat'];
            $lng_to = $location['lng'];

            $round_distance = round( haversineGreatCircleDistance( $lat_from, $lng_from, $lat_to, $lng_to ) );

            if( $round_distance <= $distance ):

                $count++;

                $lat = $location['lat'];
                $lng = $location['lng'];

                include(get_stylesheet_directory().'/parts/loop/localizacion-punto-de-venta.php');

            endif;

        }

        $n++;

    endwhile;

    wp_reset_query();

    if ( $count == 0 ) {

        $n = 1;

        while ( $query->have_posts() ) : $query->the_post();

            $id_post          = get_the_ID();
            $ciudad           = get_the_title();
            $direccion        = get_field( 'direccion' );
            $persona_contacto = get_field( 'persona_de_contacto' );
            $email            = get_field( 'email' );
            $telefono_movil   = get_field( 'telefono_movil' );
            $telefono_fijo    = get_field( 'telefono' );
            $fax              = get_field( 'fax' );
            $horario          = get_field( 'horario' );
            $descripcion      = get_field( 'descripcion' );
            $imagenes         = get_field( 'imagenes' );
            $location         = get_field( 'localizacion' );

            $lat = $location['lat'];
            $lng = $location['lng'];

            include(get_stylesheet_directory().'/parts/loop/localizacion-punto-de-venta.php');

            $n++;

        endwhile;

    }

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response
}


/* Get all locations for items on punto-de-venta by ajax */
add_action( 'wp_ajax_nopriv_get_all_localizaciones_items', 'get_all_localizaciones_items' );
add_action( 'wp_ajax_get_all_localizaciones_items', 'get_all_localizaciones_items' );
function get_all_localizaciones_items() {
    
    $query = new WP_Query( array(
        'post_type'         => 'puntos-de-venta',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'meta_key'          => 'pais',
        'orderby'           => 'meta_value',
        'order'             => 'ASC',
    ));

    $n = 1;

    while ( $query->have_posts() ) : $query->the_post();

        $id_post          = get_the_ID();
        $ciudad           = get_the_title();
        $tipo_comercio    = get_field( 'tipo_comercio' );
        $direccion        = get_field( 'direccion' );
        $persona_contacto = get_field( 'persona_de_contacto' );
        $email            = get_field( 'email' );
        $telefono_movil   = get_field( 'telefono_movil' );
        $telefono_fijo    = get_field( 'telefono' );
        $fax              = get_field( 'fax' );
        $horario          = get_field( 'horario' );
        $descripcion      = get_field( 'descripcion' );
        $imagenes         = get_field( 'imagenes' );
        $location         = get_field( 'localizacion' );

        $lat = $location['lat'];
        $lng = $location['lng'];

        include(get_stylesheet_directory().'/parts/loop/localizacion-punto-de-venta.php');

        $n++;

    endwhile;

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response
}


/* Get all locations for map on punto-de-venta by ajax */
add_action( 'wp_ajax_nopriv_get_all_localizaciones_map', 'get_all_localizaciones_map' );
add_action( 'wp_ajax_get_all_localizaciones_map', 'get_all_localizaciones_map' );
function get_all_localizaciones_map() {

    $query = new WP_Query( array(
        'post_type'      => 'puntos-de-venta',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ));

    while ( $query->have_posts() ) : $query->the_post();

        $location = get_field( 'localizacion' );

        if( $location ) {

            $lat_to = $location['lat'];
            $lng_to = $location['lng'];

            $ciudad     = get_the_title( get_the_ID() );
            $slug       = get_post_field( 'post_name', get_the_ID() );
            $direccion  = get_field( 'direccion', get_the_ID() );
            $email      = get_field( 'email', get_the_ID() );
            $telefono   = get_field( 'telefono', get_the_ID() );

            $data_direccion  = strip_tags( $direccion );

            ?>
                <div class="marker" data-lat="<?php echo esc_attr($lat_to); ?>" data-lng="<?php echo esc_attr($lng_to); ?>" data-city="<?php echo esc_attr($ciudad); ?>" data-address="<?php echo esc_attr($data_direccion); ?>" data-slug="<?php echo esc_attr($slug); ?>">
                    
                    <div class="marker-html">

                        <div class="logo">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cupastone-logo-localizaciones.png" alt="<?php _e('Logo'); ?>">
                        </div>

                        <?php if( $ciudad ): ?>
                        <div class="ciudad">
                            <?php echo $ciudad; ?>
                        </div>
                        <?php endif; ?>

                        <?php if( $direccion ): ?>
                        <div class="direccion">
                            <?php echo $direccion; ?>
                        </div>
                        <?php endif; ?>

                        <?php if( $email ): ?>
                        <div class="email">
                            <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
                        </div>
                        <?php endif; ?>

                        <?php if( $telefono ): ?>
                        <div class="telefono">
                            <a href="tel:<?php echo $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
                        </div>
                        <?php endif; ?>

                    </div>

                </div>
            <?php

        }

    endwhile;

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response
}


/* Get single location for map on punto-de-venta by ajax */
add_action( 'wp_ajax_nopriv_get_single_localizacion_map', 'get_single_localizacion_map' );
add_action( 'wp_ajax_get_single_localizacion_map', 'get_single_localizacion_map' );
function get_single_localizacion_map() {
    
    $id_post = $_POST['id_post'];

    $ciudad     = get_the_title( $id_post );
    $slug       = get_post_field( 'post_name', $id_post );
    $direccion  = get_field( 'direccion', $id_post );
    $email      = get_field( 'email', $id_post );
    $telefono   = get_field( 'telefono', $id_post );

    $data_direccion  = strip_tags( $direccion );

    $location = get_field( 'localizacion', $id_post );

    $lat_to = $location['lat'];
    $lng_to = $location['lng'];

    ?>
    <div class="marker" data-lat="<?php echo esc_attr($lat_to); ?>" data-lng="<?php echo esc_attr($lng_to); ?>" data-city="<?php echo esc_attr($ciudad); ?>" data-address="<?php echo esc_attr($data_direccion); ?>" data-slug="<?php echo esc_attr($slug); ?>">
            
        <div class="marker-html">

            <div class="logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cupastone-logo-localizaciones.png" alt="<?php _e('Logo'); ?>">
            </div>

            <?php if( $ciudad ): ?>
            <div class="ciudad">
                <?php echo $ciudad; ?>
            </div>
            <?php endif; ?>

            <?php if( $direccion ): ?>
            <div class="direccion">
                <?php echo $direccion; ?>
            </div>
            <?php endif; ?>

            <?php if( $email ): ?>
            <div class="email">
                <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
            </div>
            <?php endif; ?>

            <?php if( $telefono ): ?>
            <div class="telefono">
                <a href="tel:<?php echo $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
            </div>
            <?php endif; ?>

        </div>

    </div>
    <?php

    wp_die(); // this is required to terminate immediately and return a proper response
}


/* Get single locations for items on punto-de-venta by ajax */
add_action( 'wp_ajax_nopriv_get_single_localizacion_item', 'get_single_localizacion_item' );
add_action( 'wp_ajax_get_single_localizacion_item', 'get_single_localizacion_item' );
function get_single_localizacion_item() {
    
    $id_post = $_POST['id_post'];

    $n = 1;

    $ciudad           = get_the_title( $id_post );
    $tipo_comercio    = get_field( 'tipo_comercio', $id_post );
    $fondo_img        = get_field( 'fondo_cabecera', $id_post );
    $direccion        = get_field( 'direccion', $id_post );
    $persona_contacto = get_field( 'persona_de_contacto', $id_post );
    $email            = get_field( 'email', $id_post );
    $telefono_movil   = get_field( 'telefono_movil', $id_post );
    $telefono_fijo    = get_field( 'telefono', $id_post );
    $fax              = get_field( 'fax', $id_post );
    $horario          = get_field( 'horario', $id_post );
    $descripcion      = get_field( 'descripcion', $id_post );
    $imagenes         = get_field( 'imagenes', $id_post );
    $location         = get_field( 'localizacion', $id_post );

    $lat = $location['lat'];
    $lng = $location['lng'];

    echo '<div class="close-loc">+</div>';

    include(get_stylesheet_directory().'/parts/loop/localizacion-punto-de-venta.php');

    wp_die(); // this is required to terminate immediately and return a proper response
}


/* Get all productos on archive productos by ajax */
add_action( 'wp_ajax_nopriv_get_all_productos', 'get_all_productos' );
add_action( 'wp_ajax_get_all_productos', 'get_all_productos' );
function get_all_productos() {

    if ( $_POST['taxonomies']!="" && $_POST['terms']!="" ){

        $taxonomies = explode( ",", $_POST['taxonomies'] );
        $terms      = explode( ",", $_POST['terms'] );

        $tax_query = [];
        $tax_query[] = array(
            'relation' => 'AND',
        );

        for( $i=0; $i<count($taxonomies); $i++ ) {

            $tax_query[] = array(
                'taxonomy' => $taxonomies[$i],
                'field'    => 'term_id',
                'terms'    => $terms[$i],
            );            
        }

        $query = new WP_Query( array(
            'post_type'      => 'productos',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'posts_per_page' => -1,
            'tax_query'      => $tax_query,
        ));

    } else {

        $query_1 = new WP_Query( array(
            'post_type'      => 'productos',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'posts_per_page' => -1,
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'gama',
                    'field'    => 'id',
                    'terms'    => 29,
                ),
            ),
        ));

        $query_2 = new WP_Query( array(
            'post_type'      => 'productos',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'posts_per_page' => -1,
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'gama',
                    'field'    => 'id',
                    'terms'    => 29,
                    'operator' => 'NOT IN',
                ),
            ),
        ));

        $query = new WP_Query();
        $query->posts = array_merge( $query_1->posts, $query_2->posts );
        $query->post_count = $query_1->post_count + $query_2->post_count;

    }

    $n = 1;

    while ( $query->have_posts() ) : $query->the_post();

        $enlace_producto = get_permalink(); // . '?search';
        //$imagen_producto = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        $imagen_producto = get_field( 'imagen_para_busqueda_de_productos', get_the_ID() );
        $titulo_producto = get_the_title();
        $titulo_producto = str_replace( '®', '<sup>®</sup>', $titulo_producto );

        $term_id  = "";
        $_terms = get_the_terms( get_the_ID(), 'gama' );
        foreach ( $_terms as $_term ) { 
            $term_id  = $_term->term_id;
        }

        include(get_stylesheet_directory().'/parts/loop/item-producto-for-archive.php');

        $n++;

    endwhile;

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response

}


/* Get all eventos on archive eventos by ajax */
add_action( 'wp_ajax_nopriv_get_all_eventos', 'get_all_eventos' );
add_action( 'wp_ajax_get_all_eventos', 'get_all_eventos' );
function get_all_eventos() {

    if ( $_POST['taxonomies']!="" && $_POST['terms']!="" ){

        $taxonomies = explode( ",", $_POST['taxonomies'] );
        $terms      = explode( ",", $_POST['terms'] );

        $tax_query = [];
        $tax_query[] = array(
            'relation' => 'AND',
        );

        for( $i=0; $i<count($taxonomies); $i++ ) {

            if( $taxonomies[$i] == 'tipo-de-evento' ){
                $taxonomies[$i] = 'tipos-de-evento';
            }

            if( $taxonomies[$i] == 'pais' ){
                $taxonomies[$i] = 'paises';
            }

            $tax_query[] = array(
                'taxonomy' => $taxonomies[$i],
                'field'    => 'slug',
                'terms'    => $terms[$i],
            );            
        }

        $query = new WP_Query( array(
            'post_type'      => 'eventos',
            'post_status'    => 'publish',
            'orderby'        => 'rand',
            'posts_per_page' => -1,
            'tax_query'      => $tax_query,
        ));

    } else {

        $query = new WP_Query( array(
            'post_type'      => 'eventos',
            'post_status'    => 'publish',
            'orderby'        => 'rand',
            'posts_per_page' => -1,
        ));

    }

    $n = 1;

    while ( $query->have_posts() ) : $query->the_post();

        $idEvento = get_the_ID();

        include(get_stylesheet_directory().'/parts/loop/item-evento-for-archive.php');

        $n++;

    endwhile;

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response

}


/* Paginación categorías del blog */
add_action( 'pre_get_posts', 'show_posts_per_page_on_category_blog' );
function show_posts_per_page_on_category_blog( $query ) {
    if ( !is_admin() && $query->is_category() && $query->is_main_query() ) {
        $nPostsPerPage = get_field( 'numero_posts_por_paginacion', 'options' ) ? get_field( 'numero_posts_por_paginacion', 'options' ) : 9;
        $query->set( 'posts_per_page', $nPostsPerPage );
    }
}


/* Check if slug from post_type exists */
function slugExists( $slug, $post_type ) {
    global $wpdb;
    if( $wpdb->get_row("SELECT post_name FROM ".$wpdb->prefix."posts WHERE post_type = '" .$post_type. "' AND post_name = '" .$slug. "'", 'ARRAY_A') ) {
        return true;
    } else {
        return false;
    }
}


/* Función que recibe una url de archivo (imagen,pdf,etc) y devuelve el attachment_id */
function import_multimedia($url, $post_id){

    //\WP_CLI::log("Cogemos imagen $url");
    $filename = pathinfo($url, PATHINFO_BASENAME);
    $upload_file = wp_upload_bits($filename, null, file_get_contents($url));
    if ($upload_file['error']){
        print_r($upload_file);
        return false;
    }

    //\WP_CLI::log("Comprobamos filetype $filename");
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type'    => $wp_filetype['type'],
        'post_parent'       => $post_id,
        'post_title'        => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content'      => '',
        'post_status'       => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
    if(is_wp_error($attachment_id)){
        print_r($attachment_id);
        return false;
    }

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
    wp_update_attachment_metadata( $attachment_id,  $attachment_data );

    //\WP_CLI::log("Insertamos el attachment $attachment_id");
    return $attachment_id;
}


/* Generate featured image */
function Generate_Featured_Image( $image_url, $post_id  ){
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if(wp_mkdir_p($upload_dir['path']))
      $file = $upload_dir['path'] . '/' . $filename;
    else
      $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
}


/* Custom url path for catalogos */
add_filter( 'acf/upload_prefilter/name=catalogo', 'secure_upload_prefilter' );
add_filter( 'acf/prepare_field/name=catalogo', 'secure_files_field_display' );
add_filter( 'acf/upload_prefilter/name=archivo', 'secure_upload_prefilter' );
add_filter( 'acf/prepare_field/name=archivo', 'secure_files_field_display' );

function secure_upload_prefilter( $errors ) {
    add_filter( 'upload_dir', 'secure_upload_directory' );
    return $errors;
}

function secure_upload_directory( $param ) {        
    $folder           = '/recursos';
    $param['path']    = $param['basedir'] . $folder;
    $param['url']     = $param['baseurl'] . $folder;
    $param['subdir']  = '/';  
    return $param;
}

function secure_files_field_display( $field ) {
    // update paths accordingly before displaying link to file
    add_filter( 'upload_dir', 'secure_upload_directory' );
    return $field;
}


/*****product family********/
// Iniciar sesión al cargar el sitio
function iniciar_sesion_al_cargar() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'iniciar_sesion_al_cargar');

// Función para actualizar la sesión según la taxonomía
function actualizar_product_family() {
    // Verificar si estamos en un archivo de taxonomía 'gama' con tipo de post 'productos'
    if (is_archive() && is_tax('gama') ) {
        
        // Obtener el objeto de la taxonomía actual
        $term = get_queried_object();
        
        if ($term && isset($term->slug)) {
            // Guardar el slug en la variable de sesión 'ProductFamily'
            $_SESSION['ProductFamily'] = $term->slug;
        }
        
    } elseif (is_post_type_archive('productos')) {

        // Verificar si existe la variable 'tax' en la URL
        if (isset($_GET['tax']) && $_GET['tax'] === 'gama' && isset($_GET['term_id'])) {
            // Obtener el término de la taxonomía
            $term_id = intval($_GET['term_id']);
            $term = get_term($term_id, 'gama');

            if ($term && isset($term->slug)) {
                // Guardar el slug en la variable de sesión 'ProductFamily'
                $_SESSION['ProductFamily'] = $term->slug;
            }
        }
    }
}
// Ejecutar la función en el hook 'wp_footer'
add_action('wp_footer', 'actualizar_product_family');
/*****product family********/

add_action('wp_footer', function () {
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('input[name="your-magasin-mail"]').attr('id', 'your-magasin-mail');
        var $hiddenInput = $('#your-magasin-mail');
        var $selectMagasin = $('#magasin');
        var defaultEmail = 'pfert@cupastone.com';

        if ($hiddenInput.length && $selectMagasin.length) {
            function updateHiddenEmail() {
                var selectedValue = $selectMagasin.val();
                var email = selectedValue.split(' - ')[1] || '';
                $hiddenInput.val($.trim(email));
            }

            updateHiddenEmail(); // Ejecutar al cargar
            $selectMagasin.on('change', updateHiddenEmail); // Ejecutar al cambiar
        }

        // Restaurar valor original después del envío
        document.addEventListener('wpcf7mailsent', function(event) {
            if ($hiddenInput.length) {
                $hiddenInput.val(defaultEmail);
            }
        }, false);
    });
    </script>
    <?php
});



/* CRM INTEGRATION */
add_action( 'wpcf7_before_send_mail', 'action_wpcf7_before_send_mail', 10, 1 ); 
function action_wpcf7_before_send_mail( $contact_form ) {
    $wpcf = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
    $array_data = array();
	$url=get_bloginfo('url');

    /*datos salesforce de prueba*
    $client_id = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
    $client_secret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

    $login_url = "https://userSalesforce--dev.sandbox.my.salesforce.com/services/oauth2/token";
    $lead_url = "https://userSalesforce--dev.sandbox.my.salesforce.com/services/data/v58.0/sobjects/Lead";
    /*datos salesforce de prueba*/

    /*datos salesforce de produccion*/ 
    $client_id = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
    $client_secret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

    $login_url = "https://userSalesforce.my.salesforce.com/services/oauth2/token";
    $lead_url = "https://userSalesforce.my.salesforce.com/services/data/v58.0/sobjects/Lead";
    /*datos salesforce de produccion*/



    switch ( $wpcf->id() ) {

        case 1552:  // form CONTACTO
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = $data['your-nombre'];
                    $array_data['apellidos']     = $data['your-apellidos'];
                    $array_data['email']         = $data['your-email'];

                    $array_data['telefono']      = $data['your-telefono'];
                    $array_data['pais']          = $data['your-pais'];
                    $array_data['cp']            = $data['your-cp'];

                    $array_data['municipio']     = $data['your-municipio'];
                    $array_data['motivo']       = $data['your-motivo'];                    
                    
                    /* CRM */
                    $array_data['ciudadcrm']        = $data['your-municipio'];
                    $array_data['mensajecrm']       = $data['your-mensaje']; 
                    $array_data['perfilcliente'] = $data['your-perfil'];
                    $array_data['mailing']       = isset($data['publicidad']) ? '1' : '0';
                    $array_data['producto']      = "";
                    /* CRM */   
                    
                    $array_data['mensaje']       = $data['your-mensaje'];

                    $array_data['paginaanterior']= $data['your-previous-page'];

                    $array_data['productfamily'] = $data['familia-producto'];
                    $array_data['metroscuadrados'] = $data['metros-cuadrados'];
                    $array_data['aplicacion'] = $data['aplicacion'];

                    $array_data['fechaestimada'] = $data['fecha-estimada'];
                    $array_data['presupuesto'] = $data['presupuesto'];
                    $array_data['detalles'] = $data['detalles'];

                    $array_data['contactemos'] = $data['contactemos'];

                    $array_data['tipolead'] = "02";
                    $array_data['company'] = "Particular";                    
                    $array_data['accounttype'] = "043";

                    $array_data['recordtype'] = "MKT ES Cupa Stone Leads Marketing";
                    $array_data['environment'] = "CUPA STONE Espana";
                     
                    

					if($url=="https://www.cupastone.es"){
						include('crm-integration.php');
                        include('salesforce-integration.php');
					}
					elseif($url=="https://www.cupastone.fr"){
						include('crm-integration-FR.php');

                        $array_data['recordtype'] = "MKT FR Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Francia";
                        include('salesforce-integration.php');
					}	
                    elseif($url=="https://www.cupastone.pt"){
						include('crm-integration-PT.php');

                        $array_data['recordtype'] = "MKT PT Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Portugal";
                        include('salesforce-integration.php');
					}					
					elseif($url=="https://www.cupastone.com"){
						include('crm-integration-COM.php');

                        $array_data['recordtype'] = "MKT IN Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Internacional";
                        include('salesforce-integration.php');
					}					
					elseif($url=="https://www.cupastone.de"){
						include('crm-integration-DE.php');
					}
                }
            }
            break;
		case 6255:  // form CONTACTO PRO
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    
                    $array_data['nombre']        = $data['your-nombre'];
                    $array_data['apellidos']     = $data['your-apellidos'];
                    $array_data['email']         = $data['your-email'];

                    $array_data['telefono']      = $data['your-telefono'];
                    $array_data['pais']          = $data['your-pais'];
                    $array_data['cp']            = $data['your-cp'];

                    /*CRM*/
                    $array_data['mensajecrm']       = "EMPRESA:".$data['your-empresa']." - MOTIVO:".$data['your-motivo'][0]." - MENSAJE:".$data['your-mensaje'];
                    $array_data['ciudadcrm']        = $data['your-municipio'];
                    /*CRM*/

                    $array_data['municipio']     = $data['your-municipio'];
                    $array_data['motivo']       = $data['your-motivo'];

                    $array_data['mensaje']       = $data['your-mensaje']; 
                    $array_data['perfilcliente'] = $data['your-perfil'];
                    $array_data['mailing']       = isset($data['publicidad']) ? '1' : '0';

                    
                    $array_data['paginaanterior']= $data['your-previous-page'];

                    $array_data['productfamily'] = $data['familia-producto'];
                    $array_data['metroscuadrados'] = $data['metros-cuadrados'];
                    $array_data['aplicacion'] = $data['aplicacion'];

                    $array_data['fechaestimada'] = $data['fecha-estimada'];
                    $array_data['presupuesto'] = $data['presupuesto'];
                    $array_data['detalles'] = $data['detalles'];

                    $array_data['contactemos'] = $data['contactemos'];

                    $array_data['tipolead'] = $data['tipo-empresa'];
                    $array_data['company'] = $data['your-empresa'];                    
                    $array_data['accounttype'] = $data['your-perfil'];

                    $array_data['recordtype'] = "MKT ES Cupa Stone Leads Marketing";
                    $array_data['environment'] = "CUPA STONE Espana";
                     
                    $array_data['producto']      = "";

					if($url=="https://www.cupastone.es"){
						include('crm-integration.php');
                        include('salesforce-integration-pro.php');
					}
					elseif($url=="https://www.cupastone.fr"){
						include('crm-integration-FR.php');

                        $array_data['recordtype'] = "MKT FR Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Francia";    
                        include('salesforce-integration-pro.php');
					}
                    elseif($url=="https://www.cupastone.pt"){
						include('crm-integration-PT.php');

                        $array_data['recordtype'] = "MKT PT Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Portugal";
                        include('salesforce-integration-pro.php');
					}						
					elseif($url=="https://www.cupastone.com"){
						include('crm-integration-COM.php');

                        $array_data['recordtype'] = "MKT IN Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Internacional";
                        include('salesforce-integration-pro.php');
					}
					
					elseif($url=="https://www.cupastone.de"){
						include('crm-integration-DE.php');
					}
                }
            }
            break;
		case 6150:  // form PRESUPUESTO
        case 10885: // form PRESUPUESTO INTERNACIONAL    
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = $data['your-nombre'];
                    $array_data['apellidos']        = $data['your-apellidos'];
                    $array_data['telefono']      = $data['your-telefono'];

                    $array_data['email']         = $data['your-email'];
                    
                    $array_data['pais']          = $data['your-pais'];
                    $array_data['cp']            = $data['your-cp'];

                    /*CRM*/
                    $array_data['mensajecrm']       = "TIPO:".$data['proyecto']." - FECHA:".$data['empezar'][0]." - PRESUPUESTO:".$data['presupuesto'][0]." - MENSAJE:".$data['descripcion'];
                    $array_data['ciudadcrm']        = $data['your-municipio'];
                    /*CRM*/

                    $array_data['ciudad']        = $data['your-municipio'];
                    
                    $array_data['aplicacion']        = $data['proyecto'];
                    $array_data['fechaestimada']        = $data['empezar'];//array
                    $array_data['presupuesto']        = $data['presupuesto'];//array

                    $array_data['detalles']        = $data['descripcion'];

                    $array_data['tipolead'] = "02";
                    $array_data['company'] = "Particular";
                    $array_data['accounttype'] = "043";
                    $array_data['motivo']       = $data['motivo'];

                    $array_data['productfamily'] = $data['familia-producto'];
                    $array_data['metroscuadrados'] = $data['metros-cuadrados'];
                    $array_data['contactemos'] = $data['horario'];

                    $array_data['recordtype'] = "MKT ES Cupa Stone Leads Marketing";
                    $array_data['environment'] = "CUPA STONE Espana";



					if($url=="https://www.cupastone.es"){
						include('crm-integration.php');
                        include('salesforce-integration-presupuesto.php');
					}
					elseif($url=="https://www.cupastone.fr"){
						include('crm-integration-FR.php');

                        $array_data['recordtype'] = "MKT FR Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Francia";
                        include('salesforce-integration-presupuesto.php');
					}
                    elseif($url=="https://www.cupastone.pt"){
						include('crm-integration-PT.php');

                        $array_data['recordtype'] = "MKT PT Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Portugal";
                        include('salesforce-integration-presupuesto.php');
					}						
					elseif($url=="https://www.cupastone.com"){
						include('crm-integration-COM.php');

                        $array_data['recordtype'] = "MKT IN Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Internacional";
                        include('salesforce-integration-presupuesto.php');
					}
					
					elseif($url=="https://www.cupastone.de"){
						include('crm-integration-DE.php');
					}
                }
            }
            break;

        case 14214:  // form PRESUPUESTO PROFESIONAL ESPAÑA
        case 15727:  // form PRESUPUESTO PROFESIONAL FRANCIA
        case 10716:  // form PRESUPUESTO PROFESIONAL PORTUGAL  
        case 11942:  // form PRESUPUESTO PROFESIONAL INTERNACIONAL        
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = $data['your-nombre'];
                    $array_data['apellidos']        = $data['your-apellidos'];
                    $array_data['telefono']      = $data['your-telefono'];

                    $array_data['email']         = $data['your-email'];
                    
                    $array_data['pais']          = $data['your-pais'];
                    $array_data['cp']            = $data['your-cp'];
                    $array_data['ciudad']        = $data['your-municipio'];
                    
                    $array_data['aplicacion']        = $data['proyecto'];
                    $array_data['fechaestimada']        = $data['empezar'];//array
                    $array_data['presupuesto']        = $data['presupuesto'];//array

                    $array_data['detalles']        = $data['descripcion'];

                    $array_data['tipolead'] = $data['tipo-empresa'];;
                    $array_data['company'] = $data['your-empresa'];
                    $array_data['accounttype'] = $data['your-perfil'];
                    $array_data['motivo']       = $data['motivo'];

                    $array_data['productfamily'] = $data['familia-producto'];
                    $array_data['metroscuadrados'] = $data['metros-cuadrados'];
                    $array_data['contactemos'] = $data['horario'];

                    $array_data['recordtype'] = "MKT ES Cupa Stone Leads Marketing";
                    $array_data['environment'] = "CUPA STONE Espana";

                    if($url=="https://www.cupastone.es"){
						include('salesforce-integration-presupuesto-pro.php');
						include('crm-integration.php');
					}
					elseif($url=="https://www.cupastone.fr"){
						
                        $array_data['recordtype'] = "MKT FR Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Francia";
                        include('salesforce-integration-presupuesto-pro.php');
			include('crm-integration-FR.php');
					}
                    elseif($url=="https://www.cupastone.pt"){
						
                        $array_data['recordtype'] = "MKT PT Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Portugal";
                        include('salesforce-integration-presupuesto-pro.php');
			include('crm-integration-PT.php');
					}						
					elseif($url=="https://www.cupastone.com"){

                        $array_data['recordtype'] = "MKT IN Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Internacional";
                        include('salesforce-integration-presupuesto-pro.php');
			include('crm-integration-COM.php');
					}
                }    
            }
            break;
            
           
            
            
		case 10885:  // form PRESUPUESTO => NO EXISTE
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = $data['your-nombre'];
                    $array_data['email']         = $data['your-email'];
                    $array_data['telefono']      = $data['your-telefono'];
                    $array_data['mensaje']       = "TIPO:".$data['proyecto']." - FECHA:".$data['empezar'][0]." - PRESUPUESTO:".$data['presupuesto'][0]." - MENSAJE:".$data['descripcion'];
                    $array_data['ciudad']        = $data['your-municipio'];
                    $array_data['cp']            = $data['your-cp'];
                    
                    $array_data['perfilcliente'] = $data['your-perfil'];
                    $array_data['mailing']       = $data['publicidad'];
                    $array_data['producto']      = "";

					if($url=="https://www.cupastone.es"){
						include('crm-integration.php');
					}
					elseif($url=="https://www.cupastone.fr"){
						include('crm-integration-FR.php');
					}						
					elseif($url=="https://www.cupastone.com"){
						include('crm-integration-COM.php');
					}
					elseif($url=="https://www.cupastone.pt"){
						include('crm-integration-PT.php');
					}
					elseif($url=="https://www.cupastone.de"){
						include('crm-integration-DE.php');
					}
                }
            }
            break;		
        case 10207:  // form RDV
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = $data['your-nombre'];
                    $array_data['apellidos']        = $data['your-apellidos'];
                    $array_data['email']         = $data['your-email'];
                    $array_data['telefono']      = $data['your-telefono'];
                    $array_data['mensajecrm']       = "RDV:".$data['your-magasin'][0]." | Fecha RDV:".$data['date']." | Mensaje:".$data['message'];

                    
                    $array_data['company']      = $data['your-empresa'];
                    $array_data['cp']      = $data['your-cp'];
                    $array_data['municipio']      = $data['your-municipio'];

                    $array_data['mensaje']      = $data['message'];
                    $array_data['magasin']      = $data['your-magasin'];
                    $array_data['date']      = $data['date'];
                    

					if($url=="https://www.cupastone.es"){
						//
					}
					elseif($url=="https://www.cupastone.fr"){
						include('crm-integration-FR.php');

                        $array_data['recordtype'] = "MKT FR Cupa Stone Leads Marketing";
                        $array_data['environment'] = "CUPA STONE Francia";
						include('salesforce-integration-rdv.php');
					}						
					elseif($url=="https://www.cupastone.com"){
						//
					}
					elseif($url=="https://www.cupastone.pt"){
						//
					}
					elseif($url=="https://www.cupastone.de"){
						//
					}
                }
            }
            break;						
			

        /*
        case 7:  // Form Newsletter FOOTER
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = "";
                    $array_data['email']         = $data['your-email'];
                    $array_data['telefono']      = "";
                    $array_data['mensaje']       = "";
                    $array_data['cp']            = "";
                    $array_data['ciudad']        = $data['your-city'];
                    $array_data['perfilcliente'] = $data['your-profile'];
                    $array_data['mailing']       = "SI";
                    $array_data['producto']      = "";

                    include('crm-integration.php');
                }
            }
            break;
        */

        /*
        case 1435:  // Form ASISTIR single-evento
            if ( $submission ){
                $data = $submission->get_posted_data();
                if ( !empty( $data ) ){
                    $array_data['nombre']        = $data['your-nombre'] ." ". $data['your-apellido'];
                    $array_data['email']         = $data['your-email'];
                    $array_data['telefono']      = $data['your-telefono'];
                    $array_data['mensaje']       = "";
                    $array_data['cp']            = "";
                    $array_data['ciudad']        = "";
                    $array_data['perfilcliente'] = "";
                    $array_data['mailing']       = "NO";
                    $array_data['producto']      = "";

                    include('crm-integration.php');
                }
            }
            break;
        */

        
        default:
            # code...
            break;
    }
}

/**
*  Redirigir al formulario correcto 
*/

function add_stylesheet_to_head() {

?>
<style>

.form-presupuesto-pro,
.form-presupuesto {
    display: none;
    opacity: 0;
    -webkit-transition: opacity 0.3s ease-in-out;
    -moz-transition: opacity 0.3s ease-in-out;
    -ms-transition: opacity 0.3s ease-in-out;   
    -o-transition: opacity 0.3s ease-in-out;
    transition: opacity 0.3s ease-in-out;
} 

.form-presupuesto.form-active,
.form-presupuesto-pro.form-active {
    display: block;
    opacity: 1;
}

</style>

<?php
    
}
     
add_action( 'wp_head', 'add_stylesheet_to_head' );

function custom_redirect_script() {
    // Solo cargar el script en páginas específicas si es necesario
    $url=get_bloginfo('url');
    //if($url=="https://www.cupastone.es"){
        ?>
        
        <script type="text/javascript">
        if (document.body.classList.contains('page-template-template-contacto') && 
            document.body.classList.contains('page-template-templatestemplate-contacto-php')) {

            document.addEventListener('DOMContentLoaded', function () {
                // Obtener el select por su ID
                var selectPais = document.getElementById('your-pais');

                // Agregar un listener para detectar cambios en el select
                selectPais.addEventListener('change', function () {
                    // Obtener el valor seleccionado
                    var selectedValue = this.value;

                    // Validar si el valor no es 'AD' (Andorra) o 'ES' (España)
                    if (selectedValue !== 'AD' && selectedValue !== 'ES') {
                        var currentUrl = window.location.href; // Obtener la URL actual completa
                        console.log(currentUrl);
                        var targetUrl;

                        // Redirigir según el valor seleccionado
                        switch (selectedValue) {
                            case 'PT': // Portugal
                                targetUrl = 'https://www.cupastone.pt/formulario-contato/';
                                break;
                            case 'FR': // Francia
                                targetUrl = 'https://www.cupastone.fr/formulaire-contact/';
                                break;
                            default:
                                targetUrl = 'https://www.cupastone.com/contact-form/';
                        }

                        // Redirigir si la URL de destino está definida
                        if (targetUrl) {
                            //window.location.href = targetUrl;
                        }
                    }
                });
            });

        }

        if (document.body.classList.contains('page-template-template-presupuesto') && 
            document.body.classList.contains('page-template-templatestemplate-presupuesto-php')) {

                jQuery(window).ready(function ($) {
                    // Acción para el botón "Particular"
                    $('.btn-particular a').on('click', function (e) {
                        e.preventDefault(); // Evitar el comportamiento por defecto del enlace

                        // Animar el cambio de formularios
                        $('.form-presupuesto-pro.form-active').fadeOut(10, function () {
                            $(this).removeClass('form-active');
                            $('.form-presupuesto').fadeIn(300).addClass('form-active');
                        });

                        // Cambiar las clases activas de los botones
                        $('.btn-profesional').removeClass('active');
                        $('.btn-particular').addClass('active');

                        // Limpiar campos de texto
                        $('#field-proyecto').val('');
                        $('#field-proyecto-pro').val('');


                        $( '#form-presupuesto .pasos' ).hide();
	                    $( '#form-presupuesto .pasos.paso-1').fadeIn();    

                    });

                    // Acción para el botón "Profesional"
                    $('.btn-profesional a').on('click', function (e) {
                        e.preventDefault(); // Evitar el comportamiento por defecto del enlace

                        // Animar el cambio de formularios
                        $('.form-presupuesto.form-active').fadeOut(10, function () {
                            $(this).removeClass('form-active');
                            $('.form-presupuesto-pro').fadeIn(300).addClass('form-active');
                        });

                        // Cambiar las clases activas de los botones
                        $('.btn-particular').removeClass('active');
                        $('.btn-profesional').addClass('active');

                        // Limpiar campos de texto
                        $('#field-proyecto').val('');
                        $('#field-proyecto-pro').val('');

                        $( '#form-presupuesto .pasos' ).hide();
	                    $( '#form-presupuesto .pasos.paso-1').fadeIn(); 
                    });
                });


        }
        </script>
        <?php 
    //}
}
add_action('wp_footer', 'custom_redirect_script');


/* Slugify string */
function slugifyString($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


/* Convert a file url to a array (to manage csv) */
function csv_to_array($filename='', $delimiter=',') {
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 100000, $delimiter)) !== FALSE) {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}


/* Check if evento (category evento from blog post) is not expired */
function eventNotExpired( $eventDate ){
    $dateNow = date('d F Y g:i');
    if ( $dateNow > $eventDate ){
        return false;
    }
    return true;
}


/* Get all proyectos on archive proyectos by ajax */
add_action( 'wp_ajax_nopriv_get_all_proyectos', 'get_all_proyectos' );
add_action( 'wp_ajax_get_all_proyectos', 'get_all_proyectos' );
function get_all_proyectos() {

    $idgama       = $_POST['idgama'];
    $idproducto   = $_POST['idproducto'];
    $nomlugar     = $_POST['idproyecto']; // Antes se pasaba el ID de proyecto en la variable POST, pero para buscar hace falta el nombre de lugar
    $idaplicacion = $_POST['idaplicacion'];

    $args = array(
        'post_type'      => 'proyectos',
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'posts_per_page' => -1,
    );

    if ( $idproducto ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'productos_utilizados',
                'value'   => $idproducto,
                'compare' => 'LIKE',
            ),
        );
    }

    if( $nomlugar ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'lugar',
                'value'   => $nomlugar,
                'compare' => 'LIKE',
            ),
        );
    }

    if( $idaplicacion ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'aplicacion',
                'field'    => 'term_id',
                'terms'    => array($idaplicacion),
            ),
        );
    }

    if( $idgama ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'gama',
                'field'    => 'term_id',
                'terms'    => array($idgama),
            ),
        );
    }

    $query = new WP_Query( $args );

    $n = 1;

    while ( $query->have_posts() ) : $query->the_post();    // POR CADA PROYECTO

        $enlace_producto = get_permalink(); // . '?search';
        $imagen_producto = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        $titulo_producto = get_the_title();

        /*if( $idaplicacion != "" ) {

            $producto_asociado = get_field( 'productos_utilizados', get_the_ID() );

            foreach ( $producto_asociado as $_prod ) {  // CADA PRODUCTO DE PROYECTO

                if( has_term( intval($idaplicacion), 'aplicacion', $_prod->ID ) ){

                    include( get_stylesheet_directory().'/parts/loop/item-proyecto-for-archive.php' );
                    break;

                }
            }

        } else {*/

            include( get_stylesheet_directory().'/parts/loop/item-proyecto-for-archive.php' );

        /*}*/

        $n++;

    endwhile;

    wp_reset_query();

    wp_die(); // this is required to terminate immediately and return a proper response

}


/* Get html select for Gamas en archive proyectos */
function getSelectForGamasDeProyecto( $query ){

    $result = '<select id="gama">';

    $result .= '<option selected="true" disabled="disabled">' . __( 'Gama', 'materialwp' ) . '</option>';

    $gamas = array();

    if( $query ){

        $array_ids = array();

        while ( $query->have_posts() ) : $query->the_post();            
             
            $proyect_terms = get_the_terms( get_the_ID(), 'gama' );

            if ( $proyect_terms ):

                foreach( $proyect_terms as $_term ) {

                    if( !in_array( $_term->term_id, $array_ids ) ) {

                        array_push( $array_ids, $_term->term_id );

                        $gamas[] = array(
                            'id'   => $_term->term_id,
                            'name' => $_term->name
                        );

                    }

                }
                
            endif;

        endwhile;

        wp_reset_query();

    }

    $sortArray = array();

    foreach($gamas as $gama){
        foreach($gama as $key=>$value){
            if(!isset($sortArray[$key])){
                $sortArray[$key] = array();
            }
            $sortArray[$key][] = $value;
        }
    }

    $orderby = "name";

    array_multisort($sortArray[$orderby],SORT_ASC,$gamas);

    foreach ( $gamas as $gama ) {
        $result .= '<option value="' .$gama['id']. '">' .$gama['name']. '</option>';
    }

    $result .= '</select>';

    return $result;
}


/* Get html select for Aplicaciones en archive proyectos */
function getSelectForAplicacionesDeProyecto( $query ){

    $result = '<select id="aplicacion">';

    $result .= '<option selected="true" disabled="disabled">' . __( 'Aplicación', 'materialwp' ) . '</option>';

    $aplicaciones = array();

    if( $query ){

        $array_ids = array();

        while ( $query->have_posts() ) : $query->the_post();            
             
            $proyect_terms = get_the_terms( get_the_ID(), 'aplicacion' );

            if ( $proyect_terms ):

                foreach( $proyect_terms as $_term ) {

                    if( !in_array( $_term->term_id, $array_ids ) ) {

                        array_push( $array_ids, $_term->term_id );

                        $aplicaciones[] = array(
                            'id'   => $_term->term_id,
                            'name' => $_term->name
                        );

                    }

                }
                
            endif;

        endwhile;

        wp_reset_query();

    }

    $sortArray = array();

    foreach($aplicaciones as $aplicacion){
        foreach($aplicacion as $key=>$value){
            if(!isset($sortArray[$key])){
                $sortArray[$key] = array();
            }
            $sortArray[$key][] = $value;
        }
    }

    $orderby = "name";

    array_multisort($sortArray[$orderby],SORT_ASC,$aplicaciones);

    foreach ( $aplicaciones as $aplicacion ) {
        $result .= '<option value="' .$aplicacion['id']. '">' .$aplicacion['name']. '</option>';
    }

    $result .= '</select>';

    return $result;
}


/**
 * Canonical link for archive-productos
 */
function cupa_set_canonical_for_productos_post_type_archive() {
    
    if ( is_post_type_archive( 'productos' ) ) {
        
        $cupa_permalink = home_url() . strtok($_SERVER["REQUEST_URI"], '?');
        echo '<link rel="canonical" href="' . $cupa_permalink . '" />';
    }
}
add_action( 'wp_head', 'cupa_set_canonical_for_productos_post_type_archive' );