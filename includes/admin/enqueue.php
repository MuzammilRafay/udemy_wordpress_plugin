<?php 

function r_admin_enqueue(){
	global $typenow; //variable set to the current post type . and this variable is available in only admin area because we use admin_enqueue_scripts action hooks okkay
	
	if($typenow != "recipe"){
		return;
	} 
	wp_register_style(
		'ju_bootstrap',
		plugins_url(
			'/assets/styles/bootstrap.css',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		)
	);
	wp_enqueue_style('ju_bootstrap');
}