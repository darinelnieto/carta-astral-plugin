<?php

    if(isset($_POST["data_pos"])){
    $longitude1 = $_POST["data_pos"];
    } else {
  	$longitude1 = "";
    }
    if(isset($_POST["data_pos_h"])){
    $house_pos1 = $_POST["data_pos_h"];
    } else {
  	$house_pos1 = "";
    }
    if(isset($_POST["ubt"])){
    $ubt1 = $_POST["ubt"];
    } else {
  	$ubt1 = "";
    }
    if(isset($_POST["dig_score"])){
    $dig_score = $_POST["dig_score"];
    } else {
  	$dig_score = "";
    } 
	if(isset($_POST["show_custom_img"])){
    $show_custom_img = $_POST["show_custom_img"];
    } else {
  	$show_custom_img = 1;
    } 

    if(isset($_POST["show_outer"])){
    $show_outer = $_POST["show_outer"];
    } else {
  	$show_outer = "0";
    }

    //Chiron: defaul = 0 (see)
    if(isset($_POST["show_chiron"])){
    $show_chiron = $_POST["show_chiron"];
    } else {
  	$show_chiron = "1";
    }

    if(isset($_POST["doc_root"])){
    $doc_root = $_POST["doc_root"];
    } else {
  	$doc_root = "";
    }

    /* ay_default */
    if(isset($_POST["ay_default"])){
    $ay_default = $_POST["ay_default"];
    } else {
  	$ay_default = 0; /* tropical zodiac */
    }


    /* Show short report 
     * 1 - no
     * 2 - only sun
     * 3 - only ascendant
     * 4 - both
     * */
     $show_short_description = 0;
     if(isset($_POST["show_short"])){
       $show_short_description = $_POST["show_short"];
     } else {
   	   $show_short_description = 0;
     }

    $show_nakshatra_report_sys = 3;
    //show_nakshatra_report_sys
    if(isset($_POST["show_nakshatra_report_sys"])){
      $show_nakshatra_report_sys = $_POST["show_nakshatra_report_sys"];
    } else {
  	  $show_nakshatra_report_sys = 3; /* show option 3 */
    }

    //$show_short_description = 0;
/* show_short    
$show_short_description = 0; //(isset($_POST["show_short_description"]) ? $_POST["show_short_description"] : 0; */

    /* $show_short_description
    if(isset($_POST["ay_default"])){
    $ay_default = $_POST["ay_default"];
    } else {
  	$ay_default = 0;
    }*/





	if(isset($_POST["custom_img_size"])){
    $custom_img_size = $_POST["custom_img_size"]."px";
    } else {
  	$custom_img_size = "300px";
    }
      $max_score = max($dig_score);
      reset($dig_score);   
      arsort($dig_score);
      $key_of_max = key($dig_score);
      $keys = array_keys($dig_score);
      $max_dig = $key_of_max;
      $x = 0;
      $dig_planets = "";
      while($keys[$x] == $max_dig) {
		  $dig_planets .= "$keys[$x]";
		  $x++;
	  }
      if($show_custom_img < 3 or $max_score == 999){ 
		  $dig_planets = "";
	  }
      if($show_custom_img > 3){ 
		  $dig_planets = "0123456789";
	  }

     
        $styletd1 = "style='text-align: justify;' class='w3-border-0 w3-white'";
        $font_red = "<font style='color: #ff0000;font-size: 13px;font-family: Merriweather;'>";
	    $font_black = "<font style='color: #000000;font-size: 13px;font-family: Merriweather;'>";
	    $font_black_small = "<font style='color: #000000;font-size: 11px;font-family: Merriweather;'>";
	    $font_pink = "<font style='color: #ff00ff;font-size: 13px;font-family: Merriweather;'>";
	    $font_blue = "<font style='color: #0099ff;font-size: 13px;font-family: Merriweather;'>";
      
      $LAST_PLANET = 12;
      $SE_POF = 12;
      $SE_VERTEX = -1; 
      $signs_db = array("Aries","Taurus","Gemini","Cancer","Leo","Virgo","Libra","Scorpio","Sagittarius","Capricorn","Aquarius","Piscis");
      //$signs_db = array("Aries","Taurus","Gemini","Cancer","Leo","Virgo","Libra","Scorpio","Sagittarius","Capricorn","Aquarius","Pisces");
      $planets_db = array("Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto","Lilith","Ascending Node","Pars Fort.","Ascendant","Midheaven","Chiron");
      $aspects_db = array("Harmony","Disharmony","Conjunction","Sextil","Quadrature","Trine","Opposition");
      $texts_db = array("Title","Introduction","Footnote");
      $houses_db = array("House I","House II","House III","House IV","House V","House VI","House VII","House VIII","House IX","House X","House XI","House XII");
