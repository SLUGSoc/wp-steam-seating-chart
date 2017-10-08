<?php

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

include('wp-content/plugins/seating-chart/seatingconfig.php');

//body { 
//	font-family: Helvetica,Arial,sans-serif;
//}

//p.seating {
//	margin: 5px 0px;
//	padding: auto;
//}


echo '<STYLE type="text/css">
table.seatroot {
	margin: auto;
	table-layout: fixed;
}


table.main {
	border: 1px solid black;
	border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 2px;
	border-collapse: separate;
	border-spacing: 4px;
	table-layout: fixed;
}

td.seating {
	padding: 1px;
	border-radius: 5px;
	margin: 0;
	width: '.$size.'px;
	height: '.$size.'px;
	background-color: #40af20;
	font-size: x-small;
	text-align: center;
	color: #80ff60;
}


div.hov {
	width: '.$size.'px;
	height: '.$size.'px;
}

div.hov div.seat-hover {
	display: none;
	position: absolute;
	margin-left: 50px;
	margin-top: 10px;
	z-index:1000;
}

div.hov:hover div.seat-hover {
	display: block;
	cursor: pointer;
	box-shadow: 0px 0px 5px #555;
}

</style>
<link rel="stylesheet" type="text/css" href="/wp-content/plugins/seating-chart/map.css">
<meta http-equiv="refresh" content="300">';

?>
