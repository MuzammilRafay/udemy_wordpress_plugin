<?php 

function r_create_metaboxes(){
	add_meta_box(
	 	'r_recipe_options_mb',
	 	__('Recipe Options','recipe'),
	 	'r_recipe_options_mb', //callback function
	 	'recipe', //custom post type define
	 	'normal',
	 	'high'
	 );
}