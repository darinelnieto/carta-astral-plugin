<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'POST':
  if(isset($_POST["file"])){
    $file = $_POST["file"];
    } else {
  	$file = "";
    }
    break;
  case 'GET':
    if(isset($_GET["file"])){
    $file = $_GET["file"];
    } else {
  	$file = "";
    }
    break; 
  default:
    echo "";
    exit; 
    break;
}

if(isset($_GET["file"])){
    $file = $_GET['file'];
	$data_file = 'users/transits-'.$file.'.txt';
	$structure_file = 'transits-'.$file.'.def';
} 
// Database file, i.e. file with real data
/* $data_file = 'users/transits-'.$file.'.txt'; */
//echo "File test: ".$data_file."<br>";
// Database definition file. You have to describe database format in this file.
// See flatfile.inc.php header for sample.
/* $structure_file = 'transits-'.$file.'.def'; */
// Fields delimiter
$delimiter = '|';
// Number of header lines to skip. This is needed if you have some heder saved in the 
// database file, like comment or description
$skip_lines = 0;
// run flatfile manager
include ('transit.flatfile.inc.php');
?>
