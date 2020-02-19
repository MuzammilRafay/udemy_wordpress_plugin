<?php 

function recipe_admin_init()
{
	include('create-metaboxes.php');
	include('recipe-options.php');
	include( 'enqueue.php' );
	include( 'columns.php' ); // change columns of recipe in recipe/index
	add_action('add_meta_boxes_recipe','r_create_metaboxes');
	add_action('admin_enqueue_scripts','r_admin_enqueue');

	
	// if we want to change the content is displaying when we recipe/index page
// https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	add_filter('manage_recipe_posts_columns','r_add_new_recipe_columns');
	//
	add_action('manage_recipe_posts_custom_column','r_manage_recipe_columns',10,2);
}