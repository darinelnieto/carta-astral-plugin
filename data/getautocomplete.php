
<?php
$term = isset($_GET["term"]) ? (string) $_GET["term"] : "";
$country = isset($_GET["country_id"]) ? (string) $_GET["country_id"] : "";
$atlas = isset($_GET["atlas"]) ? (string) $_GET["atlas"] : "";
$string = $term;
$string = abvstring($string);
$i = strlen ($string );
if($i > 4){$i = 4;}
$temp = substr($string,0,$i);
$filename = __DIR__ . '/cities_results_1000.txt';
$json=array();
if (file_exists($filename)) {
$id = 0;
$file_handle = fopen($filename, "rb");
while (!feof($file_handle) ) {
$line_of_text = fgets($file_handle);
$line_of_text = chop($line_of_text);
$parts = explode(';', $line_of_text);
if(stripos($parts[0],$string) === 0 and stripos($parts[5],$country) === 0){
$id = $id + 1;
$name = $parts[1] . " , Dist. " . $parts[7] . " , " . $parts[6];
$json[]=array(
                    'value' => $parts[1],
                    'label' => $name,
                    'latitude'=> $parts[3],
                    'longitude'=> $parts[4],
					'timezone'=> $parts[8]
                        );
                        
}
}
}
$callback = isset($_GET['jsonp']) ? preg_replace('/[^a-zA-Z0-9_$.]/', '', $_GET['jsonp']) : 'callback';
print $callback.'('.json_encode($json,JSON_UNESCAPED_UNICODE).')';
exit;
function querySort ($x, $y) {
    return strcasecmp($x['city'], $y['city']);
}
function cmp($a, $b) {
        return $a["city"] - $b["city"];
}
function abvstring ($string)
{
$string = strtolower($string);
$regexp = '/&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);/i';
$string = html_entity_decode(preg_replace($regexp, '$1', htmlentities($string)));
$string = preg_replace('/[^A-Za-z0-9]*/', '', $string);
return $string;
}
?>
