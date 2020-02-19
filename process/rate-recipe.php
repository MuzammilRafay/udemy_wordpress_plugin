<?php 
function r_rate_recipe(){
	
	global $wpdb;
	// https://developer.wordpress.org/reference/classes/wpdb/
	// https://codex.wordpress.org/Class_Reference/wpdb
	$output = array('status' => 1);
	$post_id = absint($_POST['rid']);
	$rating = round($_POST['rating'],1);
	$user_IP = $_SERVER['REMOTE_ADDR'];
	// print_r($_POST);
	// wp_die();

	//get var value return a single value
	$rating_count = $wpdb->get_var(
		"SELECT COUNT(*) FROM `".$wpdb->prefix."recipe_ratings`
		WHERE recipe_id='".$post_id. "'AND user_ip='".$user_IP."'"
	);

	if($rating_count > 0){
		wp_send_json($output);
	}
	// insert in to database
	$wpdb->insert(
		$wpdb->prefix.'recipe_ratings',
		array(
			'recipe_id' => $post_id,
			'rating' => $rating,
			'user_ip' => $user_IP
		),
			//three parameter we use string  %s / integer %d/ float is %f
		array('%d','%f','%s')
	);
	// update meta data
	$recipe_data = get_post_meta($post_id,'recipe_data',true);
	$recipe_data['rating_count']++;
	$recipe_data['rating'] = round($wpdb->get_var(
		"SELECT AVG(`rating`) FROM `".$wpdb->prefix."recipe_ratings`
		WHERE recipe_id='".$post_id. "'"
	),1);
	
	update_post_meta($post_id,'recipe_data',$recipe_data);


	$output['status'] = 2;
	wp_send_json($output);
}