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

//EDIT Datafile Location
$datafile = '/var/www/wp-content/plugins/seating-chart/seats.txt';
$size = 40; // seat size
$seats = 60; // number of seats
$columns = array(1, 2, 2); // how many sets of tables there are
$collengths = array(8, 13, 14);

// seat number lookup table
$seatlookup = array();
$sat = 1;
// column 1
for ($c = 1; $c <= $collengths[0]; $c++) {
	$seatlookup[$c] = $sat++;
}
// left of column 2
for ($c = $collengths[0]+1; $c <= $collengths[1]*2+$collengths[0]; $c+=2) {
	$seatlookup[$c] = $sat++;
}
// right of column 2
//for ($c = $collengths[0]+2; $c <= $collengths[1]*2+$collengths[0]; $c+=2) {
for ($c = $collengths[1]*2+$collengths[0]; $c > $collengths[0]; $c-=2) { // inverted of above
	$seatlookup[$c] = $sat++;
}
// left of column 3
for ($c = $collengths[0]+$collengths[1]*2+1; $c <= $collengths[2]*2+$collengths[1]*2+$collengths[0]; $c+=2) {
	$seatlookup[$c] = $sat++;
}
// right of column 3
for ($c = $collengths[2]*2+$collengths[1]*2+$collengths[0]; $c > $collengths[1]*2+$collengths[0]; $c-=2) {
	$seatlookup[$c] = $sat++;
}

// total number of seats
$seats = 0;
for ($c = 0; $c < count($columns); $c++) {
	$seats += $columns[$c] * $collengths[$c];
}

?>
