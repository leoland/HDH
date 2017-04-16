<?php
/**
 * Hunter Douglas Hospitality functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hunter_Douglas_Hospitality
 */

if ( ! function_exists( 'hdh_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hdh_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hunter Douglas Hospitality, use a find and replace
		 * to change 'hdh' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hdh', get_template_directory() . '/languages' );

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

		// Menus
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Navigation', 'hdh' ),
			'secondary' => esc_html__( 'Secondary Navigation', 'hdh' ),
			'mobile' => esc_html__( 'Mobile Navigation', 'hdh' ),
			'footer'    => esc_html__( 'Footer Navigation', 'hdh' ),
		) );

// Intented to use with locations, like 'primary'
// clean_custom_menu("primary");

#add in your theme functions.php file



		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hdh_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'hdh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hdh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hdh_content_width', 640 );
}

add_action( 'after_setup_theme', 'hdh_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hdh_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hdh' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hdh' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'hdh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

//todo Come collect scripts and styles across pages and consolidate them here.
//todo check for scripts loading on unnecessary pages.
function hdh_scripts() {

	//$cache_bust = '?'.filemtime( get_stylesheet_uri());
	$cache_bust = '?' . filemtime( get_stylesheet_directory() . '/style.css' );
	wp_enqueue_style( 'hdh-style', get_stylesheet_uri(), array(), $cache_bust );

	wp_enqueue_script( 'hdh-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'hdh-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	// register loadCSS
	wp_register_script( 'load-css-async', get_stylesheet_directory_uri() . '/js/loadCSS.js', array(), '', false );

	// enqueue loadCSS
	wp_enqueue_script( 'load-css-async' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ):
		wp_enqueue_script( 'comment-reply' );
	endif;

	wp_enqueue_script( 'jquery' );

	if ( is_singular( array(
			'product_line',
			'collection_pattern',
			'printed_rs_fr_col'
		) ) || ( is_page_template( 'page_roller_shades_fr.php' ) )
	):
		wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick/slick.css' );
		wp_register_script( 'slick-min', get_stylesheet_directory_uri() . '/slick/slick.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'slick-min' );

//smiles
	endif;
	wp_enqueue_style( 'featherlight', 'http://cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.css' );
	wp_enqueue_style( 'featherlight-gallery', 'http://cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.gallery.min.css' );
}

add_action( 'wp_enqueue_scripts', 'hdh_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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


/*
 * Custom Menu Ordderings
 */
function custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) {
		return true;
	}

	return array(
		//come back to this near end to get all menus in order
		'index.php', // Dashboard
		'edit.php?post_type=page', // Pages
		'edit.php?post_type=product_type', // Custom Collections
		'edit.php?post_type=product_line', // regular products
		'edit.php?post_type=roller_shades', // roller shades fr
		'edit.php?post_type=printed_rs_fr_col', // Printed roller shades fr collection
		'edit.php?post_type=collection_pattern', // Printed roller shades fr collection pattern
		'edit.php?post_type=project', // Projects
		'edit.php?post_type=sales_rep', // Reps
		'upload.php', // Media
		'gf_edit_forms', // Forms
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
	);

}

add_filter( 'custom_menu_order', 'custom_menu_order' ); // Activate custom_menu_order
add_filter( 'menu_order', 'custom_menu_order' );
/**/
/* Nuke commenting functionality  */
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}

add_action( 'admin_init', 'df_disable_comments_post_types_support' );

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}

add_filter( 'comments_open', 'df_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'df_disable_comments_status', 20, 2 );

// Hide existing comments
function df_disable_comments_hide_existing_comments( $comments ) {
	$comments = array();

	return $comments;
}

add_filter( 'comments_array', 'df_disable_comments_hide_existing_comments', 10, 2 );

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'df_disable_comments_admin_menu' );

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ( $pagenow === 'edit-comments.php' ) {
		wp_redirect( admin_url() );
		exit;
	}
}

add_action( 'admin_init', 'df_disable_comments_admin_menu_redirect' );

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}

add_action( 'admin_init', 'df_disable_comments_dashboard' );

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}

add_action( 'init', 'df_disable_comments_admin_bar' );

/*
 * Custom image sizes
 */

add_image_size( 'vertical', 348, 261, true );
add_image_size( 'horizontal', 567, 348, true );
add_image_size( 'banner', 1600, 526, true );
add_image_size( 'fabric-full', 567, 567, true );
add_image_size( 'fabric-thumb', 129, 129, true );
add_image_size( 'slider', 497, 660, true );
add_image_size( 'slider-collections', 800, 550, true );
add_image_size( 'slider-thumb', 90, 66 );


// change number of posts on the Gallery archive

function ll_posts_for_gallery( $query ) {
	if ( $query->is_main_query() && $query->is_post_type_archive( 'project' ) ) {
		$query->set( 'posts_per_page', - 1 );
	}
}

