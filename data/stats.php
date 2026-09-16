<?php

if(isset($_REQUEST['hexa'])){

$hex = $_REQUEST['hexa'];
$email = isset($_REQUEST['email']) ? trim((string) $_REQUEST['email']) : '';
$name = isset($_REQUEST['name']) ? trim((string) $_REQUEST['name']) : '';
	
$filename = 'logs.txt';
if(!file_exists($filename)){
$myfile = fopen($filename, "w");
fclose($myfile);	
}

/* Record */
$is_rec = false;
//$rec = $hex . "|1";
$myfile = fopen($filename, "r");
while(! feof($myfile))  {
	$result = fgets($myfile);
	//$temp = explode("|",$result);
	$pos = strpos($result, $hex);
	if($pos){
		//$temp[1] += 1;
		//$rec = $hex . "|" . $temp[1];
		$is_rec = true;		
	}
  }
fclose($myfile); 
if(!$is_rec){
$myfile = fopen($filename, "a");
$txt = $hex . "\n";
fwrite($myfile, $txt.PHP_EOL);
fclose($myfile);
}

if ($email !== '') {
  $safe_email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $safe_name = preg_replace('/[\r\n|]+/', ' ', $name);

  if ($safe_email && filter_var($safe_email, FILTER_VALIDATE_EMAIL)) {
    $lead_file = 'emails.txt';
    if (!file_exists($lead_file)) {
      $myfile = fopen($lead_file, "w");
      fclose($myfile);
    }

    $lead_line = date('Y-m-d H:i:s') . ' | ' . $safe_name . ' | ' . $safe_email . PHP_EOL;
    file_put_contents($lead_file, $lead_line, FILE_APPEND | LOCK_EX);
  }
}

echo "Ok";
}





?>