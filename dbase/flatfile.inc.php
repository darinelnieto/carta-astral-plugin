<?php
if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
  function stripslashes_deep($value) {
    $value = is_array($value) ? array_map('stripslashes_deep', $value) : (isset($value) ? stripslashes($value) : null);
    return $value;
  }

  $_POST = stripslashes_deep($_POST);
  $_GET = stripslashes_deep($_GET);
}
$structure_tmp = file($structure_file);
$structure = array();
foreach($structure_tmp as $key=>$tmp) {
  $line = explode(',',$tmp);
  $name_will_be = str_replace(' ','',trim($line[0]));
  foreach($structure as $key1=>$value1) {
    if ($value1['name'] == $name_will_be)
      die("Few columns have the similar name (not counting spaces): '{$line[0]}'. Please rename.");
    }
  $structure[$key]['name_original'] = trim($line[0]);
  $structure[$key]['name'] = str_replace(' ','',$structure[$key]['name_original']);
  $structure[$key]['type'] = trim($line[1]);
  if (isset($line[2])) $structure[$key]['format'] = trim($line[2]);
  if (isset($line[3])) {
    $values = explode(':',$line[3]);
    foreach($values as $item) {
      $structure[$key]['values'][] = trim($item);
    }
  }
}
if (isset($_POST['submit'])) {
  if ($skip_lines > 0) {
    $tmp_data = file($data_file);
  }
  $structure_file = $_POST['structure_file'];
  $data_file = $_POST['filename'];
  $f = fopen($data_file,'w+');
  if ($f) {
    if ($skip_lines > 0) {
      for($i=0; $i < $skip_lines; $i++) {
        fputs($f,$tmp_data[$i]);
      }
    }
	  
	$all_data = array();  
	  
    for( $i=0; $i < count($_POST[$structure[0]['name']]); $i++ ) {
      if (isset($_POST['d_e_l_e_t_e'][$i])) continue;
      $s = '';
      $isfirst = true;
		
      foreach($structure as $key => $field) {
        $n1 = isset($_POST[$structure[$key]['name']]) ? $_POST[$structure[$key]['name']] : '';
        $v1 = isset($n1[$i]) ? $n1[$i] : $structure[$key]['values'][1];
        $v1 = str_replace(array("\r\n","\n","\r"),' ',$v1);
        $v1 = str_replace('|',' ',$v1);
		  
		


		/*$line_tmp = $data_tmp[0] . "|" . $data_tmp[1] . "|";
		if ( in_array($line_tmp, $all_data) && strpos($data_file,"signs-") > -1) { 
		   echo "There are repeated elements in this list.<br>";
		   goto CONT;
		} else {
			array_push($all_data,$line_tmp);
		}*/
		/* End check repetions */
		  
        $s = $s . ($isfirst ? '' : $delimiter) . $v1;
        $isfirst = false;
      }
      if (trim(str_replace($delimiter,'',$s)) == '') continue;
		
	  
	  /* check repetions */
	  $data_tmp = array();
      $data_tmp = explode('|',$s);
	  $line_tmp = $data_tmp[0] . "|" . $data_tmp[1] . "|";
	  if ( in_array($line_tmp, $all_data) && strpos($data_file,"signs_") > -1) { 
		   echo "<div style='font-family: Verdana;font-size: 10pt;'><b>There are repeated elements in this list:</b><br>&bullet; Last combination <i>".$data_tmp[0] . " with " . $data_tmp[1]."</i> was deleted.</div><br>";
		   goto CONT;
		} else {
			array_push($all_data,$line_tmp);
	  }
	  /* End check repetions */
      fputs($f,$s."\n");
    }
	CONT:
    fclose($f);
  } 
}
$fname = $data_file;
$split1 = explode("/",$fname);
$split2 = explode("-",$split1[1]);
$fname = ucfirst($split2[0]);
$data = file($data_file);
if ($skip_lines > 0) $data = array_slice($data, $skip_lines);
$data[] = str_repeat($delimiter,count($structure)-1);
echo '<html>';
echo "<head><title>$data_file</title>
<style>
th, td {
    padding: 7px;
	font-family: Verdana;
	font-size: 10pt;
	} 
