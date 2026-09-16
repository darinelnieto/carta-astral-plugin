<html>
<head>
<title>Tetrabyblos</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tetrabyblos</title>



<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/jquery.min.js"> </script>
<script>var $jq=jQuery.noConflict();</script>
<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/jquery-ui.min.js"> </script>

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('Tetrabyblos') ?>/js/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('Tetrabyblos') ?>/css/w3.css">
	
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('Tetrabyblos') ?>/css/main.css">	
	
<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/moment.js"> </script>
<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/moment-timezone-with-data.js"> </script>
<script type='text/javascript' src='<?php echo plugins_url('Tetrabyblos') ?>/js/ephemeris-0.1.0.js' charset='utf-8'> </script>
	
<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/astrochart.js"> </script>
<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/canvg.js"> </script>



<?php

if ( ! function_exists( 'generate_options' ) ) {
	function generate_options($begin,$end,$sel){
		for($i=$begin;$i<=$end;$i++){
			//<option value="0" selected>00</option>
			$j = ($i < 10) ? "0" . $i : $i;
			$s = ($sel == $i) ? " selected" : "";
			echo "<option value='" . $i . "'" . $s . '>' . $j . '</option>\n';
		}
		return true;
	}
}	
	
$translate_json = function_exists( 'tetrabyblos_get_translation_json' ) ? tetrabyblos_get_translation_json() : array();
$translate_main = json_encode( $translate_json );
if ( false === $translate_main ) {
  $translate_main = '{}';
}

$options = function_exists( 'tetrabyblos_get_settings_array' ) ? tetrabyblos_get_settings_array() : get_option( 'byblos_settings' );
if ( ! is_array( $options ) ) {
  $options = array();
}
		
/* var_dump($options); */
		
$options['byblos_select_field_3'] = empty( $options['byblos_select_field_3'] ) ? '0' : $options['byblos_select_field_3'];
$scale = $options['byblos_select_field_3'];
$scale_per = $scale*100;
$scale_width = 720*$scale;
		
$options['byblos_select_field_button_style'] = empty( $options['byblos_select_field_button_style'] ) ? "w3-button w3-blue w3-large w3-round" : $options['byblos_select_field_button_style'];
$tetra_button_style = $options['byblos_select_field_button_style'];
		
$options['byblos_select_field_button_style_2'] = empty( $options['byblos_select_field_button_style_2'] ) ? "w3-btn w3-block w3-grey tetra-font" : $options['byblos_select_field_button_style_2'];
$tetra_button_style_2 = $options['byblos_select_field_button_style_2'];
		
$options['byblos_select_field_table_style'] = empty( $options['byblos_select_field_table_style'] ) ? "w3-table w3-small w3-striped w3-bordered w3-white tetra-font table-no-border" : $options['byblos_select_field_table_style'];
$options['byblos_select_field_table_style_2'] = empty( $options['byblos_select_field_table_style_2'] ) ? "w3-white tetra-font-mobile table-no-border" : $options['byblos_select_field_table_style_2'];
$tetra_table_style = $options['byblos_select_field_table_style'];			
$tetra_table_style_2 = $options['byblos_select_field_table_style_2'];		

$options['byblos_select_field_table_style_3'] = empty( $options['byblos_select_field_table_style_3'] ) ? "w3-table w3-small w3-border-0 tetra-font" : $options['byblos_select_field_table_style_3'];
$options['byblos_select_field_table_style_4'] = empty( $options['byblos_select_field_table_style_4'] ) ? "w3-leftbar w3-border-0 w3-white" : $options['byblos_select_field_table_style_4'];
$tetra_table_style_3 = $options['byblos_select_field_table_style_3'];			
$tetra_table_style_4 = $options['byblos_select_field_table_style_4'];
		
$html_output = empty( $options['textarea_html_output'] ) ? "<!-- HERE -->" : $options['textarea_html_output'];

$options['byblos_checkbox_field_bcalc_transits'] = empty( $options['byblos_checkbox_field_bcalc_transits'] ) ? 0 : 1;
$options['byblos_checkbox_field_bcalc_again'] = empty( $options['byblos_checkbox_field_bcalc_again'] ) ? 0 : 1;
$b_calc_transit = $options['byblos_checkbox_field_bcalc_transits'];
$b_calc_again = $options['byblos_checkbox_field_bcalc_again'];

$options['byblos_checkbox_field_snode'] = empty( $options['byblos_checkbox_field_snode'] ) ? 0 : 1; //South Node		
$show_snode = $options['byblos_checkbox_field_snode'];	

//0, 12 or 24		
$options['byblos_select_field_hourformat'] = empty( $options['byblos_select_field_hourformat'] ) ? 0 : $options['byblos_select_field_hourformat'];
$show_hourformat = $options['byblos_select_field_hourformat'];

$id_24hours = 'id="defaultOpen"';
$id_12hours = 'id="id_12hours"';		
$display_24 = "";
$display_12 = "";
if ($show_hourformat == 24){
	$display_24 = "";
	$display_12 = "display: none;";
}
if($show_hourformat == 12){
	$display_24 = "display: none;";
	$display_12 = "";
	$id_12hours = 'id="defaultOpen"';
	$id_24hours = 'id="id_24hours"';
}

// Simplified public form: keep only the 24-hour selector visible.
$id_24hours = 'id="defaultOpen"';
$id_12hours = 'id="id_12hours"';
$display_24 = "";
$display_12 = "display: none;";
//Chart type: 0, 1 or 2 - radix, radix + transit, or vedic (north style)		
$options['byblos_select_field_chart_type'] = empty( $options['byblos_select_field_chart_type'] ) ? 0 : $options['byblos_select_field_chart_type'];
$chart_type = $options['byblos_select_field_chart_type'];		
		
$tetra_url = plugins_url('Tetrabyblos');		
		
?>
<link rel="stylesheet" href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<style>
@font-face {
font-family: 'HamburgSymbols';
src: url('<?php echo plugins_url('Tetrabyblos') ?>/css/HamburgSymbols.ttf');
}
@font-face {
font-family: 'Merriweather';
src: url('<?php echo plugins_url('Tetrabyblos') ?>/css/Merriweather-Regular.ttf');
}
.ui-autocomplete.ui-widget {
  font-family:"Merriweather", Merriweather, serif;
  font-size: 15px;
}
.ui-autocomplete-loading {
    background: white url("<?php echo plugins_url('Tetrabyblos') ?>/images/progress.gif") right center no-repeat;
  }
.ui-widget {
  font-family:"Merriweather", Merriweather, serif;
  font-size: 15px;
}

[class*="tetra-col-"] {
    width: 70%;	
}
	


.tetra-h1{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 2em;
	}	
.tetra-h2{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 1.5em;
	}	
.tetra-h3{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 1.17em;
	}	
.tetra-h4{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 1em;
	}	
.tetra-h5{font-family: "Merriweather", Merriweather, sans-serif;}	
.tetra-h6{font-family: "Merriweather", Merriweather, sans-serif;}	
.tetra-tr{font-family: "Merriweather", Merriweather, sans-serif;}	
.tetra-th{font-family: "Merriweather", Merriweather, sans-serif;}
.tetra-font{
	font-family: "Merriweather", Merriweather, sans-serif;
	}

.tetra-font-mobile{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 12px;
	}
	
	.table-no-border {
		 border: none;
	}	
@media only screen and (max-width: 400px) {

.w3-select {
height: 35px;
font-size: 8px;
}
}

	
	
@media only screen and (min-width: 768px) {

	}

.modal {
    display: none; 
    position: fixed; 
    z-index: 9999!important; 
    padding-top: 5px; 
    left: 0px;
    top: 0px;
    width: 100%; 
    height: 100%; 
    overflow: hidden;
    
    background-color: rgba(0,0,0,0.4);  
	  background-color: rgb(255,255,255); 
    background-color: rgba(255,255,255,0.95); 
	  border: 1px solid grey;
}
.modal-content {
    margin: 5px 5px 5px 5px;;
    display: block;
    width: 80%;
    max-width: 750px;
}
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}
.modal-content, #caption {
    animation-name: zoom;
    animation-duration: 0.6s;
}
@keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
}
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: darkgray; 
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}
.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}
@media only screen and (max-width: 600px){
    .modal-content {
        width: 100%;
    }
	.main_astro_div {
		width: 95%;
		font-size: 1em;
	}
	.myDIV2 {
		width: 95%;
		font-size: 1em;
	}
	.myTetra {
		width: 95%;
		font-size: 1em;
	}
	.tetra-font-mobile {
		font-size: 0.7em;
	}
	.tetra-h1{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 1.5em;
	}	
    .tetra-h2{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 1.125em;
	}	
    .tetra-h3{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 0.877em;
	font-weight: bold;
	}	
    .tetra-h4{
	font-family: "Merriweather", Merriweather, sans-serif;
	font-size: 0.75em;
	}	
	
	
}
@media only screen and (min-width: 768px){
    .modal-content {
        width: 100%;
    }
	.w3-content {max-width: 500px;}
	.w3-container {max-width: 550px;}
	.myTetra {
		width: 720px;

	}
	.tetra-font-mobile {
		font-size: <?php echo $scale; ?>em;
	}

}
</style>



<?php
$options = get_option( 'byblos_settings' );
$options['byblos_text_field_title_1_1'] = empty( $options['byblos_text_field_title_1_1'] ) ? "&Omega; - Resultados de la Carta Natal" : $options['byblos_text_field_title_1_1'];
$title_1_1 = $options['byblos_text_field_title_1_1'];
if ( $title_1_1 === '&Omega; - Natal Chart Results' ) {
	$title_1_1 = '&Omega; - Resultados de la Carta Natal';
}	
	
$options['byblos_checkbox_field_bnow'] = empty( $options['byblos_checkbox_field_bnow'] ) ? 0 : 1;		
$bnow = $options['byblos_checkbox_field_bnow'];

$options['byblos_checkbox_field_print'] = empty( $options['byblos_checkbox_field_print'] ) ? 0 : 1;		
$bprint = $options['byblos_checkbox_field_print'];
	
?>	
	
<script type="text/javascript">jQuery(document).ready(function($){function tetraawen(){var x=document.myForm.year.value;var y=document.myForm.era.value;var v=x*y;if(v< -10000||v>10000){return false;}else{return true;}};function tetraaQen(lat,lng,tz,loc){var convertLat=Math.abs(lat);var LatDeg=Math.floor(convertLat);var LatMin=(Math.floor((convertLat-LatDeg)*60));var LatCardinal=((lat>0)?1: -1);var convertLng=Math.abs(lng);var LngDeg=Math.floor(convertLng);var LngMin=(Math.floor((convertLng-LngDeg)*60));var LngCardinal=((lng>0)?1: -1);document.getElementById("lat_deg").value=LatDeg;document.getElementById("lat_min").value=LatMin;document.getElementById("long_deg").value=LngDeg;document.getElementById("long_min").value=LngMin;document.getElementById("ns").value=LatCardinal;document.getElementById("ew").value=LngCardinal;document.getElementById("timezone").value=tz;document.getElementById("full_name").value=loc;document.getElementById("zoneoffset").value="99";return;};jQuery(function(){var getData=function(request,response){$jq.getJSON("<?php echo plugins_url('Tetrabyblos') ?>/data/getautocomplete.php?jsonp=?",{term:request.term,country_id:document.getElementById("country_id").value,atlas:document.getElementById("atlas").value},function(data){response(data);l=document.getElementById("cname").value;len=l.length;if(data.length===0&&len>0){$("#empty-message").html("<?php echo $translate_json['No results were found so please input a nearby city'] ?>");}else{$("#empty-message").empty("<i><?php echo $translate_json['Longitude, latitude and timezone are automatically calculated from birth place'] ?>.</i>");}});};var selectItem=function(event,ui){$("#cname").val(ui.item.label);$("#full_name").val(ui.item.label);$("#latitude").val(ui.item.latitude);$("#longitude").val(ui.item.longitude);$("#timezone").val(ui.item.timezone);document.getElementById("empty-message").innerHTML="<i><?php echo $translate_json['Longitude, latitude and timezone are automatically calculated from birth place'] ?>.</i>";tetraaQen(ui.item.latitude,ui.item.longitude,ui.item.timezone,ui.item.label);return false;};$("#cname").autocomplete({source:getData,select:selectItem,minLength:3,change:function(){}});});}); </script>
<span style="font-family: HamburgSymbols; color: #FFF; font-weight: bold;visibility: hidden;"></span> 
<span style="font-family: Merriweather; color: #FFF; font-weight: bold;visibility: hidden;"></span>

<div class="w3-content" name="main_astro_div" id="main_astro_div" style ="background-color: white;padding: 10px;border: 0px solid grey;border-radius: 15px;">
<div id="enter_name" name="enter_name"></div>
<div class="w3-row-padding tetra-font">
  <div class="w3-half">
    <input class="w3-input w3-border tetra-font" type="text" name="name" id="name" style="width: 100%;" placeholder="Nombre">
    <div id="name_error" name="name_error" class="tetra-font-mobile"></div>
  </div>
  <div class="w3-half">
    <input class="w3-input w3-border tetra-font" type="email" name="email" id="email" style="width: 100%;" placeholder="Correo electrónico">
    <div id="email_error" name="email_error" class="tetra-font-mobile"></div>
  </div>
</div>
<br>
	
<h3 class="tetra-h3"><?php echo $translate_json["Birth time"]; ?>:</h3>
<br>
<script>function tetraaven(obj){if($(obj).is(":checked")){var tth=document.getElementById("hour");tth.value=12;var ttm=document.getElementById("minute");ttm.value=0;tetraeen();$("#page-header-inner").addClass("sticky");}else{var tth=document.getElementById("hour");tth.value=0;var ttm=document.getElementById("minute");ttm.value=0;tetraeen();}} </script>
<input class="tetra-font" type="checkbox" name="TT_sticky_header" id="TT_sticky_header_function" value="{TT_sticky_header}" onchange="tetraaven(this)"/> <?php echo $translate_json['Unknow time birth']; ?><br><br>


<div class="tab tetra-h3" style="display: none;">
  <button class="tablinks" style="width: 50%;<?php echo $display_24; ?>" onclick="openTab(event,'European')" <?php echo $id_24hours; ?>><?php echo $translate_json["24 hours style"]; ?></button>
  <button class="tablinks" style="width: 50%;<?php echo $display_12; ?>" onclick="openTab(event,'AM/PM')" <?php echo $id_12hours; ?>><?php echo $translate_json["12 hours style (AM/PM)"]; ?></button>
</div>
	
<div id="European" class="tabcontent tetra-font">
 <div class="w3-row-padding">
  <div class="w3-half">
    <label class="tetra-font-mobile"><?php echo $translate_json["Hours (0 to 23)"]; ?>:</label>
<select class="w3-select w3-border" name="hour" id="hour" onchange="javascript:tetraeen();">
<?php generate_options(0,23,0); ?>
</select> 
  </div>
  <div class="w3-half">
    <label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label>
<select class="w3-select w3-border" name="minute" id="minute" onchange="javascript:tetraeen();">
<?php generate_options(0,59,0); ?>
</select> 
  </div>
</div>
<br>
</div>
<div id="AM/PM" class="tabcontent tetra-font">
 <div class="w3-row-padding">
  <div class="w3-third">
    <label class="tetra-font-mobile"><?php echo $translate_json["Hours (1 to 12)"]; ?>:</label>
<select class="w3-select w3-border" name="hour_american" id="hour_american" onchange="javascript:tetraeen();">
<?php generate_options(1,12,1); ?>
</select> 
  </div>
  <div class="w3-third">
    <label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label>
<select class="w3-select w3-border" name="minute_american" id="minute_american" onchange="javascript:tetraeen();" >
<?php generate_options(0,59,1); ?>
</select> 
  </div>
  <div class="w3-third">
    <label class="tetra-font-mobile">AM/PM</label>
    <select class="w3-select w3-border" name="ampm_american" id="ampm_american" onchange="javascript:tetraeen();" >
    <option value="0" selected>A.M.</option>
    <option value="1">P.M</option>
    </select>
  </div>
  
</div>	
<br>
</div>

<?php 
if($bnow < 1){
?>
<br>
  <div class='w3-center'>
  	<div class='w3-bar'>
  		<p>
  			<button class='<?php echo $tetra_button_style; ?>' name='now_button' id='now_button' style='display: none;font-family: Merriweather;' onclick='javascript:tetraaqen();'><?php echo $translate_json["Now"]; ?></button>
  		</p>
  	</div>
  </div>  
<?php
}
?>
	
<script>function tetraaqen(){var d=new Date();var x=document.getElementById("hour");x.value=d.getHours();var y=document.getElementById("minute");y.value=d.getMinutes();var hh=x.value;var mm=y.value;var ampm=0;if(hh>12){hh-=12;ampm=1;if(hh==0){hh=12;}}if(hh==0){hh=12;ampm=1;}document.getElementById('hour_american').value=hh;document.getElementById('minute_american').value=mm;document.getElementById('ampm_american').value=ampm;} </script>
<br>
<h3 class="tetra-h3"><?php echo $translate_json["Birth date"]; ?>:</h3>
<br>
 <div class="w3-row-padding tetra-font">
  <div class="w3-half">
    <label class="tetra-font-mobile"><?php echo $translate_json["Day"]; ?>:</label>
<select class="w3-select w3-border" name="day" id="day">
<?php generate_options(1,31,1); ?>
</select> 
  </div>
  <div class="w3-half">
    <label class="tetra-font-mobile"><?php echo $translate_json["Month"]; ?>:</label>
      <select class="w3-select w3-border" name="month" id="month">
      <option value="1" selected><?php echo $translate_json["January"]; ?></option>
      <option value="2"><?php echo $translate_json["February"]; ?></option>
      <option value="3"><?php echo $translate_json["March"]; ?></option>
      <option value="4"><?php echo $translate_json["April"]; ?></option>
      <option value="5"><?php echo $translate_json["May"]; ?></option>
      <option value="6"><?php echo $translate_json["June"]; ?></option>
      <option value="7"><?php echo $translate_json["July"]; ?></option>
      <option value="8"><?php echo $translate_json["August"]; ?></option>
      <option value="9"><?php echo $translate_json["September"]; ?></option>
      <option value="10"><?php echo $translate_json["October"]; ?></option>
      <option value="11"><?php echo $translate_json["November"]; ?></option>
      <option value="12"><?php echo $translate_json["December"]; ?></option>
      </select> 
  </div>
	 
</div> 
<br>
	
 <div class="w3-row-padding tetra-font">
  <div class="w3-half tetra-font">
    <label class="tetra-font-mobile"><?php echo $translate_json["Year"]; ?>:</label>
    <input class="w3-input w3-border" type="text" name="year" id="year" value="1999">
  </div>  
  <div class="w3-half tetra-font" style="display: none;">
    <label class="tetra-font-mobile"><?php echo $translate_json["Era"]; ?>:</label>
    <select class="w3-select w3-border" name="era" id="era">
    <option value="1" selected><?php echo $translate_json["AD - Anno Domini"]; ?></option>
    <option value="-1"><?php echo $translate_json["BC - Before Christ"]; ?></option>
    </select>
  </div>
</div>

<?php 
if($bnow < 1){
?>	
<br>
  <div class='w3-center'>
  	<div class='w3-bar'>
  		<p>
  			<button class='<?php echo $tetra_button_style; ?>' name='now_date_button' id='now_date_button' style='display: none;font-family: Merriweather;' onclick='javascript:tetrabLen();'><?php echo $translate_json["Now"]; ?></button>
  		</p>
  	</div>
  </div>  
<?php
}
?>	
	
<script>function tetrabLen(){var d=new Date();var x1=document.getElementById("day");x1.value=d.getDate();var y1=document.getElementById("month");y1.value=d.getMonth()+1;var z1=document.getElementById("year");z1.value=d.getFullYear();var z2=document.getElementById("era");z2.value=1;} </script>
<br>

<input type="hidden" name="era" id="era" value="1">
<br>
<br>
<div class="tab tetra-font" style="display: none;">
  <button class="tablinks2" style="width: 50%;" onclick="tetraXen(event,'birthcity')" id="defaultOpen2"><?php echo $translate_json["City of birth"]; ?></button>
  <button class="tablinks2" style="width: 50%;" onclick="tetraXen(event,'birthcoordinates')"><?php echo $translate_json["Manual Coordinates"]; ?></button>
</div>
<div id="birthcity" class="tabcontent2">	
	
<h3 class="tetra-h3"><?php echo $translate_json["Country"]; ?>:</h3><br>
<select class="w3-select w3-border tetra-font" name="country_id" id="country_id" onchange="javascript:document.getElementById('cname').value=''">
<option value = "AF">Afghanistan</option>
<option value = "AX">Aland Islands</option>
<option value = "AL">Albania</option>
<option value = "DZ">Algeria</option>
<option value = "AS">American Samoa</option>
<option value = "AD">Andorra</option>
<option value = "AO">Angola</option>
<option value = "AI">Anguilla</option>
<option value = "AQ">Antarctica</option>
<option value = "AG">Antigua and Barbuda</option>
<option value = "AR">Argentina</option>
<option value = "AM">Armenia</option>
<option value = "AW">Aruba</option>
<option value = "AU">Australia</option>
<option value = "AT">Austria</option>
<option value = "AZ">Azerbaijan</option>
<option value = "BS">Bahamas</option>
<option value = "BH">Bahrain</option>
<option value = "BD">Bangladesh</option>
<option value = "BB">Barbados</option>
<option value = "BY">Belarus</option>
<option value = "BE">Belgium</option>
<option value = "BZ">Belize</option>
<option value = "BJ">Benin</option>
<option value = "BM">Bermuda</option>
<option value = "BT">Bhutan</option>
<option value = "BO">Bolivia</option>
<option value = "BQ">Bonaire, Saint Eustatius and Saba </option>
<option value = "BA">Bosnia and Herzegovina</option>
<option value = "BW">Botswana</option>
<option value = "BV">Bouvet Island</option>
<option value = "BR">Brazil</option>
<option value = "IO">British Indian Ocean Territory</option>
<option value = "VG">British Virgin Islands</option>
<option value = "BN">Brunei</option>
<option value = "BG">Bulgaria</option>
<option value = "BF">Burkina Faso</option>
<option value = "BI">Burundi</option>
<option value = "KH">Cambodia</option>
<option value = "CM">Cameroon</option>
<option value = "CA">Canada</option>
<option value = "CV">Cape Verde</option>
<option value = "KY">Cayman Islands</option>
<option value = "CF">Central African Republic</option>
<option value = "TD">Chad</option>
<option value = "CL">Chile</option>
<option value = "CN">China</option>
<option value = "CX">Christmas Island</option>
<option value = "CC">Cocos Islands</option>
<option value = "CO" selected>Colombia</option>
<option value = "KM">Comoros</option>
<option value = "CK">Cook Islands</option>
<option value = "CR">Costa Rica</option>
<option value = "HR">Croatia</option>
<option value = "CU">Cuba</option>
<option value = "CW">Curacao</option>
<option value = "CY">Cyprus</option>
<option value = "CZ">Czech Republic</option>
<option value = "CD">Democratic Republic of the Congo</option>
<option value = "DK">Denmark</option>
<option value = "DJ">Djibouti</option>
<option value = "DM">Dominica</option>
<option value = "DO">Dominican Republic</option>
<option value = "TL">East Timor</option>
<option value = "EC">Ecuador</option>
<option value = "EG">Egypt</option>
<option value = "SV">El Salvador</option>
<option value = "GQ">Equatorial Guinea</option>
<option value = "ER">Eritrea</option>
<option value = "EE">Estonia</option>
<option value = "ET">Ethiopia</option>
<option value = "FK">Falkland Islands</option>
<option value = "FO">Faroe Islands</option>
<option value = "FJ">Fiji</option>
<option value = "FI">Finland</option>
<option value = "FR">France</option>
<option value = "GF">French Guiana</option>
<option value = "PF">French Polynesia</option>
<option value = "TF">French Southern Territories</option>
<option value = "GA">Gabon</option>
<option value = "GM">Gambia</option>
<option value = "GE">Georgia</option>
<option value = "DE">Germany</option>
<option value = "GH">Ghana</option>
<option value = "GI">Gibraltar</option>
<option value = "GR">Greece</option>
<option value = "GL">Greenland</option>
<option value = "GD">Grenada</option>
<option value = "GP">Guadeloupe</option>
<option value = "GU">Guam</option>
<option value = "GT">Guatemala</option>
<option value = "GG">Guernsey</option>
<option value = "GN">Guinea</option>
<option value = "GW">Guinea-Bissau</option>
<option value = "GY">Guyana</option>
<option value = "HT">Haiti</option>
<option value = "HM">Heard Island and McDonald Islands</option>
<option value = "HN">Honduras</option>
<option value = "HK">Hong Kong</option>
<option value = "HU">Hungary</option>
<option value = "IS">Iceland</option>
<option value = "IN">India</option>
<option value = "ID">Indonesia</option>
<option value = "IR">Iran</option>
<option value = "IQ">Iraq</option>
<option value = "IE">Ireland</option>
<option value = "IM">Isle of Man</option>
<option value = "IL">Israel</option>
<option value = "IT">Italy</option>
<option value = "CI">Ivory Coast</option>
<option value = "JM">Jamaica</option>
<option value = "JP">Japan</option>
<option value = "JE">Jersey</option>
<option value = "JO">Jordan</option>
<option value = "KZ">Kazakhstan</option>
<option value = "KE">Kenya</option>
<option value = "KI">Kiribati</option>
<option value = "XK">Kosovo</option>
<option value = "KW">Kuwait</option>
<option value = "KG">Kyrgyzstan</option>
<option value = "LA">Laos</option>
<option value = "LV">Latvia</option>
<option value = "LB">Lebanon</option>
<option value = "LS">Lesotho</option>
<option value = "LR">Liberia</option>
<option value = "LY">Libya</option>
<option value = "LI">Liechtenstein</option>
<option value = "LT">Lithuania</option>
<option value = "LU">Luxembourg</option>
<option value = "MO">Macao</option>
<option value = "MK">Macedonia</option>
<option value = "MG">Madagascar</option>
<option value = "MW">Malawi</option>
<option value = "MY">Malaysia</option>
<option value = "MV">Maldives</option>
<option value = "ML">Mali</option>
<option value = "MT">Malta</option>
<option value = "MH">Marshall Islands</option>
<option value = "MQ">Martinique</option>
<option value = "MR">Mauritania</option>
<option value = "MU">Mauritius</option>
<option value = "YT">Mayotte</option>
<option value = "MX">Mexico</option>
<option value = "FM">Micronesia</option>
<option value = "MD">Moldova</option>
<option value = "MC">Monaco</option>
<option value = "MN">Mongolia</option>
<option value = "ME">Montenegro</option>
<option value = "MS">Montserrat</option>
<option value = "MA">Morocco</option>
<option value = "MZ">Mozambique</option>
<option value = "MM">Myanmar</option>
<option value = "NA">Namibia</option>
<option value = "NR">Nauru</option>
<option value = "NP">Nepal</option>
<option value = "NL">Netherlands</option>
<option value = "AN">Netherlands Antilles</option>
<option value = "NC">New Caledonia</option>
<option value = "NZ">New Zealand</option>
<option value = "NI">Nicaragua</option>
<option value = "NE">Niger</option>
<option value = "NG">Nigeria</option>
<option value = "NU">Niue</option>
<option value = "NF">Norfolk Island</option>
<option value = "KP">North Korea</option>
<option value = "MP">Northern Mariana Islands</option>
<option value = "NO">Norway</option>
<option value = "OM">Oman</option>
<option value = "PK">Pakistan</option>
<option value = "PW">Palau</option>
<option value = "PS">Palestinian Territory</option>
<option value = "PA">Panama</option>
<option value = "PG">Papua New Guinea</option>
<option value = "PY">Paraguay</option>
<option value = "PE">Peru</option>
<option value = "PH">Philippines</option>
<option value = "PN">Pitcairn</option>
<option value = "PL">Poland</option>
<option value = "PT">Portugal</option>
<option value = "PR">Puerto Rico</option>
<option value = "QA">Qatar</option>
<option value = "CG">Republic of the Congo</option>
<option value = "RE">Reunion</option>
<option value = "RO">Romania</option>
<option value = "RU">Russia</option>
<option value = "RW">Rwanda</option>
<option value = "BL">Saint Barthelemy</option>
<option value = "SH">Saint Helena</option>
<option value = "KN">Saint Kitts and Nevis</option>
<option value = "LC">Saint Lucia</option>
<option value = "MF">Saint Martin</option>
<option value = "PM">Saint Pierre and Miquelon</option>
<option value = "VC">Saint Vincent and the Grenadines</option>
<option value = "WS">Samoa</option>
<option value = "SM">San Marino</option>
<option value = "ST">Sao Tome and Principe</option>
<option value = "SA">Saudi Arabia</option>
<option value = "SN">Senegal</option>
<option value = "RS">Serbia</option>
<option value = "CS">Serbia and Montenegro</option>
<option value = "SC">Seychelles</option>
<option value = "SL">Sierra Leone</option>
<option value = "SG">Singapore</option>
<option value = "SX">Sint Maarten</option>
<option value = "SK">Slovakia</option>
<option value = "SI">Slovenia</option>
<option value = "SB">Solomon Islands</option>
<option value = "SO">Somalia</option>
<option value = "ZA">South Africa</option>
<option value = "GS">South Georgia and the South Sandwich Islands</option>
<option value = "KR">South Korea</option>
<option value = "SS">South Sudan</option>
<option value = "ES">Spain</option>
<option value = "LK">Sri Lanka</option>
<option value = "SD">Sudan</option>
<option value = "SR">Suriname</option>
<option value = "SJ">Svalbard and Jan Mayen</option>
<option value = "SZ">Swaziland</option>
<option value = "SE">Sweden</option>
<option value = "CH">Switzerland</option>
<option value = "SY">Syria</option>
<option value = "TW">Taiwan</option>
<option value = "TJ">Tajikistan</option>
<option value = "TZ">Tanzania</option>
<option value = "TH">Thailand</option>
<option value = "TG">Togo</option>
<option value = "TK">Tokelau</option>
<option value = "TO">Tonga</option>
<option value = "TT">Trinidad and Tobago</option>
<option value = "TN">Tunisia</option>
<option value = "TR">Turkey</option>
<option value = "TM">Turkmenistan</option>
<option value = "TC">Turks and Caicos Islands</option>
<option value = "TV">Tuvalu</option>
<option value = "VI">U.S. Virgin Islands</option>
<option value = "UG">Uganda</option>
<option value = "UA">Ukraine</option>
<option value = "AE">United Arab Emirates</option>
<option value = "GB">United Kingdom</option>
<option value = "US">United States</option>
<option value = "UM">United States Minor Outlying Islands</option>
<option value = "UY">Uruguay</option>
<option value = "UZ">Uzbekistan</option>
<option value = "VU">Vanuatu</option>
<option value = "VA">Vatican</option>
<option value = "VE">Venezuela</option>
<option value = "VN">Vietnam</option>
<option value = "WF">Wallis and Futuna</option>
<option value = "EH">Western Sahara</option>
<option value = "YE">Yemen</option>
<option value = "ZM">Zambia</option>
<option value = "ZW">Zimbabwe</option>
</select>
<script>
(function() {
    var countrySelect = document.getElementById('country_id');
    if (countrySelect && typeof Intl !== 'undefined' && Intl.DisplayNames) {
        var nombresPaises = new Intl.DisplayNames(['es'], { type: 'region' });
        Array.prototype.forEach.call(countrySelect.options, function(option) {
            if (option.value) {
                var nombre = nombresPaises.of(option.value);
                if (nombre) {
                    option.text = nombre;
                }
            }
        });
    }
})();
</script>
<br>
<br>
<h3 class="tetra-h3"><?php echo $translate_json["Birth City"]; ?>:</h3>
<div class="ui-widget tetra-font" style="width: 100%;">
<input class="w3-input w3-border" type="text" id="cname">
</div>
<br><p id="empty-message" class="tetra-font-mobile" style="font-size: 12px;text-align: justify;"><i><?php echo $translate_json['Longitude, latitude and timezone are automatically calculated from birth place'] ?>.</i></p>
<input type="hidden" name="atlas" id="atlas" value="0"> 
<br>
<br>
</div>
	
<div id="birthcoordinates" class="tabcontent2" style="display: none;">
	
<h3 class="tetra-h3"><?php echo $translate_json["Time zone"]; ?>:</h3><br>
<select class="w3-select w3-border tetra-font" name="zoneoffset" id="zoneoffset">
<option value="99" selected="selected"> <?php echo $translate_json["Auto detect from location"]; ?> </option>
<option value="0">Greenwich Mean Time - GMT or UT</option>
<option value="-12">GMT -12:00 hrs - IDLW</option><option value="-11">GMT -11:00 hrs - BET or NT</option>
<option value="-10.5">GMT -10:30 hrs - HST</option><option value="-10">GMT -10:00 hrs - AHST</option>
<option value="-9.5">GMT -09:30 hrs - HDT or HWT</option>
<option value="-9">GMT -09:00 hrs - YST or AHDT or AHWT</option>
<option value="-8">GMT -08:00 hrs - PST or YDT or YWT</option>
<option value="-7">GMT -07:00 hrs - MST or PDT or PWT</option>
<option value="-6">GMT -06:00 hrs - CST or MDT or MWT</option>
<option value="-5">GMT -05:00 hrs - EST or CDT or CWT</option>
<option value="-4">GMT -04:00 hrs - AST or EDT or EWT</option>
<option value="-3.5">GMT -03:30 hrs - NST</option>
<option value="-3">GMT -03:00 hrs - BZT2 or AWT</option>
<option value="-2">GMT -02:00 hrs - AT</option>
<option value="-1">GMT -01:00 hrs - WAT</option>
<option value="1">GMT +01:00 hrs - CET or MET or BST</option>
<option value="2">GMT +02:00 hrs - EET or CED or MED or BDST or BWT</option>
<option value="3">GMT +03:00 hrs - BAT or EED</option>
<option value="3.5">GMT +03:30 hrs - IT</option>
<option value="4">GMT +04:00 hrs - USZ3</option>
<option value="5">GMT +05:00 hrs - USZ4</option>
<option value="5.5">GMT +05:30 hrs - IST</option>
<option value="6">GMT +06:00 hrs - USZ5</option>
<option value="6.5">GMT +06:30 hrs - NST</option>
<option value="7">GMT +07:00 hrs - SST or USZ6</option>
<option value="7.5">GMT +07:30 hrs - JT</option>
<option value="8">GMT +08:00 hrs - AWST or CCT</option>
<option value="8.5">GMT +08:30 hrs - MT</option>
<option value="9">GMT +09:00 hrs - JST or AWDT</option>
<option value="9.5">GMT +09:30 hrs - ACST or SAT or SAST</option>
<option value="10">GMT +10:00 hrs - AEST or GST</option>
<option value="10.5">GMT +10:30 hrs - ACDT or SDT or SAD</option>
<option value="11">GMT +11:00 hrs - UZ10 or AEDT</option>
<option value="11.5">GMT +11:30 hrs - NZ</option>
<option value="12">GMT +12:00 hrs - NZT or IDLE</option>
<option value="12.5">GMT +12:30 hrs - NZS</option>
<option value="13">GMT +13:00 hrs - NZST</option>
</select> 
<br>
<br>
<h3 class="tetra-h3"><?php echo $translate_json["Latitude"]; ?>:</h3>
<br>
 <div class="w3-row-padding tetra-font">
  <div class="w3-third">
  	<label class="tetra-font-mobile"><?php echo $translate_json["Degrees"]; ?>:</label>
<select class="w3-select w3-border" name="lat_deg" id="lat_deg">
<?php generate_options(0,90,0); ?>
</select> 
  </div>
  <div class="w3-third tetra-font">
  	<label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label>
<select class="w3-select w3-border" name="lat_min" id="lat_min">
<?php generate_options(0,59,0); ?>
</select>
  </div>
  <div class="w3-third tetra-font">
  	<label class="tetra-font-mobile"><?php echo $translate_json["North"]; ?>/<?php echo $translate_json["South"]; ?>:</label>
<select class="w3-select w3-border" name="ns" id="ns">
<option value="1"><?php echo $translate_json["North"]; ?></option>
<option value="-1"><?php echo $translate_json["South"]; ?></option>
</select>
  </div>
</div> 
<br>
<br>
<h3 class="tetra-h3"><?php echo $translate_json["Longitude"]; ?>:</h3>
<br>
 <div class="w3-row-padding tetra-font">
  <div class="w3-third">
  	<label class="tetra-font-mobile"><?php echo $translate_json["Degrees"]; ?>:</label>
<select class="w3-select w3-border" name="long_deg" id="long_deg">
<?php generate_options(0,180,0); ?>
</select>
  </div>
  <div class="w3-third">
  	<label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label>
<select class="w3-select w3-border" name="long_min" id="long_min">
<?php generate_options(0,59,0); ?>
</select>
  </div>
  <div class="w3-third">
  	<label class="tetra-font-mobile"><?php echo $translate_json["East"]; ?>/<?php echo $translate_json["West"]; ?>:</label>
<select class="w3-select w3-border" name="ew" id="ew">
<option value="1" selected><?php echo $translate_json["East"]; ?></option>
<option value="-1"><?php echo $translate_json["West"]; ?></option>
</select>
  </div>
