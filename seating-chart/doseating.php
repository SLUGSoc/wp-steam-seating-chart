<?php

include('wp-content/plugins/seating-chart/seatingconfig.php');
include("wp-content/plugins/seating-chart/socialtest.php");

global $steamUser;

$steamUser = steamProfileUrl(get_current_user_id());

// load data
$data = file_get_contents($datafile);
$people = array_filter(explode("\n", $data));
$atseats = array();
foreach ($people as &$newperson) {
	$pid = substr($newperson, 0, strpos($newperson, ' '));
	$newperson = substr($newperson, strpos($newperson, ' ')+1);
	$atseats[$pid] = $newperson;
}

if (strpos($steamUser, "http") === 0) {// valid url
	$id = $steamUser;
	$seat = trim($_POST['seat']);
	if (is_numeric($seat) && strcmp($id, "")) {
		if (array_search($id, $people) !== FALSE) {
			// relocate
			unset($atseats[array_search($id, $atseats)]);
			$atseats[$seat] = $id;
		}
		else {
			// sit down
			$people[] = $id;
			$atseats[$seat] = $id;
		}
		writeData($people, $atseats, $datafile);
	}
	else if (!strcmp($seat, "delete") && strcmp($id, "")) {
		unset($people[array_search($id, $people)]);
		unset($atseats[array_search($id, $atseats)]);
		writeData($people, $atseats, $datafile);
	}
}
else {
	// poor shmuck, not in the database!
}


function writeData($people, $atseats, $datafile) {
	$data = "";
	foreach ($people as $person) {
		$line = array_search($person, $atseats)." ".$person;
		$data = $data.$line."\n";
	}
print_r($data);
	file_put_contents($datafile, $data);
	global $seatRedirect;
	$seatRedirect = 1;
}

?>