$nakshatras_db = array("Ashwini","Bharani","Krittika","Rohini","Mrigshirsha","Ardra","Punarvasu","Pushya","Ashlesha","Magha","Purvaphalguni","Uttaraphalguni","Hasta","Chitra","Swati","Vishakha","Anuradha","Jyeshtha","Mula","Purvashadha","Uttarashadha","Shravana","Dhanishtha","Shatbhisha","Poorvabhadrapada","Uttarabhadrapada","Revati","Abhijit");
    
    
      $font_red = "<font style='color: #ff0000;font-size: 13px;font-family: Merriweather;'>";
	  $font_black = "<font style='color: #000000;font-size: 13px;font-family: Merriweather;'>";
	  $font_black_small = "<font style='color: #000000;font-size: 11px;font-family: Merriweather;'>";
	  $font_pink = "<font style='color: #ff00ff;font-size: 13px;font-family: Merriweather;'>";
	  $font_blue = "<font style='color: #0099ff;font-size: 15px;font-family: Merriweather;'>";
	  $font_blue_small = "<font style='color: #0099ff;font-size: 13px;font-family: Merriweather;'>";
      $html = "";
      $html .= '<table class="w3-table w3-border-0" cellpadding="0" cellspacing="0" border="0" style="border: 1px solid white;width: 100%;">';
      $html .= "<tr><td $styletd1><font size='3'>";
      
      $file = "dbase/users/general.txt";
      $exists = CheckFile($file);
      
      $string = FindInterpretation("Introduction|", 2, $file);
      if($string != "NONE"){
      
      $html .= "<center>$font_blue<b><span class=trn>INTRODUCTION</span></b></font></center>";
      //$philo = nl2br($string);
      $philo = "<i>".$philo."</i>";
      $html .= $font_black.$philo."</font><br>";
      }
      
      
      $ubt1 = 0;
      if ($ubt1 == 0)
      {
     	$file = "dbase/users/general.txt";
     	$exists = CheckFile($file);     	
        $string = FindInterpretation("Ascendant Introduction|", 2, $file);
        $philo = "";
        if($string != "NONE"){
        //$philo = nl2br($string);
        $philo = "<i>".$philo."</i>";
        }
        
        /* Ascendant sign */
		$s_pos = floor($house_pos1[0] / 30);
        $phrase_to_look_for = "Ascendant|".strtoupper($signs_db[$s_pos])."|";
        $file = "dbase/users/signs.txt";
        $exists = CheckFile($file);
		
		//$doc_root = getcurrentpath();
		//$doc_root = "";
		$s = $s_pos + 1;
		$sfile = "S" . $s . ".png";
		$image_file = $doc_root . "uploads/" . $sfile;
		//$image_file = "uploads/" . $sfile;
		if(file_exists("uploads/$sfile") and ($show_custom_img > 1)){
			$img_text = "<br><center><img src=\"$image_file\" width='$custom_img_size'></center><br>";
		} else {
			$img_text = "";
		}
        
        $string = FindInterpretation($phrase_to_look_for, 3, $file);
        
        if($string != "NONE"){
        $html .= "<center>$font_blue<b><span class=trn>THE RISING SIGN OR ASCENDANT</span></b></font></center>";
        $html .= $font_black.$philo."</font>"."<br>$font_blue_small"."<span class=trn>YOUR ASCENDANT IS</span><span class=trn> <span class=trn>".$signs_db[$s_pos]."</span></b></font><br>$img_text<br>";
        //$string = nl2br($string);
        $html .= "$font_black".$string . "</font>";
        }
		/* END Ascendant sign */  
        
        
      }
      
        /* NAKSHATRA sign */
        if($show_nakshatra_report_sys > 1){
        $sec_nak = 360/27;
		$moon_pos = floor(($longitude1[1] + $ay_default) / $sec_nak); //24 = Lahiri default
        $moon_pos = ($moon_pos < 0) ? ($moon_pos + 360) : $moon_pos;
        $phrase_to_look_for = "Moon|".$nakshatras_db[$moon_pos]."|";
        /* $html .= "<font face=Verdana size=2>".$phrase_to_look_for." ".$longitude1[1]." ".$ay_default."</font><br>"; */
        $file = "dbase/users/nakshatras.txt";
        $exists = CheckFile($file);
		/* $s = $moon_pos + 1;
		$sfile = "S" . $s . ".png";
		$image_file = $doc_root . "uploads/" . $sfile;
		if(file_exists("uploads/$sfile") and ($show_custom_img > 1)){
			$img_text = "<br><center><img src=\"$image_file\" width='$custom_img_size'></center><br>";
		} else {
			$img_text = "";
		} */
        $img_text = "";
        $string = FindInterpretation($phrase_to_look_for, 3, $file);
        if($string != "NONE"){
        $html .= "<center>$font_blue<b><span class=trn><br>THE MOON'S NAKSHATRA</span></b></font></center>";
        $html .= $font_black.$philo."</font>"."<br>$font_blue_small"."<span class=trn>YOUR MOON'S NAKSHATRA IS</span><span class=trn> <span class=trn>".$nakshatras_db[$moon_pos]."</span></b></font><br>$img_text<br>";
        $html .= "$font_black".$string . "</font>";
        }
		}
		/* END NAKSHATRA sign */






        /* SHORT Description Ascendant sign */
        $html_short = "";
        if($show_short_description > 1){
        //$html_short = "<br><div style='align: left;width:400px;'>";
			
        $html_short = "<style>
div.shortReportTable {
  font-family: Merriweather;
  background-color: #FFFFFF;
  width: 400px;
  text-align: center;
  border-collapse: collapse;
}
.divTable.shortReportTable .divTableCell, .divTable.shortReportTable .divTableHead {
  border: 0px solid #AAAAAA;
  padding: 3px 2px;
  vertical-align: middle;
}
.divTable.shortReportTable .divTableBody .divTableCell {
  font-size: 13px;
}
.shortReportTable .tableFootStyle {
  font-size: 14px;
}
.shortReportTable .tableFootStyle .links {
	 text-align: right;
}
.shortReportTable .tableFootStyle .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.shortReportTable.outerTableFooter {
  border-top: none;
}
.shortReportTable.outerTableFooter .tableFootStyle {
  padding: 3px 5px; 
}
/* DivTable.com */
.divTable{ display: table; }
.divTableRow { display: table-row; }
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}
</style>
<span style='text-align: center;width: 100%;'><h3><span class=trn>Short Introduction</span></h3></span>
<div class='divTable shortReportTable'>";
	
		$asc_pos = floor($house_pos1[0] / 30);		
		if($longitude1[0] < 0){$longitude1[0] += 360.0;}
		$sun_pos = floor($longitude1[0]/30);
		
        $phrase_to_look_for = "Ascendant|".strtoupper($signs_db[$asc_pos])."|";
		$phrase_to_look_for_2 = "Sun|".strtoupper($signs_db[$sun_pos])."|";
        $file = "dbase/users/signs_short.txt";
        $exists = CheckFile($file);
		
		$s = $asc_pos + 1;
		$sfile = $asc_pos . ".png";
		$s_2 = $sun_pos + 1;
		$sfile_2 = $sun_pos . ".png";
		$image_file = $doc_root . "images/" . $sfile;
		$image_file_2 = $doc_root . "images/" . $sfile_2;			
			
		$image_file = $doc_root . "images/ascendant-thumbnail.jpg";
		$image_file_2 = $doc_root . "images/sun-thumbnail.jpg";
			
		if(file_exists("images/$sfile")){
		//$sfile = "S" . $s . ".png";
        $img_text = "<img style='float: left;margin: 2px;' src=\"$image_file\" width='70px'>";
		//$sfile = "S" . $s . ".png";
		$img_text_2 = "<img style='float: left;margin: 2px;' src=\"$image_file_2\" width='70px'>";
		} else {
			$img_text = "";
			$img_text_2 = "";
		}
        $string = FindInterpretation($phrase_to_look_for, 3, $file);
		$string_2 = FindInterpretation($phrase_to_look_for_2, 3, $file);
        
	    if($string != "NONE" && $show_short_description > 2){
        //$html_short .= $img_text."<p>";
        //$html_short .= $font_black . $string . "</font></p><br><br>";
        $html_short .= "<div class='divTableRow'><div class='divTableCell' style='width: 80px;'>".$img_text."</div><div class='divTableCell' style='text-align: left;'>".$string."</div></div>";
        }
        if($string_2 != "NONE" && ($show_short_description == 2 || $show_short_description == 4)){
        //$html_short .= $img_text_2."<p>";
        //$html_short .= "$font_black" . $string_2 . "</font></p><br><br>";
		$html_short .= "<div class='divTableRow'><div class='divTableCell' style='width: 80px;'>".$img_text_2."</div><div class='divTableCell' style='text-align: left;'>".$string_2."</div></div>";
        }
		$html_short .= "</div>";
		} else {
	      $html_short = "<br>";
        }

        



      $file = "dbase/users/general.txt";
      
      $exists = CheckFile($file);
      $sign_interp = "";
      $string = FindInterpretation("Signs Introduction|", 2, $file);      
      if($string != "NONE"){
      //$string = nl2br($string);
      $string = "<i>".$string."</i>";
      $sign_interp = $font_black.$string."</font><br>";
      }
      $sign_interp .= $font_black;




      //$LAST_PLANET = 12; Pars. Fort. a seguir vem asc. o mc e chiron    
      //To include Chiron, but not asc. and MC
      if($show_chiron < 1){$LAST_PLANET = 15;}
      for ($i = 0; $i <= $LAST_PLANET; $i++)			
      {
		if($show_outer > 0 && $i > 6 && $i < 10){goto cont_1;} 
		  
		//Don't show asc. and MC
		if($i > 11 && $i < 15){goto cont_1;}
		//Chiron
		if($i == 15 && $show_chiron != 0){goto cont_1;}
		  
		if($longitude1[$i] < 0){$longitude1[$i] += 360.0;}  
		  
        $s_pos = floor($longitude1[$i] / 30)+1;
        $deg = Reduce_below_30($longitude1[$i]);
        if ($ubt1 == 1 And $i == 1 And ($deg < 7.7 Or $deg > 22.3))
        {
          
        }
        
        $s_pos_t = $s_pos-1;
        $phrase_to_look_for = $planets_db[$i]."|".strtoupper($signs_db[$s_pos_t])."|"; 
        $file = "dbase/users/signs.txt";
        
        $exists = CheckFile($file);
		$ival = $i + 1;  
		$sfile = "P$ival" . ".png";
		$image_file = $doc_root . "uploads/" . $sfile;
		if(file_exists("uploads/$sfile") and strstr($dig_planets, "$i")){
			$img_text = "<br><center><img src=\"$image_file\" width='$custom_img_size'></center><br>";
		} else {
			$img_text = "";
		}
        
        $string = FindInterpretation($phrase_to_look_for, 3, $file);
        if($string != "NONE"){
        //$string = nl2br($string);
		
        $sign_interp .= "<b><span class=trn>".$planets_db[$i]."</span> <span class=trn>".$signs_db[$s_pos_t]."</span></b><br>$img_text".$string."<br>";
        }
        cont_1:
      }
      if(strlen($sign_interp) > strlen($font_black)){
          $html .= "<br><br><center>$font_blue<b><span class=trn>SIGN POSITIONS OF PLANETS</span></b></font></center>";
		  $html .= "<font size=2>" . $sign_interp . "</font>";
	  }
      
      $out_html = "";
      $ubt1 = 0;
      if ($ubt1 == 0)
      {    
        
        $file = "dbase/users/general.txt";
        $exists = CheckFile($file);
        $house_interp = "";
        $string = FindInterpretation("Houses Introduction|", 2, $file);      
        if($string != "NONE"){
        //$string = nl2br($string);
        $string = "<i>".$string."</i>";
        $house_interp = $font_black.$string."</font><br>";
        }
        
        $house_interp .= $font_black;
 
        
        for ($i = 0; $i <= $LAST_PLANET; $i++)				
        {
          if($show_outer > 0 && $i > 6 && $i < 10){goto cont_2;} 
			
		  //Don't show asc. and MC
		  if($i > 11 && $i < 15){goto cont_2;}
		  //Chiron
		  if($i == 15 && $show_chiron != 0){goto cont_2;}
          
          $s_pos_t = house_pos($longitude1[$i],$house_pos1);
          $phrase_to_look_for = $planets_db[$i]."|".$houses_db[$s_pos_t]."|"; 
          $file = "dbase/users/houses.txt";          
          $exists = CheckFile($file);
          
          $string = FindInterpretation($phrase_to_look_for, 3, $file);
          
 
          if($string != "NONE"){
          //$string = nl2br($string);
          $house_interp .= $font_black."<b><span class=trn>".$planets_db[$i]."</span> <span class=trn>".$houses_db[$s_pos_t]."</span></b></font><br>".$string."<br>";
          }
     
		  cont_2:	
        }
        
        
		  if(strlen($house_interp) > strlen($font_black)){
		    $html .= "<br><center>$font_blue<b><span class=trn>HOUSE POSITIONS OF PLANETS</span></b></font></center>";
		    $html .= $font_black.$house_interp."</font>";
		  }
        
      }
      
      //Reset to 12 bodies ---------
      $LAST_PLANET = 12;
      
      $out_html = "";
      
        
        $file = "dbase/users/general.txt";
        
        $exists = CheckFile($file);
        
        $string = FindInterpretation("Aspects Introduction|", 2, $file);      
        if($string != "NONE"){
        //$string = nl2br($string);
        $string = "<i>".$string."</i>";
        $p_aspect_interp = $string;
        $out_html .= $font_black.$p_aspect_interp."</font><br>";
        }

      //"Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto","Lilith","Ascending Node","Pars Fort.","Ascendant","Midheaven","Chiron"
      //$LAST_PLANET = 14;      
      for ($i = 0; $i <= $LAST_PLANET + 1; $i++)			
      {
		if($show_outer > 0 && $i > 6 && $i < 10){goto cont_3;} 
		  
		//Don't show MC
		//if($i == 14){goto cont_3;}
		//Chiron
		//if($i == 15 && $show_chiron != 0){goto cont_3;}
		  
        //for ($j = $i + 1; $j <= $LAST_PLANET + 2; $j++)			
        for ($j = $i + 1; $j <= 15; $j++) //adicionar Chiron			
        {
			
		  if($show_outer > 0 && $j > 6 && $j < 10){goto cont_4;}
			
		  //Don't show asc. and MC
		  if($j > 12 && $j < 15){goto cont_4;}
		  //Chiron
		  if($j == 15 && $show_chiron != 0){goto cont_4;}	
			
			
          if (($i == 1 Or $i == $SE_POF Or $i == $SE_VERTEX Or $i == $LAST_PLANET + 1 Or $i == $LAST_PLANET + 2 Or $j == 1 Or $j == $SE_POF Or $j == $SE_VERTEX Or $j == $LAST_PLANET + 1 Or $j == $LAST_PLANET + 2) And $ubt1 == 1)
          {
            continue;			
          }
          $da = Abs($longitude1[$i] - $longitude1[$j]);
          if ($da > 180)
          {
            $da = 360 - $da;
          }
          
          if ($i == 0 Or $i == 1 Or $j == 0 Or $j == 1)
          {
            $orb = 8;
          }
          else
          {
            $orb = 6;
          }
          
          $q = 1;
          if ($da <= $orb)
          {
            $q = 2; 
          }
          elseif (($da <= 60 + $orb) And ($da >= 60 - $orb))
          {
            $q = 3; 
          }
          elseif (($da <= 90 + $orb) And ($da >= 90 - $orb))
          {
            $q = 4; 
          }
          elseif (($da <= 120 + $orb) And ($da >= 120 - $orb))
          {
            $q = 5; 
          }
          elseif ($da >= 180 - $orb)
          {
            $q = 6; 
          }
          if ($q > 1)
          {
            if ($q == 2)
            {
              $aspect = " blending with ";
            }
            elseif ($q == 3 Or $q == 5)
            {
              $aspect = " harmonizing with ";
            }
            elseif ($q == 4 Or $q == 6)
            {
              $aspect = " discordant to ";
            }
            
            $aspects_db = array("","","conjunction","sextil","quadrature","trine","opposition");
            
           
          
          $phrase_to_look_for = $planets_db[$i]." - ".$planets_db[$j]."|".$aspects_db[$q]."|"; 
          
          $file = "dbase/users/aspects.txt";
          
          $exists = CheckFile($file);
          
          $string = FindInterpretation($phrase_to_look_for, 3, $file);
          
          
        
          if($string != "NONE"){
          //$string = nl2br($string);
          $out_html .= $font_black."<b><span class=trn>".$planets_db[$i]."</span> <span class=trn>".$aspects_db[$q]."</span> <span class=trn>".$planets_db[$j]."</span></b><br>".$string."</font>"."<br>";
          }
   
          }
			
		  cont_4:
        }
		  
		cont_3:  
		  
      }
      
      if(strlen($out_html)){
		  $html .= "<br><center>$font_blue<b><span class=trn>PLANETARY ASPECTS</span></b></font></center>";
		  $html .= $out_html;
	  }
      
      
      
        
        $file = "dbase/users/general.txt";
        $exists = CheckFile($file);
        $closing = "";
        $string = FindInterpretation("Conclusion|", 2, $file);      
        if($string != "NONE"){
        $html .= "<br><center>".$font_blue."<b><span class=trn>CLOSING COMMENTS</span></b></font></center>";
        //$string = nl2br($string);
        $string = "<i>".$string."</i>";
        $closing = $font_black.$string."</font><br>";     }
      
      
      $html .= $closing;
      $html .= '</font></td></tr>';
      $html .= '</table>';
      $html .= "<br /><br />";
      
      echo json_encode(array(
        'html' => $html, 'html_short' => $html_short
      ));
      exit();

