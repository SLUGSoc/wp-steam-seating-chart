<?php
/*
Plugin Name: Seating Chart
Plugin URI: NA
Description: NA
Version: 1.0
Author: Guru3/Jimmez
Author URI: NA
License: NA
*/


// hook for earliest (use this to catch post)
function doseats() {
	if (isset($_POST['seat'])) {
		include('wp-content/plugins/seating-chart/doseating.php');
	}
}
add_action('parse_request', 'doseats');

// hook for headers (use this to put in refresh)
function doseatredirect() {
	global $seatRedirect;
	if (isset($seatRedirect) && $seatRedirect == 1) {
		header("Location: /seating-chart/");
		die();
	}
}
add_action( 'send_headers', 'doseatredirect' );


function dochart($in) {
	global $post;
	if ( $post->post_name == 'seating-chart' ) {
		$in = "";
		include('wp-content/plugins/seating-chart/showseating.php');
	}
	else {
		return $in;
	}
}
add_filter('the_content', 'dochart');

function charthead() {
	global $post;
        if ( $post->post_name == 'seating-chart' ) {
                include('wp-content/plugins/seating-chart/showseatinghead.php');
        }
}
add_filter('wp_head', 'charthead');


?>
