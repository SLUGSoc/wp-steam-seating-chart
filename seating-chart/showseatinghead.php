<?php

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