</div> 
<br>
<br>
</div>
<div id="city_error" name="city_error">	</div>
<?php
$options = get_option( 'byblos_settings' );
$show = $options['byblos_select_field_2'];
if(!$show){
   $show = get_option($options['byblos_select_field_2'], 0);
   $show = 0;
}
if($show > 0){
	$show = "block";
} else {
	$show = "none";
}
?>

<script>function myShow(id){var x=document.getElementById(id);if(x.className.indexOf("w3-show")== -1){x.className+=" w3-show";}else{x.className=x.className.replace(" w3-show","");}} </script>
<br><br>
<div id="advanced" name="advanced" style="display: none;" >
<center><input type="button" onclick="myShow('showOpt')" class="<?php echo $tetra_button_style_2; ?>" id="terms" style="width: 60%;font-size: 12px;" value="<?php echo $translate_json['Advanced options']; ?>"></center>
<div id="showOpt" class="w3-container w3-hide">
	
<br>
<h3 class="tetra-h3"><?php echo $translate_json["House System"]; ?>:</h3><br>
<select class="w3-select w3-border tetra-font" name="h_sys" id="h_sys">
<option value="0" selected="selected">Placidus</option>
<option value="13">Alcabitus</option>
<option value="1">Campanus</option>
<option value="11">Equal house - Asc.</option>
<option value="2">Equal House - Whole sign</option>
<option value="9">Koch</option>
<option value="7">Morinus</option>
<option value="8">Meridian</option>
<option value="6">Porphyrius</option>
<option value="14">Neo-Porphyrius</option>
<option value="3">Vedic</option>
<option value="5">Regiomontanus</option>
<option value="4">Topocentric</option>
</select> 
<br>
<br>
<h3 class="tetra-h3"><?php echo $translate_json["Zodiac"]; ?>:</h3><br>
<select class="w3-select w3-border tetra-font" name="zodiac" id="zodiac">
<option selected="selected" value="-1"><?php echo $translate_json["Western - Tropical"]; ?></option>
<option value="0"><?php echo $translate_json["Sidereal"]; ?> - Fagan/Bradley</option>
<option value="1"><?php echo $translate_json["Sidereal"]; ?> - Lahiri</option>
<option value="2"><?php echo $translate_json["Sidereal"]; ?> - DeLuce</option>
<option value="3"><?php echo $translate_json["Sidereal"]; ?> - B.V. Raman</option>
<option value="4"><?php echo $translate_json["Sidereal"]; ?> - Usha/Shashi</option>
<option value="5"><?php echo $translate_json["Sidereal"]; ?> - Krishnamurti</option>
<option value="6"><?php echo $translate_json["Sidereal"]; ?> - Djwhal Khool</option>
<option value="7"><?php echo $translate_json["Sidereal"]; ?> - Shri Yukteshwar</option>
<option value="8"><?php echo $translate_json["Sidereal"]; ?> - J.N. Bhasin</option>
<option value="9"><?php echo $translate_json["Sidereal"]; ?> - Hipparchos</option>
<option value="10"><?php echo $translate_json["Sidereal"]; ?> - Sassanian</option>
<option value="12"><?php echo $translate_json["Sidereal"]; ?> - J1900</option>
<option value="13"><?php echo $translate_json["Sidereal"]; ?> - B1950</option>
</select>
</div>
</div>
<?php
?>
	
<input id="timezone" name="timezone" type="hidden" value="UTC"/>
<input id="latitude" name="latitude" type="hidden"/>
<input id="longitude" name="longitude" type="hidden"/>
<input id="full_name" name="full_name" type="hidden"/>
<input id="lang" name="lang" type="hidden" value="es"/>
<input type="hidden" name="submitted" value="TRUE"/>

<br><br>
<div class="w3-center">
<div class="w3-bar">
<p><button class="<?php echo $tetra_button_style; ?>"  name="create" id="create" onclick="javascript:tetraaaen();"><?php echo $translate_json["Calculate Chart"]; ?></button></p>
</div>
</div>
<br>
<br>

</div> 



<p id='myStart' name='myStart'></p>

<div class="w3-container w3-center" id="myDIV2" name ="myDIV2" style="font-family:HamburgSymbols;margin: 0 auto;background-color: white;padding: 10px;border: 0px solid grey;border-radius: 15px;">
	

<div id="ismobile" name="ismobile" style="display:none;text-align: right;padding: 15px;">
<?php 
if($bprint < 1){
?>

<div class="w3-content" align="right">
<div align="center" style="width: 100px;">
<a href="javascript:tetraaMen()" alt=""><i class='material-icons' style="font-size: 60px;color: #bfbfbf;">print</i></a><br><font face='Merriweather' size='2'>Imprimir</font><br>
</div>
</div>
<?php
}				
?>
</div>


<div id="myResults" style="margin: 0 auto;background-color: white;"></div>	

<div id="myModal" class="modal" style="width: 700px; height: 700px;">
  
  <span class="close">&times;</span>
  
  <img class="modal-content" id="img01" width="720" height="720">
  
  <div id="caption"></div>
</div>




<div id="myPrint" name="myPrint">
<?php echo $html_output; ?>
</div>	

	

	

	


<script>(function(astrology){astrology.COLORS_USER=[];astrology.COLOR_ARIES=astrology_COLOR_ARIES;astrology.COLOR_TAURUS=astrology_COLOR_TAURUS;astrology.COLOR_GEMINI=astrology_COLOR_GEMINI;astrology.COLOR_CANCER=astrology_COLOR_CANCER;astrology.COLOR_LEO=astrology_COLOR_LEO;astrology.COLOR_VIRGO=astrology_COLOR_VIRGO;astrology.COLOR_LIBRA=astrology_COLOR_LIBRA;astrology.COLOR_SCORPIO=astrology_COLOR_SCORPIO;astrology.COLOR_SAGITTARIUS=astrology_COLOR_SAGITTARIUS;astrology.COLOR_CAPRICORN=astrology_COLOR_CAPRICORN;astrology.COLOR_AQUARIUS=astrology_COLOR_AQUARIUS;astrology.COLOR_PISCES=astrology_COLOR_PISCES;astrology.COLOR_SUN=astrology_COLOR_SUN;astrology.COLOR_MOON=astrology_COLOR_MOON;astrology.COLOR_MERCURY=astrology_COLOR_MERCURY;astrology.COLOR_VENUS=astrology_COLOR_VENUS;astrology.COLOR_MARS=astrology_COLOR_MARS;astrology.COLOR_JUPITER=astrology_COLOR_JUPITER;astrology.COLOR_SATURN=astrology_COLOR_SATURN;astrology.COLOR_URANUS=astrology_COLOR_URANUS;astrology.COLOR_NEPTUNE=astrology_COLOR_NEPTUNE;astrology.COLOR_PLUTO=astrology_COLOR_PLUTO;astrology.COLOR_ASC=astrology_COLOR_ASC;astrology.COLOR_MC=astrology_COLOR_MC;astrology.COLOR_PLANETS=astrology_COLOR_PLANETS;astrology.COLOR_BACKGROUND=astrology_COLOR_BACKGROUND;astrology.SHOW_INNER_CIRCLE=astrology_SHOW_INNER_CIRCLE;astrology.COLOR_INNER_BACKGROUND=astrology_COLOR_INNER_BACKGROUND;astrology.COLOR_INNER_CIRCLE=astrology_COLOR_INNER_CIRCLE;var fire=astrology_COLOR_fire;var earth=astrology_COLOR_earth;var air=astrology_COLOR_air;var water=astrology_COLOR_water;var same_color="#000000";astrology.COLOR_SIGNS=[fire,earth,air,water,fire,earth,air,water,fire,earth,air,water,fire,earth,air,water];astrology.SYMBOL_SCALE=1;astrology.SIGN_SCALE=1;astrology.POINTS_COLOR="#000";astrology.POINTS_TEXT_SIZE=8;astrology.POINTS_STROKE=1.8;astrology.SIGNS_COLOR="#000";astrology.SIGNS_STROKE=1.5;astrology.MARGIN=50;astrology.PADDING=18;astrology.ID_CHART="astrology";astrology.ID_RADIX="radix";astrology.ID_TRANSIT="transit";astrology.ID_ASPECTS="aspects";astrology.ID_POINTS="planets";astrology.ID_SIGNS="signs";astrology.ID_CIRCLES="circles";astrology.ID_AXIS="axis";astrology.ID_CUSPS="cusps";astrology.ID_RULER="ruler";astrology.ID_BG="bg";astrology.CIRCLE_COLOR="#333";astrology.CIRCLE_STRONG=2;astrology.LINE_COLOR="#333";astrology.INDOOR_CIRCLE_RADIUS_RATIO=2.5;astrology.INNER_CIRCLE_RADIUS_RATIO=5;astrology.RULER_RADIUS=4;astrology.SYMBOL_SUN="Sun";astrology.SYMBOL_MOON="Moon";astrology.SYMBOL_MERCURY="Mercury";astrology.SYMBOL_VENUS="Venus";astrology.SYMBOL_MARS="Mars";astrology.SYMBOL_JUPITER="Jupiter";astrology.SYMBOL_SATURN="Saturn";astrology.SYMBOL_URANUS="Uranus";astrology.SYMBOL_NEPTUNE="Neptune";astrology.SYMBOL_PLUTO="Pluto";astrology.SYMBOL_CHIRON="Chiron";astrology.SYMBOL_LILITH="Lilith";astrology.SYMBOL_NNODE="NNode";astrology.SYMBOL_SNODE="SNode";astrology.SYMBOL_PFORTUNAE="PFortunae";astrology.SYMBOL_SICKNESS="sickness";astrology.SYMBOL_AS="As";astrology.SYMBOL_DS="Ds";astrology.SYMBOL_MC="Mc";astrology.SYMBOL_IC="Ic";astrology.SYMBOL_AXIS_FONT_COLOR="#333";astrology.SYMBOL_AXIS_STROKE=1.6;astrology.SYMBOL_CUSP_1="1";astrology.SYMBOL_CUSP_2="2";astrology.SYMBOL_CUSP_3="3";astrology.SYMBOL_CUSP_4="4";astrology.SYMBOL_CUSP_5="5";astrology.SYMBOL_CUSP_6="6";astrology.SYMBOL_CUSP_7="7";astrology.SYMBOL_CUSP_8="8";astrology.SYMBOL_CUSP_9="9";astrology.SYMBOL_CUSP_10="10";astrology.SYMBOL_CUSP_11="11";astrology.SYMBOL_CUSP_12="12";astrology.CUSPS_STROKE=1;astrology.CUSPS_FONT_COLOR="#000";astrology.SYMBOL_ARIES="Aries";astrology.SYMBOL_TAURUS="Taurus";astrology.SYMBOL_GEMINI="Gemini";astrology.SYMBOL_CANCER="Cancer";astrology.SYMBOL_LEO="Leo";astrology.SYMBOL_VIRGO="Virgo";astrology.SYMBOL_LIBRA="Libra";astrology.SYMBOL_SCORPIO="Scorpio";astrology.SYMBOL_SAGITTARIUS="Sagittarius";astrology.SYMBOL_CAPRICORN="Capricorn";astrology.SYMBOL_AQUARIUS="Aquarius";astrology.SYMBOL_PISCES="Pisces";astrology.SYMBOL_SIGNS=[astrology.SYMBOL_ARIES,astrology.SYMBOL_TAURUS,astrology.SYMBOL_GEMINI,astrology.SYMBOL_CANCER,astrology.SYMBOL_LEO,astrology.SYMBOL_VIRGO,astrology.SYMBOL_LIBRA,astrology.SYMBOL_SCORPIO,astrology.SYMBOL_SAGITTARIUS,astrology.SYMBOL_CAPRICORN,astrology.SYMBOL_AQUARIUS,astrology.SYMBOL_PISCES];astrology.COLORS_SIGNS=[astrology.COLOR_ARIES,astrology.COLOR_TAURUS,astrology.COLOR_GEMINI,astrology.COLOR_CANCER,astrology.COLOR_LEO,astrology.COLOR_VIRGO,astrology.COLOR_LIBRA,astrology.COLOR_SCORPIO,astrology.COLOR_SAGITTARIUS,astrology.COLOR_CAPRICORN,astrology.COLOR_AQUARIUS,astrology.COLOR_PISCES];astrology.SHIFT_IN_DEGREES=180;astrology.STROKE_ONLY=false;astrology.COLLISION_RADIUS=10;astrology.ASPECTS={"conjunction":{"degree":0,"orbit":10,"color":astrology_COLOR_CONJUNCTION},"sextile":{"degree":60,"orbit":8,"color":astrology_COLOR_SEXTILE},"square":{"degree":90,"orbit":8,"color":astrology_COLOR_SQUARE},"trine":{"degree":120,"orbit":8,"color":astrology_COLOR_TRINE},"opposition":{"degree":180,"orbit":10,"color":astrology_COLOR_OPPOSITION},};astrology.DIGNITIES_RULERSHIP="r";astrology.DIGNITIES_DETRIMENT="d";astrology.DIGNITIES_EXALTATION="e";astrology.DIGNITIES_EXACT_EXALTATION="E";astrology.DIGNITIES_FALL="f";astrology.DIGNITIES_EXACT_EXALTATION_DEFAULT=[{"name":"Sun","position":19},{"name":"Moon","position":33},{"name":"Mercury","position":155},{"name":"Venus","position":357},{"name":"Mars","position":298},{"name":"Jupiter","position":105},{"name":"Saturn","position":201},{"name":"NNode","position":63},];}(window.astrology=window.astrology||{})); </script>	
	
	
<div class="w3-content w3-center" id="myName" name="myName" style="margin: 0 auto;background-color: white; display: none;"></div>
<div class="w3-content w3-center" id="myNameDate" name="myNameDate" style="margin: 0 auto;background-color: white; display: none;"></div>

<div style="text-align: center;display: none;
 <canvas id="dp-kundali-chart-canvas" width="400px" height="267px"></canvas> 
</div>
	
<p></p>


<div id="myMS" name="myMS" class="tetra-font-mobile" style="text-align: justify;padding: 5px; display: none;"></div>



<div class="pagebreak"> </div>	
<div class="w3-content w3-center" id="myTransitsCalendar" name="myTransitsCalendar" style="display: none;"></div>
	
	
<div class="w3-content w3-center w3-padding-16" id="myData" name="myData" style="margin: 0 auto;background-color: white;display: none;"></div>
<div class="w3-content w3-center w3-padding-16" id="myData2" name="myData2" style="margin: 0 auto;background-color: white;display: none;"></div>	
<div class="w3-content w3-center w3-padding-16" id="myData3" name="myData3" style="margin: 0 auto;background-color: white;display: none;"></div>	
	
<div class="w3-content" id="myAspects" style="margin: 0 auto;background-color: white;display: none;"></div>
<div class="w3-content" id="myShortReports" style="margin: 0 auto;background-color: white;display: none;"></div>																					
<div class="w3-content" id="myPars" style="margin: 0 auto;background-color: white;display: none;"></div>
<div class="w3-content" id="myDigs" style="margin: 0 auto;background-color: white;display: none;"></div>
<div class="w3-content" id="myElements" style="margin: 0 auto;background-color: white;display: none;"></div>
<div class="w3-content" id="myVedic" style="margin: 0 auto;background-color: white;display: none;"></div>
<div class="w3-content w3-white" id="myReports" style="margin: 0 auto;background-color: white;display: none;"></div>
	</div>

	
	



	
<br><br>
<script type='text/javascript'>window.onload=function(){if(document.getElementById("TETRA_CHART")){tmp="<?php echo $translate_json['Click image to zoom...']; ?>";document.getElementById("TETRA_CHART").innerHTML='<div class="w3-content w3-white w3-center" id="paper" name="paper" style="display: none;"></div><div id="link"><canvas id="canvas_paper" name="canvas_paper" width="720px" height="720px" class="w3-image"></canvas></div>';}if(document.getElementById("TETRA_ASPECTS_GRID")){tmp="<?php echo $translate_json['Aspectarian']; ?>";document.getElementById("TETRA_ASPECTS_GRID").innerHTML='<p class="tetra-font-mobile"><font face="Merriweather" size="4"><b>'+tmp+'</b></font><canvas id="canvas-grid" name="canvas-grid" width="620px" height="620px" class="w3-image"></canvas></p>';}var x=$jq(window).width();var link=document.getElementById("link");var modal=document.getElementById('myModal');var modalImg=document.getElementById("img01");var el=document.getElementById('TETRA_CHART');if(el){link.addEventListener('click',function(){var ctx=document.getElementById("canvas_paper").getContext("2d");var image=document.getElementById("img01");modalImg.src=canvas_paper.toDataURL("image/png");x=$jq(window).width();if(x>600){modalImg.style.width="700px";modalImg.style.height="700px";modal.style.width="720px";modal.style.height="720px";modal.style.display="block";}else{x=x-10;var x1=x+5;modalImg.style.width=x+"px";modalImg.style.height=x+"px";modal.style.width=x1+"px";modal.style.height=x1+"px";modal.style.display="block";}});}var span=document.getElementsByClassName("close")[0];span.onclick=function(){modal.style.display="none";}} </script>



<?php
$options = get_option( 'byblos_settings' );	 
	 
$options['byblos_select_field_1'] = empty( $options['byblos_select_field_1'] ) ? 1 : $options['byblos_select_field_1'];	 
$show = $options['byblos_select_field_1'];
								
$options['byblos_select_field_shortrep'] = empty( $options['byblos_select_field_shortrep'] ) ? 1 : $options['byblos_select_field_shortrep'];	 
$show_short_report = $options['byblos_select_field_shortrep'];								
								
$options['byblos_select_nakshatra_report'] = empty( $options['byblos_select_nakshatra_report'] ) ? 3 : $options['byblos_select_nakshatra_report'];	 
$show_nakshatra_report_sys = $options['byblos_select_nakshatra_report'];	
			
								
								
$options['byblos_select_field_4'] = empty( $options['byblos_select_field_4'] ) ? 0 : $options['byblos_select_field_4'];
$house_sys = $options['byblos_select_field_4'];
/* $options['byblos_select_field_5'] = empty( $options['byblos_select_field_5'] ) ? -1 : $options['byblos_select_field_5']; */
$options['byblos_select_field_5'] = is_null( $options['byblos_select_field_5'] ) ? -1 : $options['byblos_select_field_5'];
$ayanamsa = $options['byblos_select_field_5'];
/* if(!$house_sys){
   $house_sys = get_option($options['byblos_select_field_4'], 0);
   $house_sys = 0;
}
if(!$ayanamsa){
   $ayanamsa = get_option($options['byblos_select_field_5'], 1);
   $ayanamsa = 1;
}
	 
if(!$show){
   $show = get_option($options['byblos_select_field_1'], 1);
   $show = 1;
} */
	 
$options['byblos_select_field_3'] = empty( $options['byblos_select_field_3'] ) ? '0.8' : $options['byblos_select_field_3'];
$scale = $options['byblos_select_field_3'];
/* if(!$scale){
   $scale = get_option($options['byblos_select_field_3'], 0.8);
   $scale = 0.8;
} */
$options['byblos_select_field_15'] = empty( $options['byblos_select_field_15'] ) ? 1 : $options['byblos_select_field_15'];
$dig_system = $options['byblos_select_field_15'];
/* if(!$dig_system){
   $dig_system = get_option($options['byblos_select_field_15'], 1);
   $dig_system = 1;
} */	 
$options['byblos_select_field_16'] = empty( $options['byblos_select_field_16'] ) ? 1 : $options['byblos_select_field_16'];
$show_custom_img = $options['byblos_select_field_16'];
/* if(!$show_custom_img){
   $show_custom_img = get_option($options['byblos_select_field_16'], 1);
   $show_custom_img = 1;
} */
$options['byblos_select_field_17'] = empty( $options['byblos_select_field_17'] ) ? '300' : $options['byblos_select_field_17'];	 
$custom_img_size = $options['byblos_select_field_17'];
/* if(!$custom_img_size){
   $custom_img_size = get_option($options['byblos_select_field_17'], 300);
   $custom_img_size = 300;
} */	 
$options['byblos_select_field_6'] = empty( $options['byblos_select_field_6'] ) ? 1 : $options['byblos_select_field_6'];	 
$show_icon = $options['byblos_select_field_6'];
/* if(!$show_icon){
   $show_icon = get_option($options['byblos_select_field_6'], 1);
   $show_icon = 1;
}*/
$options['byblos_select_field_14'] = empty( $options['byblos_select_field_14'] ) ? 2 : $options['byblos_select_field_14'];	 
$show_bar = $options['byblos_select_field_14'];
/* if(!$show_bar){
   $show_bar = get_option($options['byblos_select_field_14'], 2);
   $show_bar = 2;
} */
	 
$options['byblos_checkbox_field_7'] = empty( $options['byblos_checkbox_field_7'] ) ? 0 : 1;
$show_aspects_soft = $options['byblos_checkbox_field_7'];
$show_aspects_soft = ($show_aspects_soft > 0) ? 0 : 1;
$options['byblos_checkbox_field_8'] = empty( $options['byblos_checkbox_field_8'] ) ? 0 : 1;
$show_nodes = $options['byblos_checkbox_field_8'];
/* if(!$show_nodes){
   $show_nodes = get_option($options['byblos_checkbox_field_8'], 0);
   $show_nodes = 0;
} */
$options['byblos_checkbox_field_9'] = empty( $options['byblos_checkbox_field_9'] ) ? 0 : 1;
$show_lilith = $options['byblos_checkbox_field_9'];
/* if(!$show_lilith){
   $show_lilith = get_option($options['byblos_checkbox_field_9'], 0);
   $show_lilith = 0;
} */
$options['byblos_checkbox_field_10'] = empty( $options['byblos_checkbox_field_10'] ) ? 0 : 1;
$show_pf = $options['byblos_checkbox_field_10'];
/* if(!$show_pf){
   $show_pf = get_option($options['byblos_checkbox_field_10'], 0);
   $show_pf = 0;
}*/
$options['byblos_checkbox_field_12'] = empty( $options['byblos_checkbox_field_12'] ) ? 0 : 1;
$show_chiron = $options['byblos_checkbox_field_12'];
/* if(!$show_chiron){
   $show_chiron = get_option($options['byblos_checkbox_field_12'], 0);
   $show_chiron = 0;
}*/
	 
$options['byblos_checkbox_field_11'] = empty( $options['byblos_checkbox_field_11'] ) ? 0 : 1;
$show_stars = $options['byblos_checkbox_field_11'];
/* if(!$show_stars){
   $show_stars = get_option($options['byblos_checkbox_field_11'], 0);
   $show_stars = 0;
}*/
$options['byblos_checkbox_field_13'] = empty( $options['byblos_checkbox_field_13'] ) ? 0 : 1;
$show_vedic = $options['byblos_checkbox_field_13'];
/* if(!$show_vedic){
   $show_vedic = get_option($options['byblos_checkbox_field_13'], 0);
   $show_vedic = 0;
}*/
$options['byblos_checkbox_field_15'] = empty( $options['byblos_checkbox_field_15'] ) ? 0 : 1;
$show_syzygy = $options['byblos_checkbox_field_15'];
/* if(!$show_syzygy){
   $show_syzygy = get_option($options['byblos_checkbox_field_15'], 0);
   $show_syzygy = 0;
}*/
	 
$options['byblos_checkbox_field_16'] = empty( $options['byblos_checkbox_field_16'] ) ? 0 : 1;
$show_parts = $options['byblos_checkbox_field_16'];
/* if(!$show_parts){
   $show_parts = get_option($options['byblos_checkbox_field_16'], 0);
   $show_parts = 0;
}*/
$options['byblos_checkbox_field_17'] = empty( $options['byblos_checkbox_field_17'] ) ? 0 : 1;
$show_dignities = $options['byblos_checkbox_field_17'];
/* if(!$show_dignities){
   $show_dignities = get_option($options['byblos_checkbox_field_17'], 0);
   $show_dignities = 0;
}*/
$options['byblos_checkbox_field_18'] = empty( $options['byblos_checkbox_field_18'] ) ? 0 : 1;
$show_elements = $options['byblos_checkbox_field_18'];
/* if(!$show_elements){
   $show_elements = get_option($options['byblos_checkbox_field_18'], 0);
   $show_elements = 0;
}*/
	 
$options['byblos_checkbox_field_19'] = empty( $options['byblos_checkbox_field_19'] ) ? 0 : 1;
$show_asp_list = $options['byblos_checkbox_field_19'];
/* if(!$show_asp_list){
   $show_asp_list = get_option($options['byblos_checkbox_field_19'], 0);
   $show_asp_list = 0;
}*/
$show_transits = 0;
	
$options['byblos_select_field_35'] = empty( $options['byblos_select_field_35'] ) ? 1 : $options['byblos_select_field_35'];
$show_transits = $options['byblos_select_field_35'];	 
$options['byblos_select_field_transit'] = empty( $options['byblos_select_field_transit'] ) ? '' : $options['byblos_select_field_transit'];
$transit_url = get_site_url() . "/" . $options['byblos_select_field_transit'];
	 
$options['byblos_select_field_digsys'] = empty( $options['byblos_select_field_digsys'] ) ? 1 : $options['byblos_select_field_digsys'];
$digsys = $options['byblos_select_field_digsys'];
$dig_system_original = $dig_system;
if($dig_system < 3){
//$dig_file = plugins_url('Tetrabyblos')."/dbase/users/ptolemy.json";
$dig_file = plugin_dir_path( __FILE__ ).'/dbase/users/ptolemy.json';	
$data = json_decode(file_get_contents($dig_file), true);
$data_table = $data["DValues"];
} else {
//$dig_file = plugins_url('Tetrabyblos')."/dbase/users/custom.json";
$dig_file = plugin_dir_path( __FILE__ ).'/dbase/users/custom.json';	
$data = json_decode(file_get_contents($dig_file), true);
$data_table = $data["DValues"];
$dig_system = empty( $data["model"] ) ? 1 : $data["model"];
}
$options['byblos_checkbox_field_astrorep'] = empty( $options['byblos_checkbox_field_astrorep'] ) ? 0 :  $options['byblos_checkbox_field_astrorep'];
$astrorep = $options['byblos_checkbox_field_astrorep'];

$options['byblos_select_field_77'] = empty( $options['byblos_select_field_77'] ) ? 2 : $options['byblos_select_field_77'];
$PFFormula = $options['byblos_select_field_77'] - 1;

$options['byblos_select_field_chart'] = empty( $options['byblos_select_field_chart'] ) ? '0.7' : $options['byblos_select_field_chart'];
$glyph_chart = $options['byblos_select_field_chart']; 	
	 
$options['byblos_checkbox_field_outer'] = empty( $options['byblos_checkbox_field_outer'] ) ? 0 : 1;
$show_outer = $options['byblos_checkbox_field_outer'];
	 
$options['byblos_select_field_pars'] = empty( $options['byblos_select_field_pars'] ) ? '' : $options['byblos_select_field_pars'];
$add_pars = $options['byblos_select_field_pars'];

$options['byblos_select_field_chart_type'] = empty( $options['byblos_select_field_chart_type'] ) ? '0' : $options['byblos_select_field_chart_type'];
$chart_type = $options['byblos_select_field_chart_type']; 
	 
$options['byblos_select_field_chart_style'] = empty( $options['byblos_select_field_chart_style'] ) ? '0' : $options['byblos_select_field_chart_style'];
$chart_style = $options['byblos_select_field_chart_style'];

?>

<div id='sap' name='sap' style="display: none;"></div>


