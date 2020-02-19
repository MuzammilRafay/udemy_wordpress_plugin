<?php 

function r_generate_daily_recipe(){
	// transients api you can think like cookie or sessions
	global $wpdb;
	$recipe_id              =   $wpdb->get_var(
		"SELECT `ID` FROM `" . $wpdb->posts . "`
            WHERE post_status='publish' AND post_type='recipe'
            ORDER BY rand() LIMIT 1"
	);

	set_transient(
		'r_daily_recipe',
		$recipe_id,
		DAY_IN_SECONDS
	);
	//read transient docs it will provide this variable in second integer value number this constant provide by wordpress.

}