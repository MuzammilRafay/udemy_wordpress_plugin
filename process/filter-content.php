<?php 

function r_filter_recipe_content($content){
	// check is its single post
	if(!is_singular('recipe')){
		return $content;
	}
	global $post,$wpdb; //wordpress provide automattically $post variable

	$recipe_html = file_get_contents('recipe-template.php',true); 
	//working like include function now
	$recipe_data = get_post_meta($post->ID,'recipe_data',true);
	// print_r($recipe_data);
	// wp_die();
	$recipe_html = str_replace('INGREDIENTS_PH', $recipe_data['ingredients'],$recipe_html);
	$recipe_html = str_replace('COOKING_TIME_PH', $recipe_data['time'],$recipe_html);
	$recipe_html = str_replace('UTENSILS_PH', $recipe_data['utensils'],$recipe_html);
	$recipe_html = str_replace('LEVEL_PH', $recipe_data['level'],$recipe_html);
	$recipe_html = str_replace('TYPE_PH', $recipe_data['meal_type'],$recipe_html);


	$recipe_html                =   str_replace( "INGREDIENTS_I18N", __("Ingredients", "recipe"), $recipe_html );
	$recipe_html                =   str_replace( "COOKING_TIME_I18N", __("Cooking Time", "recipe"), $recipe_html );
	$recipe_html                =   str_replace( "UTENSILS_I18N", __("Utensils", "recipe"), $recipe_html );
	$recipe_html                =   str_replace( "LEVEL_I18N", __("Level", "recipe"), $recipe_html );
	$recipe_html                =   str_replace( "TYPE_I18N", __("Meal Type", "recipe"), $recipe_html );
	$recipe_html                =   str_replace( "RATE_I18N", __("Rating", "recipe"), $recipe_html );
	$recipe_html                =   str_replace( "RECIPE_ID", $post->ID, $recipe_html );
	$recipe_html                =   str_replace( "RECIPE_RATING", $recipe_data['rating'], $recipe_html );

	$user_IP                    =   $_SERVER['REMOTE_ADDR'];
	$rating_count = $wpdb->get_var(
		"SELECT COUNT(*) FROM `".$wpdb->prefix."recipe_ratings`
		WHERE recipe_id='".$post->ID. "'AND user_ip='".$user_IP."'"
	);

	if( $rating_count > 0 ){
		$recipe_html            =   str_replace(
			"READONLY_PLACEHOLDER", 'data-rateit-readonly="true"', $recipe_html
		);
	}else{
		$recipe_html            =   str_replace( "READONLY_PLACEHOLDER", '', $recipe_html );
	}

	return $recipe_html . $content;
}