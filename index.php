<?php 

/*
 * Plugin Name: Recipe
 * Description: A simple wordpress plugin that allows users to ccreaste recipes and rate those recipes
 * Version: 1.0
 * Author: Udemy
 * Author URI: http://udemy.com
 * Text Domain: recipe
 */


// security checck wordpress available from function exists function

if(!function_exists('add_action')){
	die("hi there ! i'm just a plugin, not  much i can do when called directly.");
}

//Setup
// constant variables
define('RECIPE_PLUGIN_URL',__FILE__);


//Includes
include('includes/activate.php');
include('includes/init.php');
include('includes/admin/init.php');
include('process/save-post.php');
include('process/filter-content.php');
include('includes/front/enqueue.php');
include('process/rate-recipe.php');
include(dirname(RECIPE_PLUGIN_URL).'/includes/widgets.php');
include('includes/widgets/daily-recipe.php');
include('includes/cron.php');
include('includes/shortcodes/creator.php');


//Hooks
register_activation_hook(__FILE__,'r_activate_plugin');
register_deactivation_hook(__FILE__,'r_deactivate_plugin');
//this funcction run when plugin is activated!
add_action('init','recipe_init');
add_action('admin_init','recipe_admin_init'); //add metaboxes there
//save post hook trigger when every post is save okkay
// https://developer.wordpress.org/reference/hooks/save_post/
// so we use save_post_{post_type}
add_action(
	'save_post_recipe',
	'r_save_post_admin',
	10, //priority
	3 //by default is 1
);

add_filter('the_content','r_filter_recipe_content');
add_action('wp_enqueue_scripts','r_enqueue_scripts',100);  // load last  priority 
add_action('wp_ajax_r_rate_recipe','r_rate_recipe');
// https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
add_action('wp_ajax_nopriv_r_rate_recipe','r_rate_recipe');
//no priv function also process request when user its not login no priv stand for no privillegs
//widgets api https://codex.wordpress.org/Widgets_API
add_action('widgets_init','r_widgets_init');
add_action('r_daily_recipe_hook','r_generate_daily_recipe');

//Shortcodes
add_shortcode( 'recipe_creator', 'r_recipe_creator_shortcode' );