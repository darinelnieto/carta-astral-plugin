<?php
/* error_reporting(1);
error_reporting(E_ALL); */

/* Translation */
$translate_json = function_exists( 'tetrabyblos_get_translation_json' ) ? tetrabyblos_get_translation_json() : array();
$translate_main = json_encode( $translate_json );
/* END */

define('_language','en');
//$url = plugins_url('Tetrabyblos') . "/";
$url = plugin_dir_path( __FILE__ ) . "/";
include($url.'lib/words.inc');
function showDeclination($d){
  $P=abs($d);
  $iS=floor($P/30);
  $P=$P-($iS*30);
  $fP=sprintf('%01.2f',DecToMin($P));
  if($d<0){
    $fP=str_replace('.','S',$fP);
  }else{
    $fP=str_replace('.','N',$fP);
  }
  return $fP;
}
function showLongitude($l){
  global $aSignGlyph;
  $P=abs($l);
  $iS=floor($P/30);
  $P=$P-($iS*30);
  $fP=sprintf('%01.2f',DecToMin($P));
  $fP=str_replace('.',$aSignGlyph[$iS],$fP);
  return $fP;
}
Function left($leftstring, $leftlength)
{
  return(substr($leftstring, 0, $leftlength));
}
Function FindText($phrase_to_look_for, $index, $file){
  $string = "NONE";
  $len = strlen($phrase_to_look_for);
  //$file = plugins_url('Tetrabyblos')."/".$file;
  //$file = plugin_dir_path( __FILE__ ) . "/" . $file;
  $file = plugin_dir_path( __FILE__ ) . $file;
  
  if(!file_exists($file)){
  	return "NONE";
  	}
  
  $file_array = file($file);
  if(count($file_array) < 1){
  	return "NONE";
  }
  for($i = 0; $i < count($file_array); $i++){
    if (left(trim($file_array[$i]), $len) == $phrase_to_look_for){
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
function safe_mktime($hour,$minute,$second,$month,$date,$year){
  if($year<1970){
    if($year>1951){
      $year+=28; 
    }else{
      $year+=84; 
    }
  }
  return mktime($hour,$minute,$second,$month,$date,$year);
}
function FormatHour($m) {
   $zhours = floor($m[1]/100);
   $zminutes = $m[1]-$zhours*100;
   $american = $zhours . ":" . $zminutes . $m[2];
   $zhours = ($m[2] == "AM") ? $zhours : ($zhours + 12);
   if($zminutes < 10){$zminutes = "0".$zminutes;}
   $t = $zhours."h".$zminutes."m";   
   return "$american ($t)";
   }
function MOD2PI($Degrees){
  return $Degrees-(floor($Degrees/(M_PI+M_PI))*(M_PI+M_PI));
  
}
function MOD360($Degrees){
  return $Degrees-(floor($Degrees/360)*360);
  
}
function PolarToRect($PolarAngle,$DistanceVector){
  if($PolarAngle==0){
    $PolarAngle=0.0000000017;
  }
  $Xaxis=$DistanceVector*cos($PolarAngle);
  $Yaxis=$DistanceVector*sin($PolarAngle);
  return array($Xaxis,$Yaxis);
}
function RectToPolar($Xaxis,$Yaxis){
  if($Yaxis==0){
    $Yaxis=0.0000000017;
  }
  $DistanceVector=sqrt(($Xaxis*$Xaxis)+($Yaxis*$Yaxis));
  $PolarAngle=atan($Yaxis/$Xaxis);
  if($PolarAngle<0){
    $PolarAngle=$PolarAngle+M_PI;
  }
  if($Yaxis<0){
    $PolarAngle=$PolarAngle+M_PI;
  }
  return array($PolarAngle,$DistanceVector);
}
function Sgn($number){
  return ($number<0)?-1:1;
}
function MinToDec($min){
  return (Sgn($min)*(floor(abs($min))+(abs($min)-floor(abs($min)))*10/6));
}
function DecToMin($dec){
  $dec=round($dec,2);
  return (Sgn($dec)*(floor(abs($dec))+(abs($dec)-floor(abs($dec)))*0.6));
}
function SecToDeg($Sec){
  return (floor((Sgn($Sec)*((abs($Sec)-floor(abs($Sec)))*0.6+floor(abs($Sec))))*100+0.5)/100);
}
function RectToSpher($HarmonicX,$HarmonicY,$HarmonicZ,$Aberration,$NU,$iPlanet){
  list($PolarAngle,$DistanceVector)=RectToPolar($HarmonicX,$HarmonicY);
  $V=rad2deg($PolarAngle)+$NU-$Aberration;
  if($iPlanet==1){
    $V=$V+180;
  }
  $SemiMajorAxis=MOD360($V);
  list($PolarAngle,$DistanceVector)=RectToPolar($DistanceVector,$HarmonicZ);
  if($PolarAngle>0.35){
    $PolarAngle=$PolarAngle-(M_PI+M_PI);
  }
  return array($SemiMajorAxis,SecToDeg(rad2deg($PolarAngle)));
}
function TopoLat($GeoLatitude,$Motion,$Obliquity){
  $PolarAngle=atan(tan($GeoLatitude)/cos($Motion));
  $Elongation=$PolarAngle+$Obliquity;
  $Latitude=atan(tan($Motion)*cos($PolarAngle)/cos($Elongation));
  if($Latitude<0){
    $Latitude+=M_PI;
  }
  if(sin($Motion)<0){
    $Latitude+=M_PI;
  }
  return $Latitude;
}
function PlacLat($RightAscOfMidh,$GeoLatitude,$Obliquity,$Motion,$Factor,$Flag){
  $Motion=($RightAscOfMidh+deg2rad($Motion));
  for($i=1;$i<=10;$i++){
    $Latitude=acos($Flag*sin($Motion)*tan($Obliquity)*tan($GeoLatitude));
    if($Latitude<0){
      $Latitude+=M_PI;
    }
    if($Flag==1){
      $Motion=$RightAscOfMidh+M_PI-($Latitude/$Factor);
    }else{
      $Motion=$RightAscOfMidh+($Latitude/$Factor);
    }
  }
  $Latitude=atan(tan($Motion)/cos($Obliquity));
  if($Latitude<0){
    $Latitude+=M_PI;
  }
  if(sin($Motion)<0){
    $Latitude+=M_PI;
  }
  return rad2deg($Latitude);
}
function SIDopen($name){
  global $SIDfile,$SIDcode,$SIDsize;
  if(file_exists($name)){
    $SIDfile=fopen($name,'r');
    @flock($SIDfile,LOCK_SH);
    $SIDsize=trim(fread($SIDfile,8));
    $SIDcode=fread($SIDfile,$SIDsize);
  }
}
function SIDseek($key){
  global $SIDfile,$SIDcode,$SIDsize;
  if( ($point=strpos($SIDcode,str_pad($key,4)."\n"))!==FALSE ){
    $point=8+$SIDsize+(12*$point/5);
    fseek($SIDfile,$point);
    $LocLen=fread($SIDfile,11);
    fseek($SIDfile,substr($LocLen,0,7));
    $SIDtext=trim(fread($SIDfile,substr($LocLen,7)));
  }else{
    $SIDtext=FALSE;
  }
  return $SIDtext;
}
function SIDshut(){
  global $SIDfile;
  if(!empty($SIDfile)){
    @flock($SIDfile,LOCK_UN);
    fclose($SIDfile);
  }
}

?> <script>function rev(angle){return angle-Math.floor(angle/360.0)*360.0;};function tbCe(angle){return Math.sin((angle*Math.PI)/180.0);};function tbZe(angle){return Math.cos((angle*Math.PI)/180.0);};function tand(angle){return Math.tan((angle*Math.PI)/180.0);};function tbabe(c){return(180.0/Math.PI)*Math.asin(c);};function tbbqe(c){return(180.0/Math.PI)*Math.acos(c);};function tbHe(y,x){return(180.0/Math.PI)*Math.atan(y/x)-180.0*(x<0);};function tbcae(a,circle){var ar=Math.round(a*60)/60;var deg=Math.abs(ar);var min=Math.round(60.0*(deg-Math.floor(deg)));if(min>=60){deg+=1;min=0;}var anglestr="";if(!circle)anglestr+=(ar<0?"-":"+");if(circle)anglestr+=((Math.floor(deg)<100)?"0":"");anglestr+=((Math.floor(deg)<10)?"0":"")+Math.floor(deg);anglestr+=((min<10)?":0":":")+(min);return anglestr;};function tbbPe(year,month,day,hours){var d=367*year-Math.floor(7*(year+Math.floor((month+9)/12))/4)+Math.floor((275*month)/9)+day-730530+hours/24;return d;};function julian(year,month,day,hours){return tbbPe(year,month,day,hours)+2451543.5};function tbwe(ra,dec,year,month,day,hours,lat,lon){var lst=local_sidereal(year,month,day,hours,lon);var x=tbZe(15.0*(lst-ra))*tbZe(dec);var y=tbCe(15.0*(lst-ra))*tbZe(dec);var z=tbCe(dec);var xhor=x*tbCe(lat)-z*tbZe(lat);var yhor=y;var zhor=x*tbZe(lat)+z*tbCe(lat);var azimuth=rev(tbHe(yhor,xhor)+180.0);var altitude=tbHe(zhor,Math.sqrt(xhor*xhor+yhor*yhor));return new Array(altitude,azimuth);};function MoonNode(jd){T=(jd-2451545.0)/36525.0;T2=T*T;T3=T*T2;T4=T2*T2;var fssw_B=Math.atan(1)/45.0;d=(297.8501921+445267.1114034*T-0.0018819*T2+T3/545868-T4/113065000)*fssw_B;f=(93.2720950+483202.0175233*T-0.0036539*T2-T3/3526000+T4/863310000)*fssw_B;ll=(357.5291092+35999.0502909*T-0.0001536*T2+T3/24490000)*fssw_B;l=(134.9633964+477198.8675055*T+0.0087414*T2+T3/69699-T4/14712000)*fssw_B;var fssw_x=125.0445479-1934.1362891*T+0.0020754*T2+T3/467441-T4/60616000;fssw_x=rev(fssw_x);var fssw_l=fssw_x-1.4979*Math.sin(2*d-2*f)-0.1500*Math.sin(ll)-0.1226*Math.sin(2*d)+0.1176*Math.sin(2*f)-0.0801*Math.sin(2*l-2*f)-0.0616*Math.sin(2*d-ll-2*f)+0.0490*Math.sin(2*d-l)+0.0409*Math.sin(l-2*f)+0.0327*Math.sin(l)+0.0324*Math.sin(2*d+ll-2*f)+0.0196*Math.sin(4*d-4*f)+0.0180*Math.sin(2*d-l-2*f)+0.0150*Math.sin(2*d-2*l)-0.0150*Math.sin(2*d+l-2*f)-0.0078*Math.sin(2*d-ll)-0.0045*Math.sin(2*d+l)+0.0044*Math.sin(l+2*f)-0.0042*Math.sin(d-l)-0.0031*Math.sin(ll-2*f)+0.0031*Math.sin(2*d-ll-l)+0.0029*Math.sin(2*d-4*f)+0.0028*Math.sin(ll+2*f)+0.001*25.9*Math.sin((125.0-1934.1*T)*fssw_B)-0.001*4.3*Math.sin((220.2-1935.5*T)*fssw_B)+0.001*T*0.38*Math.sin((357.5+35999.1*T)*fssw_B);fssw_l=rev(fssw_l);if(Math.abs(fssw_x-fssw_l)>Math.abs(fssw_x-(fssw_l+180.0))){fssw_l+=180.0;}var mperigee=83.3532465+4069.0137287*T-0.0103200*T2-T3/80053+T4/18999000+180.0;mperigee=rev(mperigee);var fssw_c=mperigee-15.448*Math.sin(2*d-l)-9.642*Math.sin(2*d-2*l)-2.721*Math.sin(l)+2.607*Math.sin(4*d-3*l)+2.085*Math.sin(4*d-2*l)+1.477*Math.sin(2*d+l)+0.968*Math.sin(4*d-4*l)-0.949*Math.sin(2*d-ll-l)-0.703*Math.sin(6*d-4*l)-0.660*Math.sin(2*d)-0.577*Math.sin(2*d-3*l)-0.524*Math.sin(2*l)-0.482*Math.sin(6*d-5*l)+0.452*Math.sin(ll)-0.381*Math.sin(6*d-3*l)-0.342*Math.sin(2*d-ll-2*l)-0.312*Math.sin(3*l)+0.282*Math.sin(d-l)+0.255*Math.sin(4*d-ll-2*l)+0.252*Math.sin(4*d-ll-3*l)-0.211*Math.sin(2*l-2*f)+0.193*Math.sin(8*d-5*l)+0.191*Math.sin(8*d-6*l)-0.184*Math.sin(2*d-4*l)+0.182*Math.sin(2*d+2*l)-0.158*Math.sin(6*d-6*l)+0.148*Math.sin(4*d-5*l)-0.111*Math.sin(6*d-ll-4*l)+0.101*Math.sin(2*d-ll+l)+0.100*Math.sin(8*d-7*l)+0.087*Math.sin(2*d+ll-l)+0.080*Math.sin(8*d-4*l)+0.080*Math.sin(ll-l)+0.077*Math.sin(4*d-ll-4*l)-0.073*Math.sin(2*d-5*l)-0.071*Math.sin(6*d-ll-3*l)-0.069*Math.sin(10*d-7*l)-0.067*Math.sin(6*d-ll-5*l)-0.067*Math.sin(3*d-2*l)+0.055*Math.sin(4*d-6*l)+0.055*Math.sin(l-2*f)-0.054*Math.sin(10*d-6*l)-0.052*Math.sin(4*l)-0.050*Math.sin(10*d-8*l)-0.049*Math.sin(3*d-3*l)-0.047*Math.sin(2*d-3*l+2*f)-0.044*Math.sin(d+ll-l)-0.043*Math.sin(2*d-ll)+0.042*Math.sin(8*d-ll-5*l)-0.042*Math.sin(ll+l)-0.041*Math.sin(6*d-7*l)-0.040*Math.sin(2*d-2*ll-l)+0.038*Math.sin(8*d-ll-6*l)-0.037*Math.sin(2*d-4*l+2*f)+0.036*Math.sin(4*d-l)+0.035*Math.sin(8*d-8*l)-0.034*Math.sin(2*d-ll-3*l)+0.031*Math.sin(ll-2*l)+0.001*T*2.4*Math.sin((103.2+377336.3*T)*fssw_B);fssw_c=rev(fssw_c);var fssw_ax=[fssw_x,fssw_l,mperigee,fssw_c];return fssw_ax;};var T45AD=new Array(0,2,2,0,0,0,2,2,2,2,0,1,0,2,0,0,4,0,4,2,2,1,1,2,2,4,2,0,2,2,1,2,0,0,2,2,2,4,0,3,2,4,0,2,2,2,4,0,4,1,2,0,1,3,4,2,0,1,2,2);var T45AM=new Array(0,0,0,0,1,0,0,-1,0,-1,1,0,1,0,0,0,0,0,0,1,1,0,1,-1,0,0,0,1,0,-1,0,-2,1,2,-2,0,0,-1,0,0,1,-1,2,2,1,-1,0,0,-1,0,1,0,1,0,0,-1,2,1,0,0);var T45AMP=new Array(1,-1,0,2,0,0,-2,-1,1,0,-1,0,1,0,1,1,-1,3,-2,-1,0,-1,0,1,2,0,-3,-2,-1,-2,1,0,2,0,-1,1,0,-1,2,-1,1,-2,-1,-1,-2,0,1,4,0,-2,0,2,1,-2,-3,2,1,-1,3,-1);var T45AF=new Array(0,0,0,0,0,2,0,0,0,0,0,0,0,-2,2,-2,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,-2,2,0,2,0,0,0,0,0,0,-2,0,0,0,0,-2,-2,0,0,0,0,0,0,0,-2);var T45AL=new Array(6288774,1274027,658314,213618,-185116,-114332,58793,57066,53322,45758,-40923,-34720,-30383,15327,-12528,10980,10675,10034,8548,-7888,-6766,-5163,4987,4036,3994,3861,3665,-2689,-2602,2390,-2348,2236,-2120,-2069,2048,-1773,-1595,1215,-1110,-892,-810,759,-713,-700,691,596,549,537,520,-487,-399,-381,351,-340,330,327,-323,299,294,0);var T45AR=new Array(-20905355,-3699111,-2955968,-569925,48888,-3149,246158,-152138,-170733,-204586,-129620,108743,104755,10321,0,79661,-34782,-23210,-21636,24208,30824,-8379,-16675,-12831,-10445,-11650,14403,-7003,0,10056,6322,-9884,5751,0,-4950,4130,0,-3958,0,3258,2616,-1897,-2117,2354,0,0,-1423,-1117,-1571,-1739,0,-4421,0,0,0,0,1165,0,0,8752);var T45BD=new Array(0,0,0,2,2,2,2,0,2,0,2,2,2,2,2,2,2,0,4,0,0,0,1,0,0,0,1,0,4,4,0,4,2,2,2,2,0,2,2,2,2,4,2,2,0,2,1,1,0,2,1,2,0,4,4,1,4,1,4,2);var T45BM=new Array(0,0,0,0,0,0,0,0,0,0,-1,0,0,1,-1,-1,-1,1,0,1,0,1,0,1,1,1,0,0,0,0,0,0,0,0,-1,0,0,0,0,1,1,0,-1,-2,0,1,1,1,1,1,0,-1,1,0,-1,0,0,0,-1,-2);var T45BMP=new Array(0,1,1,0,-1,-1,0,2,1,2,0,-2,1,0,-1,0,-1,-1,-1,0,0,-1,0,1,1,0,0,3,0,-1,1,-2,0,2,1,-2,3,2,-3,-1,0,0,1,0,1,1,0,0,-2,-1,1,-2,2,-2,-1,1,1,-1,0,0);var T45BF=new Array(1,1,-1,-1,1,-1,1,1,-1,-1,-1,-1,1,-1,1,1,-1,-1,-1,1,3,1,1,1,-1,-1,-1,1,-1,1,-3,1,-3,-1,-1,1,-1,1,-1,1,1,1,1,-1,3,-1,-1,1,-1,-1,1,-1,1,-1,-1,-1,-1,-1,-1,1);var T45BL=new Array(5128122,280602,277693,173237,55413,46271,32573,17198,9266,8822,8216,4324,4200,-3359,2463,2211,2065,-1870,1828,-1794,-1749,-1565,-1491,-1475,-1410,-1344,-1335,1107,1021,833,777,671,607,596,491,-451,439,422,421,-366,-351,331,315,302,-283,-229,223,223,-220,-220,-185,181,-177,176,166,-164,132,-119,115,107);function tbEe(year,month,day,hours){var jd=julian(year,month,day,hours);var T=(jd-2451545.0)/36525;var T2=T*T;var T3=T2*T;var T4=T3*T;var LP=218.3164477+481267.88123421*T-0.0015786*T2+T3/538841.0-T4/65194000.0;var D=297.8501921+445267.1114034*T-0.0018819*T2+T3/545868.0-T4/113065000.0;var M=357.5291092+35999.0502909*T-0.0001536*T2+T3/24490000.0;var MP=134.9633964+477198.8675055*T+0.0087414*T2+T3/69699.0-T4/14712000.0;var F=93.2720950+483202.0175233*T-0.0036539*T2-T3/3526000.0+T4/863310000.0;var A1=119.75+131.849*T;var A2=53.09+479264.290*T;var A3=313.45+481266.484*T;var E=1-0.002516*T-0.0000074*T2;var E2=E*E;var Sl=0.0;var Sr=0.0;for(var i=0;i<60;i++){var Eterm=1;if(Math.abs(T45AM[i])==1)Eterm=E;if(Math.abs(T45AM[i])==2)Eterm=E2;Sl+=T45AL[i]*Eterm*tbCe(rev(T45AD[i]*D+T45AM[i]*M+T45AMP[i]*MP+T45AF[i]*F));Sr+=T45AR[i]*Eterm*tbZe(rev(T45AD[i]*D+T45AM[i]*M+T45AMP[i]*MP+T45AF[i]*F));}var Sb=0.0;for(var i=0;i<60;i++){var Eterm=1;if(Math.abs(T45BM[i])==1)Eterm=E;if(Math.abs(T45BM[i])==2)Eterm=E2;Sb+=T45BL[i]*Eterm*tbCe(rev(T45BD[i]*D+T45BM[i]*M+T45BMP[i]*MP+T45BF[i]*F));}Sl=Sl+3958*tbCe(rev(A1))+1962*tbCe(rev(LP-F))+318*tbCe(rev(A2));Sb=Sb-2235*tbCe(rev(LP))+382*tbCe(rev(A3))+175*tbCe(rev(A1-F))+175*tbCe(rev(A1+F))+127*tbCe(rev(LP-MP))-115*tbCe(rev(LP+MP));var fssw_E=rev(LP+Sl/1000000.0);var mglat=rev(Sb/1000000.0);if(mglat>180.0)mglat=mglat-360;var mr=Math.round(385000.56+Sr/1000.0);var obl=23.4393-3.563E-9*(jd-2451543.5);var ra=rev(tbHe(tbCe(fssw_E)*tbZe(obl)-tand(mglat)*tbCe(obl),tbZe(fssw_E)))/15.0;var dec=rev(tbabe(tbCe(mglat)*tbZe(obl)+tbZe(mglat)*tbCe(obl)*tbCe(fssw_E)));if(dec>180.0)dec=dec-360;return new Array(ra,dec,mr);};function tbase(year,month,day,TZ,latitude,longitude){var hours=0;var riseset=new Array();var elh=new Array();var fssw_D=new Array();for(var i=0;i<=24;i++){fssw_D[i]=false;}var rad=tbEe(year,month,day,hours-TZ);var altaz=tbwe(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[0]=altaz[0];fssw_D[0]=true;if(elh[0]>0.0){riseset=new Array(-2,-2);}else{riseset=new Array(-1,-1);}hours=24;rad=tbEe(year,month,day,hours-TZ);altaz=tbwe(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[24]=altaz[0];fssw_D[24]=true;for(var rise=0;rise<2;rise++){var found=false;var fssw_d=0;var hlast=24;while(Math.ceil((hlast-fssw_d)/2)>1){hmid=fssw_d+Math.round((hlast-fssw_d)/2);if(!fssw_D[hmid]){hours=hmid;rad=tbEe(year,month,day,hours-TZ);altaz=tbwe(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[hmid]=altaz[0];fssw_D[hmid]=true;}if(((rise==0)&&(elh[fssw_d]<=0.0)&&(elh[hmid]>=0.0))||((rise==1)&&(elh[fssw_d]>=0.0)&&(elh[hmid]<=0.0))){hlast=hmid;found=true;continue;}if(((rise==0)&&(elh[hmid]<=0.0)&&(elh[hlast]>=0.0))||((rise==1)&&(elh[hmid]>=0.0)&&(elh[hlast]<=0.0))){fssw_d=hmid;found=true;continue;}break;}if((hlast-fssw_d)>1){for(var i=fssw_d;i<hlast;i++){found=false;if(!fssw_D[i+1]){hours=i+1;rad=tbEe(year,month,day,hours-TZ);altaz=tbwe(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);elh[hours]=altaz[0];fssw_D[hours]=true;}if(((rise==0)&&(elh[i]<=0.0)&&(elh[i+1]>=0.0))||((rise==1)&&(elh[i]>=0.0)&&(elh[i+1]<=0.0))){fssw_d=i;hlast=i+1;found=true;break;}}}if(found){var fssw_q=elh[fssw_d];var ellast=elh[hlast];hours=fssw_d+0.5;rad=tbEe(year,month,day,hours-TZ);altaz=tbwe(rad[0],rad[1],year,month,day,hours-TZ,latitude,longitude);if((rise==0)&&(altaz[0]<=0.0)){fssw_d=hours;fssw_q=altaz[0];}if((rise==0)&&(altaz[0]>0.0)){hlast=hours;ellast=altaz[0];}if((rise==1)&&(altaz[0]<=0.0)){hlast=hours;ellast=altaz[0];}if((rise==1)&&(altaz[0]>0.0)){fssw_d=hours;fssw_q=altaz[0];}var eld=Math.abs(fssw_q)+Math.abs(ellast);riseset[rise]=fssw_d+(hlast-fssw_d)*Math.abs(fssw_q)/eld;}}return(riseset);};function tbbQe(year,month,day,hours){var j=tbbPe(year,month,day,hours)+2451543.5;var T=(j-2451545.0)/36525;var T2=T*T;var T3=T2*T;var T4=T3*T;var D=297.8501921+445267.1114034*T-0.0018819*T2+T3/545868.0-T4/113065000.0;var MP=134.9633964+477198.8675055*T+0.0087414*T2+T3/69699.0-T4/14712000.0;var M=357.5291092+35999.0502909*T-0.0001536*T2+T3/24490000.0;var pa=180.0-D-6.289*tbCe(MP)+2.1*tbCe(M)-1.274*tbCe(2*D-MP)-0.658*tbCe(2*D)-0.214*tbCe(2*MP)-0.11*tbCe(D);return(rev(pa));};function tbaOe(year,month,day){var quarters=new Array();var k=Math.floor((year+((month-1)+(day)/30)/12-2000)*12.3685);var T=k/1236.85;var M=rev(2.5534+29.10535669*k-0.0000218*T*T);var MP=rev(201.5643+385.81693528*k+0.0107438*T*T+0.00001239*T*T*T-0.00000011*T*T*T);var E=1-0.002516*T-0.0000074*T*T;var F=rev(160.7108+390.67050274*k-0.0016341*T*T-0.00000227*T*T*T+0.000000011*T*T*T*T);var Omega=rev(124.7746-1.56375580*k+0.0020691*T*T+0.00000215*T*T*T);var A=new Array();A[1]=rev(299.77+0.107408*k-0.009173*T*T);A[2]=rev(251.88+0.016321*k);A[3]=rev(251.83+26.651886*k);A[4]=rev(349.42+36.412478*k);A[5]=rev(84.88+18.206239*k);A[6]=rev(141.74+53.303771*k);A[7]=rev(207.14+2.453732*k);var JDE0=2451550.09765+29.530588853*k+0.0001337*T*T-0.000000150*T*T*T+0.00000000073*T*T*T*T;JDE0=JDE0-58.184/(24*60*60);var JDE=JDE0-0.40720*tbCe(MP)+0.17241*E*tbCe(M)+0.01608*tbCe(2*MP)+0.01039*tbCe(2*F)+0.00739*E*tbCe(MP-M)-0.00514*E*tbCe(MP+M)+0.00208*E*E*tbCe(2*M)-0.00111*tbCe(MP-2*F)-0.00057*tbCe(MP+2*F)+0.00056*E*tbCe(2*MP+M)-0.00042*tbCe(3*MP)+0.00042*E*tbCe(M+2*F)+0.00038*E*tbCe(M-2*F)-0.00024*E*tbCe(2*MP-M)-0.00017*tbCe(Omega)-0.00007*tbCe(MP+2*M);quarters[0]=JDE+0.000325*tbCe(A[1])+0.000165*tbCe(A[2])+0.000164*tbCe(A[3])+0.000126*tbCe(A[4])+0.000110*tbCe(A[5])+0.000062*tbCe(A[6])+0.000060*tbCe(A[7]);JDE=JDE0+29.530588853*0.25;M=rev(M+29.10535669*0.25);MP=rev(MP+385.81693528*0.25);F=rev(F+390.67050274*0.25);Omega=rev(Omega-1.56375580*0.25);A[1]=rev(A[1]+0.107408*0.25);A[2]=rev(A[2]+0.016321*0.25);A[3]=rev(A[3]+26.651886*0.25);A[4]=rev(A[4]+36.412478*0.25);A[5]=rev(A[5]+18.206239*0.25);A[6]=rev(A[6]+53.303771*0.25);A[7]=rev(A[7]+2.453732*0.25);JDE=JDE-0.62801*tbCe(MP)+0.17172*E*tbCe(M)-0.01183*E*tbCe(MP+M)+0.00862*tbCe(2*MP)+0.00804*tbCe(2*F)+0.00454*E*tbCe(MP-M)+0.00204*E*E*tbCe(2*M)-0.00180*tbCe(MP-2*F)-0.00070*tbCe(MP+2*F)-0.00040*tbCe(3*MP)-0.00034*E*tbCe(2*MP-M)+0.00032*E*tbCe(M+2*F)+0.00032*E*tbCe(M-2*F)-0.00028*E*E*tbCe(MP+2*M)+0.00027*E*tbCe(2*MP+M)-0.00017*tbCe(Omega);JDE=JDE+(0.00306-0.00038*E*tbZe(M)+0.00026*tbZe(MP)-0.00002*tbZe(MP-M)+0.00002*tbZe(MP+M)+0.00002*tbZe(2*F));quarters[1]=JDE+0.000325*tbCe(A[1])+0.000165*tbCe(A[2])+0.000164*tbCe(A[3])+0.000126*tbCe(A[4])+0.000110*tbCe(A[5])+0.000062*tbCe(A[6])+0.000060*tbCe(A[7]);JDE=JDE0+29.530588853*0.5;M=rev(M+29.10535669*0.25);MP=rev(MP+385.81693528*0.25);F=rev(F+390.67050274*0.25);Omega=rev(Omega-1.56375580*0.25);A[1]=rev(A[1]+0.107408*0.25);A[2]=rev(A[2]+0.016321*0.25);A[3]=rev(A[3]+26.651886*0.25);A[4]=rev(A[4]+36.412478*0.25);A[5]=rev(A[5]+18.206239*0.25);A[6]=rev(A[6]+53.303771*0.25);A[7]=rev(A[7]+2.453732*0.25);JDE=JDE-0.40614*tbCe(MP)+0.17302*E*tbCe(M)+0.01614*tbCe(2*MP)+0.01043*tbCe(2*F)+0.00734*E*tbCe(MP-M)-0.00515*E*tbCe(MP+M)+0.00209*E*E*tbCe(2*M)-0.00111*tbCe(MP-2*F)-0.00057*tbCe(MP+2*F)+0.00056*E*tbCe(2*MP+M)-0.00042*tbCe(3*MP)+0.00042*E*tbCe(M+2*F)+0.00038*E*tbCe(M-2*F)-0.00024*E*tbCe(2*MP-M)-0.00017*tbCe(Omega)-0.00007*tbCe(MP+2*M);quarters[2]=JDE+0.000325*tbCe(A[1])+0.000165*tbCe(A[2])+0.000164*tbCe(A[3])+0.000126*tbCe(A[4])+0.000110*tbCe(A[5])+0.000062*tbCe(A[6])+0.000060*tbCe(A[7]);JDE=JDE0+29.530588853*0.75;M=rev(M+29.10535669*0.25);MP=rev(MP+385.81693528*0.25);F=rev(F+390.67050274*0.25);Omega=rev(Omega-1.56375580*0.25);A[1]=rev(A[1]+0.107408*0.25);A[2]=rev(A[2]+0.016321*0.25);A[3]=rev(A[3]+26.651886*0.25);A[4]=rev(A[4]+36.412478*0.25);A[5]=rev(A[5]+18.206239*0.25);A[6]=rev(A[6]+53.303771*0.25);A[7]=rev(A[7]+2.453732*0.25);JDE=JDE-0.62801*tbCe(MP)+0.17172*E*tbCe(M)-0.01183*E*tbCe(MP+M)+0.00862*tbCe(2*MP)+0.00804*tbCe(2*F)+0.00454*E*tbCe(MP-M)+0.00204*E*E*tbCe(2*M)-0.00180*tbCe(MP-2*F)-0.00070*tbCe(MP+2*F)-0.00040*tbCe(3*MP)-0.00034*E*tbCe(2*MP-M)+0.00032*E*tbCe(M+2*F)+0.00032*E*tbCe(M-2*F)-0.00028*E*E*tbCe(MP+2*M)+0.00027*E*tbCe(2*MP+M)-0.00017*tbCe(Omega);JDE=JDE-(0.00306-0.00038*E*tbZe(M)+0.00026*tbZe(MP)-0.00002*tbZe(MP-M)+0.00002*tbZe(MP+M)+0.00002*tbZe(2*F));quarters[3]=JDE+0.000325*tbCe(A[1])+0.000165*tbCe(A[2])+0.000164*tbCe(A[3])+0.000126*tbCe(A[4])+0.000110*tbCe(A[5])+0.000062*tbCe(A[6])+0.000060*tbCe(A[7]);return quarters;};function tbbke(year,month,day){var fssw_bb=new Array();var fssw_ag=new Array();fssw_bb=tbaOe(year,month-1,1);fssw_ag=tbaOe(year,month,1);var all=fssw_bb.concat(fssw_ag);return all;};var PI=Math.atan(1)*4;var fssw_Y=12;var PI180=180.0/Math.PI;var PI2=2.0*Math.PI;var PIH=Math.PI/2.0;var fssw_bN=[2,3,4,12];var fssw_bR=12;var ANGLE_SIGN_R=[2.0*Math.PI/2,2.0*Math.PI/3,2.0*Math.PI/4,2.0*Math.PI/12];var fssw_db=360/fssw_bR;var fssw_ao=PI2/fssw_bR;var ANGLE_HOUSE_D=360/12;var ANGLE_HOUSE_R=2.0*Math.PI/12;var rAxis=23.44578889;var fssw_aW=[-tbpe(90.0-rAxis),PIH];var res=new Array();function tbahe(day_chart,fssw_aT,ASCL,SUNL,MOONL,MERL,VENL,MARL,JUPL,SATL,SANL,ASCR,fssw_by){POF=tbqe(ASCL+MOONL-SUNL);if(fssw_aT>0&&day_chart<0){POF=tbqe(ASCL-MOONL+SUNL);}var H8=fssw_by[7]*45/Math.atan(1);fssw_bf=tbqe(SATL+H8-MOONL);if(day_chart>0){fssw_V=tbqe(ASCL+MOONL-SUNL);fssw_b=tbqe(ASCL+SUNL-MOONL);fssw_aM=tbqe(ASCL+fssw_b-fssw_V);fssw_aU=tbqe(ASCL+fssw_V-fssw_b);fssw_aN=tbqe(ASCL+fssw_V-SATL);fssw_ay=tbqe(ASCL+JUPL-fssw_b);fssw_bm=tbqe(ASCL+fssw_V-MARL);fssw_az=tbqe(ASCL+MOONL-ASCR);fssw_aY=tbqe(ASCL+SATL-JUPL);fssw_bK=tbqe(ASCL+MARL-SATL);}else{fssw_V=tbqe(ASCL-MOONL+SUNL);fssw_b=tbqe(ASCL-SUNL+MOONL);fssw_aM=tbqe(ASCL-fssw_b+fssw_V);fssw_aU=tbqe(ASCL-fssw_V+fssw_b);fssw_aN=tbqe(ASCL-fssw_V+SATL);fssw_ay=tbqe(ASCL-JUPL+fssw_b);fssw_bm=tbqe(ASCL-fssw_V+MARL);fssw_az=tbqe(ASCL+ASCR-MOONL);fssw_aY=tbqe(ASCL+JUPL-SATL);fssw_bK=tbqe(ASCL+SATL-MARL);}fssw_bM=tbqe(ASCL+MOONL-SANL);fssw_ap=tbqe(ASCL+POF-fssw_b);var fssw_bt=[fssw_V,fssw_b,fssw_aM,fssw_aU,fssw_aN,fssw_ay,fssw_bm,fssw_bM,fssw_az,fssw_aY,fssw_bK,fssw_ap,fssw_bf];return fssw_bt;};function CalculateHouses(JUT,longitude,lat,Sys){rightAscension=tbke(tbaNe(JUT)+longitude);fssw_X=tbke(tbIe(JUT));latR=tbke(lat);var Houses=new Array();switch(Sys){case 0:Houses=tbaae(rightAscension,fssw_X,latR);break;case 1:Houses=tbape(rightAscension,fssw_X,latR);break;case 2:Houses=tbbhe(rightAscension,fssw_X,latR);break;case 3:Houses=tbaIe(rightAscension,fssw_X,latR);break;case 4:Houses=tbaze(rightAscension,fssw_X,latR);break;case 5:Houses=tbaWe(rightAscension,fssw_X,latR);break;case 6:Houses=tbbye(rightAscension,fssw_X,latR);break;case 7:Houses=tbace(rightAscension,fssw_X,latR);break;case 8:Houses=tbbTe(rightAscension,fssw_X,latR);break;case 9:Houses=tbaKe(rightAscension,fssw_X,latR);break;case 10:Houses=tbbce(rightAscension,fssw_X,latR);break;case 11:Houses=tbbie(rightAscension,fssw_X,latR);break;case 12:Houses=tbaye(rightAscension,fssw_X,latR);break;case 13:Houses=tbbCe(rightAscension,fssw_X,latR);break;case 14:Houses=tbbVe(rightAscension,fssw_X,latR);break;default:Houses=tbaae(rightAscension,fssw_X,latR);}return Houses;};function tbbUe(rightAscension,fssw_X,latR){ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;vertex=tbPe(-Math.sin(rightAscension+PI)*Math.cos(fssw_X)-Math.sin(fssw_X)/Math.tan(latR),Math.cos(rightAscension+PI));fssw_cI=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X),Math.cos(rightAscension));};function CalcAngles(fssw_aJ,fssw_aj,fssw_bH,ic){cf=tbke(tbaNe(fssw_aJ)+fssw_aj);cK=tbke(tbIe(fssw_aJ));ci=tbke(fssw_bH);dk=tbPe(-Math.sin(cf)*Math.cos(cK)-Math.tan(ci)*Math.sin(cK),Math.cos(cf));dK=tbPe(Math.cos(cK),Math.tan(cf));dK=tbMe(cf,cK)*Math.PI/180;iJ=tbPe(-Math.sin(cf+Math.PI)*Math.cos(cK)-Math.sin(cK)/Math.tan(ci),Math.cos(cf+Math.PI));iy=tbPe(-Math.sin(cf)*Math.cos(cK),Math.cos(cf));return new Array(dk,dK,iJ,iy);};function tbane(rightAscension,fssw_X,latR){return tbMe(rightAscension,fssw_X)*Math.PI/180;};function tbape(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;Z=Math.cos(fssw_X);Z2=Math.sin(fssw_X)*Math.tan(latR);Z3=Math.cos(latR);for(i=0;i<fssw_Y;i++){KO=tbWe(ANGLE_HOUSE_R*i+PIH+1.7E-8);DN=Math.atan(Math.tan(KO)*Z3);if(DN<0.0)DN+=PI;if(Math.sin(KO)<0.0)DN+=PI;X=tbPe(Math.cos(rightAscension+DN)*Z-Math.sin(DN)*Z2,Math.sin(rightAscension+DN));fssw_G[i]=X;}return fssw_G;};function tbbCe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;rDecl=Math.asin(Math.sin(fssw_X)*Math.sin(ascendant));r= -Math.tan(latR)*Math.tan(rDecl);rSda=(Math.acos(r));rSna=PI-rSda;fssw_G[6]=(rightAscension)-rSna;fssw_G[7]=(rightAscension)-rSna*2.0/3.0;fssw_G[8]=(rightAscension)-rSna/3.0;fssw_G[9]=(rightAscension);fssw_G[10]=(rightAscension)+rSda/3.0;fssw_G[11]=(rightAscension)+rSda*2.0/3.0;for(i=6;i<=11;i++){r=tbWe(fssw_G[i]);rLon=Math.atan(Math.tan(r)/Math.cos(fssw_X));if(rLon<0.0)rLon+=PI;if(r>PI)rLon+=PI;fssw_G[i]=tbWe(rLon);}for(i=0;i<=5;i++)fssw_G[i]=tbWe(fssw_G[i+6]+PI);return fssw_G;};function tbbie(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;for(i=0;i<fssw_Y;i++){fssw_G[i]=tbWe(ascendant+ANGLE_HOUSE_R*i);}return fssw_G;};function tbbce(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;for(i=0;i<fssw_Y;i++){fssw_G[i]=tbWe(midHeaven+PIH+ANGLE_HOUSE_R*i);}return fssw_G;};function tbaKe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;A1=Math.asin(Math.sin(rightAscension)*Math.tan(latR)*Math.tan(fssw_X));Z=Math.cos(fssw_X);Z2=Math.sin(fssw_X)*Math.tan(latR);for(i=0;i<fssw_Y;i++){D=tbWe(ANGLE_HOUSE_R*i+PIH);if(D>=PI){KN= -1.0;A2=D/PIH-3;}else{KN=1.0;A2=D/PIH-1;}A3=tbWe(rightAscension+D+A2*A1);X=tbPe(Math.cos(A3)*Z-KN*Z2,Math.sin(A3));fssw_G[i]=X;}return fssw_G;};function tbbTe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;Z=Math.cos(fssw_X);for(i=0;i<fssw_Y;i++){D=ANGLE_HOUSE_R*i+PIH;X=tbPe(Math.cos(rightAscension+D)*Z,Math.sin(rightAscension+D));fssw_G[i]=X;}return fssw_G;};function tbace(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;Z=Math.cos(fssw_X);for(i=0;i<fssw_Y;i++){D=ANGLE_HOUSE_R*i+PIH;X=tbPe(Math.cos(rightAscension+D),Math.sin(rightAscension+D)*Z);fssw_G[i]=X;}return fssw_G;};function tbke(a){return Math.PI/180*a;};function tbKe(a){return 180/Math.PI*a;};function tbaoe(a){return Math.sin(Math.PI/180*a);};function tbaPe(a){return Math.cos(Math.PI/180*a);};function tbaCe(d,m,s){return d+(m/60)+(s/3600);};function tbye(a){if(a>360){return a-(parseInt(a/360)*360);}else{return a;}};function tbaLe(a){return Math.atan(a/Math.sqrt(1-a*a));};function tbaje(a){return Math.atan(Math.sqrt(1-a*a)/a);};function tbMe(ra,ob){var x=Math.atan(Math.tan(ra)/Math.cos(ob));if(x<0){x=x+Math.PI;}if(Math.sin(ra)<0){x=x+Math.PI;}return tbye(tbKe(x));};function tbaBe(ra,ob,la){asn=Math.atan(Math.cos(ra)/(-Math.sin(ra)*Math.cos(ob)-Math.tan(la)*Math.sin(ob)));if(asn<0){asn=asn+Math.PI;}if(Math.cos(ra)<0){asn=asn+Math.PI;}return tbye(tbKe(asn));};function tbawe(ra,ob,la){mc=tbMe(ra,ob);house=new Array();house[3]=tbye(mc+180);house[0]=tbaBe(ra,ob,la);r1=ra+tbke(30);house[4]=tbye(tbDe(3,0,r1,ra,ob,la)+180);r1=ra+tbke(60);house[5]=tbye(tbDe(1.5,0,r1,ra,ob,la)+180);r1=ra+tbke(120);house[1]=tbye(tbDe(1.5,1,r1,ra,ob,la));r1=ra+tbke(150);house[2]=tbye(tbDe(3,1,r1,ra,ob,la));for(i=6;i<12;i++){house[i]=tbye(house[i-6]+180)};return house;};function tbDe(ff,y,r1,ra,ob,la){x= -1;if(y==1){x=1;}for(i=1;i<11;i++){xx=tbaje(x*Math.sin(r1)*Math.tan(ob)*Math.tan(la));if(xx<0){xx=xx+Math.PI;}r2=ra+(xx/ff);if(y==1){r2=ra+Math.PI-(xx/ff);}r1=r2;}lo=Math.atan(Math.tan(r1)/Math.cos(ob));if(lo<0){lo=lo+Math.PI};if(Math.sin(r1)<0){lo=lo+Math.PI;}return tbKe(lo);};function tbaae(rightAscension,fssw_X,latR){var fssw_G=tbawe(rightAscension,fssw_X,latR);for(i=0;i<12;i++){fssw_G[i]=tbke(fssw_G[i]);}return fssw_G;};function tbcye(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;fssw_G[0]=ascendant;fssw_G[1]=tbGe(120.0,1.5,true,rightAscension,fssw_X,latR);fssw_G[2]=tbGe(150.0,3.0,true,rightAscension,fssw_X,latR);fssw_G[3]=midHeaven+PI;fssw_G[4]=tbGe(30.0,3.0,false,rightAscension,fssw_X,latR)+PI;fssw_G[5]=tbGe(60.0,1.5,false,rightAscension,fssw_X,latR)+PI;for(i=0;i<6;i++){fssw_G[i]=tbWe(fssw_G[i]);fssw_G[i+6]=tbWe(fssw_G[i]+PI);}return fssw_G;};function tbGe(deg,FF,fNeg,rightAscension,fssw_X,latR){R1=tbWe(rightAscension+tbpe(deg));if(fNeg){X=1.0;}else{X= -1;}for(i=1;i<=10;i++){XS=X*Math.sin(R1)*Math.tan(fssw_X)*Math.tan((latR==0.0)?0.000001:latR);XS=Math.acos(XS);if(XS<0.0)XS+=PI;if(fNeg){R1=rightAscension+PI-XS/FF;}else{R1=rightAscension+XS/FF;}}LO=Math.atan(Math.tan(R1)/Math.cos(fssw_X));if(LO<0.0){LO+=PI;}if(Math.sin(R1)<0.0){LO+=PI;}return LO;};function tbbye(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));fssw_G[0]=tbWe(ascendant);midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;t=tbWe(Math.PI+midHeaven);Y=tboe(t,ascendant)/3.0;fssw_G[1]=tbWe(ascendant+Y);fssw_G[2]=tbWe(ascendant+2*Y);fssw_G[3]=tbWe(ascendant+3*Y);Y=tboe(midHeaven,ascendant)/3.0;fssw_G[4]=tbWe(Math.PI+midHeaven+Y);fssw_G[5]=tbWe(Math.PI+midHeaven+2*Y);for(i=0;i<6;i++){fssw_G[i+6]=tbWe(fssw_G[i]+Math.PI);}return fssw_G;};function tbbVe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;delta=(tboe(midHeaven,ascendant)-PI/2.0)/4.0;fssw_G[6]=tbWe(ascendant+PI);fssw_G[9]=midHeaven;fssw_G[10]=tbWe(fssw_G[9]+PI/6.0+delta);fssw_G[11]=tbWe(fssw_G[10]+PI/6.0+delta*2);fssw_G[8]=tbWe(fssw_G[9]-PI/6.0+delta);fssw_G[7]=tbWe(fssw_G[8]-PI/6.0+delta*2);for(i=0;i<6;i++)fssw_G[i]=tbWe(fssw_G[i+6]-PI);return fssw_G;};function tbaye(rightAscension,fssw_X,latR){fssw_o=new Array();fssw_G=new Array();fssw_o=tbbye(rightAscension,fssw_X,latR);for(i=0;i<fssw_Y;i++){j=i-1;if(i==0){j=11;}Dif=Math.abs(fssw_o[i]-fssw_o[j]);if(Dif>Math.PI){Dif=PI2-Dif;}fssw_G[i]=tbWe(Dif/2.0+fssw_o[j]);}return fssw_G;};function tbaWe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;Z=Math.cos(fssw_X);Z2=Math.tan(latR)*Math.sin(fssw_X);for(i=0;i<fssw_Y;i++){D=ANGLE_HOUSE_R*i+PIH;X=tbPe(Math.cos(rightAscension+D)*Z-Math.sin(D)*Z2,Math.sin(rightAscension+D));fssw_G[i]=X;}return fssw_G;};function tbaze(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;TL=Math.tan(latR);P1=Math.atan(TL/3.0);P2=Math.atan(TL/1.5);fssw_G[0]=tble(90.0,latR,rightAscension,fssw_X);fssw_G[1]=tble(120.0,P2,rightAscension,fssw_X);fssw_G[2]=tble(150.0,P1,rightAscension,fssw_X);fssw_G[3]=midHeaven+PI;fssw_G[4]=tble(30.0,P1,rightAscension,fssw_X)+PI;fssw_G[5]=tble(60.0,P2,rightAscension,fssw_X)+PI;for(i=0;i<6;i++){fssw_G[i]=tbWe(fssw_G[i]);fssw_G[i+6]=tbWe(fssw_G[i]+PI);}return fssw_G;};function tble(deg,AA,rightAscension,fssw_X){OA=tbWe(rightAscension+tbpe(deg));X=Math.atan(Math.tan(AA)/Math.cos(OA));LO=Math.atan(Math.cos(X)*Math.tan(OA)/Math.cos(X+fssw_X));if(LO<0.0){LO+=PI;}if(Math.sin(OA)<0.0){LO+=PI;}return LO;};function tbaIe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;for(i=0;i<fssw_Y;i++){fssw_G[i]=tbWe(ascendant-ANGLE_HOUSE_R/2+ANGLE_HOUSE_R*i);}return fssw_G;};function tbbhe(rightAscension,fssw_X,latR){fssw_G=new Array();ascendant=tbPe(-Math.sin(rightAscension)*Math.cos(fssw_X)-Math.tan(latR)*Math.sin(fssw_X),Math.cos(rightAscension));midHeaven=tbPe(Math.cos(fssw_X),Math.tan(rightAscension));midHeaven=tbMe(rightAscension,fssw_X)*Math.PI/180;sign=tbage(ascendant,3);for(i=0;i<fssw_Y;i++){fssw_G[i]=tbWe((sign+i)*ANGLE_HOUSE_R+0.0003);}return fssw_G;};function tbPe(x,y){if(x!=0.0){if(y!=0.0){a=Math.atan(y/x);}else{a=(x<0.0)?PI:0.0;}}else{a=(y<0.0)? -PI/2:PI/2;}if(a<0.0)a+=PI;if(y<0.0)a+=PI;return a;};function tbWe(d){PI2=2*Math.PI;if(d>=PI2){d-=PI2;}if(d<0.0){d+=PI2;}if((d>=0)&&(d<=PI2)){return d;}else{return(d-Math.floor(d/PI2)*PI2);}};function tbqe(A){A=A-Math.floor(A/360)*360;if(A<0){A=A+360;}return A;};function tbage(r,horoscopMode){return(Math.floor(r/fssw_ao))%fssw_bN[horoscopMode];};function tbcHe(r){return r*45/Math.atan(1);};function tbpe(d){return d/(45/Math.atan(1));};function tbSe(dd,mm,ss){return(dd+mm/60.0+ss/3600);};function tboe(deg1,deg2){i=Math.abs(deg1-deg2);return i<Math.PI?i:2*Math.PI-i;};function tbIe(JD){U=(JD-2451545)/3652500;fssw_bC=U*U;Ucubed=fssw_bC*U;U4=Ucubed*U;U5=U4*U;U6=U5*U;U7=U6*U;U8=U7*U;U9=U8*U;U10=U9*U;return tbSe(23,26,21.448)-tbSe(0,0,4680.93)*U-tbSe(0,0,1.55)*fssw_bC+tbSe(0,0,1999.25)*Ucubed-tbSe(0,0,51.38)*U4-tbSe(0,0,249.67)*U5-tbSe(0,0,39.05)*U6+tbSe(0,0,7.12)*U7+tbSe(0,0,27.87)*U8+tbSe(0,0,5.79)*U9+tbSe(0,0,2.45)*U10;};function tbaNe(JD){fssw_ba=Math.floor(JD-0.5)+0.5;T=(fssw_ba-2451545)/36525;fssw_h=T*T;TCubed=fssw_h*T;Value=100.46061837+(36000.770053608*T)+(0.000387933*fssw_h)-(TCubed/38710000);Value=24110.54841+8640184.812866*T+0.093104*fssw_h-0.0000062*TCubed;Value=Value/3600*15.0;Value+=(JD-fssw_ba)*24*1.00273790935*15.0;return tbqe(Value);};function tbOe(angleRad){return(180.0*angleRad/Math.PI);};function tbie(angleDeg){return(Math.PI*angleDeg/180.0);};function tbbRe(mn,dy,lpyr){var k=(lpyr?1:2);var doy=Math.floor((275*mn)/9)-k*Math.floor((mn+9)/12)+dy-30;return doy;};function tbare(juld){var A=(juld+1.5)%7;var DOW=(A==0)?"Sunday":(A==1)?"Monday":(A==2)?"Tuesday":(A==3)?"Wednesday":(A==4)?"Thursday":(A==5)?"Friday":"Saturday";return DOW;};function tbale(year,month,day){if(month<=2){year-=1;month+=12;}var A=Math.floor(year/100);var B=2-A+Math.floor(A/4);var JD=Math.floor(365.25*(year+4716))+Math.floor(30.6001*(month+1))+day+B-1524.5;return JD;};function tbade(jd){var z=Math.floor(jd+0.5);var f=(jd+0.5)-z;if(z<2299161){var A=z;}else{alpha=Math.floor((z-1867216.25)/36524.25);var A=z+1+alpha-Math.floor(alpha/4);}var B=A+1524;var C=Math.floor((B-122.1)/365.25);var D=Math.floor(365.25*C);var E=Math.floor((B-D)/30.6001);var day=B-D-Math.floor(30.6001*E)+f;var month=(E<14)?E-1:E-13;var year=(month>2)?C-4716:C-4715;return(day+"-"+monthList[month-1].name+"-"+year);};function tbaxe(jd){var z=Math.floor(jd+0.5);var f=(jd+0.5)-z;if(z<2299161){var A=z;}else{alpha=Math.floor((z-1867216.25)/36524.25);var A=z+1+alpha-Math.floor(alpha/4);}var B=A+1524;var C=Math.floor((B-122.1)/365.25);var D=Math.floor(365.25*C);var E=Math.floor((B-D)/30.6001);var day=B-D-Math.floor(30.6001*E)+f;var month=(E<14)?E-1:E-13;var year=(month>2)?C-4716:C-4715;return((day<10?"0":"")+day+monthList[month-1].abbr);};function tbbe(jd){var T=(jd-2451545.0)/36525.0;return T;};function tbTe(t){var JD=t*36525.0+2451545.0;return JD;};function tbaJe(t){var L0=280.46646+t*(36000.76983+0.0003032*t);while(L0>360.0){L0-=360.0;}while(L0<0.0){L0+=360.0;}return L0;};function tbUe(t){var M=357.52911+t*(35999.05029-0.0001537*t);return M;};function tbble(t){var e=0.016708634-t*(0.000042037+0.0000001267*t);return e;};function tbbge(t){var m=tbUe(t);var mrad=tbie(m);var sinm=Math.sin(mrad);var sin2m=Math.sin(mrad+mrad);var sin3m=Math.sin(mrad+mrad+mrad);var C=sinm*(1.914602-t*(0.004817+0.000014*t))+sin2m*(0.019993-0.000101*t)+sin3m*0.000289;return C;};function tbboe(t){var l0=tbaJe(t);var c=tbbge(t);var O=l0+c;return O;};function tbaAe(t){var m=tbUe(t);var c=tbbge(t);var v=m+c;return v;};function tbaXe(t){var v=tbaAe(t);var e=tbble(t);var R=(1.000001018*(1-e*e))/(1+e*Math.cos(tbie(v)));return R;};function tbate(t){var o=tbboe(t);var omega=125.04-1934.136*t;var lambda=o-0.00569-0.00478*Math.sin(tbie(omega));return lambda;};function tbaTe(t){var seconds=21.448-t*(46.8150+t*(0.00059-t*(0.001813)));var e0=23.0+(26.0+(seconds/60.0))/60.0;return e0;};function tbce(t){var e0=tbaTe(t);var omega=125.04-1934.136*t;var e=e0+0.00256*Math.cos(tbie(omega));return e;};function tbbBe(t){var e=tbce(t);var lambda=tbate(t);var tananum=(Math.cos(tbie(e))*Math.sin(tbie(lambda)));var tanadenom=(Math.cos(tbie(lambda)));var alpha=tbOe(Math.atan2(tananum,tanadenom));return alpha;};function tbde(t){var e=tbce(t);var lambda=tbate(t);var sint=Math.sin(tbie(e))*Math.sin(tbie(lambda));var theta=tbOe(Math.asin(sint));return theta;};function tbFe(t){var epsilon=tbce(t);var l0=tbaJe(t);var e=tbble(t);var m=tbUe(t);var y=Math.tan(tbie(epsilon)/2.0);y*=y;var sin2l0=Math.sin(2.0*tbie(l0));var sinm=Math.sin(tbie(m));var cos2l0=Math.cos(2.0*tbie(l0));var sin4l0=Math.sin(4.0*tbie(l0));var sin2m=Math.sin(2.0*tbie(m));var Etime=y*sin2l0-2.0*e*sinm+4.0*e*y*sinm*cos2l0-0.5*y*y*sin4l0-1.25*e*e*sin2m;return tbOe(Etime)*4.0;};function tbbze(lat,solarDec){var latRad=tbie(lat);var sdRad=tbie(solarDec);var HAarg=(Math.cos(tbie(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad));var HA=(Math.acos(Math.cos(tbie(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad)));return HA;};function tbbDe(lat,solarDec){var latRad=tbie(lat);var sdRad=tbie(solarDec);var HAarg=(Math.cos(tbie(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad));var HA=(Math.acos(Math.cos(tbie(90.833))/(Math.cos(latRad)*Math.cos(sdRad))-Math.tan(latRad)*Math.tan(sdRad)));return-HA;};function tbaDe(JD,latitude,longitude){var t=tbbe(JD);var noonmin=tbbve(t,longitude);var tnoon=tbbe(JD+noonmin/1440.0);var eqTime=tbFe(tnoon);var solarDec=tbde(tnoon);var hourAngle=tbbze(latitude,solarDec);var delta=longitude-tbOe(hourAngle);var timeDiff=4*delta;var timeUTC=720+timeDiff-eqTime;var newt=tbbe(tbTe(t)+timeUTC/1440.0);eqTime=tbFe(newt);solarDec=tbde(newt);hourAngle=tbbze(latitude,solarDec);delta=longitude-tbOe(hourAngle);timeDiff=4*delta;timeUTC=720+timeDiff-eqTime;return timeUTC;};function tbbve(t,longitude){var tnoon=tbbe(tbTe(t)+longitude/360.0);var eqTime=tbFe(tnoon);var solNoonUTC=720+(longitude*4)-eqTime;var newt=tbbe(tbTe(t)-0.5+solNoonUTC/1440.0);eqTime=tbFe(newt);solNoonUTC=720+(longitude*4)-eqTime;return solNoonUTC;};function tbbIe(JD,latitude,longitude){var t=tbbe(JD);var noonmin=tbbve(t,longitude);var tnoon=tbbe(JD+noonmin/1440.0);var eqTime=tbFe(tnoon);var solarDec=tbde(tnoon);var hourAngle=tbbDe(latitude,solarDec);var delta=longitude-tbOe(hourAngle);var timeDiff=4*delta;var timeUTC=720+timeDiff-eqTime;var newt=tbbe(tbTe(t)+timeUTC/1440.0);eqTime=tbFe(newt);solarDec=tbde(newt);hourAngle=tbbDe(latitude,solarDec);delta=longitude-tbOe(hourAngle);timeDiff=4*delta;timeUTC=720+timeDiff-eqTime;return timeUTC;};function tbne(pl){var info=[4,3,2,1,0,2,3,4,5,6,6,5];var v=Math.floor(pl/30.0);return info[v];};function tbXe(v_val){if(v_val>=360){return(v_val-Math.floor(v_val/360.0)*360.0);}if(v_val<0){v_val=v_val+Math.floor(Math.abs(v_val/360.0)+1)*360;return v_val;}return v_val;};function tbbFe(day_chart,longitude_ecl,house_all,SAN_LONG){var house_longitude=[];for(i=1;i<13;i++){house_longitude[i]=house_all[i-1]*45/Math.atan(1);}Asc=house_longitude[1];Sun=longitude_ecl[0];Moon=longitude_ecl[1];Mercury=longitude_ecl[2];Venus=longitude_ecl[3];Mars=longitude_ecl[4];Jupiter=longitude_ecl[5];Saturn=longitude_ecl[6];var ExaltationDegree=[];ExaltationDegree[0]=19;ExaltationDegree[1]=33;ExaltationDegree[2]=135;ExaltationDegree[3]=357;ExaltationDegree[4]=298;ExaltationDegree[5]=105;ExaltationDegree[6]=201;var pars_description=[];pars_description[0]="<?php echo $translate_json['Life']; ?>";pars_description[1]="<?php echo $translate_json['Pillar of horoscope - Nativities, permanence, constancy']; ?>";pars_description[2]="<?php echo $translate_json['Reasoning and eloquence']; ?>";pars_description[3]="<?php echo $translate_json['Property']; ?>";pars_description[4]="<?php echo $translate_json['Debt']; ?>";pars_description[5]="<?php echo $translate_json['Treasure Trove']; ?>";pars_description[6]="<?php echo $translate_json['Brothers']; ?>";pars_description[7]="<?php echo $translate_json['Number of brothers']; ?>";pars_description[8]="<?php echo $translate_json['Death of brothers & sisters']; ?>";pars_description[9]="<?php echo $translate_json['Parents']; ?>";pars_description[10]="<?php echo $translate_json['Death of parents']; ?>";pars_description[11]="<?php echo $translate_json['Grandparents']; ?>";pars_description[12]="<?php echo $translate_json['Ancestors and relations']; ?>";pars_description[13]="<?php echo $translate_json['Ancestors and relations']; ?>";pars_description[14]="<?php echo $translate_json['Real estate acc. Hermes']; ?>";pars_description[15]="<?php echo $translate_json['Real estate acc. some Persians']; ?>";pars_description[16]="<?php echo $translate_json['Agriculture, tillage']; ?>";pars_description[17]="<?php echo $translate_json['Issue of affairs [end of matter]']; ?>";pars_description[18]="<?php echo $translate_json['Children']; ?>";pars_description[19]="<?php echo $translate_json['Time and number of sexes']; ?>";pars_description[20]="<?php echo $translate_json['Condition of males']; ?>";pars_description[21]="<?php echo $translate_json['Condition of females']; ?>";pars_description[22]="<?php echo $translate_json['Whether expected birth is male or female']; ?>";pars_description[23]="<?php echo $translate_json['Disease, defects, time of onset acc. Hermes']; ?>";pars_description[24]="<?php echo $translate_json['Disease, defects, time of onset acc. some of the ancients']; ?>";pars_description[25]="<?php echo $translate_json['Captivity']; ?>";pars_description[26]="<?php echo $translate_json['Slaves']; ?>";pars_description[27]="<?php echo $translate_json['Marriage of men acc. Hermes']; ?>";pars_description[28]="<?php echo $translate_json['Marriage of men acc. Vettius Valens']; ?>";pars_description[29]="<?php echo $translate_json['Trickery and deception of men and women']; ?>";pars_description[30]="<?php echo $translate_json['Intercourse']; ?>";pars_description[31]="<?php echo $translate_json['Marriage of women (Hermes)']; ?>";pars_description[32]="<?php echo $translate_json['Marriage of women (Valens)']; ?>";pars_description[33]="<?php echo $translate_json['Misconduct by women']; ?>";pars_description[34]="<?php echo $translate_json['Trickery and deceit of men by women']; ?>";pars_description[35]="<?php echo $translate_json['Intercourse']; ?>";pars_description[36]="<?php echo $translate_json['Unchastity of women']; ?>";pars_description[37]="<?php echo $translate_json['Chastity of women']; ?>";pars_description[38]="<?php echo $translate_json['Marriage of men and women acc. Hermes']; ?>";pars_description[39]="<?php echo $translate_json['Time of marriage (Hermes)']; ?>";pars_description[40]="<?php echo $translate_json['Fraudulent marriage & Facilitating it']; ?>";pars_description[41]="<?php echo $translate_json['Sons in law']; ?>";pars_description[42]="<?php echo $translate_json['Lawsuits']; ?>";pars_description[43]="<?php echo $translate_json['Death']; ?>";pars_description[44]="<?php echo $translate_json['Anairetai [anareta: destroyer]']; ?>";pars_description[45]="<?php echo $translate_json['Year to be feared at birth for death, famine']; ?>";pars_description[46]="<?php echo $translate_json['Place of murder and sickness']; ?>";pars_description[47]="<?php echo $translate_json['Danger of violence']; ?>";pars_description[48]="<?php echo $translate_json['Journeys']; ?>";pars_description[49]="<?php echo $translate_json['By water']; ?>";pars_description[50]="<?php echo $translate_json['Timidity and hiding']; ?>";pars_description[51]="<?php echo $translate_json['Deep reflection']; ?>";pars_description[52]="<?php echo $translate_json['Understanding and wisdom']; ?>";pars_description[53]="<?php echo $translate_json['Traditions, knowledge of affairs']; ?>";pars_description[54]="<?php echo $translate_json['Knowledge whether true or false']; ?>";pars_description[55]="<?php echo $translate_json['Noble births']; ?>";pars_description[56]="<?php echo $translate_json['Kings and Sultans']; ?>";pars_description[57]="<?php echo $translate_json['Administrators, vazirs [ministers], etc.']; ?>";pars_description[58]="<?php echo $translate_json['Sultan\'s victory, conquest']; ?>";pars_description[59]="<?php echo $translate_json['Of those who rise in station']; ?>";pars_description[60]="<?php echo $translate_json['Celebrated persons of rank']; ?>";pars_description[61]="<?php echo $translate_json['Armies and police']; ?>";pars_description[62]="<?php echo $translate_json['Sultan. Those concerned In nativities']; ?>";pars_description[63]="<?php echo $translate_json['Merchants and their work']; ?>";pars_description[64]="<?php echo $translate_json['Buying and selling']; ?>";pars_description[65]="<?php echo $translate_json['Operations and orders in medical Treatment']; ?>";pars_description[66]="<?php echo $translate_json['Mothers']; ?>";pars_description[67]="<?php echo $translate_json['Glory']; ?>";pars_description[68]="<?php echo $translate_json['Friendship and enmity']; ?>";pars_description[69]="<?php echo $translate_json['Known by men and revered, Constant in affairs']; ?>";pars_description[70]="<?php echo $translate_json['Success']; ?>";pars_description[71]="<?php echo $translate_json['Worldliness']; ?>";pars_description[72]="<?php echo $translate_json['Hope']; ?>";pars_description[73]="<?php echo $translate_json['Friends']; ?>";pars_description[74]="<?php echo $translate_json['Violence']; ?>";pars_description[75]="<?php echo $translate_json['Abundance in house']; ?>";pars_description[76]="<?php echo $translate_json['Liberty of Person']; ?>";pars_description[77]="<?php echo $translate_json['Praise and acceptation']; ?>";pars_description[78]="<?php echo $translate_json['Enmity acc. some of the ancients']; ?>";pars_description[79]="<?php echo $translate_json['Enmity acc. Hermes']; ?>";pars_description[80]="<?php echo $translate_json['Bad luck']; ?>";pars_description[81]="<?php echo $translate_json['Fortune or Lunar horoscope']; ?>";pars_description[82]="<?php echo $translate_json['Daemon and religion [Spirit]']; ?>";pars_description[83]="<?php echo $translate_json['Friendship and love']; ?>";pars_description[84]="<?php echo $translate_json['Despair & penury & fraud']; ?>";pars_description[85]="<?php echo $translate_json['Captivity, prisons and escape therefrom']; ?>";pars_description[86]="<?php echo $translate_json['Victory, triumph & aid']; ?>";pars_description[87]="<?php echo $translate_json['Valour and bravery']; ?>";pars_description[88]="<?php echo $translate_json['Hailaj [Hyleg, life-giver]']; ?>";pars_description[89]="<?php echo $translate_json['Debilitated bodies']; ?>";pars_description[90]="<?php echo $translate_json['Horsemanship, bravery']; ?>";pars_description[91]="<?php echo $translate_json['Boldness, violence and murder']; ?>";pars_description[92]="<?php echo $translate_json['Trickery and deceit']; ?>";pars_description[93]="<?php echo $translate_json['Necessity and wish']; ?>";pars_description[94]="<?php echo $translate_json['Requirements and necessities acc. Egyptians']; ?>";pars_description[95]="<?php echo $translate_json['Realisation of needs and desires']; ?>";pars_description[96]="<?php echo $translate_json['Retribution']; ?>";pars_description[97]="<?php echo $translate_json['Rectitude']; ?>";var pars_n=[];if(day_chart>0){lord_of_time=Sun;Fortune=tbXe(Asc+Moon-Sun);Spirit=tbXe(Asc+Sun-Moon);pars_n[0]=tbXe(Asc+Saturn-Jupiter);pars_n[1]=tbXe(Asc+Spirit-Fortune);pars_n[2]=tbXe(Asc+Mars-Mercury);ruler=tbne(house_longitude[2]);pars_n[3]=tbXe(Asc+house_longitude[2]-longitude_ecl[ruler]);pars_n[4]=tbXe(Asc+Mercury-Saturn);pars_n[5]=tbXe(Asc+Venus-Mercury);pars_n[6]=tbXe(Asc+Jupiter-Saturn);pars_n[7]=tbXe(Asc+Saturn-Mercury);pars_n[8]=tbXe(Asc+70-Sun);dif=Math.abs(Sun-Saturn);if(dif>180){dif=360-dif;}if(dif>15){pars_n[9]=tbXe(Asc+Saturn-Sun);}else{pars_n[9]=tbXe(Asc+Saturn-Jupiter);}pars_n[10]=tbXe(Asc+Jupiter-Saturn);pars_n[11]=tbXe(Asc+Saturn-house_longitude[2]);pars_n[12]=tbXe(Asc+Mars-Saturn);pars_n[13]=tbXe(Asc+Mars-Saturn);pars_n[14]=tbXe(Asc+Moon-Saturn);pars_n[15]=tbXe(Asc+Jupiter-Mercury);pars_n[16]=tbXe(Asc+Saturn-Venus);ruler=tbne(SAN_LONG);pars_n[17]=tbXe(Asc+longitude_ecl[ruler]-Saturn);pars_n[18]=tbXe(Asc+Saturn-Jupiter);pars_n[19]=tbXe(Asc+Jupiter-Mars);pars_n[20]=tbXe(Asc+Jupiter-Mars);pars_n[21]=tbXe(Asc+Venus-Moon);ruler=tbne(Moon);pars_n[22]=tbXe(Asc+Moon-longitude_ecl[ruler]);pars_n[23]=tbXe(Asc+Mars-Saturn);pars_n[24]=tbXe(Asc+Mars-Mercury);ruler=tbne(lord_of_time);pars_n[25]=tbXe(Asc+longitude_ecl[ruler]-lord_of_time);pars_n[26]=tbXe(Asc+Moon-Mercury);pars_n[27]=tbXe(Asc+Venus-Saturn);pars_n[28]=tbXe(Asc+Venus-Sun);pars_n[29]=tbXe(Asc+Venus-Sun);pars_n[30]=tbXe(Asc+Venus-Sun);pars_n[31]=tbXe(Asc+Saturn-Venus);pars_n[32]=tbXe(Asc+Mars-Moon);pars_n[33]=tbXe(Asc+Mars-Moon);pars_n[34]=tbXe(Asc+Mars-Moon);pars_n[35]=tbXe(Asc+Mars-Moon);pars_n[36]=tbXe(Asc+Mars-Moon);pars_n[37]=tbXe(Asc+Venus-Moon);pars_n[38]=tbXe(Asc+house_longitude[7]-Venus);pars_n[39]=tbXe(Asc+Moon-Sun);pars_n[40]=tbXe(Asc+Venus-Saturn);pars_n[41]=tbXe(Asc+Venus-Saturn);pars_n[42]=tbXe(Asc+Jupiter-Mars);pars_n[43]=tbXe(Saturn+house_longitude[8]-Moon);ruler=tbne(Asc);pars_n[44]=tbXe(Asc+Moon-longitude_ecl[ruler]);ruler=tbne(SAN_LONG);pars_n[45]=tbXe(Asc+longitude_ecl[ruler]-Saturn);pars_n[46]=tbXe(Mercury+Mars-Saturn);pars_n[47]=tbXe(Asc+Mercury-Saturn);ruler=tbne(house_longitude[9]);pars_n[48]=tbXe(Asc+house_longitude[9]-longitude_ecl[ruler]);pars_n[49]=tbXe(Asc+105-Saturn);pars_n[50]=tbXe(Asc+Mercury-Moon);pars_n[51]=tbXe(Asc+Moon-Saturn);pars_n[52]=tbXe(Asc+Sun-Saturn);pars_n[53]=tbXe(Asc+Jupiter-Sun);pars_n[54]=tbXe(Asc+Moon-Mercury);pars_n[55]=tbXe(Asc+ExaltationDegree[lord_of_time]-lord_of_time);pars_n[56]=tbXe(Asc+Mars-Mercury);pars_n[57]=tbXe(Asc+Mars-Mercury);pars_n[58]=tbXe(Asc+Saturn-Sun);pars_n[59]=tbXe(Asc+Fortune-Saturn);pars_n[60]=tbXe(Asc+Sun-Saturn);pars_n[61]=tbXe(Asc+Saturn-Mars);pars_n[62]=tbXe(Asc+Moon-Saturn);pars_n[63]=tbXe(Asc+Venus-Mercury);pars_n[64]=tbXe(Asc+Fortune-Spirit);pars_n[65]=tbXe(Asc+Jupiter-Sun);pars_n[66]=tbXe(Asc+Moon-Venus);pars_n[67]=tbXe(Asc+Spirit-Fortune);pars_n[68]=tbXe(Asc+Spirit-Fortune);pars_n[69]=tbXe(Asc+Sun-Fortune);pars_n[70]=tbXe(Asc+Jupiter-Fortune);pars_n[71]=tbXe(Asc+Venus-Fortune);pars_n[72]=tbXe(Asc+Mercury-Jupiter);pars_n[73]=tbXe(Asc+Mercury-Moon);pars_n[74]=tbXe(Asc+Mercury-Spirit);pars_n[75]=tbXe(Asc+Sun-Moon);pars_n[76]=tbXe(Asc+Sun-Mercury);pars_n[77]=tbXe(Asc+Venus-Jupiter);pars_n[78]=tbXe(Asc+Mars-Saturn);ruler=tbne(house_longitude[12]);pars_n[79]=tbXe(Asc+house_longitude[12]-longitude_ecl[ruler]);pars_n[80]=tbXe(Asc+Fortune-Spirit);pars_n[81]=tbXe(Asc+Moon-Sun);pars_n[82]=tbXe(Asc+Sun-Moon);pars_n[83]=tbXe(Asc+Spirit-Fortune);pars_n[84]=tbXe(Asc+Fortune-Spirit);pars_n[85]=tbXe(Asc+Fortune-Saturn);pars_n[86]=tbXe(Asc+Jupiter-Spirit);pars_n[87]=tbXe(Asc+Fortune-Mars);pars_n[88]=tbXe(Asc+Moon-SAN_LONG);pars_n[89]=tbXe(Asc+Mars-Fortune);pars_n[90]=tbXe(Asc+Moon-Saturn);ruler=tbne(Asc);pars_n[91]=tbXe(Asc+Moon-longitude_ecl[ruler]);pars_n[92]=tbXe(Asc+Spirit-Mercury);pars_n[93]=tbXe(Asc+Mars-Saturn);pars_n[94]=tbXe(Asc+house_longitude[3]-Mars);pars_n[95]=tbXe(Asc+Mercury-Fortune);pars_n[96]=tbXe(Asc+Sun-Mars);pars_n[97]=tbXe(Asc+Mars-Mercury);}else{lord_of_time=Moon;Fortune=tbXe(Asc-Moon+Sun);Spirit=tbXe(Asc-Sun+Moon);pars_n[0]=tbXe(Asc-Saturn+Jupiter);pars_n[1]=tbXe(Asc-Spirit+Fortune);pars_n[2]=tbXe(Asc-Mars+Mercury);ruler=tbne(house_longitude[2]);pars_n[3]=tbXe(Asc-house_longitude[2]+longitude_ecl[ruler]);pars_n[4]=tbXe(Asc-Mercury+Saturn);pars_n[5]=tbXe(Asc+Venus-Mercury);pars_n[6]=tbXe(Asc+Jupiter-Saturn);pars_n[7]=tbXe(Asc+Saturn-Mercury);pars_n[8]=tbXe(Asc-70+Sun);dif=Math.abs(Sun-Saturn);if(dif>180){dif=360-dif;}if(dif>15){pars_n[9]=tbXe(Asc-Saturn+Sun);}else{pars_n[9]=tbXe(Asc-Saturn+Jupiter);}pars_n[10]=tbXe(Asc-Jupiter+Saturn);pars_n[11]=tbXe(Asc-Saturn+house_longitude[2]);pars_n[12]=tbXe(Asc-Mars+Saturn);pars_n[13]=tbXe(Asc-Mars+Saturn);pars_n[14]=tbXe(Asc-Moon+Saturn);pars_n[15]=tbXe(Asc-Jupiter+Mercury);pars_n[16]=tbXe(Asc+Saturn-Venus);ruler=tbne(SAN_LONG);pars_n[17]=tbXe(Asc+longitude_ecl[ruler]-Saturn);pars_n[18]=tbXe(Asc-Saturn+Jupiter);pars_n[19]=tbXe(Asc+Jupiter-Mars);pars_n[20]=tbXe(Asc+Jupiter-Mars);pars_n[21]=tbXe(Asc+Venus-Moon);ruler=tbne(Moon);pars_n[22]=tbXe(Asc-Moon+longitude_ecl[ruler]);pars_n[23]=tbXe(Asc-Mars+Saturn);pars_n[24]=tbXe(Asc+Mars-Mercury);ruler=tbne(lord_of_time);pars_n[25]=tbXe(Asc+longitude_ecl[ruler]-lord_of_time);pars_n[26]=tbXe(Asc+Moon-Mercury);pars_n[27]=tbXe(Asc+Venus-Saturn);pars_n[28]=tbXe(Asc+Venus-Sun);pars_n[29]=tbXe(Asc+Venus-Sun);pars_n[30]=tbXe(Asc+Venus-Sun);pars_n[31]=tbXe(Asc+Saturn-Venus);pars_n[32]=tbXe(Asc+Mars-Moon);pars_n[33]=tbXe(Asc+Mars-Moon);pars_n[34]=tbXe(Asc+Mars-Moon);pars_n[35]=tbXe(Asc+Mars-Moon);pars_n[36]=tbXe(Asc+Mars-Moon);pars_n[37]=tbXe(Asc+Venus-Moon);pars_n[38]=tbXe(Asc+house_longitude[7]-Venus);pars_n[39]=tbXe(Asc+Moon-Sun);pars_n[40]=tbXe(Asc+Venus-Saturn);pars_n[41]=tbXe(Asc-Venus+Saturn);pars_n[42]=tbXe(Asc-Jupiter+Mars);pars_n[43]=tbXe(Saturn+house_longitude[8]-Moon);ruler=tbne(Asc);pars_n[44]=tbXe(Asc-Moon+longitude_ecl[ruler]);ruler=tbne(SAN_LONG);pars_n[45]=tbXe(Asc+longitude_ecl[ruler]-Saturn);pars_n[46]=tbXe(Mercury-Mars+Saturn);pars_n[47]=tbXe(Asc-Mercury+Saturn);ruler=tbne(house_longitude[9]);pars_n[48]=tbXe(Asc+house_longitude[9]-longitude_ecl[ruler]);pars_n[49]=tbXe(Asc-105+Saturn);pars_n[50]=tbXe(Asc-Mercury+Moon);pars_n[51]=tbXe(Asc-Moon+Saturn);pars_n[52]=tbXe(Asc-Sun+Saturn);pars_n[53]=tbXe(Asc-Jupiter+Sun);pars_n[54]=tbXe(Asc+Moon-Mercury);pars_n[55]=tbXe(Asc-ExaltationDegree[lord_of_time]+lord_of_time);pars_n[56]=tbXe(Asc-Mars+Mercury);pars_n[57]=tbXe(Asc-Mars+Mercury);pars_n[58]=tbXe(Asc-Saturn+Sun);pars_n[59]=tbXe(Asc-Fortune+Saturn);pars_n[60]=tbXe(Asc+Sun-Saturn);pars_n[61]=tbXe(Asc-Saturn+Mars);pars_n[62]=tbXe(Asc+Moon-Saturn);pars_n[63]=tbXe(Asc-Venus+Mercury);pars_n[64]=tbXe(Asc-Fortune+Spirit);pars_n[65]=tbXe(Asc-Jupiter+Sun);pars_n[66]=tbXe(Asc-Moon+Venus);pars_n[67]=tbXe(Asc-Spirit+Fortune);pars_n[68]=tbXe(Asc-Spirit+Fortune);pars_n[69]=tbXe(Asc-Sun+Fortune);pars_n[70]=tbXe(Asc-Jupiter+Fortune);pars_n[71]=tbXe(Asc-Venus+Fortune);pars_n[72]=tbXe(Asc-Mercury+Jupiter);pars_n[73]=tbXe(Asc+Mercury-Moon);pars_n[74]=tbXe(Asc+Mercury-Spirit);pars_n[75]=tbXe(Asc+Sun-Moon);pars_n[76]=tbXe(Asc-Sun+Mercury);pars_n[77]=tbXe(Asc-Venus+Jupiter);pars_n[78]=tbXe(Asc+Mars-Saturn);ruler=tbne(house_longitude[12]);pars_n[79]=tbXe(Asc+house_longitude[12]-longitude_ecl[ruler]);pars_n[80]=tbXe(Asc+Fortune-Spirit);pars_n[81]=tbXe(Asc-Moon+Sun);pars_n[82]=tbXe(Asc-Sun+Moon);pars_n[83]=tbXe(Asc-Spirit+Fortune);pars_n[84]=tbXe(Asc-Fortune+Spirit);pars_n[85]=tbXe(Asc-Fortune+Saturn);pars_n[86]=tbXe(Asc-Jupiter+Spirit);pars_n[87]=tbXe(Asc-Fortune+Mars);pars_n[88]=tbXe(Asc+Moon-SAN_LONG);pars_n[89]=tbXe(Asc-Mars+Fortune);pars_n[90]=tbXe(Asc-Moon+Saturn);ruler=tbne(Asc);pars_n[91]=tbXe(Asc-Moon+longitude_ecl[ruler]);pars_n[92]=tbXe(Asc-Spirit+Mercury);pars_n[93]=tbXe(Asc+Mars-Saturn);pars_n[94]=tbXe(Asc+house_longitude[3]-Mars);pars_n[95]=tbXe(Asc+Mercury-Fortune);pars_n[96]=tbXe(Asc-Sun+Mars);pars_n[97]=tbXe(Asc-Mars+Mercury);}var res=[];res[0]=pars_description;res[1]=pars_n;return res;};TWOPI=Math.PI*2;fssw_P=Math.PI/180;fssw_af=180.0/Math.PI;J2000=2451545.0;B1950=2433282.42345905;J1900=2415020.0;var aya_systems=[[2433282.5,24.042044444,false],[2435553.5,23.250182778-0.004660222,false],[J1900,360-333.58695,false],[J1900,360-338.98556,false],[J1900,360-341.33904,false],[J1900,360-337.636111,false],[J1900,360-333.0369024,false],[J1900,360-338.917778,false],[J1900,360-338.634444,false],[1674484,-9.33333,true],[1927135.8747793,0,true],[J2000,0,false],[J1900,0,false],[B1950,0,false]];function tbaGe(J){T=(J-2451545.0)/36525.0;T/=10.0;eps=(((((((((2.45e-10*T+5.79e-9)*T+2.787e-7)*T+7.12e-7)*T-3.905e-5)*T-2.4967e-3)*T-5.138e-3)*T+1.99925)*T-0.0155)*T-468.093)*T+84381.448;eps*=fssw_P/3600.0;return(eps);};function tbNe(R,J,direction,fssw_F){var x=[0,0,0];if(J==J2000){return x;}T=(J-J2000)/36525.0;if(fssw_F==0){Z1=((0.017998*T+0.30188)*T+2306.2181)*T*fssw_P/3600;Z2=((0.018203*T+1.09468)*T+2306.2181)*T*fssw_P/3600;TH=((-0.041833*T-0.42665)*T+2004.3109)*T*fssw_P/3600;}else if(fssw_F==1){Z1=(((((-0.0000002*T-0.0000327)*T+0.0179663)*T+0.3019015)*T+2306.0809506)*T+2.5976176)*fssw_P/3600;Z2=(((((-0.0000003*T-0.000047)*T+0.0182237)*T+1.0947790)*T+2306.0803226)*T-2.5976176)*fssw_P/3600;TH=((((-0.0000001*T-0.0000601)*T-0.0418251)*T-0.4269353)*T+2004.1917476)*T*fssw_P/3600;}else if(fssw_F==2){T=(J-J2000)/36525.0;Z1=(((((-0.0000003173*T-0.000005971)*T+0.01801828)*T+0.2988499)*T+2306.083227)*T+2.650545)*fssw_P/3600;Z2=(((((-0.0000002904*T-0.000028596)*T+0.01826837)*T+1.0927348)*T+2306.077181)*T-2.650545)*fssw_P/3600;TH=((((-0.00000011274*T-0.000007089)*T-0.04182264)*T-0.4294934)*T+2004.191903)*T*fssw_P/3600;}else if(fssw_F==3){Z1=((((((-0.00000000013*T-0.0000003040)*T-0.000005708)*T+0.01801752)*T+0.3023262)*T+2306.080472)*T+2.72767)*fssw_P/3600;Z2=((((((-0.00000000005*T-0.0000002486)*T-0.000028276)*T+0.01826676)*T+1.0956768)*T+2306.076070)*T-2.72767)*fssw_P/3600;TH=((((((0.000000000009*T+0.00000000036)*T-0.0000001127)*T-0.000007291)*T-0.04182364)*T-0.4266980)*T+2004.190936)*T*fssw_P/3600;}else{return x;}sinth=Math.sin(TH);costh=Math.cos(TH);sinZ1=Math.sin(Z1);cosZ1=Math.cos(Z1);sinZ2=Math.sin(Z2);cosZ2=Math.cos(Z2);A=cosZ1*costh;B=sinZ1*costh;if(direction<0){x[0]=(A*cosZ2-sinZ1*sinZ2)*R[0]-(B*cosZ2+cosZ1*sinZ2)*R[1]-sinth*cosZ2*R[2];x[1]=(A*sinZ2+sinZ1*cosZ2)*R[0]-(B*sinZ2-cosZ1*cosZ2)*R[1]-sinth*sinZ2*R[2];x[2]=cosZ1*sinth*R[0]-sinZ1*sinth*R[1]+costh*R[2];}else{x[0]=(A*cosZ2-sinZ1*sinZ2)*R[0]+(A*sinZ2+sinZ1*cosZ2)*R[1]+cosZ1*sinth*R[2];x[1]= -(B*cosZ2+cosZ1*sinZ2)*R[0]-(B*sinZ2-cosZ1*cosZ2)*R[1]-sinZ1*sinth*R[2];x[2]= -sinth*cosZ2*R[0]-sinth*sinZ2*R[1]+costh*R[2];}return x;};function tbbLe(xpo,eps){var x=[0,0,0];var xpn=[0,0,0];sineps=Math.sin(eps);coseps=Math.cos(eps);x[0]=xpo[0];x[1]=xpo[1]*coseps+xpo[2]*sineps;x[2]= -xpo[1]*sineps+xpo[2]*coseps;xpn[0]=x[0];xpn[1]=x[1];xpn[2]=x[2];return xpn;};function tbbne(x){var ll=[0,0,0];var l=[0,0,0];if(x[0]==0&&x[1]==0&&x[2]==0){l[0]=l[1]=l[2]=0;return;}rxy=x[0]*x[0]+x[1]*x[1];ll[2]=Math.sqrt(rxy+x[2]*x[2]);rxy=Math.sqrt(rxy);ll[0]=Math.atan2(x[1],x[0]);if(ll[0]<0.0)ll[0]+=TWOPI;if(rxy==0){if(x[2]>=0)ll[1]=PI/2;else ll[1]= -(PI/2);}else{ll[1]=Math.atan(x[2]/rxy);}l[0]=ll[0];l[1]=ll[1];l[2]=ll[2];return ll;};function tbbJe(x){y=Math.floor(x/360.0);y=x-360*y;if(Math.abs(y)<1e-13){y=0;}if(y<0.0){y+=360.0;}return y;};function tbame(tjd_et,sys){var x=[0,0,0];var res=[0,0,0];x[0]=1;x[1]=0;x[2]=0;if(tjd_et!=J2000){res=tbNe(x,tjd_et,1,3);}sip_t0=aya_systems[sys][0];fssw_bx=aya_systems[sys][2];fssw_ar=aya_systems[sys][1];t0=sip_t0;if(fssw_bx){t0+=dT(t0);}x=tbNe(res,t0,-1,3);eps=tbaGe(t0);res=tbbLe(x,eps);x=tbbne(res);x[0]=x[0]*fssw_af-fssw_ar;daya=tbbJe(-x[0]);return daya;};function dT(jd){y=tbaie(jd);var c= -0.000012932*Math.pow((y-1955),2);var dt=0,u=0,t=0;t2=t*t;t3=t*t*t;t4=t*t*t*t;t5=t4*t;t6=t5*t;t7=t6*t;if(y<= -500){u=(y-1820)/100;dt= -20+32*u*u+c;}else if(y< -500&&y<=500){u=y/100;dt=10583.6-1014.41*u+33.78311*u*u-5.952053*u*u*u-0.1798452*u*u*u*u+0.022174192*u*u*u*u*u+0.0090316521*u*u*u*u*u*u+c;}else if(y>500&&y<=1600){u=(y-1000)/100;dt=1574.2-556.01*u+71.23472*u*u+0.319781*u*u*u-0.8503463*u*u*u*u-0.005050998*u*u*u*u*u+0.0083572073*u*u*u*u*u*u+c;}else if(y>1600&&y<=1700){t=(y-1600);dt=120-0.9808*t-0.01532*t2+t3/7129+c;}else if(y>1700&&y<=1800){t=(y-1800);dt=13.72-0.332447*t+0.0068612*t2+0.0041116*t3-0.00037436*t4+0.0000121272*t5-0.0000001699*t6+0.000000000875*t7+c;}else if(y>1860&&y<=1900){t=(y-1860);dt=7.62+0.5737*t-0.251754*t2+0.01680668*t3-0.0004473624*t4+t5/233174+c;}else if(y>1900&&y<=1920){t=(y-1920);dt=21.20+0.84493*t-0.076100*t2+0.0020936*t3+c;}else if(y>1941&&y<=1961){t=(y-1950);dt=29.07+0.407*t-t2/233+t3/2547;}else if(y>1961&&y<=1986){t=(y-1975);dt=45.45+1.067*t-t2/260-t3/718;}else if(y>1986&&y<=2005){t=(y-2000);dt=3.86+0.3345*t-0.060374*t2+0.0017275*t3+0.000651814*t4+0.00002373599*t5;}else if(y>2005&&y<=2050){t=(y-2000);dt=62.92+0.32217*t+0.005589*t2+c;}else if(y>2050&&y<=2150){dt= -20+32*((y-1820)/100)*((y-1820)/100)-0.5628*(2150-y)+c;}else if(y>2150){u=(y-1820)/100;dt= -20+32*u*u+c;}return(dt/86400);};function tbaie(jd){var jd0,u0,u1,u2,u3,u4,jyear,jmon,jday,hr,mn,sc,fssw_p,fssw_L;u0=0;u1=0;u2=0;u3=0;u4=0;jd0=jd;u0=jd0+32082.5;if(jd0>2299160){u1=u0+Math.floor(u0/36525.0)-Math.floor(u0/146100.0)-38.0;if(jd0>=1830691.5)u1+=1;u0=u0+Math.floor(u1/36525.0)-Math.floor(u1/146100.0)-38.0;}u2=Math.floor(u0+123.0);u3=Math.floor((u2-122.2)/365.25);u4=Math.floor((u2-Math.floor(365.25*u3))/30.6001);jmon=(u4-1.0);if(jmon>12)jmon-=12;jday=(u2-Math.floor(365.25*u3)-Math.floor(30.6001*u4));jyear=(u3+Math.floor((u4-2.0)/12.0)-4800);fssw_p=(jd0-Math.floor(jd0+0.5)+0.5)*24.0;hr=Math.floor(fssw_p);fssw_L=(fssw_p-hr)*60;mn=Math.floor(fssw_L);sc=Math.floor((fssw_L-mn)*60+0.5);if(sc==60){sc=0;mn+=1;}if(mn==60){mn=0;hr+=1;}return(jyear+jmon/12);};pars_names=["Pars Futurorum - Daemon and religion","Pars Fortun&aelig; - Fortune or Lunar horoscope","Pars Mercurii - Despair, penury and fraud","Pars Veneris - Friendship and love","Pars Martis - Valour and bravery","Pars Iovis - Victory, triumph and aid","Pars Saturni - Captivity, prisons and escape","Pars Hyleg - Part of the Root of Life"];phases_names=["New Moon","First quarter","Full Moon","Last quarter","New Moon"];var rasi_name=[];rasi_name[1]="Mesha";rasi_name[2]="Vrisha";rasi_name[3]="Mithuna";rasi_name[4]="Karka";rasi_name[5]="Simha";rasi_name[6]="Kanya";rasi_name[7]="Tula";rasi_name[8]="Vrischika";rasi_name[9]="Dhanu";rasi_name[10]="Makar";rasi_name[11]="Kumbha";rasi_name[12]="Meena";var navagraha=[];navagraha[1]="Surya Deva";navagraha[2]="Chandra";navagraha[3]="Budha";navagraha[4]="Shukra";navagraha[5]="Mangala";navagraha[6]="Guru";navagraha[7]="Shani";navagraha[8]="Rahu";navagraha[9]="Ketu";var bhava_name=[];bhava_name[1]="Lagna";bhava_name[2]="Dhana";bhava_name[3]="Parakrama";bhava_name[4]="Suhrda";bhava_name[5]="Suta";bhava_name[6]="Ripu/Roga";bhava_name[7]="Kama";bhava_name[8]="Mrtyu";bhava_name[9]="Bhagya";bhava_name[10]="Karma";bhava_name[11]="Aya";bhava_name[12]="Vyaya";nakshatra_name=[];nakshatra_name[1]="Ashwini";nakshatra_name[2]="Bharani";nakshatra_name[3]="Krittika";nakshatra_name[4]="Rohini";nakshatra_name[5]="Mrigshirsha";nakshatra_name[6]="Ardra";nakshatra_name[7]="Punarvasu";nakshatra_name[8]="Pushya";nakshatra_name[9]="Ashlesha";nakshatra_name[10]="Magha";nakshatra_name[11]="Purvaphalguni";nakshatra_name[12]="Uttaraphalguni";nakshatra_name[13]="Hasta";nakshatra_name[14]="Chitra";nakshatra_name[15]="Swati";nakshatra_name[16]="Vishakha";nakshatra_name[17]="Anuradha";nakshatra_name[18]="Jyeshtha";nakshatra_name[19]="Mula";nakshatra_name[20]="Purvashadha";nakshatra_name[21]="Uttarashadha";nakshatra_name[22]="Shravana";nakshatra_name[23]="Dhanishtha";nakshatra_name[24]="Shatbhisha";nakshatra_name[25]="Poorvabhadrapada";nakshatra_name[26]="Uttarabhadrapada";nakshatra_name[27]="Revati";nakshatra_name[28]="Abhijit";function tbfe(v){if(v<0.0){v+=360;}if(v>360){v-=360;}return v;};function tbbEe(rasi,sundeg){pada=rasi%(360/27);if(pada<=(360/108)){code=1;}else if(pada<=(360/54)){code=2;}else if(pada<=10.0){code=3;}else{code=4;}Pada=code;str="";code=0;diff=0.0;diff=rasi-sundeg;if(diff<0){diff=diff+360;}if(diff<=12){code=1;str="Sukla Padyami";}else if(diff<=24){code=2;str="Sukla Vidiya";}else if(diff<=36){code=3;str="Sukla Tadiya";}else if(diff<=48){code=4;str="Sukla Chaviti";}else if(diff<=60){code=5;str="Sukla Panchami";}else if(diff<=72){code=6;str="Sukla Sashti";}else if(diff<=84){code=7;str="Sukla Saptami";}else if(diff<=96){code=8;str="Sukla Ashtami";}else if(diff<=108){code=9;str="Sukla Navami";}else if(diff<=120){code=10;str="Sukla Dasami";}else if(diff<=132){code=11;str="Sukla Ekadasi";}else if(diff<=144){code=12;str="Sukla Dwadasi";}else if(diff<=156){code=13;str="Sukla Trayodasi";}else if(diff<=168){code=14;str="Sukla Chaturdasi";}else if(diff<=180){code=15;str="Pournami";}else if(diff<=192){code=16;str="Krishna Padyami";}else if(diff<=204){code=17;str="Krishna Vidiya";}else if(diff<=216){code=18;str="Krishna Tadiya";}else if(diff<=228){code=19;str="Krishna Chaviti";}else if(diff<=240){code=20;str="Krishna Panchami";}else if(diff<=252){code=21;str="Krishna Sashti";}else if(diff<=264){code=22;str="Krishna Saptami";}else if(diff<=276){code=23;str="Krishna Ashtami";}else if(diff<=288){code=24;str="Krishna Navami";}else if(diff<=300){code=25;str="Krishna Dasami";}else if(diff<=312){code=26;str="Krishna Ekadasi";}else if(diff<=324){code=27;str="Krishna Dwadasi";}else if(diff<=336){code=28;str="Krishna Trayodasi";}else if(diff<=348){code=29;str="Krishna Chaturdasi";}else{code=30;str="Amavasya";}Thiti=str;str="";code=0;diff=0.0;diff=rasi-sundeg;if(diff<0){diff=diff+360;}if(diff<=6){code=1;}else if(diff<=12){code=2;}else if(diff<=18){code=3;}else if(diff<=24){code=4;}else if(diff<=30){code=5;}else if(diff<=36){code=6;}else if(diff<=42){code=7;}else if(diff<=48){code=8;}else if(diff<=54){code=2;}else if(diff<=60){code=3;}else if(diff<=66){code=4;}else if(diff<=72){code=5;}else if(diff<=78){code=6;}else if(diff<=84){code=7;}else if(diff<=90){code=8;}else if(diff<=96){code=2;}else if(diff<=102){code=3;}else if(diff<=108){code=4;}else if(diff<=114){code=5;}else if(diff<=120){code=6;}else if(diff<=126){code=7;}else if(diff<=132){code=8;}else if(diff<=138){code=2;}else if(diff<=144){code=3;}else if(diff<=150){code=4;}else if(diff<=156){code=5;}else if(diff<=162){code=6;}else if(diff<=168){code=7;}else if(diff<=174){code=8;}else if(diff<=180){code=2;}else if(diff<=186){code=3;}else if(diff<=192){code=4;}else if(diff<=198){code=5;}else if(diff<=204){code=6;}else if(diff<=210){code=7;}else if(diff<=216){code=8;}else if(diff<=222){code=2;}else if(diff<=228){code=3;}else if(diff<=234){code=4;}else if(diff<=240){code=5;}else if(diff<=246){code=6;}else if(diff<=252){code=7;}else if(diff<=258){code=8;}else if(diff<=264){code=2;}else if(diff<=270){code=3;}else if(diff<=276){code=4;}else if(diff<=282){code=5;}else if(diff<=288){code=6;}else if(diff<=294){code=7;}else if(diff<=300){code=8;}else if(diff<=306){code=2;}else if(diff<=312){code=3;}else if(diff<=318){code=4;}else if(diff<=324){code=5;}else if(diff<=330){code=6;}else if(diff<=336){code=7;}else if(diff<=342){code=8;}else if(diff<=348){code=9;}else if(diff<=354){code=10;}else{code=11;}if(code==1){str="Kimsthugnam";}else if(code==2){str="Bava";}else if(code==3){str="Baalava";}else if(code==4){str="Koulava";}else if(code==5){str="Taitula";}else if(code==6){str="Garaji";}else if(code==7){str="Vanija";}else if(code==8){str="Bhadra(Vishti)";}else if(code==9){str="Sakuni";}else if(code==10){str="Chatushpaat";}else if(code==11){str="Naagavam";}Karana=str;str="";code=0;sum=0.0;sum=rasi+sundeg;if(sum>360)sum=sum-360;if(sum<=13.3333){code=1;str="Vishkambha";}else if(sum<=26.6666){code=2;str="Preeti";}else if(sum<=40){code=3;str="Ayushman";}else if(sum<=53.3333){code=4;str="Soubhagya";}else if(sum<=66.6666){code=5;str="Sobhana";}else if(sum<=80){code=6;str="Atiganda";}else if(sum<=93.3333){code=7;str="Sukarma";}else if(sum<=106.6666){code=8;str="Dhriti";}else if(sum<=120){code=9;str="Soola";}else if(sum<=133.3333){code=10;str="Ganda";}else if(sum<=146.6666){code=11;str="Vriddhi";}else if(sum<=160){code=12;str="Dhruva";}else if(sum<=173.3333){code=13;str="Vyaghata";}else if(sum<=186.6666){code=14;str="Harshana";}else if(sum<=200){code=15;str="Vajra";}else if(sum<=213.3333){code=16;str="Siddhi";}else if(sum<=226.6666){code=17;str="Vyateepat";}else if(sum<=240){code=18;str="Vareeyan";}else if(sum<=253.3333){code=19;str="Parigha";}else if(sum<=266.6666){code=20;str="Siva";}else if(sum<=280){code=21;str="Siddha";}else if(sum<=293.3333){code=22;str="Sadhya";}else if(sum<=306.6666){code=23;str="Subha";}else if(sum<=320){code=24;str="Sukla";}else if(sum<=333.3333){code=25;str="Brahma";}else if(sum<=346.6666){code=26;str="Iyndra";}else{code=27;str="Vydhruti";}Yoga=str;janma_nakshatram=nakshatra_name[Math.floor(rasi/(360/27))+1];res=[Pada,Yoga,Karana,Thiti,janma_nakshatram];return res;};function tbaRe(as,mc){hs=[];x=as-mc;if(x<0.0){x+=360.0;}x/=6;y=18;for(i=0;i<7;i++){hs[y]=tbfe(mc+x*i);y++;if(y>24){y=0;}}x=mc-tbfe(as+180.0);if(x<0.0){x+=360.0;}x/=6;y=12;for(i=0;i<7;i++){hs[y]=tbfe(as+180+x*i);y++;}for(i=0;i<12;i++){hs[i]=tbfe(hs[i+12]+180.0);}s;z=0;hs_Madhya=[hs[0],hs[2],hs[4],hs[6],hs[8],hs[10],hs[12],hs[14],hs[16],hs[18],hs[20],hs[22]];hs_Sandhi=[hs[23],hs[1],hs[3],hs[5],hs[7],hs[9],hs[11],hs[13],hs[15],hs[17],hs[19],hs[21]];var vedic_houses=[hs_Madhya,hs_Sandhi];return vedic_houses;};function tbbre(longitude,houses){if(longitude<0){longitude+=360;}for(x=1;x<=12;x++){pl=longitude+(1/36000);if(x<12&&houses[x-1]>houses[x]){if((pl>=houses[x-1]&&pl<360)||(pl<houses[x]&&pl>=0)){h=x;continue;}}if(x==12&&(houses[x-1]>houses[0])){if((pl>=houses[x-1]&&pl<360)||(pl<houses[0]&&pl>=0)){h=x;}continue;}if((pl>=houses[x-1])&&(pl<houses[x])&&(x<12)){h=x;continue;}if((pl>=houses[x-1])&&(pl<houses[0])&&(x==12)){h=x;}}return h;};function tbave(longitude,houses){var TWOPI=2*Math.PI;if(longitude<0){longitude+=TWOPI;}for(x=1;x<=12;x++){pl=longitude+(1/36000);if(x<12&&houses[x-1]>houses[x]){if((pl>=houses[x-1]&&pl<TWOPI)||(pl<houses[x]&&pl>=0)){h=x;continue;}}if(x==12&&(houses[x-1]>houses[0])){if((pl>=houses[x-1]&&pl<TWOPI)||(pl<houses[0]&&pl>=0)){h=x;}continue;}if((pl>=houses[x-1])&&(pl<houses[x])&&(x<12)){h=x;continue;}if((pl>=houses[x-1])&&(pl<houses[0])&&(x==12)){h=x;}}return h;};function tbdEe(longitude){longitude=tbfe(longitude);sign_num=Math.floor(longitude/(360/27));pos_in_sign=longitude-(sign_num*(360/27));deg=Math.floor(pos_in_sign);full_min=(pos_in_sign-deg)*60;minu=Math.floor(full_min);full_sec=Math.round((full_min-minu)*60);pada=pos_in_sign;if(pada<=(360/108)){code=1;}else if(pada<=(360/54)){code=2;}else if(pada<=10.0){code=3;}else{code=4;}Pada=code;if(deg<10){deg="0"+deg;}if(minu<10){minu="0"+minu;}if(full_sec<10){full_sec="0"+full_sec;}return deg+"&deg; "+minu+"'<br> "+" "+nakshatra_name[sign_num+1]+"<br>( Pada "+Pada+" )";};function tbcUe(longitude){longitude=tbfe(longitude);sign_num=Math.floor(longitude/30);pos_in_sign=longitude-(sign_num*30);deg=Math.floor(pos_in_sign);full_min=(pos_in_sign-deg)*60;minu=Math.floor(full_min);full_sec=Math.round((full_min-minu)*60);pada=pos_in_sign;if(pada<=(360/108)){code=1;}else if(pada<=(360/54)){code=2;}else if(pada<=10.0){code=3;}else{code=4;}Pada=code;if(deg<10){deg="0"+deg;}if(minu<10){minu="0"+minu;}if(full_sec<10){full_sec="0"+full_sec;}return deg+"&deg; "+minu+"'<br> "+" "+rasi_name[sign_num+1];};function tbcEe(planet,planet_long,dayt){sign=Math.floor(planet_long/30.0);if(sign<0){sign+=12;}rulers=fssw_dt;faces=[[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4],[0,3,2],[1,6,5],[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4]];if(fssw_cB<2){terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[4,-1],[2,5],[2,5],[3,-1],[6,-1]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[6,-1],[4,-1]],[[6,-1],[3,-1],[5,-1],[2,-1],[4,-1]],[[4,-1],[5,-1],[3,-1],[2,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[3,-1],[2,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];triplicity=[[0,5],[3,1],[6,2],[4,4],[0,5],[3,1],[6,2],[4,4],[0,5],[3,1],[6,2],[4,4]];terms_deg=[[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30],[6,14,21,26,30]];}else{terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[4,-1],[6,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[6,-1],[2,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[5,-1],[3,-1],[4,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];triplicity=[[0,5,6],[3,1,5],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1]];terms_deg=[[6,12,20,25,30],[8,14,22,27,30],[6,12,17,24,30],[7,13,19,26,30],[6,11,18,24,30],[7,17,21,28,30],[6,14,21,28,30],[7,11,19,24,30],[12,17,21,26,30],[6,14,22,26,30],[7,13,20,25,30],[12,16,19,28,30]];}ruler_value= -1;for(i1=0;i1<=3;i1++){if(rulers[sign][planet][3-i1]==true){ruler_value=i1;}}planet_faces=planet_long-sign*30.0;planet_faces_dec=Math.floor(planet_faces/10);faces_value= -1;for(i1=0;i1<=2;i1++){if(faces[sign][i1]==planet&&planet_faces_dec==i1){faces_value=i1;}}trip_value= -1;j1=0;if(dayt<0){j1=1;}if(triplicity[sign][j1]==planet){trip_value=1;}terms_value= -1;for(i1=0;i1<=4;i1++){if(i1==0){t_i=0;}else{t_i=terms_deg[sign][i1-1];}t_f=terms_deg[sign][i1];if((terms[sign][i1][0]==planet||terms[sign][i1][1]==planet)&&(planet_faces<=t_f&&planet_faces>=t_i)){terms_value=i1;}}return[ruler_value,trip_value,terms_value,faces_value];};function tbaQe(pn,rlon){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn=Math.floor(rlon/30);if(digp[sn][0]==pn){return true;}else{return false;}};function tbbxe(pn,rlon){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn=Math.floor(rlon/30);if(digp[sn][1]==pn){return true;}else{return false;}};function tbafe(pn1,rRadix){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if((digp[sn1][0]==pn2)&&(digp[sn2][0]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tbaUe(pn1,rRadix){var digp=[[4,0,3,6],[3,1,4,-1],[2,10,5,-1],[1,5,6,4],[0,-1,6,-1],[2,2,5,3],[3,6,4,0],[4,-1,3,1],[5,99,2,-1],[6,4,1,5],[6,-1,0,-1],[5,3,2,2]];var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if((digp[sn1][1]==pn2)&&(digp[sn2][1]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tbaMe(pn1,rRadix){var digfaces=[[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4],[0,3,2],[1,6,5],[4,0,3],[2,1,6],[5,4,0],[3,2,1],[6,5,4]];var sn1=Math.floor(rRadix[pn1]/30);pfaces1=Math.floor((rRadix[pn1]-sn1*30.0)/10);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);pfaces2=Math.floor((rRadix[pn2]-sn2*30.0)/10);if((digfaces[sn1][pfaces1]==pn2)&&(digfaces[sn2][pfaces2]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tbbpe(pn1,rRadix,dayt,fssw_cB){if(fssw_cB<2){triplicity=[[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1],[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1],[0,5,-1],[3,1,-1],[6,2,-1],[4,4,-1]];}else{triplicity=[[0,5,6],[3,1,5],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1],[0,5,6],[3,1,4],[6,2,5],[3,4,1]];}var j1=0;if(dayt==false){j1=1;}var sn1=Math.floor(rRadix[pn1]/30);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);if(fssw_cB<2){if((triplicity[sn1][j1]==pn2)&&(triplicity[sn2][j1]==pn1)&&(pn1!=pn2)){return true;}}else{var p=triplicity[sn1][2];var snp=Math.floor(rRadix[p]/30);if((triplicity[sn1][j1]==p)&&(triplicity[snp][j1]==pn1)){return true;}if((triplicity[sn1][j1]==pn2)&&(triplicity[sn2][j1]==pn1)&&(pn1!=pn2)){return true;}}}return false;};function tbaee(pn1,rRadix,fssw_cB){if(fssw_cB<2){terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[4,-1],[2,5],[2,5],[3,-1],[6,-1]],[[5,6],[2,-1],[6,3],[5,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[6,-1],[4,-1]],[[6,-1],[3,-1],[2,5],[5,2],[4,-1]],[[4,-1],[3,5],[5,3],[2,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[3,-1],[2,-1],[5,-1],[6,4],[4,6]],[[6,-1],[2,-1],[3,-1],[5,-1],[4,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];}else{terms=[[[5,-1],[3,-1],[2,-1],[4,-1],[6,-1]],[[3,-1],[2,-1],[5,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[4,-1],[6,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[6,-1],[2,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[6,-1],[2,-1],[5,-1],[3,-1],[4,-1]],[[4,-1],[3,-1],[2,-1],[5,-1],[6,-1]],[[5,-1],[3,-1],[2,-1],[6,-1],[4,-1]],[[2,-1],[5,-1],[3,-1],[6,-1],[4,-1]],[[2,-1],[3,-1],[5,-1],[4,-1],[6,-1]],[[3,-1],[5,-1],[2,-1],[4,-1],[6,-1]]];}var sn1=Math.floor(rRadix[pn1]/30);var nterm1=Math.floor((rRadix[pn1]-30*sn1)/5);for(var pn2=0;pn2<=7;pn2++){var sn2=Math.floor(rRadix[pn2]/30);var nterm2=Math.floor((rRadix[pn2]-30*sn2)/5);if((terms[sn1][nterm1][0]==pn2)&&(terms[sn2][nterm2][0]==pn1)&&(pn1!=pn2)){return true;}if((terms[sn1][nterm1][1]==pn2)&&(terms[sn2][nterm2][1]==pn1)&&(pn1!=pn2)){return true;}}return false;};function tbse(xx){var jdi=xx+0.5;z=Math.floor(jdi);f=jdi-z;a=z;if(z>=229161){alpha=Math.floor((z-1867216.25)/36524.25);a=z+1+alpha-Math.floor(alpha/4);}b=a+1524;c=Math.floor((b-122.1)/365.25);d=Math.floor(365.25*c);e=Math.floor((b-d)/30.6001);dia=b-d-Math.floor(30.6001*e)+f;mes=e-1;if(e>13){mes=e-13;}if(m>2){ano=c-4716;}else{ano=c-4715;}return[ano,mes,dia];};function tbte(deg,n){var nakshatra,lord,pada=0,sdeg=0;if(deg<0){deg+=360;}if(deg>=0.0000&&deg<=13.3333){nakshatra="Ashvini";lord="Ke";pada=(deg-0.0000);sdeg=0.0000;}else if(deg>13.3333&&deg<=26.6667){nakshatra="Bharani";lord="Ve";pada=(deg-13.3333);sdeg=13.3333;}else if(deg>26.6667&&deg<=40.0000){nakshatra="Krittika";lord="Su";pada=(deg-26.6667);sdeg=26.6667;}else if(deg>40.0000&&deg<=53.3333){nakshatra="Rohini";lord="Mo";pada=(deg-40.0000);sdeg=40.0000;}else if(deg>53.3333&&deg<=66.6667){nakshatra="Mrigashir";lord="Ma";pada=(deg-53.3333);sdeg=53.3333;}else if(deg>66.6667&&deg<=80.0000){nakshatra="Ardra";lord="Ra";pada=(deg-66.6667);sdeg=66.6667;}else if(deg>80.0000&&deg<=93.3333){nakshatra="Punarvasu";lord="Ju";pada=(deg-80.0000);sdeg=80.0000;}else if(deg>93.3333&&deg<=106.6667){nakshatra="Pushya";lord="Sa";pada=(deg-93.3333);sdeg=93.3333;}else if(deg>106.6667&&deg<=120.0000){nakshatra="Ashlesha";lord="Me";pada=(deg-106.6667);sdeg=106.6667;}else if(deg>120.0000&&deg<=133.3333){nakshatra="Magha";lord="Ke";pada=(deg-120.0000);sdeg=120.0000;}else if(deg>133.3333&&deg<=146.6667){nakshatra="P.Phalg";lord="Ve";pada=(deg-133.3333);sdeg=133.3333;}else if(deg>146.6667&&deg<=160.0000){nakshatra="U.Phalg";lord="Su";pada=(deg-146.6667);sdeg=146.6667;}else if(deg>160.0000&&deg<=173.3333){nakshatra="Hasta";lord="Mo";pada=(deg-160.0000);sdeg=160.0000;}else if(deg>173.3333&&deg<=186.6667){nakshatra="Chitra";lord="Ma";pada=(deg-173.3333);sdeg=173.3333;}else if(deg>186.6667&&deg<=200.0000){nakshatra="Svati";lord="Ra";pada=(deg-186.6667);sdeg=186.6667;}else if(deg>200.0000&&deg<=213.3333){nakshatra="Vishakha";lord="Ju";pada=(deg-200.0000);sdeg=200.0000;}else if(deg>213.3333&&deg<=226.6667){nakshatra="Anuradha";lord="Sa";pada=(deg-213.3333);sdeg=213.3333;}else if(deg>226.6667&&deg<=240.0000){nakshatra="Jyeshtha";lord="Me";pada=(deg-226.6667);sdeg=226.6667;}else if(deg>240.0000&&deg<=253.3333){nakshatra="Mula";lord="Ke";pada=(deg-240.0000);sdeg=240.0000;}else if(deg>253.3333&&deg<=266.6667){nakshatra="P.Shadha";lord="Ve";pada=(deg-253.3333);sdeg=253.3333;}else if(deg>266.6667&&deg<=280.0000){nakshatra="U.Shadha";lord="Su";pada=(deg-266.6667);sdeg=266.6667;}else if(deg>280.0000&&deg<=293.3333){nakshatra="Sravana";lord="Mo";pada=(deg-280.0000);sdeg=280.0000;}else if(deg>293.3333&&deg<=306.6667){nakshatra="Dhanista";lord="Ma";pada=(deg-293.3333);sdeg=293.3333;}else if(deg>306.6667&&deg<=320.0000){nakshatra="Shatabhi";lord="Ra";pada=(deg-306.6667);sdeg=306.6667;}else if(deg>320.0000&&deg<=333.3333){nakshatra="P.Bhadra";lord="Ju";pada=(deg-320.0000);sdeg=320.0000;}else if(deg>333.3333&&deg<=346.6667){nakshatra="U.Bhadra";lord="Sa";pada=(deg-333.3333);sdeg=333.3333;}else if(deg>346.6667&&deg<=360.0000){nakshatra="Revati";lord="Me";pada=(deg-346.6667);sdeg=346.6667;}if(n==1)return nakshatra;else if(n==2)return lord;else if(n==3){if(pada>=0.000000&&pada<=3.333334)return 1;if(pada>3.333334&&pada<=6.666667)return 2;if(pada>6.666667&&pada<=9.999999)return 3;if(pada>9.999999&&pada<=13.400000)return 4;}else if(n==4){return sdeg;}};function tbbOe(d,moon,yy,mes,dd,h,m,natal_jd){var lord=["Me","Ke","Ve","Su","Mo","Ma","Ra","Ju","Sa"];var tdasa=[6209.116431424950,2556.695001174980,7304.842860499940,2191.452858149980,3652.421430249970,2556.695001174980,6574.358574449950,5843.874288399950,6939.600717474940];var bdata=[];bdata=tbse(natal_jd);birthyear=bdata[0];birthmonth=bdata[1];birthday=Math.floor(bdata[2]);var jd=natal_jd;var Ts=(jd-2415020.0)/36525.0;var Tm=(jd-2451545.0)/36525.0;var tropmonth=27.321661547+0.000000001857*birthyear;var synmonth=29.5305888531+0.00000021621*Tm-3.64*(10e-10)*Tm*Tm;var solaryear=365.2421896698-6.15359*(10e-6)*Ts-7.29*(10e-10)*Ts*Ts+2.64*(10e-10)*Ts*Ts*Ts;var sideralyear=solaryear+(1+(1/26000));var savanayear=360;var lunaryear=12*synmonth;var sideralday=24*solaryear/sideralyear;var civilday=24*86400/60/60/24;var synodicday=24*360/sideralyear;var ratio=1/100273790935;var sdeg=tbte(moon,4);var nlord=tbte(moon,2);var vindex=lord.indexOf(nlord);var period=tdasa[lord.indexOf(nlord)];var balance=((moon-sdeg)/13.3333);var lbalance=1-balance;var etime=Math.abs(balance*(period/solaryear));var ta=0,tp=0,mlord=nlord,alord,plord,cmlord,calord,cplord,today1=new Date(),currentmaha=0,indexcurrent=vindex,year;var ayear=(today1.getFullYear()*solaryear)+((today1.getMonth()+1)*30)+today1.getDate();var byear=(birthyear*solaryear)+((birthmonth)*30)+birthday;var tyear=ayear-byear;var istoday=true;if(tyear>120*solaryear){ayear=120*solaryear+byear;tyear=ayear-byear;istoday=false;}for(var i=0;i<9;i++){if(vindex>8)vindex=0;ta+=tdasa[vindex]/solaryear/120;if(ta>balance){alord=lord[vindex];break;}vindex++;}ta=1-((ta-balance)/(tdasa[vindex]/solaryear/120));for(var i=0;i<9;i++){if(vindex>8)vindex=0;tp+=tdasa[vindex]/solaryear/120;if(tp>ta){plord=lord[vindex];break;}vindex++;}var nbalance=(lbalance*tdasa[indexcurrent]);year=(ayear-(byear+nbalance));indexcurrent++;ta=0;for(var i=0;i<9;i++){if(indexcurrent>8)indexcurrent=0;ta+=tdasa[indexcurrent];if(ta>year){cmlord=lord[indexcurrent];break;}indexcurrent++;}year=1-(ta-year)/tdasa[indexcurrent];ta=0;for(var i=0;i<9;i++){if(indexcurrent>8)indexcurrent=0;ta+=tdasa[indexcurrent]/solaryear/120;if(ta>year){calord=lord[indexcurrent];break;}indexcurrent++;}tp=0;ta=1-((ta-year)/(tdasa[indexcurrent]/solaryear/120));for(var i=0;i<9;i++){if(indexcurrent>8)indexcurrent=0;tp+=tdasa[indexcurrent]/solaryear/120;if(tp>ta){cplord=lord[indexcurrent];break;}indexcurrent++;}var tstr=tbbje(etime,solaryear,natal_jd);var nowstr=" ";if(istoday){nowstr+=(((today1.getDate())<10)?"0":"")+(today1.getDate());nowstr+=(((today1.getMonth()+1)<10)?"/0":"/")+(today1.getMonth()+1);nowstr+=(((today1.getFullYear())<1000)?"/0":"/")+(today1.getFullYear())+" <?php echo $translate_json['A.C.']; ?>";}else{var cdata=[];var c=natal_jd+120*solaryear;cdata=tbse(c);var cc_year=cdata[0];var cc_month=cdata[1];var cc_day=Math.floor(cdata[2]);nowstr=((cc_day<10)?"0":"")+cc_day;nowstr+=((cc_month<10)?"/0":"/")+cc_month;var out_year=cc_year+" <?php echo $translate_json['A.C.']; ?>";if(cc_year<=0){cc_year=1-cc_year;out_year=cc_year+" <?php echo $translate_json['B.C.']; ?>";}nowstr+="/"+out_year;}var nstr=mlord;nstr+="/";nstr+=alord;nstr+="/";nstr+=plord;nstr+="|";nstr+=cmlord;nstr+="/";nstr+=calord;nstr+="/";nstr+=cplord;nstr+="|";nstr+=tstr;nstr+="|";nstr+=nowstr;return nstr;};function tbbje(etime,solaryear,natal_jd){if(isNaN(etime))return("00/00/0000");var bdata=[];bdata=tbse(natal_jd-etime*solaryear);b_year=bdata[0];b_month=bdata[1];b_day=Math.floor(bdata[2]);var str=((b_day<10)?"0":"")+b_day;str+=((b_month<10)?"/0":"/")+b_month;var out_year=b_year+" <?php echo $translate_json['A.C.']; ?>";if(b_year<=0){b_year=1-b_year;out_year=b_year+" <?php echo $translate_json['B.C.']; ?>";}return str+"/"+out_year;};function oar(OK,CODE1,CODE2){this.OK;this.CODE1;this.CODE2;this.n_jrl;this.JR_courant;this.bool;this.chaine;};function date(JJD,AN,MOIS,JOUR,TYPEA,NBMOIS){this.JJD;this.AN;this.MOIS;this.JOUR;this.TYPEA;this.NBMOIS;};function tbYe(x){if(x>0.0){return(Math.floor(x));}else{return Math.ceil(x);}};function tbae(){Z1=date.JJD+0.5;Z=tbYe(Z1);A=Z;B=A+1524;C=tbYe((B-122.1)/365.25);D=tbYe(365.25*C);E=tbYe((B-D)/30.6001);date.JOUR=tbYe(B-D-tbYe(30.6001*E));if(E<13.5){date.MOIS=tbYe(E-1);}else{date.MOIS=tbYe(E-13);}if(date.MOIS>=3){date.AN=tbYe(C-4716);}else{date.AN=tbYe(C-4715);}};function tbxe(){Z1=date.JJD+0.5;Z=tbYe(Z1);if(Z<2299161){A=Z;}else{ALPHA=tbYe((Z-1867216.25)/36524.25);A=Z+1+ALPHA-tbYe(ALPHA/4);}B=A+1524;C=tbYe((B-122.1)/365.25);D=tbYe(365.25*C);E=tbYe((B-D)/30.6001);date.JOUR=tbYe(B-D-tbYe(30.6001*E));if(E<13.5){date.MOIS=tbYe(E-1);}else{date.MOIS=tbYe(E-13);}if(date.MOIS>=3){date.AN=tbYe(C-4716);}else{date.AN=tbYe(C-4715);}};function tbBe(){date.NBMOIS=12;date.TYPEA=0;if((date.AN%4)==0){date.TYPEA=1;}if((date.AN%100)==0&&(date.AN%400)!=0){date.TYPEA=0;}};function tbLe(){date.NBMOIS=12;if((date.AN%4)==0){date.TYPEA=1;}else{date.TYPEA=0;}};function tbbde(divID,n){mois=new Array("nul","January","February","March","April","May","June","July","August","September","October","November","December");nomsai=new Array("<?php echo $translate_json['Spring']; ?>... ","<?php echo $translate_json['Summer']; ?>... ","<?php echo $translate_json['Autumn']; ?>... ","<?php echo $translate_json['Winter']; ?>... ");FDJ=(date.JJD+0.5E0)-Math.floor(date.JJD+0.5E0);HH=Math.floor(FDJ*24);FDJ-=HH/24.0;MM=Math.floor(FDJ*1440);var div=document.getElementById(divID);div.innerHTML+=nomsai[n]+date.JOUR+" "+tr(mois[date.MOIS])+" "+date.AN+" , "+HH+"h"+MM+"m UT<br>";};function tbbwe(divID,YY){CODE1=YY;nline=1;k=YY-2000-1;for(n=0;n<8;n++){nn=n%4;dk=k+0.25E0*n;with(Math){T=0.21451814e0+0.99997862442e0*dk+0.00642125e0*sin(1.580244e0+0.0001621008e0*dk)+0.00310650e0*sin(4.143931e0+6.2829005032e0*dk)+0.00190024e0*sin(5.604775e0+6.2829478479e0*dk)+0.00178801e0*sin(3.987335e0+6.2828291282e0*dk)+0.00004981e0*sin(1.507976e0+6.2831099520e0*dk)+0.00006264e0*sin(5.723365e0+6.2830626030e0*dk)+0.00006262e0*sin(5.702396e0+6.2827383999e0*dk)+0.00003833e0*sin(7.166906e0+6.2827857489e0*dk)+0.00003616e0*sin(5.581750e0+6.2829912245e0*dk)+0.00003597e0*sin(5.591081e0+6.2826670315e0*dk)+0.00003744e0*sin(4.3918e0+12.56578830e0*dk)+0.00001827e0*sin(8.3129e0+12.56582984e0*dk)+0.00003482e0*sin(8.1219e0+12.56572963e0*dk)-0.00001327e0*sin(-2.1076e0+0.33756278e0*dk)-0.00000557e0*sin(5.549e0+5.7532620e0*dk)+0.00000537e0*sin(1.255e0+0.0033930e0*dk)+0.00000486e0*sin(19.268e0+77.7121103e0*dk)-0.00000426e0*sin(7.675e0+7.8602511e0*dk)-0.00000385e0*sin(2.911e0+0.0005412e0*dk)-0.00000372e0*sin(2.266e0+3.9301258e0*dk)-0.00000210e0*sin(4.785e0+11.5065238e0*dk)+0.00000190e0*sin(6.158e0+1.5774000e0*dk)+0.00000204e0*sin(0.582e0+0.5296557e0*dk)-0.00000157e0*sin(1.782e0+5.8848012e0*dk)+0.00000137e0*sin(-4.265e0+0.3980615e0*dk)-0.00000124e0*sin(3.871e0+5.2236573e0*dk)+0.00000119e0*sin(2.145e0+5.5075293e0*dk)+0.00000144e0*sin(0.476e0+0.0261074e0*dk)+0.00000038e0*sin(6.45e0+18.848689e0*dk)+0.00000078e0*sin(2.80e0+0.775638e0*dk)-0.00000051e0*sin(3.67e0+11.790375e0*dk)+0.00000045e0*sin(-5.79e0+0.796122e0*dk)+0.00000024e0*sin(5.61e0+0.213214e0*dk)+0.00000043e0*sin(7.39e0+10.976868e0*dk)-0.00000038e0*sin(3.10e0+5.486739e0*dk)-0.00000033e0*sin(0.64e0+2.544339e0*dk)+0.00000033e0*sin(-4.78e0+5.573024e0*dk)-0.00000032e0*sin(5.33e0+6.069644e0*dk)-0.00000021e0*sin(2.65e0+0.020781e0*dk)-0.00000021e0*sin(5.61e0+2.942400e0*dk)+0.00000019e0*sin(-0.93e0+0.000799e0*dk)-0.00000016e0*sin(3.22e0+4.694014e0*dk)+0.00000016e0*sin(-3.59e0+0.006829e0*dk)-0.00000016e0*sin(1.96e0+2.146279e0*dk)-0.00000016e0*sin(5.92e0+15.720504e0*dk)+0.00000115e0*sin(23.671e0+83.9950108e0*dk)+0.00000115e0*sin(17.845e0+71.4292098e0*dk);}JJD=2451545+T*365.25e0;JJD+=0.0003472222e0;D=CODE1/100.0;TETUJ=(32.23e0*(D-18.30e0)*(D-18.30e0)-15)/86400.e0;JJD-=TETUJ;date.JJD=JJD;if(JJD<2299160.5e0){tbae();}else{tbxe();}if(date.AN==CODE1){tbbde(divID,nn);}}};function tbaYe(divID){PI314=3.141592653589793;tabm=new Array(0.041e0,0.126e0,0.203e0,0.288e0,0.370e0,0.455e0,0.537e0,0.622e0,0.707e0,0.789e0,0.874e0,0.956e0);xMOIS=date.MOIS;oar.CODE1=date.AN;oar.CODE2=date.MOIS;if(date.MOIS==1){an=date.AN-1;date.MOIS=12;}else{an=date.AN;date.MOIS--;}an+=tabm[date.MOIS-1];k=(an-1900)*12.3685e0;lik=tbYe(k);rk=lik;k=rk-0.25e0;if(k<0.e0)k=k-1;rad=PI314/180e0;nx=0;with(Math){for(ii=0;ii<12;ii++){k=k+0.25;t=k/1236.85e0;t2=t*t;t3=t*t2;j=2415020.75933e0+29.5305888531e0*k+0.0001337e0*t2-0.000000150e0*t3+0.00033e0*sin(rad*(166.56e0+132.87*t-0.009*t2));m=rad*(359.2242e0+29.10535608e0*k-0.0000333e0*t2-0.00000347e0*t3);m=m%(2*PI314);mp=rad*(306.0253e0+385.81691806e0*k+0.0107306e0*t2+0.00001236e0*t3);mp=mp%(2*PI314);f=rad*(21.2964e0+390.67050646e0*k-0.0016528e0*t2-0.00000239e0*t3);f=f%(2*PI314);oar.OK=0;i=ii%4;if(i==0||i==2){j=j+(0.1734e0-0.000393e0*t)*sin(m)+0.0021e0*sin(2*m)-0.4068e0*sin(mp)+0.0161e0*sin(2*mp)-0.0004e0*sin(3*mp)+0.0104e0*sin(2*f)-0.0051e0*sin(m+mp)-0.0074e0*sin(m-mp)+0.0004e0*sin(2*f+m)-0.0004e0*sin(2*f-m)-0.0006e0*sin(2*f+mp)+0.001e0*sin(2*f-mp)+0.0005e0*sin(m+2*mp);date.JJD=j;tbme(i,xMOIS);if(oar.OK==1){tbhe(divID,i);}}else{j=j+(0.1721e0-0.0004e0*t)*sin(m)+0.0021e0*sin(2*m)-0.6280e0*sin(mp)+0.0089e0*sin(2*mp)-0.0004e0*sin(3*mp)+0.0079e0*sin(2*f)-0.0119e0*sin(m+mp)-0.0047e0*sin(m-mp)+0.0003e0*sin(2*f+m)-0.0004e0*sin(2*f-m)-0.0006e0*sin(2*f+mp)+0.0021e0*sin(2*f-mp)+0.0003e0*sin(m+2*mp)+0.0004e0*sin(m-2*mp)-0.0003e0*sin(2*m+mp);if(i==1){date.JJD=j+0.0028e0-0.0004*cos(m)+0.0003e0*cos(mp);tbme(i,xMOIS);if(oar.OK==1)tbhe(divID,i);}else{date.JJD=j-0.0028e0+0.0004*cos(m)-0.0003e0*cos(mp);tbme(i,xMOIS);if(oar.OK==1){tbhe(divID,i);}}}}if(oar.OK==1){nx++;}date.AN=oar.CODE1;date.MOIS=oar.CODE2;if(date.MOIS==2){date.NBJRS=((date.TYPEA==0)?28:29);}else{if(date.MOIS<8){date.NBJRS=(((date.MOIS&1)!=0)?31:30);}else{date.NBJRS=(((date.MOIS&1)!=0)?30:31);}}}};function tbme(i,pMOIS){D=oar.CODE1/100.0;TETUS=32.23*(D-18.30)*(D-18.30)-15;TETUJ=TETUS/86400e0;date.JJD+=0.0003472222e0;date.JJD+=(-TETUJ);if(date.JJD<2299160.5e0){tbae();tbLe();}else{tbxe();tbBe();}oar.OK=0;if(date.MOIS==pMOIS){oar.OK=1;}if(i==0){if(pMOIS>date.MOIS){tbbGe(pMOIS);}else if(date.MOIS==12&&pMOIS==1){tbbGe(pMOIS);}}};function tbbGe(xmois){if(oar.bool==0){if(date.MOIS==2){date.NBJRS=((date.TYPEA==0)?28:29);}else{if(date.MOIS<8){date.NBJRS=(((date.MOIS&1)!=0)?31:30);}else{date.NBJRS=(((date.MOIS&1)!=0)?30:31);}}oar.JR_courant=1;oar.n_jrl=date.NBJRS-date.JOUR+2;}};function tbhe(divID,i){mois=new Array("nul"," January "," February","  March  ","  April  ","   May   ","   June  ","   July  ","  August ","September"," October ","November ","December ");nompha=new Array("<?php echo $translate_json['New moon']; ?>... ","<?php echo $translate_json['First quarter']; ?>... ","<?php echo $translate_json['Full moon']; ?>... ","<?php echo $translate_json['Last quarter']; ?>... ");sigpha=new Array("NM","FQ","FM","LQ");tabjm=new Array(31,28,31,30,31,30,31,31,30,31,30,31);if(date.JJD<2299160.5E0){tbae();}else{tbxe();}FRACJ=(date.JJD+0.5E0)%1.0;jour=date.JOUR;HH=FRACJ*24e0;hh=Math.floor(HH);FRACJ-=hh/24.e0;MM=FRACJ*1440.e0;mm=Math.floor(MM);if(hh==24){jfin=tabjm[date.MOIS-1];if(date.JJD<2299160.5E0){tbLe();}else{tbBe();}if(date.MOIS==2&&date.TYPEA==1){jfin=29;}if(date.JOUR<jfin){hh=0;jour=date.JOUR+1;}}if(hh<10){hh="0"+hh;}if(mm<10){mm="0"+mm;}nombre=((oar.JR_courant<=9)?"0"+oar.JR_courant++ :oar.JR_courant++);if(date.AN>= -9&&date.AN<=99){oar.chaine="  "+date.AN;}else{oar.chaine=date.AN;}if(i==0){oar.n_jrl=2;oar.bool=1;}else{oar.n_jrl++;}var div=document.getElementById(divID);div.innerHTML+=nompha[i]+" "+jour+" "+tr(mois[date.MOIS])+" "+date.AN+" , "+hh+"h"+mm+"m UT<br>";};function calc_seasons_moon(mes,ano,vDIV){var divn=document.getElementById(vDIV);divn.innerHTML="<b><?php echo $translate_json["Seasons"]; ?>:</b><br>";tbbwe(vDIV,ano);divn.innerHTML+="<b><?php echo $translate_json["Moon phases"]; ?>:</b><br>";date.MOIS=mes;tbaYe(vDIV);$.ajax({type:"GET",url:"<?php echo plugins_url('Tetrabyblos') ?>/data/eclipse.php",data:{year:ano,age:27,country:'Ireland'},success:function(data){divn.innerHTML+=tr(data);}});};function tbje(lla,llb){var dretro=(llb-lla);if(Math.abs(dretro)>180){dretro=360-Math.abs(dretro);if(llb>=0&&lla>=180){return dretro;}if(lla>=0&&llb>180){return-dretro;}}return dretro;} </script> <?php




if($_POST){


$post = $_POST;
$parameters = isset($post["parameters"]) ? $post["parameters"] : "";
$dater = isset($post["dater"]) ? $post["dater"] : "";
$Date1 = isset($post["dateG"]) ? $post["dateG"] : "";
$Longitude1 = isset($post["LongitudeG"]) ? $post["LongitudeG"] : "";
$Longitude2 = isset($post["transit1G"]) ? $post["transit1G"] : "";
$Longitude3 = isset($post["transit2G"]) ? $post["transit2G"] : "";
$Declination1 = isset($post["DeclinationG"]) ? $post["DeclinationG"] : "";
$Nodes1 = isset($post["nodesG"]) ? $post["nodesG"] : "";
$HPos1 = isset($post["hposG"]) ? $post["hposG"] : "";
$Points1 = isset($post["pointsG"]) ? $post["pointsG"] : "";
$Declination2 = isset($post["transit1DecG"]) ? $post["transit1DecG"] : "";
$Houses_2 = isset($post["transit1housesG"]) ? $post["transit1housesG"] : "";
$Points2 = isset($post["transit1pointsG"]) ? $post["transit1pointsG"] : "";
$showopt = isset($post["showopt"]) ? $post["showopt"] : "";

$action=get_site_url() . '/transits/?parameters='.urlencode($parameters).'&dater=';
  if(!empty($parameters)){
    list($natName,$sNat,$palName,$sPal,$sUse,$sMore)=explode('|',urldecode($parameters));
    /* list($sNatLat,$sNatLng,$natZone,$sNatDate,$natTime,$natCity)=explode(',',$sNat,6); */
	list($sNatLat,$sNatLng,$natZone,$sNatDate,$natTime,$natTime24,$natCity)=explode(',',$sNat,7);
    $natYear=substr($sNatDate,0,4);
    $natMonth=substr($sNatDate,4,2);
    $natDay=substr($sNatDate,6,2);
    $fPrecession=(substr($sNatDate,-1,1)=='P');
    list($sUseLat,$sUseLng,$useZone,$sUseDate,$useCity)=explode(',',$sUse,5);
    $useYear=substr($sUseDate,0,4);
    $useMonth=substr($sUseDate,4,2);
    $useDay=substr($sUseDate,6,2);
    if(strpos($sMore,',')<1){
      $houseName='Koch';
      $SIDname='';
      $sMore="$houseName,$SIDname";
    }else{
      list($houseName,$SIDname)=explode(',',$sMore);
    }
    list($SIDuser,$SIDdomain,$SIDtitle)=explode('@',$SIDname);
  }
  if($useDay=='00'){
    $dated='today';
  }
  if(!empty($dater)){
    $dated=$dater;
  }
  if(!empty($dated)){
    switch($dated) {
    case _yesterday:
      $sUseDate=$useYear.date('md',safe_mktime(0,0,0,$useMonth,$useDay-1,$useYear));
      break;
    case _today:
      $sUseDate=date('Ymd');
      break;
    case _tomorrow:
      $sUseDate=$useYear.date('md',safe_mktime(0,0,0,$useMonth,$useDay+1,$useYear));
      
      break;
    default:
      $sUseDate=$dated;
    }
    $useYear=substr($sUseDate,0,4);
    $useMonth=substr($sUseDate,4,2);
    $useDay=substr($sUseDate,6,2);
  }
$natTime_txt = $natTime;
$today_date = date('Ymd');
$regex = "/(\d+)([A-Za-z]+)/";
$newstring = preg_replace_callback($regex,"FormatHour",$natTime_txt);
$natTime_txt = $newstring; 
//$sDateHeading = date("l jS \of F Y", mktime(0, 0, 0, $useMonth, $useDay, $useYear));
$sDateHeading = date("l j F Y", mktime(0, 0, 0, $useMonth, $useDay, $useYear));
//$sDateHeading = str_replace("of","",$sDateHeading);
$sDateHeading = strtr($sDateHeading,$translate_json);

//$sUseLat, $sUseLng
$sUseLat = preg_replace("/(\d+)([NS]+)(\d+)/", "$1&deg;$2$3'", $sUseLat);
$sUseLng = preg_replace("/(\d+)([EW]+)(\d+)/", "$1&deg;$2$3'", $sUseLng);
	
$todo_tm = -$useZone; 
$useZone = gmdate('H:i', floor(abs($todo_tm) * 3600));
if($todo_tm < 0){$useZone = "GMT-".$useZone;} else {$useZone = "GMT+".$useZone;}
//$useZone = ($useZone >= 0) ? "GMT+".$useZone : "GMT".$useZone;
$natTime_txt = $natTime24;	
echo"<html>
<head>
<title>"._Daily_Transits.' '._for." $natName</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>

<JasobNoObfs>

<style>
a:link, a:visited {
    text-decoration: none;
    color: teal;
    font-weight:bold;
}
a:hover, a:active {
    text-decoration: none;
    color: teal;
    font-weight:bold;
}
@font-face {
font-family: '" . _FontFaceZodiac . "';
src: url('".plugins_url('Tetrabyblos')."/css/ZODIACJD.ttf');
}
#table_data_1, th, td {
    border: 0px solid black;
}
#table_data_2, th, td {
    border: 0px solid black;
}
.tetra-font {
font-family: '" . _FontFaceZodiac . "';
}
</style>

</JasobNoObfs>


<script src='".plugins_url('Tetrabyblos')."/js/jquery.min.js'></script>
<script src='".plugins_url('Tetrabyblos')."/js/moment.js'></script>
<script src='".plugins_url('Tetrabyblos')."/js/moment-timezone-with-data.js'></script>
<script type='text/javascript' src='".plugins_url('Tetrabyblos')."/js/ephemeris-0.1.0.js' charset='utf-8'></script>
<script src='".plugins_url('Tetrabyblos')."/js/astrochart.js'></script>
<script src='".plugins_url('Tetrabyblos')."/js/canvg.js'></script>
</head>
<body>
";
  echo"
<span style='font-family: " . _FontFaceZodiac . "; color: #FFF; font-weight: bold;visibility: hidden;'></span>
<div style='width: 90%;'>
<center>

<table id='table_data_1' name='table_data_1' cellpadding=12 cellspacing=0 style='background-color: white;'> <!-- 1st table -->

<tr style='background-color: white;border: 0px solid white'>

<td width=600px valign=top style='background-color: white;'>
<font face='"._FontFaceHeading."' size=1>
</font>
<br>
<center>
<!-- <font face='"._FontFaceHeading."' color=black size=6>".$translate_json[_PPStitleTM]."</font> -->
</center>
<font face='"._FontFaceSansSerif."' color=black size=2>
<center>
<font color=green>
<h4>$sDateHeading<br>$holiday</h4>
</font>
<h2>".$translate_json[_Daily_Transits]."</h2>
<h4>".$translate_json[_for]." </h4>
<h1>$natName</h1>
<font size=1>
$natName, "." $natYear ".date('M j',safe_mktime(0,0,0,$natMonth,$natDay,$natYear))
.' '.', '." $natTime_txt"." $useZone &bullet; $sUseLat, $sUseLng
<br>
</font>
";

echo'<hr>
<table id="table_data_2" name="table_data_2" cellspacing=0 cellpadding=0 style="border-spacing: 7px;background-color: white;"> <!-- 2nd table -->
  <tr style="background-color: white;">
    <td style="background-color: white; width: 300px;">
<pre style="background-color: #ffffff;font-size: 12px;border: 0px solid white;">';
  echo strtr(str_pad(date('F ',safe_mktime(0,0,0,$useMonth,1,$useYear)).$useYear,21,' ',STR_PAD_BOTH),$translate_json).'
'.strtr(_Weekdays2letter,$translate_json).'
';
  $j=date('w',mktime(0,0,0,$useMonth,1,$useYear));
  $col=0;
  for($i=0;$i<$j;$i++){
    echo'   ';
    $col++;
  }
  $days=date('d',mktime(0,0,0,($useMonth+1),0,$useYear));
  for($i=1;$i<=$days;$i++){
    $s="$i";
    if(strlen($s)==1){
      $s=" $s";
    }
    if($i!=$useDay){
      
      $s='<a href="#" onclick="document.f1.dater.value='.date('Ymd',mktime(0,0,0,$useMonth,$i,$useYear)).';Calc_Transits();document.f1.submit();">'.$s.'</a>';
    }
    echo"$s ";
    if(++$col==7){
      echo'
';
      $col=0;
    }
  }
  echo'</pre>
    </td>
    <td valign=top style="background-color: white;">
<small>
<br>
<br><a href="#" onclick="document.f1.dater.value='.date('Ymd',mktime(0,0,0,$useMonth-1,1,$useYear)).';Calc_Transits();document.f1.submit();">' . $translate_json["Previous Month"] . '</a>
<br><span style="font-size: 20px;">&bullet;</span><br><a href="#" onclick="document.f1.dater.value='.date('Ymd',mktime(0,0,0,$useMonth,$useDay-1,$useYear)).';Calc_Transits();document.f1.submit();">' . $translate_json["Yesterday"] . '</a>
<br><a href="#" onclick="document.f1.dater.value='.$today_date.';Calc_Transits();document.f1.submit();">' . $translate_json["Today"] . '</a>
<br><a href="#" onclick="document.f1.dater.value='.date('Ymd',mktime(0,0,0,$useMonth,$useDay+1,$useYear)).';Calc_Transits();document.f1.submit();">' . $translate_json["Tomorrow"] . '</a>
<br><span style="font-size: 20px;">&bullet;</span><br><a href="#" onclick="document.f1.dater.value='.date('Ymd',mktime(0,0,0,$useMonth+1,1,$useYear)).';Calc_Transits();document.f1.submit();">' .  $translate_json["Next Month"] . '</a>
<br>
<form name=f1 action="" method="POST" target=_self >
<input name=parameters type=hidden value="'.$parameters.'">
<input type="hidden" name="dateG" id="dateG" value="'.$Date1.'" >
<input type="hidden" name="LongitudeG" id="LongitudeG" value="'.$Longitude1.'" >
<input type="hidden" name="transit1G" id="transit1G" value="'.$Longitude2.'" >
<input type="hidden" name="transit2G" id="transit2G" value="'.$Longitude3.'" >
<input type="hidden" name="DeclinationG" id="DeclinationG" value="'.$Declination1.'" >
<input type="hidden" name="nodesG" id="nodesG" value="'.$Nodes1.'" >
<input type="hidden" name="hposG" id="hposG" value="'.$HPos1.'" >
<input type="hidden" name="pointsG" id="pointsG" value="'.$Points1.'" >
<input type="hidden" name="transit1DecG" id="transit1DecG" value="'.$Declination2.'" >
<input type="hidden" name="transit1housesG" id="transit1housesG" value="'.$Houses_2.'" >
<input type="hidden" name="transit1pointsG" id="transit1pointsG" value="'.$Points2.'" >
<input type="hidden" name="showopt" id="transit1pointsG" value="'.$showopt.'" >
<input name=dater type=hidden value="">
</form>
<script>
function fixto360(ang){
	while (ang < 0) {
    ang += 360;
  }
  while (ang >= 360) {
    ang -= 360;
  }
  return ang;
}
/* function FNretro(lla,llb){
var dretro = (lla - llb);	
if(Math.abs(dretro) > 180){
	z = 360 - Math.abs(dretro);
	d = Math.sign(dretro)*z;
}	
return dretro;	
}*/

function FNretro(lla,llb){
var dretro = (llb - lla);
if(Math.abs(dretro) > 180){
	dretro = 360 - Math.abs(dretro);
	if(llb >=0 && lla >= 180){
		return dretro;
	}
	if(lla >= 0 && llb > 180){
		return -dretro;
	}
}
	return dretro;
}


function ephemeris_moshier_2(date,longitude,latitude,h_sys){
$const.tlong = longitude; 
$const.glat = latitude; 
var longitude1 = Number(longitude);
var latitude1 = Number(latitude);
var nbody = new Array("sun","moon","mercury","venus","mars","jupiter","saturn","uranus","neptune","pluto","chiron");
$processor.init ();
var LongitudeG1 = new Array();
var DeclinationG1 = new Array();
var AltitudeG1 = new Array();
for(i=0;i<10;i++){
var body = $moshier.body[nbody[i]];
$processor.calc (date, body);
LongitudeG1[i+1] = fixto360($const.body.position.apparentLongitude);
DeclinationG1[i+1] = $const.body.position.apparent.dDec * 180/Math.PI;
AltitudeG1[i+1] = $const.body.position.altaz.topocentric.altitude;
}
var nodesG1 = new Array();
nodesG1 = MoonNode(date.julian);
var houses_G1 = new Array();
houses_G1 = CalculateHouses(date.julian,longitude1,latitude1,h_sys);
for(i=12;i>0;i--){houses_G1[i] = houses_G1[i-1]*180/Math.PI;}
houses_G1[0] = 0;
var pointsG1 = new Array();
pointsG1[1] = nodesG1[0];
var angleG1 = new Array();
angleG1 = CalcAngles(date.julian,longitude1,latitude1,0);
pointsG1[2] = angleG1[2]*180/Math.PI;
pointsG1[3] = houses_G1[1];
pointsG1[4] = houses_G1[10];
pointsG1[6] = nodesG1[1];
SUNALT1 = AltitudeG1[1];
if (SUNALT1 > 0){
pointsG1[5] = fixto360(pointsG1[3] + LongitudeG1[2] - LongitudeG1[1]); 
} else {
pointsG1[5] = fixto360(pointsG1[3] - LongitudeG1[2] + LongitudeG1[1]); 
}
date["day"] += 1;
$processor.init ();
var LongitudeG2 = new Array();
for(i=0;i<10;i++){
var body = $moshier.body[nbody[i]];
$processor.calc (date, body);
LongitudeG2[i+1] = fixto360($const.body.position.apparentLongitude);
}
date["day"] += 1;
$processor.init ();
var LongitudeG3 = new Array();
for(i=0;i<10;i++){
var body = $moshier.body[nbody[i]];
$processor.calc (date, body);
LongitudeG3[i+1] = fixto360($const.body.position.apparentLongitude);
}
for(i=1;i<12;i++){
//if(FNretro(LongitudeG2[i],LongitudeG1[i]) < 0){LongitudeG1[i] = -LongitudeG1[i];}
//if(FNretro(LongitudeG3[i],LongitudeG2[i]) < 0){LongitudeG2[i] = -LongitudeG2[i];}	
if(LongitudeG1[i],FNretro(LongitudeG2[i]) < 0){LongitudeG1[i] = -LongitudeG1[i];}
if(FNretro(LongitudeG2[i],LongitudeG3[i]) < 0){LongitudeG2[i] = -LongitudeG2[i];}
}	
var vv = new Array(LongitudeG1,LongitudeG2,DeclinationG1,houses_G1,pointsG1);
return vv;
}
function Calc_Transits(){
var DateG = "'.$Date1.'";
var myData = DateG.split(",");
longitude = myData[7];
latitude = myData[8];
h_sys = myData[9];
var DateR = document.f1.dater.value;
yy = Math.floor(DateR/10000);
DateR -= yy*10000;
mm = Math.floor(DateR/100);
DateR -= mm*100; 
dd = DateR;
var date = {year: yy, month: mm, day: dd, hours: 0, minutes: 0, seconds: 0, offset: 0};
var z = new Array();
z = ephemeris_moshier_2(date,longitude,latitude,h_sys);
document.getElementById("transit1G").value = z[0].toString();
document.getElementById("transit2G").value = z[1].toString();
document.getElementById("transit1DecG").value = z[2].toString();
document.getElementById("transit1housesG").value = z[3].toString();
document.getElementById("transit1pointsG").value = z[4].toString();
}
</script>
<br>
<div align=left>' . $translate_json["Chose the date for your transit report."] . '
</div>
</small>
    </td>
  </tr>
</table> <!-- 2nd table -->
<hr>
</center>
<br>
';
  $aSignGlyph=array('a','t','g','m','l','v','b','i','s','c','q','p');
  $aPlanetCode=array('a','r','l','m','v','w','j','s','u','n','p','c');
  
  $P = strtr(_PlanetWords,$translate_json);
  //$aPlanetWord=explode(',',_PlanetWords);
  $aPlanetWord=explode(',',$P);
  $aBurdenConj=array('R&W', 'R&S', 'R&U', 'R&N', 'R&P', 'L&W', 'L&S', 'L&U', 'L&P', 'M&W', 'M&S', 'M&U', 'V&S', 'V&U', 'W&R', 'W&L', 'W&W', 'W&S', 'W&U', 'W&N', 'S&R', 'S&L', 'S&W', 'S&U', 'S&N', 'S&P', 'U&R', 'U&L', 'U&M', 'U&W', 'U&S', 'N&R', 'N&M', 'N&W', 'N&S', 'P&R', 'P&L', 'P&W', 'P&S', 'P&U');
  $aPlanetGlyph=array('A','R','L','M','V','W','J','S','U','N','P','C');
  
  $P = strtr(_PlanetNames,$translate_json);
  //$aPlanetName=explode(',',_PlanetNames);
  $aPlanetName=explode(',',$P);
  $aAspectDegree=array(360,180,120,240,90,270,60,300);
  $aAspectDegreeLo=array(3,3,3,3,3,3,3,3);
  $aAspectDegreeHi=array(1,1,1,1,1,1,1,1);
  $aAspectGlyph=array('&','%','/','/','+','+','*','*');

  $P1 = strtr(_AspectWords,$translate_json);
  $P2 = strtr(_AspectNames,$translate_json);
  //$aAspectWord=explode(',',_AspectWords);
  $aAspectWord=explode(',',$P1);
  //$aAspectName=explode(',',_AspectNames);
  $aAspectName=explode(',',$P2);
  $orbMax=max($aAspectDegreeLo)+16; 
  $orbMin=360-$orbMax;
  $sDateTime=$natYear.date('md.',safe_mktime(0,0,0,$natMonth,$natDay,$natYear)).$natTime;
  
  
  $aNatal = explode(",",$Longitude1);
  $aPoint = explode(",",$Points1);
  
  
  
 
  $aNatal[0]=$aPoint[3];
  $aNatal[]=$aPoint[4];
  
  $sDateTime=$useYear.date('md.Hi',safe_mktime(-$DST,0,0,$useMonth,$useDay,$useYear));
  
  $aTransitOne = explode(",",$Longitude2);
  
  
        
  
  
  
  $sDateTime=date('md.Hi',safe_mktime(-$DST,0,1,$useMonth,$useDay+1,$useYear));
  if(substr($sDateTime,0,4)=='0101'){
    $sDateTime=($useYear+1).$sDateTime;
  }else{
    $sDateTime=$useYear.$sDateTime;
  }
  
  $aTransitTwo = explode(",",$Longitude3);
  
  $aTransit=array(); 
  $aTransitAST=array(); 
  $iTransit=0;
  $ciPlanet=count($aTransitOne);
  $cjPlanet=count($aNatal);
  $aNatalA=array();
  for($jPlanet=0;$jPlanet<$cjPlanet;$jPlanet++){
    $aNatalA[$jPlanet]=abs($aNatal[$jPlanet]);
    if($aNatalA[$jPlanet]<=$orbMax)$aNatalA[$jPlanet]+=360;
  }
  $aRetro=array();
  for($iPlanet=1;$iPlanet<=$ciPlanet;$iPlanet++){
    $TransitOne=abs($aTransitOne[$iPlanet]);
    $TransitTwo=abs($aTransitTwo[$iPlanet]);
    if( ($TransitOne<=$orbMax) || ($TransitTwo<=$orbMax) ){
      if($TransitOne<=$orbMin) $TransitOne+=360;
      if($TransitTwo<=$orbMin) $TransitTwo+=360;
    }
    $fRetro[$iPlanet]=($TransitOne>$TransitTwo);
    for($jPlanet=0;$jPlanet<$cjPlanet;$jPlanet++){
      $Natal=$aNatalA[$jPlanet];
      $deltaOne=abs($TransitOne-$Natal);if($deltaOne<=$orbMax)$deltaOne+=360;
      $deltaTwo=abs($TransitTwo-$Natal);if($deltaTwo<=$orbMax)$deltaTwo+=360;
      $deltaLo=min($deltaOne,$deltaTwo);
      $deltaHi=max($deltaOne,$deltaTwo);
      reset($aAspectDegree);
      //while(list($iAspect,$AspectDegree)=each($aAspectDegree)){
      foreach ($aAspectDegree as $key => $value) {
        //echo "Key: $key, value: $value";
        $iAspect = $key;
        $AspectDegree = $value;
    
        $deltaOrbOne=abs($deltaOne-$AspectDegree);
        $deltaOrbTwo=abs($deltaTwo-$AspectDegree);
        if( ($fApply=($deltaOrbOne>$deltaOrbTwo)) ){
          $AspectDegreeOrb=$aAspectDegreeLo[$iAspect];
        }else{
          $AspectDegreeOrb=$aAspectDegreeHi[$iAspect];
        }
        $TransitLo=min($TransitOne,$TransitTwo);
        $TransitHi=max($TransitOne,$TransitTwo);
        $TransitDeg=$Natal-$AspectDegree;if($TransitDeg<=$orbMax)$TransitDeg+=360;
        if( !($fExact=($TransitLo<=$TransitDeg && $TransitDeg<=$TransitHi)) ){
          $TransitDeg=$Natal+$AspectDegree;if($TransitDeg>=$orbMax+360)$TransitDeg-=360;
          $fExact=($TransitLo<=$TransitDeg && $TransitDeg<=$TransitHi);
        }
        if($fExact){
          $iTransit++;
          $aTransit[$iTransit]=
                $aPlanetGlyph[$iPlanet].$aAspectGlyph[$iAspect].$aPlanetGlyph[$jPlanet];
          $aTransitAST[$iTransit]=
                DecToMin(abs( ($TransitDeg-$TransitOne)/($TransitOne-$TransitTwo) )*24);
          break;
        }elseif( min($deltaOrbOne,$deltaOrbTwo)<=$AspectDegreeOrb
              || $AspectDegreeOrb>=max($deltaOrbOne,$deltaOrbTwo) ){
          $iTransit++;
          $aTransit[$iTransit]=
                $aPlanetGlyph[$iPlanet].$aAspectGlyph[$iAspect].$aPlanetGlyph[$jPlanet];
          $aTransitAST[$iTransit]=$fApply ? '00' : '99';
          break;
        }
      }
    }
  }
  
  
  
  
  
  
  
  $t='';
  asort($aTransitAST);
  reset($aTransitAST);
  //while(list($kTransit,$TransitAST)=each($aTransitAST)){
  	
  	foreach ($aTransitAST as $key => $value) {
        //echo "Key: $key, value: $value";
        $kTransit = $key;
        $TransitAST = $value;
  	
  	
    $Transit=$aTransit[$kTransit];
    
    
    
    $pl = array('A' => 'Ascendant','R' => 'Sun','L' => 'Moon','M' => 'Mercury','V' => 'Venus','W' => 'Mars','J' => 'Jupiter','S' => 'Saturn','U' => 'Uranus','N' => 'Neptune','P' => 'Pluto','C' => 'Midheaven');
    $asp = array('&' => 'conjunction','%' => 'opposition','/' => 'trine','+' => 'square','*' => 'sextile');
    $iTransit=substr($Transit,0,1);
    $iAspect=substr($Transit,1,1);
    $iNatal=substr($Transit,2,1);
    
    $phrase_to_look_for = $pl["$iTransit"]." - ".$pl["$iNatal"]."|".$asp["$iAspect"]."|";
    $file = "dbase/users/transits-".$pl["$iTransit"].".txt";
    $text = FindText($phrase_to_look_for, 3, $file);
    
    if($text !== "NONE" ){
      $iTransit=array_search(substr($Transit,0,1),$aPlanetGlyph);
      $iAspect=array_search(substr($Transit,1,1),$aAspectGlyph);
      $iNatal=array_search(substr($Transit,2,1),$aPlanetGlyph);
      $name='<b>'.$aPlanetName[$iTransit].' '.$aAspectName[$iAspect].' '.$aPlanetName[$iNatal].'</b>';
      switch($TransitAST){
      case '00':
        $name.=' &nbsp; '.$translate_json[_applying];
        break;
      case '99':
        $name.=' &nbsp; '.$translate_json[_separating];
        break;
      default:
        $time=str_pad(sprintf('%02.2f',$TransitAST),5,'0',STR_PAD_LEFT);
        $AmPm=_AM;
        if($time>=12){
          if($time>=13)$time-=12;
          $AmPm=_PM;
        }elseif($time<1)$time+=12;
        $name.=' &nbsp; '.str_replace('.',':',sprintf('%01.2f',$time)).$AmPm;
      }
      if(in_array($Transit,$aBurdenConj)) $iAspect+=count($aAspectWord)-1;
      $name.=' &nbsp; <i>('.$aPlanetWord[$iTransit].' '.$aAspectWord[$iAspect].' '.$aPlanetWord[$iNatal].')</i>';
      $t.="<p style='text-align: justify;padding: 10px;'>$name<br>$text</p>\n";
    }
  }
  
  $t=str_replace('|','<br><br>',$t);
  echo $t;
  echo'
';
  if($DST){
    echo'<font color=black size=1><div align=right>'._TimeShownDST.'</div></font>';
  }
  echo'
</font>
</td>
</tr>
</table>
</center>
';
if($PageCount<0){
  
}
?> <?php
	
$showopt = 7;	
	
if($showopt < 3){goto contend;}
  $sApply='99';
  $sSepar='999';
  $aSignGlyph=array('a','t','g','m','l','v','b','i','s','c','q','p');
  $aBurdenConj=array('rCw', 'rCs', 'rCu', 'rCn', 'rCp', 'lCw', 'lCs', 'lCu', 'lCp', 'mCw', 'mCs', 'mCu', 'vCs', 'vCu', 'wCr', 'wCl', 'wCw', 'wCs', 'wCu', 'wCn', 'sCr', 'sCl', 'sCw', 'sCu', 'sCn', 'sCp', 'uCr', 'uCl', 'uCm', 'uCw', 'uCs', 'nCr', 'nCm', 'nCw', 'nCs', 'pCr', 'pCl', 'pCw', 'pCs', 'pCu');
  $aPlanetCode=array('a','r','l','m','v','w','j','s','u','n','p','c');
  $aPlanetGlyph=array('A','R','L','M','V','W','J','S','U','N','P','C');
  
  $aAspectDegree=array(360,180,120,240,90,270,60,300);
  $aAspectDegreeLo=array(3,3,3,3,3,3,3,3);
  $aAspectDegreeHi=array(1,1,1,1,1,1,1,1);
  $aAspectCode=array('C','O','T','T','S','S','X','X');
  $aAspectGlyph=array('&','%','/','/','+','+','*','*');
  $aPlanetName=explode(',',_PlanetNames);
  $orbMax=max($aAspectDegreeLo)+16; 
  $orbMin=360-$orbMax;
  $sDateTime=$natYear.date('md.',safe_mktime(0,0,0,$natMonth,$natDay,$natYear)).$natTime;
  
  
  $aNatal = explode(",",$Longitude1);
  $aPoint = explode(",",$Points1);
  $Declination = explode(",",$Declination1);
  $aHouse = explode(",",$HPos1);
  
  
  
  
  $aNatal[0]=$aPoint[3];
  $aNatal[]=$aPoint[4];
  
  
  $sDateTime=date('Ymd.Hi',mktime(-$DST,0,0,$useMonth,$useDay,$useYear));
  
  
  $aTransitOne = explode(",",$Longitude2);
  $aTransitDeclination = explode(",",$Declination2);
  $aTransitPoint = explode(",",$Points2);
  $aTransitHouse = explode(",",$Houses_2);
  
  
  
  $sDateTime=date('Ymd.Hi',mktime(-$DST,0,1,$useMonth,$useDay+1,$useYear));
  
  $aTransitTwo = explode(",",$Longitude3);
  
  
  $aTransit=array(); 
  $aTransitAST=array(); 
  $iTransit=0;
  $ciPlanet=count($aTransitOne);
  $cjPlanet=count($aNatal);
  $aNatalA=array();
  for($jPlanet=0;$jPlanet<$cjPlanet;$jPlanet++){
    $aNatalA[$jPlanet]=abs($aNatal[$jPlanet]);
    if($aNatalA[$jPlanet]<=$orbMax)$aNatalA[$jPlanet]+=360;
  }
  $aRetro=array();
  for($iPlanet=1;$iPlanet<=$ciPlanet;$iPlanet++){
    $TransitOne=abs($aTransitOne[$iPlanet]);
    $TransitTwo=abs($aTransitTwo[$iPlanet]);
    if( ($TransitOne<=$orbMax) || ($TransitTwo<=$orbMax) ){
      if($TransitOne<=$orbMin) $TransitOne+=360;
      if($TransitTwo<=$orbMin) $TransitTwo+=360;
    }
    $fRetro[$iPlanet]=($TransitOne>$TransitTwo);
    for($jPlanet=0;$jPlanet<$cjPlanet;$jPlanet++){
      $Natal=$aNatalA[$jPlanet];
      $deltaOne=abs($TransitOne-$Natal);if($deltaOne<=$orbMax)$deltaOne+=360;
      $deltaTwo=abs($TransitTwo-$Natal);if($deltaTwo<=$orbMax)$deltaTwo+=360;
      $deltaLo=min($deltaOne,$deltaTwo);
      $deltaHi=max($deltaOne,$deltaTwo);
      reset($aAspectDegree);
      //while(list($iAspect,$AspectDegree)=each($aAspectDegree)){
      	
      	foreach ($aAspectDegree as $key => $value) {
        //echo "Key: $key, value: $value";
        $iAspect = $key;
        $AspectDegree = $value;
      	
      	
        $deltaOrbOne=abs($deltaOne-$AspectDegree);
        $deltaOrbTwo=abs($deltaTwo-$AspectDegree);
        if( ($fApply=($deltaOrbOne>$deltaOrbTwo)) ){
          $AspectDegreeOrb=$aAspectDegreeLo[$iAspect];
        }else{
          $AspectDegreeOrb=$aAspectDegreeHi[$iAspect];
        }
        $TransitLo=min($TransitOne,$TransitTwo);
        $TransitHi=max($TransitOne,$TransitTwo);
        $TransitDeg=$Natal-$AspectDegree;if($TransitDeg<=$orbMax)$TransitDeg+=360;
        if( !($fExact=($TransitLo<=$TransitDeg && $TransitDeg<=$TransitHi)) ){
          $TransitDeg=$Natal+$AspectDegree;if($TransitDeg>=$orbMax+360)$TransitDeg-=360;
          $fExact=($TransitLo<=$TransitDeg && $TransitDeg<=$TransitHi);
        }
        if($fExact){
          $iTransit++;
          $aTransit[$iTransit]= $aPlanetCode[$iPlanet].$aAspectCode[$iAspect].$aPlanetCode[$jPlanet];
          $aTransitAST[$iTransit]= DecToMin(abs( ($TransitDeg-$TransitOne)/($TransitOne-$TransitTwo) )*24);
          break;
        }elseif( min($deltaOrbOne,$deltaOrbTwo)<=$AspectDegreeOrb  || $AspectDegreeOrb>=max($deltaOrbOne,$deltaOrbTwo) ){
          $iTransit++;
          $aTransit[$iTransit]= $aPlanetCode[$iPlanet].$aAspectCode[$iAspect].$aPlanetCode[$jPlanet];
          $aTransitAST[$iTransit]=$fApply ? $sApply : $sSepar;
          break;
        }
      }
    }
  }
echo'
<p><br><br></p>
<center>
<table id="table_data_3" name="table_data_3" style="border-collapse: collapse;border: 0px solid black;padding: 15px;border-spacing: 15px;background-color: white;width: 100%;"> <!-- 3th table -->
  <tr>
    <th colspan=13 style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;">
      <font face="'._FontFaceSansSerif.'" size=2>
' . $translate_json["Transiting Aspects (Summary)"] . '<br>'.$sDateHeading.'
      </font>
    </th>
  </tr>
  <tr>
    <th colspan=13 style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;">
      <font face="'._FontFaceSansSerif.'" size=1>
'.$translate_json["Natal Planets"].'
      </font>
    </th>
  </tr>
  <tr>
    <th style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;" valign=bottom>
<!--      <font face="'._FontFaceSansSerif.'" size=1>
'.$translate_json["Trans. Plan."].'
      </font> -->
    </th>
';
  for($iPlanet=0;$iPlanet<=11;$iPlanet++){
    echo'
    <td width="7.5%" style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;" class="tetra-font">
      <font face='._FontFaceZodiac.' size=4 color='.($aNatal[$iPlanet]<0?'red':'black').'>
'.$aPlanetGlyph[$iPlanet].'
      </font>
    </td>
';
  }
  echo'
  </tr>
';
  for($iPlanet=1;$iPlanet<=10;$iPlanet++){
    echo'
  <tr>
    <td width="10%" style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;" class="tetra-font">
      <font face='._FontFaceZodiac.' size=4 color='.($fRetro[$iPlanet]?'red':'black').'>
'.$aPlanetGlyph[$iPlanet].'
      </font>
    </td>
';
    for($jPlanet=0;$jPlanet<=11;$jPlanet++){
      echo'
    <td width="7.5%" style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;" class="tetra-font">
';
      $pMatch='/('.$aPlanetCode[$iPlanet].')\S('.$aPlanetCode[$jPlanet].')/';
      if(count($aMatch=preg_grep($pMatch,$aTransit))==0){
        echo'&nbsp;';
      }else{
        $iAspect=array_search( substr(end($aMatch),1,1) ,$aAspectCode);
        $iTransit=key($aMatch);
        if($aTransitAST[$iTransit]==$sApply){
        	
          
          echo '<font face='._FontFaceZodiac.' size=4 color=teal>'.$aAspectGlyph[$iAspect].'</font>';
        }elseif($aTransitAST[$iTransit]==$sSepar){
          
          
          echo '<font face='._FontFaceZodiac.' size=4 color=LightCoral>'.$aAspectGlyph[$iAspect].'</font>';
        }else{
          
          
          echo '<font face='._FontFaceZodiac.' size=4 color=blue>'.$aAspectGlyph[$iAspect].'</font>';
        }
      }
    echo'
    </td>
';
    }
    echo'
  </tr>
';
  }
  echo'
  <tr>
    <td colspan=13 style="text-align: center;border-bottom: 1px solid #ddd;background-color: white;">
  
<font face="'._FontFaceSansSerif.'" size=2>
<i><b>' . $translate_json['Aspects notes'] . ':</b> <font color=blue><b>' . $translate_json['exact is blue'] . '</b>, <font color=teal><b>' . $translate_json['applying is teal'] . '</b>, <font color=LightCoral><b>' . $translate_json['separating is light coral'] . '</b>, <font color=red><b>' . $translate_json['retrograde is red'] . '</b> (<font face='._FontFaceZodiac.' size=4><span class="tetra-font">&lt;</span></font>)</font></b></i>.
</font>	  
	  
	  
    </td>
  </tr>
</table>
</center>
</div>
<br>
</body>
</html>
';
function ShowHourGrid(){
  echo'
  <tr>
    <td style="text-align: center;border-bottom: 1px solid #ddd;">
      <font face="'._FontFaceSansSerif.'" size=2>&nbsp;&leftarrow;</font>
    </td>
    <td style="text-align: center;border-bottom: 1px solid #ddd;">
      <font face="'._FontFaceSansSerif.'" size=2>12</font>
    </td>
';
  for($i=1;$i<13;$i++){
    echo'
    <td style="text-align: center;border-bottom: 1px solid #ddd;">
      <font face="'._FontFaceSansSerif.'" size=2>'.(sprintf('%02.0f',$i)).'</font>
    </td>
';
  }
  for($i=1;$i<12;$i++){
    echo'
    <td style="text-align: center;border-bottom: 1px solid #ddd;">
      <font face="'._FontFaceSansSerif.'" size=2>'.(sprintf('%02.0f',$i)).'</font>
    </td>
';
  }
  echo'
    <td style="text-align: center;border-bottom: 1px solid #ddd;">
      <font face="'._FontFaceSansSerif.'" size=2>&nbsp;&rightarrow;&nbsp;</font>
    </td>
  </tr>
';
}
cont:
contend:
?> <?php
} else {
  /* Form */
  //echo "Nothing was inputed";
	
?>  <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/html2canvas.min.js"> </script> <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/jquery.min.js"> </script> <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/jquery-ui.min.js"> </script> <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('Tetrabyblos') ?>/js/jquery-ui.css"/> <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('Tetrabyblos') ?>/css/w3.css"> <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/moment.js"> </script> <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/moment-timezone-with-data.js"> </script> <script type='text/javascript' src='<?php echo plugins_url('Tetrabyblos') ?>/js/ephemeris-0.1.0.js' charset='utf-8'> </script> <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/astrochart.js"> </script> <script src="<?php echo plugins_url('Tetrabyblos') ?>/js/canvg.js"> </script> <?php
$translate_json = function_exists( 'tetrabyblos_get_translation_json' ) ? tetrabyblos_get_translation_json() : array();
$translate_main = json_encode( $translate_json );

$options = function_exists( 'tetrabyblos_get_settings_array' ) ? tetrabyblos_get_settings_array() : get_option( 'byblos_settings' );
if ( ! is_array( $options ) ) {
  $options = array();
}
$options['byblos_select_field_3'] = empty( $options['byblos_select_field_3'] ) ? '0' : $options['byblos_select_field_3'];
$scale = $options['byblos_select_field_3'];
$scale_per = $scale*100;
$scale_width = 720*$scale;
		
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
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;

	color: darkgray;
}
.tab button:hover {
    background-color: #ddd;
}
.tab button.active {
    background-color: #ccc;
}
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
	
}
.tabcontent2 {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
	
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
$options['byblos_text_field_title_1'] = empty( $options['byblos_text_field_title_1'] ) ? "Natal Chart Calculation" : $options['byblos_text_field_title_1'];
$title_1 = $options['byblos_text_field_title_1'];
$options['byblos_checkbox_field_bnow'] = empty( $options['byblos_checkbox_field_bnow'] ) ? 0 : 1;		
$bnow = $options['byblos_checkbox_field_bnow'];

$options['byblos_checkbox_field_print'] = empty( $options['byblos_checkbox_field_print'] ) ? 0 : 1;		
$bprint = $options['byblos_checkbox_field_print'];
?> <script type="text/javascript">jQuery(document).ready(function($){function tbaSe(){var x=document.myForm.year.value;var y=document.myForm.era.value;var v=x*y;if(v< -10000||v>10000){return false;}else{return true;}};function tbbse(lat,lng,tz,loc){var fssw_av=Math.abs(lat);var LatDeg=Math.floor(fssw_av);var LatMin=(Math.floor((fssw_av-LatDeg)*60));var LatCardinal=((lat>0)?1: -1);var fssw_aP=Math.abs(lng);var LngDeg=Math.floor(fssw_aP);var LngMin=(Math.floor((fssw_aP-LngDeg)*60));var fssw_bz=((lng>0)?1: -1);document.getElementById("lat_deg").value=LatDeg;document.getElementById("lat_min").value=LatMin;document.getElementById("long_deg").value=LngDeg;document.getElementById("long_min").value=LngMin;document.getElementById("ns").value=LatCardinal;document.getElementById("ew").value=fssw_bz;document.getElementById("timezone").value=tz;document.getElementById("full_name").value=loc;document.getElementById("zoneoffset").value="99";return;};jQuery(function(){var getData=function(request,response){$.getJSON("<?php echo plugins_url('Tetrabyblos') ?>/data/getautocomplete.php?jsonp=?",{term:request.term,country_id:document.getElementById("country_id").value,atlas:document.getElementById("atlas").value},function(data){response(data);l=document.getElementById("cname").value;len=l.length;if(data.length===0&&len>0){$("#empty-message").html("<b>No results were found...</b> Please input a <i>nearby city from the place of birth <b>(strongly advised)</b></i> or input below the <i>place\'s coordinates along with the <b>correct timezone</b> for the date of birth.</i>");}else{$("#empty-message").empty("<i>Longitude, latitude and timezone are automatically calculated from birth place.</i>");}});};var selectItem=function(event,ui){$("#cname").val(ui.item.label);$("#full_name").val(ui.item.label);$("#latitude").val(ui.item.latitude);$("#longitude").val(ui.item.longitude);$("#timezone").val(ui.item.timezone);document.getElementById("empty-message").innerHTML="<i>Longitude, latitude and timezone are automatically calculated from birth place.</i>";tbbse(ui.item.latitude,ui.item.longitude,ui.item.timezone,ui.item.label);return false;};$("#cname").autocomplete({source:getData,select:selectItem,minLength:3,change:function(){}});});}); </script> <span style="font-family:HamburgSymbols;color:#FFF;font-weight:bold;visibility:hidden;"></span> <span style="font-family:Merriweather;color:#FFF;font-weight:bold;visibility:hidden;"></span> <div class="w3-content" name="main_astro_div" id="main_astro_div" style="background-color:white;padding:10px;border:0px solid grey;border-radius:15px;">  <div class="tetra-font"> <h2 class="tetra-h2"><?php echo $title_1; ?></h2> <p class="tetra-font-mobile"><?php echo $translate_json["Please enter your birth details below."]; ?></p> </div>  <br> <div id="enter_name" name="enter_name"></div> <h3 class="tetra-h3"><?php echo $translate_json["Your Name"]; ?></h3> <input class="w3-input w3-border tetra-font" type="text" name="name" id="name" style="max-width:250px"> <div id="name_error" name="name_error" class="tetra-font-mobile"> </div> <br> <h3 class="tetra-h3"><?php echo $translate_json["Birth time"]; ?>:</h3> <br> <script>function tbbSe(obj){if($(obj).is(":checked")){var tth=document.getElementById("hour");tth.value=12;var ttm=document.getElementById("minute");ttm.value=0;tbAe();$("#page-header-inner").addClass("sticky");}else{var tth=document.getElementById("hour");tth.value=0;var ttm=document.getElementById("minute");ttm.value=0;tbAe();}} </script> <input class="tetra-font" type="checkbox" name="TT_sticky_header" id="TT_sticky_header_function" value="{TT_sticky_header}" onchange="tbbSe(this)"/> Unknow time birth<br><br> <div class="tab tetra-h3"> <button class="tablinks" onclick="tbve(event,'European')" id="defaultOpen"><?php echo $translate_json["24 hours style"]; ?></button> <button class="tablinks" onclick="tbve(event,'AM/PM')"><?php echo $translate_json["12 hours style (AM/PM)"]; ?></button> </div> <div id="European" class="tabcontent tetra-font"> <div class="w3-row-padding"> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Hours (0 to 23)"]; ?>:</label> <select class="w3-select w3-border" name="hour" id="hour" onchange="javascript:tbAe();"> <option value="0" selected>00</option> <option value="1">01</option> <option value="2">02</option> <option value="3">03</option> <option value="4">04</option> <option value="5">05</option> <option value="6">06</option> <option value="7">07</option> <option value="8">08</option> <option value="9">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> </select> </div> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label> <select class="w3-select w3-border" name="minute" id="minute" onchange="javascript:tbAe();"> <option value="0" selected>00</option> <option value="1">01</option> <option value="2">02</option> <option value="3">03</option> <option value="4">04</option> <option value="5">05</option> <option value="6">06</option> <option value="7">07</option> <option value="8">08</option> <option value="9">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> <option value="32">32</option> <option value="33">33</option> <option value="34">34</option> <option value="35">35</option> <option value="36">36</option> <option value="37">37</option> <option value="38">38</option> <option value="39">39</option> <option value="40">40</option> <option value="41">41</option> <option value="42">42</option> <option value="43">43</option> <option value="44">44</option> <option value="45">45</option> <option value="46">46</option> <option value="47">47</option> <option value="48">48</option> <option value="49">49</option> <option value="50">50</option> <option value="51">51</option> <option value="52">52</option> <option value="53">53</option> <option value="54">54</option> <option value="55">55</option> <option value="56">56</option> <option value="57">57</option> <option value="58">58</option> <option value="59">59</option> </select> </div> </div> <br> </div> <div id="AM/PM" class="tabcontent tetra-font"> <div class="w3-row-padding"> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Hours (1 to 12)"]; ?>:</label> <select class="w3-select w3-border" name="hour_american" id="hour_american" onchange="javascript:tbAe();"> <option value="1" selected>01</option> <option value="2">02</option> <option value="3">03</option> <option value="4">04</option> <option value="5">05</option> <option value="6">06</option> <option value="7">07</option> <option value="8">08</option> <option value="9">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> </select> </div> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label> <select class="w3-select w3-border" name="minute_american" id="minute_american" onchange="javascript:tbAe();"> <option value="0" selected>00</option> <option value="1">01</option> <option value="2">02</option> <option value="3">03</option> <option value="4">04</option> <option value="5">05</option> <option value="6">06</option> <option value="7">07</option> <option value="8">08</option> <option value="9">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> <option value="32">32</option> <option value="33">33</option> <option value="34">34</option> <option value="35">35</option> <option value="36">36</option> <option value="37">37</option> <option value="38">38</option> <option value="39">39</option> <option value="40">40</option> <option value="41">41</option> <option value="42">42</option> <option value="43">43</option> <option value="44">44</option> <option value="45">45</option> <option value="46">46</option> <option value="47">47</option> <option value="48">48</option> <option value="49">49</option> <option value="50">50</option> <option value="51">51</option> <option value="52">52</option> <option value="53">53</option> <option value="54">54</option> <option value="55">55</option> <option value="56">56</option> <option value="57">57</option> <option value="58">58</option> <option value="59">59</option> </select> </div> <div class="w3-third"> <label class="tetra-font-mobile">AM/PM</label> <select class="w3-select w3-border" name="ampm_american" id="ampm_american" onchange="javascript:tbAe();"> <option value="0" selected>A.M.</option> <option value="1">P.M</option> </select> </div> </div> <br> </div> <?php 
if($bnow < 1){
?> <br> <div class='w3-center'> <div class='w3-bar'> <p> <button class='w3-button w3-blue w3-large w3-round' name='now_button' id='now_button' style='font-family:Merriweather;' onclick='javascript:tbbMe();'><?php echo $translate_json["Now"]; ?></button> </p> </div> </div> <?php
}
?> <script>function tbbMe(){var d=new Date();var x=document.getElementById("hour");x.value=d.getHours();var y=document.getElementById("minute");y.value=d.getMinutes();var hh=x.value;var mm=y.value;var ampm=0;if(hh>12){hh-=12;ampm=1;if(hh==0){hh=12;}}if(hh==0){hh=12;ampm=1;}document.getElementById('hour_american').value=hh;document.getElementById('minute_american').value=mm;document.getElementById('ampm_american').value=ampm;} </script> <br> <h3 class="tetra-h3"><?php echo $translate_json["Birth date"]; ?>:</h3> <br> <div class="w3-row-padding tetra-font"> <div class="w3-quarter"> <label class="tetra-font-mobile"><?php echo $translate_json["Day"]; ?>:</label> <select class="w3-select w3-border" name="day" id="day"> <option value="1" selected>01</option> <option value="2">02</option> <option value="3">03</option> <option value="4">04</option> <option value="5">05</option> <option value="6">06</option> <option value="7">07</option> <option value="8">08</option> <option value="9">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> </select> </div> <div class="w3-half"> <label class="tetra-font-mobile"><?php echo $translate_json["Month"]; ?>:</label> <select class="w3-select w3-border" name="month" id="month"> <option value="1" selected><?php echo $translate_json["January"]; ?></option> <option value="2"><?php echo $translate_json["February"]; ?></option> <option value="3"><?php echo $translate_json["March"]; ?></option> <option value="4"><?php echo $translate_json["April"]; ?></option> <option value="5"><?php echo $translate_json["May"]; ?></option> <option value="6"><?php echo $translate_json["June"]; ?></option> <option value="7"><?php echo $translate_json["July"]; ?></option> <option value="8"><?php echo $translate_json["August"]; ?></option> <option value="9"><?php echo $translate_json["September"]; ?></option> <option value="10"><?php echo $translate_json["October"]; ?></option> <option value="11"><?php echo $translate_json["November"]; ?></option> <option value="12"><?php echo $translate_json["December"]; ?></option> </select> </div> </div> <br> <div class="w3-row-padding tetra-font"> <div class="w3-half"> <label class="tetra-font-mobile"><?php echo $translate_json["Year"]; ?>:</label> <input class="w3-input w3-border" type="text" name="year" id="year" value="1999"> </div> <div class="w3-half tetra-font"> <label class="tetra-font-mobile"><?php echo $translate_json["Era"]; ?>:</label> <select class="w3-select w3-border" name="era" id="era"> <option value="1" selected><?php echo $translate_json["AD - Anno Domini"]; ?></option> <option value="-1"><?php echo $translate_json["BC - Before Christ"]; ?></option> </select> </div> </div> <?php 
if($bnow < 1){
?> <br> <div class='w3-center'> <div class='w3-bar'> <p> <button class='w3-button w3-blue w3-large w3-round' name='now_date_button' id='now_date_button' style='font-family:Merriweather;' onclick='javascript:tbbbe();'><?php echo $translate_json["Now"]; ?></button> </p> </div> </div> <?php
}
?> <script>function tbbbe(){var d=new Date();var x1=document.getElementById("day");x1.value=d.getDate();var y1=document.getElementById("month");y1.value=d.getMonth()+1;var z1=document.getElementById("year");z1.value=d.getFullYear();var z2=document.getElementById("era");z2.value=1;} </script> <br> <input type="hidden" name="era" id="era" value="1"> <br> <br> <div class="tab tetra-font"> <button class="tablinks2" onclick="tbre(event,'birthcity')" id="defaultOpen2"><?php echo $translate_json["City of birth"]; ?></button> <button class="tablinks2" onclick="tbre(event,'birthcoordinates')"><?php echo $translate_json["Manual Coordinates"]; ?></button> </div> <div id="birthcity" class="tabcontent2"> <h3 class="tetra-h3"><?php echo $translate_json["Country"]; ?>:</h3><br> <select class="w3-select w3-border tetra-font" name="country_id" id="country_id" onchange="javascript:document.getElementById('cname').value=''"> <option value="AF">Afghanistan</option> <option value="AX">Aland Islands</option> <option value="AL">Albania</option> <option value="DZ">Algeria</option> <option value="AS">American Samoa</option> <option value="AD">Andorra</option> <option value="AO">Angola</option> <option value="AI">Anguilla</option> <option value="AQ">Antarctica</option> <option value="AG">Antigua and Barbuda</option> <option value="AR">Argentina</option> <option value="AM">Armenia</option> <option value="AW">Aruba</option> <option value="AU">Australia</option> <option value="AT">Austria</option> <option value="AZ">Azerbaijan</option> <option value="BS">Bahamas</option> <option value="BH">Bahrain</option> <option value="BD">Bangladesh</option> <option value="BB">Barbados</option> <option value="BY">Belarus</option> <option value="BE">Belgium</option> <option value="BZ">Belize</option> <option value="BJ">Benin</option> <option value="BM">Bermuda</option> <option value="BT">Bhutan</option> <option value="BO">Bolivia</option> <option value="BQ">Bonaire, Saint Eustatius and Saba </option> <option value="BA">Bosnia and Herzegovina</option> <option value="BW">Botswana</option> <option value="BV">Bouvet Island</option> <option value="BR">Brazil</option> <option value="IO">British Indian Ocean Territory</option> <option value="VG">British Virgin Islands</option> <option value="BN">Brunei</option> <option value="BG">Bulgaria</option> <option value="BF">Burkina Faso</option> <option value="BI">Burundi</option> <option value="KH">Cambodia</option> <option value="CM">Cameroon</option> <option value="CA">Canada</option> <option value="CV">Cape Verde</option> <option value="KY">Cayman Islands</option> <option value="CF">Central African Republic</option> <option value="TD">Chad</option> <option value="CL">Chile</option> <option value="CN">China</option> <option value="CX">Christmas Island</option> <option value="CC">Cocos Islands</option> <option value="CO">Colombia</option> <option value="KM">Comoros</option> <option value="CK">Cook Islands</option> <option value="CR">Costa Rica</option> <option value="HR">Croatia</option> <option value="CU">Cuba</option> <option value="CW">Curacao</option> <option value="CY">Cyprus</option> <option value="CZ">Czech Republic</option> <option value="CD">Democratic Republic of the Congo</option> <option value="DK">Denmark</option> <option value="DJ">Djibouti</option> <option value="DM">Dominica</option> <option value="DO">Dominican Republic</option> <option value="TL">East Timor</option> <option value="EC">Ecuador</option> <option value="EG">Egypt</option> <option value="SV">El Salvador</option> <option value="GQ">Equatorial Guinea</option> <option value="ER">Eritrea</option> <option value="EE">Estonia</option> <option value="ET">Ethiopia</option> <option value="FK">Falkland Islands</option> <option value="FO">Faroe Islands</option> <option value="FJ">Fiji</option> <option value="FI">Finland</option> <option value="FR">France</option> <option value="GF">French Guiana</option> <option value="PF">French Polynesia</option> <option value="TF">French Southern Territories</option> <option value="GA">Gabon</option> <option value="GM">Gambia</option> <option value="GE">Georgia</option> <option value="DE">Germany</option> <option value="GH">Ghana</option> <option value="GI">Gibraltar</option> <option value="GR">Greece</option> <option value="GL">Greenland</option> <option value="GD">Grenada</option> <option value="GP">Guadeloupe</option> <option value="GU">Guam</option> <option value="GT">Guatemala</option> <option value="GG">Guernsey</option> <option value="GN">Guinea</option> <option value="GW">Guinea-Bissau</option> <option value="GY">Guyana</option> <option value="HT">Haiti</option> <option value="HM">Heard Island and McDonald Islands</option> <option value="HN">Honduras</option> <option value="HK">Hong Kong</option> <option value="HU">Hungary</option> <option value="IS">Iceland</option> <option value="IN">India</option> <option value="ID">Indonesia</option> <option value="IR">Iran</option> <option value="IQ">Iraq</option> <option value="IE">Ireland</option> <option value="IM">Isle of Man</option> <option value="IL">Israel</option> <option value="IT">Italy</option> <option value="CI">Ivory Coast</option> <option value="JM">Jamaica</option> <option value="JP">Japan</option> <option value="JE">Jersey</option> <option value="JO">Jordan</option> <option value="KZ">Kazakhstan</option> <option value="KE">Kenya</option> <option value="KI">Kiribati</option> <option value="XK">Kosovo</option> <option value="KW">Kuwait</option> <option value="KG">Kyrgyzstan</option> <option value="LA">Laos</option> <option value="LV">Latvia</option> <option value="LB">Lebanon</option> <option value="LS">Lesotho</option> <option value="LR">Liberia</option> <option value="LY">Libya</option> <option value="LI">Liechtenstein</option> <option value="LT">Lithuania</option> <option value="LU">Luxembourg</option> <option value="MO">Macao</option> <option value="MK">Macedonia</option> <option value="MG">Madagascar</option> <option value="MW">Malawi</option> <option value="MY">Malaysia</option> <option value="MV">Maldives</option> <option value="ML">Mali</option> <option value="MT">Malta</option> <option value="MH">Marshall Islands</option> <option value="MQ">Martinique</option> <option value="MR">Mauritania</option> <option value="MU">Mauritius</option> <option value="YT">Mayotte</option> <option value="MX">Mexico</option> <option value="FM">Micronesia</option> <option value="MD">Moldova</option> <option value="MC">Monaco</option> <option value="MN">Mongolia</option> <option value="ME">Montenegro</option> <option value="MS">Montserrat</option> <option value="MA">Morocco</option> <option value="MZ">Mozambique</option> <option value="MM">Myanmar</option> <option value="NA">Namibia</option> <option value="NR">Nauru</option> <option value="NP">Nepal</option> <option value="NL">Netherlands</option> <option value="AN">Netherlands Antilles</option> <option value="NC">New Caledonia</option> <option value="NZ">New Zealand</option> <option value="NI">Nicaragua</option> <option value="NE">Niger</option> <option value="NG">Nigeria</option> <option value="NU">Niue</option> <option value="NF">Norfolk Island</option> <option value="KP">North Korea</option> <option value="MP">Northern Mariana Islands</option> <option value="NO">Norway</option> <option value="OM">Oman</option> <option value="PK">Pakistan</option> <option value="PW">Palau</option> <option value="PS">Palestinian Territory</option> <option value="PA">Panama</option> <option value="PG">Papua New Guinea</option> <option value="PY">Paraguay</option> <option value="PE">Peru</option> <option value="PH">Philippines</option> <option value="PN">Pitcairn</option> <option value="PL">Poland</option> <option value="PT">Portugal</option> <option value="PR">Puerto Rico</option> <option value="QA">Qatar</option> <option value="CG">Republic of the Congo</option> <option value="RE">Reunion</option> <option value="RO">Romania</option> <option value="RU">Russia</option> <option value="RW">Rwanda</option> <option value="BL">Saint Barthelemy</option> <option value="SH">Saint Helena</option> <option value="KN">Saint Kitts and Nevis</option> <option value="LC">Saint Lucia</option> <option value="MF">Saint Martin</option> <option value="PM">Saint Pierre and Miquelon</option> <option value="VC">Saint Vincent and the Grenadines</option> <option value="WS">Samoa</option> <option value="SM">San Marino</option> <option value="ST">Sao Tome and Principe</option> <option value="SA">Saudi Arabia</option> <option value="SN">Senegal</option> <option value="RS">Serbia</option> <option value="CS">Serbia and Montenegro</option> <option value="SC">Seychelles</option> <option value="SL">Sierra Leone</option> <option value="SG">Singapore</option> <option value="SX">Sint Maarten</option> <option value="SK">Slovakia</option> <option value="SI">Slovenia</option> <option value="SB">Solomon Islands</option> <option value="SO">Somalia</option> <option value="ZA">South Africa</option> <option value="GS">South Georgia and the South Sandwich Islands</option> <option value="KR">South Korea</option> <option value="SS">South Sudan</option> <option value="ES">Spain</option> <option value="LK">Sri Lanka</option> <option value="SD">Sudan</option> <option value="SR">Suriname</option> <option value="SJ">Svalbard and Jan Mayen</option> <option value="SZ">Swaziland</option> <option value="SE">Sweden</option> <option value="CH">Switzerland</option> <option value="SY">Syria</option> <option value="TW">Taiwan</option> <option value="TJ">Tajikistan</option> <option value="TZ">Tanzania</option> <option value="TH">Thailand</option> <option value="TG">Togo</option> <option value="TK">Tokelau</option> <option value="TO">Tonga</option> <option value="TT">Trinidad and Tobago</option> <option value="TN">Tunisia</option> <option value="TR">Turkey</option> <option value="TM">Turkmenistan</option> <option value="TC">Turks and Caicos Islands</option> <option value="TV">Tuvalu</option> <option value="VI">U.S. Virgin Islands</option> <option value="UG">Uganda</option> <option value="UA">Ukraine</option> <option value="AE">United Arab Emirates</option> <option value="GB">United Kingdom</option> <option value="US" selected>United States</option> <option value="UM">United States Minor Outlying Islands</option> <option value="UY">Uruguay</option> <option value="UZ">Uzbekistan</option> <option value="VU">Vanuatu</option> <option value="VA">Vatican</option> <option value="VE">Venezuela</option> <option value="VN">Vietnam</option> <option value="WF">Wallis and Futuna</option> <option value="EH">Western Sahara</option> <option value="YE">Yemen</option> <option value="ZM">Zambia</option> <option value="ZW">Zimbabwe</option> </select> <br> <br> <h3 class="tetra-h3"><?php echo $translate_json["Birth City"]; ?>:</h3> <div class="ui-widget tetra-font" style="width:100%;"> <input class="w3-input w3-border" type="text" id="cname"> </div> <br><p id="empty-message" class="tetra-font-mobile" style="font-size:12px;text-align:justify;"><i>Longitude, latitude and timezone are automatically calculated from birth place.</i></p> <input type="hidden" name="atlas" id="atlas" value="0"> <br> <br> </div> <div id="birthcoordinates" class="tabcontent2"> <h3 class="tetra-h3"><?php echo $translate_json["Time zone"]; ?>:</h3><br> <select class="w3-select w3-border tetra-font" name="zoneoffset" id="zoneoffset"> <option value="99" selected="selected"> <?php echo $translate_json["Auto detect from location"]; ?> </option> <option value="0">Greenwich Mean Time - GMT or UT</option> <option value="-12">GMT -12:00 hrs - IDLW</option><option value="-11">GMT -11:00 hrs - BET or NT</option> <option value="-10.5">GMT -10:30 hrs - HST</option><option value="-10">GMT -10:00 hrs - AHST</option> <option value="-9.5">GMT -09:30 hrs - HDT or HWT</option> <option value="-9">GMT -09:00 hrs - YST or AHDT or AHWT</option> <option value="-8">GMT -08:00 hrs - PST or YDT or YWT</option> <option value="-7">GMT -07:00 hrs - MST or PDT or PWT</option> <option value="-6">GMT -06:00 hrs - CST or MDT or MWT</option> <option value="-5">GMT -05:00 hrs - EST or CDT or CWT</option> <option value="-4">GMT -04:00 hrs - AST or EDT or EWT</option> <option value="-3.5">GMT -03:30 hrs - NST</option> <option value="-3">GMT -03:00 hrs - BZT2 or AWT</option> <option value="-2">GMT -02:00 hrs - AT</option> <option value="-1">GMT -01:00 hrs - WAT</option> <option value="1">GMT +01:00 hrs - CET or MET or BST</option> <option value="2">GMT +02:00 hrs - EET or CED or MED or BDST or BWT</option> <option value="3">GMT +03:00 hrs - BAT or EED</option> <option value="3.5">GMT +03:30 hrs - IT</option> <option value="4">GMT +04:00 hrs - USZ3</option> <option value="5">GMT +05:00 hrs - USZ4</option> <option value="5.5">GMT +05:30 hrs - IST</option> <option value="6">GMT +06:00 hrs - USZ5</option> <option value="6.5">GMT +06:30 hrs - NST</option> <option value="7">GMT +07:00 hrs - SST or USZ6</option> <option value="7.5">GMT +07:30 hrs - JT</option> <option value="8">GMT +08:00 hrs - AWST or CCT</option> <option value="8.5">GMT +08:30 hrs - MT</option> <option value="9">GMT +09:00 hrs - JST or AWDT</option> <option value="9.5">GMT +09:30 hrs - ACST or SAT or SAST</option> <option value="10">GMT +10:00 hrs - AEST or GST</option> <option value="10.5">GMT +10:30 hrs - ACDT or SDT or SAD</option> <option value="11">GMT +11:00 hrs - UZ10 or AEDT</option> <option value="11.5">GMT +11:30 hrs - NZ</option> <option value="12">GMT +12:00 hrs - NZT or IDLE</option> <option value="12.5">GMT +12:30 hrs - NZS</option> <option value="13">GMT +13:00 hrs - NZST</option> </select> <br> <br> <h3 class="tetra-h3"><?php echo $translate_json["Latitude"]; ?>:</h3> <br> <div class="w3-row-padding tetra-font"> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Degrees"]; ?>:</label> <select class="w3-select w3-border" name="lat_deg" id="lat_deg"> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> <option value="32">32</option> <option value="33">33</option> <option value="34">34</option> <option value="35">35</option> <option value="36">36</option> <option value="37">37</option> <option value="38">38</option> <option value="39">39</option> <option value="40">40</option> <option value="41">41</option> <option value="42">42</option> <option value="43">43</option> <option value="44">44</option> <option value="45">45</option> <option value="46">46</option> <option value="47">47</option> <option value="48">48</option> <option value="49">49</option> <option value="50">50</option> <option value="51">51</option> <option value="52">52</option> <option value="53">53</option> <option value="54">54</option> <option value="55">55</option> <option value="56">56</option> <option value="57">57</option> <option value="58">58</option> <option value="59">59</option> <option value="60">60</option> <option value="61">61</option> <option value="62">62</option> <option value="63">63</option> <option value="64">64</option> <option value="65">65</option> <option value="66">66</option> <option value="67">67</option> <option value="68">68</option> <option value="69">69</option> <option value="70">70</option> <option value="71">71</option> <option value="72">72</option> <option value="73">73</option> <option value="74">74</option> <option value="75">75</option> <option value="76">76</option> <option value="77">77</option> <option value="78">78</option> <option value="79">79</option> <option value="80">80</option> <option value="81">81</option> <option value="82">82</option> <option value="83">83</option> <option value="84">84</option> <option value="85">85</option> <option value="86">86</option> <option value="87">87</option> <option value="88">88</option> <option value="89">89</option> <option value="90">90</option> </select> </div> <div class="w3-third tetra-font"> <label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label> <select class="w3-select w3-border" name="lat_min" id="lat_min"> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> <option value="32">32</option> <option value="33">33</option> <option value="34">34</option> <option value="35">35</option> <option value="36">36</option> <option value="37">37</option> <option value="38">38</option> <option value="39">39</option> <option value="40">40</option> <option value="41">41</option> <option value="42">42</option> <option value="43">43</option> <option value="44">44</option> <option value="45">45</option> <option value="46">46</option> <option value="47">47</option> <option value="48">48</option> <option value="49">49</option> <option value="50">50</option> <option value="51">51</option> <option value="52">52</option> <option value="53">53</option> <option value="54">54</option> <option value="55">55</option> <option value="56">56</option> <option value="57">57</option> <option value="58">58</option> <option value="59">59</option> </select> </div> <div class="w3-third tetra-font"> <label class="tetra-font-mobile"><?php echo $translate_json["North"]; ?>/<?php echo $translate_json["South"]; ?>:</label> <select class="w3-select w3-border" name="ns" id="ns"> <option value="1"><?php echo $translate_json["North"]; ?></option> <option value="-1"><?php echo $translate_json["South"]; ?></option> </select> </div> </div> <br> <br> <h3 class="tetra-h3"><?php echo $translate_json["Longitude"]; ?>:</h3> <br> <div class="w3-row-padding tetra-font"> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Degrees"]; ?>:</label> <select class="w3-select w3-border" name="long_deg" id="long_deg"> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> <option value="32">32</option> <option value="33">33</option> <option value="34">34</option> <option value="35">35</option> <option value="36">36</option> <option value="37">37</option> <option value="38">38</option> <option value="39">39</option> <option value="40">40</option> <option value="41">41</option> <option value="42">42</option> <option value="43">43</option> <option value="44">44</option> <option value="45">45</option> <option value="46">46</option> <option value="47">47</option> <option value="48">48</option> <option value="49">49</option> <option value="50">50</option> <option value="51">51</option> <option value="52">52</option> <option value="53">53</option> <option value="54">54</option> <option value="55">55</option> <option value="56">56</option> <option value="57">57</option> <option value="58">58</option> <option value="59">59</option> <option value="60">60</option> <option value="61">61</option> <option value="62">62</option> <option value="63">63</option> <option value="64">64</option> <option value="65">65</option> <option value="66">66</option> <option value="67">67</option> <option value="68">68</option> <option value="69">69</option> <option value="70">70</option> <option value="71">71</option> <option value="72">72</option> <option value="73">73</option> <option value="74">74</option> <option value="75">75</option> <option value="76">76</option> <option value="77">77</option> <option value="78">78</option> <option value="79">79</option> <option value="80">80</option> <option value="81">81</option> <option value="82">82</option> <option value="83">83</option> <option value="84">84</option> <option value="85">85</option> <option value="86">86</option> <option value="87">87</option> <option value="88">88</option> <option value="89">89</option> <option value="90">90</option> <option value="91">91</option> <option value="92">92</option> <option value="93">93</option> <option value="94">94</option> <option value="95">95</option> <option value="96">96</option> <option value="97">97</option> <option value="98">98</option> <option value="99">99</option> <option value="100">100</option> <option value="101">101</option> <option value="102">102</option> <option value="103">103</option> <option value="104">104</option> <option value="105">105</option> <option value="106">106</option> <option value="107">107</option> <option value="108">108</option> <option value="109">109</option> <option value="110">110</option> <option value="111">111</option> <option value="112">112</option> <option value="113">113</option> <option value="114">114</option> <option value="115">115</option> <option value="116">116</option> <option value="117">117</option> <option value="118">118</option> <option value="119">119</option> <option value="120">120</option> <option value="121">121</option> <option value="122">122</option> <option value="123">123</option> <option value="124">124</option> <option value="125">125</option> <option value="126">126</option> <option value="127">127</option> <option value="128">128</option> <option value="129">129</option> <option value="130">130</option> <option value="131">131</option> <option value="132">132</option> <option value="133">133</option> <option value="134">134</option> <option value="135">135</option> <option value="136">136</option> <option value="137">137</option> <option value="138">138</option> <option value="139">139</option> <option value="140">140</option> <option value="141">141</option> <option value="142">142</option> <option value="143">143</option> <option value="144">144</option> <option value="145">145</option> <option value="146">146</option> <option value="147">147</option> <option value="148">148</option> <option value="149">149</option> <option value="150">150</option> <option value="151">151</option> <option value="152">152</option> <option value="153">153</option> <option value="154">154</option> <option value="155">155</option> <option value="156">156</option> <option value="157">157</option> <option value="158">158</option> <option value="159">159</option> <option value="160">160</option> <option value="161">161</option> <option value="162">162</option> <option value="163">163</option> <option value="164">164</option> <option value="165">165</option> <option value="166">166</option> <option value="167">167</option> <option value="168">168</option> <option value="169">169</option> <option value="170">170</option> <option value="171">171</option> <option value="172">172</option> <option value="173">173</option> <option value="174">174</option> <option value="175">175</option> <option value="176">176</option> <option value="177">177</option> <option value="178">178</option> <option value="179">179</option> <option value="180">180</option> </select> </div> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["Minutes"]; ?>:</label> <select class="w3-select w3-border" name="long_min" id="long_min"> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> <option value="32">32</option> <option value="33">33</option> <option value="34">34</option> <option value="35">35</option> <option value="36">36</option> <option value="37">37</option> <option value="38">38</option> <option value="39">39</option> <option value="40">40</option> <option value="41">41</option> <option value="42">42</option> <option value="43">43</option> <option value="44">44</option> <option value="45">45</option> <option value="46">46</option> <option value="47">47</option> <option value="48">48</option> <option value="49">49</option> <option value="50">50</option> <option value="51">51</option> <option value="52">52</option> <option value="53">53</option> <option value="54">54</option> <option value="55">55</option> <option value="56">56</option> <option value="57">57</option> <option value="58">58</option> <option value="59">59</option> </select> </div> <div class="w3-third"> <label class="tetra-font-mobile"><?php echo $translate_json["East"]; ?>/<?php echo $translate_json["West"]; ?>:</label> <select class="w3-select w3-border" name="ew" id="ew"> <option value="1" selected><?php echo $translate_json["East"]; ?></option> <option value="-1"><?php echo $translate_json["West"]; ?></option> </select> </div> </div> <br> <br> </div> <div id="city_error" name="city_error"> </div> <?php
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
?>  <script>function tbaVe(id){var x=document.getElementById(id);if(x.className.indexOf("w3-show")== -1){x.className+=" w3-show";}else{x.className=x.className.replace(" w3-show","");}} </script> <br><br> <div id="advanced" name="advanced" style="display: <?php echo $show ?>"> <center><input type="button" onclick="tbaVe('showOpt')" class="w3-btn w3-block w3-grey tetra-font" id="terms" style="width:60%;font-size:12px;" value="<?php echo $translate_json['Advanced options']; ?>"></center> <div id="showOpt" class="w3-container w3-hide"> <br> <h3 class="tetra-h3"><?php echo $translate_json["House System"]; ?>:</h3><br> <select class="w3-select w3-border tetra-font" name="h_sys" id="h_sys"> <option value="0" selected="selected">Placidus</option> <option value="13">Alcabitus</option> <option value="1">Campanus</option> <option value="11">Equal house - Asc.</option> <option value="2">Equal House - Whole sign</option> <option value="9">Koch</option> <option value="7">Morinus</option> <option value="8">Meridian</option> <option value="6">Porphyrius</option> <option value="14">Neo-Porphyrius</option> <option value="3">Vedic</option> <option value="5">Regiomontanus</option> <option value="4">Topocentric</option> </select> <br> <br> <h3 class="tetra-h3"><?php echo $translate_json["Zodiac"]; ?>:</h3><br> <select class="w3-select w3-border tetra-font" name="zodiac" id="zodiac"> <option selected="selected" value="-1"><?php echo $translate_json["Western - Tropical"]; ?></option> <option value="0"><?php echo $translate_json["Sidereal"]; ?> - Fagan/Bradley</option> <option value="1"><?php echo $translate_json["Sidereal"]; ?> - Lahiri</option> <option value="2"><?php echo $translate_json["Sidereal"]; ?> - DeLuce</option> <option value="3"><?php echo $translate_json["Sidereal"]; ?> - B.V. Raman</option> <option value="4"><?php echo $translate_json["Sidereal"]; ?> - Usha/Shashi</option> <option value="5"><?php echo $translate_json["Sidereal"]; ?> - Krishnamurti</option> <option value="6"><?php echo $translate_json["Sidereal"]; ?> - Djwhal Khool</option> <option value="7"><?php echo $translate_json["Sidereal"]; ?> - Shri Yukteshwar</option> <option value="8"><?php echo $translate_json["Sidereal"]; ?> - J.N. Bhasin</option> <option value="9"><?php echo $translate_json["Sidereal"]; ?> - Hipparchos</option> <option value="10"><?php echo $translate_json["Sidereal"]; ?> - Sassanian</option> <option value="12"><?php echo $translate_json["Sidereal"]; ?> - J1900</option> <option value="13"><?php echo $translate_json["Sidereal"]; ?> - B1950</option> </select> </div> </div> <?php
?> <input id="timezone" name="timezone" type="hidden" value="UTC"/> <input id="latitude" name="latitude" type="hidden"/> <input id="longitude" name="longitude" type="hidden"/> <input id="full_name" name="full_name" type="hidden"/> <input id="lang" name="lang" type="hidden" value="en"/> <input type="hidden" name="submitted" value="TRUE"/> <br><br> <div class="w3-center"> <div class="w3-bar"> <p><button class="w3-button w3-blue w3-large w3-round" name="create" id="create" onclick="javascript:tbbee();"><?php echo $translate_json["Calculate Transits"]; ?></button></p> </div> <br> <br>   <div class="w3-content w3-center" id="myTransitsCalendar" name="myTransitsCalendar"></div> <?php
$options = get_option( 'byblos_settings' );	 
	 
$options['byblos_select_field_1'] = empty( $options['byblos_select_field_1'] ) ? 1 : $options['byblos_select_field_1'];	 
$show = $options['byblos_select_field_1'];
$options['byblos_select_field_4'] = empty( $options['byblos_select_field_4'] ) ? 0 : $options['byblos_select_field_4'];
$house_sys = $options['byblos_select_field_4'];
/* $options['byblos_select_field_5'] = empty( $options['byblos_select_field_5'] ) ? -1 : $options['byblos_select_field_5']; */
$options['byblos_select_field_5'] = is_null( $options['byblos_select_field_5'] ) ? -1 : $options['byblos_select_field_5'];
$ayanamsa = $options['byblos_select_field_5'];
	 
$options['byblos_select_field_3'] = empty( $options['byblos_select_field_3'] ) ? '0.8' : $options['byblos_select_field_3'];
$scale = $options['byblos_select_field_3'];
$options['byblos_select_field_15'] = empty( $options['byblos_select_field_15'] ) ? 1 : $options['byblos_select_field_15'];
$dig_system = $options['byblos_select_field_15'];
	 
$options['byblos_select_field_16'] = empty( $options['byblos_select_field_16'] ) ? 1 : $options['byblos_select_field_16'];
$show_custom_img = $options['byblos_select_field_16'];

$options['byblos_select_field_17'] = empty( $options['byblos_select_field_17'] ) ? '300' : $options['byblos_select_field_17'];	 
$custom_img_size = $options['byblos_select_field_17'];
	 
$options['byblos_select_field_6'] = empty( $options['byblos_select_field_6'] ) ? 1 : $options['byblos_select_field_6'];	 
$show_icon = $options['byblos_select_field_6'];

$options['byblos_select_field_14'] = empty( $options['byblos_select_field_14'] ) ? 2 : $options['byblos_select_field_14'];	 
$show_bar = $options['byblos_select_field_14'];

	 
$options['byblos_checkbox_field_7'] = empty( $options['byblos_checkbox_field_7'] ) ? 0 : 1;
$show_aspects_soft = $options['byblos_checkbox_field_7'];
$show_aspects_soft = ($show_aspects_soft > 0) ? 0 : 1;
$options['byblos_checkbox_field_8'] = empty( $options['byblos_checkbox_field_8'] ) ? 0 : 1;
$show_nodes = $options['byblos_checkbox_field_8'];

$options['byblos_checkbox_field_9'] = empty( $options['byblos_checkbox_field_9'] ) ? 0 : 1;
$show_lilith = $options['byblos_checkbox_field_9'];

$options['byblos_checkbox_field_10'] = empty( $options['byblos_checkbox_field_10'] ) ? 0 : 1;
$show_pf = $options['byblos_checkbox_field_10'];

$options['byblos_checkbox_field_12'] = empty( $options['byblos_checkbox_field_12'] ) ? 0 : 1;
$show_chiron = $options['byblos_checkbox_field_12'];
	 
$options['byblos_checkbox_field_11'] = empty( $options['byblos_checkbox_field_11'] ) ? 0 : 1;
$show_stars = $options['byblos_checkbox_field_11'];

$options['byblos_checkbox_field_13'] = empty( $options['byblos_checkbox_field_13'] ) ? 0 : 1;
$show_vedic = $options['byblos_checkbox_field_13'];

$options['byblos_checkbox_field_15'] = empty( $options['byblos_checkbox_field_15'] ) ? 0 : 1;
$show_syzygy = $options['byblos_checkbox_field_15'];
	 
$options['byblos_checkbox_field_16'] = empty( $options['byblos_checkbox_field_16'] ) ? 0 : 1;
$show_parts = $options['byblos_checkbox_field_16'];

$options['byblos_checkbox_field_17'] = empty( $options['byblos_checkbox_field_17'] ) ? 0 : 1;
$show_dignities = $options['byblos_checkbox_field_17'];

$options['byblos_checkbox_field_18'] = empty( $options['byblos_checkbox_field_18'] ) ? 0 : 1;
$show_elements = $options['byblos_checkbox_field_18'];

	 
$options['byblos_checkbox_field_19'] = empty( $options['byblos_checkbox_field_19'] ) ? 0 : 1;
$show_asp_list = $options['byblos_checkbox_field_19'];

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

?> <script>tbbfe();document.getElementById("h_sys").value="<?php echo $house_sys ?>";document.getElementById("zodiac").value="<?php echo $ayanamsa ?>";var fssw_cD="<?php echo $show_aspects_soft ?>";var fssw_cv="<?php echo $show_nodes ?>";var fssw_bX="<?php echo $show_lilith ?>";var fssw_dh="<?php echo $show_pf ?>";var fssw_cy="<?php echo $show_chiron ?>";var fssw_ck="<?php echo $show_stars ?>";var fssw_dr="<?php echo $show_icon ?>";var fssw_dC="<?php echo $show_bar ?>";var fssw_cX="<?php echo $show_vedic ?>";var fssw_cG="<?php echo $show_syzygy ?>";var fssw_cB="<?php echo $dig_system ?>";var fssw_cU="<?php echo $show_custom_img ?>";var fssw_cw="<?php echo $custom_img_size ?>";var fssw_de="<?php echo $show_parts ?>";var fssw_dD="<?php echo $show_dignities ?>";var fssw_cV="<?php echo $show_elements ?>";var fssw_da="<?php echo $show_asp_list ?>";var ecp_url="<?php echo plugins_url('Tetrabyblos') ?>/data/eclipse.php";var fssw_dd="<?php echo plugins_url('Tetrabyblos') ?>/natal_report.php";var fssw_cb= <?php echo $show ?>;var home_url="<?php echo get_site_url() ?>";var fssw_aS="<?php echo $show_transits ?>";var fssw_bU="<?php echo $transit_url ?>";var digsys="<?php echo $digsys ?>";var fssw_dy="<?php echo $dig_system_original; ?>";var fssw_dK="<?php echo $astrorep; ?>";var fssw_aT= <?php echo $PFFormula; ?>;var fssw_bW="<?php echo $glyph_chart ?>";var fssw_bZ="<?php echo $show_outer ?>";var add_pars="<?php echo $add_pars ?>";var fssw_ce="<?php echo $chart_type; ?>";var fssw_cA="<?php echo $chart_style; ?>";var fssw_aK= <?php echo $translate ?>;var fssw_ae= <?php echo $translate_main ?>;var fssw_dt= <?php echo $data_table ?>;var fssw_cx="<?php echo plugins_url('Tetrabyblos') ?>/images/";var x=screen.width;if(x>400){escala= <?php echo $scale ?>;$('#main_astro_div').css({transform:"scale("+escala+")",'-webkit-transform-origin':'top left'});$('#myResults').css({transform:"scale("+escala+")",'-webkit-transform-origin':'top left'});}function tbbee(){a=eval(document.getElementById("lat_deg").value);b=eval(document.getElementById("lat_min").value);c=eval(document.getElementById("long_deg").value);d=eval(document.getElementById("long_min").value);fssw_aC=document.getElementById("name").value;if(fssw_aC==null||fssw_aC==""){document.getElementById("name_error").innerHTML='<br><h5 style="color: teal;text-align: center;"><b><?php echo $translate_json["Please input a valid name!..."]; ?></b></h5>';var url=location.href;location.href="#enter_name";return false;}if(a+b+c+d==0){document.getElementById("city_error").innerHTML='<br><h5 style="color: teal;text-align: center;"><b><?php echo $translate_json["Please input a valid city/place!..."]; ?></b></h5>';return false;}else{var vv=eval(document.getElementById("year").value);if(vv>3000){document.getElementById("city_error").innerHTML='<br><h5><b><?php echo $translate_json["Year out of range!..."]; ?></b></h5>';return false;}else{tbaFe();calc();}}};function tbve(evt,fssw_g){var i,tabcontent,tablinks;tabcontent=document.getElementsByClassName("tabcontent");for(i=0;i<tabcontent.length;i++){tabcontent[i].style.display="none";}tablinks=document.getElementsByClassName("tablinks");for(i=0;i<tablinks.length;i++){tablinks[i].className=tablinks[i].className.replace(" active","");}document.getElementById(fssw_g).style.display="block";evt.currentTarget.className+=" active";};function tbre(evt,fssw_g){var i,tabcontent,tablinks;tabcontent=document.getElementsByClassName("tabcontent2");for(i=0;i<tabcontent.length;i++){tabcontent[i].style.display="none";}tablinks=document.getElementsByClassName("tablinks2");for(i=0;i<tablinks.length;i++){tablinks[i].className=tablinks[i].className.replace(" active","");}document.getElementById(fssw_g).style.display="block";evt.currentTarget.className+=" active";};document.getElementById("defaultOpen").click();document.getElementById("defaultOpen2").click();
	  
/* function tbAe(){var is24=document.getElementById('European').style.display;if(is24=='none'){var hh=eval(document.getElementById('hour_american').value);var mm=eval(document.getElementById('minute_american').value);var ampm=eval(document.getElementById('ampm_american').value);if(ampm>0){hh+=12;if(hh==24){hh=0;}}document.getElementById('hour').value=hh;document.getElementById('minute').value=mm;}else{var hh=eval(document.getElementById('hour').value);var mm=eval(document.getElementById('minute').value);var ampm=0;if(hh>12){hh-=12;ampm=1;if(hh==0){hh=12;}}if(hh==0){hh=12;ampm=1;}document.getElementById('hour_american').value=hh;document.getElementById('minute_american').value=mm;document.getElementById('ampm_american').value=ampm;}}; */
function tbAe(){
	var is24 = document.getElementById('European').style.display;
	if(is24 == 'none'){
		var hh = eval(document.getElementById('hour_american').value);
		var mm = eval(document.getElementById('minute_american').value);
		var ampm = eval(document.getElementById('ampm_american').value);
		
		if(hh == 12 && ampm == 0){
			document.getElementById('hour').value = 0;
	        document.getElementById('minute').value = mm;
			return;
		}
		
		if(hh == 12 && ampm == 1){
			document.getElementById('hour').value = 0;
	        document.getElementById('minute').value = mm;
			document.getElementById('hour_american').value = 12;
			document.getElementById('ampm_american').value = 0;
			return;
		}	
		
		if(ampm > 0){
			hh += 12;
			if(hh == 24){
				hh = 0;
			}
			
		}
		document.getElementById('hour').value = hh;
	    document.getElementById('minute').value = mm;
	} else {
		var hh = eval(document.getElementById('hour').value);
		var mm = eval(document.getElementById('minute').value);
		var ampm = 0;
		
		if(hh == 0){
			document.getElementById('hour_american').value = 12;
	        document.getElementById('minute_american').value = mm;
			document.getElementById('ampm_american').value = 0;
			return;
		}		
		if(hh == 12){
			document.getElementById('hour_american').value = 12;
	        document.getElementById('minute_american').value = mm;
			document.getElementById('ampm_american').value = 1;
			return;
		}	
		
		if(hh > 12){
			hh -= 12;
			ampm = 1;
			if(hh == 0){hh = 12;}
		}
		if(hh == 0){
			hh = 12;
			ampm = 1;
		}
		document.getElementById('hour_american').value = hh;
		document.getElementById('minute_american').value = mm;
		document.getElementById('ampm_american').value = ampm;
	}
}	  

	  
function tbJe(name,value,days){if(days){var date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));var expires="; expires="+date.toGMTString();}else var expires="";document.cookie=name+"="+value+expires+"; path=/";};function tbue(name){var nameEQ=name+"=";var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);if(c.indexOf(nameEQ)==0)return c.substring(nameEQ.length,c.length);}return null;};function tbbte(name){tbJe(name,"",-1);};function tbaFe(){var fssw_H=["lat_deg","lat_min","long_deg","long_min","ns","ew","timezone","full_name","zoneoffset","hour","minute","hour_american","minute_american","ampm_american","day","month","year","era","country_id","h_sys","zodiac","latitude","longitude","name","cname"];for(index=0;index<fssw_H.length;++index){var t=document.getElementById(fssw_H[index]);tbJe(fssw_H[index],t.value,7);}};function tbbfe(){var fssw_H=["lat_deg","lat_min","long_deg","long_min","ns","ew","timezone","full_name","zoneoffset","hour","minute","hour_american","minute_american","ampm_american","day","month","year","era","country_id","h_sys","zodiac","latitude","longitude","name","cname"];for(index=0;index<fssw_H.length;index++){if(document.getElementById(fssw_H[index])&&tbue(fssw_H[index])){var v1=tbue(fssw_H[index]);document.getElementById(fssw_H[index]).value=v1;}}};function tbaue(date,longitude,latitude){$const.tlong= -longitude;$const.glat=latitude;$processor.init();var nbody=new Array('sun','moon','mercury','venus','mars','jupiter','saturn','uranus','neptune','pluto','chiron');var LongitudeG=new Array();var DeclinationG=new Array();var AltitudeG=new Array();ay=0;for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG[i+1]=tbee($const.body.position.apparentLongitude+ay);DeclinationG[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG[i+1]=$const.body.position.altaz.topocentric.altitude;}var nodesG=new Array();nodesG=MoonNode(date.julian);h_sys=eval(document.getElementById("h_sys").value);var housesG=new Array();housesG=CalculateHouses(date.julian,longitude,latitude,0);for(i=12;i>0;i--){housesG[i]=housesG[i-1]*180/Math.PI;}housesG[0]=0;var pointsG=new Array();pointsG[1]=nodesG[0];pointsG[2]=0;pointsG[3]=housesG[1];pointsG[4]=housesG[10];pointsG[6]=nodesG[1];SUNALT=AltitudeG[1];pointsG[7]=SUNALT;if(SUNALT>0){pointsG[5]=tbqe(pointsG[3]+LongitudeG[2]-LongitudeG[1]);}else{pointsG[5]=tbqe(pointsG[3]-LongitudeG[2]+LongitudeG[1]);}var fssw_bn=0;date['day']+=1;$processor.init();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);fssw_bn=tbee($const.body.position.apparentLongitude+ay);if(tbje(LongitudeG[i+1],fssw_bn)<0){LongitudeG[i+1]= -LongitudeG[i+1];}}var today=new Date();yy=today.getUTCFullYear();m=today.getUTCMonth()+1;dd=today.getUTCDate();hh=0;mm=0;ss=0;off=0;var date={year:yy,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:off};$processor.init();var LongitudeG1=new Array();var DeclinationG1=new Array();var AltitudeG1=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG1[i+1]=tbee($const.body.position.apparentLongitude+ay);DeclinationG1[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG1[i+1]=$const.body.position.altaz.topocentric.altitude;}var nodesG1=new Array();nodesG1=MoonNode(date.julian);var housesG1=new Array();housesG1=CalculateHouses(date.julian,longitude,latitude,h_sys);for(i=12;i>0;i--){housesG1[i]=housesG1[i-1]*180/Math.PI;}housesG1[0]=0;var pointsG1=new Array();pointsG1[1]=nodesG1[0];pointsG1[2]=0;pointsG1[3]=housesG1[1];pointsG1[4]=housesG1[10];pointsG1[6]=nodesG1[1];fssw_A=AltitudeG1[1];if(fssw_A>0){pointsG1[5]=tbqe(pointsG1[3]+LongitudeG1[2]-LongitudeG1[1]);}else{pointsG1[5]=tbqe(pointsG1[3]-LongitudeG1[2]+LongitudeG1[1]);}date['day']+=1;$processor.init();var LongitudeG2=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG2[i+1]=tbee($const.body.position.apparentLongitude+ay);}date['day']+=1;$processor.init();var LongitudeG3=new Array();for(i=0;i<11;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG3[i+1]=tbee($const.body.position.apparentLongitude+ay);}for(i=1;i<12;i++){if(tbje(LongitudeG1[i],LongitudeG2[i])<0){LongitudeG1[i]= -LongitudeG1[i];}if(tbje(LongitudeG2[i],LongitudeG3[i])<0){LongitudeG2[i]= -LongitudeG2[i];}}vv=new Array(LongitudeG,LongitudeG1,LongitudeG2,DeclinationG,nodesG,housesG,pointsG,DeclinationG1,housesG1,pointsG1);return vv;};function tbdae(date,longitude,latitude,h_sys){$const.tlong=longitude;$const.glat=latitude;var fssw_aV=Number(longitude);var fssw_aB=Number(latitude);var nbody=new Array("sun","moon","mercury","venus","mars","jupiter","saturn","uranus","neptune","pluto","chiron");$processor.init();var LongitudeG1=new Array();var DeclinationG1=new Array();var AltitudeG1=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG1[i+1]=tbee($const.body.position.apparentLongitude);DeclinationG1[i+1]=$const.body.position.apparent.dDec*180/Math.PI;AltitudeG1[i+1]=$const.body.position.altaz.topocentric.altitude;}var nodesG1=new Array();nodesG1=MoonNode(date.julian);var houses_G1=new Array();houses_G1=CalculateHouses(date.julian,fssw_aV,fssw_aB,h_sys);for(i=12;i>0;i--){houses_G1[i]=houses_G1[i-1]*180/Math.PI;}houses_G1[0]=0;var pointsG1=new Array();pointsG1[1]=nodesG1[0];var angleG1=new Array();angleG1=CalcAngles(date.julian,fssw_aV,fssw_aB,0);pointsG1[2]=angleG1[2]*180/Math.PI;pointsG1[3]=houses_G1[1];pointsG1[4]=houses_G1[10];pointsG1[6]=nodesG1[1];fssw_A=AltitudeG1[1];if(fssw_A>0){pointsG1[5]=tbqe(pointsG1[3]+LongitudeG1[2]-LongitudeG1[1]);}else{pointsG1[5]=tbqe(pointsG1[3]-LongitudeG1[2]+LongitudeG1[1]);}date["day"]+=1;$processor.init();var LongitudeG2=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG2[i+1]=tbee($const.body.position.apparentLongitude);}date["day"]+=1;$processor.init();var LongitudeG3=new Array();for(i=0;i<10;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);LongitudeG3[i+1]=tbee($const.body.position.apparentLongitude);}for(i=1;i<12;i++){if(tbje(LongitudeG2[i],LongitudeG1[i])<0){LongitudeG1[i]= -LongitudeG1[i];}if(tbje(LongitudeG3[i],LongitudeG2[i])<0){LongitudeG2[i]= -LongitudeG2[i];}}var vv=new Array(LongitudeG1,LongitudeG2,DeclinationG1,houses_G1,pointsG1);return vv;};function tbbae(lat,lng,tz){var fssw_s,fssw_I;fssw_s=(lat>=0)?'N':'S';fssw_I=(lng>=0)?'E':'W';lat=Math.abs(lat);fssw_W=Math.floor(lat);fssw_r=Math.floor((lat-fssw_W)*60);if(fssw_r<10){fssw_r="0"+fssw_r;}fssw_s=fssw_W+fssw_s+fssw_r;lng=Math.abs(lng);fssw_W=Math.floor(lng);fssw_r=Math.floor((lng-fssw_W)*60);if(fssw_r<10){fssw_r="0"+fssw_r;}fssw_I=fssw_W+fssw_I+fssw_r;tzResult=tz;return(fssw_s+","+fssw_I+","+tzResult);};function tbbNe(era,y,m,d,h,mn,s){var jy,ja,jm;if(y==0){alert("There's no zero year!");return "invalid";}if(y==1582&&m==10&&d>4&&d<15&&era=="CE"){alert("Dates between 5 and 14 October 1582 AD do not exist in the gregorian system!");return "invalid";}var jd;var u,u0,u1,u2;var temp;u2=0;temp=y+m/100+d/10000;if(era=="BCE"){y= -y+1;temp= -temp+1;}u=y;if(m<3){u-=1;}u0=u+4712.0;u1=m+1.0;if(u1<4){u1+=12.0;}jd=Math.floor(u0*365.25)+Math.floor(30.6*u1+0.000001)+d+h/24.0+mn/24.0/60+s/24.0/3600-63.5;if(temp>=1582.1015){u2=Math.floor(Math.abs(u)/100)-Math.floor(Math.abs(u)/400);if(u<0.0)u2= -u2;jd+= -u2+2;if((u<0.0)&&(u/100==Math.floor(u/100))&&(u/400!=Math.floor(u/400)))jd-=1;}return jd;};function jump(h){var url=location.href;location.href="#"+h;history.replaceState(null,null,url);};function tbee(ang){while(ang<0){ang+=360;}while(ang>=360){ang-=360;}return ang;};function tbake(ang){var p2=2*(Math.PI);while(ang<0){ang+=p2;}while(ang>=p2){ang-=p2;}return ang;};function cjd(d,m,y){var a,j,l;var b;if(m<3){m+=12;y--}a=y/100;b=ParseFloat(30.6)*ParseFloat(m+1);l=ParseInt(b);j=365*y+y/4+l+2-a+a/4+d;return j};function tbRe(d,m,y){var h,mt,s,h6,b6,timeZone;h=12;mt=0;s=0;timeZone=0;h6=(h+mt/60+s/3600-(12+timeZone))/24;jd=tbbNe(1,y,m,d,h6,mt,s);b6=(cjd(d,m,y)-694025+h6)/36525;return b6;};function tbaZe(dd,mm,yy,asys){if(asys<0){return 0;}switch(asys){case 0:t=tbRe(dd,mm,yy);return 22.460148+1.396042*t+3.08E-4*t*t;break;case 1:t=tbRe(dd,mm,yy);return 21.013972+1.398191*t;break;case 2:return(yy+(mm*30+dd)/365-297.3204723)*50.2388475/3600;break;case 3:var fssw_j,fssw_aH,fssw_bi,fssw_ak;fssw_aH=22+(1335+(yy-1900)*50.2388475)/3600+(yy-1900)*(yy-1900)*1.11E-4/3600;fssw_bi=((mm-1)*30+(dd-1))/3600;fssw_ak=fssw_bi/365*(50.2388475+1.11E-4*20);fssw_j=fssw_aH+fssw_ak;return fssw_j;break;case 4:var dayAya,fssw_j,fssw_i;dayAya=50.2388475/365.25;fssw_i=(yy-291)*365.25;fssw_i+=mm*30+dd-114;fssw_j=dayAya*fssw_i;fssw_j/=3600;return fssw_j;break;default:t=tbRe(dd,mm,yy);return 22.460148+1.396042*t+3.08E-4*t*t;}};function DMS(x){x1=Math.floor(x);x2=Math.floor((x-x1)*60);if(x1<10){x1="0"+x1;}if(x2<10){x2="0"+x2;}var t=""+x1+"&deg;"+x2+"'";return t;};function move(){var elem=document.getElementById("myBar");var width=20;var id=setInterval(frame,15);function frame(){if(width>=100){clearInterval(id);}else{width++;elem.style.width=width+'%';elem.innerHTML='<i class="material-icons">schedule</i>';}}};function calc(){era=eval(document.getElementById("era").value);yy=eval(document.getElementById("year").value);m=eval(document.getElementById("month").value);dd=eval(document.getElementById("day").value);hh=eval(document.getElementById("hour").value);mm=eval(document.getElementById("minute").value);ss=0;l1=eval(document.getElementById("long_deg").value);l2=eval(document.getElementById("long_min").value);l3=eval(document.getElementById("ew").value);longitude=(l1+l2/60)*l3;l1=eval(document.getElementById("lat_deg").value);l2=eval(document.getElementById("lat_min").value);l3=eval(document.getElementById("ns").value);latitude=(l1+l2/60)*l3;tz=document.getElementById("timezone").value;if(yy<3000&&yy> -3000){tbbAe(era,yy,m,dd,hh,mm,ss,latitude,longitude,tz);}};function tbbHe(input){return input.match(/[0-9]+/g);};function tbbAe(era,yy,m,dd,hh,mm,ss,latitude,longitude,tz){var fssw_Z=yy;var yy_tz=yy;if(era<0){fssw_Z=1-yy;yy_tz=1000;}var off_choose=document.getElementById("zoneoffset").value;if(off_choose==99){var zone=moment.tz.zone(tz);var off=zone.parse(Date.UTC(yy_tz,m,dd,hh,mm,ss,0));}else{off= -off_choose*60;}fssw_v=tbbae(latitude,longitude,off/60);d_ddec=yy*10000+m*100+dd;h_american=eval(document.getElementById("hour_american").value);fssw_aL=eval(document.getElementById("minute_american").value);ampm=eval(document.getElementById("ampm_american").value);ampm=(ampm==1)?'PM':'AM';hdec=h_american*100+fssw_aL+ampm;

	  
h_24 = eval(document.getElementById("hour").value);
m_24 = eval(document.getElementById("minute").value);
h_24 = h_24 < 10 ? "0" + h_24 : h_24;	
m_24 = m_24 < 10 ? "0" + m_24 : m_24;	
h_24_dec = "" + h_24 + ":" + m_24;
console.log("Here:" + h_24_dec + " " + ampm);

c_name=document.getElementById("name").value;
test=home_url+"/transits/?parameters="+c_name+"|"+fssw_v+","+d_ddec+","+hdec;
/* fssw_bT=c_name+"|"+fssw_v+","+d_ddec+","+hdec+"|||"+fssw_v+",00000000,,|"+"Placidus"; */
fssw_bT=c_name+"|"+fssw_v+","+d_ddec+","+hdec + "," + h_24_dec + "|||"+fssw_v+",00000000,,|"+"Placidus";
	  
	  	  
	  	  	  	  
var date={year:fssw_Z,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:off};var fssw_bQ={year:fssw_Z,month:m,day:dd,hours:hh,minutes:mm,seconds:0,offset:off};h_sys=eval(document.getElementById("h_sys").value);var dateG=fssw_Z+","+m+","+dd+","+hh+","+mm+","+0+","+off+","+longitude+","+latitude+","+h_sys;vera="CE";if(era<0){vera="BCE";}var jd=tbbNe(vera,yy,m,dd,hh,mm,0)+off/1440;var fssw_an=jd;var offset=off/1440;asys=eval(document.getElementById("zodiac").value);var fssw_be= -tbame(jd,1);if(asys>=0){ay= -tbame(jd,asys);fssw_be=0;}else{ay=0;}$const.tlong= -longitude;$const.glat=latitude;var fssw_cJ=longitude;$processor.init();var nbody=new Array('sun','moon','mercury','venus','mars','jupiter','saturn','uranus','neptune','pluto','chiron');var arrayData=tbaqe(11,7);var LongitudeG=new Array();var DeclinationG=new Array();for(i=0;i<11;i++){var body=$moshier.body[nbody[i]];$processor.calc(date,body);arrayData[i][0]=tbee($const.body.position.apparentLongitude+ay);LongitudeG[i+1]=tbee($const.body.position.apparentLongitude);arrayData[i][1]=$const.body.position.apparentLatitude;arrayData[i][2]=$const.body.position.apparent.dRA*180/Math.PI/15;arrayData[i][3]=$const.body.position.apparent.dDec*180/Math.PI;DeclinationG[i+1]=$const.body.position.apparent.dDec*180/Math.PI;arrayData[i][4]=$const.body.position.geocentricDistance;arrayData[i][5]=$const.body.position.altaz.topocentric.azimuth;arrayData[i][6]=$const.body.position.altaz.topocentric.altitude;out=nbody[i]+": ";for(i1=0;i1<7;i1++){out=out+arrayData[i][i1]+" ";}}var hh2=hh+1;var date2={year:fssw_Z,month:m,day:dd,hours:hh2,minutes:mm,seconds:0,offset:off};$processor.init();var fssw_bI=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];for(i=0;i<11;+i++){var body=$moshier.body[nbody[i]];$processor.calc(date2,body);fssw_bI[i]=tbje(arrayData[i][0],tbee($const.body.position.apparentLongitude+ay));if(fssw_bI[i]<0){LongitudeG[i+1]= -LongitudeG[i+1];}}lgmt=$const.body.position.altaz.dLocalApparentSiderialTime;var fssw_t=[];fssw_t=tbse(jd);var fssw_R=new Array();fssw_R=tbbke(fssw_t[0],fssw_t[1],fssw_t[2]);var SAN=0;for(i=0;i<8;i=i+2){if(fssw_R[i]<jd){SAN=fssw_R[i];}}fssw_t=tbse(SAN);var date={year:fssw_t[0],month:fssw_t[1],day:fssw_t[2],hours:0,minutes:0,seconds:0,offset:0};var body=$moshier.body['moon'];$processor.calc(date,body);var fssw_K=tbee($const.body.position.apparentLongitude+ay);if(fssw_K<0){fssw_K+=360;}var body=$moshier.body['sun'];$processor.calc(date,body);var fssw_U=tbee($const.body.position.apparentLongitude+ay);if(fssw_U<0){fssw_U+=360;}var fssw_aG="New";var d=Math.abs(fssw_K-fssw_U);if(d>360){d-=360;}if(d>170){fssw_aG="Full";}var nodes=new Array();nodes=MoonNode(date.julian);var aPoints=new Array();aPoints[1]=nodes[0];aPoints[6]=nodes[1];var nodesG=new Array();nodesG=nodes;nodes[0]+=ay;nodes[1]+=ay;nodes[2]+=ay;var jd1=2451545.2;var jd0=Math.floor(jd1-0.5)+0.5;jd1=2451544.9;jd0=Math.floor(jd1-0.5)+0.5;jd=fssw_an;h_sys=eval(document.getElementById("h_sys").value);var hposG=new Array();hposG=CalculateHouses(jd,longitude,latitude,h_sys);;for(i=12;i>0;i--){hposG[i]=hposG[i-1]*180/Math.PI;}hposG[0]=0;aPoints[3]=hposG[1];aPoints[4]=hposG[10];var h=new Array();h=CalculateHouses(jd,longitude,latitude,h_sys);for(i=0;i<12;i++){h[i]+=ay*(Math.PI/180);if(h[i]<0){h[i]+=2*Math.PI;}}var GData=new Array();GData=tbaue(fssw_bQ,longitude,latitude);var fssw_am=document.getElementById('myTransitsCalendar');fssw_am.innerHTML="";fssw_am.innerHTML+="<div class='w3-center'><div class='w3-bar'><form id='form-id' method='POST' action='"+fssw_bU+"'><input type='hidden' name='parameters' id='parameters' value='"+fssw_bT+"' ><input type='hidden' name='dateG' id='dateG' value='"+dateG+"' ><input type='hidden' name='LongitudeG' id='LongitudeG' value='"+GData[0].toString()+"' ><input type='hidden' name='DeclinationG' id='DeclinationG' value='"+GData[3].toString()+"' ><input type='hidden' name='nodesG' id='nodesG' value='"+GData[4].toString()+"' ><input type='hidden' name='hposG' id='hposG' value='"+GData[5].toString()+"' ><input type='hidden' name='pointsG' id='pointsG' value='"+GData[6].toString()+"' ><input type='hidden' name='transit1G' id='transit1G' value='"+GData[1].toString()+"' ><input type='hidden' name='transit2G' id='transit2G' value='"+GData[2].toString()+"' ><input type='hidden' name='transit1DecG' id='transit1DecG' value='"+GData[7].toString()+"' ><input type='hidden' name='transit1housesG' id='transit1housesG' value='"+GData[8].toString()+"' ><input type='hidden' name='transit1pointsG' id='transit1pointsG' value='"+GData[9].toString()+"' ><input type='hidden' name='showopt' id='showopt' value='"+fssw_aS+"' ><br></form></div></div>";tbbme();function tbbme(){document.getElementById("form-id").submit();}};function tbaEe(){var x=document.getElementById("myDIV2");x.style.display="none";var y=document.getElementById("main_astro_div");y.style.display="block";jump("main_astro_div");};function tbaHe(x){signs=new Array("a","s","d","f","g","h","j","k","l","z","x","c");if(x<0){x+=360.0;}signo=Math.floor(x/30.0);x-=30*signo;x=Math.floor(x*100)/100;x=DMS(x);return x+" "+"<span style='font-family: HamburgSymbols;font-size: 15px;'>"+signs[signo]+"</span>";};function tbaqe(x,y){var array2D=new Array(x);for(var i=0;i<array2D.length;i++){array2D[i]=new Array(y);}return array2D;};function tr(fssw_C){var subst=fssw_aK;for(var key in subst){replace="\\b"+key+"\\b";what=""+subst[key];re=new RegExp(replace,"gi");fssw_C=fssw_C.replace(re,what);}return fssw_C;};function tr_2(fssw_C){var subst=fssw_aK;for(var key in subst){replace="<span class=trn>"+key+"<\/span>";what=""+subst[key];re=new RegExp(replace,"gi");fssw_C=fssw_C.replace(re,what);}return fssw_C;} </script> <?php	
}
