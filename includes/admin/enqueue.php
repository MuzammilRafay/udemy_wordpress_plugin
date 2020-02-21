<?php 

function r_admin_enqueue(){
	global $typenow; //variable set to the current post type . and this variable is available in only admin area because we use admin_enqueue_scripts action hooks okkay
	
	if($typenow != "recipe"){
		return;
	} 
	wp_register_style(
		'ju_bootstrap',
		plugins_url(
			'/assets/bootstrap-select/bootstrap.min.css',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		)
	);
	wp_enqueue_style('ju_bootstrap');

	wp_register_style(
		'ju_bootstrap_select',
		plugins_url(
			'/assets/bootstrap-select/bootstrap-select.css',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		)
	);
	wp_enqueue_style('ju_bootstrap_select');

	// wp_enqueue_script('jquery');

	wp_register_script( 'ju_jquery',
		plugins_url(
			'/assets/bootstrap-select/jquery.min.js',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		), array(), false, true );

	wp_enqueue_script('ju_jquery' );


	wp_register_script( 'ju_bootstrap_min_js',
		plugins_url(
			'/assets/bootstrap-select/bootstrap.min.js',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		), array(), false, true );

	wp_enqueue_script('ju_bootstrap_min_js' );
	
	/**
	 *
	 * Bootstrap Select js
	 *
	 */
	
	wp_register_script( 'ju_bootstrap_select_js',
		plugins_url(
			'/assets/bootstrap-select/bootstrap-select.js',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		), array(), false, true );

	wp_enqueue_script('ju_bootstrap_select_js' );


	wp_register_script( 'ju_main_js',
		plugins_url(
			'/assets/main.js',
			RECIPE_PLUGIN_URL // i have created the constant variable for this.
		), array(), false, true );

	wp_enqueue_script('ju_main_js' );
}