<script>if(!navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)){document.getElementById('ismobile').style.display='block';}function tetraaMen(){var WinPrint=window.open('','','left=50,top=50,width=800,height=600,toolbar=0,scrollbars=1,resizable=0,status=0,toolbar=1');WinPrint.document.write("<html><head><title>Tetrabyblos - Informe</title></head>");var estilo="<style>@font-face {font-family: 'HamburgSymbols';src: url('<?php echo $tetra_url ?>/css/HamburgSymbols.ttf');} @font-face {font-family: 'Merriweather';src: url('<?php echo $tetra_url ?>/css/Merriweather-Regular.ttf');} .tetra-font-mobile{font-family: 'Merriweather';font-size: 12px;} .table-no-border {border: 0px solid black;padding: 2px;}svg {transform: scale(0.8);}  .pagebreak { page-break-before: always; }</style>";estilo+="<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>";WinPrint.document.write(estilo+"<br>");estilo="<center><form ><input type='button' id='myForm' name='myForm' value='Imprimir esta página' onClick='doit()'></form></center><script>function doit(){document.getElementById('myForm').style.display='none';window.print();}<\/script>";WinPrint.document.write(estilo+"<br>");var tetra_zones=['TETRA_ASTRO_REPORT','TETRA_PLANETS','TETRA_HOUSES','TETRA_STARS','TETRA_ASPECTS','TETRA_PARS','TETRA_DIGS','TETRA_ELEMENTS','TETRA_VEDIC','TETRA_REPORTS'];var dataURL=document.getElementById('canvas_paper').toDataURL("image/png");var dataURL2=document.getElementById('canvas-grid').toDataURL("image/png");var tmp=document.getElementById('TETRA_TITLE').innerHTML;WinPrint.document.write(tmp+"<br>");tmp=document.getElementById('TETRA_BIRTH_DETAILS').innerHTML;WinPrint.document.write(tmp+"<br>");WinPrint.document.write('<center><img style="width: 600px;" src="'+dataURL+'"/></center><br>');WinPrint.document.write('<center><img style="width: 600px;" src="'+dataURL2+'"/></center><br>');for(i=0;i<=tetra_zones.length-1;i++){nn=tetra_zones[i];ss=document.getElementById(nn).innerHTML;if(ss.length>5){if(i==tetra_zones.length-1){WinPrint.document.write('<div align="center"><div style="width: 650px;">');}WinPrint.document.write("<center>"+ss+"</center><br>");if(i==tetra_zones.length-1){WinPrint.document.write('</div></div>');}}}var script_txt="<script>document.getElementById('myBar').style.display='none';document.getElementById('create2').style.display='none';if(document.getElementById('create3')){document.getElementById('create3').style.display='none';}<\/script>";WinPrint.document.write(script_txt);WinPrint.document.close();WinPrint.focus();};function print_page_testing(){var prtContent=document.getElementById("sap");var WinPrint=window.open('','','left=50,top=50,width=800,height=600,toolbar=1,scrollbars=1,resizable=0,status=1');WinPrint.document.write("<html><head><title>Tetrabyblos - Informe</title></head>");var estilo="<style>@font-face {font-family: 'HamburgSymbols';src: url('<?php echo $tetra_url ?>/css/HamburgSymbols.ttf');} @font-face {font-family: 'Merriweather';src: url('<?php echo $tetra_url ?>/css/Merriweather-Regular.ttf');}.tetra-font-mobile{font-family: 'Merriweather';font-size: 12px;} .table-no-border {border: 0px solid black;padding: 2px;}svg {transform: scale(0.8);} .pagebreak { page-break-before: always; }</style>";estilo+="<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>";WinPrint.document.write(estilo+"<br>");estilo="<center><form ><input type='button' id='myForm' name='myForm' value='Imprimir esta página' onClick='doit()'></form></center><script>function doit(){document.getElementById('myForm').style.display='none';window.print();}<\/script>";WinPrint.document.write("<span style='font-family: HamburgSymbols; color: #FFF; font-weight: bold;visibility: hidden;'></span><span style='font-family: Merriweather; color: #FFF; font-weight: bold;visibility: hidden;'></span>");WinPrint.document.write(estilo+"<br>");var dataURL=canvas.toDataURL("image/png");var dataURL2=document.getElementById('canvas-grid').toDataURL("image/png");var objChl=document.getElementById('myPrint').children;var vhtml="";for(i=0;i<=objChl.length-1;i++){var str=objChl[i].id;if((i<3||(i>5&&i<15))&&((str.indexOf("TETRA")> -1)||(str.indexOf("canvas")> -1))){if(i==14||i==3||i==4){WinPrint.document.write('<div align="center"><div style="width: 650px;">');}WinPrint.document.write('<br><center>'+objChl[i].innerHTML+'</center>');if(i==14){WinPrint.document.write('</div></div>');}}if(i==3){WinPrint.document.write('<center><img style="width: 700px;" src="'+dataURL+'"/></center><br>');}if(i==4){WinPrint.document.write('<center><img style="width: 700px;" src="'+dataURL2+'"/></center><br>');}}var script_txt="<script>document.getElementById('myBar').style.display='none';document.getElementById('create2').style.display='none';if(document.getElementById('create3')){document.getElementById('create3').style.display='none';}<\/script>";WinPrint.document.write(script_txt);WinPrint.document.close();WinPrint.focus();};function tetraaIen(canvas,callback){var image=new Image();image.onload=function(){callback(image);};image.src=canvas.toDataURL("image/png");};function tetraaBen(){var objChl=document.getElementById('myPrint').children;var vhtml="";for(i=0;i<=objChl.length-1;i++){document.getElementById('sap').append('<br>'+objChl[i].innerHTML);}};tetraaXen();document.getElementById("h_sys").value="<?php echo $house_sys ?>";document.getElementById("zodiac").value="<?php echo $ayanamsa ?>";var show_aspects_soft="<?php echo $show_aspects_soft ?>";var show_nodes="<?php echo $show_nodes ?>";var show_lilith="<?php echo $show_lilith ?>";var show_pf="<?php echo $show_pf ?>";var show_chiron="<?php echo $show_chiron ?>";var show_stars="<?php echo $show_stars ?>";var show_icon="<?php echo $show_icon ?>";var show_bar="<?php echo $show_bar ?>";var show_vedic="<?php echo $show_vedic ?>";var show_syzygy="<?php echo $show_syzygy ?>";var dig_system="<?php echo $dig_system ?>";var show_custom_img="<?php echo $show_custom_img ?>";var custom_img_size="<?php echo $custom_img_size ?>";var show_parts="<?php echo $show_parts ?>";var show_dignities="<?php echo $show_dignities ?>";var show_elements="<?php echo $show_elements ?>";var show_asp_list="<?php echo $show_asp_list ?>";var ecp_url="<?php echo plugins_url('Tetrabyblos') ?>/data/eclipse.php";var natal_url="<?php echo plugins_url('Tetrabyblos') ?>/natal_report.php";var natal_show= <?php echo $show ?>;var show_short_report= <?php echo $show_short_report ?>;var show_nakshatra_report_sys= <?php echo $show_nakshatra_report_sys ?>;var home_url="<?php echo get_site_url() ?>";var show_transits="<?php echo $show_transits ?>";var transit_url="<?php echo $transit_url ?>";var digsys="<?php echo $digsys ?>";var digsystemoriginal="<?php echo $dig_system_original; ?>";var astrorep="<?php echo $astrorep; ?>";var PFFormula= <?php echo $PFFormula; ?>;var glyph_chart="<?php echo $glyph_chart ?>";var show_outer="<?php echo $show_outer ?>";var add_pars="<?php echo $add_pars ?>";var chart_type="<?php echo $chart_type; ?>";var chart_style="<?php echo $chart_style; ?>";var trans_string= <?php echo $translate_main; ?>;var translate_main= <?php echo $translate_main; ?>;var DIGTABLE= <?php echo $data_table ?>;var b_calc_again= <?php echo $b_calc_again ?>;var b_calc_transit= <?php echo $b_calc_transit ?>;var show_snode= <?php echo $show_snode ?>;var pic_dir="<?php echo plugins_url('Tetrabyblos') ?>/images/";var x=screen.width;function tetraaaen(){a=eval(document.getElementById("lat_deg").value);b=eval(document.getElementById("lat_min").value);c=eval(document.getElementById("long_deg").value);d=eval(document.getElementById("long_min").value);my_name=document.getElementById("name").value;if(my_name==null||my_name==""){document.getElementById("name_error").innerHTML='<br><h5 style="color: teal;text-align: center;"><b><?php echo $translate_json["Please input a valid name!..."]; ?></b></h5>';var url=location.href;location.href="#enter_name";return false;}if(a+b+c+d==0){document.getElementById("city_error").innerHTML='<br><h5 style="color: teal;text-align: center;"><b><?php echo $translate_json["Please input a valid city/place!..."]; ?></b></h5>';return false;}else{var vv=eval(document.getElementById("year").value);if(vv>3000){document.getElementById("city_error").innerHTML='<br><h5><b><?php echo $translate_json["Year out of range!..."]; ?></b></h5>';return false;}else{tetraaden();calc();}}};var showhourformat="<?php echo $show_hourformat; ?>";function openTab(evt,tabName){var i,tabcontent,tablinks;tabcontent=document.getElementsByClassName("tabcontent");for(i=0;i<tabcontent.length;i++){tabcontent[i].style.display="none";}tablinks=document.getElementsByClassName("tablinks");for(i=0;i<tablinks.length;i++){tablinks[i].className=tablinks[i].className.replace(" active","");}document.getElementById(tabName).style.display="block";evt.currentTarget.className+=" active";};function tetraXen(evt,tabName){var i,tabcontent,tablinks;tabcontent=document.getElementsByClassName("tabcontent2");for(i=0;i<tabcontent.length;i++){tabcontent[i].style.display="none";}tablinks=document.getElementsByClassName("tablinks2");for(i=0;i<tablinks.length;i++){tablinks[i].className=tablinks[i].className.replace(" active","");}document.getElementById(tabName).style.display="block";evt.currentTarget.className+=" active";};document.getElementById("defaultOpen").click();document.getElementById("defaultOpen2").click();function tetraeen(){var is24=document.getElementById('European').style.display;if(is24=='none'){var hh=eval(document.getElementById('hour_american').value);var mm=eval(document.getElementById('minute_american').value);var ampm=eval(document.getElementById('ampm_american').value);if(hh==12&&ampm==0){document.getElementById('hour').value=0;document.getElementById('minute').value=mm;return;}if(hh==12&&ampm==1){document.getElementById('hour').value=0;document.getElementById('minute').value=mm;document.getElementById('hour_american').value=12;document.getElementById('ampm_american').value=0;return;}if(ampm>0){hh+=12;if(hh==24){hh=0;}}document.getElementById('hour').value=hh;document.getElementById('minute').value=mm;}else{var hh=eval(document.getElementById('hour').value);var mm=eval(document.getElementById('minute').value);var ampm=0;if(hh==0){document.getElementById('hour_american').value=12;document.getElementById('minute_american').value=mm;document.getElementById('ampm_american').value=0;return;}if(hh==12){document.getElementById('hour_american').value=12;document.getElementById('minute_american').value=mm;document.getElementById('ampm_american').value=1;return;}if(hh>12){hh-=12;ampm=1;if(hh==0){hh=12;}}if(hh==0){hh=12;ampm=1;}document.getElementById('hour_american').value=hh;document.getElementById('minute_american').value=mm;document.getElementById('ampm_american').value=ampm;}};function tetrayen(name,value,days){if(days){var date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));var expires="; expires="+date.toGMTString();}else var expires="";document.cookie=name+"="+value+expires+"; path=/";};function tetrazen(name){var nameEQ=name+"=";var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);if(c.indexOf(nameEQ)==0)return c.substring(nameEQ.length,c.length);}return null;};function tetrabEen(name){tetrayen(name,"",-1);};function tetraaden(){var datavalues=["lat_deg","lat_min","long_deg","long_min","ns","ew","timezone","full_name","zoneoffset","hour","minute","hour_american","minute_american","ampm_american","day","month","year","era","country_id","h_sys","zodiac","latitude","longitude","name","email","cname"];for(index=0;index<datavalues.length;++index){var t=document.getElementById(datavalues[index]);if(t){tetrayen(datavalues[index],t.value,7);}}};function tetraaXen(){var datavalues=["lat_deg","lat_min","long_deg","long_min","ns","ew","timezone","full_name","zoneoffset","hour","minute","hour_american","minute_american","ampm_american","day","month","year","era","country_id","h_sys","zodiac","latitude","longitude","name","email","cname"];for(index=0;index<datavalues.length;index++){if(document.getElementById(datavalues[index])&&tetrazen(datavalues[index])){var v1=tetrazen(datavalues[index]);document.getElementById(datavalues[index]).value=v1;}}} </script>
<script>function rev(angle){return angle-Math.floor(angle/360.0)*360.0;};function sind(angle){return Math.sin((angle*Math.PI)/180.0);};function cosd(angle){return Math.cos((angle*Math.PI)/180.0);};function tand(angle){return Math.tan((angle*Math.PI)/180.0);};function asind(c){return(180.0/Math.PI)*Math.asin(c);};function acosd(c){return(180.0/Math.PI)*Math.acos(c);};function atan2d(y,x){return(180.0/Math.PI)*Math.atan(y/x)-180.0*(x<0);};function tetrabcen(a,circle){var ar=Math.round(a*60)/60;var deg=Math.abs(ar);var min=Math.round(60.0*(deg-Math.floor(deg)));if(min>=60){deg+=1;min=0;}var anglestr="";if(!circle)anglestr+=(ar<0?"-":"+");if(circle)anglestr+=((Math.floor(deg)<100)?"0":"");anglestr+=((Math.floor(deg)<10)?"0":"")+Math.floor(deg);anglestr+=((min<10)?":0":":")+(min);return anglestr;};function dayno(year,month,day,hours){var d=367*year-Math.floor(7*(year+Math.floor((month+9)/12))/4)+Math.floor((275*month)/9)+day-730530+hours/24;return d;};function julian(year,month,day,hours){return dayno(year,month,day,hours)+2451543.5};function radtoaa(ra,dec,year,month,day,hours,lat,lon){var lst=local_sidereal(year,month,day,hours,lon);var x=cosd(15.0*(lst-ra))*cosd(dec);var y=sind(15.0*(lst-ra))*cosd(dec);var z=sind(dec);var xhor=x*sind(lat)-z*cosd(lat);var yhor=y;var zhor=x*cosd(lat)+z*sind(lat);var azimuth=rev(atan2d(yhor,xhor)+180.0);var altitude=atan2d(zhor,Math.sqrt(xhor*xhor+yhor*yhor));return new Array(altitude,azimuth);};function tetraqen(jd){T=(jd-2451545.0)/36525.0;T2=T*T;T3=T*T2;T4=T2*T2;var DEG2RAD=Math.atan(1)/45.0;d=(297.8501921+445267.1114034*T-0.0018819*T2+T3/545868-T4/113065000)*DEG2RAD;f=(93.2720950+483202.0175233*T-0.0036539*T2-T3/3526000+T4/863310000)*DEG2RAD;ll=(357.5291092+35999.0502909*T-0.0001536*T2+T3/24490000)*DEG2RAD;l=(134.9633964+477198.8675055*T+0.0087414*T2+T3/69699-T4/14712000)*DEG2RAD;var manode=125.0445479-1934.1362891*T+0.0020754*T2+T3/467441-T4/60616000;manode=rev(manode);var tanode=manode-1.4979*Math.sin(2*d-2*f)-0.1500*Math.sin(ll)-0.1226*Math.sin(2*d)+0.1176*Math.sin(2*f)-0.0801*Math.sin(2*l-2*f)-0.0616*Math.sin(2*d-ll-2*f)+0.0490*Math.sin(2*d-l)+0.0409*Math.sin(l-2*f)+0.0327*Math.sin(l)+0.0324*Math.sin(2*d+ll-2*f)+0.0196*Math.sin(4*d-4*f)+0.0180*Math.sin(2*d-l-2*f)+0.0150*Math.sin(2*d-2*l)-0.0150*Math.sin(2*d+l-2*f)-0.0078*Math.sin(2*d-ll)-0.0045*Math.sin(2*d+l)+0.0044*Math.sin(l+2*f)-0.0042*Math.sin(d-l)-0.0031*Math.sin(ll-2*f)+0.0031*Math.sin(2*d-ll-l)+0.0029*Math.sin(2*d-4*f)+0.0028*Math.sin(ll+2*f)+0.001*25.9*Math.sin((125.0-1934.1*T)*DEG2RAD)-0.001*4.3*Math.sin((220.2-1935.5*T)*DEG2RAD)+0.001*T*0.38*Math.sin((357.5+35999.1*T)*DEG2RAD);tanode=rev(tanode);if(Math.abs(manode-tanode)>Math.abs(manode-(tanode+180.0))){tanode+=180.0;}var mperigee=83.3532465+4069.0137287*T-0.0103200*T2-T3/80053+T4/18999000+180.0;mperigee=rev(mperigee);var trueperigee=mperigee-15.448*Math.sin(2*d-l)-9.642*Math.sin(2*d-2*l)-2.721*Math.sin(l)+2.607*Math.sin(4*d-3*l)+2.085*Math.sin(4*d-2*l)+1.477*Math.sin(2*d+l)+0.968*Math.sin(4*d-4*l)-0.949*Math.sin(2*d-ll-l)-0.703*Math.sin(6*d-4*l)-0.660*Math.sin(2*d)-0.577*Math.sin(2*d-3*l)-0.524*Math.sin(2*l)-0.482*Math.sin(6*d-5*l)+0.452*Math.sin(ll)-0.381*Math.sin(6*d-3*l)-0.342*Math.sin(2*d-ll-2*l)-0.312*Math.sin(3*l)+0.282*Math.sin(d-l)+0.255*Math.sin(4*d-ll-2*l)+0.252*Math.sin(4*d-ll-3*l)-0.211*Math.sin(2*l-2*f)+0.193*Math.sin(8*d-5*l)+0.191*Math.sin(8*d-6*l)-0.184*Math.sin(2*d-4*l)+0.182*Math.sin(2*d+2*l)-0.158*Math.sin(6*d-6*l)+0.148*Math.sin(4*d-5*l)-0.111*Math.sin(6*d-ll-4*l)+0.101*Math.sin(2*d-ll+l)+0.100*Math.sin(8*d-7*l)+0.087*Math.sin(2*d+ll-l)+0.080*Math.sin(8*d-4*l)+0.080*Math.sin(ll-l)+0.077*Math.sin(4*d-ll-4*l)-0.073*Math.sin(2*d-5*l)-0.071*Math.sin(6*d-ll-3*l)-0.069*Math.sin(10*d-7*l)-0.067*Math.sin(6*d-ll-5*l)-0.067*Math.sin(3*d-2*l)+0.055*Math.sin(4*d-6*l)+0.055*Math.sin(l-2*f)-0.054*Math.sin(10*d-6*l)-0.052*Math.sin(4*l)-0.050*Math.sin(10*d-8*l)-0.049*Math.sin(3*d-3*l)-0.047*Math.sin(2*d-3*l+2*f)-0.044*Math.sin(d+ll-l)-0.043*Math.sin(2*d-ll)+0.042*Math.sin(8*d-ll-5*l)-0.042*Math.sin(ll+l)-0.041*Math.sin(6*d-7*l)-0.040*Math.sin(2*d-2*ll-l)+0.038*Math.sin(8*d-ll-6*l)-0.037*Math.sin(2*d-4*l+2*f)+0.036*Math.sin(4*d-l)+0.035*Math.sin(8*d-8*l)-0.034*Math.sin(2*d-ll-3*l)+0.031*Math.sin(ll-2*l)+0.001*T*2.4*Math.sin((103.2+377336.3*T)*DEG2RAD);trueperigee=rev(trueperigee);var results=[manode,tanode,mperigee,trueperigee];return results;};var T45AD=new Array(0,2,2,0,0,0,2,2,2,2,0,1,0,2,0,0,4,0,4,2,2,1,1,2,2,4,2,0,2,2,1,2,0,0,2,2,2,4,0,3,2,4,0,2,2,2,4,0,4,1,2,0,1,3,4,2,0,1,2,2);var T45AM=new Array(0,0,0,0,1,0,0,-1,0,-1,1,0,1,0,0,0,0,0,0,1,1,0,1,-1,0,0,0,1,0,-1,0,-2,1,2,-2,0,0,-1,0,0,1,-1,2,2,1,-1,0,0,-1,0,1,0,1,0,0,-1,2,1,0,0);var T45AMP=new Array(1,-1,0,2,0,0,-2,-1,1,0,-1,0,1,0,1,1,-1,3,-2,-1,0,-1,0,1,2,0,-3,-2,-1,-2,1,0,2,0,-1,1,0,-1,2,-1,1,-2,-1,-1,-2,0,1,4,0,-2,0,2,1,-2,-3,2,1,-1,3,-1);var T45AF=new Array(0,0,0,0,0,2,0,0,0,0,0,0,0,-2,2,-2,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,-2,2,0,2,0,0,0,0,0,0,-2,0,0,0,0,-2,-2,0,0,0,0,0,0,0,-2);var T45AL=new Array(6288774,1274027,658314,213618,-185116,-114332,58793,57066,53322,45758,-40923,-34720,-30383,15327,-12528,10980,10675,10034,8548,-7888,-6766,-5163,4987,4036,3994,3861,3665,-2689,-2602,2390,-2348,2236,-2120,-2069,2048,-1773,-1595,1215,-1110,-892,-810,759,-713,-700,691,596,549,537,520,-487,-399,-381,351,-340,330,327,-323,299,294,0);var T45AR=new Array(-20905355,-3699111,-2955968,-569925,48888,-3149,246158,-152138,-170733,-204586,-129620,108743,104755,10321,0,79661,-34782,-23210,-21636,24208,30824,-8379,-16675,-12831,-10445,-11650,14403,-7003,0,10056,6322,-9884,5751,0,-4950,4130,0,-3958,0,3258,2616,-1897,-2117,2354,0,0,-1423,-1117,-1571,-1739,0,-4421,0,0,0,0,1165,0,0,8752);var T45BD=new Array(0,0,0,2,2,2,2,0,2,0,2,2,2,2,2,2,2,0,4,0,0,0,1,0,0,0,1,0,4,4,0,4,2,2,2,2,0,2,2,2,2,4,2,2,0,2,1,1,0,2,1,2,0,4,4,1,4,1,4,2);var T45BM=new Array(0,0,0,0,0,0,0,0,0,0,-1,0,0,1,-1,-1,-1,1,0,1,0,1,0,1,1,1,0,0,0,0,0,0,0,0,-1,0,0,0,0,1,1,0,-1,-2,0,1,1,1,1,1,0,-1,1,0,-1,0,0,0,-1,-2);var T45BMP=new Array(0,1,1,0,-1,-1,0,2,1,2,0,-2,1,0,-1,0,-1,-1,-1,0,0,-1,0,1,1,0,0,3,0,-1,1,-2,0,2,1,-2,3,2,-3,-1,0,0,1,0,1,1,0,0,-2,-1,1,-2,2,-2,-1,1,1,-1,0,0);var T45BF=new Array(1,1,-1,-1,1,-1,1,1,-1,-1,-1,-1,1,-1,1,1,-1,-1,-1,1,3,1,1,1,-1,-1,-1,1,-1,1,-3,1,-3,-1,-1,1,-1,1,-1,1,1,1,1,-1,3,-1,-1,1,-1,-1,1,-1,1,-1,-1,-1,-1,-1,-1,1);var T45BL=new Array(5128122,280602,277693,173237,55413,46271,32573,17198,9266,8822,8216,4324,4200,-3359,2463,2211,2065,-1870,1828,-1794,-1749,-1565,-1491,-1475,-1410,-1344,-1335,1107,1021,833,777,671,607,596,491,-451,439,422,421,-366,-351,331,315,302,-283,-229,223,223,-220,-220,-185,181,-177,176,166,-164,132,-119,115,107);function MoonPos(year,month,day,hours){var jd=julian(year,month,day,hours);var T=(jd-2451545.0)/36525;var T2=T*T;var T3=T2*T;var T4=T3*T;var LP=218.3164477+481267.88123421*T-0.0015786*T2+T3/538841.0-T4/65194000.0;var D=297.8501921+445267.1114034*T-0.0018819*T2+T3/545868.0-T4/113065000.0;var M=357.5291092+35999.0502909*T-0.0001536*T2+T3/24490000.0;var MP=134.9633964+477198.8675055*T+0.0087414*T2+T3/69699.0-T4/14712000.0;var F=93.2720950+483202.0175233*T-0.0036539*T2-T3/3526000.0+T4/863310000.0;var A1=119.75+131.849*T;var A2=53.09+479264.290*T;var A3=313.45+481266.484*T;var E=1-0.002516*T-0.0000074*T2;var E2=E*E;var Sl=0.0;var Sr=0.0;for(var i=0;i<60;i++){var Eterm=1;if(Math.abs(T45AM[i])==1)Eterm=E;if(Math.abs(T45AM[i])==2)Eterm=E2;Sl+=T45AL[i]*Eterm*sind(rev(T45AD[i]*D+T45AM[i]*M+T45AMP[i]*MP+T45AF[i]*F));Sr+=T45AR[i]*Eterm*cosd(rev(T45AD[i]*D+T45AM[i]*M+T45AMP[i]*MP+T45AF[i]*F));}var Sb=0.0;for(var i=0;i<60;i++){var Eterm=1;if(Math.abs(T45BM[i])==1)Eterm=E;if(Math.abs(T45BM[i])==2)Eterm=E2;Sb+=T45BL[i]*Eterm*sind(rev(T45BD[i]*D+T45BM[i]*M+T45BMP[i]*MP+T45BF[i]*F));}Sl=Sl+3958*sind(rev(A1))+1962*sind(rev(LP-F))+318*sind(rev(A2));Sb=Sb-2235*sind(rev(LP))+382*sind(rev(A3))+175*sind(rev(A1-F))+175*sind(rev(A1+F))+127*sind(rev(LP-MP))-115*sind(rev(LP+MP));var mglong=rev(LP+Sl/1000000.0);var mglat=rev(Sb/1000000.0);if(mglat>180.0)mglat=mglat-360;var mr=Math.round(385000.56+Sr/1000.0);var obl=23.4393-3.563E-9*(jd-2451543.5);var ra=rev(atan2d(sind(mglong)*cosd(obl)-tand(mglat)*sind(obl),cosd(mglong)))/15.0;var dec=rev(asind(sind(mglat)*cosd(obl)+cosd(mglat)*sind(obl)*sind(mglong)));if(dec>180.0)dec=dec-360;return new Array(ra,dec,mr);};function MoonRise(year,month,day,TZ,latitude,longitude){var hours=0;var riseset=new Array();var elh=new Array();var elhdone=new Array();for(var i=0;i<=24;i++){elhdone[i]=false;}var rad=MoonPos(year,month,day,hours-TZ);var altaz=radtoaa(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[0]=altaz[0];elhdone[0]=true;if(elh[0]>0.0){riseset=new Array(-2,-2);}else{riseset=new Array(-1,-1);}hours=24;rad=MoonPos(year,month,day,hours-TZ);altaz=radtoaa(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[24]=altaz[0];elhdone[24]=true;for(var rise=0;rise<2;rise++){var found=false;var hfirst=0;var hlast=24;while(Math.ceil((hlast-hfirst)/2)>1){hmid=hfirst+Math.round((hlast-hfirst)/2);if(!elhdone[hmid]){hours=hmid;rad=MoonPos(year,month,day,hours-TZ);altaz=radtoaa(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[hmid]=altaz[0];elhdone[hmid]=true;}if(((rise==0)&&(elh[hfirst]<=0.0)&&(elh[hmid]>=0.0))||((rise==1)&&(elh[hfirst]>=0.0)&&(elh[hmid]<=0.0))){hlast=hmid;found=true;continue;}if(((rise==0)&&(elh[hmid]<=0.0)&&(elh[hlast]>=0.0))||((rise==1)&&(elh[hmid]>=0.0)&&(elh[hlast]<=0.0))){hfirst=hmid;found=true;continue;}break;}if((hlast-hfirst)>1){for(var i=hfirst;i<hlast;i++){found=false;if(!elhdone[i+1]){hours=i+1;rad=MoonPos(year,month,day,hours-TZ);altaz=radtoaa(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[hours]=altaz[0];elhdone[hours]=true;}if(((rise==0)&&(elh[i]<=0.0)&&(elh[i+1]>=0.0))||((rise==1)&&(elh[i]>=0.0)&&(elh[i+1]<=0.0))){hfirst=i;hlast=i+1;found=true;break;}}}if(found){var elfirst=elh[hfirst];var ellast=elh[hlast];hours=hfirst+0.5;rad=MoonPos(year,month,day,hours-TZ);altaz=radtoaa(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);if((rise==0)&&(altaz[0]<=0.0)){hfirst=hours;elfirst=altaz[0];}if((rise==0)&&(altaz[0]>0.0)){hlast=hours;ellast=altaz[0];}if((rise==1)&&(altaz[0]<=0.0)){hlast=hours;ellast=altaz[0];}if((rise==1)&&(altaz[0]>0.0)){hfirst=hours;elfirst=altaz[0];}var eld=Math.abs(elfirst)+Math.abs(ellast);riseset[rise]=hfirst+(hlast-hfirst)*Math.abs(elfirst)/eld;}}return(riseset);};function tetrabBen(year,month,day,hours){var j=dayno(year,month,day,hours)+2451543.5;var T=(j-2451545.0)/36525;var T2=T*T;var T3=T2*T;var T4=T3*T;var D=297.8501921+445267.1114034*T-0.0018819*T2+T3/545868.0-T4/113065000.0;var MP=134.9633964+477198.8675055*T+0.0087414*T2+T3/69699.0-T4/14712000.0;var M=357.5291092+35999.0502909*T-0.0001536*T2+T3/24490000.0;var pa=180.0-D-6.289*sind(MP)+2.1*sind(M)-1.274*sind(2*D-MP)-0.658*sind(2*D)-0.214*sind(2*MP)-0.11*sind(D);return(rev(pa));};function tetralen(year,month,day){var quarters=new Array();var k=Math.floor((year+((month-1)+(day)/30)/12-2000)*12.3685);var T=k/1236.85;var M=rev(2.5534+29.10535669*k-0.0000218*T*T);var MP=rev(201.5643+385.81693528*k+0.0107438*T*T+0.00001239*T*T*T-0.00000011*T*T*T);var E=1-0.002516*T-0.0000074*T*T;var F=rev(160.7108+390.67050274*k-0.0016341*T*T-0.00000227*T*T*T+0.000000011*T*T*T*T);var Omega=rev(124.7746-1.56375580*k+0.0020691*T*T+0.00000215*T*T*T);var A=new Array();A[1]=rev(299.77+0.107408*k-0.009173*T*T);A[2]=rev(251.88+0.016321*k);A[3]=rev(251.83+26.651886*k);A[4]=rev(349.42+36.412478*k);A[5]=rev(84.88+18.206239*k);A[6]=rev(141.74+53.303771*k);A[7]=rev(207.14+2.453732*k);var JDE0=2451550.09765+29.530588853*k+0.0001337*T*T-0.000000150*T*T*T+0.00000000073*T*T*T*T;JDE0=JDE0-58.184/(24*60*60);var JDE=JDE0-0.40720*sind(MP)+0.17241*E*sind(M)+0.01608*sind(2*MP)+0.01039*sind(2*F)+0.00739*E*sind(MP-M)-0.00514*E*sind(MP+M)+0.00208*E*E*sind(2*M)-0.00111*sind(MP-2*F)-0.00057*sind(MP+2*F)+0.00056*E*sind(2*MP+M)-0.00042*sind(3*MP)+0.00042*E*sind(M+2*F)+0.00038*E*sind(M-2*F)-0.00024*E*sind(2*MP-M)-0.00017*sind(Omega)-0.00007*sind(MP+2*M);quarters[0]=JDE+0.000325*sind(A[1])+0.000165*sind(A[2])+0.000164*sind(A[3])+0.000126*sind(A[4])+0.000110*sind(A[5])+0.000062*sind(A[6])+0.000060*sind(A[7]);JDE=JDE0+29.530588853*0.25;M=rev(M+29.10535669*0.25);MP=rev(MP+385.81693528*0.25);F=rev(F+390.67050274*0.25);Omega=rev(Omega-1.56375580*0.25);A[1]=rev(A[1]+0.107408*0.25);A[2]=rev(A[2]+0.016321*0.25);A[3]=rev(A[3]+26.651886*0.25);A[4]=rev(A[4]+36.412478*0.25);A[5]=rev(A[5]+18.206239*0.25);A[6]=rev(A[6]+53.303771*0.25);A[7]=rev(A[7]+2.453732*0.25);JDE=JDE-0.62801*sind(MP)+0.17172*E*sind(M)-0.01183*E*sind(MP+M)+0.00862*sind(2*MP)+0.00804*sind(2*F)+0.00454*E*sind(MP-M)+0.00204*E*E*sind(2*M)-0.00180*sind(MP-2*F)-0.00070*sind(MP+2*F)-0.00040*sind(3*MP)-0.00034*E*sind(2*MP-M)+0.00032*E*sind(M+2*F)+0.00032*E*sind(M-2*F)-0.00028*E*E*sind(MP+2*M)+0.00027*E*sind(2*MP+M)-0.00017*sind(Omega);JDE=JDE+(0.00306-0.00038*E*cosd(M)+0.00026*cosd(MP)-0.00002*cosd(MP-M)+0.00002*cosd(MP+M)+0.00002*cosd(2*F));quarters[1]=JDE+0.000325*sind(A[1])+0.000165*sind(A[2])+0.000164*sind(A[3])+0.000126*sind(A[4])+0.000110*sind(A[5])+0.000062*sind(A[6])+0.000060*sind(A[7]);JDE=JDE0+29.530588853*0.5;M=rev(M+29.10535669*0.25);MP=rev(MP+385.81693528*0.25);F=rev(F+390.67050274*0.25);Omega=rev(Omega-1.56375580*0.25);A[1]=rev(A[1]+0.107408*0.25);A[2]=rev(A[2]+0.016321*0.25);A[3]=rev(A[3]+26.651886*0.25);A[4]=rev(A[4]+36.412478*0.25);A[5]=rev(A[5]+18.206239*0.25);A[6]=rev(A[6]+53.303771*0.25);A[7]=rev(A[7]+2.453732*0.25);JDE=JDE-0.40614*sind(MP)+0.17302*E*sind(M)+0.01614*sind(2*MP)+0.01043*sind(2*F)+0.00734*E*sind(MP-M)-0.00515*E*sind(MP+M)+0.00209*E*E*sind(2*M)-0.00111*sind(MP-2*F)-0.00057*sind(MP+2*F)+0.00056*E*sind(2*MP+M)-0.00042*sind(3*MP)+0.00042*E*sind(M+2*F)+0.00038*E*sind(M-2*F)-0.00024*E*sind(2*MP-M)-0.00017*sind(Omega)-0.00007*sind(MP+2*M);quarters[2]=JDE+0.000325*sind(A[1])+0.000165*sind(A[2])+0.000164*sind(A[3])+0.000126*sind(A[4])+0.000110*sind(A[5])+0.000062*sind(A[6])+0.000060*sind(A[7]);JDE=JDE0+29.530588853*0.75;M=rev(M+29.10535669*0.25);MP=rev(MP+385.81693528*0.25);F=rev(F+390.67050274*0.25);Omega=rev(Omega-1.56375580*0.25);A[1]=rev(A[1]+0.107408*0.25);A[2]=rev(A[2]+0.016321*0.25);A[3]=rev(A[3]+26.651886*0.25);A[4]=rev(A[4]+36.412478*0.25);A[5]=rev(A[5]+18.206239*0.25);A[6]=rev(A[6]+53.303771*0.25);A[7]=rev(A[7]+2.453732*0.25);JDE=JDE-0.62801*sind(MP)+0.17172*E*sind(M)-0.01183*E*sind(MP+M)+0.00862*sind(2*MP)+0.00804*sind(2*F)+0.00454*E*sind(MP-M)+0.00204*E*E*sind(2*M)-0.00180*sind(MP-2*F)-0.00070*sind(MP+2*F)-0.00040*sind(3*MP)-0.00034*E*sind(2*MP-M)+0.00032*E*sind(M+2*F)+0.00032*E*sind(M-2*F)-0.00028*E*E*sind(MP+2*M)+0.00027*E*sind(2*MP+M)-0.00017*sind(Omega);JDE=JDE-(0.00306-0.00038*E*cosd(M)+0.00026*cosd(MP)-0.00002*cosd(MP-M)+0.00002*cosd(MP+M)+0.00002*cosd(2*F));quarters[3]=JDE+0.000325*sind(A[1])+0.000165*sind(A[2])+0.000164*sind(A[3])+0.000126*sind(A[4])+0.000110*sind(A[5])+0.000062*sind(A[6])+0.000060*sind(A[7]);return quarters;};function tetrabben(year,month,day){var phases1=new Array();var phases2=new Array();phases1=tetralen(year,month-1,1);phases2=tetralen(year,month,1);var all=phases1.concat(phases2);return all;};var PI=Math.atan(1)*4;var NUMBER_HOUSE=12;var PI180=180.0/Math.PI;var PI2=2.0*Math.PI;var PIH=Math.PI/2.0;var NUMBER_SIGN=[2,3,4,12];var NUMBER_MAX=12;var ANGLE_SIGN_R=[2.0*Math.PI/2,2.0*Math.PI/3,2.0*Math.PI/4,2.0*Math.PI/12];var SignAngleD=360/NUMBER_MAX;var SignAngleR=PI2/NUMBER_MAX;var ANGLE_HOUSE_D=360/12;var ANGLE_HOUSE_R=2.0*Math.PI/12;var rAxis=23.44578889;var subRange=[-RFromD(90.0-rAxis),PIH];var res=new Array();function FPars(day_chart,PFFormula,ASCL,SUNL,MOONL,MERL,VENL,MARL,JUPL,SATL,SANL,ASCR,hhouses){POF=Mod360(ASCL+MOONL-SUNL);if(PFFormula>0&&day_chart<0){POF=Mod360(ASCL-MOONL+SUNL);}var H8=hhouses[7]*45/Math.atan(1);pars_DEATH=Mod360(SATL+H8-MOONL);if(day_chart>0){pars_MOON=Mod360(ASCL+MOONL-SUNL);pars_SUN=Mod360(ASCL+SUNL-MOONL);pars_VENUS=Mod360(ASCL+pars_SUN-pars_MOON);pars_MERCURY=Mod360(ASCL+pars_MOON-pars_SUN);pars_SATURN=Mod360(ASCL+pars_MOON-SATL);pars_JUPITER=Mod360(ASCL+JUPL-pars_SUN);pars_MARS=Mod360(ASCL+pars_MOON-MARL);pars_ANARETA=Mod360(ASCL+MOONL-ASCR);pars_LIFE=Mod360(ASCL+SATL-JUPL);pars_ILLNESS=Mod360(ASCL+MARL-SATL);}else{pars_MOON=Mod360(ASCL-MOONL+SUNL);pars_SUN=Mod360(ASCL-SUNL+MOONL);pars_VENUS=Mod360(ASCL-pars_SUN+pars_MOON);pars_MERCURY=Mod360(ASCL-pars_MOON+pars_SUN);pars_SATURN=Mod360(ASCL-pars_MOON+SATL);pars_JUPITER=Mod360(ASCL-JUPL+pars_SUN);pars_MARS=Mod360(ASCL-pars_MOON+MARL);pars_ANARETA=Mod360(ASCL+ASCR-MOONL);pars_LIFE=Mod360(ASCL+JUPL-SATL);pars_ILLNESS=Mod360(ASCL+SATL-MARL);}pars_HYLEG=Mod360(ASCL+MOONL-SANL);pars_BADLUCK=Mod360(ASCL+POF-pars_SUN);var pars_ALL=[pars_MOON,pars_SUN,pars_VENUS,pars_MERCURY,pars_SATURN,pars_JUPITER,pars_MARS,pars_HYLEG,pars_ANARETA,pars_LIFE,pars_ILLNESS,pars_BADLUCK,pars_DEATH];return pars_ALL;};function tetraAen(JUT,longitude,lat,Sys){rightAscension=FNrad(tetraSen(JUT)+longitude);eclipticObliquity=FNrad(tetraFen(JUT));latR=FNrad(lat);var Houses=new Array();switch(Sys){case 0:Houses=tetranen(rightAscension,eclipticObliquity,latR);break;case 1:Houses=tetraacen(rightAscension,eclipticObliquity,latR);break;case 2:Houses=tetraagen(rightAscension,eclipticObliquity,latR);break;case 3:Houses=tetrapen(rightAscension,eclipticObliquity,latR);break;case 4:Houses=tetraaPen(rightAscension,eclipticObliquity,latR);break;case 5:Houses=tetraaen(rightAscension,eclipticObliquity,latR);break;case 6:Houses=tetrafen(rightAscension,eclipticObliquity,latR);break;case 7:Houses=tetraayen(rightAscension,eclipticObliquity,latR);break;case 8:Houses=tetraaWen(rightAscension,eclipticObliquity,latR);break;case 9:Houses=tetrabden(rightAscension,eclipticObliquity,latR);break;case 10:Houses=tetraaVen(rightAscension,eclipticObliquity,latR);break;case 11:Houses=tetraajen(rightAscension,eclipticObliquity,latR);break;case 12:Houses=tetrabQen(rightAscension,eclipticObliquity,latR);break;case 13:Houses=tetrabDen(rightAscension,eclipticObliquity,latR);break;case 14:Houses=tetraauen(rightAscension,eclipticObliquity,latR);break;default:Houses=tetranen(rightAscension,eclipticObliquity,latR);}return Houses;};function tetraafen(rightAscension,eclipticObliquity,latR){ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;vertex=Angle(-Math.sin(rightAscension+PI)*Math.cos(eclipticObliquity)-Math.sin(eclipticObliquity)/Math.tan(latR),Math.cos(rightAscension+PI));eastPoint=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity),Math.cos(rightAscension));};function tetraaGen(date_julian,longitude_1,latitude_1,ic){cf=FNrad(tetraSen(date_julian)+longitude_1);cK=FNrad(tetraFen(date_julian));ci=FNrad(latitude_1);dk=Angle(-Math.sin(cf)*Math.cos(cK)-Math.tan(ci)*Math.sin(cK),Math.cos(cf));dK=Angle(Math.cos(cK),Math.tan(cf));dK=tetrawen(cf,cK)*Math.PI/180;iJ=Angle(-Math.sin(cf+Math.PI)*Math.cos(cK)-Math.sin(cK)/Math.tan(ci),Math.cos(cf+Math.PI));iy=Angle(-Math.sin(cf)*Math.cos(cK),Math.cos(cf));return new Array(dk,dK,iJ,iy);};function tetraaLen(rightAscension,eclipticObliquity,latR){return tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;};function tetraacen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;Z=Math.cos(eclipticObliquity);Z2=Math.sin(eclipticObliquity)*Math.tan(latR);Z3=Math.cos(latR);for(i=0;i<NUMBER_HOUSE;i++){KO=Mod2PI(ANGLE_HOUSE_R*i+PIH+1.7E-8);DN=Math.atan(Math.tan(KO)*Z3);if(DN<0.0)DN+=PI;if(Math.sin(KO)<0.0)DN+=PI;X=Angle(Math.cos(rightAscension+DN)*Z-Math.sin(DN)*Z2,Math.sin(rightAscension+DN));housesR[i]=X;}return housesR;};function tetrabDen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;rDecl=Math.asin(Math.sin(eclipticObliquity)*Math.sin(ascendant));r= -Math.tan(latR)*Math.tan(rDecl);rSda=(Math.acos(r));rSna=PI-rSda;housesR[6]=(rightAscension)-rSna;housesR[7]=(rightAscension)-rSna*2.0/3.0;housesR[8]=(rightAscension)-rSna/3.0;housesR[9]=(rightAscension);housesR[10]=(rightAscension)+rSda/3.0;housesR[11]=(rightAscension)+rSda*2.0/3.0;for(i=6;i<=11;i++){r=Mod2PI(housesR[i]);rLon=Math.atan(Math.tan(r)/Math.cos(eclipticObliquity));if(rLon<0.0)rLon+=PI;if(r>PI)rLon+=PI;housesR[i]=Mod2PI(rLon);}for(i=0;i<=5;i++)housesR[i]=Mod2PI(housesR[i+6]+PI);return housesR;};function tetraajen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;for(i=0;i<NUMBER_HOUSE;i++){housesR[i]=Mod2PI(ascendant+ANGLE_HOUSE_R*i);}return housesR;};function tetraaVen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;for(i=0;i<NUMBER_HOUSE;i++){housesR[i]=Mod2PI(midHeaven+PIH+ANGLE_HOUSE_R*i);}return housesR;};function tetrabden(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;A1=Math.asin(Math.sin(rightAscension)*Math.tan(latR)*Math.tan(eclipticObliquity));Z=Math.cos(eclipticObliquity);Z2=Math.sin(eclipticObliquity)*Math.tan(latR);for(i=0;i<NUMBER_HOUSE;i++){D=Mod2PI(ANGLE_HOUSE_R*i+PIH);if(D>=PI){KN= -1.0;A2=D/PIH-3;}else{KN=1.0;A2=D/PIH-1;}A3=Mod2PI(rightAscension+D+A2*A1);X=Angle(Math.cos(A3)*Z-KN*Z2,Math.sin(A3));housesR[i]=X;}return housesR;};function tetraaWen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;Z=Math.cos(eclipticObliquity);for(i=0;i<NUMBER_HOUSE;i++){D=ANGLE_HOUSE_R*i+PIH;X=Angle(Math.cos(rightAscension+D)*Z,Math.sin(rightAscension+D));housesR[i]=X;}return housesR;};function tetraayen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;Z=Math.cos(eclipticObliquity);for(i=0;i<NUMBER_HOUSE;i++){D=ANGLE_HOUSE_R*i+PIH;X=Angle(Math.cos(rightAscension+D),Math.sin(rightAscension+D)*Z);housesR[i]=X;}return housesR;};function FNrad(a){return Math.PI/180*a;};function FNdeg(a){return 180/Math.PI*a;};function FNsin(a){return Math.sin(Math.PI/180*a);};function FNcos(a){return Math.cos(Math.PI/180*a);};function FNdec(d,m,s){return d+(m/60)+(s/3600);};function FNmod(a){if(a>360){return a-(parseInt(a/360)*360);}else{return a;}};function FNasn(a){return Math.atan(a/Math.sqrt(1-a*a));};function FNacs(a){return Math.atan(Math.sqrt(1-a*a)/a);};function tetrawen(ra,ob){var x=Math.atan(Math.tan(ra)/Math.cos(ob));if(x<0){x=x+Math.PI;}if(Math.sin(ra)<0){x=x+Math.PI;}return FNmod(FNdeg(x));};function tetrabjen(ra,ob,la){asn=Math.atan(Math.cos(ra)/(-Math.sin(ra)*Math.cos(ob)-Math.tan(la)*Math.sin(ob)));if(asn<0){asn=asn+Math.PI;}if(Math.cos(ra)<0){asn=asn+Math.PI;}return FNmod(FNdeg(asn));};function placidus(ra,ob,la){mc=tetrawen(ra,ob);house=new Array();house[3]=FNmod(mc+180);house[0]=tetrabjen(ra,ob,la);r1=ra+FNrad(30);house[4]=FNmod(plac(3,0,r1,ra,ob,la)+180);r1=ra+FNrad(60);house[5]=FNmod(plac(1.5,0,r1,ra,ob,la)+180);r1=ra+FNrad(120);house[1]=FNmod(plac(1.5,1,r1,ra,ob,la));r1=ra+FNrad(150);house[2]=FNmod(plac(3,1,r1,ra,ob,la));for(i=6;i<12;i++){house[i]=FNmod(house[i-6]+180)};return house;};function plac(ff,y,r1,ra,ob,la){x= -1;if(y==1){x=1;}for(i=1;i<11;i++){xx=FNacs(x*Math.sin(r1)*Math.tan(ob)*Math.tan(la));if(xx<0){xx=xx+Math.PI;}r2=ra+(xx/ff);if(y==1){r2=ra+Math.PI-(xx/ff);}r1=r2;}lo=Math.atan(Math.tan(r1)/Math.cos(ob));if(lo<0){lo=lo+Math.PI};if(Math.sin(r1)<0){lo=lo+Math.PI;}return FNdeg(lo);};function tetranen(rightAscension,eclipticObliquity,latR){var housesR=placidus(rightAscension,eclipticObliquity,latR);for(i=0;i<12;i++){housesR[i]=FNrad(housesR[i]);}return housesR;};function tetrabeen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;housesR[0]=ascendant;housesR[1]=tetraWen(120.0,1.5,true,rightAscension,eclipticObliquity,latR);housesR[2]=tetraWen(150.0,3.0,true,rightAscension,eclipticObliquity,latR);housesR[3]=midHeaven+PI;housesR[4]=tetraWen(30.0,3.0,false,rightAscension,eclipticObliquity,latR)+PI;housesR[5]=tetraWen(60.0,1.5,false,rightAscension,eclipticObliquity,latR)+PI;for(i=0;i<6;i++){housesR[i]=Mod2PI(housesR[i]);housesR[i+6]=Mod2PI(housesR[i]+PI);}return housesR;};function tetraWen(deg,FF,fNeg,rightAscension,eclipticObliquity,latR){R1=Mod2PI(rightAscension+RFromD(deg));if(fNeg){X=1.0;}else{X= -1;}for(i=1;i<=10;i++){XS=X*Math.sin(R1)*Math.tan(eclipticObliquity)*Math.tan((latR==0.0)?0.000001:latR);XS=Math.acos(XS);if(XS<0.0)XS+=PI;if(fNeg){R1=rightAscension+PI-XS/FF;}else{R1=rightAscension+XS/FF;}}LO=Math.atan(Math.tan(R1)/Math.cos(eclipticObliquity));if(LO<0.0){LO+=PI;}if(Math.sin(R1)<0.0){LO+=PI;}return LO;};function tetrafen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));housesR[0]=Mod2PI(ascendant);midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;t=Mod2PI(Math.PI+midHeaven);Y=tetrauen(t,ascendant)/3.0;housesR[1]=Mod2PI(ascendant+Y);housesR[2]=Mod2PI(ascendant+2*Y);housesR[3]=Mod2PI(ascendant+3*Y);Y=tetrauen(midHeaven,ascendant)/3.0;housesR[4]=Mod2PI(Math.PI+midHeaven+Y);housesR[5]=Mod2PI(Math.PI+midHeaven+2*Y);for(i=0;i<6;i++){housesR[i+6]=Mod2PI(housesR[i]+Math.PI);}return housesR;};function tetraauen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;delta=(tetrauen(midHeaven,ascendant)-PI/2.0)/4.0;housesR[6]=Mod2PI(ascendant+PI);housesR[9]=midHeaven;housesR[10]=Mod2PI(housesR[9]+PI/6.0+delta);housesR[11]=Mod2PI(housesR[10]+PI/6.0+delta*2);housesR[8]=Mod2PI(housesR[9]-PI/6.0+delta);housesR[7]=Mod2PI(housesR[8]-PI/6.0+delta*2);for(i=0;i<6;i++)housesR[i]=Mod2PI(housesR[i+6]-PI);return housesR;};function tetrabQen(rightAscension,eclipticObliquity,latR){housesOrig=new Array();housesR=new Array();housesOrig=tetrafen(rightAscension,eclipticObliquity,latR);for(i=0;i<NUMBER_HOUSE;i++){j=i-1;if(i==0){j=11;}Dif=Math.abs(housesOrig[i]-housesOrig[j]);if(Dif>Math.PI){Dif=PI2-Dif;}housesR[i]=Mod2PI(Dif/2.0+housesOrig[j]);}return housesR;};function tetraaen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;Z=Math.cos(eclipticObliquity);Z2=Math.tan(latR)*Math.sin(eclipticObliquity);for(i=0;i<NUMBER_HOUSE;i++){D=ANGLE_HOUSE_R*i+PIH;X=Angle(Math.cos(rightAscension+D)*Z-Math.sin(D)*Z2,Math.sin(rightAscension+D));housesR[i]=X;}return housesR;};function tetraaPen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;TL=Math.tan(latR);P1=Math.atan(TL/3.0);P2=Math.atan(TL/1.5);housesR[0]=tetraYen(90.0,latR,rightAscension,eclipticObliquity);housesR[1]=tetraYen(120.0,P2,rightAscension,eclipticObliquity);housesR[2]=tetraYen(150.0,P1,rightAscension,eclipticObliquity);housesR[3]=midHeaven+PI;housesR[4]=tetraYen(30.0,P1,rightAscension,eclipticObliquity)+PI;housesR[5]=tetraYen(60.0,P2,rightAscension,eclipticObliquity)+PI;for(i=0;i<6;i++){housesR[i]=Mod2PI(housesR[i]);housesR[i+6]=Mod2PI(housesR[i]+PI);}return housesR;};function tetraYen(deg,AA,rightAscension,eclipticObliquity){OA=Mod2PI(rightAscension+RFromD(deg));X=Math.atan(Math.tan(AA)/Math.cos(OA));LO=Math.atan(Math.cos(X)*Math.tan(OA)/Math.cos(X+eclipticObliquity));if(LO<0.0){LO+=PI;}if(Math.sin(OA)<0.0){LO+=PI;}return LO;};function tetrapen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;for(i=0;i<NUMBER_HOUSE;i++){housesR[i]=Mod2PI(ascendant-ANGLE_HOUSE_R/2+ANGLE_HOUSE_R*i);}return housesR;};function tetraagen(rightAscension,eclipticObliquity,latR){housesR=new Array();ascendant=Angle(-Math.sin(rightAscension)*Math.cos(eclipticObliquity)-Math.tan(latR)*Math.sin(eclipticObliquity),Math.cos(rightAscension));midHeaven=Angle(Math.cos(eclipticObliquity),Math.tan(rightAscension));midHeaven=tetrawen(rightAscension,eclipticObliquity)*Math.PI/180;sign=ZFromR(ascendant,3);for(i=0;i<NUMBER_HOUSE;i++){housesR[i]=Mod2PI((sign+i)*ANGLE_HOUSE_R+0.0003);}return housesR;};function Angle(x,y){if(x!=0.0){if(y!=0.0){a=Math.atan(y/x);}else{a=(x<0.0)?PI:0.0;}}else{a=(y<0.0)? -PI/2:PI/2;}if(a<0.0)a+=PI;if(y<0.0)a+=PI;return a;};function Mod2PI(d){PI2=2*Math.PI;if(d>=PI2){d-=PI2;}if(d<0.0){d+=PI2;}if((d>=0)&&(d<=PI2)){return d;}else{return(d-Math.floor(d/PI2)*PI2);}};function Mod360(A){A=A-Math.floor(A/360)*360;if(A<0){A=A+360;}return A;};function ZFromR(r,horoscopMode){return(Math.floor(r/SignAngleR))%NUMBER_SIGN[horoscopMode];};function DFromR(r){return r*45/Math.atan(1);};function RFromD(d){return d/(45/Math.atan(1));};function tetraDen(dd,mm,ss){return(dd+mm/60.0+ss/3600);};function tetrauen(deg1,deg2){i=Math.abs(deg1-deg2);return i<Math.PI?i:2*Math.PI-i;};function tetraFen(JD){U=(JD-2451545)/3652500;Usquared=U*U;Ucubed=Usquared*U;U4=Ucubed*U;U5=U4*U;U6=U5*U;U7=U6*U;U8=U7*U;U9=U8*U;U10=U9*U;return tetraDen(23,26,21.448)-tetraDen(0,0,4680.93)*U-tetraDen(0,0,1.55)*Usquared+tetraDen(0,0,1999.25)*Ucubed-tetraDen(0,0,51.38)*U4-tetraDen(0,0,249.67)*U5-tetraDen(0,0,39.05)*U6+tetraDen(0,0,7.12)*U7+tetraDen(0,0,27.87)*U8+tetraDen(0,0,5.79)*U9+tetraDen(0,0,2.45)*U10;};function tetraSen(JD){JDMidnight=Math.floor(JD-0.5)+0.5;T=(JDMidnight-2451545)/36525;TSquared=T*T;TCubed=TSquared*T;Value=100.46061837+(36000.770053608*T)+(0.000387933*TSquared)-(TCubed/38710000);Value=24110.54841+8640184.812866*T+0.093104*TSquared-0.0000062*TCubed;Value=Value/3600*15.0;Value+=(JD-JDMidnight)*24*1.00273790935*15.0;return Mod360(Value);};function tetraten(angleRad){return(180.0*angleRad/Math.PI);};function tetraZen(angleDeg){return(Math.PI*angleDeg/180.0);};function tetraaren(mn,dy,lpyr){var k=(lpyr?1:2);var doy=Math.floor((275*mn)/9)-k*Math.floor((mn+9)/12)+dy-30;return doy;};function tetrabAen(juld){var A=(juld+1.5)%7;var DOW=(A==0)?"Sunday":(A==1)?"Monday":(A==2)?"Tuesday":(A==3)?"Wednesday":(A==4)?"Thursday":(A==5)?"Friday":"Saturday";return DOW;};function calcJD(year,month,day){if(month<=2){year-=1;month+=12;}var A=Math.floor(year/100);var B=2-A+Math.floor(A/4);var JD=Math.floor(365.25*(year+4716))+Math.floor(30.6001*(month+1))+day+B-1524.5;return JD;};function tetraaHen(jd){var z=Math.floor(jd+0.5);var f=(jd+0.5)-z;if(z<2299161){var A=z;}else{alpha=Math.floor((z-1867216.25)/36524.25);var A=z+1+alpha-Math.floor(alpha/4);}var B=A+1524;var C=Math.floor((B-122.1)/365.25);var D=Math.floor(365.25*C);var E=Math.floor((B-D)/30.6001);var day=B-D-Math.floor(30.6001*E)+f;var month=(E<14)?E-1:E-13;var year=(month>2)?C-4716:C-4715;return(day+"-"+monthList[month-1].name+"-"+year);};function tetraaFen(jd){var z=Math.floor(jd+0.5);var f=(jd+0.5)-z;if(z<2299161){var A=z;}else{alpha=Math.floor((z-1867216.25)/36524.25);var A=z+1+alpha-Math.floor(alpha/4);}var B=A+1524;var C=Math.floor((B-122.1)/365.25);var D=Math.floor(365.25*C);var E=Math.floor((B-D)/30.6001);var day=B-D-Math.floor(30.6001*E)+f;var month=(E<14)?E-1:E-13;var year=(month>2)?C-4716:C-4715;return((day<10?"0":"")+day+monthList[month-1].abbr);};function tetraUen(jd){var T=(jd-2451545.0)/36525.0;return T;};function tetraCen(t){var JD=t*36525.0+2451545.0;return JD;};function tetraTen(t){var L0=280.46646+t*(36000.76983+0.0003032*t);while(L0>360.0){L0-=360.0;}while(L0<0.0){L0+=360.0;}return L0;};function tetraben(t){var M=357.52911+t*(35999.05029-0.0001537*t);return M;};function tetraNen(t){var e=0.016708634-t*(0.000042037+0.0000001267*t);return e;};function tetraVen(t){var m=tetraben(t);var mrad=tetraZen(m);var sinm=Math.sin(mrad);var sin2m=Math.sin(mrad+mrad);var sin3m=Math.sin(mrad+mrad+mrad);var C=sinm*(1.914602-t*(0.004817+0.000014*t))+sin2m*(0.019993-0.000101*t)+sin3m*0.000289;return C;};function tetraJen(t){var l0=tetraTen(t);var c=tetraVen(t);var O=l0+c;return O;};function tetraaoen(t){var m=tetraben(t);var c=tetraVen(t);var v=m+c;return v;};function tetraaUen(t){var v=tetraaoen(t);var e=tetraNen(t);var R=(1.000001018*(1-e*e))/(1+e*Math.cos(tetraZen(v)));return R;};function tetraQen(t){var o=tetraJen(t);var omega=125.04-1934.136*t;var lambda=o-0.00569-0.00478*Math.sin(tetraZen(omega));return lambda;};function tetraalen(t){var seconds=21.448-t*(46.8150+t*(0.00059-t*(0.001813)));var e0=23.0+(26.0+(seconds/60.0))/60.0;return e0;};function tetraOen(t){var e0=tetraalen(t);var omega=125.04-1934.136*t;var e=e0+0.00256*Math.cos(tetraZen(omega));return e;};function tetraanen(t){var e=tetraOen(t);var lambda=tetraQen(t);var tananum=(Math.cos(tetraZen(e))*Math.sin(tetraZen(lambda)));var tanadenom=(Math.cos(tetraZen(lambda)));var alpha=tetraten(Math.atan2(tananum,tanadenom));return alpha;};function tetrahen(t){var e=tetraOen(t);var lambda=tetraQen(t);var sint=Math.sin(tetraZen(e))*Math.sin(tetraZen(lambda));var theta=tetraten(Math.asin(sint));return theta;};function tetraEen(t){var epsilon=tetraOen(t);var l0=tetraTen(t);var e=tetraNen(t);var m=tetraben(t);var y=Math.tan(tetraZen(epsilon)/2.0);y*=y;var sin2l0=Math.sin(2.0*tetraZen(l0));var sinm=Math.sin(tetraZen(m));var cos2l0=Math.cos(2.0*tetraZen(l0));var sin4l0=Math.sin(4.0*tetraZen(l0));var sin2m=Math.sin(2.0*tetraZen(m));var Etime=y*sin2l0-2.0*e*sinm+4.0*e*y*sinm*cos2l0-0.5*y*y*sin4l0-1.25*e*e*sin2m;return tetraten(Etime)*4.0;};function tetrasen(lat,solarDec){var latRad=tetraZen(lat);var sdRad=tetraZen(solarDec);var HAarg=(Math.cos(tetraZen(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad));var HA=(Math.acos(Math.cos(tetraZen(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad)));return HA;};function tetraden(lat,solarDec){var latRad=tetraZen(lat);var sdRad=tetraZen(solarDec);var HAarg=(Math.cos(tetraZen(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad));var HA=(Math.acos(Math.cos(tetraZen(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad)));return-HA;};function tetraasen(JD,latitude,longitude){var t=tetraUen(JD);var noonmin=tetramen(t,longitude);var tnoon=tetraUen(JD+noonmin/1440.0);var eqTime=tetraEen(tnoon);var solarDec=tetrahen(tnoon);var hourAngle=tetrasen(latitude,solarDec);var delta=longitude-tetraten(hourAngle);var timeDiff=4*delta;var timeUTC=720+timeDiff-eqTime;var newt=tetraUen(tetraCen(t)+timeUTC/1440.0);eqTime=tetraEen(newt);solarDec=tetrahen(newt);hourAngle=tetrasen(latitude,solarDec);delta=longitude-tetraten(hourAngle);timeDiff=4*delta;timeUTC=720+timeDiff-eqTime;return timeUTC;};function tetramen(t,longitude){var tnoon=tetraUen(tetraCen(t)+longitude/360.0);var eqTime=tetraEen(tnoon);var solNoonUTC=720+(longitude*4)-eqTime;var newt=tetraUen(tetraCen(t)-0.5+solNoonUTC/1440.0);eqTime=tetraEen(newt);solNoonUTC=720+(longitude*4)-eqTime;return solNoonUTC;};function tetraaYen(JD,latitude,longitude){var t=tetraUen(JD);var noonmin=tetramen(t,longitude);var tnoon=tetraUen(JD+noonmin/1440.0);var eqTime=tetraEen(tnoon);var solarDec=tetrahen(tnoon);var hourAngle=tetraden(latitude,solarDec);var delta=longitude-tetraten(hourAngle);var timeDiff=4*delta;var timeUTC=720+timeDiff-eqTime;var newt=tetraUen(tetraCen(t)+timeUTC/1440.0);eqTime=tetraEen(newt);solarDec=tetrahen(newt);hourAngle=tetraden(latitude,solarDec);delta=longitude-tetraten(hourAngle);timeDiff=4*delta;timeUTC=720+timeDiff-eqTime;return timeUTC;};function tetraKen(pl){var info=[4,3,2,1,0,2,3,4,5,6,6,5];var v=Math.floor(pl/30.0);return info[v];};function M360(v_val){if(v_val>=360){return(v_val-Math.floor(v_val/360.0)*360.0);}if(v_val<0){v_val=v_val+Math.floor(Math.abs(v_val/360.0)+1)*360;return v_val;}return v_val;};function ParsFull(day_chart,longitude_ecl,house_all,SAN_LONG){var house_longitude=[];for(i=1;i<13;i++){house_longitude[i]=house_all[i-1]*45/Math.atan(1);}Asc=house_longitude[1];Sun=longitude_ecl[0];Moon=longitude_ecl[1];Mercury=longitude_ecl[2];Venus=longitude_ecl[3];Mars=longitude_ecl[4];Jupiter=longitude_ecl[5];Saturn=longitude_ecl[6];var ExaltationDegree=[];ExaltationDegree[0]=19;ExaltationDegree[1]=33;ExaltationDegree[2]=135;ExaltationDegree[3]=357;ExaltationDegree[4]=298;ExaltationDegree[5]=105;ExaltationDegree[6]=201;var pars_description=[];pars_description[0]="<?php echo $translate_json['Life']; ?>";pars_description[1]="<?php echo $translate_json['Pillar of horoscope - Nativities, permanence, constancy']; ?>";pars_description[2]="<?php echo $translate_json['Reasoning and eloquence']; ?>";pars_description[3]="<?php echo $translate_json['Property']; ?>";pars_description[4]="<?php echo $translate_json['Debt']; ?>";pars_description[5]="<?php echo $translate_json['Treasure Trove']; ?>";pars_description[6]="<?php echo $translate_json['Brothers']; ?>";pars_description[7]="<?php echo $translate_json['Number of brothers']; ?>";pars_description[8]="<?php echo $translate_json['Death of brothers & sisters']; ?>";pars_description[9]="<?php echo $translate_json['Parents']; ?>";pars_description[10]="<?php echo $translate_json['Death of parents']; ?>";pars_description[11]="<?php echo $translate_json['Grandparents']; ?>";pars_description[12]="<?php echo $translate_json['Ancestors and relations']; ?>";pars_description[13]="<?php echo $translate_json['Ancestors and relations']; ?>";pars_description[14]="<?php echo $translate_json['Real estate acc. Hermes']; ?>";pars_description[15]="<?php echo $translate_json['Real estate acc. some Persians']; ?>";pars_description[16]="<?php echo $translate_json['Agriculture, tillage']; ?>";pars_description[17]="<?php echo $translate_json['Issue of affairs [end of matter]']; ?>";pars_description[18]="<?php echo $translate_json['Children']; ?>";pars_description[19]="<?php echo $translate_json['Time and number of sexes']; ?>";pars_description[20]="<?php echo $translate_json['Condition of males']; ?>";pars_description[21]="<?php echo $translate_json['Condition of females']; ?>";pars_description[22]="<?php echo $translate_json['Whether expected birth is male or female']; ?>";pars_description[23]="<?php echo $translate_json['Disease, defects, time of onset acc. Hermes']; ?>";pars_description[24]="<?php echo $translate_json['Disease, defects, time of onset acc. some of the ancients']; ?>";pars_description[25]="<?php echo $translate_json['Captivity']; ?>";pars_description[26]="<?php echo $translate_json['Slaves']; ?>";pars_description[27]="<?php echo $translate_json['Marriage of men acc. Hermes']; ?>";pars_description[28]="<?php echo $translate_json['Marriage of men acc. Vettius Valens']; ?>";pars_description[29]="<?php echo $translate_json['Trickery and deception of men and women']; ?>";pars_description[30]="<?php echo $translate_json['Intercourse']; ?>";pars_description[31]="<?php echo $translate_json['Marriage of women (Hermes)']; ?>";pars_description[32]="<?php echo $translate_json['Marriage of women (Valens)']; ?>";pars_description[33]="<?php echo $translate_json['Misconduct by women']; ?>";pars_description[34]="<?php echo $translate_json['Trickery and deceit of men by women']; ?>";pars_description[35]="<?php echo $translate_json['Intercourse']; ?>";pars_description[36]="<?php echo $translate_json['Unchastity of women']; ?>";pars_description[37]="<?php echo $translate_json['Chastity of women']; ?>";pars_description[38]="<?php echo $translate_json['Marriage of men and women acc. Hermes']; ?>";pars_description[39]="<?php echo $translate_json['Time of marriage (Hermes)']; ?>";pars_description[40]="<?php echo $translate_json['Fraudulent marriage & Facilitating it']; ?>";pars_description[41]="<?php echo $translate_json['Sons in law']; ?>";pars_description[42]="<?php echo $translate_json['Lawsuits']; ?>";pars_description[43]="<?php echo $translate_json['Death']; ?>";pars_description[44]="<?php echo $translate_json['Anairetai [anareta: destroyer]']; ?>";pars_description[45]="<?php echo $translate_json['Year to be feared at birth for death, famine']; ?>";pars_description[46]="<?php echo $translate_json['Place of murder and sickness']; ?>";pars_description[47]="<?php echo $translate_json['Danger of violence']; ?>";pars_description[48]="<?php echo $translate_json['Journeys']; ?>";pars_description[49]="<?php echo $translate_json['By water']; ?>";pars_description[50]="<?php echo $translate_json['Timidity and hiding']; ?>";pars_description[51]="<?php echo $translate_json['Deep reflection']; ?>";pars_description[52]="<?php echo $translate_json['Understanding and wisdom']; ?>";pars_description[53]="<?php echo $translate_json['Traditions, knowledge of affairs']; ?>";pars_description[54]="<?php echo $translate_json['Knowledge whether true or false']; ?>";pars_description[55]="<?php echo $translate_json['Noble births']; ?>";pars_description[56]="<?php echo $translate_json['Kings and Sultans']; ?>";pars_description[57]="<?php echo $translate_json['Administrators, vazirs [ministers], etc.']; ?>";pars_description[58]="<?php echo $translate_json['Sultan\'s victory, conquest']; ?>";pars_description[59]="<?php echo $translate_json['Of those who rise in station']; ?>";pars_description[60]="<?php echo $translate_json['Celebrated persons of rank']; ?>";pars_description[61]="<?php echo $translate_json['Armies and police']; ?>";pars_description[62]="<?php echo $translate_json['Sultan. Those concerned In nativities']; ?>";pars_description[63]="<?php echo $translate_json['Merchants and their work']; ?>";pars_description[64]="<?php echo $translate_json['Buying and selling']; ?>";pars_description[65]="<?php echo $translate_json['Operations and orders in medical Treatment']; ?>";pars_description[66]="<?php echo $translate_json['Mothers']; ?>";pars_description[67]="<?php echo $translate_json['Glory']; ?>";pars_description[68]="<?php echo $translate_json['Friendship and enmity']; ?>";pars_description[69]="<?php echo $translate_json['Known by men and revered, Constant in affairs']; ?>";pars_description[70]="<?php echo $translate_json['Success']; ?>";pars_description[71]="<?php echo $translate_json['Worldliness']; ?>";pars_description[72]="<?php echo $translate_json['Hope']; ?>";pars_description[73]="<?php echo $translate_json['Friends']; ?>";pars_description[74]="<?php echo $translate_json['Violence']; ?>";pars_description[75]="<?php echo $translate_json['Abundance in house']; ?>";pars_description[76]="<?php echo $translate_json['Liberty of Person']; ?>";pars_description[77]="<?php echo $translate_json['Praise and acceptation']; ?>";pars_description[78]="<?php echo $translate_json['Enmity acc. some of the ancients']; ?>";pars_description[79]="<?php echo $translate_json['Enmity acc. Hermes']; ?>";pars_description[80]="<?php echo $translate_json['Bad luck']; ?>";pars_description[81]="<?php echo $translate_json['Fortune or Lunar horoscope']; ?>";pars_description[82]="<?php echo $translate_json['Daemon and religion [Spirit]']; ?>";pars_description[83]="<?php echo $translate_json['Friendship and love']; ?>";pars_description[84]="<?php echo $translate_json['Despair & penury & fraud']; ?>";pars_description[85]="<?php echo $translate_json['Captivity, prisons and escape therefrom']; ?>";pars_description[86]="<?php echo $translate_json['Victory, triumph & aid']; ?>";pars_description[87]="<?php echo $translate_json['Valour and bravery']; ?>";pars_description[88]="<?php echo $translate_json['Hailaj [Hyleg, life-giver]']; ?>";pars_description[89]="<?php echo $translate_json['Debilitated bodies']; ?>";pars_description[90]="<?php echo $translate_json['Horsemanship, bravery']; ?>";pars_description[91]="<?php echo $translate_json['Boldness, violence and murder']; ?>";pars_description[92]="<?php echo $translate_json['Trickery and deceit']; ?>";pars_description[93]="<?php echo $translate_json['Necessity and wish']; ?>";pars_description[94]="<?php echo $translate_json['Requirements and necessities acc. Egyptians']; ?>";pars_description[95]="<?php echo $translate_json['Realisation of needs and desires']; ?>";pars_description[96]="<?php echo $translate_json['Retribution']; ?>";pars_description[97]="<?php echo $translate_json['Rectitude']; ?>";var pars_n=[];if(day_chart>0){lord_of_time=Sun;Fortune=M360(Asc+Moon-Sun);Spirit=M360(Asc+Sun-Moon);pars_n[0]=M360(Asc+Saturn-Jupiter);pars_n[1]=M360(Asc+Spirit-Fortune);pars_n[2]=M360(Asc+Mars-Mercury);ruler=tetraKen(house_longitude[2]);pars_n[3]=M360(Asc+house_longitude[2]-longitude_ecl[ruler]);pars_n[4]=M360(Asc+Mercury-Saturn);pars_n[5]=M360(Asc+Venus-Mercury);pars_n[6]=M360(Asc+Jupiter-Saturn);pars_n[7]=M360(Asc+Saturn-Mercury);pars_n[8]=M360(Asc+70-Sun);dif=Math.abs(Sun-Saturn);if(dif>180){dif=360-dif;}if(dif>15){pars_n[9]=M360(Asc+Saturn-Sun);}else{pars_n[9]=M360(Asc+Saturn-Jupiter);}pars_n[10]=M360(Asc+Jupiter-Saturn);pars_n[11]=M360(Asc+Saturn-house_longitude[2]);pars_n[12]=M360(Asc+Mars-Saturn);pars_n[13]=M360(Asc+Mars-Saturn);pars_n[14]=M360(Asc+Moon-Saturn);pars_n[15]=M360(Asc+Jupiter-Mercury);pars_n[16]=M360(Asc+Saturn-Venus);ruler=tetraKen(SAN_LONG);pars_n[17]=M360(Asc+longitude_ecl[ruler]-Saturn);pars_n[18]=M360(Asc+Saturn-Jupiter);pars_n[19]=M360(Asc+Jupiter-Mars);pars_n[20]=M360(Asc+Jupiter-Mars);pars_n[21]=M360(Asc+Venus-Moon);ruler=tetraKen(Moon);pars_n[22]=M360(Asc+Moon-longitude_ecl[ruler]);pars_n[23]=M360(Asc+Mars-Saturn);pars_n[24]=M360(Asc+Mars-Mercury);ruler=tetraKen(lord_of_time);pars_n[25]=M360(Asc+longitude_ecl[ruler]-lord_of_time);pars_n[26]=M360(Asc+Moon-Mercury);pars_n[27]=M360(Asc+Venus-Saturn);pars_n[28]=M360(Asc+Venus-Sun);pars_n[29]=M360(Asc+Venus-Sun);pars_n[30]=M360(Asc+Venus-Sun);pars_n[31]=M360(Asc+Saturn-Venus);pars_n[32]=M360(Asc+Mars-Moon);pars_n[33]=M360(Asc+Mars-Moon);pars_n[34]=M360(Asc+Mars-Moon);pars_n[35]=M360(Asc+Mars-Moon);pars_n[36]=M360(Asc+Mars-Moon);pars_n[37]=M360(Asc+Venus-Moon);pars_n[38]=M360(Asc+house_longitude[7]-Venus);pars_n[39]=M360(Asc+Moon-Sun);pars_n[40]=M360(Asc+Venus-Saturn);pars_n[41]=M360(Asc+Venus-Saturn);pars_n[42]=M360(Asc+Jupiter-Mars);pars_n[43]=M360(Saturn+house_longitude[8]-Moon);ruler=tetraKen(Asc);pars_n[44]=M360(Asc+Moon-longitude_ecl[ruler]);ruler=tetraKen(SAN_LONG);pars_n[45]=M360(Asc+longitude_ecl[ruler]-Saturn);pars_n[46]=M360(Mercury+Mars-Saturn);pars_n[47]=M360(Asc+Mercury-Saturn);ruler=tetraKen(house_longitude[9]);pars_n[48]=M360(Asc+house_longitude[9]-longitude_ecl[ruler]);pars_n[49]=M360(Asc+105-Saturn);pars_n[50]=M360(Asc+Mercury-Moon);pars_n[51]=M360(Asc+Moon-Saturn);pars_n[52]=M360(Asc+Sun-Saturn);pars_n[53]=M360(Asc+Jupiter-Sun);pars_n[54]=M360(Asc+Moon-Mercury);pars_n[55]=M360(Asc+ExaltationDegree[lord_of_time]-lord_of_time);pars_n[56]=M360(Asc+Mars-Mercury);pars_n[57]=M360(Asc+Mars-Mercury);pars_n[58]=M360(Asc+Saturn-Sun);pars_n[59]=M360(Asc+Fortune-Saturn);pars_n[60]=M360(Asc+Sun-Saturn);pars_n[61]=M360(Asc+Saturn-Mars);pars_n[62]=M360(Asc+Moon-Saturn);pars_n[63]=M360(Asc+Venus-Mercury);pars_n[64]=M360(Asc+Fortune-Spirit);pars_n[65]=M360(Asc+Jupiter-Sun);pars_n[66]=M360(Asc+Moon-Venus);pars_n[67]=M360(Asc+Spirit-Fortune);pars_n[68]=M360(Asc+Spirit-Fortune);pars_n[69]=M360(Asc+Sun-Fortune);pars_n[70]=M360(Asc+Jupiter-Fortune);pars_n[71]=M360(Asc+Venus-Fortune);pars_n[72]=M360(Asc+Mercury-Jupiter);pars_n[73]=M360(Asc+Mercury-Moon);pars_n[74]=M360(Asc+Mercury-Spirit);pars_n[75]=M360(Asc+Sun-Moon);pars_n[76]=M360(Asc+Sun-Mercury);pars_n[77]=M360(Asc+Venus-Jupiter);pars_n[78]=M360(Asc+Mars-Saturn);ruler=tetraKen(house_longitude[12]);pars_n[79]=M360(Asc+house_longitude[12]-longitude_ecl[ruler]);pars_n[80]=M360(Asc+Fortune-Spirit);pars_n[81]=M360(Asc+Moon-Sun);pars_n[82]=M360(Asc+Sun-Moon);pars_n[83]=M360(Asc+Spirit-Fortune);pars_n[84]=M360(Asc+Fortune-Spirit);pars_n[85]=M360(Asc+Fortune-Saturn);pars_n[86]=M360(Asc+Jupiter-Spirit);pars_n[87]=M360(Asc+Fortune-Mars);pars_n[88]=M360(Asc+Moon-SAN_LONG);pars_n[89]=M360(Asc+Mars-Fortune);pars_n[90]=M360(Asc+Moon-Saturn);ruler=tetraKen(Asc);pars_n[91]=M360(Asc+Moon-longitude_ecl[ruler]);pars_n[92]=M360(Asc+Spirit-Mercury);pars_n[93]=M360(Asc+Mars-Saturn);pars_n[94]=M360(Asc+house_longitude[3]-Mars);pars_n[95]=M360(Asc+Mercury-Fortune);pars_n[96]=M360(Asc+Sun-Mars);pars_n[97]=M360(Asc+Mars-Mercury);}else{lord_of_time=Moon;Fortune=M360(Asc-Moon+Sun);Spirit=M360(Asc-Sun+Moon);pars_n[0]=M360(Asc-Saturn+Jupiter);pars_n[1]=M360(Asc-Spirit+Fortune);pars_n[2]=M360(Asc-Mars+Mercury);ruler=tetraKen(house_longitude[2]);pars_n[3]=M360(Asc-house_longitude[2]+longitude_ecl[ruler]);pars_n[4]=M360(Asc-Mercury+Saturn);pars_n[5]=M360(Asc+Venus-Mercury);pars_n[6]=M360(Asc+Jupiter-Saturn);pars_n[7]=M360(Asc+Saturn-Mercury);pars_n[8]=M360(Asc-70+Sun);dif=Math.abs(Sun-Saturn);if(dif>180){dif=360-dif;}if(dif>15){pars_n[9]=M360(Asc-Saturn+Sun);}else{pars_n[9]=M360(Asc-Saturn+Jupiter);}pars_n[10]=M360(Asc-Jupiter+Saturn);pars_n[11]=M360(Asc-Saturn+house_longitude[2]);pars_n[12]=M360(Asc-Mars+Saturn);pars_n[13]=M360(Asc-Mars+Saturn);pars_n[14]=M360(Asc-Moon+Saturn);pars_n[15]=M360(Asc-Jupiter+Mercury);pars_n[16]=M360(Asc+Saturn-Venus);ruler=tetraKen(SAN_LONG);pars_n[17]=M360(Asc+longitude_ecl[ruler]-Saturn);pars_n[18]=M360(Asc-Saturn+Jupiter);pars_n[19]=M360(Asc+Jupiter-Mars);pars_n[20]=M360(Asc+Jupiter-Mars);pars_n[21]=M360(Asc+Venus-Moon);ruler=tetraKen(Moon);pars_n[22]=M360(Asc-Moon+longitude_ecl[ruler]);pars_n[23]=M360(Asc-Mars+Saturn);pars_n[24]=M360(Asc+Mars-Mercury);ruler=tetraKen(lord_of_time);pars_n[25]=M360(Asc+longitude_ecl[ruler]-lord_of_time);pars_n[26]=M360(Asc+Moon-Mercury);pars_n[27]=M360(Asc+Venus-Saturn);pars_n[28]=M360(Asc+Venus-Sun);pars_n[29]=M360(Asc+Venus-Sun);pars_n[30]=M360(Asc+Venus-Sun);pars_n[31]=M360(Asc+Saturn-Venus);pars_n[32]=M360(Asc+Mars-Moon);pars_n[33]=M360(Asc+Mars-Moon);pars_n[34]=M360(Asc+Mars-Moon);pars_n[35]=M360(Asc+Mars-Moon);pars_n[36]=M360(Asc+Mars-Moon);pars_n[37]=M360(Asc+Venus-Moon);pars_n[38]=M360(Asc+house_longitude[7]-Venus);pars_n[39]=M360(Asc+Moon-Sun);pars_n[40]=M360(Asc+Venus-Saturn);pars_n[41]=M360(Asc-Venus+Saturn);pars_n[42]=M360(Asc-Jupiter+Mars);pars_n[43]=M360(Saturn+house_longitude[8]-Moon);ruler=tetraKen(Asc);pars_n[44]=M360(Asc-Moon+longitude_ecl[ruler]);ruler=tetraKen(SAN_LONG);pars_n[45]=M360(Asc+longitude_ecl[ruler]-Saturn);pars_n[46]=M360(Mercury-Mars+Saturn);pars_n[47]=M360(Asc-Mercury+Saturn);ruler=tetraKen(house_longitude[9]);pars_n[48]=M360(Asc+house_longitude[9]-longitude_ecl[ruler]);pars_n[49]=M360(Asc-105+Saturn);pars_n[50]=M360(Asc-Mercury+Moon);pars_n[51]=M360(Asc-Moon+Saturn);pars_n[52]=M360(Asc-Sun+Saturn);pars_n[53]=M360(Asc-Jupiter+Sun);pars_n[54]=M360(Asc+Moon-Mercury);pars_n[55]=M360(Asc-ExaltationDegree[lord_of_time]+lord_of_time);pars_n[56]=M360(Asc-Mars+Mercury);pars_n[57]=M360(Asc-Mars+Mercury);pars_n[58]=M360(Asc-Saturn+Sun);pars_n[59]=M360(Asc-Fortune+Saturn);pars_n[60]=M360(Asc+Sun-Saturn);pars_n[61]=M360(Asc-Saturn+Mars);pars_n[62]=M360(Asc+Moon-Saturn);pars_n[63]=M360(Asc-Venus+Mercury);pars_n[64]=M360(Asc-Fortune+Spirit);pars_n[65]=M360(Asc-Jupiter+Sun);pars_n[66]=M360(Asc-Moon+Venus);pars_n[67]=M360(Asc-Spirit+Fortune);pars_n[68]=M360(Asc-Spirit+Fortune);pars_n[69]=M360(Asc-Sun+Fortune);pars_n[70]=M360(Asc-Jupiter+Fortune);pars_n[71]=M360(Asc-Venus+Fortune);pars_n[72]=M360(Asc-Mercury+Jupiter);pars_n[73]=M360(Asc+Mercury-Moon);pars_n[74]=M360(Asc+Mercury-Spirit);pars_n[75]=M360(Asc+Sun-Moon);pars_n[76]=M360(Asc-Sun+Mercury);pars_n[77]=M360(Asc-Venus+Jupiter);pars_n[78]=M360(Asc+Mars-Saturn);ruler=tetraKen(house_longitude[12]);pars_n[79]=M360(Asc+house_longitude[12]-longitude_ecl[ruler]);pars_n[80]=M360(Asc+Fortune-Spirit);pars_n[81]=M360(Asc-Moon+Sun);pars_n[82]=M360(Asc-Sun+Moon);pars_n[83]=M360(Asc-Spirit+Fortune);pars_n[84]=M360(Asc-Fortune+Spirit);pars_n[85]=M360(Asc-Fortune+Saturn);pars_n[86]=M360(Asc-Jupiter+Spirit);pars_n[87]=M360(Asc-Fortune+Mars);pars_n[88]=M360(Asc+Moon-SAN_LONG);pars_n[89]=M360(Asc-Mars+Fortune);pars_n[90]=M360(Asc-Moon+Saturn);ruler=tetraKen(Asc);pars_n[91]=M360(Asc-Moon+longitude_ecl[ruler]);pars_n[92]=M360(Asc-Spirit+Mercury);pars_n[93]=M360(Asc+Mars-Saturn);pars_n[94]=M360(Asc+house_longitude[3]-Mars);pars_n[95]=M360(Asc+Mercury-Fortune);pars_n[96]=M360(Asc-Sun+Mars);pars_n[97]=M360(Asc-Mars+Mercury);}var res=[];res[0]=pars_description;res[1]=pars_n;return res;};TWOPI=Math.PI*2;DEGTORAD=Math.PI/180;RADTODEG=180.0/Math.PI;J2000=2451545.0;B1950=2433282.42345905;J1900=2415020.0;var aya_systems=[[2433282.5,24.042044444,false],[2435553.5,23.250182778-0.004660222,false],[J1900,360-333.58695,false],[J1900,360-338.98556,false],[J1900,360-341.33904,false],[J1900,360-337.636111,false],[J1900,360-333.0369024,false],[J1900,360-338.917778,false],[J1900,360-338.634444,false],[1674484,-9.33333,true],[1927135.8747793,0,true],[J2000,0,false],[J1900,0,false],[B1950,0,false]];function epsiln(J){T=(J-2451545.0)/36525.0;T/=10.0;eps=(((((((((2.45e-10*T+5.79e-9)*T+2.787e-7)*T+7.12e-7)*T-3.905e-5)*T-2.4967e-3)*T-5.138e-3)*T+1.99925)*T-0.0155)*T-468.093)*T+84381.448;eps*=DEGTORAD/3600.0;return(eps);};function tetraBen(R,J,direction,prec_method){var x=[0,0,0];if(J==J2000){return x;}T=(J-J2000)/36525.0;if(prec_method==0){Z1=((0.017998*T+0.30188)*T+2306.2181)*T*DEGTORAD/3600;Z2=((0.018203*T+1.09468)*T+2306.2181)*T*DEGTORAD/3600;TH=((-0.041833*T-0.42665)*T+2004.3109)*T*DEGTORAD/3600;}else if(prec_method==1){Z1=(((((-0.0000002*T-0.0000327)*T+0.0179663)*T+0.3019015)*T+2306.0809506)*T+2.5976176)*DEGTORAD/3600;Z2=(((((-0.0000003*T-0.000047)*T+0.0182237)*T+1.0947790)*T+2306.0803226)*T-2.5976176)*DEGTORAD/3600;TH=((((-0.0000001*T-0.0000601)*T-0.0418251)*T-0.4269353)*T+2004.1917476)*T*DEGTORAD/3600;}else if(prec_method==2){T=(J-J2000)/36525.0;Z1=(((((-0.0000003173*T-0.000005971)*T+0.01801828)*T+0.2988499)*T+2306.083227)*T+2.650545)*DEGTORAD/3600;Z2=(((((-0.0000002904*T-0.000028596)*T+0.01826837)*T+1.0927348)*T+2306.077181)*T-2.650545)*DEGTORAD/3600;TH=((((-0.00000011274*T-0.000007089)*T-0.04182264)*T-0.4294934)*T+2004.191903)*T*DEGTORAD/3600;}else if(prec_method==3){Z1=((((((-0.00000000013*T-0.0000003040)*T-0.000005708)*T+0.01801752)*T+0.3023262)*T+2306.080472)*T+2.72767)*DEGTORAD/3600;Z2=((((((-0.00000000005*T-0.0000002486)*T-0.000028276)*T+0.01826676)*T+1.0956768)*T+2306.076070)*T-2.72767)*DEGTORAD/3600;TH=((((((0.000000000009*T+0.00000000036)*T-0.0000001127)*T-0.000007291)*T-0.04182364)*T-0.4266980)*T+2004.190936)*T*DEGTORAD/3600;}else{return x;}sinth=Math.sin(TH);costh=Math.cos(TH);sinZ1=Math.sin(Z1);cosZ1=Math.cos(Z1);sinZ2=Math.sin(Z2);cosZ2=Math.cos(Z2);A=cosZ1*costh;B=sinZ1*costh;if(direction<0){x[0]=(A*cosZ2-sinZ1*sinZ2)*R[0]-(B*cosZ2+cosZ1*sinZ2)*R[1]-sinth*cosZ2*R[2];x[1]=(A*sinZ2+sinZ1*cosZ2)*R[0]-(B*sinZ2-cosZ1*cosZ2)*R[1]-sinth*sinZ2*R[2];x[2]=cosZ1*sinth*R[0]-sinZ1*sinth*R[1]+costh*R[2];}else{x[0]=(A*cosZ2-sinZ1*sinZ2)*R[0]+(A*sinZ2+sinZ1*cosZ2)*R[1]+cosZ1*sinth*R[2];x[1]= -(B*cosZ2+cosZ1*sinZ2)*R[0]-(B*sinZ2-cosZ1*cosZ2)*R[1]-sinZ1*sinth*R[2];x[2]= -sinth*cosZ2*R[0]-sinth*sinZ2*R[1]+costh*R[2];}return x;};function coortrf(xpo,eps){var x=[0,0,0];var xpn=[0,0,0];sineps=Math.sin(eps);coseps=Math.cos(eps);x[0]=xpo[0];x[1]=xpo[1]*coseps+xpo[2]*sineps;x[2]= -xpo[1]*sineps+xpo[2]*coseps;xpn[0]=x[0];xpn[1]=x[1];xpn[2]=x[2];return xpn;};function cartpol(x){var ll=[0,0,0];var l=[0,0,0];if(x[0]==0&&x[1]==0&&x[2]==0){l[0]=l[1]=l[2]=0;return;}rxy=x[0]*x[0]+x[1]*x[1];ll[2]=Math.sqrt(rxy+x[2]*x[2]);rxy=Math.sqrt(rxy);ll[0]=Math.atan2(x[1],x[0]);if(ll[0]<0.0)ll[0]+=TWOPI;if(rxy==0){if(x[2]>=0)ll[1]=PI/2;else ll[1]= -(PI/2);}else{ll[1]=Math.atan(x[2]/rxy);}l[0]=ll[0];l[1]=ll[1];l[2]=ll[2];return ll;};function degnorm(x){y=Math.floor(x/360.0);y=x-360*y;if(Math.abs(y)<1e-13){y=0;}if(y<0.0){y+=360.0;}return y;};function tetraken(tjd_et,sys){var x=[0,0,0];var res=[0,0,0];x[0]=1;x[1]=0;x[2]=0;if(tjd_et!=J2000){res=tetraBen(x,tjd_et,1,3);}sip_t0=aya_systems[sys][0];sip_t0_is_UT=aya_systems[sys][2];sip_ayan_t0=aya_systems[sys][1];t0=sip_t0;if(sip_t0_is_UT){t0+=dT(t0);}x=tetraBen(res,t0,-1,3);eps=epsiln(t0);res=coortrf(x,eps);x=cartpol(res);x[0]=x[0]*RADTODEG-sip_ayan_t0;daya=degnorm(-x[0]);return daya;};function dT(jd){y=jdtoYear(jd);var c= -0.000012932*Math.pow((y-1955),2);var dt=0,u=0,t=0;t2=t*t;t3=t*t*t;t4=t*t*t*t;t5=t4*t;t6=t5*t;t7=t6*t;if(y<= -500){u=(y-1820)/100;dt= -20+32*u*u+c;}else if(y< -500&&y<=500){u=y/100;dt=10583.6-1014.41*u+33.78311*u*u-5.952053*u*u*u-0.1798452*u*u*u*u+0.022174192*u*u*u*u*u+0.0090316521*u*u*u*u*u*u+c;}else if(y>500&&y<=1600){u=(y-1000)/100;dt=1574.2-556.01*u+71.23472*u*u+0.319781*u*u*u-0.8503463*u*u*u*u-0.005050998*u*u*u*u*u+0.0083572073*u*u*u*u*u*u+c;}else if(y>1600&&y<=1700){t=(y-1600);dt=120-0.9808*t-0.01532*t2+t3/7129+c;}else if(y>1700&&y<=1800){t=(y-1800);dt=13.72-0.332447*t+0.0068612*t2+0.0041116*t3-0.00037436*t4+0.0000121272*t5-0.0000001699*t6+0.000000000875*t7+c;}else if(y>1860&&y<=1900){t=(y-1860);dt=7.62+0.5737*t-0.251754*t2+0.01680668*t3-0.0004473624*t4+t5/233174+c;}else if(y>1900&&y<=1920){t=(y-1920);dt=21.20+0.84493*t-0.076100*t2+0.0020936*t3+c;}else if(y>1941&&y<=1961){t=(y-1950);dt=29.07+0.407*t-t2/233+t3/2547;}else if(y>1961&&y<=1986){t=(y-1975);dt=45.45+1.067*t-t2/260-t3/718;}else if(y>1986&&y<=2005){t=(y-2000);dt=3.86+0.3345*t-0.060374*t2+0.0017275*t3+0.000651814*t4+0.00002373599*t5;}else if(y>2005&&y<=2050){t=(y-2000);dt=62.92+0.32217*t+0.005589*t2+c;}else if(y>2050&&y<=2150){dt= -20+32*((y-1820)/100)*((y-1820)/100)-0.5628*(2150-y)+c;}else if(y>2150){u=(y-1820)/100;dt= -20+32*u*u+c;}return(dt/86400);};function jdtoYear(jd){var jd0,u0,u1,u2,u3,u4,jyear,jmon,jday,hr,mn,sc,hrfrac,mnfrac;u0=0;u1=0;u2=0;u3=0;u4=0;jd0=jd;u0=jd0+32082.5;if(jd0>2299160){u1=u0+Math.floor(u0/36525.0)-Math.floor(u0/146100.0)-38.0;if(jd0>=1830691.5)u1+=1;u0=u0+Math.floor(u1/36525.0)-Math.floor(u1/146100.0)-38.0;}u2=Math.floor(u0+123.0);u3=Math.floor((u2-122.2)/365.25);u4=Math.floor((u2-Math.floor(365.25*u3))/30.6001);jmon=(u4-1.0);if(jmon>12)jmon-=12;jday=(u2-Math.floor(365.25*u3)-Math.floor(30.6001*u4));jyear=(u3+Math.floor((u4-2.0)/12.0)-4800);hrfrac=(jd0-Math.floor(jd0+0.5)+0.5)*24.0;hr=Math.floor(hrfrac);mnfrac=(hrfrac-hr)*60;mn=Math.floor(mnfrac);sc=Math.floor((mnfrac-mn)*60+0.5);if(sc==60){sc=0;mn+=1;}if(mn==60){mn=0;hr+=1;}return(jyear+jmon/12);};pars_names=["Pars Futurorum - Daemon and religion","Pars Fortun&aelig; - Fortune or Lunar horoscope","Pars Mercurii - Despair, penury and fraud","Pars Veneris - Friendship and love","Pars Martis - Valour and bravery","Pars Iovis - Victory, triumph and aid","Pars Saturni - Captivity, prisons and escape","Pars Hyleg - Part of the Root of Life"];phases_names=["New Moon","First quarter","Full Moon","Last quarter","New Moon"];var rasi_name=[];rasi_name[1]="Mesha";rasi_name[2]="Vrisha";rasi_name[3]="Mithuna";rasi_name[4]="Karka";rasi_name[5]="Simha";rasi_name[6]="Kanya";rasi_name[7]="Tula";rasi_name[8]="Vrischika";rasi_name[9]="Dhanu";rasi_name[10]="Makar";rasi_name[11]="Kumbha";rasi_name[12]="Meena";var navagraha=[];navagraha[1]="Surya Deva";navagraha[2]="Chandra";navagraha[3]="Budha";navagraha[4]="Shukra";navagraha[5]="Mangala";navagraha[6]="Guru";navagraha[7]="Shani";navagraha[8]="Rahu";navagraha[9]="Ketu";var bhava_name=[];bhava_name[1]="Lagna";bhava_name[2]="Dhana";bhava_name[3]="Parakrama";bhava_name[4]="Suhrda";bhava_name[5]="Suta";bhava_name[6]="Ripu/Roga";bhava_name[7]="Kama";bhava_name[8]="Mrtyu";bhava_name[9]="Bhagya";bhava_name[10]="Karma";bhava_name[11]="Aya";bhava_name[12]="Vyaya";nakshatra_name=[];nakshatra_name[1]="Ashwini";nakshatra_name[2]="Bharani";nakshatra_name[3]="Krittika";nakshatra_name[4]="Rohini";nakshatra_name[5]="Mrigshirsha";nakshatra_name[6]="Ardra";nakshatra_name[7]="Punarvasu";nakshatra_name[8]="Pushya";nakshatra_name[9]="Ashlesha";nakshatra_name[10]="Magha";nakshatra_name[11]="Purvaphalguni";nakshatra_name[12]="Uttaraphalguni";nakshatra_name[13]="Hasta";nakshatra_name[14]="Chitra";nakshatra_name[15]="Swati";nakshatra_name[16]="Vishakha";nakshatra_name[17]="Anuradha";nakshatra_name[18]="Jyeshtha";nakshatra_name[19]="Mula";nakshatra_name[20]="Purvashadha";nakshatra_name[21]="Uttarashadha";nakshatra_name[22]="Shravana";nakshatra_name[23]="Dhanishtha";nakshatra_name[24]="Shatbhisha";nakshatra_name[25]="Poorvabhadrapada";nakshatra_name[26]="Uttarabhadrapada";nakshatra_name[27]="Revati";nakshatra_name[28]="Abhijit";function fix360(v){if(v<0.0){v+=360;}if(v>360){v-=360;}return v;};function tetrabHen(rasi,sundeg){pada=rasi%(360/27);if(pada<=(360/108)){code=1;}else if(pada<=(360/54)){code=2;}else if(pada<=10.0){code=3;}else{code=4;}Pada=code;str="";code=0;diff=0.0;diff=rasi-sundeg;if(diff<0){diff=diff+360;}if(diff<=12){code=1;str="Sukla Padyami";}else if(diff<=24){code=2;str="Sukla Vidiya";}else if(diff<=36){code=3;str="Sukla Tadiya";}else if(diff<=48){code=4;str="Sukla Chaviti";}else if(diff<=60){code=5;str="Sukla Panchami";}else if(diff<=72){code=6;str="Sukla Sashti";}else if(diff<=84){code=7;str="Sukla Saptami";}else if(diff<=96){code=8;str="Sukla Ashtami";}else if(diff<=108){code=9;str="Sukla Navami";}else if(diff<=120){code=10;str="Sukla Dasami";}else if(diff<=132){code=11;str="Sukla Ekadasi";}else if(diff<=144){code=12;str="Sukla Dwadasi";}else if(diff<=156){code=13;str="Sukla Trayodasi";}else if(diff<=168){code=14;str="Sukla Chaturdasi";}else if(diff<=180){code=15;str="Pournami";}else if(diff<=192){code=16;str="Krishna Padyami";}else if(diff<=204){code=17;str="Krishna Vidiya";}else if(diff<=216){code=18;str="Krishna Tadiya";}else if(diff<=228){code=19;str="Krishna Chaviti";}else if(diff<=240){code=20;str="Krishna Panchami";}else if(diff<=252){code=21;str="Krishna Sashti";}else if(diff<=264){code=22;str="Krishna Saptami";}else if(diff<=276){code=23;str="Krishna Ashtami";}else if(diff<=288){code=24;str="Krishna Navami";}else if(diff<=300){code=25;str="Krishna Dasami";}else if(diff<=312){code=26;str="Krishna Ekadasi";}else if(diff<=324){code=27;str="Krishna Dwadasi";}else if(diff<=336){code=28;str="Krishna Trayodasi";}else if(diff<=348){code=29;str="Krishna Chaturdasi";}else{code=30;str="Amavasya";}Thiti=str;str="";code=0;diff=0.0;diff=rasi-sundeg;if(diff<0){diff=diff+360;}if(diff<=6){code=1;}else if(diff<=12){code=2;}else if(diff<=18){code=3;}else if(diff<=24){code=4;}else if(diff<=30){code=5;}else if(diff<=36){code=6;}else if(diff<=42){code=7;}else if(diff<=48){code=8;}else if(diff<=54){code=2;}else if(diff<=60){code=3;}else if(diff<=66){code=4;}else if(diff<=72){code=5;}else if(diff<=78){code=6;}else if(diff<=84){code=7;}else if(diff<=90){code=8;}else if(diff<=96){code=2;}else if(diff<=102){code=3;}else if(diff<=108){code=4;}else if(diff<=114){code=5;}else if(diff<=120){code=6;}else if(diff<=126){code=7;}else if(diff<=132){code=8;}else if(diff<=138){code=2;}else if(diff<=144){code=3;}else if(diff<=150){code=4;}else if(diff<=156){code=5;}else if(diff<=162){code=6;}else if(diff<=168){code=7;}else if(diff<=174){code=8;}else if(diff<=180){code=2;}else if(diff<=186){code=3;}else if(diff<=192){code=4;}else if(diff<=198){code=5;}else if(diff<=204){code=6;}else if(diff<=210){code=7;}else if(diff<=216){code=8;}else if(diff<=222){code=2;}else if(diff<=228){code=3;}else if(diff<=234){code=4;}else if(diff<=240){code=5;}else if(diff<=246){code=6;}else if(diff<=252){code=7;}else if(diff<=258){code=8;}else if(diff<=264){code=2;}else if(diff<=270){code=3;}else if(diff<=276){code=4;}else if(diff<=282){code=5;}else if(diff<=288){code=6;}else if(diff<=294){code=7;}else if(diff<=300){code=8;}else if(diff<=306){code=2;}else if(diff<=312){code=3;}else if(diff<=318){code=4;}else if(diff<=324){code=5;}else if(diff<=330){code=6;}else if(diff<=336){code=7;}else if(diff<=342){code=8;}else if(diff<=348){code=9;}else if(diff<=354){code=10;}else{code=11;}if(code==1){str="Kimsthugnam";}else if(code==2){str="Bava";}else if(code==3){str="Baalava";}else if(code==4){str="Koulava";}else if(code==5){str="Taitula";}else if(code==6){str="Garaji";}else if(code==7){str="Vanija";}else if(code==8){str="Bhadra(Vishti)";}else if(code==9){str="Sakuni";}else if(code==10){str="Chatushpaat";}else if(code==11){str="Naagavam";}Karana=str;str="";code=0;sum=0.0;sum=rasi+sundeg;if(sum>360)sum=sum-360;if(sum<=13.3333){code=1;str="Vishkambha";}else if(sum<=26.6666){code=2;str="Preeti";}else if(sum<=40){code=3;str="Ayushman";}else if(sum<=53.3333){code=4;str="Soubhagya";}else if(sum<=66.6666){code=5;str="Sobhana";}else if(sum<=80){code=6;str="Atiganda";}else if(sum<=93.3333){code=7;str="Sukarma";}else if(sum<=106.6666){code=8;str="Dhriti";}else if(sum<=120){code=9;str="Soola";}else if(sum<=133.3333){code=10;str="Ganda";}else if(sum<=146.6666){code=11;str="Vriddhi";}else if(sum<=160){code=12;str="Dhruva";}else if(sum<=173.3333){code=13;str="Vyaghata";}else if(sum<=186.6666){code=14;str="Harshana";}else if(sum<=200){code=15;str="Vajra";}else if(sum<=213.3333){code=16;str="Siddhi";}else if(sum<=226.6666){code=17;str="Vyateepat";}else if(sum<=240){code=18;str="Vareeyan";}else if(sum<=253.3333){code=19;str="Parigha";}else if(sum<=266.6666){code=20;str="Siva";}else if(sum<=280){code=21;str="Siddha";}else if(sum<=293.3333){code=22;str="Sadhya";}else if(sum<=306.6666){code=23;str="Subha";}else if(sum<=320){code=24;str="Sukla";}else if(sum<=333.3333){code=25;str="Brahma";}else if(sum<=346.6666){code=26;str="Iyndra";}else{code=27;str="Vydhruti";}Yoga=str;janma_nakshatram=nakshatra_name[Math.floor(rasi/(360/27))+1];res=[Pada,Yoga,Karana,Thiti,janma_nakshatram];return res;};function bhava(as,mc){hs=[];x=as-mc;if(x<0.0){x+=360.0;}x/=6;y=18;for(i=0;i<7;i++){hs[y]=fix360(mc+x*i);y++;if(y>24){y=0;}}x=mc-fix360(as+180.0);if(x<0.0){x+=360.0;}x/=6;y=12;for(i=0;i<7;i++){hs[y]=fix360(as+180+x*i);y++;}for(i=0;i<12;i++){hs[i]=fix360(hs[i+12]+180.0);}s;z=0;hs_Madhya=[hs[0],hs[2],hs[4],hs[6],hs[8],hs[10],hs[12],hs[14],hs[16],hs[18],hs[20],hs[22]];hs_Sandhi=[hs[23],hs[1],hs[3],hs[5],hs[7],hs[9],hs[11],hs[13],hs[15],hs[17],hs[19],hs[21]];var vedic_houses=[hs_Madhya,hs_Sandhi];return vedic_houses;};function tetrabken(longitude,houses){if(longitude<0){longitude+=360;}for(x=1;x<=12;x++){pl=longitude+(1/36000);if(x<12&&houses[x-1]>houses[x]){if((pl>=houses[x-1]&&pl<360)||(pl<houses[x]&&pl>=0)){h=x;continue;}}if(x==12&&(houses[x-1]>houses[0])){if((pl>=houses[x-1]&&pl<360)||(pl<houses[0]&&pl>=0)){h=x;}continue;}if((pl>=houses[x-1])&&(pl<houses[x])&&(x<12)){h=x;continue;}if((pl>=houses[x-1])&&(pl<houses[0])&&(x==12)){h=x;}}return h;};function tetraien(longitude,houses){var TWOPI=2*Math.PI;if(longitude<0){longitude+=TWOPI;}for(x=1;x<=12;x++){pl=longitude+(1/36000);if(x<12&&houses[x-1]>houses[x]){if((pl>=houses[x-1]&&pl<TWOPI)||(pl<houses[x]&&pl>=0)){h=x;continue;}}if(x==12&&(houses[x-1]>houses[0])){if((pl>=houses[x-1]&&pl<TWOPI)||(pl<houses[0]&&pl>=0)){h=x;}continue;}if((pl>=houses[x-1])&&(pl<houses[x])&&(x<12)){h=x;continue;}if((pl>=houses[x-1])&&(pl<houses[0])&&(x==12)){h=x;}}return h;};function tetraoen(longitude){longitude=fix360(longitude);sign_num=Math.floor(longitude/(360/27));pos_in_sign=longitude-(sign_num*(360/27));deg=Math.floor(pos_in_sign);full_min=(pos_in_sign-deg)*60;minu=Math.floor(full_min);full_sec=Math.round((full_min-minu)*60);pada=pos_in_sign;if(pada<=(360/108)){code=1;}else if(pada<=(360/54)){code=2;}else if(pada<=10.0){code=3;}else{code=4;}Pada=code;if(deg<10){deg="0"+deg;}if(minu<10){minu="0"+minu;}if(full_sec<10){full_sec="0"+full_sec;}return deg+"&deg; "+minu+"'<br> "+" "+nakshatra_name[sign_num+1]+"<br>( Pada "+Pada+" )";};function tetrabOen(longitude){longitude=fix360(longitude);sign_num=Math.floor(longitude/30);pos_in_sign=longitude-(sign_num*30);deg=Math.floor(pos_in_sign);full_min=(pos_in_sign-deg)*60;minu=Math.floor(full_min);full_sec=Math.round((full_min-minu)*60);pada=pos_in_sign;if(pada<=(360/108)){code=1;}else if(pada<=(360/54)){code=2;}else if(pada<=10.0){code=3;}else{code=4;}Pada=code;if(deg<10){deg="0"+deg;}if(minu<10){minu="0"+minu;}if(full_sec<10){full_sec="0"+full_sec;}return deg+"&deg; "+minu+"'<br> "+" "+rasi_name[sign_num+1];};function Dignity(planet,planet_long,dayt){sign=Math.floor(planet_long/30.0);if(sign<0){sign+=12;}rulers=DIGTABLE;faces=[[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4],[0,3,2],[1,6,5],[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4]];if(dig_system<2){terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[4,-1],[2,5],[2,5],[3,-1],[6,-1]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[6,-1],[4,-1]],[[6,-1],[3,-1],[5,-1],[2,-1],[4,-1]],[[4,-1],[5,-1],[3,-1],[2,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[3,-1],[2,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];triplicity=[[0,5],[3,1],[6,2],[4,4],[0,5],[3,1],[6,2],[4,4],[0,5],[3,1],[6,2],[4,4]];terms_deg=[[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30]];}else{terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[4,-1],[6,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[6,-1],[2,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[5,-1],[3,-1],[4,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];triplicity=[[0,5,6],[3,1,5],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1]];terms_deg=[[6,12,20,25,30],[8,14,22,27,30],[6,12,17,24,30],[7,13,19,26,30],[6,11,18,24,30],[7,17,21,28,30],[6,14,21,28,30],[7,11,19,24,30],[12,17,21,26,30],[6,14,22,26,30],[7,13,20,25,30],[12,16,19,28,30]];}ruler_value= -1;for(i1=0;i1<=3;i1++){if(rulers[sign][planet][3-i1]==true){ruler_value=i1;}}planet_faces=planet_long-sign*30.0;planet_faces_dec=Math.floor(planet_faces/10);faces_value= -1;for(i1=0;i1<=2;i1++){if(faces[sign][i1]==planet&&planet_faces_dec==i1){faces_value=i1;}}trip_value= -1;j1=0;if(dayt<0){j1=1;}if(triplicity[sign][j1]==planet){trip_value=1;}terms_value= -1;for(i1=0;i1<=4;i1++){if(i1==0){t_i=0;}else{t_i=terms_deg[sign][i1-1];}t_f=terms_deg[sign][i1];if((terms[sign][i1][0]==planet||terms[sign][i1][1]==planet)&&(planet_faces<=t_f&&planet_faces>=t_i)){terms_value=i1;}}return[ruler_value,trip_value,terms_value,faces_value];};function isRuler(pn,rlon){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn=Math.floor(rlon/30);if(digp[sn][0]==pn){return true;}else{return false;}};function tetraxen(pn,rlon){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn=Math.floor(rlon/30);if(digp[sn][1]==pn){return true;}else{return false;}};function tetraGen(pn1,rRadix){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if((digp[sn1][0]==pn2)&&(digp[sn2][0]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tetracen(pn1,rRadix){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if((digp[sn1][1]==pn2)&&(digp[sn2][1]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tetragen(pn1,rRadix){var digfaces=[[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4],[0,3,2],[1,6,5],[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4]];var sn1=Math.floor(rRadix[pn1]/30);pfaces1=Math.floor((rRadix[pn1]-sn1*30.0)/10);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);pfaces2=Math.floor((rRadix[pn2]-sn2*30.0)/10);if((digfaces[sn1][pfaces1]==pn2)&&(digfaces[sn2][pfaces2]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tetraIen(pn1,rRadix,dayt,dig_system){if(dig_system<2){triplicity=[[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1],[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1],[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1]];}else{triplicity=[[0,5,6],[3,1,5],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1]];}var j1=0;if(dayt==false){j1=1;}var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if(dig_system<2){if((triplicity[sn1][j1]==pn2)&&(triplicity[sn2][j1]==pn1)&&(pn1!=pn2)){return true;}}else{var p=triplicity[sn1][2];var snp=Math.floor(rRadix[p]/30);if((triplicity[sn1][j1]==p)&&(triplicity[snp][j1]==pn1)){return true;}if((triplicity[sn1][j1]==pn2)&&(triplicity[sn2][j1]==pn1)&&(pn1!=pn2)){return true;}}}return false;};function tetraMen(pn1,rRadix,dig_system){if(dig_system<2){terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[4,-1],[2,5],[2,5],[3,-1],[6,-1]],[[5,6],[2,-1],[6,3],[5,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[6,-1],[4,-1]],[[6,-1],[3,-1],[2,5],[5,2],[4,-1]],[[4,-1],[3,5],[5,3],[2,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[3,-1],[2,-1],[5,-1],[6,4],[4,6]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];}else{terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[4,-1],[6,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[6,-1],[2,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[5,-1],[3,-1],[4,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];}var sn1=Math.floor(rRadix[pn1]/30);var nterm1=Math.floor((rRadix[pn1]-30*sn1)/5);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);var nterm2=Math.floor((rRadix[pn2]-30*sn2)/5);if((terms[sn1][nterm1][0]==pn2)&&(terms[sn2][nterm2][0]==pn1)&&(pn1!=pn2)){return true;}if((terms[sn1][nterm1][1]==pn2)&&(terms[sn2][nterm2][1]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tetraren(xx){var jdi=xx+0.5;z=Math.floor(jdi);f=jdi-z;a=z;if(z>=229161){alpha=Math.floor((z-1867216.25)/36524.25);a=z+1+alpha-Math.floor(alpha/4);}b=a+1524;c=Math.floor((b-122.1)/365.25);d=Math.floor(365.25*c);e=Math.floor((b-d)/30.6001);dia=b-d-Math.floor(30.6001*e)+f;mes=e-1;if(e>13){mes=e-13;}if(m>2){ano=c-4716;}else{ano=c-4715;}return[ano,mes,dia];};function tetrajen(deg,n){var nakshatra,lord,pada=0,sdeg=0;if(deg<0){deg+=360;}if(deg>=0.0000&&deg<=13.3333){nakshatra="Ashvini";lord="Ke";pada=(deg-0.0000);sdeg=0.0000;}else if(deg>13.3333&&deg<=26.6667){nakshatra="Bharani";lord="Ve";pada=(deg-13.3333);sdeg=13.3333;}else if(deg>26.6667&&deg<=40.0000){nakshatra="Krittika";lord="Su";pada=(deg-26.6667);sdeg=26.6667;}else if(deg>40.0000&&deg<=53.3333){nakshatra="Rohini";lord="Mo";pada=(deg-40.0000);sdeg=40.0000;}else if(deg>53.3333&&deg<=66.6667){nakshatra="Mrigashir";lord="Ma";pada=(deg-53.3333);sdeg=53.3333;}else if(deg>66.6667&&deg<=80.0000){nakshatra="Ardra";lord="Ra";pada=(deg-66.6667);sdeg=66.6667;}else if(deg>80.0000&&deg<=93.3333){nakshatra="Punarvasu";lord="Ju";pada=(deg-80.0000);sdeg=80.0000;}else if(deg>93.3333&&deg<=106.6667){nakshatra="Pushya";lord="Sa";pada=(deg-93.3333);sdeg=93.3333;}else if(deg>106.6667&&deg<=120.0000){nakshatra="Ashlesha";lord="Me";pada=(deg-106.6667);sdeg=106.6667;}else if(deg>120.0000&&deg<=133.3333){nakshatra="Magha";lord="Ke";pada=(deg-120.0000);sdeg=120.0000;}else if(deg>133.3333&&deg<=146.6667){nakshatra="P.Phalg";lord="Ve";pada=(deg-133.3333);sdeg=133.3333;}else if(deg>146.6667&&deg<=160.0000){nakshatra="U.Phalg";lord="Su";pada=(deg-146.6667);sdeg=146.6667;}else if(deg>160.0000&&deg<=173.3333){nakshatra="Hasta";lord="Mo";pada=(deg-160.0000);sdeg=160.0000;}else if(deg>173.3333&&deg<=186.6667){nakshatra="Chitra";lord="Ma";pada=(deg-173.3333);sdeg=173.3333;}else if(deg>186.6667&&deg<=200.0000){nakshatra="Svati";lord="Ra";pada=(deg-186.6667);sdeg=186.6667;}else if(deg>200.0000&&deg<=213.3333){nakshatra="Vishakha";lord="Ju";pada=(deg-200.0000);sdeg=200.0000;}else if(deg>213.3333&&deg<=226.6667){nakshatra="Anuradha";lord="Sa";pada=(deg-213.3333);sdeg=213.3333;}else if(deg>226.6667&&deg<=240.0000){nakshatra="Jyeshtha";lord="Me";pada=(deg-226.6667);sdeg=226.6667;}else if(deg>240.0000&&deg<=253.3333){nakshatra="Mula";lord="Ke";pada=(deg-240.0000);sdeg=240.0000;}else if(deg>253.3333&&deg<=266.6667){nakshatra="P.Shadha";lord="Ve";pada=(deg-253.3333);sdeg=253.3333;}else if(deg>266.6667&&deg<=280.0000){nakshatra="U.Shadha";lord="Su";pada=(deg-266.6667);sdeg=266.6667;}else if(deg>280.0000&&deg<=293.3333){nakshatra="Sravana";lord="Mo";pada=(deg-280.0000);sdeg=280.0000;}else if(deg>293.3333&&deg<=306.6667){nakshatra="Dhanista";lord="Ma";pada=(deg-293.3333);sdeg=293.3333;}else if(deg>306.6667&&deg<=320.0000){nakshatra="Shatabhi";lord="Ra";pada=(deg-306.6667);sdeg=306.6667;}else if(deg>320.0000&&deg<=333.3333){nakshatra="P.Bhadra";lord="Ju";pada=(deg-320.0000);sdeg=320.0000;}else if(deg>333.3333&&deg<=346.6667){nakshatra="U.Bhadra";lord="Sa";pada=(deg-333.3333);sdeg=333.3333;}else if(deg>346.6667&&deg<=360.0000){nakshatra="Revati";lord="Me";pada=(deg-346.6667);sdeg=346.6667;}if(n==1)return nakshatra;else if(n==2)return lord;else if(n==3){if(pada>=0.000000&&pada<=3.333334)return 1;if(pada>3.333334&&pada<=6.666667)return 2;if(pada>6.666667&&pada<=9.999999)return 3;if(pada>9.999999&&pada<=13.400000)return 4;}else if(n==4){return sdeg;}};function tetrabPen(d,moon,yy,mes,dd,h,m,natal_jd){var lord=["Me","Ke","Ve","Su","Mo","Ma","Ra","Ju","Sa"];var tdasa=[6209.116431424950,2556.695001174980,7304.842860499940,2191.452858149980,3652.421430249970,2556.695001174980,6574.358574449950,5843.874288399950,6939.600717474940];var bdata=[];bdata=tetraren(natal_jd);birthyear=bdata[0];birthmonth=bdata[1];birthday=Math.floor(bdata[2]);var jd=natal_jd;var Ts=(jd-2415020.0)/36525.0;var Tm=(jd-2451545.0)/36525.0;var tropmonth=27.321661547+0.000000001857*birthyear;var synmonth=29.5305888531+0.00000021621*Tm-3.64*(10e-10)*Tm*Tm;var solaryear=365.2421896698-6.15359*(10e-6)*Ts-7.29*(10e-10)*Ts*Ts+2.64*(10e-10)*Ts*Ts*Ts;var sideralyear=solaryear+(1+(1/26000));var savanayear=360;var lunaryear=12*synmonth;var sideralday=24*solaryear/sideralyear;var civilday=24*86400/60/60/24;var synodicday=24*360/sideralyear;var ratio=1/100273790935;var sdeg=tetrajen(moon,4);var nlord=tetrajen(moon,2);var vindex=lord.indexOf(nlord);var period=tdasa[lord.indexOf(nlord)];var balance=((moon-sdeg)/13.3333);var lbalance=1-balance;var etime=Math.abs(balance*(period/solaryear));var ta=0,tp=0,mlord=nlord,alord,plord,cmlord,calord,cplord,today1=new Date(),currentmaha=0,indexcurrent=vindex,year;var ayear=(today1.getFullYear()*solaryear)+((today1.getMonth()+1)*30)+today1.getDate();var byear=(birthyear*solaryear)+((birthmonth)*30)+birthday;var tyear=ayear-byear;var istoday=true;if(tyear>120*solaryear){ayear=120*solaryear+byear;tyear=ayear-byear;istoday=false;}for(var i=0;i<9;i++){if(vindex>8)vindex=0;ta+=tdasa[vindex]/solaryear/120;if(ta>balance){alord=lord[vindex];break;}vindex++;}ta=1-((ta-balance)/(tdasa[vindex]/solaryear/120));for(var i=0;i<9;i++){if(vindex>8)vindex=0;tp+=tdasa[vindex]/solaryear/120;if(tp>ta){plord=lord[vindex];break;}vindex++;}var nbalance=(lbalance*tdasa[indexcurrent]);year=(ayear-(byear+nbalance));indexcurrent++;ta=0;for(var i=0;i<9;i++){if(indexcurrent>8)indexcurrent=0;ta+=tdasa[indexcurrent];if(ta>year){cmlord=lord[indexcurrent];break;}indexcurrent++;}year=1-(ta-year)/tdasa[indexcurrent];ta=0;for(var i=0;i<9;i++){if(indexcurrent>8)indexcurrent=0;ta+=tdasa[indexcurrent]/solaryear/120;if(ta>year){calord=lord[indexcurrent];break;}indexcurrent++;}tp=0;ta=1-((ta-year)/(tdasa[indexcurrent]/solaryear/120));for(var i=0;i<9;i++){if(indexcurrent>8)indexcurrent=0;tp+=tdasa[indexcurrent]/solaryear/120;if(tp>ta){cplord=lord[indexcurrent];break;}indexcurrent++;}var tstr=tetraven(etime,solaryear,natal_jd);var nowstr=" ";if(istoday){nowstr+=(((today1.getDate())<10)?"0":"")+(today1.getDate());nowstr+=(((today1.getMonth()+1)<10)?"/0":"/")+(today1.getMonth()+1);nowstr+=(((today1.getFullYear())<1000)?"/0":"/")+(today1.getFullYear())+" <?php echo $translate_json['A.C.']; ?>";}else{var cdata=[];var c=natal_jd+120*solaryear;cdata=tetraren(c);var cc_year=cdata[0];var cc_month=cdata[1];var cc_day=Math.floor(cdata[2]);nowstr=((cc_day<10)?"0":"")+cc_day;nowstr+=((cc_month<10)?"/0":"/")+cc_month;var out_year=cc_year+" <?php echo $translate_json['A.C.']; ?>";if(cc_year<=0){cc_year=1-cc_year;out_year=cc_year+" <?php echo $translate_json['B.C.']; ?>";}nowstr+="/"+out_year;}var nstr=mlord;nstr+="/";nstr+=alord;nstr+="/";nstr+=plord;nstr+="|";nstr+=cmlord;nstr+="/";nstr+=calord;nstr+="/";nstr+=cplord;nstr+="|";nstr+=tstr;nstr+="|";nstr+=nowstr;return nstr;};function tetraven(etime,solaryear,natal_jd){if(isNaN(etime))return("00/00/0000");var bdata=[];bdata=tetraren(natal_jd-etime*solaryear);b_year=bdata[0];b_month=bdata[1];b_day=Math.floor(bdata[2]);var str=((b_day<10)?"0":"")+b_day;str+=((b_month<10)?"/0":"/")+b_month;var out_year=b_year+" <?php echo $translate_json['A.C.']; ?>";if(b_year<=0){b_year=1-b_year;out_year=b_year+" <?php echo $translate_json['B.C.']; ?>";}return str+"/"+out_year;};function oar(OK,CODE1,CODE2){this.OK;this.CODE1;this.CODE2;this.n_jrl;this.JR_courant;this.bool;this.chaine;};function date(JJD,AN,MOIS,JOUR,TYPEA,NBMOIS){this.JJD;this.AN;this.MOIS;this.JOUR;this.TYPEA;this.NBMOIS;};function trunc(x){if(x>0.0){return(Math.floor(x));}else{return Math.ceil(x);}};function JJDATEJ(){Z1=date.JJD+0.5;Z=trunc(Z1);A=Z;B=A+1524;C=trunc((B-122.1)/365.25);D=trunc(365.25*C);E=trunc((B-D)/30.6001);date.JOUR=trunc(B-D-trunc(30.6001*E));if(E<13.5){date.MOIS=trunc(E-1);}else{date.MOIS=trunc(E-13);}if(date.MOIS>=3){date.AN=trunc(C-4716);}else{date.AN=trunc(C-4715);}};function JJDATE(){Z1=date.JJD+0.5;Z=trunc(Z1);if(Z<2299161){A=Z;}else{ALPHA=trunc((Z-1867216.25)/36524.25);A=Z+1+ALPHA-trunc(ALPHA/4);}B=A+1524;C=trunc((B-122.1)/365.25);D=trunc(365.25*C);E=trunc((B-D)/30.6001);date.JOUR=trunc(B-D-trunc(30.6001*E));if(E<13.5){date.MOIS=trunc(E-1);}else{date.MOIS=trunc(E-13);}if(date.MOIS>=3){date.AN=trunc(C-4716);}else{date.AN=trunc(C-4715);}};function BISG(){date.NBMOIS=12;date.TYPEA=0;if((date.AN%4)==0){date.TYPEA=1;}if((date.AN%100)==0&&(date.AN%400)!=0){date.TYPEA=0;}};function BISJ(){date.NBMOIS=12;if((date.AN%4)==0){date.TYPEA=1;}else{date.TYPEA=0;}};function affsai(divID,n,lat_sign){mois=new Array("nul","January","February","March","April","May","June","July","August","September","October","November","December");if(lat_sign>=0){nomsai=new Array("<?php echo $translate_json['Spring']; ?>... ","<?php echo $translate_json['Summer']; ?>... ","<?php echo $translate_json['Autumn']; ?>... ","<?php echo $translate_json['Winter']; ?>... ");}else{nomsai=new Array("<?php echo $translate_json['Autumn']; ?>... ","<?php echo $translate_json['Winter']; ?>... ","<?php echo $translate_json['Spring']; ?>... ","<?php echo $translate_json['Summer']; ?>... ",);}FDJ=(date.JJD+0.5E0)-Math.floor(date.JJD+0.5E0);HH=Math.floor(FDJ*24);FDJ-=HH/24.0;MM=Math.floor(FDJ*1440);var div=document.getElementById(divID);div.innerHTML+=nomsai[n]+date.JOUR+" "+tr(mois[date.MOIS])+" "+date.AN+" , "+HH+"h"+MM+"m UT<br>";};function saison(divID,YY,lat_sign){CODE1=YY;nline=1;k=YY-2000-1;for(n=0;n<8;n++){nn=n%4;dk=k+0.25E0*n;with(Math){T=0.21451814e0+0.99997862442e0*dk+0.00642125e0*sin(1.580244e0+0.0001621008e0*dk)+0.00310650e0*sin(4.143931e0+6.2829005032e0*dk)+0.00190024e0*sin(5.604775e0+6.2829478479e0*dk)+0.00178801e0*sin(3.987335e0+6.2828291282e0*dk)+0.00004981e0*sin(1.507976e0+6.2831099520e0*dk)+0.00006264e0*sin(5.723365e0+6.2830626030e0*dk)+0.00006262e0*sin(5.702396e0+6.2827383999e0*dk)+0.00003833e0*sin(7.166906e0+6.2827857489e0*dk)+0.00003616e0*sin(5.581750e0+6.2829912245e0*dk)+0.00003597e0*sin(5.591081e0+6.2826670315e0*dk)+0.00003744e0*sin(4.3918e0+12.56578830e0*dk)+0.00001827e0*sin(8.3129e0+12.56582984e0*dk)+0.00003482e0*sin(8.1219e0+12.56572963e0*dk)-0.00001327e0*sin(-2.1076e0+0.33756278e0*dk)-0.00000557e0*sin(5.549e0+5.7532620e0*dk)+0.00000537e0*sin(1.255e0+0.0033930e0*dk)+0.00000486e0*sin(19.268e0+77.7121103e0*dk)-0.00000426e0*sin(7.675e0+7.8602511e0*dk)-0.00000385e0*sin(2.911e0+0.0005412e0*dk)-0.00000372e0*sin(2.266e0+3.9301258e0*dk)-0.00000210e0*sin(4.785e0+11.5065238e0*dk)+0.00000190e0*sin(6.158e0+1.5774000e0*dk)+0.00000204e0*sin(0.582e0+0.5296557e0*dk)-0.00000157e0*sin(1.782e0+5.8848012e0*dk)+0.00000137e0*sin(-4.265e0+0.3980615e0*dk)-0.00000124e0*sin(3.871e0+5.2236573e0*dk)+0.00000119e0*sin(2.145e0+5.5075293e0*dk)+0.00000144e0*sin(0.476e0+0.0261074e0*dk)+0.00000038e0*sin(6.45e0+18.848689e0*dk)+0.00000078e0*sin(2.80e0+0.775638e0*dk)-0.00000051e0*sin(3.67e0+11.790375e0*dk)+0.00000045e0*sin(-5.79e0+0.796122e0*dk)+0.00000024e0*sin(5.61e0+0.213214e0*dk)+0.00000043e0*sin(7.39e0+10.976868e0*dk)-0.00000038e0*sin(3.10e0+5.486739e0*dk)-0.00000033e0*sin(0.64e0+2.544339e0*dk)+0.00000033e0*sin(-4.78e0+5.573024e0*dk)-0.00000032e0*sin(5.33e0+6.069644e0*dk)-0.00000021e0*sin(2.65e0+0.020781e0*dk)-0.00000021e0*sin(5.61e0+2.942400e0*dk)+0.00000019e0*sin(-0.93e0+0.000799e0*dk)-0.00000016e0*sin(3.22e0+4.694014e0*dk)+0.00000016e0*sin(-3.59e0+0.006829e0*dk)-0.00000016e0*sin(1.96e0+2.146279e0*dk)-0.00000016e0*sin(5.92e0+15.720504e0*dk)+0.00000115e0*sin(23.671e0+83.9950108e0*dk)+0.00000115e0*sin(17.845e0+71.4292098e0*dk);}JJD=2451545+T*365.25e0;JJD+=0.0003472222e0;D=CODE1/100.0;TETUJ=(32.23e0*(D-18.30e0)*(D-18.30e0)-15)/86400.e0;JJD-=TETUJ;date.JJD=JJD;if(JJD<2299160.5e0){JJDATEJ();}else{JJDATE();}if(date.AN==CODE1){affsai(divID,nn,lat_sign);}}};function moonph(divID){PI314=3.141592653589793;tabm=new Array(0.041e0,0.126e0,0.203e0,0.288e0,0.370e0,0.455e0,0.537e0,0.622e0,0.707e0,0.789e0,0.874e0,0.956e0);xMOIS=date.MOIS;oar.CODE1=date.AN;oar.CODE2=date.MOIS;if(date.MOIS==1){an=date.AN-1;date.MOIS=12;}else{an=date.AN;date.MOIS--;}an+=tabm[date.MOIS-1];k=(an-1900)*12.3685e0;lik=trunc(k);rk=lik;k=rk-0.25e0;if(k<0.e0)k=k-1;rad=PI314/180e0;nx=0;with(Math){for(ii=0;ii<12;ii++){k=k+0.25;t=k/1236.85e0;t2=t*t;t3=t*t2;j=2415020.75933e0+29.5305888531e0*k+0.0001337e0*t2-0.000000150e0*t3+0.00033e0*sin(rad*(166.56e0+132.87*t-0.009*t2));m=rad*(359.2242e0+29.10535608e0*k-0.0000333e0*t2-0.00000347e0*t3);m=m%(2*PI314);mp=rad*(306.0253e0+385.81691806e0*k+0.0107306e0*t2+0.00001236e0*t3);mp=mp%(2*PI314);f=rad*(21.2964e0+390.67050646e0*k-0.0016528e0*t2-0.00000239e0*t3);f=f%(2*PI314);oar.OK=0;i=ii%4;if(i==0||i==2){j=j+(0.1734e0-0.000393e0*t)*sin(m)+0.0021e0*sin(2*m)-0.4068e0*sin(mp)+0.0161e0*sin(2*mp)-0.0004e0*sin(3*mp)+0.0104e0*sin(2*f)-0.0051e0*sin(m+mp)-0.0074e0*sin(m-mp)+0.0004e0*sin(2*f+m)-0.0004e0*sin(2*f-m)-0.0006e0*sin(2*f+mp)+0.001e0*sin(2*f-mp)+0.0005e0*sin(m+2*mp);date.JJD=j;testmoi(i,xMOIS);if(oar.OK==1){affmoph(divID,i);}}else{j=j+(0.1721e0-0.0004e0*t)*sin(m)+0.0021e0*sin(2*m)-0.6280e0*sin(mp)+0.0089e0*sin(2*mp)-0.0004e0*sin(3*mp)+0.0079e0*sin(2*f)-0.0119e0*sin(m+mp)-0.0047e0*sin(m-mp)+0.0003e0*sin(2*f+m)-0.0004e0*sin(2*f-m)-0.0006e0*sin(2*f+mp)+0.0021e0*sin(2*f-mp)+0.0003e0*sin(m+2*mp)+0.0004e0*sin(m-2*mp)-0.0003e0*sin(2*m+mp);if(i==1){date.JJD=j+0.0028e0-0.0004*cos(m)+0.0003e0*cos(mp);testmoi(i,xMOIS);if(oar.OK==1)affmoph(divID,i);}else{date.JJD=j-0.0028e0+0.0004*cos(m)-0.0003e0*cos(mp);testmoi(i,xMOIS);if(oar.OK==1){affmoph(divID,i);}}}}if(oar.OK==1){nx++;}date.AN=oar.CODE1;date.MOIS=oar.CODE2;if(date.MOIS==2){date.NBJRS=((date.TYPEA==0)?28:29);}else{if(date.MOIS<8){date.NBJRS=(((date.MOIS&1)!=0)?31:30);}else{date.NBJRS=(((date.MOIS&1)!=0)?30:31);}}}};function testmoi(i,pMOIS){D=oar.CODE1/100.0;TETUS=32.23*(D-18.30)*(D-18.30)-15;TETUJ=TETUS/86400e0;date.JJD+=0.0003472222e0;date.JJD+=(-TETUJ);if(date.JJD<2299160.5e0){JJDATEJ();BISJ();}else{JJDATE();BISG();}oar.OK=0;if(date.MOIS==pMOIS){oar.OK=1;}if(i==0){if(pMOIS>date.MOIS){tetraHen(pMOIS);}else if(date.MOIS==12&&pMOIS==1){tetraHen(pMOIS);}}};function tetraHen(xmois){if(oar.bool==0){if(date.MOIS==2){date.NBJRS=((date.TYPEA==0)?28:29);}else{if(date.MOIS<8){date.NBJRS=(((date.MOIS&1)!=0)?31:30);}else{date.NBJRS=(((date.MOIS&1)!=0)?30:31);}}oar.JR_courant=1;oar.n_jrl=date.NBJRS-date.JOUR+2;}};function affmoph(divID,i){mois=new Array("nul"," January "," February","  March  ","  April  ","   May   ","   June  ","   July  ","  August ","September"," October ","November ","December ");nompha=new Array("<?php echo $translate_json['New moon']; ?>... ","<?php echo $translate_json['First quarter']; ?>... ","<?php echo $translate_json['Full moon']; ?>... ","<?php echo $translate_json['Last quarter']; ?>... ");sigpha=new Array("NM","FQ","FM","LQ");tabjm=new Array(31,28,31,30,31,30,31,31,30,31,30,31);if(date.JJD<2299160.5E0){JJDATEJ();}else{JJDATE();}FRACJ=(date.JJD+0.5E0)%1.0;jour=date.JOUR;HH=FRACJ*24e0;hh=Math.floor(HH);FRACJ-=hh/24.e0;MM=FRACJ*1440.e0;mm=Math.floor(MM);if(hh==24){jfin=tabjm[date.MOIS-1];if(date.JJD<2299160.5E0){BISJ();}else{BISG();}if(date.MOIS==2&&date.TYPEA==1){jfin=29;}if(date.JOUR<jfin){hh=0;jour=date.JOUR+1;}}if(hh<10){hh="0"+hh;}if(mm<10){mm="0"+mm;}nombre=((oar.JR_courant<=9)?"0"+oar.JR_courant++ :oar.JR_courant++);if(date.AN>= -9&&date.AN<=99){oar.chaine="  "+date.AN;}else{oar.chaine=date.AN;}if(i==0){oar.n_jrl=2;oar.bool=1;}else{oar.n_jrl++;}var div=document.getElementById(divID);div.innerHTML+=nompha[i]+" "+jour+" "+tr(mois[date.MOIS])+" "+date.AN+" , "+hh+"h"+mm+"m UT<br>";};function tetrabpen(mes,ano,vDIV,lat_sign){var divn=document.getElementById(vDIV);divn.innerHTML="<b><?php echo $translate_json["Seasons"]; ?>:</b><br>";saison(vDIV,ano,lat_sign);divn.innerHTML+="<b><?php echo $translate_json["Moon phases"]; ?>:</b><br>";date.MOIS=mes;moonph(vDIV);$jq.ajax({type:"GET",url:"<?php echo plugins_url('Tetrabyblos') ?>/data/eclipse.php",data:{year:ano,age:27,country:'Ireland'},success:function(data){divn.innerHTML+=tr(data);divn.innerHTML="<table class='w3-table w3-small w3-white tetra-font table-no-border'><tr><td class='w3-white tetra-font-mobile table-no-border'>"+divn.innerHTML+"</td></tr></table>";if(document.getElementById("TETRA_ASTRO_REPORT")){document.getElementById("TETRA_ASTRO_REPORT").innerHTML=divn.innerHTML;}}});};x=document.getElementById("myDIV2");x.style.display="none";function FNretro(lla,llb){var dretro=(llb-lla);if(Math.abs(dretro)>180){dretro=360-Math.abs(dretro);if(llb>=0&&lla>=180){return dretro;}if(lla>=0&&llb>180){return-dretro;}}return dretro;};function tetraaxen(date,longitude,latitude){$const.tlong= -longitude;$const.glat=latitude;$processor.init();var nbody=new Array('sun','moon','mercury','venus','mars','jupiter','saturn','uranus','neptune','pluto','chiron');var LongitudeG=new Array();var DeclinationG=new Array();var AltitudeG=new Array();ay=0;for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG[i+1]=tetraRen($const.body.position.apparentLongitude+ay);DeclinationG[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG[i+1]=$const.body.position.altaz.topocentric.altitude;}var nodesG=new Array();nodesG=tetraqen(date.julian);h_sys=eval(document.getElementById("h_sys").value);var housesG=new Array();housesG=tetraAen(date.julian,longitude,latitude,0);for(i=12;i>0;i--){housesG[i]=housesG[i-1]*180/Math.PI;}housesG[0]=0;var pointsG=new Array();pointsG[1]=nodesG[0];pointsG[2]=0;pointsG[3]=housesG[1];pointsG[4]=housesG[10];pointsG[6]=nodesG[1];SUNALT=AltitudeG[1];pointsG[7]=SUNALT;if(SUNALT>0){pointsG[5]=Mod360(pointsG[3]+LongitudeG[2]-LongitudeG[1]);}else{pointsG[5]=Mod360(pointsG[3]-LongitudeG[2]+LongitudeG[1]);}var LongitudeTemp=0;date['day']+=1;$processor.init();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeTemp=tetraRen($const.body.position.apparentLongitude+ay);if(FNretro(LongitudeG[i+1],LongitudeTemp)<0){LongitudeG[i+1]= -LongitudeG[i+1];}}var today=new Date();yy=today.getUTCFullYear();m=today.getUTCMonth()+1;dd=today.getUTCDate();hh=0;mm=0;ss=0;off=0;var date={year:yy,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:off};$processor.init();var LongitudeG1=new Array();var DeclinationG1=new Array();var AltitudeG1=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG1[i+1]=tetraRen($const.body.position.apparentLongitude+ay);DeclinationG1[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG1[i+1]=$const.body.position.altaz.topocentric.altitude;}var nodesG1=new Array();nodesG1=tetraqen(date.julian);var housesG1=new Array();housesG1=tetraAen(date.julian,longitude,latitude,h_sys);for(i=12;i>0;i--){housesG1[i]=housesG1[i-1]*180/Math.PI;}housesG1[0]=0;var pointsG1=new Array();pointsG1[1]=nodesG1[0];pointsG1[2]=0;pointsG1[3]=housesG1[1];pointsG1[4]=housesG1[10];pointsG1[6]=nodesG1[1];SUNALT1=AltitudeG1[1];if(SUNALT1>0){pointsG1[5]=Mod360(pointsG1[3]+LongitudeG1[2]-LongitudeG1[1]);}else{pointsG1[5]=Mod360(pointsG1[3]-LongitudeG1[2]+LongitudeG1[1]);}date['day']+=1;$processor.init();var LongitudeG2=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG2[i+1]=tetraRen($const.body.position.apparentLongitude+ay);}date['day']+=1;$processor.init();var LongitudeG3=new Array();for(i=0;i<11;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG3[i+1]=tetraRen($const.body.position.apparentLongitude+ay);}for(i=1;i<12;i++){if(FNretro(LongitudeG1[i],LongitudeG2[i])<0){LongitudeG1[i]= -LongitudeG1[i];}if(FNretro(LongitudeG2[i],LongitudeG3[i])<0){LongitudeG2[i]= -LongitudeG2[i];}}vv=new Array(LongitudeG,LongitudeG1,LongitudeG2,DeclinationG,nodesG,housesG,pointsG,DeclinationG1,housesG1,pointsG1);return vv;};function tetrabsen(date,longitude,latitude,h_sys){$const.tlong=longitude;$const.glat=latitude;var longitude1=Number(longitude);var latitude1=Number(latitude);var nbody=new Array("sun","moon","mercury","venus","mars","jupiter","saturn","uranus","neptune","pluto","chiron");$processor.init();var LongitudeG1=new Array();var LatitudeG1=new Array();var DeclinationG1=new Array();var AltitudeG1=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG1[i+1]=tetraRen($const.body.position.apparentLongitude);LatitudeG1[i+1]=$const.body.position.apparentLatitude*Math.PI/180;DeclinationG1[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG1[i+1]=$const.body.position.altaz.topocentric.altitude;}var nodesG1=new Array();nodesG1=tetraqen(date.julian);var houses_G1=new Array();houses_G1=tetraAen(date.julian,longitude1,latitude1,h_sys);for(i=12;i>0;i--){houses_G1[i]=houses_G1[i-1]*180/Math.PI;}houses_G1[0]=0;var pointsG1=new Array();pointsG1[1]=nodesG1[0];var angleG1=new Array();angleG1=tetraaGen(date.julian,longitude1,latitude1,0);pointsG1[2]=angleG1[2]*180/Math.PI;pointsG1[3]=houses_G1[1];pointsG1[4]=houses_G1[10];pointsG1[6]=nodesG1[1];SUNALT1=AltitudeG1[1];if(SUNALT1>0){pointsG1[5]=Mod360(pointsG1[3]+LongitudeG1[2]-LongitudeG1[1]);}else{pointsG1[5]=Mod360(pointsG1[3]-LongitudeG1[2]+LongitudeG1[1]);}date["day"]+=1;$processor.init();var LongitudeG2=new Array();var LatitudeG2=new Array();var DeclinationG2=new Array();var AltitudeG2=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG2[i+1]=tetraRen($const.body.position.apparentLongitude);LatitudeG2[i+1]=$const.body.position.apparentLatitude*Math.PI/180;DeclinationG2[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG2[i+1]=$const.body.position.altaz.topocentric.altitude;}date["day"]+=1;$processor.init();var LongitudeG3=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG3[i+1]=tetraRen($const.body.position.apparentLongitude);}for(i=1;i<12;i++){if(FNretro(LongitudeG2[i],LongitudeG1[i])<0){LongitudeG1[i]= -LongitudeG1[i];}if(FNretro(LongitudeG3[i],LongitudeG2[i])<0){LongitudeG2[i]= -LongitudeG2[i];}}var vv=new Array(LongitudeG1,LongitudeG2,DeclinationG1,houses_G1,pointsG1);return vv;};function MoonTrueNode(dateV){$const.tlong=0;$const.glat=0;var longitude1=Number(longitude);var latitude1=Number(latitude);var nbody=new Array("sun","moon","mercury","venus","mars","jupiter","saturn","uranus","neptune","pluto","chiron");$processor.init();var body=$moshier.body[nbody[1]];$processor.calc(dateV,body);var LongitudeG1=tetraRen($const.body.position.apparentLongitude);var LatitudeG1=$const.body.position.apparentLatitude*Math.PI/180;dateV["day"]+=0.5;$processor.init();var body=$moshier.body[nbody[1]];$processor.calc(dateV,body);var LongitudeG2=tetraRen($const.body.position.apparentLongitude);var LatitudeG2=$const.body.position.apparentLatitude*Math.PI/180;var moonx1=Math.cos(LongitudeG1*Math.PI/180);var moonx2=Math.cos(LongitudeG2*Math.PI/180);var moony1=Math.sin(LongitudeG1*Math.PI/180);var moony2=Math.sin(LongitudeG2*Math.PI/180);var moonz1=Math.tan(LatitudeG1*Math.PI/180)*moony1;var moonz2=Math.tan(LatitudeG2*Math.PI/180)*moony2;var hx=moony1*moonz2-moonz1*moony2;var hy=moonz1*moonx2-moonx1*moonz2;var omega=Math.atan2(hx,-hy)*180/Math.PI;omega=Math.atan2(hy,hx)*180/Math.PI;var nodesG=new Array();nodesG=tetraqen(dateV.julian);var dif=Math.abs(omega-nodesG[0]);if(dif>180){dif=360-dif;}if(dif>90){omega+=180;if(omega>360){omega-=360;}}return omega;};function ddToDms(lat,lng,tz){var latResult,lngResult;latResult=(lat>=0)?'N':'S';lngResult=(lng>=0)?'E':'W';lat=Math.abs(lat);valDeg=Math.floor(lat);valMin=Math.floor((lat-valDeg)*60);if(valMin<10){valMin="0"+valMin;}latResult=valDeg+latResult+valMin;lng=Math.abs(lng);valDeg=Math.floor(lng);valMin=Math.floor((lng-valDeg)*60);if(valMin<10){valMin="0"+valMin;}lngResult=valDeg+lngResult+valMin;tzResult=tz;return(latResult+","+lngResult+","+tzResult);};function tetraLen(era,y,m,d,h,mn,s){var jy,ja,jm;if(y==0){alert("There's no zero year!");return "invalid";}if(y==1582&&m==10&&d>4&&d<15&&era=="CE"){alert("Dates between 5 and 14 October 1582 AD do not exist in the gregorian system!");return "invalid";}var jd;var u,u0,u1,u2;var temp;u2=0;temp=y+m/100+d/10000;if(era=="BCE"){y= -y+1;temp= -temp+1;}u=y;if(m<3){u-=1;}u0=u+4712.0;u1=m+1.0;if(u1<4){u1+=12.0;}jd=Math.floor(u0*365.25)+Math.floor(30.6*u1+0.000001)+d+h/24.0+mn/24.0/60+s/24.0/3600-63.5;if(temp>=1582.1015){u2=Math.floor(Math.abs(u)/100)-Math.floor(Math.abs(u)/400);if(u<0.0)u2= -u2;jd+= -u2+2;if((u<0.0)&&(u/100==Math.floor(u/100))&&(u/400!=Math.floor(u/400)))jd-=1;}return jd;};function jump(h){var url=location.href;location.href="#"+h;history.replaceState(null,null,url);};function tetraRen(ang){while(ang<0){ang+=360;}while(ang>=360){ang-=360;}return ang;};function fixtoRAD(ang){var p2=2*(Math.PI);while(ang<0){ang+=p2;}while(ang>=p2){ang-=p2;}return ang;};function cjd(d,m,y){var a,j,l;var b;if(m<3){m+=12;y--}a=y/100;b=ParseFloat(30.6)*ParseFloat(m+1);l=ParseInt(b);j=365*y+y/4+l+2-a+a/4+d;return j};function tetraPen(d,m,y){var h,mt,s,h6,b6,timeZone;h=12;mt=0;s=0;timeZone=0;h6=(h+mt/60+s/3600-(12+timeZone))/24;jd=tetraLen(1,y,m,d,h6,mt,s);b6=(cjd(d,m,y)-694025+h6)/36525;return b6;};function tetrabCen(dd,mm,yy,asys){if(asys<0){return 0;}switch(asys){case 0:t=tetraPen(dd,mm,yy);return 22.460148+1.396042*t+3.08E-4*t*t;break;case 1:t=tetraPen(dd,mm,yy);return 21.013972+1.398191*t;break;case 2:return(yy+(mm*30+dd)/365-297.3204723)*50.2388475/3600;break;case 3:var newAya,kpayaOn1stJan,daysAfter1stJan,correctionForDays;kpayaOn1stJan=22+(1335+(yy-1900)*50.2388475)/3600+(yy-1900)*(yy-1900)*1.11E-4/3600;daysAfter1stJan=((mm-1)*30+(dd-1))/3600;correctionForDays=daysAfter1stJan/365*(50.2388475+1.11E-4*20);newAya=kpayaOn1stJan+correctionForDays;return newAya;break;case 4:var dayAya,newAya,totalday;dayAya=50.2388475/365.25;totalday=(yy-291)*365.25;totalday+=mm*30+dd-114;newAya=dayAya*totalday;newAya/=3600;return newAya;break;default:t=tetraPen(dd,mm,yy);return 22.460148+1.396042*t+3.08E-4*t*t;}};function DMS(x){x1=Math.floor(x);x2=Math.floor((x-x1)*60);if(x1<10){x1="0"+x1;}if(x2<10){x2="0"+x2;}var t=""+x1+"&deg;"+x2+"'";return t;};function move(){var elem=document.getElementById("myBar");var width=20;var id=setInterval(frame,15);function frame(){if(width>=100){clearInterval(id);var x=document.getElementById("myBar");x.style.display="none";}else{width++;elem.style.width=width+'%';elem.innerHTML='<i class="material-icons">schedule</i>';}}};function stats(date_value){var hexString=date_value.toString(16);var leadEmail=document.getElementById("email")?document.getElementById("email").value:"";var leadName=document.getElementById("name")?document.getElementById("name").value:"";$jq.ajax({type:"POST",url:"<?php echo plugins_url('Tetrabyblos') ?>/data/stats.php",data:{hexa:hexString,email:leadEmail,name:leadName},success:function(data){}});return;};function calc(){x=document.getElementById("main_astro_div");x.style.display="none";prepareToDrawKundaliChart();era=eval(document.getElementById("era").value);yy=eval(document.getElementById("year").value);m=eval(document.getElementById("month").value);dd=eval(document.getElementById("day").value);hh=eval(document.getElementById("hour").value);mm=eval(document.getElementById("minute").value);ss=0;var nname=document.getElementById("name").value;var name_div=document.getElementById("myName");var s1="<?php echo $translate_json['Here are some details regarding your birth date.']; ?>";var s2="<?php echo $translate_json['Around the main wheel are displayed the current positions of the planets and astrological points which are called  transits.']; ?>";temp="<?php echo $translate_json['Chart Results']; ?>";temp="<?php echo $title_1_1; ?>";if(chart_type>0){name_div.innerHTML="<div style='margin: 0 auto;background-color: white;'><center><h2 class='tetra-h2'>"+temp+"</h2><p class='tetra-font-mobile' style='font-family: Merriweather;text-align: center;'>"+s1+"<br>"+s2+"</p></center><h1 style='font-family: Merriweather;text-align: center;' class='tetra-h1'>"+nname+"</h1>";if(document.getElementById("TETRA_TITLE")){document.getElementById("TETRA_TITLE").innerHTML="<div style='margin: 0 auto;background-color: white;'><center><h2 class='tetra-h2'>"+temp+"</h2><p class='tetra-font-mobile' style='text-align: center;'></p></center><h1 style='font-family: Merriweather;text-align: center;' class='tetra-h1'>"+nname+"</h1>";}}else{name_div.innerHTML="<div id='myStart' style='margin: 0 auto;background-color: white;'><center><h2 class='tetra-h2'>"+temp+"</h2><p class='tetra-font-mobile' style='font-family: Merriweather;text-align: center;'>"+s1+"<br></p></center><h1 style='font-family: Merriweather;text-align: center;' class='tetra-h1'>"+nname+"</h1>";if(document.getElementById("TETRA_TITLE")){document.getElementById("TETRA_TITLE").innerHTML="<div id='myStart' style='margin: 0 auto;background-color: white;'><center><h2 class='tetra-h2'>"+temp+"</h2><p class='tetra-font-mobile' style='font-family: Merriweather;text-align: center;'>"+s1+"<br></p></center><h1 style='font-family: Merriweather;text-align: center;' class='tetra-h1'>"+nname+"</h1>";}}if(show_bar>1){name_div.innerHTML+="<div id='myBar' style='padding: 3px;' class='w3-container w3-blue w3-round-xlarge' style='height:10px;width:20%'></div>";move();}else{name_div.innerHTML+="</div>";}jump("myStart");l1=eval(document.getElementById("long_deg").value);l2=eval(document.getElementById("long_min").value);l3=eval(document.getElementById("ew").value);longitude=(l1+l2/60)*l3;l1=eval(document.getElementById("lat_deg").value);l2=eval(document.getElementById("lat_min").value);l3=eval(document.getElementById("ns").value);latitude=(l1+l2/60)*l3;tz=document.getElementById("timezone").value;if(yy<3000&&yy> -3000){do_calc(era,yy,m,dd,hh,mm,ss,latitude,longitude,tz);}};function tetraaKen(input){return input.match(/[0-9]+/g);};function tetraaAen(minutes){var sign=minutes<0?"-":"+";var min=Math.floor(Math.abs(minutes));var sec=Math.floor((Math.abs(minutes)*60)%60);return sign+(min<10?"0":"")+min+":"+(sec<10?"0":"")+sec;};function do_calc(era,yy,m,dd,hh,mm,ss,latitude,longitude,tz){date_number=(Math.abs(yy)*100000000+m*1000000+dd*10000+hh*100+mm);resultado=stats(date_number);var yy_astro=yy;var yy_tz=yy;if(era<0){yy_astro=1-yy;yy_tz=1000;}$jq.post("<?php echo plugins_url('Tetrabyblos') ?>/utils.php",{"year":yy_tz,"month":m,"day":dd,"hour":hh,"minute":mm,"timezone":tz},function(returned_data){console.log("OFFSET"+returned_data);});var off_choose=document.getElementById("zoneoffset").value;var tz=document.getElementById("timezone").value;if(off_choose==99){var zone=moment.tz.zone(tz);off=zone.parse(Date.UTC(yy_tz,m-1,dd,hh,mm,ss,0));}else{off= -off_choose*60;}var sec=Date.UTC(yy_tz,m-1,dd,hh,mm,ss,0);var tt=moment.tz.zone(tz).abbr(sec);var z=moment.tz.zone(tz).utcOffset(sec);console.log(off_choose+" "+off+" "+tz+" "+m+" "+Date.UTC(yy_tz,m-1,dd,hh,mm,ss,0)+" "+z+" "+tt);var name_div=document.getElementById("myNameDate");name_div.innerHTML="";l1=eval(document.getElementById("long_deg").value);l2=eval(document.getElementById("long_min").value);l3=eval(document.getElementById("ew").value);l4=eval(document.getElementById("lat_deg").value);l5=eval(document.getElementById("lat_min").value);l6=eval(document.getElementById("ns").value);lew=(l3>=0)?"East":"West";lns=(l6>=0)?"North":"South";lew=(l3>=0)?"<?php echo $translate_json['East']; ?>":"<?php echo $translate_json['West']; ?>";lns=(l6>=0)?"<?php echo $translate_json['North']; ?>":"<?php echo $translate_json['South']; ?>";lat_sign=l6;l3=(l3>=0)?"East":"West";l6=(l6>=0)?"North":"South";birth_off=tetraaAen(-off/60);var nome_mes=new Array("nul","<?php echo $translate_json['January']; ?>","<?php echo $translate_json['February']; ?>","<?php echo $translate_json['March']; ?>","<?php echo $translate_json['April']; ?>","<?php echo $translate_json['May']; ?>","<?php echo $translate_json['June']; ?>","<?php echo $translate_json['July']; ?>","<?php echo $translate_json['August']; ?>","<?php echo $translate_json['September']; ?>","<?php echo $translate_json['October']; ?>","<?php echo $translate_json['November']; ?>","<?php echo $translate_json['December']; ?>");var birth_city="";var city_name=document.getElementById("cname").value;if(city_name){birth_city+=" ( "+city_name+" ) ";}var tagbr="<br>";birth_date="<br><br><div class='tetra-font-mobile' style='font-family: Merriweather;text-align: center;font-style: oblique;'><p><?php echo $translate_json['Born']; ?> "+dd+" "+nome_mes[m]+" "+yy+", "+hh+"h"+mm+"m GMT"+birth_off+"<br>"+l1+"&deg;"+l2+"' "+lew+", "+l4+"&deg;"+l5+"' "+lns+"<br>"+birth_city+"</p>";h_sys=eval(document.getElementById("h_sys").value);zodiac=eval(document.getElementById("zodiac").value);var arr_hsys={0:"Plácidus",13:"Alcabicio",1:"Campano",11:"Casa igual - Asc.",2:"Casa igual - signo completo",9:"Koch",7:"Morino",8:"Meridiano",6:"Porfirio",14:"Neo-Porfirio",3:"Védico",5:"Regiomontano",4:"Topocéntrico"};var arr_zodiac={"-1":"Occidental - tropical",0:"Fagan/Bradley",1:"Lahiri",2:"DeLuce",3:"B.V. Raman",4:"Usha/Shashi",5:"Krishnamurti",6:"Djwhal Khool",7:"Shri Yukteshwar",8:"J.N. Bhasin",9:"Hiparco",10:"Sasánida",12:"J1900",13:"B1950"};var sys_house="<p><?php echo $translate_json['House System']; ?>: "+arr_hsys[h_sys]+"<br><?php echo $translate_json['Zodiac']; ?>: "+arr_zodiac[zodiac]+"</p>";birth_date+=sys_house+"</div>";name_div.innerHTML+=birth_date;if(document.getElementById("TETRA_BIRTH_DETAILS")){document.getElementById("TETRA_BIRTH_DETAILS").innerHTML=birth_date;}c_test=ddToDms(latitude,longitude,off/60);d_ddec=yy*10000+m*100+dd;h_american=eval(document.getElementById("hour_american").value);m_american=eval(document.getElementById("minute_american").value);ampm=eval(document.getElementById("ampm_american").value);ampm=(ampm==1)?'PM':'AM';hdec=h_american*100+m_american+ampm;c_name=document.getElementById("name").value;test=home_url+"/transits/?parameters="+c_name+"|"+c_test+","+d_ddec+","+hdec;h_24=eval(document.getElementById("hour").value);m_24=eval(document.getElementById("minute").value);h_24=h_24<10?"0"+h_24:h_24;m_24=m_24<10?"0"+m_24:m_24;h_24_dec=""+h_24+":"+m_24;console.log("Here:"+h_24_dec+" "+ampm);transit_parameters=c_name+"|"+c_test+","+d_ddec+","+hdec+","+h_24_dec+"|||"+c_test+",00000000,,|"+"Placidus";var date={year:yy_astro,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:off};var date_transit={year:yy_astro,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:off};var date_natal_orig=date;h_sys=eval(document.getElementById("h_sys").value);if(astrorep<1){tetrabpen(m,yy_astro,"myMS",lat_sign);}var dateG=yy_astro+","+m+","+dd+","+hh+","+mm+","+0+","+off+","+longitude+","+latitude+","+h_sys;vera="CE";if(era<0){vera="BCE";}var jd=tetraLen(vera,yy,m,dd,hh,mm,0)+off/1440;jd_original=jd;var jd_birth=jd;var offset=off/1440;asys=eval(document.getElementById("zodiac").value);var ay_default= -tetraken(jd,1);if(asys>=0){ay= -tetraken(jd,asys);ay_default=0;}else{ay=0;}$const.tlong= -longitude;$const.glat=latitude;var QLongitude=longitude;$processor.init();var nbody=new Array('sun','moon','mercury','venus','mars','jupiter','saturn','uranus','neptune','pluto','chiron');var arrayData=Array2D(11,7);var LongitudeG=new Array();var DeclinationG=new Array();for(i=0;i<11;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);arrayData[i][0]=tetraRen($const.body.position.apparentLongitude+ay);LongitudeG[i+1]=tetraRen($const.body.position.apparentLongitude);arrayData[i][1]=$const.body.position.apparentLatitude;arrayData[i][2]=$const.body.position.apparent.dRA*180/Math.PI/15;arrayData[i][3]=$const.body.position.apparent.dDec*180/Math.PI;DeclinationG[i+1]=$const.body.position.apparent.dDec*180/Math.PI;arrayData[i][4]=$const.body.position.geocentricDistance;arrayData[i][5]=$const.body.position.altaz.topocentric.azimuth;arrayData[i][6]=$const.body.position.altaz.topocentric.altitude;out=nbody[i]+": ";for(i1=0;i1<7;i1++){out=out+arrayData[i][i1]+" ";}}var star_names=new Array("Alpheratz","Ankaa","Schedar","Diphda","Achernar","Hamal","Acamar","Menkar","Mirfak","Aldebaran","Rigel","Capella","Bellatrix","Elnath","Alnilam","Betelgeuse","Canopus","Sirius","Adhara","Procyon","Pollux","Avior","Suhail","Miaplacidus","Alphard","Regulus","Dubhe","Denebola","Gienah","Acrux","Gacrux","Alioth","Spica","Alkaid","Hadar","Menkent","Arcturus","Rigel","Al-Zubenelgen","Kochab","Alphecca","Antares","Atria","Sabik","Shaula","Rasalhague","Eltanin","Kaus Aust.","Vega","Nunki","Altair","Peacock","Deneb","Enif","Alnair","Fomalhaut","Markab","Polaris");var star_abv=new Array("Alpheratz","Ankaa","Schedar","Diphda","Achernar","Hamal","thAcamar","Menkar","Mirfak","Aldebaran","Rigel","Capella","Bellatrix","Elnath","Alnilam","Betelgeuse","Canopus","Sirius","Adhara","Procyon","Pollux","Avior","Suhail","Miaplacidus","Alphard","Regulus","Dubhe","Denebola","Gienah","alAcrux","Gacrux","Alioth","Spica","Alkaid","Hadar","Menkent","Arcturus","Rigil","alZubenelgen","Kochab","Alphecca","Antares","Atria","Sabik","Shaula","Rasalhague","Eltanin","KausAust","Vega","Nunki","Altair","Peacock","Deneb","Enif","Alnair","Fomalhaut","Markab","Polaris");var arrayStars=Array2D(star_abv.length,2);for(i=0;i<star_abv.length;i++){var body=$moshier.body[star_abv[i]];$processor.calc(date,body);var l=$const.body.position.apparentLongitude*180/Math.PI+ay;arrayStars[i][0]=l;dec=0;}var body=$moshier.body.Sirius;$processor.calc(date,body);var body=$moshier.body.Aldebaran;$processor.calc(date,body);var hh2=hh+1;var date2={year:yy_astro,month:m,day:dd,hours:hh2,minutes:mm,seconds:0,offset:off};$processor.init();var ret_birth=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];for(i=0;i<11;+i++){var body=$moshier.body[nbody[i]];$processor.calc(date2,body);ret_birth[i]=FNretro(arrayData[i][0],tetraRen($const.body.position.apparentLongitude+ay));if(ret_birth[i]<0){LongitudeG[i+1]= -LongitudeG[i+1];}}lgmt=$const.body.position.altaz.dLocalApparentSiderialTime;var san_date=[];san_date=tetraren(jd);var phases=new Array();phases=tetrabben(san_date[0],san_date[1],san_date[2]);var SAN=0;for(i=0;i<8;i=i+2){if(phases[i]<jd){SAN=phases[i];}}var rxy=MoonTrueNode(date_natal_orig)+ay;san_date=tetraren(SAN);var date={year:san_date[0],month:san_date[1],day:san_date[2],hours:0,minutes:0,seconds:0,offset:0};var body=$moshier.body['moon'];$processor.calc(date,body);var SAN_long=tetraRen($const.body.position.apparentLongitude+ay);if(SAN_long<0){SAN_long+=360;}var body=$moshier.body['sun'];$processor.calc(date,body);var SAN_SUN_long=tetraRen($const.body.position.apparentLongitude+ay);if(SAN_SUN_long<0){SAN_SUN_long+=360;}var SAN_type="New";var d=Math.abs(SAN_long-SAN_SUN_long);if(d>360){d-=360;}if(d>170){SAN_type="Full";}var nodes=new Array();nodes=tetraqen(jd_original);var aPoints=new Array();aPoints[1]=nodes[0];aPoints[6]=nodes[1];var nodesG=new Array();nodesG=nodes;nodes[0]+=ay;nodes[1]+=ay;nodes[2]+=ay;for(i=0;i<4;i++){}jd=date.julian;h_sys=eval(document.getElementById("h_sys").value);var hposG=new Array();hposG=tetraAen(jd_original,longitude,latitude,h_sys);;for(i=12;i>0;i--){hposG[i]=hposG[i-1]*180/Math.PI;}hposG[0]=0;aPoints[3]=hposG[1];aPoints[4]=hposG[10];var h=new Array();h=tetraAen(jd_original,longitude,latitude,h_sys);var hposPlacidus=new Array();hposPlacidus=tetraAen(jd_original,longitude,latitude,0);for(i=0;i<12;i++){h[i]+=ay*(Math.PI/180);if(h[i]<0){h[i]+=2*Math.PI;}hposPlacidus[i]+=ay*(Math.PI/180);if(hposPlacidus[i]<0){hposPlacidus[i]+=2*Math.PI;}}var dataRadix={"planets":{"Sun":[36]},"cusps":[],"declination":[],"angles":[]};var SendData=new Array();var SendDataHouses=new Array();for(i=0;i<12;i++){house=(h[i]*45/Math.atan(1));dataRadix["cusps"][i]=house;SendDataHouses[i]=house;}dataRadix["angles"][0]=hposPlacidus[0]*45/Math.atan(1);dataRadix["angles"][3]=hposPlacidus[3]*45/Math.atan(1);dataRadix["angles"][6]=hposPlacidus[6]*45/Math.atan(1);dataRadix["angles"][9]=hposPlacidus[9]*45/Math.atan(1);v=arrayData[0][6];ubt=arrayData[0][6];ubt_dig=ubt;if(PFFormula<1){ubt=Math.abs(ubt);}var RawRadix=new Array();SendData[13]=dataRadix["cusps"][0];SendData[14]=dataRadix["cusps"][9];v=arrayData[10][0];RawRadix[10]=v;if(show_chiron<1){dataRadix["planets"]["Chiron"]=[v];dataRadix["declination"]["Chiron"]=arrayData[10][3];}SendData[15]=v;v=arrayData[0][0];dataRadix["planets"]["Sun"]=[v];dataRadix["declination"]["Sun"]=arrayData[0][3];RawRadix[0]=v;SendData[0]=v;v=arrayData[1][0];dataRadix["planets"]["Moon"]=[v];dataRadix["declination"]["Moon"]=arrayData[1][3];RawRadix[1]=v;SendData[1]=v;v=arrayData[2][0];dataRadix["planets"]["Mercury"]=[v];dataRadix["declination"]["Mercury"]=arrayData[2][3];RawRadix[2]=v;SendData[2]=v;v=arrayData[3][0];dataRadix["planets"]["Venus"]=[v];dataRadix["declination"]["Venus"]=arrayData[3][3];RawRadix[3]=v;SendData[3]=v;v=arrayData[4][0];dataRadix["planets"]["Mars"]=[v];dataRadix["declination"]["Mars"]=arrayData[4][3];RawRadix[4]=v;SendData[4]=v;v=arrayData[5][0];dataRadix["planets"]["Jupiter"]=[v];dataRadix["declination"]["Jupiter"]=arrayData[5][3];RawRadix[5]=v;SendData[5]=v;v=arrayData[6][0];dataRadix["planets"]["Saturn"]=[v];dataRadix["declination"]["Saturn"]=arrayData[6][3];RawRadix[6]=v;SendData[6]=v;v=arrayData[7][0];if(show_outer<1){dataRadix["planets"]["Uranus"]=[v];dataRadix["declination"]["Uranus"]=arrayData[7][3];}RawRadix[7]=v;SendData[7]=v;v=arrayData[8][0];if(show_outer<1){dataRadix["planets"]["Neptune"]=[v];dataRadix["declination"]["Neptune"]=arrayData[8][3];}RawRadix[8]=v;SendData[8]=v;v=arrayData[9][0];if(show_outer<1){dataRadix["planets"]["Pluto"]=[v];dataRadix["declination"]["Pluto"]=arrayData[9][3];}RawRadix[9]=v;SendData[9]=v;v=tetraRen(nodes[0]);RawRadix[10]=v;SendData[11]=v;if(show_nodes<1){dataRadix["planets"]["NNode"]=[v];}v=tetraRen(nodes[0]+180);if(v>360){v-=360;}if(v<0){v+=360;}RawRadix[11]=v;if(show_nodes<1&&show_snode<1){dataRadix["planets"]["SNode"]=[v];}v=tetraRen(nodes[2]);RawRadix[12]=v;SendData[10]=v;if(show_lilith<1){dataRadix["planets"]["Lilith"]=[v];}ASCL=tetraRen(h[0]*45/Math.atan(1));RawRadix[13]=ASCL;MOONL=arrayData[1][0];SUNL=arrayData[0][0];SUNALT=arrayData[0][6];if(PFFormula<1){SUNALT=Math.abs(SUNALT);}if(SUNALT>0){POF=Mod360(ASCL+MOONL-SUNL);}else{POF=Mod360(ASCL-MOONL+SUNL);}v=tetraRen(POF);RawRadix[14]=v;SendData[12]=v;if(show_pf<1){dataRadix["planets"]["PFortunae"]=[v];}if(SUNALT>0){aPoints[5]=Mod360(aPoints[3]+LongitudeG[2]-LongitudeG[1]);}else{aPoints[5]=Mod360(aPoints[3]-LongitudeG[2]+LongitudeG[1]);}var today=new Date();yy=today.getUTCFullYear();m=today.getUTCMonth()+1;dd=today.getUTCDate();hh=today.getUTCHours();mm=today.getUTCMinutes();ss=0;var date={year:yy,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:0};$const.tlong= -longitude;$const.glat=latitude;$processor.init();var nbody=new Array('sun','moon','mercury','venus','mars','jupiter','saturn','uranus','neptune','pluto','chiron');var arrayData=Array2D(11,7);for(i=0;i<11;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);arrayData[i][0]=tetraRen($const.body.position.apparentLongitude+ay);arrayData[i][1]=$const.body.position.apparentLatitude;arrayData[i][2]=$const.body.position.apparent.dRA*180/Math.PI/15;arrayData[i][3]=$const.body.position.apparent.dDec*180/Math.PI;arrayData[i][4]=$const.body.position.geocentricDistance;arrayData[i][5]=$const.body.position.altaz.topocentric.azimuth;arrayData[i][6]=$const.body.position.altaz.topocentric.altitude;out=nbody[i]+": ";for(i1=0;i1<7;i1++){out=out+arrayData[i][i1]+" ";}}var hh3=hh+1;var date3={year:yy,month:m,day:dd,hours:hh3,minutes:mm,seconds:0,offset:0};$processor.init();var ret_transit=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];for(i=0;i<11;+i++){var body=$moshier.body[nbody[i]];$processor.calc(date3,body);ret_transit[i]=FNretro(arrayData[i][0],tetraRen($const.body.position.apparentLongitude+ay));}var nodes=new Array();nodes=tetraqen(date.julian);nodes[0]+=ay;nodes[1]+=ay;nodes[2]+=ay;jd=date.julian;var h_t=new Array();h_t=tetraAen(jd,longitude,latitude,h_sys);for(i=0;i<12;i++){h_t[i]+=ay*(Math.PI/180);if(h_t[i]<0){h_t[i]+=2*Math.PI;}}var dataTransit={"planets":{"Sun":[36]},"cusps":[]};for(i=0;i<12;i++){house=tetraRen(h_t[i]*45/Math.atan(1));dataTransit["cusps"][i]=house;}var RawTransit=new Array();v=arrayData[10][0];;RawTransit[10]=v;if(show_chiron<1){dataTransit["planets"]["Chiron"]=[v];}v=arrayData[0][0];dataTransit["planets"]["Sun"]=[v];RawTransit[0]=v;v=arrayData[1][0];dataTransit["planets"]["Moon"]=[v];RawTransit[1]=v;v=arrayData[2][0];dataTransit["planets"]["Mercury"]=[v];RawTransit[2]=v;v=arrayData[3][0];dataTransit["planets"]["Venus"]=[v];RawTransit[3]=v;v=arrayData[4][0];dataTransit["planets"]["Mars"]=[v];RawTransit[4]=v;v=arrayData[5][0];dataTransit["planets"]["Jupiter"]=[v];RawTransit[5]=v;v=arrayData[6][0];dataTransit["planets"]["Saturn"]=[v];RawTransit[6]=v;v=arrayData[7][0];if(show_outer<1){dataTransit["planets"]["Uranus"]=[v];}RawTransit[7]=v;v=arrayData[8][0];if(show_outer<1){dataTransit["planets"]["Neptune"]=[v];}RawTransit[8]=v;v=arrayData[9][0];if(show_outer<1){dataTransit["planets"]["Pluto"]=[v];}RawTransit[9]=v;v=tetraRen(nodes[0]);RawTransit[10]=v;if(show_nodes<1){dataTransit["planets"]["NNode"]=[v];}v=tetraRen(nodes[0]+180);if(v>360){v-=360;}RawTransit[11]=v;if(show_nodes<1&&show_snode<1){dataTransit["planets"]["SNode"]=[v];}v=tetraRen(nodes[2]);RawTransit[12]=v;if(show_lilith<1){dataTransit["planets"]["Lilith"]=[v];}ASCL=tetraRen(h_t[0]*45/Math.atan(1));RawTransit[13]=ASCL;MOONL=arrayData[1][0];SUNL=arrayData[0][0];SUNALT=arrayData[0][6];if(PFFormula<1){SUNALT=Math.abs(SUNALT);}if(SUNALT>0){POF=Mod360(ASCL+MOONL-SUNL);}else{POF=Mod360(ASCL-MOONL+SUNL);}v=tetraRen(POF);RawTransit[14]=v;if(show_pf<1){dataTransit["planets"]["PFortunae"]=[v];}ASCL=h[0]*45/Math.atan(1);MARL=RawRadix[4];SATL=RawRadix[6];var v=0;if(ubt_dig>=0){v=Mod360(ASCL+MARL-SATL);}else{v=Mod360(ASCL+SATL-MARL);}if(show_pf<1){dataRadix["planets"]["sickness"]=[v];}do_chart(dataRadix,dataTransit,arrayStars,hposPlacidus);var planets_simb=["Q","W","E","R","T","Y","U","I","O","P","{","}","`","Z","<"];PNames=new Array("<?php echo $translate_json['Sun']; ?>","<?php echo $translate_json['Moon']; ?>","<?php echo $translate_json['Mercury']; ?>","<?php echo $translate_json['Venus']; ?>","<?php echo $translate_json['Mars']; ?>","<?php echo $translate_json['Jupiter']; ?>","<?php echo $translate_json['Saturn']; ?>","<?php echo $translate_json['Uranus']; ?>","<?php echo $translate_json['Neptune']; ?>","<?php echo $translate_json['Pluto']; ?>","<?php echo $translate_json['Asc. node']; ?>","<?php echo $translate_json['Desc. node']; ?>","<?php echo $translate_json['Lilith']; ?>","<?php echo $translate_json['Ascendant']; ?>","<?php echo $translate_json['Pars Fort.']; ?>","<?php echo $translate_json['Chiron']; ?>");var out=document.getElementById('myData');out.innerHTML="";tout="<br><table class='<?php echo $tetra_table_style; ?>'><tr><th colspan=3 class='<?php echo $tetra_table_style_2; ?>'><p><h3 class='tetra-font w3-center'><?php echo $translate_json['Planets position']; ?> <i class='material-icons'>done_all</i></h3></th></tr>";tout+="<tr><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Planet/Point']; ?></th><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Radix Long.']; ?></th><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Transit Long.']; ?></th></tr>";for(i=0;i<15;i++){var Retro1="";if(ret_birth[i]<0&&(i>1)){Retro1="&rx;";}var Retro2="";if(ret_transit[i]<0&&(i>1)){Retro2="&rx;";}if((i==12&&show_lilith<1)|(i==14&&show_pf<1)|(i==10&&show_nodes<1)|(i==11&&show_nodes<1&&show_snode<1)|(i<7)|(i<10&&i>6&&show_outer<1)){if(i>9){Retro1="";Retro2="";}tout+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+PNames[i]+"<span style='font-family: HamburgSymbols;font-size: 15px;'> - "+planets_simb[i]+"</span>"+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(RawRadix[i])+" "+Retro1+"<br>H-"+tetraien(RawRadix[i]*Math.PI/180,h)+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(RawTransit[i])+" "+Retro2+"<br>H-"+tetraien(RawTransit[i]*Math.PI/180,h_t)+"</td></tr>";}}if(show_chiron==0){dataRad=dataRadix["planets"]["Chiron"];dataTra=dataTransit["planets"]["Chiron"];tout+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+PNames[15]+"<span style='font-family: HamburgSymbols;font-size: 15px;'> - M</span>"+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(dataRad)+" "+Retro1+"<br>H-"+tetraien(dataRad*Math.PI/180,h)+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(dataTra)+" "+Retro2+"<br>H-"+tetraien(dataTra*Math.PI/180,h_t)+"</td></tr>";}if(show_syzygy<1){var SAN_txt=tr("Syzygy - "+SAN_type);tout+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+SAN_txt+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(SAN_long)+"</td><td class='<?php echo $tetra_table_style_2; ?>'> - </td></tr>";}tout+="</table></p>";out.innerHTML=tout;if(document.getElementById("TETRA_PLANETS")){document.getElementById("TETRA_PLANETS").innerHTML=document.getElementById("myData").innerHTML;}tout="";var out2=document.getElementById('myData2');out2.innerHTML="";var nomenc=["<?php echo $translate_json['Ascendant']; ?>","-","-","<?php echo $translate_json['Imum Coeli']; ?>","-","-","<?php echo $translate_json['Descendant']; ?>","-","-","<?php echo $translate_json['Medium Coeli']; ?>","-","-",];tout="<br><table class='<?php echo $tetra_table_style; ?>'><tr><th colspan=3 class='<?php echo $tetra_table_style_2; ?>'><p><h3 class='tetra-font w3-center'><?php echo $translate_json['House positions']; ?> <i class='material-icons'>done_all</i></h3></th></tr>";tout+="<tr><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['House']; ?></b></th><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Radix Long.']; ?></th><th style='text-align:center;' class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Nomenclature']; ?></th></tr>";for(i=0;i<12;i++){tout+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+(i+1)+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(h[i]*45/Math.atan(1))+"</td><td style='text-align:center;' class='<?php echo $tetra_table_style_2; ?>'>";if((i%3==0)&&h_sys==2){tout+=""+nomenc[i]+"<br>"+RedAng(hposPlacidus[i]*45/Math.atan(1))+"</td></tr>";}else{tout+=""+nomenc[i]+"</td></tr>";}}tout+="</table></p>";out2.innerHTML=tout;if(document.getElementById("TETRA_HOUSES")){document.getElementById("TETRA_HOUSES").innerHTML=document.getElementById("myData2").innerHTML;}tout="";var out3=document.getElementById('myData3');out3.innerHTML="";tstars='';if(show_stars<1){tstars+="<br><table class='<?php echo $tetra_table_style; ?>'><tr><th colspan=4 class='<?php echo $tetra_table_style_2; ?>'><p><h3 class='tetra-font w3-center'><?php echo $translate_json['Star positions']; ?> <i class='material-icons'>done_all</i></h3></th></tr>";var tdc="<td class='<?php echo $tetra_table_style_2; ?>'>";var tdc2="<td class='<?php echo $tetra_table_style_2; ?>'>";tstars+="<tr><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Star']; ?></th><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Radix Long.']; ?></th><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Star']; ?></th><th class='<?php echo $tetra_table_style_2; ?>'><?php echo $translate_json['Radix Long.']; ?></th></tr>";for(i=0;i<star_abv.length;i=i+2){tstars+="<tr>"+tdc+star_names[i]+"</td>"+tdc2+RedAng(arrayStars[i][0])+" "+"<br><b>H-"+tetraien(arrayStars[i][0]*Math.PI/180,h)+"</b></td>";tstars+=tdc+star_names[i+1]+"</td>"+tdc2+RedAng(arrayStars[i+1][0])+" "+"<br><b>H-"+tetraien(arrayStars[i+1][0]*Math.PI/180,h)+"</b></td></tr>";}tstars+="</table></p>";}tout+=tstars;out3.innerHTML=tout;if(document.getElementById("TETRA_STARS")){document.getElementById("TETRA_STARS").innerHTML=document.getElementById("myData3").innerHTML;}tout="";var myP=document.getElementById('myPars');myP.innerHTML="";if(show_parts<1){var Pars=[];ASCL=h[0]*45/Math.atan(1);SUNL=RawRadix[0];MOONL=RawRadix[1];MERL=RawRadix[2];VENL=RawRadix[3];MARL=RawRadix[4];JUPL=RawRadix[5];SATL=RawRadix[6];SANL=SAN_long;var myPNames=["<?php echo $translate_json['Pars Fort.']; ?><br><i><?php echo $translate_json['Fortune']; ?></i>","<?php echo $translate_json['Pars Futurorum']; ?><br><i><?php echo $translate_json['Daemon and religion (Spirit)']; ?></i>","<?php echo $translate_json['Pars Veneris']; ?><br><i><?php echo $translate_json['Friendship and Love']; ?></i>","<?php echo $translate_json['Pars Mercurii']; ?><br><i><?php echo $translate_json['Despair, penury and fraud']; ?></i>","<?php echo $translate_json['Pars Saturni']; ?><br><i><?php echo $translate_json['Captivity, prisons and escape']; ?></i>","<?php echo $translate_json['Pars Iovis']; ?><br><i><?php echo $translate_json['Victory, triumph and help']; ?></i>","<?php echo $translate_json['Pars Martis']; ?><br><i><?php echo $translate_json['Courage and Bravery']; ?></i>","<?php echo $translate_json['Pars Hyleg']; ?><br><i><?php echo $translate_json['Life giver']; ?></i>","<?php echo $translate_json['Pars Anareitai']; ?><br><i><?php echo $translate_json['Destroyer']; ?></i>","<?php echo $translate_json['Part of Life']; ?>","<?php echo $translate_json['Part of Sickness']; ?>","<?php echo $translate_json['Part of Bad Luck']; ?>","<?php echo $translate_json['Part of Death']; ?>"];var info_1=[4,3,2,1,0,2,3,4,5,6,6,5];var aruler=Math.floor(ASCL/30.0);aruler=info_1[aruler];var ASCR=RawRadix[aruler];Pars=FPars(ubt_dig,PFFormula,ASCL,SUNL,MOONL,MERL,VENL,MARL,JUPL,SATL,SANL,ASCR,h);p_out="<br><table class='<?php echo $tetra_table_style; ?>'><tr><th colspan=2 class='<?php echo $tetra_table_style_2; ?>'><p><h3 class='tetra-font w3-center'><?php echo $translate_json['Arabic Parts']; ?> <i class='material-icons'>done_all</i></h3></th></tr>";for(i=0;i<13;i++){p_out+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+myPNames[i]+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(Pars[i])+"<br>H-"+tetraien(Pars[i]*Math.PI/180,h)+"</td></tr>";}var teste1=ParsFull(ubt_dig,RawRadix,h,SANL);var zz=add_pars;var oPars=zz.split(',');if(zz[0]> -1){for(ii=0;ii<oPars.length;ii++){var cc_v=oPars[ii];p_out+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+"Pars "+teste1[0][cc_v]+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+RedAng(teste1[1][cc_v])+"<br>H-"+tetraien(teste1[1][cc_v]*Math.PI/180,h)+"</td></tr>";}}p_out+="</table></p>";myP.innerHTML+=p_out;}if(document.getElementById("TETRA_PARS")){document.getElementById("TETRA_PARS").innerHTML=document.getElementById("myPars").innerHTML;}var myD=document.getElementById('myDigs');myD.innerHTML="";var dig_score=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];var dig_score_mr=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];var has_major_dig=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];var has_minor_dig=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];if(show_dignities<1){dig_out="<br><table class='<?php echo $tetra_table_style; ?>'><tr><th colspan=2 class='<?php echo $tetra_table_style_2; ?>'><p><h3 class='tetra-font w3-center'><?php echo $translate_json['Classical Dignities']; ?> <i class='material-icons'>done_all</i></h3></th></tr><tr><td class='<?php echo $tetra_table_style_2; ?>'>";var dig_txt="";var dig_value=[[]];for(i=0;i<12;i++){dig_value[i]=Dignity(i,RawRadix[i],ubt_dig);}dig_out+="<p>";var p_rulers=["<?php echo $translate_json['Rulership']; ?>","<?php echo $translate_json['Exaltation']; ?>","<?php echo $translate_json['Fall']; ?>","<?php echo $translate_json['Detriment']; ?>"];var dignities_cat=["<?php echo $translate_json['Rulership']; ?>","<?php echo $translate_json['Triplicity']; ?>","<?php echo $translate_json['Terms']; ?>","<?php echo $translate_json['Face']; ?>"];var p_rulers_score=[5,4,-4,-5];var dignities_cat_score=[5,3,2,1];var np1=12;if(show_outer>0){np1=7;}for(i=0;i<np1;i++){for(j=0;j<4;j++){dv=dig_value[i][j];if(dv>=0){if(j==0){dig_txt+="<b>"+PNames[i]+":</b> "+p_rulers[3-dv]+"<br>";if(dv<2){dig_score[i]+=p_rulers_score[3-dv];has_major_dig[i]= -1;}}else{dig_txt+="<b>"+PNames[i]+":</b> "+dignities_cat[j]+"<br>";if(j>0){dig_score[i]+=dignities_cat_score[j];has_major_dig[i]=1;}}}}}dig_txt+="<br>";var npl=7;if(digsystemoriginal==3&&show_outer<1){npl=12;}for(i=0;i<=npl;i++){if(isRuler(i,RawRadix[i])){dig_score[i]+=5;has_major_dig[i]=1;}if(tetraxen(i,RawRadix[i])){dig_score[i]+=4;has_major_dig[i]=1;}var mr=tetraGen(i,RawRadix);var me=tetracen(i,RawRadix);var res=tetraGen(i,RawRadix);if(res[0]==1){dig_score[i]+=5;has_minor_dig[i]=1;dig_txt+="<b>"+PNames[i]+":</b> <i><?php echo $translate_json['mutual reception']; ?></i> <?php echo $translate_json['in Rulership with']; ?> "+PNames[res[1]]+"<br>";}var res=tetracen(i,RawRadix);if(res[0]==1){dig_score[i]+=4;has_minor_dig[i]=1;dig_txt+="<b>"+PNames[i]+":</b> <i><?php echo $translate_json['mutual reception']; ?></i> <?php echo $translate_json['in Exaltation with']; ?> "+PNames[res[1]]+"<br>";}var res=tetraIen(i,RawRadix,ubt_dig,dig_system);if(res[0]==1){dig_score_mr[i]+=3;has_minor_dig[i]=1;dig_txt+="<b>"+PNames[i]+":</b> <i><?php echo $translate_json['mutual reception']; ?></i> <?php echo $translate_json['in Triplicity with']; ?> "+PNames[res[1]]+"<br>";}var res=tetraMen(i,RawRadix,dig_system);if(res[0]==1){dig_score_mr[i]+=2;has_minor_dig[i]=1;dig_txt+="<b>"+PNames[i]+":</b> <i><?php echo $translate_json['mutual reception']; ?></i> <?php echo $translate_json['in Terms with']; ?> "+PNames[res[1]]+"<br>";}var res=tetragen(i,RawRadix);if(res[0]==1){dig_score_mr[i]+=1;has_minor_dig[i]=1;dig_txt+="<b>"+PNames[i]+":</b> <i><?php echo $translate_json['mutual reception']; ?></i> <?php echo $translate_json['in Face with']; ?> "+PNames[res[1]]+"<br>";}}npl=6;if(digsystemoriginal==3&&show_outer<1){npl=11;}if(dig_system<2){var scores="<br><b><?php echo $translate_json['Scores']; ?></b> (<?php echo $translate_json['ess. dig.']; ?> Ptolemy):<br><br>";}else{var scores="<br><b><?php echo $translate_json['Scores']; ?></b> (<?php echo $translate_json['ess. dig.']; ?> Dorotheus):<br><br>";}if(digsystemoriginal==3){if(dig_system<2){var scores="<br><b><?php echo $translate_json['Scores']; ?></b> (<?php echo $translate_json['modern dig.']; ?> + Ptolemy):<br><br>";}else{var scores="<br><b><?php echo $translate_json['Scores']; ?></b> (<?php echo $translate_json['modern dig.']; ?> + Dorotheus):<br><br>";}}for(i=0;i<=npl;i++){var is_pilgrim="";dig_score_mr[i]+=dig_score[i];if(has_major_dig[i]==0){dig_score[i]+= -5;is_pilgrim=" <b>p</b>";}scores+="<b>"+PNames[i]+":</b> "+dig_score[i]+is_pilgrim+"<br>";}if(dig_system<2){var mscores="<br><b><?php echo $translate_json['Scores with m.r. dig.']; ?></b> (<?php echo $translate_json['ess. dig.']; ?> Ptolemy):<br><br>";}else{var mscores="<br><b><?php echo $translate_json['Scores with m.r. dig.']; ?></b> (<?php echo $translate_json['ess. dig.']; ?> Dorotheus):<br><br>";}if(digsystemoriginal==3){if(dig_system<2){var mscores="<br><b><?php echo $translate_json['Scores with m.r. dig.']; ?></b> (<?php echo $translate_json['modern dig.']; ?> + Ptolemy):<br><br>";}else{var mscores="<br><b><?php echo $translate_json['Scores with m.r. dig.']; ?></b> (<?php echo $translate_json['modern dig.']; ?> + Dorotheus):<br><br>";}}for(i=0;i<=npl;i++){var is_pilgrim="";if(has_major_dig[i]<=0&&has_minor_dig[i]==0){dig_score_mr[i]+= -5;is_pilgrim=" <b>p</b>";}var sscore=dig_score_mr[i];mscores+="<b>"+PNames[i]+":</b> "+sscore+is_pilgrim+"<br>";}if(digsys<2){dig_txt+=mscores;}else{dig_txt+=scores;}dig_out+=dig_txt+"</p></td></tr></table></p>";if(dig_txt!=""){myD.innerHTML+=dig_out;}}else{dig_score[0]=999;}if(document.getElementById("TETRA_DIGS")){document.getElementById("TETRA_DIGS").innerHTML=document.getElementById("myDigs").innerHTML;}var myElem=document.getElementById('myElements');myElem.innerHTML="";if(show_elements<1){e_out="<br><table class='<?php echo $tetra_table_style; ?>'>";e_out+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+"<h3 class='tetra-font w3-center'><?php echo $translate_json['Elements']; ?></h3></td></tr><tr><td class='<?php echo $tetra_table_style_2; ?>'>";var e_txt="";var e1_value=["","","","","","","","","","","","",""];var e2_value=["","","","","","","","","","","","",""];var elements_1=["<?php echo $translate_json['Fire']; ?>","<?php echo $translate_json['Earth']; ?>","<?php echo $translate_json['Air']; ?>","<?php echo $translate_json['Water']; ?>"];var elements_2=["<?php echo $translate_json['Cardinal']; ?>","<?php echo $translate_json['Fixed']; ?>","<?php echo $translate_json['Mutable']; ?>"];var elements_sum=[0,0,0,0];var elements_sum2=[0,0,0,0];e_txt="<p>";var np2=10;if(show_outer>0){np2=7;}for(i=0;i<np2;i++){sgn=Math.floor(RawRadix[i]/30);if(sgn<0){sgn+=12;}elem=sgn%4;elem2=sgn%3;e1_value[elem]+=PNames[i]+" ";e2_value[elem2]+=PNames[i]+" ";elements_sum[elem]+=1;elements_sum2[elem2]+=1;}for(i=0;i<4;i++){elements_sum[i]=Math.floor(elements_sum[i]/np2*1000)/10;e_txt+="<b>"+elements_1[i]+":</b> "+e1_value[i]+" &bullet; <b>"+elements_sum[i]+"%</b>"+"<br>";}e_txt+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+"<br><h3 class='tetra-font w3-center'><?php echo $translate_json['Qualities']; ?></h3></td></tr><tr><td class='<?php echo $tetra_table_style_2; ?>'>";e_txt+="<p>";for(i=0;i<3;i++){elements_sum2[i]=Math.floor(elements_sum2[i]/np2*1000)/10;e_txt+="<b>"+elements_2[i]+":</b> "+e2_value[i]+" &bullet; <b>"+elements_sum2[i]+"%</b>"+"<br>";}e_out+=e_txt+"</p><br></td></tr></table>";if(e_txt!=""){myElem.innerHTML+=e_out;}}if(document.getElementById("TETRA_ELEMENTS")){document.getElementById("TETRA_ELEMENTS").innerHTML=document.getElementById("myElements").innerHTML;}var output="";var out=document.getElementById('myVedic');if(show_vedic<1){var vedic=[];vedic_moon=tetraRen(RawRadix[1]+ay_default);vedic_sun=tetraRen(RawRadix[0]+ay_default);vedic_asc=tetraRen(h[0]*45/Math.atan(1)+ay_default);vedic_mc=tetraRen(h[9]*45/Math.atan(1)+ay_default);vedic=tetrabHen(vedic_moon,vedic_sun);var out=document.getElementById('myVedic');output="<table class='<?php echo $tetra_table_style; ?>'><tr><td colspan=4 class='<?php echo $tetra_table_style_2; ?>'>";output+="<h3 class='tetra-font'><?php echo $translate_json['Vedic Chart']; ?>:</h3></td></tr><td colspan=4 class='<?php echo $tetra_table_style_2; ?>'><h4 class='tetra-font'><?php echo $translate_json['Main Info']; ?>:</h4><b>Pada:</b> "+vedic[0]+"<br>";output+="<b>Yoga:</b> "+vedic[1]+"<br>";output+="<b>Karana:</b> "+vedic[2]+"<br>";output+="<b>Thiti:</b> "+vedic[3]+"<br>";output+="<b>Janma Nakshatram:</b> "+" "+vedic[4]+"<br>";var vhouses=[];vhouses=bhava(vedic_asc,vedic_mc);output+="</tr><tr><td colspan=4 class='<?php echo $tetra_table_style_2; ?>'><br><h3 class='tetra-font'><?php echo $translate_json['Graha positions']; ?>:</h3></td></tr>";output+="<tr><td class='<?php echo $tetra_table_style_2; ?>'><b>Graha</b></td><td class='<?php echo $tetra_table_style_2; ?>'><b>Rasi</b></td><td class='<?php echo $tetra_table_style_2; ?>'><b>Nakshatra</b></td><td class='<?php echo $tetra_table_style_2; ?>'><b>House</b></td></tr>";for(i=0;i<14;i++){if(i!=7&&i!=8&&i!=9){output+="<tr><td class='<?php echo $tetra_table_style_2; ?>'><b>"+PNames[i]+"</b></td><td class='<?php echo $tetra_table_style_2; ?>'>"+tetrabOen(RawRadix[i]+ay_default)+"</td><td class='<?php echo $tetra_table_style_2; ?>'>"+tetraoen(RawRadix[i]+ay_default)+"</td>";if(i<14){vedic_planet=tetraRen(RawRadix[i]+ay_default);output+="<td class='<?php echo $tetra_table_style_2; ?>'>"+tetrabken(vedic_planet,vhouses[1])+"</td>";}else{output+="<td class='<?php echo $tetra_table_style_2; ?>'>-</td>";}output+="</tr>";}}yy=eval(document.getElementById("year").value);mes=eval(document.getElementById("month").value);dd=eval(document.getElementById("day").value);h=eval(document.getElementById("hour").value);m=eval(document.getElementById("minute").value);s=0;jd_natal=tetraLen(vera,yy,mes,dd,h,m,0);res1=tetrabPen(false,vedic_moon,yy,mes,dd,h,m,jd_natal);var res=res1.split("|");tdc="<td  class='<?php echo $tetra_table_style_2; ?>'>";var dasa="<tr><td class='<?php echo $tetra_table_style_2; ?>' colspan=4><h3 class='tetra-font'><?php echo $translate_json['Dasas']; ?>:</h3></td><tr><td class='<?php echo $tetra_table_style_2; ?>' colspan=4><b><?php echo $translate_json['Birth Dasa']; ?>:</b> "+res[0]+" ( <?php echo $translate_json['begun in']; ?> "+res[2]+" )";dasa+="<br><b><?php echo $translate_json['Current Dasa']; ?>:</b> "+res[1]+" ( <?php echo $translate_json['begun in']; ?> "+res[3]+" )<br><br>";output+=dasa+"</td></tr></table>";}out.innerHTML=output;if(document.getElementById("TETRA_VEDIC")){document.getElementById("TETRA_VEDIC").innerHTML=output;}console.log("Send data: "+SendData);reports=natal_show;var myAscendant=RedAng(h[i]*45/Math.atan(1));var mySolarSign=RedAng(RawRadix[i]);var droot="<?php echo plugins_url('Tetrabyblos') ?>/";var myRep=document.getElementById('myReports');myRep.innerHTML="";if(reports>1){$jq.ajax({data:{'user':'kepler','data_pos':SendData,'data_pos_h':SendDataHouses,'ubt':ubt_dig,'dig_score':dig_score,'show_custom_img':show_custom_img,'custom_img_size':custom_img_size,'show_outer':show_outer,'doc_root':droot,'ay_default':ay_default,'show_short':show_short_report,'show_nakshatra_report_sys':show_nakshatra_report_sys,'show_chiron':show_chiron},type:'POST',dataType:'JSON',url:"<?php echo plugins_url('Tetrabyblos'); ?>/natal_report.php",success:function($answer){myRep.innerHTML=tr_2($answer['html']);if(document.getElementById("TETRA_REPORTS")){document.getElementById("TETRA_REPORTS").innerHTML=document.getElementById("myReports").innerHTML;}if(document.getElementById("TETRA_SHORT_REPORTS")){document.getElementById("TETRA_SHORT_REPORTS").innerHTML=tr_2($answer['html_short']);}}});}var x=document.getElementById("myDIV2");x.style.display="block";if(show_transits>1){var GData=new Array();GData=tetraaxen(date_transit,longitude,latitude);var TransitsCalendar=document.getElementById('myTransitsCalendar');TransitsCalendar.innerHTML="";TransitsCalendar.innerHTML+="<div class='w3-center'><div class='w3-bar'><form id='form-id' method='POST' action='"+transit_url+"'><input type='hidden' name='parameters' id='parameters' value='"+transit_parameters+"' ><input type='hidden' name='dateG' id='dateG' value='"+dateG+"' ><input type='hidden' name='LongitudeG' id='LongitudeG' value='"+GData[0].toString()+"' ><input type='hidden' name='DeclinationG' id='DeclinationG' value='"+GData[3].toString()+"' ><input type='hidden' name='nodesG' id='nodesG' value='"+GData[4].toString()+"' ><input type='hidden' name='hposG' id='hposG' value='"+GData[5].toString()+"' ><input type='hidden' name='pointsG' id='pointsG' value='"+GData[6].toString()+"' ><input type='hidden' name='transit1G' id='transit1G' value='"+GData[1].toString()+"' ><input type='hidden' name='transit2G' id='transit2G' value='"+GData[2].toString()+"' ><input type='hidden' name='transit1DecG' id='transit1DecG' value='"+GData[7].toString()+"' ><input type='hidden' name='transit1housesG' id='transit1housesG' value='"+GData[8].toString()+"' ><input type='hidden' name='transit1pointsG' id='transit1pointsG' value='"+GData[9].toString()+"' ><input type='hidden' name='showopt' id='showopt' value='"+show_transits+"' ><br><button class='<?php echo $tetra_button_style; ?>' name='create3' id='create3' style='font-family: Merriweather;' id='your-id'><?php echo $translate_json['Calculate Daily Transits Calendar']; ?></button></form></div></div>";}if(b_calc_again<1){document.getElementById("TETRA_CALC_AGAIN").innerHTML="<div class='w3-center'><div class='w3-bar'><br><p><button class='<?php echo $tetra_button_style; ?>' name='create2' id='create2' style='font-family: Merriweather;' onclick='javascript:calc_again();'><?php echo $translate_json['Calculate Another Chart']; ?></button></p></div></div>";}if(b_calc_transit<1){if(document.getElementById("TETRA_TRANSITS")){document.getElementById("TETRA_TRANSITS").innerHTML=document.getElementById("myTransitsCalendar").innerHTML;}}jump("myStart");};function calc_again(){var x=document.getElementById("myDIV2");x.style.display="none";var y=document.getElementById("main_astro_div");y.style.display="block";jump("main_astro_div");};function RedAng(x){signs=new Array("a","s","d","f","g","h","j","k","l","z","x","c");if(x<0){x+=360.0;}signo=Math.floor(x/30.0);x-=30*signo;x=Math.floor(x*100)/100;x=DMS(x);return x+" "+"<span style='font-family: HamburgSymbols;font-size: 15px;'>"+signs[signo]+"</span>";};function Array2D(x,y){var array2D=new Array(x);for(var i=0;i<array2D.length;i++){array2D[i]=new Array(y);}return array2D;};var star_names=new Array("Alpheratz","Ankaa","Schedar","Diphda","Achernar","Hamal","Acamar","Menkar","Mirfak","Aldebaran","Rigel","Capella","Bellatrix","Elnath","Alnilam","Betelgeuse","Canopus","Sirius","Adhara","Procyon","Pollux","Avior","Suhail","Miaplacidus","Alphard","Regulus","Dubhe","Denebola","Gienah","Acrux","Gacrux","Alioth","Spica","Alkaid","Hadar","Menkent","Arcturus","Rigel","Al-Zubenelgen","Kochab","Alphecca","Antares","Atria","Sabik","Shaula","Rasalhague","Eltanin","Kaus Aust.","Vega","Nunki","Altair","Peacock","Deneb","Enif","Alnair","Fomalhaut","Markab","Polaris");var star_abv=new Array("Alpheratz","Ankaa","Schedar","Diphda","Achernar","Hamal","thAcamar","Menkar","Mirfak","Aldebaran","Rigel","Capella","Bellatrix","Elnath","Alnilam","Betelgeuse","Canopus","Sirius","Adhara","Procyon","Pollux","Avior","Suhail","Miaplacidus","Alphard","Regulus","Dubhe","Denebola","Gienah","alAcrux","Gacrux","Alioth","Spica","Alkaid","Hadar","Menkent","Arcturus","Rigil","alZubenelgen","Kochab","Alphecca","Antares","Atria","Sabik","Shaula","Rasalhague","Eltanin","KausAust","Vega","Nunki","Altair","Peacock","Deneb","Enif","Alnair","Fomalhaut","Markab","Polaris");var planets_names=["Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto","Lilith","NNode","PFortunae","Asc","Mc"];var planets_names_complete=["Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto","Lilith","Rahu","Pars Fortuna","Asc.","MC"];function do_chart(dataRadix,dataTransit,arrayStars,arrayPlacidus){var w=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth;var screensize=720;var margem=100;var COLORS_USER=[astrology_COLOR_ARIES,astrology_COLOR_TAURUS,astrology_COLOR_GEMINI,astrology_COLOR_CANCER,astrology_COLOR_LEO,astrology_COLOR_VIRGO,astrology_COLOR_LIBRA,astrology_COLOR_SCORPIO,astrology_COLOR_SAGITTARIUS,astrology_COLOR_CAPRICORN,astrology_COLOR_AQUARIUS,astrology_COLOR_PISCES,astrology_COLOR_SUN,astrology_COLOR_MOON,astrology_COLOR_MERCURY,astrology_COLOR_VENUS,astrology_COLOR_MARS,astrology_COLOR_JUPITER,astrology_COLOR_SATURN,astrology_COLOR_URANUS,astrology_COLOR_NEPTUNE,astrology_COLOR_PLUTO,astrology_COLOR_ASC,astrology_COLOR_MC,astrology_COLOR_PLANETS,astrology_COLOR_BACKGROUND,astrology_SHOW_INNER_CIRCLE,astrology_COLOR_INNER_BACKGROUND,astrology_COLOR_INNER_CIRCLE,astrology_COLOR_fire,astrology_COLOR_earth,astrology_COLOR_air,astrology_COLOR_water,astrology_COLOR_same_color];if(w<=400){}else{var screensize=720;var margem=67;}var screen_scale= <?php echo $scale; ?>;if(chart_style<1){var is_style=false;}else{var is_style=true;}if(chart_type<1){screensize=720*screen_scale;margem=67*screen_scale;var radix=new astrology.Chart('paper',screensize,screensize,{MARGIN:margem,SYMBOL_SCALE:glyph_chart,STROKE_ONLY:is_style}).radix(dataRadix);radix.aspects();}else{screensize=720*1.0;margem=77*screen_scale;var chart=new astrology.Chart('paper',screensize,screensize,{MARGIN:margem,SYMBOL_SCALE:glyph_chart,STROKE_ONLY:is_style});var radix=chart.radix(dataRadix);var transit=radix.transit(dataTransit);transit.aspects();}c=document.getElementById("paper").children;s=c[0].innerHTML;canvg('canvas_paper',s);var x=document.getElementById("canvas_paper");x.style.display="block";var aspects_letters=['q','i','t','r','e','o','p'];var aspects_color=['transparent','#004d00','#004d00','#FF0000','#004d00','#FF0000','#0000FF'];var planets_letter={"Lilith":"`","Chiron":"M","Pluto":"P","Neptune":"O","Uranus":"I","Saturn":"U","Jupiter":"Y","Mars":"T","Moon":"W","Sun":"Q","Mercury":"E","Venus":"R","NNode":"{","SNode":"}","PFortunae":"<"};var canvas=document.getElementById("canvas-grid");var ctx=canvas.getContext("2d");ctx.clearRect(0,0,620,620);ctx.scale(1,1);if(w<=400){}else{ctx.scale(1,1);}var l=30;var n=15;x=60;y=20;var allasp="";var all_radix_aspects=[];var planets_numbers=["Q","W","E","R","T","Y","U","I","O","P"];var planets_names=["Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto"];var planets_names_complete=["Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto"];var planets_colors_user=[astrology_COLOR_SUN,astrology_COLOR_MOON,astrology_COLOR_MERCURY,astrology_COLOR_VENUS,astrology_COLOR_MARS,astrology_COLOR_JUPITER,astrology_COLOR_SATURN,astrology_COLOR_URANUS,astrology_COLOR_NEPTUNE,astrology_COLOR_PLUTO];n=9;if(show_outer>0){var planets_numbers=["Q","W","E","R","T","Y","U"];var planets_names=["Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn"];var planets_names_complete=["Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn"];n=6;var planets_colors_user=[astrology_COLOR_SUN,astrology_COLOR_MOON,astrology_COLOR_MERCURY,astrology_COLOR_VENUS,astrology_COLOR_MARS,astrology_COLOR_JUPITER,astrology_COLOR_SATURN];}if(show_lilith<1){n+=1;planets_numbers[n]="`";planets_names[n]="Lilith";planets_names_complete[n]="Lilith";planets_colors_user[n]="black";}if(show_nodes<1){n+=1;planets_numbers[n]="{";planets_names[n]="NNode";planets_names_complete[n]="Rahu";planets_colors_user[n]="black";}if(show_pf<1){n+=1;planets_numbers[n]="<";planets_names[n]="PFortunae";planets_names_complete[n]="Pars Fortuna";planets_colors_user[n]="black";}if(show_chiron==0){n+=1;planets_numbers[n]="M";planets_names[n]="Chiron";planets_names_complete[n]="Chiron";planets_colors_user[n]="black";}n+=1;planets_numbers[n]="Z";planets_names[n]="Asc";planets_names_complete[n]="Asc.";planets_colors_user[n]=astrology_COLOR_ASC;n+=1;planets_numbers[n]="X";planets_names[n]="Mc";planets_names_complete[n]="MC";planets_colors_user[n]=astrology_COLOR_MC;l=Math.floor(420/n);if(show_aspects_soft<1){var aspects_names=['q','i','t','r','e','o','w'];var aspects_letters=['q','i','t','r','e','o','w'];var aspects_values=[0,30,60,90,120,150,180];var aspects_colors_user=[astrology_COLOR_CONJUNCTION,'black',astrology_COLOR_SEXTILE,astrology_COLOR_SQUARE,astrology_COLOR_TRINE,'black',astrology_COLOR_OPPOSITION];}else{var aspects_names=['q','i','y','t','\u02DC','r','e','u','\u0161','o','w'];var aspects_letters=['q','i','y','t','\u02DC','r','e','u','\u0161','o','w'];var aspects_values=[0,30,45,60,72,90,120,135,144,150,180];var aspects_colors_user=[astrology_COLOR_CONJUNCTION,'black','black',astrology_COLOR_SEXTILE,'black',astrology_COLOR_SQUARE,astrology_COLOR_TRINE,'black','black','black',astrology_COLOR_OPPOSITION];}var asp_txt="<br><table class='<?php echo $tetra_table_style; ?>'><tr><th colspan=2 class='<?php echo $tetra_table_style_2; ?>'><p><h3 class='tetra-font w3-center'><?php echo $translate_json['Natal Aspects']; ?> <i class='material-icons'>done_all</i></h3></th></tr>";asp_txt+="";v=dataRadix["cusps"][0];dataRadix["planets"]["Asc"]=v;v=dataRadix["cusps"][9];dataRadix["planets"]["Mc"]=v;var planet_n=0;for(j=0;j<=n;j++){ctx.rect(x,y+j*l,l,l);ctx.stroke();if(j>0){ctx.font='14pt HamburgSymbols';if(typeof planets_colors_user!=='undefined'){ctx.fillStyle=planets_colors_user[j-1];}else{ctx.fillStyle="black";}ctx.fillText(planets_numbers[j-1],x+10-3-l,40+j*l+2);}for(i=0;i<=n-j;i++){ctx.rect(x+i*l,y+j*l,l,l);ctx.stroke();if(i==0&&j>0){ctx.rect(x+i*l-l,y+j*l,l,l);ctx.stroke();}if(j==0){ctx.font='14pt HamburgSymbols';if(typeof planets_colors_user!=='undefined'){ctx.fillStyle=planets_colors_user[n-i];}else{ctx.fillStyle="black";}ctx.fillText(planets_numbers[n-i],x+10+i*l-3,40+j*l+2);}else{if(n-i!=j-1){p1=planets_names[n-i];p2=planets_names[j-1];var pl1=dataRadix.planets[p1];var pl2=dataRadix.planets[p2];var d1=dataRadix.declination[p1];var d2=dataRadix.declination[p2];var ddf=Math.abs(Math.abs(d1)-Math.abs(d2));if((ddf<2)&&(ddf>0)){var paraname=" <span style='font-family: HamburgSymbols;font-size: 15px;'>\u203A</span> ";if(d1*d2<0){paraname=" <span style='font-family: HamburgSymbols;font-size: 15px;'>\u0153</span> ";}if(show_aspects_soft>0){all_radix_aspects.push(""+planets_names_complete[j-1]+paraname+planets_names_complete[n-i]);}}if(Array.isArray(pl1)){var long1=pl1[0];}else{var long1=pl1;}if(Array.isArray(pl2)){var long2=pl2[0];}else{var long2=pl2;}asp=HAspect(long1,long2);if(asp>=0){ctx.font='14pt HamburgSymbols';if(typeof aspects_colors_user!=='undefined'){ctx.fillStyle=aspects_colors_user[asp];}else{ctx.fillStyle="black";}ctx.fillText(aspects_letters[asp],x+10+i*l-3,40+j*l+2);difv=Math.abs(long1-long2);if(difv>180){difv=360-difv;}difv=Math.abs(difv-aspects_values[asp]);difv=Math.floor(difv*10)/10;all_radix_aspects.push(""+planets_names_complete[j-1]+" <span style='font-family: HamburgSymbols;font-size: 15px;'>"+aspects_names[asp]+"</span> "+planets_names_complete[n-i]+" ( "+difv+"&deg; )");}}}}}var np=10;if(show_outer>0){np=7;}if(show_stars<1){for(z=0;z<star_abv.length;z++){for(zz=0;zz<np;zz++){var p1=planets_names[zz];var pl1=dataRadix.planets[p1];var dif_star=Math.abs(pl1-arrayStars[z][0]);if(dif_star>180){dif_star=360-dif_star;}if(dif_star<=1){difv=Math.abs(dif_star);difv=Math.floor(difv*10)/10;all_radix_aspects.push(p1+" <span style='font-family: HamburgSymbols;font-size: 15px;'>q</span> <i><?php echo $translate_json['Star']; ?> "+star_names[z]+"</i> ( "+difv+"&deg; )");}}}}var l=all_radix_aspects.length;if(l%2!=0){all_radix_aspects.push(" - ");l+=1;}for(i=0;i<l-1;i=i+2){asp_txt+="<tr><td class='<?php echo $tetra_table_style_2; ?>'>"+all_radix_aspects[i]+"</td>";asp_txt+="<td class='<?php echo $tetra_table_style_2; ?>'>"+all_radix_aspects[i+1]+"</td></tr>";}var img=new Image();img.onload=function(){ctx.drawImage(img,350,250,200,200);};signs=new Array("Aries","Taurus","Gemini","Cancer","Leo","Virgo","Libra","Scorpio","Sagittarius","Capricorn","Aquarius","Pisces");var sun_lon=dataRadix.planets["Sun"];var asc_lon=dataRadix.cusps[0];if(sun_lon<0){sun_lon+=360;}var sig=Math.floor(sun_lon/30);if(sig<0){sig+=12;}var imgsrc=pic_dir+sig+".png";if(show_icon>1&&show_icon<4){img.src=imgsrc;}ctx.font='22pt Merriweather';if(show_icon%2==0){ctx.fillText(tr(signs[sig]),350,470)}asp_txt+="</table></p>";var out=document.getElementById('myAspects');if(show_asp_list<1){out.innerHTML=tr(asp_txt);if(document.getElementById("TETRA_ASPECTS")){document.getElementById("TETRA_ASPECTS").innerHTML=out.innerHTML;}}};function HAspect(pp1,pp2){if(show_aspects_soft<1){var aspects=[0,30,60,90,120,150,180];var orbs=[10,3,6,10,10,3,10];var nelem=7;}else{var aspects=[0,30,45,60,72,90,120,135,144,150,180];var orbs=[10,3,3,6,2,10,10,3,2,3,10];var nelem=11;}var result= -1;var last=1000;var dif=Math.abs(pp1-pp2);if(dif>180){dif=360-dif;}for(i1=0;i1<nelem;i1++){var orbe=Math.abs(dif-aspects[i1]);if((orbe<=orbs[i1])&&(orbe<last)){result=i1;last=orbe;}}return result;};function SHDiv(){var x=document.getElementById("myDIV");if(x.style.display==="none"){x.style.display="block";}else{x.style.display="none";}};var digp=DIGTABLE;function isRuler(pn,rlon){var sn=Math.floor(rlon/30);if(digp[sn][pn][0]==true){return true;}else{return false;}};function tetraxen(pn,rlon){var sn=Math.floor(rlon/30);if(digp[sn][pn][1]==true){return true;}else{return false;}};function tetraGen(pn1,rRadix){var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if((digp[sn1][pn2][0]==true)&&(digp[sn2][pn1][0]==true)&&(pn1!=pn2)){return[1,pn2];}}return[0,0];};function tetracen(pn1,rRadix){var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if((digp[sn1][pn2][1]==true)&&(digp[sn2][pn1][1]==true)&&(pn1!=pn2)){return[1,pn2];}}return[0,0];};function tetragen(pn1,rRadix){var digfaces=[[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4],[0,3,2],[1,6,5],[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4]];var sn1=Math.floor(rRadix[pn1]/30);pfaces1=Math.floor((rRadix[pn1]-sn1*30.0)/10);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);pfaces2=Math.floor((rRadix[pn2]-sn2*30.0)/10);if((digfaces[sn1][pfaces1]==pn2)&&(digfaces[sn2][pfaces2]==pn1)&&(pn1!=pn2)){return[1,pn2];}}return[0,0];};function tetraIen(pn1,rRadix,dayt,dig_system){if(dig_system<2){triplicity=[[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1],[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1],[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1]];}else{triplicity=[[0,5,6],[3,1,5],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1]];}var j1=0;if(dayt<0){j1=1;}var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if(dig_system<2){if((triplicity[sn1][j1]==pn2)&&(triplicity[sn2][j1]==pn1)&&(pn1!=pn2)){return[1,pn2];}}else{var p=triplicity[sn1][2];var snp=Math.floor(rRadix[p]/30);if((triplicity[sn1][j1]==p)&&(triplicity[snp][j1]==pn1)){return[1,p];}if((triplicity[sn1][j1]==pn2)&&(triplicity[sn2][j1]==pn1)&&(pn1!=pn2)){return[1,pn2];}}}return[0,0];};function tetraMen(pn1,rRadix,dig_system){if(dig_system<2){var terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[4,-1],[2,5],[2,5],[3,-1],[6,-1]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[6,-1],[4,-1]],[[6,-1],[3,-1],[5,-1],[2,-1],[4,-1]],[[4,-1],[5,-1],[3,-1],[2,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[3,-1],[2,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];terms_deg=[[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30]];}else{var terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[4,-1],[6,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[6,-1],[2,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[5,-1],[3,-1],[4,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];terms_deg=[[6,12,20,25,30],[8,14,22,27,30],[6,12,17,24,30],[7,13,19,26,30],[6,11,18,24,30],[7,17,21,28,30],[6,14,21,28,30],[7,11,19,24,30],[12,17,21,26,30],[6,14,22,26,30],[7,13,20,25,30],[12,16,19,28,30]];}var sn1=Math.floor(rRadix[pn1]/30);var pp1=rRadix[pn1]-30*sn1;var nterm1=0;for(i1=0;i1<5;i1++){if(pp1<terms_deg[sn1][i1]){nterm1=i1;break;}}for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);var pp2=rRadix[pn2]-30*sn2;var nterm2=0;for(i1=0;i1<5;i1++){if(pp2<terms_deg[sn2][i1]){nterm2=i1;break;}}if((terms[sn1][nterm1][0]==pn2)&&(terms[sn2][nterm2][0]==pn1)&&(pn1!=pn2)){return[1,pn2];}if((terms[sn1][nterm1][1]==pn2)&&(terms[sn2][nterm2][1]==pn1)&&(pn1!=pn2)){return[1,pn2];}}return[0,0];};function tr(var_str){var subst=trans_string;for(var key in subst){replace="\\b"+key+"\\b";what=""+subst[key];re=new RegExp(replace,"gi");var_str=var_str.replace(re,what);}return var_str;};function tr_2(var_str){var subst=trans_string;for(var key in subst){replace="<span class=trn>"+key+"<\/span>";what=""+subst[key];re=new RegExp(replace,"gi");var_str=var_str.replace(re,what);}return var_str;} </script>
	

<script>dpNumeralMap={'0':'0','1':'1','2':'2','3':'3','4':'4','5':'5','6':'6','7':'7','8':'8','9':'9'}; </script>
<script class="dpAjaxScript" type="text/javascript">dpCityName="Washington, D.C.";dpPlanetPositionList={"2":[285.55555555556,33.333333333333,"Sun"],"3":[285.55555555556,6.6666666666667,"Moon"],"4":[305.55555555556,20,"Mer"],"13":[265.55555555556,20,"Rahu"],"7":[28.888888888889,202.22222222222,"Mar"],"8":[28.888888888889,46.666666666667,"Jup"],"5":[96.666666666667,33.333333333333,"Ven"],"9":[337.77777777778,44.444444444444,"Sat"],"14":[94.444444444444,217.77777777778,"Ketu"],"11":[94.444444444444,244.44444444444,"Nep"],"10":[106.66666666667,124.44444444444,"Ura"],"12":[93.333333333333,144.44444444444,"Plu"]};dpHouseNoPositionList={"2":[195.55555555556,102.22222222222,2],"3":[103.33333333333,46.666666666667,3],"4":[68.888888888889,60,4],"5":[160,124.44444444444,5],"6":[68.888888888889,188.88888888889,6],"7":[101.11111111111,204.44444444444,7],"8":[195.55555555556,146.66666666667,8],"9":[287.77777777778,202.22222222222,9],"10":[313.33333333333,191.11111111111,10],"11":[226.66666666667,124.44444444444,11],"12":[315.55555555556,57.777777777778,12],"1":[287.77777777778,46.666666666667,1]};dpZodiacPositionList={"2":[191.11111111111,35.555555555556,"Tau"],"3":[35.555555555556,4.4444444444444,"Gem"],"4":[4.4444444444444,62.222222222222,"Can"],"5":[35.555555555556,128.88888888889,"Leo"],"6":[4.4444444444444,195.55555555556,"Vir"],"7":[35.555555555556,244.44444444444,"Lib"],"8":[186.66666666667,217.77777777778,"Sco"],"9":[333.33333333333,244.44444444444,"Sag"],"10":[364.44444444444,195.55555555556,"Cap"],"11":[333.33333333333,128.88888888889,"Aqu"],"12":[364.44444444444,62.222222222222,"Pis"],"1":[342.22222222222,4.4444444444444,"Ari"]};dpCriticalPointsList=[[200,133.33333333333],[100,66.666666666667],[0,0],[300,200],[400,266.66666666667],[116.66666666667,77.777777777778],[283.33333333333,188.88888888889]];dpPlanetLabelColorList={"1":"#EB0707","2":"red","5":"green","3":"white","4":"#7B0000","7":"#BB0000","8":"#A52583","9":"#4B4B4B","10":"#007BFF","11":"#730084","12":"black","13":"black","15":"black","14":"brown","16":"brown"};dpZodiacHexColor='#540000';dpLineHexColor='#B80000';dpHouseNoColor='#540000';dpDotFillColor='#AA0000';dpWatermarkColor='#DAA520'; </script>
<script>var dpTimeSelection=true;var dpBackgroundColor='#FFC15E';var dpKundaliChartCanvas;var dpPaintContext;var dpChartWidth=0;var dpChartHeight=0;var mX1,mX2,mX3,mX4,mX5,mX6,mX7;var mY1,mY2,mY3,mY4,mY5,mY6,mY7;var dpSwastikaSize=0;var dpYPointsAdjustment=12;var dpChartWatermark="";function prepareToDrawKundaliChart(){if(typeof dpChartCanvasId=='undefined'){dpChartCanvasId='dp-kundali-chart-canvas';}dpKundaliChartCanvas=document.getElementById(dpChartCanvasId);if(dpKundaliChartCanvas&&dpKundaliChartCanvas.getContext){pageLanguage='en';fontSize='11';if('hi'===pageLanguage||'mr'===pageLanguage||'en'===pageLanguage){fontSize='13';}else if('ta'===pageLanguage||'te'===pageLanguage||'ml'===pageLanguage){fontSize='10';}dpPaintContext=dpKundaliChartCanvas.getContext('2d');dpPaintContext.font=fontSize+"px monospace";dpPaintContext.lineWidth=1;dpPaintContext.strokeStyle=dpLineHexColor;dpPaintContext.fillStyle=dpBackgroundColor;dpPaintContext.fillRect(0,0,dpKundaliChartCanvas.width,dpKundaliChartCanvas.height);dpSwastikaSize=dpKundaliChartCanvas.width/40;drawCanvasBackgroundImage();drawKundaliChart();drawDrikpanchangWatermark();}};function drawCanvasBackgroundImage(){if("undefined"!==typeof dpBackgroundImageURL){backgroundImage=new Image();backgroundImage.src=dpBackgroundImageURL;backgroundImage.onload=function(){dpPaintContext.drawImage(backgroundImage,0,0);}}};function drawKundaliChart(){dpChartType='north';setElementCoordinates();drawKundaliChartOuterRectangle();drawChartCommonCoreShape();dpPaintContext.globalAlpha=0.75;if('east'===dpChartType){drawEastKundaliChartLines();}else if('south'===dpChartType){drawSouthKundaliChartLines();}else{drawNorthKundaliChartLines();}dpPaintContext.globalAlpha=1;drawHouseNumbersOnCanvas();drawPlanetLabelsOnCanvas();drawZodiacLabelsOnCanvas();};function setElementCoordinates(){calculateElementDimension();calculateBasicDrawingCoordinates();};function calculateElementDimension(){dpChartWidth=dpKundaliChartCanvas.offsetWidth;dpChartHeight=dpKundaliChartCanvas.offsetHeight;};function calculateBasicDrawingCoordinates(){mX1=dpCriticalPointsList[0][0];mX2=dpCriticalPointsList[1][0];mX3=dpCriticalPointsList[2][0];mX4=dpCriticalPointsList[3][0];mX5=dpCriticalPointsList[4][0];mX6=dpCriticalPointsList[5][0];mX7=dpCriticalPointsList[6][0];mY1=dpCriticalPointsList[0][1];mY2=dpCriticalPointsList[1][1];mY3=dpCriticalPointsList[2][1];mY4=dpCriticalPointsList[3][1];mY5=dpCriticalPointsList[4][1];mY6=dpCriticalPointsList[5][1];mY7=dpCriticalPointsList[6][1];};function drawKundaliChartOuterRectangle(){dpPaintContext.moveTo(mX3,mY3);dpPaintContext.lineTo(mX5,mY3);dpPaintContext.lineTo(mX5,mY5);dpPaintContext.lineTo(mX3,mY5);dpPaintContext.lineTo(mX3,mY3);dpPaintContext.stroke();};function drawChartCommonCoreShape(){return;halfSwastikaSize=dpSwastikaSize/2;dpPaintContext.beginPath();dpPaintContext.moveTo(mX1-dpSwastikaSize,mY1-dpSwastikaSize);dpPaintContext.lineTo(mX1-dpSwastikaSize,mY1);dpPaintContext.lineTo(mX1+dpSwastikaSize,mY1);dpPaintContext.lineTo(mX1+dpSwastikaSize,mY1+dpSwastikaSize);dpPaintContext.moveTo(mX1-dpSwastikaSize,mY1+dpSwastikaSize);dpPaintContext.lineTo(mX1,mY1+dpSwastikaSize);dpPaintContext.lineTo(mX1,mY1-dpSwastikaSize);dpPaintContext.lineTo(mX1+dpSwastikaSize,mY1-dpSwastikaSize);dpPaintContext.fillStyle=dpDotFillColor;dpPaintContext.fillRect(mX1-halfSwastikaSize,mY1-halfSwastikaSize,1,1);dpPaintContext.fillRect(mX1+halfSwastikaSize,mY1-halfSwastikaSize,1,1);dpPaintContext.fillRect(mX1-halfSwastikaSize,mY1+halfSwastikaSize,1,1);dpPaintContext.fillRect(mX1+halfSwastikaSize,mY1+halfSwastikaSize,1,1);};function drawNorthKundaliChartLines(){dpSwastikaSize=0;dpPaintContext.moveTo(mX1-dpSwastikaSize,mY1-dpSwastikaSize);dpPaintContext.lineTo(mX3,mY3);dpPaintContext.moveTo(mX1+dpSwastikaSize,mY1-dpSwastikaSize);dpPaintContext.lineTo(mX5,mY3);dpPaintContext.moveTo(mX1-dpSwastikaSize,mY1+dpSwastikaSize);dpPaintContext.lineTo(mX3,mY5);dpPaintContext.moveTo(mX1+dpSwastikaSize,mY1+dpSwastikaSize);dpPaintContext.lineTo(mX5,mY5);dpPaintContext.moveTo(mX1,mY3);curvePoint=dpChartWidth/7;adjustedCurvePoint=1.3*curvePoint;dpPaintContext.lineTo(mX5,mY1);dpPaintContext.lineTo(mX1,mY5);dpPaintContext.lineTo(mX3,mY1);dpPaintContext.lineTo(mX1,mY3);dpPaintContext.stroke();};function drawSouthKundaliChartLines(){dpPaintContext.moveTo(mX2,mY3);dpPaintContext.lineTo(mX2,mY5);dpPaintContext.moveTo(mX4,mY5);dpPaintContext.lineTo(mX4,mY3);dpPaintContext.moveTo(mX3,mY2);dpPaintContext.lineTo(mX5,mY2);dpPaintContext.moveTo(mX5,mY4);dpPaintContext.lineTo(mX3,mY4);dpPaintContext.moveTo(mX1,mY3);dpPaintContext.lineTo(mX1,mY2);dpPaintContext.moveTo(mX1,mY4);dpPaintContext.lineTo(mX1,mY5);dpPaintContext.moveTo(mX3,mY1);dpPaintContext.lineTo(mX2,mY1);dpPaintContext.moveTo(mX4,mY1);dpPaintContext.lineTo(mX5,mY1);dpPaintContext.stroke();};function drawEastKundaliChartLines(){dpPaintContext.moveTo(mX3,mY6);dpPaintContext.lineTo(mX5,mY6);dpPaintContext.moveTo(mX3,mY7);dpPaintContext.lineTo(mX5,mY7);dpPaintContext.moveTo(mX6,mY3);dpPaintContext.lineTo(mX6,mY5);dpPaintContext.moveTo(mX7,mY3);dpPaintContext.lineTo(mX7,mY5);dpPaintContext.moveTo(mX3,mY3);dpPaintContext.lineTo(mX6,mY6);dpPaintContext.moveTo(mX5,mY3);dpPaintContext.lineTo(mX7,mY6);dpPaintContext.moveTo(mX5,mY5);dpPaintContext.lineTo(mX7,mY7);dpPaintContext.moveTo(mX3,mY5);dpPaintContext.lineTo(mX6,mY7);dpPaintContext.stroke();};function drawHouseNumbersOnCanvas(){dpPaintContext.fillStyle=dpHouseNoColor;for(index in dpHouseNoPositionList){if(dpHouseNoPositionList.hasOwnProperty(index)){houseData=dpHouseNoPositionList[index];positionX=houseData[0];positionY=houseData[1]+dpYPointsAdjustment;houseNumber=houseData[2];dpPaintContext.fillText(houseNumber,positionX,positionY);}}};function drawPlanetLabelsOnCanvas(){for(index in dpPlanetPositionList){if(dpPlanetPositionList.hasOwnProperty(index)){planetData=dpPlanetPositionList[index];positionX=planetData[0];positionY=planetData[1]+dpYPointsAdjustment;planetName=planetData[2];dpPaintContext.fillStyle=dpPlanetLabelColorList[index.toString()];dpPaintContext.fillText(planetName,positionX,positionY);}}};function drawZodiacLabelsOnCanvas(){dpPaintContext.font="12px monospace";dpPaintContext.fillStyle=dpZodiacHexColor;dpPaintContext.globalAlpha=0.5;for(index in dpZodiacPositionList){if(dpZodiacPositionList.hasOwnProperty(index)){zodiacData=dpZodiacPositionList[index];positionX=zodiacData[0];positionY=zodiacData[1]+dpYPointsAdjustment;zodiacName=zodiacData[2];dpPaintContext.fillText(zodiacName,positionX,positionY);}}dpPaintContext.font="14px monospace";dpPaintContext.globalAlpha=1;};function drawDrikpanchangWatermark(){dpPaintContext.save();dpPaintContext.font="13px monospace";dpPaintContext.fillStyle=dpWatermarkColor;dpPaintContext.fillText(dpChartWatermark,mX1-30,mY4-30);dpPaintContext.restore();};$jq(document).ready(function(){}); </script>	
	
	
	
	
	

	
	
	
	
	
	
	
	