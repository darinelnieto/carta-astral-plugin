<?php
Function CheckFile($filename){
	if(!file_exists($filename)){
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fclose($myfile);
    return false;
  } else {
  	return true;
  }
}
if (!isset($_POST['submit'])) {
	
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
$script_name = isset($_SERVER['SCRIPT_NAME']) ? preg_quote($_SERVER['SCRIPT_NAME'], '!') : '';
$doc_root = preg_replace("!{$script_name}$!", '', $_SERVER['SCRIPT_FILENAME']);
$data_file = "users/".$file.".txt";
$structure_file = $file.'.def';
$exists = CheckFile($data_file);
if(!file_exists($data_file)){
  $myfile = fopen($data_file, "w") or die("Unable to open file!");
  fclose($myfile);
}
} else {
$data_file = $_POST['filename'];
$structure_file = $_POST['structure_file'];
}
$delimiter = '|';
$skip_lines = 0;
include ('flatfile.inc.php');
?>
