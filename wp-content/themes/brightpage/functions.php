<?php
/**
 * Brightpage functions and definitions
 *
 * Sets up the theme and provides some helper functions. 
 *
 * @package WordPress
 * @subpackage Brightpage
 */

	/* Make Brightpage available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Brightpage, use a find and replace
	 * to change 'brightpage' to the name of your theme in all the template files.
	 */

	load_theme_textdomain('brightpage');

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
	   require_once( $locale_file );
  

	/* Properly enqueue styles and scripts for our theme options page.
	 * This function is attached to the admin_enqueue_scripts action hook.
	 */

	function brightpage_scripts(){
		if( !is_admin() ) {

			// comment out the next two lines to load the local copy of jQuery
			wp_deregister_script('jquery');
			wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js', false, '1.6.1');
			wp_enqueue_script('jquery');
		    
   			wp_enqueue_script( 'brightpage_tooltip', get_template_directory_uri() . '/js/tooltip.js', array('jquery') );
			wp_enqueue_script( 'brightpage_custom', get_template_directory_uri() . '/js/custom.js', array('jquery') );
			wp_enqueue_script( 'brightpage_nivoslider', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array('jquery') );
		}
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
	
	}
	add_action( 'wp_enqueue_scripts', 'brightpage_scripts' );

/* Add support for custom image header ********************************************/
	
	define('NO_HEADER_TEXT', true );
	define('HEADER_TEXTCOLOR', '');
	define('HEADER_IMAGE', '%s/images/default_header.jpg'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 980); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 128);
	
	// gets included in the site header
	function brightpage_header_style() {
	
	    ?><style type="text/css">
	        #header { background: url(<?php header_image(); ?>); }	
		  </style><?php
	}
	
	// gets included in the admin header
	function brightpage_admin_header_style() {
	    ?><style type="text/css">
	        #headimg {
	            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	            background: no-repeat;
	        }
	    </style><?php
	}
	
	add_custom_image_header('brightpage_header_style', 'brightpage_admin_header_style');

/* Add support for custom backgrounds ********************************************/

	add_custom_background();
	
/* Define content width  ********************************************/

	// set content width
	if ( ! isset( $content_width ) ) $content_width = 600;

/* Enable support for automatic-feed-links ********************************************/

	add_theme_support('automatic-feed-links');

/* Enable support for post-thumbnails ********************************************/
		
	// If we want to ensure that we only call this function if
	// the user is working with WP 2.9 or higher,
	// let's instead make sure that the function exists first
	
	add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
	set_post_thumbnail_size( 200, 200, true ); // Normal post thumbnails, hard crop mode
	add_image_size( 'post-image', 600, 200, true ); // Post thumbnails, hard crop mode
	add_image_size( 'slider-image', 920, 300, true ); // Post thumbnails for slider, hard crop mode

/* Breadcrumb ********************************************/

	function brightpage_the_breadcrumb() {
		if (!is_home()) {
			echo '<a href="';
			echo home_url('home');
			echo '">';
			echo ('Home');
			echo "</a> &raquo; ";
			if (is_single()) {
				the_title('');
				if (is_single()) {
					echo "";
				}
			} elseif (is_page()) {
				echo the_title();
			}
		}
	}


/* WordPress 3.0 Menu Editor ********************************************/

	// add menu support and fallback menu if menu doesn't exist
	add_action('init', 'wpj_register_menu');
	function wpj_register_menu() {
		if (function_exists('register_nav_menu')) {
			register_nav_menu( 'wpj-main-menu', __( 'Main Menu', 'brightpage' ) );
		}
	}
	function wpj_default_menu() {
		echo '<ul id="dropmenu">';
		if ('page' != get_option('show_on_front')) {
			echo '<li><a href="'. home_url() . '/">Home</a></li>';
		}
		wp_list_pages('title_li=');
		echo '</ul>';
	}


/* Excerpt ********************************************/

	/* Make the "read more" link to the post */
	function brightpage_new_excerpt_more($more) {
	       global $post;
		return '<br /><span class="read_more"><a href="'. get_permalink($post->ID) . '">' . 'Read more...' . '</a></span>';
	}
	add_filter('excerpt_more', 'brightpage_new_excerpt_more');
	
	/* Set the excerpt length */
	function brightpage_new_excerpt_length($length) {
		return 60;
	}
	add_filter('excerpt_length', 'brightpage_new_excerpt_length');


/* Register sidebars and widgetized areas ********************************************/
	
	function brightpage_widget_areas() {

		register_sidebar( array(
			'name' => __( 'Welcome Message', 'brightpage' ),
			'id' => 'welcome-message',
			'description' => __( 'An optional widget area for your welcome message area.', 'brightpage' ),
			'before_widget' => '<div class="big">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => '',
		) );

	    register_sidebar(array(
			'name' => __( 'Sidebar Top', 'brightpage' ),
			'id' => 'sidebar-top',
			'description' => __( 'An optional widget area for your sidebar top.', 'brightpage' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	    
   	    register_sidebar( array(
			'name' => __( 'Sidebar Left', 'brightpage' ),
			'id' => 'sidebar-left',
			'description' => __( 'An optional widget area for your sidebar left.', 'brightpage' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	
	    register_sidebar( array(
			'name' => __( 'Sidebar Right', 'brightpage' ),
			'id' => 'sidebar-right',
			'description' => __( 'An optional widget area for your sidebar right.', 'brightpage' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
		
		register_sidebar( array(
			'name' => __( 'Bottom Menu Left', 'brightpage' ),
			'id' => 'bottom-menu-left',
			'description' => __( 'An optional widget area for your site footer', 'brightpage' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
		register_sidebar( array(
			'name' => __( 'Bottom Menu Center', 'brightpage' ),
			'id' => 'bottom-menu-center',
			'description' => __( 'An optional widget area for your site footer', 'brightpage' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
		register_sidebar( array(
			'name' => __( 'Bottom Menu Right', 'brightpage' ),
			'id' => 'bottom-menu-right',
			'description' => __( 'An optional widget area for your site footer', 'brightpage' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}
	add_action('widgets_init', 'brightpage_widget_areas');

?>
