<?php

$base_date = "Mon, 07 Sep 2015 20:24:01 -0700";

$date = substr($base_date, 0, -2);

$zone1 = substr($date, -1, 1);

$zone2 = 10 * substr($date, -2, 1);

$mult = substr($date, -3, 1);

$zone = $zone1 + $zone2;

if($mult == "-")
{
	$zone = $zone * -1;
}

$local_time = strtotime($base_date) + ($zone * 60 * 60);

echo date("F d, Y",$local_time);

?>

