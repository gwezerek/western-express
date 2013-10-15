<?php
/*
Plugin Name: WP-Admin Icons  
Version: 1.3
Author URI: http://imdev.in/
Plugin URI: http://www.wordimpress.com/
Description:  This plugin provides admins total control over the WordPress administrator dashboard icons.  Implement your own custom WordPress icons or choose from one of hundreds that come with the plugin through an easy-to-use and intuitive  interface.  Developed by <a href="http://imdev.in" title="Visit Devin's Website">Devin Walker</a> of <a href="http://www.wordimpress.com">WordImpress</a> for the WordPress community.
Author: Devin Walker
License: GPL2

	USAGE:

	Copyright (C) 2010  Devin Walker, http://www.wordimpress.com
	
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
    
*/

/* Version check */
global $wp_version;

$exit_msg = 'WP Admin Icons requires WordPress 3.0 or newer.  <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (version_compare($wp_version, "3.0", "<")) {
    exit ($exit_msg);
}

add_action('admin_menu', 'my_plugin_menu');

/**
 * Add Settings link to plugins
 */

add_filter('plugin_action_links', 'add_settings_link', 10, 2);

/**
 * Add Settings link to plugins
 */
function add_settings_link($links, $file)
{
    static $this_plugin;
    if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

    if ($file == $this_plugin) {
        $settings_link = '<a href="admin.php?page=wp-admin-icons/wp-admin-icons-init.php">' . __("Settings", "photosmash-galleries") . '</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}


add_filter('plugin_action_links', 'add_settings_link', 10, 2);

function my_plugin_menu()
{

    //create new wordpress setting options page
    $page = add_options_page('WP-Admin Icons Options Page', 'WP-Admin Icons', 'manage_options', __FILE__, 'my_plugin_options');

    //call register settings function
    add_action('admin_init', 'register_mysettings');

    //call register settings function
    //add_action( 'admin_init', 'add_styles' );

    //ok now that we have registered our settings let's get the styles into our admin head
    add_action('admin_print_styles-' . $page, 'my_plugin_admin_styles');

    /* Using registered $page handle to hook script load */
    add_action('admin_print_scripts-' . $page, 'my_plugin_admin_styles');

}


function register_mysettings()
{

    //register our stylesheet
    wp_register_style('myPluginStylesheet', WP_PLUGIN_URL . '/wp-admin-icons/includes/icons-style.css');

    //register our javascript
    wp_register_script('myPluginScript', WP_PLUGIN_URL . '/wp-admin-icons/includes/icons-scripts.js');

    //register our options settings
    register_setting('icons-settings-group', 'admin-icons-options');
    //register our options settings
    register_setting('icons-settings-group-more', 'admin-icons-options-more');


}

function my_plugin_admin_styles()
{
    /* It will be called only on your plugin admin page, enqueue our stylesheet here */
    wp_enqueue_style('myPluginStylesheet');

    /* It will be called only on your plugin admin page, enqueue our script here */
    wp_enqueue_script('myPluginScript');

}

function my_plugin_options()
{

    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }


// let's get the WP-icons admin page for the user

    $plugin_dir = dirname(plugin_basename(__FILE__)); //plugin absolute server directory name
    $wpicons_path = ABSPATH . "wp-content/plugins/" . $plugin_dir; //absolute server path to plugin directory

    // let's get the wp admin icons plugin stylesheet
    add_action('wp_print_styles', 'add_my_stylesheet');

    // get the admin options screen
    include("includes/wp-admin-icons-options.php");

}

// the lines below are helpful for debugging the wp-admin icons options array
//	$options = get_option('admin-icons-options');
//	echo "<pre>";
//    var_dump($options);
//    echo "</pre>";

function add_styles()
{

    $options = get_option('admin-icons-options');

    $moreOptions = get_option('admin-icons-options-more');

    echo '<style type="text/css" media="screen">';

    if ($moreOptions['removeIcons']) {
        echo '.wp-menu-image { display: none; }';
    }

    if ($moreOptions['removeLogo']) {
        echo '#wp-admin-bar-wp-logo { display: none; }';
    }

    if ($options['dashboardIconURL'] != NULL) {
        echo '#adminmenu .menu-icon-dashboard div.wp-menu-image {
					background:url("';
        echo $options["dashboardIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-dashboard.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-dashboard.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["dashboardIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-dashboard:hover div.wp-menu-image {
					background:url("';
        echo $options["dashboardIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['postIconURL'] != NULL) {
        echo '#adminmenu #menu-posts div.wp-menu-image {
					background:url("';
        echo $options["postIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu #menu-posts.wp-menu-open  div.wp-menu-image, #adminmenu #menu-posts.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["postIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu #menu-posts:hover div.wp-menu-image {
					background:url("';
        echo $options["postIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;

    if ($options['mediaIconURL'] != NULL) {

        echo  '#adminmenu .menu-icon-media div.wp-menu-image {
					background:url("';
        echo $options["mediaIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-media.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-media.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["mediaIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-media:hover div.wp-menu-image {
					background:url("';
        echo $options["mediaIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['linksIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-links div.wp-menu-image {
					background:url("';
        echo $options["linksIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-links.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-media.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["linksIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-links:hover div.wp-menu-image {
					background:url("';
        echo $options["linksIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['pagesIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-page div.wp-menu-image {
					background:url("';
        echo $options["pagesIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-page.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-page.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["pagesIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-page:hover div.wp-menu-image {
					background:url("';
        echo $options["pagesIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;

    if ($options['commentsIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-comments div.wp-menu-image {
					background:url("';
        echo $options["commentsIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-comments.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-comments.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["commentsIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-comments:hover div.wp-menu-image {
					background:url("';
        echo $options["commentsIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['appearanceIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-appearance div.wp-menu-image {
					background:url("';
        echo $options["appearanceIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-appearance.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-appearance.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["appearanceIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-appearance:hover div.wp-menu-image {
					background:url("';
        echo $options["appearanceIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['pluginsIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-plugins div.wp-menu-image {
					background:url("';
        echo $options["pluginsIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-plugins.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-plugins.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["pluginsIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-plugins:hover div.wp-menu-image {
					background:url("';
        echo $options["pluginsIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['usersIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-users div.wp-menu-image {
					background:url("';
        echo $options["usersIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
				}
				#adminmenu .menu-icon-users.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-users.wp-menu-open:hover  div.wp-menu-image  {
					background:url("';
        echo $options["usersIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}
				#adminmenu .menu-icon-users:hover div.wp-menu-image {
					background:url("';
        echo $options["usersIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
				}';

    }
    ;


    if ($options['toolsIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-tools div.wp-menu-image {
                        background:url("';
        echo $options["toolsIconURL"];
        echo '") no-repeat scroll 7px -17px transparent;
                    }
                    #adminmenu .menu-icon-tools.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-tools.wp-menu-open:hover  div.wp-menu-image  {
                        background:url("';
        echo $options["toolsIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
                    }
                    #adminmenu .menu-icon-tools:hover div.wp-menu-image {
                        background:url("';
        echo $options["toolsIconURL"];
        echo '") no-repeat scroll 7px 7px transparent;
                    }';

    }
    ;

    if ($options['settingsIconURL'] != NULL) {

        echo '#adminmenu .menu-icon-settings div.wp-menu-image {
                        background:url("' . $options["settingsIconURL"] . '") no-repeat scroll 7px -17px transparent;
                    }
                    #adminmenu .menu-icon-settings.wp-menu-open  div.wp-menu-image, #adminmenu .menu-icon-settings.wp-menu-open:hover  div.wp-menu-image  {
                        background:url("' . $options["settingsIconURL"] . '") no-repeat scroll 7px 7px transparent;
                    }
                    #adminmenu .menu-icon-settings:hover div.wp-menu-image {
                        background:url("' . $options["settingsIconURL"] . '") no-repeat scroll 7px 7px transparent;
                    }';

    }
    ;

    //Custom Post Type Icons
    $args = array(
        '_builtin' => false
    );
    $post_types = get_post_types($args, 'names');


    foreach ($post_types as $post_type) {

        $thisOption = $post_type . 'IconURL';


        if ($options[$thisOption] != NULL) {

            echo '#adminmenu #menu-posts-' . $post_type . ' div.wp-menu-image {
                        background:url("' . $options[$thisOption] . '") no-repeat scroll 7px -17px transparent; }';

            echo '#adminmenu #menu-posts-' . $post_type . ':hover  div.wp-menu-image  { background:url("' . $options[$thisOption] . '") no-repeat scroll 7px 7px transparent; }';

            echo '#adminmenu #menu-posts-' . $post_type . '.wp-menu-open  div.wp-menu-image { background:url("' . $options[$thisOption] . '") no-repeat scroll 7px 7px transparent; }';

        }

    }


    echo '</style>';

}

add_action('admin_head', 'add_styles');

?>