h1 {
    font-family: Verdana;
	color: #008CBA;
	} 
textarea {
    resize: none;
	border-radius: 12px;
	padding: 12px 12px;
	overflow: hidden;
	height: 400 px;
	width: 670px;
	font-size: 15px;
	} 
table {
    table-layout: auto;
    border-collapse: collapse;
    width: 100%;
}
table .absorbing-column {
    width: 100%;
}
#myBtn {
  display: block;
  position: fixed;
  top: 20px;
  right: 30px;
  z-index: 99;
  font-size: 15px;
  border: none;
  outline: none;
  background-color: #0099ff;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
</style></head>";

echo "
<script>
function textAreaAdjust(o) {
  o.style.height = '1px';
  o.style.height = (25+o.scrollHeight)+'px';
}
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > -1 || document.documentElement.scrollTop > -1) {
        document.getElementById('myBtn').style.display = 'block';
    } else {
        document.getElementById('myBtn').style.display = 'none';
    }
}

function mark_all(){
    var elements = document.getElementById('myForm').elements;
    for (var i = 0, element; element = elements[i++];) {
    if (element.type === 'textarea')
        element.value = '';
    }
}

</script>";

echo "<body><h1>$fname interpretations</h1>";
echo '<form method="post" name="myForm" id="myForm">';
echo '<input type="hidden" name="filename" id="filename" value="'.$data_file.'">';
echo '<input type="hidden" name="structure_file" id="structure_file" value="'.$structure_file.'">';
echo '<table >'."\n";
echo '<tr style="background: #AAAAAA; border: 1px solid blue">';

