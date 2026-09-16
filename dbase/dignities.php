<?php
if(isset($_POST["submit"])){
	$custom_file = "users/custom.json";
	file_put_contents($custom_file,json_encode($_POST));
	$data1 = $_POST;
} else {
	$custom_file = "users/custom.json";
	$c = file_get_contents($custom_file);
	$data1 = json_decode($c, true);
}
?>
<html>
<head>
	
<style>
.tooltip {
    position: relative;
    display: inline-block;
}
.tooltip .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 7px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}
.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}
.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
#digtable, td, th {
    border: 1px solid #ddd;
    text-align: left;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size: 14px;
    }
#digtable {
    border-collapse: collapse;
    width: 100%;
    }
#digtable th, td {
    padding: 10px;
    }
</style>	
	
<script>
var js_array =<?php echo json_encode($data1);?>;
</script>
	
</head><body>
<h2>Custom Essential Dignities</h2><br>
<form method="post" onsubmit="checkAll()">
<table border=1 cellspacing="2" align=center>
<tr><td colspan="15" style="text-align: center;"><h3>Triplicity,Terms & Faces model:</h3>
<br><select name="model" id="model">
	<option value="1">Ptolemy model (Chaldean Term system) </option>
	<option value="2">Dorotheus model (Egyptian Term system) </option>