add_action( 'pre_get_posts', 'll_posts_for_gallery' );

//increase file size 

@ini_set( 'upload_max_size', '96M' );
@ini_set( 'post_max_size', '96M' );
@ini_set( 'max_execution_time', '450' );

//login logo to sue HDH logo instead
function ll_custom_login_logo() {
	echo '<style type="text/css">
        .login.login h1 a {background-size: contain;
    width: 100%;background-image:url(' . get_stylesheet_directory_uri() . '/images/hdh-logo-full.png); }
    </style>';
}

add_action( 'login_head', 'll_custom_login_logo' );

function ll_login_logo_url() {
	return get_bloginfo( 'url' );
}

add_filter( 'login_headerurl', 'll_login_logo_url' );

function ll_login_logo_url_title() {
	return 'Hunter Douglas Hospitality';
}

add_filter( 'login_headertitle', 'll_login_logo_url_title' );


//the excerpt
function ll_excerpt_more( $more ) {
	return '...';
}

add_filter( 'excerpt_more', 'll_excerpt_more' );

function ll_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'll_excerpt_length', 999 );




function ll_filter_function() {
	$args = array(
		'orderby' => 'name',
		'order'   => 'desc',
	);

	if ( isset( $_POST['categoryfilter'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'region',
				'field'    => 'id',
				'terms'    => $_POST['categoryfilter']
			)
		);
	}
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ): $query->the_post(); ?>
            <div class="single-rep">
                <h3 class="name"> <?php echo $query->post->post_title ?> </h3>
                <div class="tel">
                    <a href="tel:<?php
                    the_field( 'phone_number' ); ?>"><?php
	                    the_field( 'phone_number' ); ?></a>
                </div>

                <a class="email" href="mailto:<?php the_field( 'email' );
				?>" target="_blank">Send an email</a>

            </div>
			<?php
		endwhile;
		wp_reset_postdata();

		?>
		<?php
	else :
		echo 'We do not seem to have reps in that area';
	endif;

	die();
}


add_action( 'wp_ajax_myfilter', 'll_filter_function' );
add_action( 'wp_ajax_nopriv_myfilter', 'll_filter_function' );



function exclude_from_search($query) {
	if( $query->is_search) {
		$query->set( 'post_type', array( 'post', 'page', 'product_line', 'product_type', 'printed_rs_fr_col', 'collection_pattern') );
	}
}
add_filter( 'pre_get_posts','exclude_from_search' );

// change search result number
function change_wp_search_size($queryVars) {
	if ( isset($_REQUEST['s']) )
		$queryVars['posts_per_page'] = 12;
	return $queryVars;
}
add_filter('request', 'change_wp_search_size');
/// Custom menu



function create_menu( $theme_location ) {
	if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {

		$menu_list  = '';
		$menu = get_term( $locations[$theme_location], 'nav_menu' );
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		foreach( $menu_items as $menu_item ) {
			if( $menu_item->menu_item_parent == 0 ) {

				$parent = $menu_item->ID;

				$menu_array = array();
				foreach( $menu_items as $submenu ) {
					if( $submenu->menu_item_parent == $parent ) {
						$bool = true;
						$menu_array[] = '<li><a href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n";
					}
				}
				if( $bool == true && count( $menu_array ) > 0 ) {

					$menu_list .= '<li class="dropdown">' ."\n";
					$menu_list .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>' ."\n";

					$menu_list .= '<ul class="dropdown-menu">' ."\n";
					$menu_list .= implode( "\n", $menu_array );
					$menu_list .= '</ul>' ."\n";

				} else {

					$menu_list .= '<li>' ."\n";
					$menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
				}

			}

			// end <li>
			$menu_list .= '</li>' ."\n";
		}

	} else {
		$menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
	}

	echo $menu_list;
}


///lazy loader for filter page

/**
 * Gets an attachement image as lazy loaded img based on ID
 * @param  string  $size          Thumbnail, medium, large, original, or {custom size}
 * @param  string  $class         CSS class name for the img tag
 * @param  integer $attachment_id ID of the attachment
 * @param  string  $attachment_id The custom src atrribute to use, default to data-echo
 * @return string                 Lazyload friendly HTML img tag
 */
function get_attachment_lazy($size, $class, $attachment_id = "", $src_attr = "data-src")
{
	$src = wp_get_attachment_url($attachment_id);
	$attr = array(
		'class' => "attachment-$size $class",
		'src' => 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==',
		$src_attr => $src,
	);
	$output = wp_get_attachment_image($attachment_id, $size, false, $attr);
	return $output;
}

/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
	global $wpdb;

	if ( is_search() ) {
		$join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	}

	return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
	global $wpdb;

	if ( is_search() ) {
		$where = preg_replace(
			"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
	}

	return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
	global $wpdb;

	if ( is_search() ) {
		return "DISTINCT";
	}

	return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );





