<?php 

function r_activate_plugin(){
	// 4.7 < 4.5 = false
	if (version_compare(get_bloginfo('version'),'4.5','<')) {
		wp_die(__('you must update wordpress to use this plugin','recipe'));
	}
	/*======================================================
	=            CREATE DATABASE WITH HEIDI SQL            =
	======================================================*/
	
	global $wpdb; 
	//this object created by wordpress for you
	$createSQL              =   "
	CREATE TABLE `" . $wpdb->prefix . "recipe_ratings` (
		`ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`recipe_id` BIGINT(20) UNSIGNED NOT NULL,
		`rating` FLOAT(3,2) UNSIGNED NOT NULL,
		`user_ip` VARCHAR(32) NOT NULL,
		PRIMARY KEY (`ID`)
	) ENGINE=InnoDB " . $wpdb->get_charset_collate() . " AUTO_INCREMENT=1;";


	require_once(ABSPATH.'/wp-admin/includes/upgrade.php');
	dbDelta($createSQL);

	/*=====  End of CREATE DATABASE WITH HEIDI SQL  ======*/

	/*================================
	=            Cron job            =
	================================*/
	wp_schedule_event( 
		time(),
		'daily',
		'r_daily_recipe_hook'
	);
	 //it will create custom action hook now you should add add_action('r_daily_recipe_hook','callbackFunctionName');
	
	/*=====  End of Cron job  ======*/
	
	
	// https://developer.wordpress.org/reference/functions/dbdelta/
}