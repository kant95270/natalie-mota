<?php
/**
 * nathalie mota functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nathalie_mota
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nathalie_mota_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on nathalie mota, use a find and replace
		* to change 'nathalie-mota' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nathalie-mota', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Primary', 'nathalie-mota' ),
			'footer' => 'Navigation du footer' 
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
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nathalie_mota_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nathalie_mota_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nathalie_mota_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nathalie_mota_content_width', 640 );
}
add_action( 'after_setup_theme', 'nathalie_mota_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nathalie_mota_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nathalie-mota' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nathalie-mota' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nathalie_mota_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nathalie_mota_scripts() {
	wp_enqueue_style('nathalie_mota-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('nathalie_mota-style', 'rtl', 'replace');
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
	wp_enqueue_script('jquery');
	wp_enqueue_script('nathalie_mota-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('theme-scripts', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
	wp_enqueue_script('ajax-filtrage', get_template_directory_uri() . '/js/ajax-filtrage.js', array('jquery'), null, true);
	wp_localize_script('ajax-filtrage', 'ajaxurl', admin_url('admin-ajax.php'));
	wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
	wp_enqueue_script('jquery');
	wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nathalie_mota_scripts' );



function register_my_menu()
{
	register_nav_menu('header', "Menu principal");
	
}
add_action('after_setup_theme', 'register_my_menu');

function filtrer_photos()
{
	$categorie_id = isset($_POST['categorie']) ? $_POST['categorie'] : '';
	$formats_id = isset($_POST['formats']) ? $_POST['formats'] : '';
	$order = isset($_POST['order']) ? $_POST['order'] : 'desc';
	$paged = isset($_POST['page']) ? $_POST['page'] : 1;

	$args = array(
		'post_type' => 'photo',
		'posts_per_page' => 8,
		'orderby' => 'date',
		'order' => $order,
		'paged' => $paged,
	);

	$tax_query = array();

	if (!empty($categorie_id)) {
		$tax_query[] = array(
			'taxonomy' => 'categorie',
			'field' => 'id',
			'terms' => $categorie_id
		);
	}

	if (!empty($formats_id)) {
		$tax_query[] = array(
			'taxonomy' => 'formats',
			'field' => 'id',
			'terms' => $formats_id
		);
	}

	if (!empty($tax_query)) {
		$tax_query['relation'] = 'AND';
		$args['tax_query'] = $tax_query;
	}

	$query = new WP_Query($args);

	$is_last_page = ($query->max_num_pages <= $paged); // Vérifiez si c'est la dernière page

	if ($query->have_posts()) {
		while ($query->have_posts()) : $query->the_post();
			// Le code HTML pour afficher chaque photo
?>
			<div class="photo-item">
				<h3 class="title-photo"><?php the_title(); ?></h3>
				<?php
				$categories = get_the_terms(get_the_ID(), 'categorie');
				$category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
				if (!empty($category_name)) {
					echo '<h4 class="categorie-photo">' . $category_name . '</h4>';
				}
				?>
				<?php the_post_thumbnail('large'); // Affiche l'image à la une 
				?>
				<a href="<?php the_permalink(); ?>" class="detail-photo-link">
					<span class="detail-photo"></span>
				</a>
				<form>
					<input type="hidden" name="postid" class="postid" value="<?php the_id(); ?>">
					<a href="<?php the_post_thumbnail_url('full'); ?>" class="openLightbox" title="Afficher la photo en plein écran" data-fancybox="gallery" data-caption="<?php echo esc_attr(get_field('reference')) . (!empty($category_name) ? ' - ' . $category_name : ''); ?>" data-postid="<?php echo get_the_id(); ?>" data-arrow="true">
					</a>
				</form>
			</div>
<?php
		endwhile;
		if ($is_last_page) {
			// Ajouter un marqueur pour indiquer qu'il n'y a plus de photos à charger
			echo '<span id="no-more-posts"></span>';
		}
	} else {
		// Ne pas renvoyer de message si aucune photo n'est trouvée pour les requêtes AJAX
		if ($paged > 1) {
			echo '';
		} else {
			echo 'Aucune photo trouvée.';
		}
	}

	wp_reset_postdata();

	die();
}
add_action('wp_ajax_filtrer_photos', 'filtrer_photos');
add_action('wp_ajax_nopriv_filtrer_photos', 'filtrer_photos');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function photo_register_post_types()
{

	// CPT Photo
	$labels = array(
		'name' => 'photos',
		'all_items' => 'Toutes les photos',  // affiché dans le sous menu
		'singular_name' => 'Photo',
		'add_new_item' => 'Ajouter une photo',
		'edit_item' => 'Modifier la photo',
		'menu_name' => 'Photos'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_rest' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-customizer',
	);

	register_post_type('photo', $args);

	// Déclaration de la premiere Taxonomie
	$labels = array(
		'name' => 'Catégories',
		'singular_name' => 'Catégorie',
		'new_item_name' => 'Nom de la nouvelle Catégorie',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_rest' => true,
		'hierarchical' => true,
	);

	register_taxonomy('categorie', 'photo', $args);

	// Déclaration de la deuxième Taxonomie
	$labels = array(
		'name' => 'Formats',
		'singular_name' => 'Formats',
		'new_item_name' => 'Nom du nouveau Formats',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_rest' => true,
		'hierarchical' => true,
	);

	register_taxonomy('Formats', 'photo', $args);
}
add_action('init', 'photo_register_post_types'); // Le hook init lance la fonction

