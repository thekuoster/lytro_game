<?php

/*
  Plugin Name: Advanced WP Columns Plugin
  Plugin URI: http://www.wpcolumns.com/
  Description: Advanced WP Columns plugin allows you to set up your BLOG content in the multiple columns using simple user interface, without any short codes.
  Author: Vladica Savic
  Version: 1.0.0
  Author URI: http://vladicasavic.iz.rs

  == Copyright ==
  Copyright 2012 Vladica Savic (email: vladica.savic@gmail.com)

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>
 */
//GET PLUGIN SETTINGS TROUGHT AJAX =============================================
if (isset($_POST["pluginRequest"]) && $_POST["pluginRequest"] == "settings") {
    $options = get_option('wp_advanced_columns_plugin_options');
    echo json_encode($options);

    die(); //end script, and prevent wordpress ajax to return additional response
} else {
//ADD NEW BUTTON TO MCE AND HOOK OUR EDITOR PLUGIN =============================
    add_filter('mce_external_plugins', "advanced_wp_columns_plugin_register");
    add_filter('mce_buttons', 'advanced_wp_columns_plugin_add_button', 0);

    function advanced_wp_columns_plugin_add_button($buttons) {
        array_push($buttons, "separator", "advanced_wp_columns_plugin");
        return $buttons;
    }

    function advanced_wp_columns_plugin_register($plugin_array) {
        $url = plugins_url('/advanced_wp_columns_plugin.js', __FILE__);

        $plugin_array['advanced_wp_columns_plugin'] = $url;
        return $plugin_array;
    }

//ADD CSS TO THEME =============================================================
    function add_theme_styles() {
        wp_register_style('wp-columns-custom-style', plugins_url('/css/wp-columns-theme-style.css', __FILE__), array(), '20120208', 'all');
        wp_enqueue_style('wp-columns-custom-style');
    }

    add_action('wp_print_styles', 'add_theme_styles');

//ADD SETTINGS LINK ON PLUGIN PAGE =============================================
    function wp_advanced_columns_plugin_settings_link($links) {
        $settings_link = '<a href="options-general.php?page=wp_advanced_columns_plugin_settings_page">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'wp_advanced_columns_plugin_settings_link');

//REGISTER PLUGIN SETTINGS PAGE ================================================
    add_action('admin_menu', 'wp_advanced_columns_plugin_add_page');

    function wp_advanced_columns_plugin_add_page() {
        add_options_page('Advanced Post Columns', 'Advanced Columns', 'manage_options', 'wp_advanced_columns_plugin_settings_page', 'wp_advanced_columns_plugin_settings_page_display');
    }

//DISPLAY THE ADMIN OPTIONS PAGE ===============================================
    function wp_advanced_columns_plugin_settings_page_display() {
        echo '<div><form action="options.php" method="post">';
        settings_fields('wp_advanced_columns_plugin_options');
        do_settings_sections('plugin');
        echo '<br />';
        echo '<input name="Submit" type="submit" class="button-primary" value="Save Changes" /></form></div>';
    }

//ADD THE ADMIN SETTINGS AND SUCH ==============================================
    add_action('admin_init', 'wp_advanced_columns_plugin_settings_init');

    function wp_advanced_columns_plugin_settings_init() {
        register_setting('wp_advanced_columns_plugin_options', 'wp_advanced_columns_plugin_options', 'wp_advanced_columns_plugin_options_validate');
        add_settings_section('plugin_main_section', 'Advanced WP Columns Plugin', 'plugin_main_section_text', 'plugin');
        add_settings_field('plugin_columns_number', 'Default number of columns:', 'plugin_columns_number', 'plugin', 'plugin_main_section');
        add_settings_field('plugin_full_width', 'Default columns container width:', 'plugin_full_width', 'plugin', 'plugin_main_section');
        add_settings_field('plugin_gutter_width', 'Default columns gutter width:', 'plugin_gutter_width', 'plugin', 'plugin_main_section');
        add_settings_section('plugin_sub_section', '', 'plugin_sub_section_text', 'plugin');
        add_settings_field('plugin_holder_class', 'Columns wrapper CSS class:', 'plugin_holder_class', 'plugin', 'plugin_sub_section');
        add_settings_field('plugin_column_class', 'Single column CSS class:', 'plugin_column_class', 'plugin', 'plugin_sub_section');
        add_settings_field('plugin_gutter_class', 'Columns gutter CSS class:', 'plugin_gutter_class', 'plugin', 'plugin_sub_section');
    }

    function plugin_main_section_text() {
        echo '<p><b>Main options related to the default advanced wp columns plugin settings.</b></p>';
    }

    function plugin_sub_section_text() {
        echo '<p><b>Additional params for theming.</b></p>';
    }

    function plugin_columns_number() {
        $options = get_option('wp_advanced_columns_plugin_options');
        echo "<input id='wp_advanced_columns_plugin_columns_number' name='wp_advanced_columns_plugin_options[columns_number]' size='10' type='text' value='{$options['columns_number']}' />";
    }

    function plugin_full_width() {
        $options = get_option('wp_advanced_columns_plugin_options');
        echo "<input id='wp_advanced_columns_plugin_full_width' name='wp_advanced_columns_plugin_options[full_width]' size='10' type='text' value='{$options['full_width']}' />";
    }

    function plugin_gutter_width() {
        $options = get_option('wp_advanced_columns_plugin_options');
        echo "<input id='wp_advanced_columns_plugin_gutter_width' name='wp_advanced_columns_plugin_options[gutter_width]' size='10' type='text' value='{$options['gutter_width']}' />";
    }

    function plugin_holder_class() {
        $options = get_option('wp_advanced_columns_plugin_options');
        echo "<input id='wp_advanced_columns_plugin_holder_class' name='wp_advanced_columns_plugin_options[holder_class]' size='40' type='text' value='{$options['holder_class']}' />";
    }

    function plugin_column_class() {
        $options = get_option('wp_advanced_columns_plugin_options');
        echo "<input id='wp_advanced_columns_plugin_column_class' name='wp_advanced_columns_plugin_options[column_class]' size='40' type='text' value='{$options['column_class']}' />";
    }

    function plugin_gutter_class() {
        $options = get_option('wp_advanced_columns_plugin_options');
        echo "<input id='wp_advanced_columns_plugin_gutter_class' name='wp_advanced_columns_plugin_options[gutter_class]' size='40' type='text' value='{$options['gutter_class']}' />";
    }

//VALIDATE PLUGIN OPTIONS ======================================================
    function wp_advanced_columns_plugin_options_validate($input) {
        $options = get_option('wp_advanced_columns_plugin_options');

        $options['columns_number'] = trim($input['columns_number']);
        $options['full_width'] = trim($input['full_width']);
        $options['gutter_width'] = trim($input['gutter_width']);
        $options['holder_class'] = trim($input['holder_class']);
        $options['column_class'] = trim($input['column_class']);
        $options['gutter_class'] = trim($input['gutter_class']);

        if (!preg_match('/^[0-9]+$/i', $options['columns_number'])
                || !preg_match('/^[0-9]+$/i', $options['full_width'])
                || !preg_match('/^[0-9]+$/i', $options['gutter_width'])) {
            add_settings_error(
                    'Invalid Settings Input', 'wp_advanced_columns_input_error', 'Invalid input data, only numbers allowed!', 'error'
            );

            $options['columns_number'] = '';
            $options['full_width'] = '';
            $options['gutter_width'] = '';
        }
        return $options;
    }

}
?>