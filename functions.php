<?php
/**
 * Materialwp functions and definitions
 *
 * @package materialwp
 */

if ( ! function_exists( 'materialwp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function materialwp_setup() {

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 640; /* pixels */
		}

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on materialwp, use a find and replace
		 * to change 'materialwp' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'materialwp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Suport for WordPress 4.1+ to display titles.
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'materialwp' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'materialwp_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
endif; // materialwp_setup.
add_action( 'after_setup_theme', 'materialwp_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function materialwp_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'materialwp' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="panel panel-warning">',
			'after_widget'  => '</div></aside>',
			'before_title'  => ' <div class="panel-heading"><h3 class="panel-title">',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Pie columna 1', 'materialwp' ),
			'id'            => 'pie1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget-pie %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="titulo-pie">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Pie columna 2', 'materialwp' ),
			'id'            => 'pie2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget-pie %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="titulo-pie">',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Pie columna 3', 'materialwp' ),
			'id'            => 'pie3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget-pie %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="titulo-pie">',
			'after_title'   => '</h3></div>',
		)
	);
}
add_action( 'widgets_init', 'materialwp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function materialwp_scripts() {
	$version = '2.2.1';
	wp_enqueue_style( 'roboto-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700', array(), $version, 'all' );

	/*Bootstrap 4 material*/
	wp_enqueue_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $version );
	wp_enqueue_style( 'Bootstrap_css', get_template_directory_uri() . '/bower_components//bootstrap4_material/css/bootstrap.min.css', array(), $version );
	wp_enqueue_style( 'MDB', get_template_directory_uri() . '/bower_components/bootstrap4_material/css/mdb.min.css', array(), $version );
	wp_enqueue_style( 'Style', get_template_directory_uri() . '/bower_components/bootstrap4_material/css/style.css', array(), $version );
	wp_enqueue_script( 'jQuery', get_template_directory_uri() . '/bower_components/bootstrap4_material/js/jquery-3.2.1.min.js', array(), '2.2.3', true );
	wp_enqueue_script( 'Tether', get_template_directory_uri() . '/bower_components/bootstrap4_material/js/popper.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Bootstrap', get_template_directory_uri() . '/bower_components/bootstrap4_material/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'MDB', get_template_directory_uri() . '/bower_components/bootstrap4_material/js/mdb.min.js', array(), '1.0.0', true );

	wp_enqueue_style( 'izimodalcss', get_template_directory_uri() . '/js/izimodal/css/iziModal.css', array(), $version );
	wp_enqueue_script( 'izimodal', get_template_directory_uri() . '/js/izimodal/js/iziModal.min.js', array(), '1.0.0', true );

	// Theme styles & scripts.
	wp_enqueue_style( 'materialwp-style', get_stylesheet_uri(), array(), $version );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), $version, true );
	wp_enqueue_script( 'custom-scripts-js', get_template_directory_uri() . '/js/custom-scripts.js', array(), $version, true );
	wp_enqueue_style( 'hacce-style', get_template_directory_uri() . '/css/custom.css', array(), $version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*Tiny Slide*/
	wp_enqueue_script( 'tiny_js', get_template_directory_uri() . '/js/tiny-slider.js', array(), $version, true );
	wp_enqueue_style( 'tiny_style', get_template_directory_uri() . '/css/tiny-slider.css', array(), $version );
	/*Fin tiny*/

	/*GreenSock*/
	wp_enqueue_script( 'tweenmax_js', get_template_directory_uri() . '/js/gsap/TweenMax.min.js', array(), $version, true );
	wp_enqueue_script( 'cssplugin_js', get_template_directory_uri() . '/js/gsap/plugins/CSSPlugin.min.js', array(), $version, true );
	/*Fin GreenSock*/

	/* Waypoints */
	wp_enqueue_script( 'waypoints_js', get_template_directory_uri() . '/js/waypoints/jquery.waypoints.min.js', array(), $version, true );
	/* Fin Waypoints */

	/* Tilt */
	wp_enqueue_script( 'tilt_js', get_template_directory_uri() . '/js/tilt/tilt.jquery.min.js', array(), $version, true );
	/* Fin Tilt */

	/* Custom scripts */
	wp_enqueue_script( 'countup-custom_js', get_template_directory_uri() . '/js/countup-custom.js', array(), $version, true );
	wp_enqueue_script( 'utils-custom_js', get_template_directory_uri() . '/js/utils-custom.js', array(), $version, true );
	/* Fin Custom scripts */
}
add_action( 'wp_enqueue_scripts', 'materialwp_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Adds a Walker class for the Bootstrap Navbar.
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

/**
 * Comments Callback.
 */
require get_template_directory() . '/inc/comments-callback.php';

/**
 * Custom Functions.
 */
require get_template_directory() . '/hincludes/functions.php';


//Cambiar sender name
function wpb_sender_name( $original_email_from ) {
    return 'Cupa Stone Web';
}
 
//Hook cambio sender name
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );


//Añadir scripts contacto (es el mismo para todos los idiomas)
function add_this_script_footer(){
			echo"<script>
document.addEventListener( 'wpcf7submit', function( event ) {
	ga('send', 'event', 'Formulario', 'envío', 'Contacto principal');
}, false );
</script>";


} ;

//Hook scripts
add_action('wp_footer', 'add_this_script_footer');




function my_custom_admin_scripts() {
    // Enqueuea tu script personalizado
    
	wp_enqueue_script('my-custom-js-admin', get_template_directory_uri() . '/js/custom-admin.js', array('jquery', 'visual-composer-js'), '1.0.0', true);

    // Opcional: Pasar datos de PHP a JavaScript
    wp_localize_script('my-custom-js-admin', 'MyScriptVars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'some_var' => 'some_value'
    ));
}

add_action('admin_enqueue_scripts', 'my_custom_admin_scripts');



add_filter('vc_basic_grid_filter_knowledge', 'add_caption_to_lightbox', 10, 2);


function add_custom_lightbox_caption_script() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Verificar si existen elementos con el atributo data-lightbox
        if ($('a[data-lightbox]').length) {
            $('a[data-lightbox]').each(function() {
                var caption = $(this).find('img').attr('title'); // Obtener la leyenda del atributo title
                $(this).attr('data-title', caption);
            });

            $(document).on('click', 'a[data-lightbox]', function() {
                var caption = $(this).data('title');
                if (caption) {
                    setTimeout(function() {
                        $('.mfp-title').text(caption);
                    }, 100);
                }
            });
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'add_custom_lightbox_caption_script');