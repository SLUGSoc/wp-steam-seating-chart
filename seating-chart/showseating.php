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
	echo 'Click the green square where you are sitting!';
}
?></p>
<p class="seating" align="center" style="margin-bottom: 15px">To move seats click again. You must be logged in and have linked you steam account.</p>
<p class="seating" align="center"><i>Front of the room...</i></p>

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
//$collen = $seats/array_sum($columns);
//for ($z = 0; $z < $columns; $z++) {
foreach ($columns as $z => $z2) {
	if ($z != 0) {
		echo "<td width=$size></td>";
	}
	echo "\n<td><table class=\"main\" >";
#	for ($c = 0; $c < $collen; $c++) {
	for ($c = 0; $c < $collengths[$z]; $c++) {
		echo "\n<tr>";

		for ($d = 0; $d < $z2; $d++) {

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
					echo '<a href="'.$person.'"><img class="hovimg"';
					if (isset($offline[$person]) && $offline[$person] == 1)
						echo 'style="opacity: 0.6" ';
					echo ' src="'.$seaticons[$person].'" title="'.$seattext[$person].'" alt="'.$seattext[$atseats[$sid]].'"></a>';
					if (isset($bigicons[$person]))
						echo '</div>';
				}
				else {
					echo "<td class=\"seating\" onclick=\"document.f.seat.value=$sid; document.f.submit()\">";
					echo "Seat #$seatlookup[$sid]";
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
<p class="seating" align="center"><i>...back of the room.</i></p>

<p class="seating" align="center"><br><a onclick="document.f.seat.value='delete'; document.f.submit()" href="#">Click here to leave seat.</a></p>
<p class="seating" align="center">&copy; 2014 Guru3, Jimmez, and what the hey, SLUGSoc too.</p>

<form method="post" name="f">
<input type="hidden" name="seat" value="none">
</form>
