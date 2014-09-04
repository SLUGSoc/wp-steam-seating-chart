<?php

global $steamUser;

include('wp-content/plugins/seating-chart/seatingconfig.php');

// load data
$data = file_get_contents($datafile);
$people = array_filter(explode("\n", $data));
$atseats = array();
foreach ($people as &$newperson) {
        $pid = substr($newperson, 0, strpos($newperson, ' '));
        $newperson = substr($newperson, strpos($newperson, ' ')+1);
        $atseats[$pid] = $newperson;
}

echo '<p class="seating" align="center" style="margin-top: -20px; font-size: 150%">';
if ($steamUser == NULL && isset($_POST['seat'])) {
	echo '<b>To use the seating chart, please login with your Steam account by clicking on the right.</b>';
}
else {
	echo 'Click the green square where you want to sit!';
}
?></p>
<p class="seating" align="center" style="margin-bottom: 15px">To move seats click again.</p>

<?php

$seaticons = array();
$seattext = array();
$bigicons = array();
$offline = array();
foreach ($people as $person) {
if (strcmp($person, "")) {

	$page = @file_get_contents("$person?xml=1");
	$steam = new SimpleXMLElement($page, LIBXML_NOCDATA);

	if ($steam) {
		$seaticons[$person] = $steam->avatarMedium;

		if ($steam->privacyState == "public" && $steam->onlineState == "in-game") {
			$game = (string)$steam->inGameInfo->gameName;
			$seaticons[$person] = $steam->inGameInfo->gameIcon;
			$seattext[$person] = $steam->steamID." (playing $game)";
			$bigicons[$person] = $steam->avatarFull;
		}
		else if ($steam->onlineState == "offline") {
			$seattext[$person] = $steam->steamID." (offline)";
			$bigicons[$person] = $steam->avatarFull;
			$offline[$person] = 1;
		}
		else {
			$seattext[$person] = $steam->steamID." (not in game)";
			$bigicons[$person] = $steam->avatarFull;
		}
	}

}
}


// generate the seating chart!
$sid=0;
echo "<table align=\"center\" class=\"seatroot\"><tr>";
for ($z = 0; $z < $columns; $z++) {
	if ($z != 0) {
		echo "<td width=$size></td>";
	}
	echo "\n<td><table class=\"main\" >";

	for ($c = 0; $c < ($seats/$columns/2); $c++) {
		echo "\n<tr>";

		for ($d = 0; $d < 2; $d++) {

			if ($d == 2) {
				echo "<td class=\"seating\" width=$size></td>";
			}
			else {
				$sid++;
				if (isset($atseats[$sid])) {
					$person = $atseats[$sid];
					echo "<td class=\"seating\" style=\"background-color: black\">";
					if (isset($bigicons[$person]))
						echo '<div class="hov"><div class="seat-hover"><div class="head-box"><div class="avatar"><img class="hov" src="'.$bigicons[$person].'"><br></div><br><div class="main-info">'.$seattext[$person].'</div></div></div>';
//						echo '<div class="hov"><div class="seat-hover"><img class="hov" src="'.$bigicons[$person].'"></div>';
					echo '<img class="hovimg"';
					if (isset($offline[$person]) && $offline[$person] == 1)
						echo 'style="opacity: 0.6" ';
					echo ' src="'.$seaticons[$person].'" title="'.$seattext[$person].'" alt="'.$seattext[$atseats[$sid]].'">';
					if (isset($bigicons[$person]))
						echo '</div>';
				}
				else {
					echo "<td class=\"seating\" onclick=\"document.f.seat.value=$sid; document.f.submit()\">";
				}
				echo "</td>";
			}
		}
		echo "</tr>";
	}
	echo "</table></td>";
}
echo "</tr></table>";

?>

<p class="seating" align="center"><br><a onclick="document.f.seat.value='delete'; document.f.submit()" href="#">Click here to leave seat.</a></p>
<p class="seating" align="center">&copy; 2014 Guru3, Jimmez, and what the hey, SLUGSoc too.</p>

<form method="post" name="f">
<input type="hidden" name="seat" value="none">
</form>