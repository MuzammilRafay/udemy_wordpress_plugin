<?php 

function r_save_post_admin($post_id,$post,$update){
	if(!$update) {
		//so i know that is new post
		return;
	}
	
	// how to check the array
	/*
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	die();
	*/

	// https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data
	//see wp-includes/formatting file see all function of sanitize_text_field	$recipe_data = array();
	$recipe_data = array();
	$recipe_data['ingredients'] = sanitize_text_field( $_POST['r_inputIngredients'] );
	$recipe_data['time'] = sanitize_text_field( $_POST['r_inputTime'] );
	$recipe_data['utensils'] = sanitize_text_field( $_POST['r_inputUtensils'] );
	$recipe_data['level'] = sanitize_text_field( $_POST['r_inputLevel'] );
	$recipe_data['meal_type'] = sanitize_text_field( $_POST['r_inputMealType'] );
	$recipe_data['rating'] = 0;
	$recipe_data['rating_count'] = 0;
	//update method check if   data already exist if it doesnt it will creaate that
	update_post_meta($post_id,'recipe_data',$recipe_data);
}