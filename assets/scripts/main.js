jQuery(function($){
	$("#recipe_rating").bind("rated",function(){
		$(this).rateit('readonly',true); // this will user not allowed to create ratting if ratting is made
		
		var form = {
			action:	"r_rate_recipe", 
			/*
			i have pass r_rate_recipe so we use in index.php action hook to check my request.
			add_action('wp_ajax_r_rate_recipe','r_rate_recipe'); 
			*/ 
			rid:	$(this).data('rid'), // get the id 
			rating:	$(this).rateit('value'), // get the value
		};


	/*
	in plugin/recipe/includes/fron/enqueue.php
		wp_register_script(
		'r_main',
		plugins_url('/assets/scripts/main.js',RECIPE_PLUGIN_URL),
		array('jquery'),
		'1.0.0',
		true //in footer
	);

	// this function used for providing translation link to javascript file
	wp_localize_script( 'r_main', 'recipe_obj', array(
		'ajax_url' => admin_url('admin-ajax.php'); //wp-admin/admin-ajax.php file aavailable in worpdress
	));
	we have pass reccipe_obj to this file
	*/
		$.post(recipe_obj.ajax_url,form,function(data){
			
		});
	})
});