</select><br>	
</td>
</tr>	
<tr><td colspan="15" style="text-align: center;"><h3>Essential Dignities:</h3></td></tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Ari</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Ari</span><input type='checkbox' name="dig_0_0_0" id="dig_0_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Ari</span><input type='checkbox' name="dig_0_1_0" id="dig_0_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Ari</span><input type='checkbox' name="dig_0_2_0" id="dig_0_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Ari</span><input type='checkbox' name="dig_0_3_0" id="dig_0_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Ari</span><input type='checkbox' name="dig_0_0_1" id="dig_0_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Ari</span><input type='checkbox' name="dig_0_1_1" id="dig_0_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Ari</span><input type='checkbox' name="dig_0_2_1" id="dig_0_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Ari</span><input type='checkbox' name="dig_0_3_1" id="dig_0_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Ari</span><input type='checkbox' name="dig_0_0_2" id="dig_0_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Ari</span><input type='checkbox' name="dig_0_1_2" id="dig_0_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Ari</span><input type='checkbox' name="dig_0_2_2" id="dig_0_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Ari</span><input type='checkbox' name="dig_0_3_2" id="dig_0_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Ari</span><input type='checkbox' name="dig_0_0_3" id="dig_0_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Ari</span><input type='checkbox' name="dig_0_1_3" id="dig_0_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Ari</span><input type='checkbox' name="dig_0_2_3" id="dig_0_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Ari</span><input type='checkbox' name="dig_0_3_3" id="dig_0_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Ari</span><input type='checkbox' name="dig_0_0_4" id="dig_0_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Ari</span><input type='checkbox' name="dig_0_1_4" id="dig_0_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Ari</span><input type='checkbox' name="dig_0_2_4" id="dig_0_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Ari</span><input type='checkbox' name="dig_0_3_4" id="dig_0_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Ari</span><input type='checkbox' name="dig_0_0_5" id="dig_0_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Ari</span><input type='checkbox' name="dig_0_1_5" id="dig_0_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Ari</span><input type='checkbox' name="dig_0_2_5" id="dig_0_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Ari</span><input type='checkbox' name="dig_0_3_5" id="dig_0_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Ari</span><input type='checkbox' name="dig_0_0_6" id="dig_0_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Ari</span><input type='checkbox' name="dig_0_1_6" id="dig_0_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Ari</span><input type='checkbox' name="dig_0_2_6" id="dig_0_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Ari</span><input type='checkbox' name="dig_0_3_6" id="dig_0_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Ari</span><input type='checkbox' name="dig_0_0_7" id="dig_0_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Ari</span><input type='checkbox' name="dig_0_1_7" id="dig_0_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Ari</span><input type='checkbox' name="dig_0_2_7" id="dig_0_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Ari</span><input type='checkbox' name="dig_0_3_7" id="dig_0_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Ari</span><input type='checkbox' name="dig_0_0_8" id="dig_0_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Ari</span><input type='checkbox' name="dig_0_1_8" id="dig_0_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Ari</span><input type='checkbox' name="dig_0_2_8" id="dig_0_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Ari</span><input type='checkbox' name="dig_0_3_8" id="dig_0_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Ari</span><input type='checkbox' name="dig_0_0_9" id="dig_0_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Ari</span><input type='checkbox' name="dig_0_1_9" id="dig_0_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Ari</span><input type='checkbox' name="dig_0_2_9" id="dig_0_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Ari</span><input type='checkbox' name="dig_0_3_9" id="dig_0_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Ari</span><input type='checkbox' name="dig_0_0_10" id="dig_0_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Ari</span><input type='checkbox' name="dig_0_1_10" id="dig_0_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Ari</span><input type='checkbox' name="dig_0_2_10" id="dig_0_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Ari</span><input type='checkbox' name="dig_0_3_10" id="dig_0_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Ari</span><input type='checkbox' name="dig_0_0_11" id="dig_0_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Ari</span><input type='checkbox' name="dig_0_1_11" id="dig_0_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Ari</span><input type='checkbox' name="dig_0_2_11" id="dig_0_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Ari</span><input type='checkbox' name="dig_0_3_11" id="dig_0_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Ari</span><input type='checkbox' name="dig_0_0_12" id="dig_0_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Ari</span><input type='checkbox' name="dig_0_1_12" id="dig_0_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Ari</span><input type='checkbox' name="dig_0_2_12" id="dig_0_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Ari</span><input type='checkbox' name="dig_0_3_12" id="dig_0_3_12" value='0'></div><br>
</td>
</tr>
<tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<td>Tau</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Tau</span><input type='checkbox' name="dig_1_0_0" id="dig_1_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Tau</span><input type='checkbox' name="dig_1_1_0" id="dig_1_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Tau</span><input type='checkbox' name="dig_1_2_0" id="dig_1_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Tau</span><input type='checkbox' name="dig_1_3_0" id="dig_1_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Tau</span><input type='checkbox' name="dig_1_0_1" id="dig_1_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Tau</span><input type='checkbox' name="dig_1_1_1" id="dig_1_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Tau</span><input type='checkbox' name="dig_1_2_1" id="dig_1_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Tau</span><input type='checkbox' name="dig_1_3_1" id="dig_1_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Tau</span><input type='checkbox' name="dig_1_0_2" id="dig_1_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Tau</span><input type='checkbox' name="dig_1_1_2" id="dig_1_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Tau</span><input type='checkbox' name="dig_1_2_2" id="dig_1_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Tau</span><input type='checkbox' name="dig_1_3_2" id="dig_1_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Tau</span><input type='checkbox' name="dig_1_0_3" id="dig_1_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Tau</span><input type='checkbox' name="dig_1_1_3" id="dig_1_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Tau</span><input type='checkbox' name="dig_1_2_3" id="dig_1_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Tau</span><input type='checkbox' name="dig_1_3_3" id="dig_1_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Tau</span><input type='checkbox' name="dig_1_0_4" id="dig_1_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Tau</span><input type='checkbox' name="dig_1_1_4" id="dig_1_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Tau</span><input type='checkbox' name="dig_1_2_4" id="dig_1_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Tau</span><input type='checkbox' name="dig_1_3_4" id="dig_1_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Tau</span><input type='checkbox' name="dig_1_0_5" id="dig_1_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Tau</span><input type='checkbox' name="dig_1_1_5" id="dig_1_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Tau</span><input type='checkbox' name="dig_1_2_5" id="dig_1_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Tau</span><input type='checkbox' name="dig_1_3_5" id="dig_1_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Tau</span><input type='checkbox' name="dig_1_0_6" id="dig_1_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Tau</span><input type='checkbox' name="dig_1_1_6" id="dig_1_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Tau</span><input type='checkbox' name="dig_1_2_6" id="dig_1_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Tau</span><input type='checkbox' name="dig_1_3_6" id="dig_1_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Tau</span><input type='checkbox' name="dig_1_0_7" id="dig_1_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Tau</span><input type='checkbox' name="dig_1_1_7" id="dig_1_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Tau</span><input type='checkbox' name="dig_1_2_7" id="dig_1_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Tau</span><input type='checkbox' name="dig_1_3_7" id="dig_1_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Tau</span><input type='checkbox' name="dig_1_0_8" id="dig_1_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Tau</span><input type='checkbox' name="dig_1_1_8" id="dig_1_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Tau</span><input type='checkbox' name="dig_1_2_8" id="dig_1_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Tau</span><input type='checkbox' name="dig_1_3_8" id="dig_1_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Tau</span><input type='checkbox' name="dig_1_0_9" id="dig_1_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Tau</span><input type='checkbox' name="dig_1_1_9" id="dig_1_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Tau</span><input type='checkbox' name="dig_1_2_9" id="dig_1_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Tau</span><input type='checkbox' name="dig_1_3_9" id="dig_1_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Tau</span><input type='checkbox' name="dig_1_0_10" id="dig_1_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Tau</span><input type='checkbox' name="dig_1_1_10" id="dig_1_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Tau</span><input type='checkbox' name="dig_1_2_10" id="dig_1_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Tau</span><input type='checkbox' name="dig_1_3_10" id="dig_1_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Tau</span><input type='checkbox' name="dig_1_0_11" id="dig_1_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Tau</span><input type='checkbox' name="dig_1_1_11" id="dig_1_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Tau</span><input type='checkbox' name="dig_1_2_11" id="dig_1_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Tau</span><input type='checkbox' name="dig_1_3_11" id="dig_1_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Tau</span><input type='checkbox' name="dig_1_0_12" id="dig_1_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Tau</span><input type='checkbox' name="dig_1_1_12" id="dig_1_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Tau</span><input type='checkbox' name="dig_1_2_12" id="dig_1_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Tau</span><input type='checkbox' name="dig_1_3_12" id="dig_1_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Gem</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Gem</span><input type='checkbox' name="dig_2_0_0" id="dig_2_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Gem</span><input type='checkbox' name="dig_2_1_0" id="dig_2_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Gem</span><input type='checkbox' name="dig_2_2_0" id="dig_2_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Gem</span><input type='checkbox' name="dig_2_3_0" id="dig_2_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Gem</span><input type='checkbox' name="dig_2_0_1" id="dig_2_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Gem</span><input type='checkbox' name="dig_2_1_1" id="dig_2_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Gem</span><input type='checkbox' name="dig_2_2_1" id="dig_2_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Gem</span><input type='checkbox' name="dig_2_3_1" id="dig_2_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Gem</span><input type='checkbox' name="dig_2_0_2" id="dig_2_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Gem</span><input type='checkbox' name="dig_2_1_2" id="dig_2_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Gem</span><input type='checkbox' name="dig_2_2_2" id="dig_2_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Gem</span><input type='checkbox' name="dig_2_3_2" id="dig_2_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Gem</span><input type='checkbox' name="dig_2_0_3" id="dig_2_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Gem</span><input type='checkbox' name="dig_2_1_3" id="dig_2_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Gem</span><input type='checkbox' name="dig_2_2_3" id="dig_2_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Gem</span><input type='checkbox' name="dig_2_3_3" id="dig_2_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Gem</span><input type='checkbox' name="dig_2_0_4" id="dig_2_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Gem</span><input type='checkbox' name="dig_2_1_4" id="dig_2_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Gem</span><input type='checkbox' name="dig_2_2_4" id="dig_2_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Gem</span><input type='checkbox' name="dig_2_3_4" id="dig_2_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Gem</span><input type='checkbox' name="dig_2_0_5" id="dig_2_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Gem</span><input type='checkbox' name="dig_2_1_5" id="dig_2_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Gem</span><input type='checkbox' name="dig_2_2_5" id="dig_2_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Gem</span><input type='checkbox' name="dig_2_3_5" id="dig_2_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Gem</span><input type='checkbox' name="dig_2_0_6" id="dig_2_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Gem</span><input type='checkbox' name="dig_2_1_6" id="dig_2_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Gem</span><input type='checkbox' name="dig_2_2_6" id="dig_2_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Gem</span><input type='checkbox' name="dig_2_3_6" id="dig_2_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Gem</span><input type='checkbox' name="dig_2_0_7" id="dig_2_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Gem</span><input type='checkbox' name="dig_2_1_7" id="dig_2_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Gem</span><input type='checkbox' name="dig_2_2_7" id="dig_2_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Gem</span><input type='checkbox' name="dig_2_3_7" id="dig_2_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Gem</span><input type='checkbox' name="dig_2_0_8" id="dig_2_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Gem</span><input type='checkbox' name="dig_2_1_8" id="dig_2_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Gem</span><input type='checkbox' name="dig_2_2_8" id="dig_2_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Gem</span><input type='checkbox' name="dig_2_3_8" id="dig_2_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Gem</span><input type='checkbox' name="dig_2_0_9" id="dig_2_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Gem</span><input type='checkbox' name="dig_2_1_9" id="dig_2_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Gem</span><input type='checkbox' name="dig_2_2_9" id="dig_2_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Gem</span><input type='checkbox' name="dig_2_3_9" id="dig_2_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Gem</span><input type='checkbox' name="dig_2_0_10" id="dig_2_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Gem</span><input type='checkbox' name="dig_2_1_10" id="dig_2_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Gem</span><input type='checkbox' name="dig_2_2_10" id="dig_2_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Gem</span><input type='checkbox' name="dig_2_3_10" id="dig_2_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Gem</span><input type='checkbox' name="dig_2_0_11" id="dig_2_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Gem</span><input type='checkbox' name="dig_2_1_11" id="dig_2_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Gem</span><input type='checkbox' name="dig_2_2_11" id="dig_2_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Gem</span><input type='checkbox' name="dig_2_3_11" id="dig_2_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Gem</span><input type='checkbox' name="dig_2_0_12" id="dig_2_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Gem</span><input type='checkbox' name="dig_2_1_12" id="dig_2_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Gem</span><input type='checkbox' name="dig_2_2_12" id="dig_2_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Gem</span><input type='checkbox' name="dig_2_3_12" id="dig_2_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Can</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Can</span><input type='checkbox' name="dig_3_0_0" id="dig_3_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Can</span><input type='checkbox' name="dig_3_1_0" id="dig_3_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Can</span><input type='checkbox' name="dig_3_2_0" id="dig_3_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Can</span><input type='checkbox' name="dig_3_3_0" id="dig_3_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Can</span><input type='checkbox' name="dig_3_0_1" id="dig_3_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Can</span><input type='checkbox' name="dig_3_1_1" id="dig_3_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Can</span><input type='checkbox' name="dig_3_2_1" id="dig_3_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Can</span><input type='checkbox' name="dig_3_3_1" id="dig_3_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Can</span><input type='checkbox' name="dig_3_0_2" id="dig_3_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Can</span><input type='checkbox' name="dig_3_1_2" id="dig_3_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Can</span><input type='checkbox' name="dig_3_2_2" id="dig_3_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Can</span><input type='checkbox' name="dig_3_3_2" id="dig_3_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Can</span><input type='checkbox' name="dig_3_0_3" id="dig_3_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Can</span><input type='checkbox' name="dig_3_1_3" id="dig_3_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Can</span><input type='checkbox' name="dig_3_2_3" id="dig_3_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Can</span><input type='checkbox' name="dig_3_3_3" id="dig_3_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Can</span><input type='checkbox' name="dig_3_0_4" id="dig_3_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Can</span><input type='checkbox' name="dig_3_1_4" id="dig_3_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Can</span><input type='checkbox' name="dig_3_2_4" id="dig_3_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Can</span><input type='checkbox' name="dig_3_3_4" id="dig_3_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Can</span><input type='checkbox' name="dig_3_0_5" id="dig_3_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Can</span><input type='checkbox' name="dig_3_1_5" id="dig_3_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Can</span><input type='checkbox' name="dig_3_2_5" id="dig_3_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Can</span><input type='checkbox' name="dig_3_3_5" id="dig_3_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Can</span><input type='checkbox' name="dig_3_0_6" id="dig_3_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Can</span><input type='checkbox' name="dig_3_1_6" id="dig_3_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Can</span><input type='checkbox' name="dig_3_2_6" id="dig_3_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Can</span><input type='checkbox' name="dig_3_3_6" id="dig_3_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Can</span><input type='checkbox' name="dig_3_0_7" id="dig_3_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Can</span><input type='checkbox' name="dig_3_1_7" id="dig_3_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Can</span><input type='checkbox' name="dig_3_2_7" id="dig_3_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Can</span><input type='checkbox' name="dig_3_3_7" id="dig_3_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Can</span><input type='checkbox' name="dig_3_0_8" id="dig_3_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Can</span><input type='checkbox' name="dig_3_1_8" id="dig_3_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Can</span><input type='checkbox' name="dig_3_2_8" id="dig_3_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Can</span><input type='checkbox' name="dig_3_3_8" id="dig_3_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Can</span><input type='checkbox' name="dig_3_0_9" id="dig_3_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Can</span><input type='checkbox' name="dig_3_1_9" id="dig_3_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Can</span><input type='checkbox' name="dig_3_2_9" id="dig_3_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Can</span><input type='checkbox' name="dig_3_3_9" id="dig_3_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Can</span><input type='checkbox' name="dig_3_0_10" id="dig_3_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Can</span><input type='checkbox' name="dig_3_1_10" id="dig_3_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Can</span><input type='checkbox' name="dig_3_2_10" id="dig_3_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Can</span><input type='checkbox' name="dig_3_3_10" id="dig_3_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Can</span><input type='checkbox' name="dig_3_0_11" id="dig_3_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Can</span><input type='checkbox' name="dig_3_1_11" id="dig_3_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Can</span><input type='checkbox' name="dig_3_2_11" id="dig_3_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Can</span><input type='checkbox' name="dig_3_3_11" id="dig_3_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Can</span><input type='checkbox' name="dig_3_0_12" id="dig_3_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Can</span><input type='checkbox' name="dig_3_1_12" id="dig_3_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Can</span><input type='checkbox' name="dig_3_2_12" id="dig_3_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Can</span><input type='checkbox' name="dig_3_3_12" id="dig_3_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Leo</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Leo</span><input type='checkbox' name="dig_4_0_0" id="dig_4_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Leo</span><input type='checkbox' name="dig_4_1_0" id="dig_4_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Leo</span><input type='checkbox' name="dig_4_2_0" id="dig_4_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Leo</span><input type='checkbox' name="dig_4_3_0" id="dig_4_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Leo</span><input type='checkbox' name="dig_4_0_1" id="dig_4_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Leo</span><input type='checkbox' name="dig_4_1_1" id="dig_4_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Leo</span><input type='checkbox' name="dig_4_2_1" id="dig_4_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Leo</span><input type='checkbox' name="dig_4_3_1" id="dig_4_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Leo</span><input type='checkbox' name="dig_4_0_2" id="dig_4_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Leo</span><input type='checkbox' name="dig_4_1_2" id="dig_4_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Leo</span><input type='checkbox' name="dig_4_2_2" id="dig_4_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Leo</span><input type='checkbox' name="dig_4_3_2" id="dig_4_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Leo</span><input type='checkbox' name="dig_4_0_3" id="dig_4_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Leo</span><input type='checkbox' name="dig_4_1_3" id="dig_4_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Leo</span><input type='checkbox' name="dig_4_2_3" id="dig_4_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Leo</span><input type='checkbox' name="dig_4_3_3" id="dig_4_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Leo</span><input type='checkbox' name="dig_4_0_4" id="dig_4_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Leo</span><input type='checkbox' name="dig_4_1_4" id="dig_4_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Leo</span><input type='checkbox' name="dig_4_2_4" id="dig_4_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Leo</span><input type='checkbox' name="dig_4_3_4" id="dig_4_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Leo</span><input type='checkbox' name="dig_4_0_5" id="dig_4_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Leo</span><input type='checkbox' name="dig_4_1_5" id="dig_4_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Leo</span><input type='checkbox' name="dig_4_2_5" id="dig_4_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Leo</span><input type='checkbox' name="dig_4_3_5" id="dig_4_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Leo</span><input type='checkbox' name="dig_4_0_6" id="dig_4_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Leo</span><input type='checkbox' name="dig_4_1_6" id="dig_4_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Leo</span><input type='checkbox' name="dig_4_2_6" id="dig_4_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Leo</span><input type='checkbox' name="dig_4_3_6" id="dig_4_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Leo</span><input type='checkbox' name="dig_4_0_7" id="dig_4_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Leo</span><input type='checkbox' name="dig_4_1_7" id="dig_4_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Leo</span><input type='checkbox' name="dig_4_2_7" id="dig_4_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Leo</span><input type='checkbox' name="dig_4_3_7" id="dig_4_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Leo</span><input type='checkbox' name="dig_4_0_8" id="dig_4_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Leo</span><input type='checkbox' name="dig_4_1_8" id="dig_4_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Leo</span><input type='checkbox' name="dig_4_2_8" id="dig_4_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Leo</span><input type='checkbox' name="dig_4_3_8" id="dig_4_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Leo</span><input type='checkbox' name="dig_4_0_9" id="dig_4_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Leo</span><input type='checkbox' name="dig_4_1_9" id="dig_4_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Leo</span><input type='checkbox' name="dig_4_2_9" id="dig_4_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Leo</span><input type='checkbox' name="dig_4_3_9" id="dig_4_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Leo</span><input type='checkbox' name="dig_4_0_10" id="dig_4_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Leo</span><input type='checkbox' name="dig_4_1_10" id="dig_4_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Leo</span><input type='checkbox' name="dig_4_2_10" id="dig_4_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Leo</span><input type='checkbox' name="dig_4_3_10" id="dig_4_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Leo</span><input type='checkbox' name="dig_4_0_11" id="dig_4_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Leo</span><input type='checkbox' name="dig_4_1_11" id="dig_4_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Leo</span><input type='checkbox' name="dig_4_2_11" id="dig_4_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Leo</span><input type='checkbox' name="dig_4_3_11" id="dig_4_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Leo</span><input type='checkbox' name="dig_4_0_12" id="dig_4_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Leo</span><input type='checkbox' name="dig_4_1_12" id="dig_4_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Leo</span><input type='checkbox' name="dig_4_2_12" id="dig_4_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Leo</span><input type='checkbox' name="dig_4_3_12" id="dig_4_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Vir</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Vir</span><input type='checkbox' name="dig_5_0_0" id="dig_5_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Vir</span><input type='checkbox' name="dig_5_1_0" id="dig_5_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Vir</span><input type='checkbox' name="dig_5_2_0" id="dig_5_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Vir</span><input type='checkbox' name="dig_5_3_0" id="dig_5_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Vir</span><input type='checkbox' name="dig_5_0_1" id="dig_5_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Vir</span><input type='checkbox' name="dig_5_1_1" id="dig_5_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Vir</span><input type='checkbox' name="dig_5_2_1" id="dig_5_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Vir</span><input type='checkbox' name="dig_5_3_1" id="dig_5_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Vir</span><input type='checkbox' name="dig_5_0_2" id="dig_5_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Vir</span><input type='checkbox' name="dig_5_1_2" id="dig_5_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Vir</span><input type='checkbox' name="dig_5_2_2" id="dig_5_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Vir</span><input type='checkbox' name="dig_5_3_2" id="dig_5_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Vir</span><input type='checkbox' name="dig_5_0_3" id="dig_5_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Vir</span><input type='checkbox' name="dig_5_1_3" id="dig_5_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Vir</span><input type='checkbox' name="dig_5_2_3" id="dig_5_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Vir</span><input type='checkbox' name="dig_5_3_3" id="dig_5_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Vir</span><input type='checkbox' name="dig_5_0_4" id="dig_5_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Vir</span><input type='checkbox' name="dig_5_1_4" id="dig_5_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Vir</span><input type='checkbox' name="dig_5_2_4" id="dig_5_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Vir</span><input type='checkbox' name="dig_5_3_4" id="dig_5_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Vir</span><input type='checkbox' name="dig_5_0_5" id="dig_5_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Vir</span><input type='checkbox' name="dig_5_1_5" id="dig_5_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Vir</span><input type='checkbox' name="dig_5_2_5" id="dig_5_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Vir</span><input type='checkbox' name="dig_5_3_5" id="dig_5_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Vir</span><input type='checkbox' name="dig_5_0_6" id="dig_5_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Vir</span><input type='checkbox' name="dig_5_1_6" id="dig_5_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Vir</span><input type='checkbox' name="dig_5_2_6" id="dig_5_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Vir</span><input type='checkbox' name="dig_5_3_6" id="dig_5_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Vir</span><input type='checkbox' name="dig_5_0_7" id="dig_5_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Vir</span><input type='checkbox' name="dig_5_1_7" id="dig_5_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Vir</span><input type='checkbox' name="dig_5_2_7" id="dig_5_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Vir</span><input type='checkbox' name="dig_5_3_7" id="dig_5_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Vir</span><input type='checkbox' name="dig_5_0_8" id="dig_5_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Vir</span><input type='checkbox' name="dig_5_1_8" id="dig_5_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Vir</span><input type='checkbox' name="dig_5_2_8" id="dig_5_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Vir</span><input type='checkbox' name="dig_5_3_8" id="dig_5_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Vir</span><input type='checkbox' name="dig_5_0_9" id="dig_5_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Vir</span><input type='checkbox' name="dig_5_1_9" id="dig_5_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Vir</span><input type='checkbox' name="dig_5_2_9" id="dig_5_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Vir</span><input type='checkbox' name="dig_5_3_9" id="dig_5_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Vir</span><input type='checkbox' name="dig_5_0_10" id="dig_5_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Vir</span><input type='checkbox' name="dig_5_1_10" id="dig_5_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Vir</span><input type='checkbox' name="dig_5_2_10" id="dig_5_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Vir</span><input type='checkbox' name="dig_5_3_10" id="dig_5_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Vir</span><input type='checkbox' name="dig_5_0_11" id="dig_5_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Vir</span><input type='checkbox' name="dig_5_1_11" id="dig_5_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Vir</span><input type='checkbox' name="dig_5_2_11" id="dig_5_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Vir</span><input type='checkbox' name="dig_5_3_11" id="dig_5_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Vir</span><input type='checkbox' name="dig_5_0_12" id="dig_5_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Vir</span><input type='checkbox' name="dig_5_1_12" id="dig_5_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Vir</span><input type='checkbox' name="dig_5_2_12" id="dig_5_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Vir</span><input type='checkbox' name="dig_5_3_12" id="dig_5_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Lib</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Lib</span><input type='checkbox' name="dig_6_0_0" id="dig_6_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Lib</span><input type='checkbox' name="dig_6_1_0" id="dig_6_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Lib</span><input type='checkbox' name="dig_6_2_0" id="dig_6_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Lib</span><input type='checkbox' name="dig_6_3_0" id="dig_6_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Lib</span><input type='checkbox' name="dig_6_0_1" id="dig_6_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Lib</span><input type='checkbox' name="dig_6_1_1" id="dig_6_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Lib</span><input type='checkbox' name="dig_6_2_1" id="dig_6_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Lib</span><input type='checkbox' name="dig_6_3_1" id="dig_6_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Lib</span><input type='checkbox' name="dig_6_0_2" id="dig_6_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Lib</span><input type='checkbox' name="dig_6_1_2" id="dig_6_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Lib</span><input type='checkbox' name="dig_6_2_2" id="dig_6_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Lib</span><input type='checkbox' name="dig_6_3_2" id="dig_6_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Lib</span><input type='checkbox' name="dig_6_0_3" id="dig_6_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Lib</span><input type='checkbox' name="dig_6_1_3" id="dig_6_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Lib</span><input type='checkbox' name="dig_6_2_3" id="dig_6_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Lib</span><input type='checkbox' name="dig_6_3_3" id="dig_6_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Lib</span><input type='checkbox' name="dig_6_0_4" id="dig_6_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Lib</span><input type='checkbox' name="dig_6_1_4" id="dig_6_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Lib</span><input type='checkbox' name="dig_6_2_4" id="dig_6_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Lib</span><input type='checkbox' name="dig_6_3_4" id="dig_6_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Lib</span><input type='checkbox' name="dig_6_0_5" id="dig_6_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Lib</span><input type='checkbox' name="dig_6_1_5" id="dig_6_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Lib</span><input type='checkbox' name="dig_6_2_5" id="dig_6_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Lib</span><input type='checkbox' name="dig_6_3_5" id="dig_6_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Lib</span><input type='checkbox' name="dig_6_0_6" id="dig_6_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Lib</span><input type='checkbox' name="dig_6_1_6" id="dig_6_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Lib</span><input type='checkbox' name="dig_6_2_6" id="dig_6_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Lib</span><input type='checkbox' name="dig_6_3_6" id="dig_6_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Lib</span><input type='checkbox' name="dig_6_0_7" id="dig_6_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Lib</span><input type='checkbox' name="dig_6_1_7" id="dig_6_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Lib</span><input type='checkbox' name="dig_6_2_7" id="dig_6_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Lib</span><input type='checkbox' name="dig_6_3_7" id="dig_6_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Lib</span><input type='checkbox' name="dig_6_0_8" id="dig_6_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Lib</span><input type='checkbox' name="dig_6_1_8" id="dig_6_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Lib</span><input type='checkbox' name="dig_6_2_8" id="dig_6_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Lib</span><input type='checkbox' name="dig_6_3_8" id="dig_6_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Lib</span><input type='checkbox' name="dig_6_0_9" id="dig_6_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Lib</span><input type='checkbox' name="dig_6_1_9" id="dig_6_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Lib</span><input type='checkbox' name="dig_6_2_9" id="dig_6_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Lib</span><input type='checkbox' name="dig_6_3_9" id="dig_6_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Lib</span><input type='checkbox' name="dig_6_0_10" id="dig_6_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Lib</span><input type='checkbox' name="dig_6_1_10" id="dig_6_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Lib</span><input type='checkbox' name="dig_6_2_10" id="dig_6_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Lib</span><input type='checkbox' name="dig_6_3_10" id="dig_6_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Lib</span><input type='checkbox' name="dig_6_0_11" id="dig_6_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Lib</span><input type='checkbox' name="dig_6_1_11" id="dig_6_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Lib</span><input type='checkbox' name="dig_6_2_11" id="dig_6_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Lib</span><input type='checkbox' name="dig_6_3_11" id="dig_6_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Lib</span><input type='checkbox' name="dig_6_0_12" id="dig_6_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Lib</span><input type='checkbox' name="dig_6_1_12" id="dig_6_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Lib</span><input type='checkbox' name="dig_6_2_12" id="dig_6_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Lib</span><input type='checkbox' name="dig_6_3_12" id="dig_6_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Sco</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Sco</span><input type='checkbox' name="dig_7_0_0" id="dig_7_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Sco</span><input type='checkbox' name="dig_7_1_0" id="dig_7_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Sco</span><input type='checkbox' name="dig_7_2_0" id="dig_7_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Sco</span><input type='checkbox' name="dig_7_3_0" id="dig_7_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Sco</span><input type='checkbox' name="dig_7_0_1" id="dig_7_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Sco</span><input type='checkbox' name="dig_7_1_1" id="dig_7_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Sco</span><input type='checkbox' name="dig_7_2_1" id="dig_7_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Sco</span><input type='checkbox' name="dig_7_3_1" id="dig_7_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Sco</span><input type='checkbox' name="dig_7_0_2" id="dig_7_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Sco</span><input type='checkbox' name="dig_7_1_2" id="dig_7_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Sco</span><input type='checkbox' name="dig_7_2_2" id="dig_7_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Sco</span><input type='checkbox' name="dig_7_3_2" id="dig_7_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Sco</span><input type='checkbox' name="dig_7_0_3" id="dig_7_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Sco</span><input type='checkbox' name="dig_7_1_3" id="dig_7_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Sco</span><input type='checkbox' name="dig_7_2_3" id="dig_7_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Sco</span><input type='checkbox' name="dig_7_3_3" id="dig_7_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Sco</span><input type='checkbox' name="dig_7_0_4" id="dig_7_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Sco</span><input type='checkbox' name="dig_7_1_4" id="dig_7_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Sco</span><input type='checkbox' name="dig_7_2_4" id="dig_7_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Sco</span><input type='checkbox' name="dig_7_3_4" id="dig_7_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Sco</span><input type='checkbox' name="dig_7_0_5" id="dig_7_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Sco</span><input type='checkbox' name="dig_7_1_5" id="dig_7_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Sco</span><input type='checkbox' name="dig_7_2_5" id="dig_7_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Sco</span><input type='checkbox' name="dig_7_3_5" id="dig_7_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Sco</span><input type='checkbox' name="dig_7_0_6" id="dig_7_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Sco</span><input type='checkbox' name="dig_7_1_6" id="dig_7_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Sco</span><input type='checkbox' name="dig_7_2_6" id="dig_7_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Sco</span><input type='checkbox' name="dig_7_3_6" id="dig_7_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Sco</span><input type='checkbox' name="dig_7_0_7" id="dig_7_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Sco</span><input type='checkbox' name="dig_7_1_7" id="dig_7_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Sco</span><input type='checkbox' name="dig_7_2_7" id="dig_7_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Sco</span><input type='checkbox' name="dig_7_3_7" id="dig_7_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Sco</span><input type='checkbox' name="dig_7_0_8" id="dig_7_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Sco</span><input type='checkbox' name="dig_7_1_8" id="dig_7_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Sco</span><input type='checkbox' name="dig_7_2_8" id="dig_7_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Sco</span><input type='checkbox' name="dig_7_3_8" id="dig_7_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Sco</span><input type='checkbox' name="dig_7_0_9" id="dig_7_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Sco</span><input type='checkbox' name="dig_7_1_9" id="dig_7_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Sco</span><input type='checkbox' name="dig_7_2_9" id="dig_7_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Sco</span><input type='checkbox' name="dig_7_3_9" id="dig_7_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Sco</span><input type='checkbox' name="dig_7_0_10" id="dig_7_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Sco</span><input type='checkbox' name="dig_7_1_10" id="dig_7_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Sco</span><input type='checkbox' name="dig_7_2_10" id="dig_7_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Sco</span><input type='checkbox' name="dig_7_3_10" id="dig_7_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Sco</span><input type='checkbox' name="dig_7_0_11" id="dig_7_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Sco</span><input type='checkbox' name="dig_7_1_11" id="dig_7_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Sco</span><input type='checkbox' name="dig_7_2_11" id="dig_7_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Sco</span><input type='checkbox' name="dig_7_3_11" id="dig_7_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Sco</span><input type='checkbox' name="dig_7_0_12" id="dig_7_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Sco</span><input type='checkbox' name="dig_7_1_12" id="dig_7_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Sco</span><input type='checkbox' name="dig_7_2_12" id="dig_7_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Sco</span><input type='checkbox' name="dig_7_3_12" id="dig_7_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Sag</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Sag</span><input type='checkbox' name="dig_8_0_0" id="dig_8_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Sag</span><input type='checkbox' name="dig_8_1_0" id="dig_8_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Sag</span><input type='checkbox' name="dig_8_2_0" id="dig_8_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Sag</span><input type='checkbox' name="dig_8_3_0" id="dig_8_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Sag</span><input type='checkbox' name="dig_8_0_1" id="dig_8_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Sag</span><input type='checkbox' name="dig_8_1_1" id="dig_8_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Sag</span><input type='checkbox' name="dig_8_2_1" id="dig_8_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Sag</span><input type='checkbox' name="dig_8_3_1" id="dig_8_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Sag</span><input type='checkbox' name="dig_8_0_2" id="dig_8_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Sag</span><input type='checkbox' name="dig_8_1_2" id="dig_8_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Sag</span><input type='checkbox' name="dig_8_2_2" id="dig_8_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Sag</span><input type='checkbox' name="dig_8_3_2" id="dig_8_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Sag</span><input type='checkbox' name="dig_8_0_3" id="dig_8_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Sag</span><input type='checkbox' name="dig_8_1_3" id="dig_8_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Sag</span><input type='checkbox' name="dig_8_2_3" id="dig_8_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Sag</span><input type='checkbox' name="dig_8_3_3" id="dig_8_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Sag</span><input type='checkbox' name="dig_8_0_4" id="dig_8_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Sag</span><input type='checkbox' name="dig_8_1_4" id="dig_8_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Sag</span><input type='checkbox' name="dig_8_2_4" id="dig_8_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Sag</span><input type='checkbox' name="dig_8_3_4" id="dig_8_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Sag</span><input type='checkbox' name="dig_8_0_5" id="dig_8_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Sag</span><input type='checkbox' name="dig_8_1_5" id="dig_8_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Sag</span><input type='checkbox' name="dig_8_2_5" id="dig_8_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Sag</span><input type='checkbox' name="dig_8_3_5" id="dig_8_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Sag</span><input type='checkbox' name="dig_8_0_6" id="dig_8_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Sag</span><input type='checkbox' name="dig_8_1_6" id="dig_8_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Sag</span><input type='checkbox' name="dig_8_2_6" id="dig_8_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Sag</span><input type='checkbox' name="dig_8_3_6" id="dig_8_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Sag</span><input type='checkbox' name="dig_8_0_7" id="dig_8_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Sag</span><input type='checkbox' name="dig_8_1_7" id="dig_8_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Sag</span><input type='checkbox' name="dig_8_2_7" id="dig_8_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Sag</span><input type='checkbox' name="dig_8_3_7" id="dig_8_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Sag</span><input type='checkbox' name="dig_8_0_8" id="dig_8_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Sag</span><input type='checkbox' name="dig_8_1_8" id="dig_8_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Sag</span><input type='checkbox' name="dig_8_2_8" id="dig_8_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Sag</span><input type='checkbox' name="dig_8_3_8" id="dig_8_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Sag</span><input type='checkbox' name="dig_8_0_9" id="dig_8_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Sag</span><input type='checkbox' name="dig_8_1_9" id="dig_8_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Sag</span><input type='checkbox' name="dig_8_2_9" id="dig_8_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Sag</span><input type='checkbox' name="dig_8_3_9" id="dig_8_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Sag</span><input type='checkbox' name="dig_8_0_10" id="dig_8_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Sag</span><input type='checkbox' name="dig_8_1_10" id="dig_8_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Sag</span><input type='checkbox' name="dig_8_2_10" id="dig_8_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Sag</span><input type='checkbox' name="dig_8_3_10" id="dig_8_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Sag</span><input type='checkbox' name="dig_8_0_11" id="dig_8_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Sag</span><input type='checkbox' name="dig_8_1_11" id="dig_8_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Sag</span><input type='checkbox' name="dig_8_2_11" id="dig_8_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Sag</span><input type='checkbox' name="dig_8_3_11" id="dig_8_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Sag</span><input type='checkbox' name="dig_8_0_12" id="dig_8_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Sag</span><input type='checkbox' name="dig_8_1_12" id="dig_8_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Sag</span><input type='checkbox' name="dig_8_2_12" id="dig_8_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Sag</span><input type='checkbox' name="dig_8_3_12" id="dig_8_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Cap</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Cap</span><input type='checkbox' name="dig_9_0_0" id="dig_9_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Cap</span><input type='checkbox' name="dig_9_1_0" id="dig_9_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Cap</span><input type='checkbox' name="dig_9_2_0" id="dig_9_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Cap</span><input type='checkbox' name="dig_9_3_0" id="dig_9_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Cap</span><input type='checkbox' name="dig_9_0_1" id="dig_9_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Cap</span><input type='checkbox' name="dig_9_1_1" id="dig_9_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Cap</span><input type='checkbox' name="dig_9_2_1" id="dig_9_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Cap</span><input type='checkbox' name="dig_9_3_1" id="dig_9_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Cap</span><input type='checkbox' name="dig_9_0_2" id="dig_9_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Cap</span><input type='checkbox' name="dig_9_1_2" id="dig_9_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Cap</span><input type='checkbox' name="dig_9_2_2" id="dig_9_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Cap</span><input type='checkbox' name="dig_9_3_2" id="dig_9_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Cap</span><input type='checkbox' name="dig_9_0_3" id="dig_9_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Cap</span><input type='checkbox' name="dig_9_1_3" id="dig_9_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Cap</span><input type='checkbox' name="dig_9_2_3" id="dig_9_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Cap</span><input type='checkbox' name="dig_9_3_3" id="dig_9_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Cap</span><input type='checkbox' name="dig_9_0_4" id="dig_9_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Cap</span><input type='checkbox' name="dig_9_1_4" id="dig_9_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Cap</span><input type='checkbox' name="dig_9_2_4" id="dig_9_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Cap</span><input type='checkbox' name="dig_9_3_4" id="dig_9_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Cap</span><input type='checkbox' name="dig_9_0_5" id="dig_9_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Cap</span><input type='checkbox' name="dig_9_1_5" id="dig_9_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Cap</span><input type='checkbox' name="dig_9_2_5" id="dig_9_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Cap</span><input type='checkbox' name="dig_9_3_5" id="dig_9_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Cap</span><input type='checkbox' name="dig_9_0_6" id="dig_9_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Cap</span><input type='checkbox' name="dig_9_1_6" id="dig_9_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Cap</span><input type='checkbox' name="dig_9_2_6" id="dig_9_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Cap</span><input type='checkbox' name="dig_9_3_6" id="dig_9_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Cap</span><input type='checkbox' name="dig_9_0_7" id="dig_9_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Cap</span><input type='checkbox' name="dig_9_1_7" id="dig_9_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Cap</span><input type='checkbox' name="dig_9_2_7" id="dig_9_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Cap</span><input type='checkbox' name="dig_9_3_7" id="dig_9_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Cap</span><input type='checkbox' name="dig_9_0_8" id="dig_9_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Cap</span><input type='checkbox' name="dig_9_1_8" id="dig_9_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Cap</span><input type='checkbox' name="dig_9_2_8" id="dig_9_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Cap</span><input type='checkbox' name="dig_9_3_8" id="dig_9_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Cap</span><input type='checkbox' name="dig_9_0_9" id="dig_9_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Cap</span><input type='checkbox' name="dig_9_1_9" id="dig_9_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Cap</span><input type='checkbox' name="dig_9_2_9" id="dig_9_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Cap</span><input type='checkbox' name="dig_9_3_9" id="dig_9_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Cap</span><input type='checkbox' name="dig_9_0_10" id="dig_9_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Cap</span><input type='checkbox' name="dig_9_1_10" id="dig_9_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Cap</span><input type='checkbox' name="dig_9_2_10" id="dig_9_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Cap</span><input type='checkbox' name="dig_9_3_10" id="dig_9_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Cap</span><input type='checkbox' name="dig_9_0_11" id="dig_9_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Cap</span><input type='checkbox' name="dig_9_1_11" id="dig_9_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Cap</span><input type='checkbox' name="dig_9_2_11" id="dig_9_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Cap</span><input type='checkbox' name="dig_9_3_11" id="dig_9_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Cap</span><input type='checkbox' name="dig_9_0_12" id="dig_9_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Cap</span><input type='checkbox' name="dig_9_1_12" id="dig_9_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Cap</span><input type='checkbox' name="dig_9_2_12" id="dig_9_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Cap</span><input type='checkbox' name="dig_9_3_12" id="dig_9_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Aqu</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Aqu</span><input type='checkbox' name="dig_10_0_0" id="dig_10_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Aqu</span><input type='checkbox' name="dig_10_1_0" id="dig_10_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Aqu</span><input type='checkbox' name="dig_10_2_0" id="dig_10_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Aqu</span><input type='checkbox' name="dig_10_3_0" id="dig_10_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Aqu</span><input type='checkbox' name="dig_10_0_1" id="dig_10_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Aqu</span><input type='checkbox' name="dig_10_1_1" id="dig_10_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Aqu</span><input type='checkbox' name="dig_10_2_1" id="dig_10_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Aqu</span><input type='checkbox' name="dig_10_3_1" id="dig_10_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Aqu</span><input type='checkbox' name="dig_10_0_2" id="dig_10_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Aqu</span><input type='checkbox' name="dig_10_1_2" id="dig_10_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Aqu</span><input type='checkbox' name="dig_10_2_2" id="dig_10_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Aqu</span><input type='checkbox' name="dig_10_3_2" id="dig_10_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Aqu</span><input type='checkbox' name="dig_10_0_3" id="dig_10_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Aqu</span><input type='checkbox' name="dig_10_1_3" id="dig_10_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Aqu</span><input type='checkbox' name="dig_10_2_3" id="dig_10_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Aqu</span><input type='checkbox' name="dig_10_3_3" id="dig_10_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Aqu</span><input type='checkbox' name="dig_10_0_4" id="dig_10_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Aqu</span><input type='checkbox' name="dig_10_1_4" id="dig_10_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Aqu</span><input type='checkbox' name="dig_10_2_4" id="dig_10_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Aqu</span><input type='checkbox' name="dig_10_3_4" id="dig_10_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Aqu</span><input type='checkbox' name="dig_10_0_5" id="dig_10_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Aqu</span><input type='checkbox' name="dig_10_1_5" id="dig_10_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Aqu</span><input type='checkbox' name="dig_10_2_5" id="dig_10_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Aqu</span><input type='checkbox' name="dig_10_3_5" id="dig_10_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Aqu</span><input type='checkbox' name="dig_10_0_6" id="dig_10_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Aqu</span><input type='checkbox' name="dig_10_1_6" id="dig_10_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Aqu</span><input type='checkbox' name="dig_10_2_6" id="dig_10_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Aqu</span><input type='checkbox' name="dig_10_3_6" id="dig_10_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Aqu</span><input type='checkbox' name="dig_10_0_7" id="dig_10_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Aqu</span><input type='checkbox' name="dig_10_1_7" id="dig_10_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Aqu</span><input type='checkbox' name="dig_10_2_7" id="dig_10_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Aqu</span><input type='checkbox' name="dig_10_3_7" id="dig_10_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Aqu</span><input type='checkbox' name="dig_10_0_8" id="dig_10_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Aqu</span><input type='checkbox' name="dig_10_1_8" id="dig_10_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Aqu</span><input type='checkbox' name="dig_10_2_8" id="dig_10_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Aqu</span><input type='checkbox' name="dig_10_3_8" id="dig_10_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Aqu</span><input type='checkbox' name="dig_10_0_9" id="dig_10_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Aqu</span><input type='checkbox' name="dig_10_1_9" id="dig_10_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Aqu</span><input type='checkbox' name="dig_10_2_9" id="dig_10_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Aqu</span><input type='checkbox' name="dig_10_3_9" id="dig_10_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Aqu</span><input type='checkbox' name="dig_10_0_10" id="dig_10_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Aqu</span><input type='checkbox' name="dig_10_1_10" id="dig_10_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Aqu</span><input type='checkbox' name="dig_10_2_10" id="dig_10_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Aqu</span><input type='checkbox' name="dig_10_3_10" id="dig_10_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Aqu</span><input type='checkbox' name="dig_10_0_11" id="dig_10_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Aqu</span><input type='checkbox' name="dig_10_1_11" id="dig_10_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Aqu</span><input type='checkbox' name="dig_10_2_11" id="dig_10_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Aqu</span><input type='checkbox' name="dig_10_3_11" id="dig_10_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Aqu</span><input type='checkbox' name="dig_10_0_12" id="dig_10_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Aqu</span><input type='checkbox' name="dig_10_1_12" id="dig_10_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Aqu</span><input type='checkbox' name="dig_10_2_12" id="dig_10_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Aqu</span><input type='checkbox' name="dig_10_3_12" id="dig_10_3_12" value='0'></div><br>
</td>
</tr>
<tr><td></td><td></td><td>Sun</td><td>Moo</td><td>Mer</td><td>Ven</td><td>Mar</td><td>Jup</td><td>Sat</td><td>Ura</td><td>Nep</td><td>Plu</td><td>AN</td><td>DN</td><td>Chi</td></tr>
<tr>
<td>Pis</td><td>R<br>E<br>F<br>D</td><td>
<div class="tooltip"><span class="tooltiptext">Sun ruling in Pis</span><input type='checkbox' name="dig_11_0_0" id="dig_11_0_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun exalted in Pis</span><input type='checkbox' name="dig_11_1_0" id="dig_11_1_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun falling in Pis</span><input type='checkbox' name="dig_11_2_0" id="dig_11_2_0" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sun in det. at Pis</span><input type='checkbox' name="dig_11_3_0" id="dig_11_3_0" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Moo ruling in Pis</span><input type='checkbox' name="dig_11_0_1" id="dig_11_0_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo exalted in Pis</span><input type='checkbox' name="dig_11_1_1" id="dig_11_1_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo falling in Pis</span><input type='checkbox' name="dig_11_2_1" id="dig_11_2_1" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Moo in det. at Pis</span><input type='checkbox' name="dig_11_3_1" id="dig_11_3_1" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mer ruling in Pis</span><input type='checkbox' name="dig_11_0_2" id="dig_11_0_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer exalted in Pis</span><input type='checkbox' name="dig_11_1_2" id="dig_11_1_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer falling in Pis</span><input type='checkbox' name="dig_11_2_2" id="dig_11_2_2" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mer in det. at Pis</span><input type='checkbox' name="dig_11_3_2" id="dig_11_3_2" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ven ruling in Pis</span><input type='checkbox' name="dig_11_0_3" id="dig_11_0_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven exalted in Pis</span><input type='checkbox' name="dig_11_1_3" id="dig_11_1_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven falling in Pis</span><input type='checkbox' name="dig_11_2_3" id="dig_11_2_3" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ven in det. at Pis</span><input type='checkbox' name="dig_11_3_3" id="dig_11_3_3" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Mar ruling in Pis</span><input type='checkbox' name="dig_11_0_4" id="dig_11_0_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar exalted in Pis</span><input type='checkbox' name="dig_11_1_4" id="dig_11_1_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar falling in Pis</span><input type='checkbox' name="dig_11_2_4" id="dig_11_2_4" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Mar in det. at Pis</span><input type='checkbox' name="dig_11_3_4" id="dig_11_3_4" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Jup ruling in Pis</span><input type='checkbox' name="dig_11_0_5" id="dig_11_0_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup exalted in Pis</span><input type='checkbox' name="dig_11_1_5" id="dig_11_1_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup falling in Pis</span><input type='checkbox' name="dig_11_2_5" id="dig_11_2_5" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Jup in det. at Pis</span><input type='checkbox' name="dig_11_3_5" id="dig_11_3_5" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Sat ruling in Pis</span><input type='checkbox' name="dig_11_0_6" id="dig_11_0_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat exalted in Pis</span><input type='checkbox' name="dig_11_1_6" id="dig_11_1_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat falling in Pis</span><input type='checkbox' name="dig_11_2_6" id="dig_11_2_6" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Sat in det. at Pis</span><input type='checkbox' name="dig_11_3_6" id="dig_11_3_6" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Ura ruling in Pis</span><input type='checkbox' name="dig_11_0_7" id="dig_11_0_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura exalted in Pis</span><input type='checkbox' name="dig_11_1_7" id="dig_11_1_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura falling in Pis</span><input type='checkbox' name="dig_11_2_7" id="dig_11_2_7" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Ura in det. at Pis</span><input type='checkbox' name="dig_11_3_7" id="dig_11_3_7" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Nep ruling in Pis</span><input type='checkbox' name="dig_11_0_8" id="dig_11_0_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep exalted in Pis</span><input type='checkbox' name="dig_11_1_8" id="dig_11_1_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep falling in Pis</span><input type='checkbox' name="dig_11_2_8" id="dig_11_2_8" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Nep in det. at Pis</span><input type='checkbox' name="dig_11_3_8" id="dig_11_3_8" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Plu ruling in Pis</span><input type='checkbox' name="dig_11_0_9" id="dig_11_0_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu exalted in Pis</span><input type='checkbox' name="dig_11_1_9" id="dig_11_1_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu falling in Pis</span><input type='checkbox' name="dig_11_2_9" id="dig_11_2_9" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Plu in det. at Pis</span><input type='checkbox' name="dig_11_3_9" id="dig_11_3_9" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">AN ruling in Pis</span><input type='checkbox' name="dig_11_0_10" id="dig_11_0_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN exalted in Pis</span><input type='checkbox' name="dig_11_1_10" id="dig_11_1_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN falling in Pis</span><input type='checkbox' name="dig_11_2_10" id="dig_11_2_10" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">AN in det. at Pis</span><input type='checkbox' name="dig_11_3_10" id="dig_11_3_10" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">DN ruling in Pis</span><input type='checkbox' name="dig_11_0_11" id="dig_11_0_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN exalted in Pis</span><input type='checkbox' name="dig_11_1_11" id="dig_11_1_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN falling in Pis</span><input type='checkbox' name="dig_11_2_11" id="dig_11_2_11" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">DN in det. at Pis</span><input type='checkbox' name="dig_11_3_11" id="dig_11_3_11" value='0'></div><br>
</td>
<td>
<div class="tooltip"><span class="tooltiptext">Chi ruling in Pis</span><input type='checkbox' name="dig_11_0_12" id="dig_11_0_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi exalted in Pis</span><input type='checkbox' name="dig_11_1_12" id="dig_11_1_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi falling in Pis</span><input type='checkbox' name="dig_11_2_12" id="dig_11_2_12" value='0'></div><br>
<div class="tooltip"><span class="tooltiptext">Chi in det. at Pis</span><input type='checkbox' name="dig_11_3_12" id="dig_11_3_12" value='0'></div><br>
</td>
</tr>
</table>
<input type="hidden" name="DValues" id="DValues" value="">
<br><br><center><input type="submit" name="submit" id="submit" value="Save custom settings"></center><br><br>
</form>
<script>
if(js_array){
	for(i in js_array){
		var t = document.getElementById(i);	
    if(i.indexOf('dig_') == 0){
    t.checked = true;
    }
	}
	document.getElementById("model").value=js_array["model"];
}
function checkAll(){
    var element = [];
    var inputs = document.getElementsByTagName("input");
    //console.log(inputs);
    
    var v = new Array(12);
    for(i=0;i<12;i++){
    	v[i] = new Array(13);
    }
    for(i=0;i<12;i++){
    	for(j=0;j<13;j++){
    	v[i][j] = new Array(4);
    }
    }
   
    for(var i = 0; i < inputs.length; i++)
    {
        if(inputs[i].name.indexOf('dig') == 0)
        {
           element.push(inputs[i]);
           
           var reg = /(\d+)/;
           var z = inputs[i].name.split(reg);
           console.log(z);
           a = Number(z[1]);
           b = Number(z[3]);
           c = Number(z[5]);
           v[a][c][b] = inputs[i].checked;
           
        }
    }
    //console.log(element);
    var e = document.getElementById("DValues"); 
    e.value=JSON.stringify(v);  
 
}
	
</script>
</body></html>
