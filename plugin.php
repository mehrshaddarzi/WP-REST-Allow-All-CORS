<?php
/**
 * Plugin Name: WP-REST-Allow-All-CORS
 * Plugin URI: http://AhmadAwais.com/
 * Description: Allow all cross origin requests to your WordPress site's REST API.
 * Author: mrahmadawais, WPTie
 * Author URI: http://AhmadAwais.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package WPRAC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//<meta http-equiv="Content-Security-Policy" content="default-src * 'unsafe-inline'; style-src 'self' 'unsafe-inline'; media-src *" />
//<meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; img-src * 'self' data: http://application.mznapp.ir/; connect-src 'self' http://application.mznapp.ir/">


// Hook.
add_action( 'rest_api_init', 'wp_rest_allow_all_cors', 15 );

/**
 * Allow all CORS.
 *
 * @since 1.0.0
 */
function wp_rest_allow_all_cors() {
	// Remove the default filter.
	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );

	// Add a Custom filter.
	add_filter( 'rest_pre_serve_request', function( $value ) {
		header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
		header( 'Access-Control-Allow-Credentials: true' );
		return $value;
	});
} // End fucntion wp_rest_allow_all_cors().


/*
function my_customize_rest_cors() {
	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
	add_filter( 'rest_pre_serve_request', function( $value ) {
		header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Allow-Methods: GET' );
		header( 'Access-Control-Allow-Credentials: true' );
		header( 'Access-Control-Expose-Headers: Link', false );
		return $value;
	} );
}
add_action( 'rest_api_init', 'my_customize_rest_cors', 15 );
*/
