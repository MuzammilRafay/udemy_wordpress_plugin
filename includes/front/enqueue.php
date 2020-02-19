<?php 
function r_enqueue_scripts(){
	wp_register_style( 
		'r_rate_it',
		plugins_url('/assets/rateit/rateit.css',RECIPE_PLUGIN_URL)
	);

	wp_enqueue_style('r_rate_it');

	wp_register_script(
		'r_rate_it',
		plugins_url('/assets/rateit/jquery.rateit.min.js',RECIPE_PLUGIN_URL),
		array('jquery'),
		'1.0.0',
		true //in footer
	);
	

	wp_register_script(
		'r_main',
		plugins_url('/assets/scripts/main.js',RECIPE_PLUGIN_URL),
		array('jquery'),
		'1.0.0',
		true //in footer
	);

	// this function used for providing translation link to javascript file
	wp_localize_script( 'r_main', 'recipe_obj', array(
		'ajax_url' => admin_url('admin-ajax.php')
		 //wp-admin/admin-ajax.php file aavailable in worpdress
	));

	//we are passing recipe_obj to r_main file okkay iin this object we have ajax_url

	wp_enqueue_script('r_rate_it');
	wp_enqueue_script('r_main');
	
}