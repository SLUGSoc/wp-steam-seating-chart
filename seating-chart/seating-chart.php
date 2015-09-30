<?php
/*
Plugin Name: Seating Chart
Plugin URI: https://github.com/SLUGSoc/wp-steam-seating-chart
Description: Use Steam Logins to track what people are playing and who is sitting where at a LAN
Version: 1.0
Author: Guru3/Jimmez
Author URI: http://three.guru
License: GNU GPL v2
*/


/*

*************************************************************************

LAN Seating Chart for WordPress (using Steam)
Copyright (C) 2014 Guru3/Jimmez

**************************************************************************

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
  
***************************************************************************

*/

// hook for earliest (use this to catch post)
function doseats() {
	if (isset($_POST['seat'])) {
		define( "DONOTCACHEPAGE", true );
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
