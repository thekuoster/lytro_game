<?php
/*
Plugin Name: NextGEN Flex Slider Template
Plugin URI: http://wpdevsnippets.com/nextgen-flex-image-content-slider-template/
Description: Add a "sliderview" template for the NextGen gallery. Use the shortcode [nggallery id=x template="sliderview"] to display images as the slider.
Author: Mohsin Rasool
Author URI: http://wpdevsnippets.com
Version: 1.7
*/

include 'admin-settings.php';

if (!class_exists('nggSliderview')) {
    class nggSliderview {
        var $plugin_name = null; 
        function nggSliderview() {
            $this->plugin_name = '/'.plugin_basename( dirname(__FILE__) ).'/';
            add_action('wp_enqueue_scripts', array(&$this, 'load_scripts') );
            add_action('wp_enqueue_scripts', array(&$this, 'load_styles') );
            add_filter('ngg_render_template', array(&$this, 'add_template'), 10, 2);
        }

        function add_template( $path, $template_name = false) {

            if ($template_name == 'gallery-sliderview') {
                $path = WP_PLUGIN_DIR.$this->plugin_name.'/template-nggsliderview.php';
            }

            return $path;
        }

        function load_styles() {
            wp_enqueue_style('nggsliderview-css', plugins_url($this->plugin_name.'css/style.css'), false, '1.0.1', 'screen');
            /*
            if(!get_option('ng_slider_theme'))
                wp_enqueue_style('nggsliderview-css', plugins_url($this->plugin_name.'css/black.css'), false, '1.0.1', 'screen');
            else if(get_option('ng_slider_theme') == 2)
                wp_enqueue_style('nggsliderview-greycss', plugins_url($this->plugin_name.'css/grey.css'), false, '1.0.1', 'screen');
            else
                wp_enqueue_style('nggsliderview-bluecss', plugins_url($this->plugin_name.'css/blue.css'), false, '1.0.1', 'screen');
             * 
             */
        }

        function load_scripts() {
            wp_enqueue_script('nggsliderview', plugins_url($this->plugin_name.'js/jquery.flexslider-min.js'), array('jquery'), '1.2');			
        }

    }

    // Start this plugin once all other plugins are fully loaded
    add_action( 'plugins_loaded', create_function( '', 'global $nggSliderview; $nggSliderview = new nggSliderview();' ) );

}

// Plugin Activation Hook
function nggFlexSliderview_activate(){
    // Check if its a first install
    if(!get_option('ng_slider_theme'))
        add_option( 'ng_slider_theme', '0');
    if(!get_option('ng_slider_display_content'))
        add_option( 'ng_slider_display_content', '0' );
    if(!get_option('ng_slider_slideshow_speed'))
        add_option( 'ng_slider_slideshow_speed', '7' );
    if(!get_option('ng_slider_order'))
        add_option( 'ng_slider_order', '0' );
    //if(!get_option('ng_slider_direction'))
        //add_option( 'ng_slider_direction', 'horizontal' );
    if(!get_option('ng_slider_direction_nav'))
        add_option( 'ng_slider_direction_nav', '1' );
    if(!get_option('ng_slider_pagination'))
        add_option( 'ng_slider_pagination', 'bullet' );

    if(!get_option('ng_slider_us_width_for_img_slider'))
        add_option( 'ng_slider_us_width_for_img_slider', '0' );

    
}
register_activation_hook( __FILE__, 'nggFlexSliderview_activate' );
