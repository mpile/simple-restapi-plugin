<?php
/*
Plugin Name: Simple REST API plugin
Plugin URI: https://github.com/mpile/simple-resrapi-plugin
Description: Create custom REST API Endpoint
Version: 1.0
Author: Miloš Piletić
 */
if (!defined('ABSPATH'))   // nije dozvoljen direkni pristup pluginu
{
	exit();
}
add_action( 'rest_api_init','reg_endpoint' );

function reg_endpoint() {
	register_rest_route( 'mysimplerestapi/v1', '/getsomedata', 
	array(
		'method'   => WP_REST_Server::READABLE,
		'callback' => 'handler_somedata'
	) );
} 

function handler_somedata( $request ) {
	$sitetitle = get_bloginfo();
	$siteurl = get_site_url();
	$adminemail = get_bloginfo('admin_email')
	$response = array(
		'Site title' => $sitetitle,
		'Site URL' => $siteurl,
		'Admin email' => $adminemail
	);

	return rest_ensure_response( $response );
}

// To consume this endpoint send request to  http://<your_own_domen>/wp-json/mysimplerestapi/v1/getsomedata
