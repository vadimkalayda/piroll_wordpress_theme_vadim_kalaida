<?php
/**
 * piroll functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package piroll
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'piroll_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function piroll_setup() {
    add_filter('show_admin_bar', '__return_false');
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on piroll, use a find and replace
		 * to change 'piroll' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'piroll', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'piroll' ),
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
				'piroll_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'piroll_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function piroll_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'piroll_content_width', 640 );
}
add_action( 'after_setup_theme', 'piroll_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function piroll_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'piroll' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'piroll' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'piroll_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
define('PI_THEME_ROOT', get_template_directory_uri());
define('PI_CSS_DIR', PI_THEME_ROOT.'/layouts');
define('PI_JS_DIR', PI_THEME_ROOT.'/js');
define('PI_IMG_DIR', PI_THEME_ROOT.'/img');

function connectMainRoots() {
  wp_enqueue_style('basic', PI_CSS_DIR.'/basic.css');
  wp_enqueue_style('header', PI_CSS_DIR.'/header.css');
  wp_enqueue_style('top_banner', PI_CSS_DIR.'/top_banner.css');
  wp_enqueue_style('about_us', PI_CSS_DIR.'/about_us.css');
  wp_enqueue_style('skills', PI_CSS_DIR.'/skills.css');
  wp_enqueue_style('numbers', PI_CSS_DIR.'/numbers.css');
  wp_enqueue_style('works', PI_CSS_DIR.'/works.css');
  wp_enqueue_style('work_process', PI_CSS_DIR.'/work_process.css');
  wp_enqueue_style('services', PI_CSS_DIR.'/services.css');
  wp_enqueue_style('testimonials', PI_CSS_DIR.'/testimonials.css');
  wp_enqueue_style('clients', PI_CSS_DIR.'/clients.css');
  wp_enqueue_style('contact', PI_CSS_DIR.'/contact.css');
  wp_enqueue_style('footer', PI_CSS_DIR.'/footer.css');
}

add_action('wp_enqueue_scripts', 'connectMainRoots');

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

function create_post_type_pi_skills() {

  register_post_type( 'pi_skills',
    array(
      'labels' => array(
        'name' => __( 'Skills' ),
        'singular_name' => __( 'Skills' ),
      ),
      'public' => true,
      'menu_icon'     => 'dashicons-star-filled',
      'has_archive' => true,
      'supports'           => array('')
    )
  );
}
add_action( 'init', 'create_post_type_pi_skills' );

function create_post_type_pi_numbers() {

  register_post_type( 'pi_numbers',
    array(
      'labels' => array(
        'name' => __( 'Numbers' ),
        'singular_name' => __( 'Numbers' ),
      ),
      'public' => true,
      'menu_icon'     => 'dashicons-lightbulb',
      'has_archive' => true,
      'supports'           => array('thumbnail')
    )
  );
}
add_action( 'init', 'create_post_type_pi_numbers' );

function create_post_type_pi_works() {

  register_post_type( 'pi_works',
    array(
      'labels' => array(
        'name' => __( 'Works' ),
        'singular_name' => __( 'Works' ),
      ),
      'public' => true,
      'menu_icon'     => 'dashicons-admin-page',
      'has_archive' => true,
      'supports'           => array('thumbnail', 'title')
    )
  );
}
add_action( 'init', 'create_post_type_pi_works' );

function create_post_type_pi_services() {

  register_post_type( 'pi_services',
    array(
      'labels' => array(
        'name' => __( 'Services' ),
        'singular_name' => __( 'Services' ),
      ),
      'public' => true,
      'menu_icon'     => 'dashicons-awards',
      'has_archive' => true,
      'supports'           => array('thumbnail')
    )
  );
}
add_action( 'init', 'create_post_type_pi_services' );

function create_post_type_pi_clients() {

  register_post_type( 'pi_clients',
    array(
      'labels' => array(
        'name' => __( 'Clients' ),
        'singular_name' => __( 'Clients' ),
      ),
      'public' => true,
      'menu_icon'     => 'dashicons-universal-access-alt',
      'has_archive' => true,
      'supports'           => array('title', 'thumbnail')
    )
  );
}
add_action( 'init', 'create_post_type_pi_clients' );