<?php

function ch150918__utc_offset_dst( $time_zone = 'Europe/Berlin' ) {
	// Set UTC as default time zone.
	date_default_timezone_set( 'UTC' );
	$utc = new DateTime();
	// Calculate offset.
	$current   = timezone_open( $time_zone );
	$offset_s  = timezone_offset_get( $current, $utc ); // seconds
	$offset_h  = $offset_s / ( 60 * 60 ); // hours
	// Prepend “+” when positive
	$offset_h  = (string) $offset_h;
	if ( strpos( $offset_h, '-' ) === FALSE ) {
		$offset_h = '+' . $offset_h; // prepend +
	}
	return 'UTC' . $offset_h;
}

//mktime(hour, minute, second, month, day, year)
//$d=mktime(11, 14, 54, 8, 12, 2014);
 
$month = isset($_POST["month"]) ? (int) $_POST["month"] : 1;
$day = isset($_POST["day"]) ? (int) $_POST["day"] : 1;
$year = isset($_POST["year"]) ? (int) $_POST["year"] : 2000;
$hour = isset($_POST["hour"]) ? (int) $_POST["hour"] : 0;
$minute = isset($_POST["minute"]) ? (int) $_POST["minute"] : 0;
$timezone = isset($_POST["timezone"]) ? (string) $_POST["timezone"] : 'UTC';

if($year < 1000){$year_val = 1000;} else {$year_val = $year;}

date_default_timezone_set('UTC');
$dateValue = $year_val . "-" . $month . "-" . $day . " " . $hour . ":" . $minute;
//$d = date("Y-m-d h:i", mktime(7, 57, 0, 7, 21, 1959));
$dt = new DateTime($dateValue, new DateTimeZone($timezone));
//$dt = new DateTime($d, new DateTimeZone($timezone));
$offset = $dt->getOffset() / 3600;


//$dateTime = new DateTime('1959-07-21 12:00:00', new DateTimeZone($timezone));
//$dateTime->setTimezone(new DateTimeZone('UTC'));
//echo $dateTime->getOffset();

echo " " . $dateValue . " " . $timezone . " " . $offset; 


?>