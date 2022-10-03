<?php
/*
Plugin Name: Simple REST API plugin
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

	$response = array(
		'firstname' => 'John',
		'lastname' => 'Doe',
		'email' => 'john@gmail.com'
	);

	return rest_ensure_response( $response );
}

// call http://localhost/wordpress/wp-json/mysimplerestapi/v1/getsomedata
// ako nije podignut endpoint javlja se greška
//{"code":"rest_no_route","message":"No route was found matching the URL and request method.","data":{"status":404}}
// koristan link: https://awhitepixel.com/blog/in-depth-guide-in-creating-and-fetching-custom-wp-rest-api-endpoints/