$n = 0;
foreach ($structure as $key=>$line) {
  $n += 1;
  echo "<th style=\"font-family: Verdana; font-size: 10pt;\">{$line['name_original']}</th>";
}
//echo '<th>Mark<br><a href="javascript: mark_all();"><font size=2>[Clear ALL texts]</font></a></th>';
echo '<th>Mark</th>';
echo '</tr>'."\n";
foreach($data as $datakey => $line) {
  
  if (trim($line) == '') continue;
  echo '<tr style="background: #'.($datakey % 2 == 0 ? 'F0F0F0' : 'FAFAFA').'">';
  $items = explode($delimiter,$line);
  
  while (count($items) < count($structure))
    $items[] = '';
  foreach ($items as $key => $item) {
    $item = htmlspecialchars(trim($item));
    $name = $structure[$key]['name'];
    echo "\n".'  <td valign="top">';
    switch ($structure[$key]['type']) {
      case 'STRING':
        echo '<input onchange="cdf('.$datakey.')" name="'.$name.'['.$datakey.']" value="'.$item.'" size="'.$structure[$key]['format'].'" />';
        break;
      case 'TEXT':
        $rc = explode(':',$structure[$key]['format']);
        $cols = trim($rc[0]);
        $rows = trim($rc[1]);
        echo '<textarea onkeyup="textAreaAdjust(this)" onfocus="textAreaAdjust(this)" style="overflow:hidden" onchange="cdf('.$datakey.')" name="'.$name.'['.$datakey.']" id="'.$name.'['.$datakey.']" rows="'.$rows.'" cols="'.$cols.'" size=3>'.$item.'</textarea>';
        break;
      case 'LOGICAL':
        $val_yes = trim($structure[$key]['values'][0]);
        echo '<input onchange="cdf('.$datakey.')" name="'.$name.'['.$datakey.']" type="checkbox" '.(($item == $val_yes) ? 'checked' : '').' value="'.$val_yes.'" />';
        break;
      case 'LIST':
        echo '<select onchange="cdf('.$datakey.')" name="'.$name.'['.$datakey.']" id="'.$name.'['.$datakey.']" size="'.$structure[$key]['format'].'">';
        foreach($structure[$key]['values'] as $value) {
          echo '<option value="'.$value.'" '.($value == $item ? 'selected' : '').'>'.$value.'</option>';
        }
        echo '</select>';
        break;
    }
    echo '</td>';
  }
  
  
  echo "\n  <td><input id='d_e_l_e_t_e[{$datakey}]'  name='d_e_l_e_t_e[{$datakey}]' type='checkbox' ".($datakey == count($data)-1 ? 'checked' : '')." /></td>";
  echo "\n</tr>\n";
}
echo '<tr><td colspan=255 align=center><input type="submit" name="submit" id="myBtn" style="font-family: Verdana;font-size: 10pt;" value="Save Changes and Delete marked" style="padding: 10px 24px; font-size: 12px; background-color: #008CBA; border: none; text-align: center; color: white;"></td></tr>';
echo '</table>';
echo "<script>var filename = '".$data_file."';</script>";
echo "</form>
<script>
function cdf(theid) {
document.getElementById('d_e_l_e_t_e['+theid+']').checked = false;
var id = theid;
if(filename.match(/signs-/gi)){
var e = document.getElementById('Body['+id+']');
var b1 = e.options[e.selectedIndex].value;
e = document.getElementById('Sign['+id+']');
var s1 = e.options[e.selectedIndex].value;
if(id > 0){
for(i=0;i<id;i++){
e1 = document.getElementById('Body['+i+']');
var b2 = e1.options[e1.selectedIndex].value;
e2 = document.getElementById('Sign['+i+']');
var s2 = e2.options[e2.selectedIndex].value;
if(s1 == s2 && b1 == b2){
alert('Carefull: repeated combination!!!');
document.getElementById('Body['+id+']').value = 'Sun';
document.getElementById('Sign['+id+']').value = 'ARIES';
document.getElementById('Comments['+id+']').value = null;
document.getElementById('d_e_l_e_t_e['+theid+']').checked = true;
}
}
}
}
if(filename.match(/aspects-/gi)){
var e = document.getElementById('Combination['+id+']');
var b1 = e.options[e.selectedIndex].value;
e = document.getElementById('Aspect['+id+']');
var b2 = e.options[e.selectedIndex].value;
if(id > 0){
for(i=0;i<id;i++){
e = document.getElementById('Combination['+i+']');
var b12 = e.options[e.selectedIndex].value;
e = document.getElementById('Aspect['+i+']');
var b32 = e.options[e.selectedIndex].value;
if(b1 == b12 && b2 == b32){
alert('Carefull: repeated combination!!!');
document.getElementById('Combination['+id+']').selectedIndex = 0;
document.getElementById('Aspect['+id+']').value = 'Harmony';
document.getElementById('Comments['+id+']').value = null;
document.getElementById('d_e_l_e_t_e['+theid+']').checked = true;
}
}
}
}
if(filename.match(/houses-/gi)){
var e = document.getElementById('Body['+id+']');
var b1 = e.options[e.selectedIndex].value;
e = document.getElementById('House['+id+']');
var s1 = e.options[e.selectedIndex].value;
if(id > 0){
for(i=0;i<id;i++){
e1 = document.getElementById('Body['+i+']');
var b2 = e1.options[e1.selectedIndex].value;
e2 = document.getElementById('House['+i+']');
var s2 = e2.options[e2.selectedIndex].value;
if(s1 == s2 && b1 == b2){
alert('Carefull: repeated combination!!!');
document.getElementById('Body['+id+']').value = 'Sun';
document.getElementById('House['+id+']').value = 'House I';
document.getElementById('Comments['+id+']').value = null;
document.getElementById('d_e_l_e_t_e['+theid+']').checked = true;
}
}
}
}
}
</script>";
echo '</body>';
echo '</html>';
?>