Function CheckFile($filename){
	if(!file_exists($filename)){
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fclose($myfile);
    return false;
  } else {
  	return true;
  }
}
Function center($str){
return "<center>$str</center>";
}
Function left($leftstring, $leftlength)
{
  return(substr($leftstring, 0, $leftlength));
}
Function rulership($planet_n,$sign_n){
$str = "";
for($i1=0;$i1 <=3;$i1++){
if($rulers[$planet_n][$i1][0] === $sign_n Or $rulers[$planet_n][$i1][1] === $sign_n){
$str = "crap";
}
}
return $str;
}
Function Reduce_below_30($longitude)
{
  $lng = $longitude;
  while ($lng >= 30)
  {
    $lng = $lng - 30;
  }
  return $lng;
}
Function Convert_Longitude($longitude)
{
  $signs = array (0 => 'ARI', 'TAU', 'GEM', 'CAN', 'LEO' , 'VIR', 'LIB', 'SCO', 'SAG', 'CAP', 'AQU', 'PIS');
  $longitude = fix360($longitude);
  $sign_num = floor($longitude / 30);
  $pos_in_sign = $longitude - ($sign_num * 30);
  $deg = floor($pos_in_sign);
  $full_min = ($pos_in_sign - $deg) * 60;
  $min = floor($full_min);
  $full_sec = round(($full_min - $min) * 60);
  if ($deg < 10)
  {
    $deg = "0" . $deg;
  }
  if ($min < 10)
  {
    $min = "0" . $min;
  }
  if ($full_sec < 10)
  {
    $full_sec = "0" . $full_sec;
  }
  return $deg . "&deg; " . $min . "' " . $full_sec . chr(34) . " <b>" . $signs[$sign_num] . "</b> " . $sign_letter;
}
Function fix360($v)
{
	if($v < 0.0){$v += 360;}
	if($v > 360){$v -= 360;}
	return $v;
}
Function mid($midstring, $midstart, $midlength)
{
  return(substr($midstring, $midstart-1, $midlength));
}
Function mod360($val){
if($val >= 360){
return ($val - floor($val/360.0)*360.0);
}
if($val < 0){
$val = $val + floor(abs($val/360.0)+1)*360;
return $val;
}
return $val;
}
Function safeEscapeString($string)
{
  $temp1 = str_replace("<", "[", $string);
  $temp2 = str_replace(">", "]", $temp1);
  $temp1 = str_replace("[br]", "<br />", $temp2);
  $temp2 = str_replace("[br /]", "<br />", $temp1);

  return $temp2;
}
Function Find_Specific_Report_Paragraph($phrase_to_look_for, $file)
{
  $string = "";
  $len = strlen($phrase_to_look_for);
  
  $file_array = file($file);
  
  for($i = 0; $i < count($file_array); $i++)
  {
    if (left(trim($file_array[$i]), $len) == $phrase_to_look_for)
    {
      $flag = 0;
      while (trim($file_array[$i]) != "*")
      {
        if ($flag == 0)
        {
          $string .= "<b>" . $file_array[$i] . "</b>";
        }
        else
        {
          $string .= $file_array[$i];
        }
        $flag = 1;
        $i++;
      }
      break;
    }
  }
  return $string;
}
Function FindInterpretation($phrase_to_look_for, $index, $file)
{
  $string = "NONE";
  $len = strlen($phrase_to_look_for);
	
  $allow = "N";
  
  $file_array = file($file);
  
  if(count($file_array) < 1){
  	return "NONE";
  }
  for($i = 0; $i < count($file_array); $i++)
  {
    if (left(trim($file_array[$i]), $len) == $phrase_to_look_for)
    {
      
          $string = $file_array[$i];
          $data = explode('|',$string);
          $string = $data[$index];
          $allow = $data[$index-1];
          break;
    }
    
  }
  
  if($allow != "N"){
  return $string;
  } else {
	return "NONE";
  }
}
function sign($n) {
    return ($n > 0) - ($n < 0);
}
function house_pos($long,$houses){
	
      /*$houses = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	  for($ii=0;$ii<12;$ii++){$houses[$ii+1]=$housesA[$ii];}*/
	
      for ($x = 1; $x <= 12; $x++)
      {
          $pl = $long + (1 / 36000);
          if ($x < 12 And $houses[$x-1] > $houses[$x])
          {
            If (($pl >= $houses[$x-1] And $pl < 360) Or ($pl < $houses[$x] And $pl >= 0))
            {
              $h = $x;
              continue;
            }
          }
          if ($x == 12 And ($houses[$x-1] > $houses[0]))
          {
            if (($pl >= $houses[$x-1] And $pl < 360) Or ($pl < $houses[0] And $pl >= 0))
            {
              $h = $x;
            }
            continue;
          }
          if (($x < 12) and ($pl >= $houses[$x-1]) and ($pl < $houses[$x]))
          {
            $h = $x;
            continue;
          }
          if (($pl >= $houses[$x-1]) And ($pl < $houses[0]) And ($x == 12))
          {
            $h = $x;
          }
      }
	
	  return ($h-1);
}
/* function getcurrentpath(){ 
$curPageURL = "";
if ($_SERVER["HTTPS"] != "on")
$curPageURL .= "http://";
else
$curPageURL .= "https://";

if ($_SERVER["SERVER_PORT"] == "80")
$curPageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
else
$curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
$count = strlen(basename($curPageURL));
$path = substr($curPageURL,0, -$count);
return $path ;
}*/

?>