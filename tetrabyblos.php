<?php
/*
Plugin Name: Tetrabyblos
Plugin URI: http://cosmos.pt
Description: Allows the insertion of a short code to calculate a user natal horoscope and transits.
Version: 2.6.0.0
Author: Miguel Fernandes
Author URI: http://cosmos.pt
*/

if ( ! function_exists( 'tetrabyblos_get_settings_array' ) ) {
	function tetrabyblos_get_settings_array() {
		$options = get_option( 'byblos_settings' );
		return is_array( $options ) ? $options : array();
	}
}

if ( ! function_exists( 'tetrabyblos_get_language_array' ) ) {
	function tetrabyblos_get_language_array() {
		$mytext = get_option( 'byblos_text_field_language_default' );
		if ( is_array( $mytext ) && ! empty( $mytext ) ) {
			return $mytext;
		}
		if ( isset( $GLOBALS['mylang'] ) && is_array( $GLOBALS['mylang'] ) ) {
			return $GLOBALS['mylang'];
		}
		return array();
	}
}

if ( ! function_exists( 'tetrabyblos_get_translation_json' ) ) {
	function tetrabyblos_get_translation_json() {
		$mytext = tetrabyblos_get_language_array();
		$translate_map = array();
		foreach ( $mytext as $value ) {
			$translate_map[ $value ] = $value;
		}

		$translate = get_option( 'byblos_text_field_language_json' );
		if ( ! empty( $translate ) ) {
			$decoded = json_decode( $translate, true );
			if ( is_array( $decoded ) ) {
				$translate_map = array_merge( $translate_map, $decoded );
			}
		}

		$spanish_defaults = array(
			'Natal Chart Calculation' => 'Cálculo de Carta Natal',
			'Please enter your birth details below.' => 'Por favor, ingresa tus datos de nacimiento a continuación.',
			'Your Name' => 'Tu nombre',
			'Birth time' => 'Hora de nacimiento',
			'24 hours style' => 'Formato de 24 horas',
			'12 hours style (AM/PM)' => 'Formato de 12 horas (a. m./p. m.)',
			'Hours (0 to 23)' => 'Hora (0 a 23)',
			'Hours (1 to 12)' => 'Hora (1 a 12)',
			'Minutes' => 'Minutos',
			'Now' => 'Ahora',
			'Birth date' => 'Fecha de nacimiento',
			'Day' => 'Día',
			'Month' => 'Mes',
			'Year' => 'Año',
			'Era' => 'Era',
			'AD - Anno Domini' => 'd. C.',
			'BC - Before Christ' => 'a. C.',
			'A.C.' => 'd. C.',
			'B.C.' => 'a. C.',
			'City of birth' => 'Ciudad de nacimiento',
			'Manual Coordinates' => 'Coordenadas manuales',
			'Time zone' => 'Zona horaria',
			'Latitude' => 'Latitud',
			'Degrees' => 'Grados',
			'North' => 'Norte',
			'South' => 'Sur',
			'Longitude' => 'Longitud',
			'East' => 'Este',
			'West' => 'Oeste',
			'Country' => 'País',
			'Auto detect from location' => 'Detectar automáticamente según la ubicación',
			'Birth City' => 'Ciudad de nacimiento',
			'Calculate Chart' => 'Calcular carta',
			'Calculate Another Chart' => 'Calcular otra carta',
			'Calculate Transits' => 'Calcular tránsitos',
			'Chart Results' => 'Resultados de la carta',
			'Click image to zoom...' => 'Haz clic en la imagen para ampliar...',
			'Here are some details regarding your birth date.' => 'Tu carta astral es el regalo del Universo para conocerte mejor. Cada símbolo representa una parte de ti y de tu energía. Aquí comienza el camino para descubrir quién eres, cómo sientes y hacia dónde vas.',
			'Advanced options' => 'Opciones avanzadas',
			'Western - Tropical' => 'Occidental - Tropical',
			'Sidereal' => 'Sideral',
			'Please input a valid name!...' => 'Por favor, ingresa un nombre válido.',
			'Please input a valid city/place!...' => 'Por favor, ingresa una ciudad o lugar válido.',
			'Year out of range!...' => 'El año está fuera del rango permitido.',
			'Longitude, latitude and timezone are automatically calculated from birth place' => 'La longitud, latitud y zona horaria se calculan automáticamente según el lugar de nacimiento',
			'No results were found so please input a nearby city' => 'No se encontraron resultados; por favor, escribe una ciudad cercana',
			'Unknow time birth' => 'No conozco la hora de nacimiento',
			'House System' => 'Sistema de casas',
			'Zodiac' => 'Zodiaco',
			'Born' => 'Nacido el',
			'Around the main wheel are displayed the current positions of the planets and astrological points which are called  transits.' => 'Alrededor de la rueda principal se muestran las posiciones actuales de los planetas y puntos astrológicos, llamadas tránsitos.',
			'Planets position' => 'Posición de los planetas',
			'Planet/Point' => 'Planeta/Punto',
			'Radix Long.' => 'Long. natal',
			'Transit Long.' => 'Long. tránsito',
			'House positions' => 'Posiciones de las casas',
			'House' => 'Casa',
			'Nomenclature' => 'Nomenclatura',
			'Imum Coeli' => 'Fondo del Cielo',
			'Medium Coeli' => 'Medio Cielo',
			'Star positions' => 'Posiciones de las estrellas',
			'Star' => 'Estrella',
			'Natal Aspects' => 'Aspectos natales',
			'Arabic Parts' => 'Partes árabes',
			'Classical Dignities' => 'Dignidades clásicas',
			'Elements' => 'Elementos',
			'Fire' => 'Fuego',
			'Earth' => 'Tierra',
			'Air' => 'Aire',
			'Water' => 'Agua',
			'Qualities' => 'Cualidades',
			'Cardinal' => 'Cardinal',
			'Fixed' => 'Fijo',
			'Mutable' => 'Mutable',
			'Vedic Chart' => 'Carta védica',
			'Main Info' => 'Información principal',
			'Graha positions' => 'Posiciones de los grahas',
			'Dasas' => 'Dasas',
			'Birth Dasa' => 'Dasa de nacimiento',
			'begun in' => 'iniciada en',
			'Current Dasa' => 'Dasa actual',
			'Calculate Daily Transits Calendar' => 'Calcular calendario diario de tránsitos',
			'Seasons' => 'Estaciones',
			'Spring' => 'Primavera',
			'Summer' => 'Verano',
			'Autumn' => 'Otoño',
			'Winter' => 'Invierno',
			'Moon phases' => 'Fases lunares',
			'New moon' => 'Luna nueva',
			'First quarter' => 'Cuarto creciente',
			'Full moon' => 'Luna llena',
			'Last quarter' => 'Cuarto menguante',
			'Previous Month' => 'Mes anterior',
			'Yesterday' => 'Ayer',
			'Today' => 'Hoy',
			'Tomorrow' => 'Mañana',
			'Next Month' => 'Mes siguiente',
			'Chose the date for your transit report.' => 'Elige la fecha para tu reporte de tránsitos.',
			'Transiting Aspects (Summary)' => 'Aspectos en tránsito (resumen)',
			'Trans. Plan.' => 'Plan. en tránsito',
			'Natal Planets' => 'Planetas natales',
			'in House' => 'en casa',
			'Sun' => 'Sol',
			'Moon' => 'Luna',
			'Mercury' => 'Mercurio',
			'Venus' => 'Venus',
			'Mars' => 'Marte',
			'Jupiter' => 'Júpiter',
			'Saturn' => 'Saturno',
			'Uranus' => 'Urano',
			'Neptune' => 'Neptuno',
			'Pluto' => 'Plutón',
			'Chiron' => 'Quirón',
			'Asc. node' => 'Nodo asc.',
			'Desc. node' => 'Nodo desc.',
			'Ascendant' => 'Ascendente',
			'Descendant' => 'Descendente',
			'Aries' => 'Aries',
			'Taurus' => 'Tauro',
			'Gemini' => 'Géminis',
			'Cancer' => 'Cáncer',
			'Leo' => 'Leo',
			'Virgo' => 'Virgo',
			'Libra' => 'Libra',
			'Scorpio' => 'Escorpio',
			'Sagittarius' => 'Sagitario',
			'Capricorn' => 'Capricornio',
			'Aquarius' => 'Acuario',
			'Pisces' => 'Piscis',
			'Rulership' => 'Domicilio',
			'Exaltation' => 'Exaltación',
			'Fall' => 'Caída',
			'Detriment' => 'Exilio',
			'Triplicity' => 'Triplicidad',
			'Terms' => 'Términos',
			'Face' => 'Decanato',
			'Scores' => 'Puntuaciones',
			'ess. dig.' => 'dignidades esenciales',
			'modern dig.' => 'dignidades modernas',
			'Scores with m.r. dig.' => 'Puntuaciones con recepción mutua',
			'mutual reception' => 'recepción mutua',
			'in Rulership with' => 'en domicilio con',
			'in Exaltation with' => 'en exaltación con',
			'in Triplicity with' => 'en triplicidad con',
			'in Terms with' => 'en términos con',
			'in Face with' => 'en decanato con',
			'Fortune' => 'Fortuna',
			'Daemon and religion (Spirit)' => 'Daimon y religión (Espíritu)',
			'Friendship and Love' => 'Amistad y amor',
			'Despair, penury and fraud' => 'Desesperación, penuria y fraude',
			'Captivity, prisons and escape' => 'Cautiverio, prisiones y escape',
			'Victory, triumph and help' => 'Victoria, triunfo y ayuda',
			'Courage and Bravery' => 'Coraje y valentía',
			'Life giver' => 'Dador de vida',
			'Destroyer' => 'Destructor',
			'Part of Life' => 'Parte de la vida',
			'Part of Sickness' => 'Parte de la enfermedad',
			'Part of Bad Luck' => 'Parte de la mala suerte',
			'Part of Death' => 'Parte de la muerte',
			'New' => 'Nueva',
			'Full' => 'Llena',
			'Syzygy' => 'Sizigia'
		);

		return array_merge( $translate_map, $spanish_defaults );
	}
}

function show_transits( $atts, $content = null, $tag = '' ) {
	
	$a = shortcode_atts( array(
        'action' => 'natal',
		'userlogged' => 'no'
        ), $atts );
	$user_must  = $a['userlogged'];
    $current_user_id = get_current_user_id();
    if ( $current_user_id < 1 && $user_must === 'yes' ) {
        return "Debes iniciar sesión para ver esta página. Inténtalo de nuevo.";
    }
	
    ob_start();
	$filename = "daily_transits.php";
	$request = plugin_dir_path(__FILE__) . $filename;
	
	if ( file_exists( $request ) ) {
		$data = include( $request );
		if ( is_string( $data ) && $data !== '' ) {
			echo substr( $data, 0, -1 );
		}
	}
	$contents = ob_get_contents();
	ob_end_clean();
    return $contents;
}
add_shortcode( 'byblostransits', 'show_transits' );

function show_jyotisha( $atts, $content = null, $tag = '' ) { 
	
	$a = shortcode_atts( array(
        'action' => 'natal',
		'userlogged' => 'no'
        ), $atts );
	$user_must  = $a['userlogged'];
    $current_user_id = get_current_user_id();
    if ( $current_user_id < 1 && $user_must === 'yes' ) {
        return "Debes iniciar sesión para ver esta página. Inténtalo de nuevo.";
    }
	
    ob_start();
	$filename = "jyotisha.php";
	$request = plugin_dir_path(__FILE__) . $filename;
	
	if ( file_exists( $request ) ) {
		$data = include( $request );
		if ( is_string( $data ) && $data !== '' ) {
			echo substr( $data, 0, -1 );
		}
	}
	$contents = ob_get_contents();
	ob_end_clean();
    return $contents;
}
add_shortcode( 'byblosvedic', 'show_jyotisha' );




function add_my_transit_page() {
    
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'Transits' ),
      'post_content'  => '[byblostransits]',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
    );

	$page_path = 'transits/';	
	if( ! $page = get_page_by_path( $page_path ) ){
    
    wp_insert_post( $my_post );
	}
}

register_activation_hook(__FILE__, 'add_my_transit_page');

function deactivate_plugin() {

    $page_id = wds_get_ID_by_page_name('Transits');
    wp_delete_post($page_id,true);
	
	// Uninstallation actions here
    /* BACKUP ALL - SETTINGS, TEXTS AND LANGUAGE TRANSLATIONS */
    /* Zip Settings */
    /*
     * Render the Backup settings page
     */

	$options = get_option( 'byblos_settings' );

    /* CONFIGURATION - SAVE SETTINGS ON FILE */
    $settings = get_option( 'byblos_settings' );
    $json_content = json_encode( $settings );
    $filename = plugin_dir_path(__FILE__) . "dbase/users/settings.txt";
    file_put_contents($filename,$json_content);
    /* LANGUAGE - SAVE */
    $filename = plugin_dir_path(__FILE__) . "dbase/users/myOwnTranslation.txt";
    $option_name = 'byblos_text_field_language_default';
    $mytext = tetrabyblos_get_language_array();
    $arrlength = count( $mytext );
    $temp = '{';
    for($x=0;$x<$arrlength;$x++){
    $temp .= '"' . $mytext[$x] . '" : "' . $mytext[$x] . '",';
    }
    $temp .= '"nothing" : "nothing"}';	
    file_put_contents($filename,$temp);

    /* ZIP ALL FILES FROM THE DBASE/USERS DIR TO MYTETRABYBLOS.ZIP */
    $date = date('YmdHis');
    foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.zip" ) as $zipfile ) {
	    unlink($zipfile);
    }
    $zipname = plugin_dir_path( __FILE__ ) . "dbase/users/myTetrabyblos-$date.zip";
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE|ZipArchive::OVERWRITE);
    foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.*" ) as $file ) {
	    $zip->addFile($file,basename($file));
    }
    $zip->close();
    /* Link of the Zip */ 
    $ziplink = plugins_url( "dbase/users/myTetrabyblos-$date.zip", __FILE__ );
	$link_url = home_url();
    //echo "<div class='updated'><p>Your texts were zipped! If the download doesn't start automatically, please download them <a href='$ziplink'>here</a>.</p></div>";
    //echo "<script> document.location.href = '" . $ziplink . "';</script>";
	/* echo "<script> window.open('" . $ziplink . "');</script>"; */
	
	/* Automatic - working */
    echo "<script>alert('Please save the backup configuration zip file \(in the format myTetrabyblos-yyyymmddhhmmss.zip\) if asked \(if the download doesnt start automatically\) so you can import your settings later.'); window.open('" . $ziplink . "');</script>";
		
}
register_deactivation_hook( __FILE__, 'deactivate_plugin' );

function wds_get_ID_by_page_name($page_name)
{
     global $wpdb;
     $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name ='".$page_name."'");
     return $page_name_id;
}

function pw_load_scripts($hook) { 
	if( $hook != 'admin.php' )
		return;
 
	wp_enqueue_script( 'custom-js', plugins_url( 'js/jscolor.js' , dirname(__FILE__) ) );
}
add_action('admin_enqueue_scripts', 'pw_load_scripts');


/* Language settings */
$mylang = array('Aspectarian','Born','Longitude, latitude and timezone are automatically calculated from birth place','No results were found so please input a nearby city','Unknow time birth','Sun','Moon','Mercury','Venus','Mars','Jupiter','Saturn','Uranus','Neptune','Pluto','Chiron','Asc. node','Desc. node','Lilith','Ascendant','Descendant','Pars Fort.','Rahu','Ketu','Aries','Taurus','Gemini','Cancer','Leo','Virgo','Libra','Scorpio','Sagittarius','Capricorn','Aquarius','Pisces','House I','House II','House III','House IV','House V','House VI','House VII','House VIII','House IX','House X','House XI','House XII','applying','separating','Conjunct','Opposite','Trine','Square','Sextile','conjunction','sextil','quadrature','trine','opposition','blending with','harmonizing with','discordant to','January','February','March','April','May','June','July','August','September','October','November','December','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','SU MO TU WE TH FR SA','Natal Chart Calculation','Please enter your birth details below.','Your Name','Birth time','24 hours style','12 hours style (AM/PM)','Hours (0 to 23)','Hours (1 to 12)','AD - Anno Domini','BC - Before Christ','A.C.','B.C.','Minutes','Now','Birth date','Day','Month','Year','Era','City of birth','Manual Coordinates','Time zone','Latitude','Degrees','Minutes','North','South','Longitude','East','West','Country','Auto detect from location','Birth City','Calculate Chart','Click image to zoom...','Chart Results','Here are some details regarding your birth date.','Calculate Daily Transits Calendar','Astronomical small report','Seasons','Spring','Summer','Autumn','Winter','Moon phases','Syzygy - Full','Syzygy - New','Last quarter','New moon','First quarter','Full moon','Last quarter','Eclipses','Total lunar eclipse','Partial lunar eclipse','Penumbral lunar eclipse','Total solar eclipse','Partial solar eclipse','Penumbral solar eclipse','Annular solar eclipse','Hybrid solar eclipse','Planets position','Planet/Point','Radix Long.','Transit Long.','House positions','House','Nomenclature','Imum Coeli','Medium Coeli','Star','Star positions','Natal Aspects','Arabic Parts','Pars Fortun&aelig;','Fortune','Pars Futurorum','Daemon and religion (Spirit)','Pars Veneris','Friendship and Love','Pars Mercurii','Despair, penury and fraud','Pars Saturni','Captivity, prisons and escape','Pars Iovis','Victory, triumph and help','Pars Martis','Courage and Bravery','Pars Hyleg','Life giver','Pars Anareitai','Destroyer','Part of Life','Part of Sickness','Part of Bad Luck','Part of Death','Classical Dignities','Rulership','Exaltation','Terms','Detriment','Triplicity','Fall','Face','Elements','Fire','Earth','Air','Water','Qualities','Cardinal','Fixed','Mutable','Vedic Chart','Main Info','Graha positions','Dasas','Birth Dasa','begun in','Current Dasa','Calculate Another Chart','Around the main wheel are displayed the current positions of the planets and astrological points which are called  transits.','Daily Transits for','Daily Transits','for','Previous Month','Yesterday','Today','Tomorrow','Next Month','Chose the date for your transit report.','Transiting Aspects (Summary)','Trans. Plan.','Natal Planets','in House','INTRODUCTION','THE RISING SIGN OR ASCENDANT','YOUR ASCENDANT IS','SIGN POSITIONS OF PLANETS','HOUSE POSITIONS OF PLANETS','PLANETARY ASPECTS','CLOSING COMMENTS','persona','power','emotion','expression','affection','action','expansion','effort','freedom','impression','change','purpose','enhance','confront','favor','strain','support','burden','Advanced options','Western - Tropical','Sidereal','Please input a valid name!...','Please input a valid city/place!...','Year out of range!...','House System','Zodiac','mutual reception','in Rulership with','in Exaltation with','in Triplicity with','in Terms with','in Face with','Scores','ess. dig.','modern dig.','Scores with m.r. dig.','Life','Pillar of horoscope - Nativities, permanence, constancy','Reasoning and eloquence','Property','Debt','Treasure Trove','Brothers','Number of brothers','Death of brothers & sisters','Parents','Death of parents','Grandparents','Ancestors and relations','Ancestors and relations','Real estate acc. Hermes','Real estate acc. some Persians','Agriculture, tillage','Issue of affairs [end of matter]','Children','Time and number of sexes','Condition of males','Condition of females','Whether expected birth is male or female','Disease, defects, time of onset acc. Hermes','Disease, defects, time of onset acc. some of the ancients','Captivity','Slaves','Marriage of men acc. Hermes','Marriage of men acc. Vettius Valens','Trickery and deception of men and women','Intercourse','Marriage of women (Hermes)','Marriage of women (Valens)','Misconduct by women','Trickery and deceit of men by women','Intercourse','Unchastity of women','Chastity of women','Marriage of men and women acc. Hermes','Time of marriage (Hermes)','Fraudulent marriage & Facilitating it','Sons in law','Lawsuits','Death','Anairetai [anareta: destroyer]','Year to be feared at birth for death, famine','Place of murder and sickness','Danger of violence','Journeys','By water','Timidity and hiding','Deep reflection','Understanding and wisdom','Traditions, knowledge of affairs','Knowledge whether true or false','Noble births','Kings and Sultans','Administrators, vazirs [ministers], etc.','Sultan\'s victory, conquest','Of those who rise in station','Celebrated persons of rank','Armies and police','Sultan. Those concerned In nativities','Merchants and their work','Buying and selling','Operations and orders in medical Treatment','Mothers','Glory','Friendship and enmity','Known by men and revered, Constant in affairs','Success','Worldliness','Hope','Friends','Violence','Abundance in house','Liberty of Person','Praise and acceptation','Enmity acc. some of the ancients','Enmity acc. Hermes','Bad luck','Fortune or Lunar horoscope','Daemon and religion [Spirit]','Friendship and love','Despair & penury & fraud','Captivity, prisons and escape therefrom','Victory, triumph & aid','Valour and bravery','Hailaj [Hyleg, life-giver]','Debilitated bodies','Horsemanship, bravery','Boldness, violence and murder','Trickery and deceit','Necessity and wish','Requirements and necessities acc. Egyptians','Realisation of needs and desires','Retribution','Rectitude','Aspects notes','exact is blue','applying is teal','separating is light coral','retrograde is red','Calculate Transits','Short Introduction');

function reset_all_tetra( ){
$arr_2 = array('byblos_text_field_title_1' => 'Natal Chart Calculation Test' , 'byblos_text_field_title_1_1' => '&Omega; – Natal Chart Results' , 'byblos_select_field_1' => '2' , 'byblos_select_field_35' => '3' , 'byblos_select_field_transit' => 'transits' , 'byblos_select_field_2' => '1' , 'byblos_select_field_pars' => '-1,' , 'byblos_select_field_77' => '2' , 'byblos_select_field_4' => '0' , 'byblos_select_field_5' => '-1' , 'byblos_select_field_15' => '1' , 'byblos_select_field_digsys' => '1' , 'byblos_select_field_chart_type' => '0' , 'byblos_select_field_chart_style' => '0' , 'byblos_select_field_3' => '1.0' , 'byblos_select_field_chart' => '1' , 'byblos_select_field_16' => '2' , 'byblos_select_field_17' => '200' , 'byblos_select_field_6' => '2' , 'byblos_select_field_14' => '2' , 'byblos_select_field_button_style' => 'w3-button w3-blue w3-large w3-round' , 'byblos_select_field_button_style_2' => 'w3-btn w3-block w3-grey tetra-font' , 'byblos_select_field_table_style' => 'w3-table w3-small w3-striped w3-bordered w3-white tetra-font table-no-border' , 'byblos_select_field_table_style_2' => 'w3-white tetra-font-mobile table-no-border' , 'byblos_checkbox_field_bnow' => '1');
    $options = get_option( 'byblos_settings' );
    foreach ($arr_2 as $key => $value) {
      /* $options[$key] = $value; */
      //$options[$key] = empty( $options[$key] ) ? $value : $options[$key];
      update_option( $options[$key], $value );
    }
	return true;
}

    $option_name = 'byblos_text_field_language_default';
	if ( get_option( $option_name ) !== false ) {
    update_option( $option_name, $mylang );
    } else {
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $mylang, $deprecated, $autoload );
    }
/* End */


register_activation_hook(__FILE__, 'tetrabyblos_activate');
add_action('admin_init', 'tetrabyblos_redirect');

function tetrabyblos_activate() {	 
$arr_orig = array('byblos_text_field_title_1' => 'Natal Chart Calculation' , 'byblos_text_field_title_1_1' => '&Omega; – Natal Chart Results' , 'byblos_select_field_1' => '2' , 'byblos_select_field_35' => '3' , 'byblos_select_field_transit' => 'transits' , 'byblos_select_field_2' => '1' , 'byblos_select_field_pars' => '-1,' , 'byblos_select_field_77' => '2' , 'byblos_select_field_4' => '0' , 'byblos_select_field_5' => '-1' , 'byblos_select_field_15' => '1' , 'byblos_select_field_digsys' => '1' , 'byblos_select_field_chart_type' => '0' , 'byblos_select_field_chart_style' => '0' , 'byblos_select_field_3' => '1.0' , 'byblos_select_field_chart' => '1' , 'byblos_select_field_16' => '2' , 'byblos_select_field_17' => '200' , 'byblos_select_field_6' => '2' , 'byblos_select_field_14' => '2' , 'byblos_select_field_button_style' => 'w3-button w3-blue w3-large w3-round' , 'byblos_select_field_button_style_2' => 'w3-btn w3-block w3-grey tetra-font' , 'byblos_select_field_table_style' => 'w3-table w3-small w3-striped w3-bordered w3-white tetra-font table-no-border' , 'byblos_select_field_table_style_2' => 'w3-white tetra-font-mobile table-no-border' , 'byblos_checkbox_field_bnow' => '1', 'byblos_checkbox_field_bcalc_transits' => '0', 'byblos_checkbox_field_bcalc_again' => '0');
	/* On activation, reset all the fields */
    /* ob_start();
    echo "";
	$output = ob_get_contents();
	ob_end_clean(); //Discard output buffer */
	
	/* $filename = plugin_dir_path(__FILE__) . "css/template.txt"; */
	$filename = plugin_dir_path(__FILE__) . "dbase/users/template.txt";
	$arr_orig['textarea_html_output'] = file_get_contents($filename);
		
	update_option('byblos_settings',$arr_orig);	
    add_option('tetrabyblos_do_activation_redirect', true);
}

function tetrabyblos_redirect() {
   
	/* $link_url = admin_url( 'admin.php?page=user_role_editor_slug_intro'); */
	$link_url = admin_url( 'admin.php?page=tetrabyblos_plugin');
    if (get_option('tetrabyblos_do_activation_redirect', false)) {
        delete_option('tetrabyblos_do_activation_redirect');
        wp_redirect($link_url);
        exit;
    }
}

/* function load_jquery() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {

        //Enqueue
        wp_enqueue_script( 'jquery' );

    }
}
add_action( 'wp_enqueue_scripts', 'load_jquery' );
*/

/* function modify_jquery_version() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js', false, '2.0.s');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modify_jquery_version');

function modify_jquery_ui_version() {
    if (!is_admin()) {
        wp_deregister_script('jquery-ui');
        wp_register_script('jquery-ui','https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', false, '1.12.s');
        wp_enqueue_script('jquery-ui');
    }
}
add_action('init', 'modify_jquery_ui_version'); */


class Tetrabyblos {
	
	public function __construct() {
		add_shortcode( 'tetrabyblos', array( &$this, 'shortcode' ) );
	}
	
	private function render_tetra( $goto) {
		ob_start();
		
		if (strpos($goto, 'byblostransits') !== false or strpos($goto, 'transits') !== false){
			$filename = "daily_transits.php";
		} elseif (strpos($goto, 'byblosvedic') !== false){
			$filename = "jyotisha.php";
		} else {
			$filename = "skeleton.php";
		}
		
		
      $request = plugin_dir_path(__FILE__) . $filename;
		
	  $data = include($request);
	  $replacement = "";
	  
        if ( is_string( $data ) && $data !== '' ) {
			echo substr( $data, 0, -1 );
		}
		
		/* $options = get_option( 'byblos_settings' );
        $mytext = empty( $options['textarea_html_output'] ) ? "<!-- HERE -->" : $options['textarea_html_output']; 
		$data = str_replace('HTML USER OUTPUT', $mytext, $data);
		$replacement = "<!-- HERE -->\n";
		$data = nl2br($data);
		echo preg_replace("HTML USER OUTPUT", $replacement, $data);
		
		foreach(explode("\n", $data) as $line) {
        echo preg_replace("/HTML USER OUTPUT/i", $replacement, $line);
        } */
		
		$contents = ob_get_contents();
		ob_end_clean();
		
    return $contents;

	}

	public function shortcode( $atts, $content = null, $code = '' ) {
		
		/* extract( shortcode_atts( array(
            'reports' => '2',
		    'userlogged' => 'no',
			'goto' => 'natal',
        ), $atts ) ); */
		
		$a = shortcode_atts( array(
        'action' => 'natal',
		'userlogged' => 'no'
        ), $atts );
		
		$url = "url";
		$username  = "user";
		$email  = "email";
		$apikey  = "apikey";
		$goto  = $a['action'];
		$user_must  = $a['userlogged'];
		        
        $current_user_id = get_current_user_id();
	    if(($current_user_id > 0 and $user_must == 'yes') or ($user_must == 'no')){
		//if ( $username ){
			//return $this->render_tetra( $reports, $userlogged, $url, $username, $email, $apikey );
		    return $this->render_tetra( $goto );
		}
		//return '';
		echo "Debes iniciar sesión para ver esta página. Inténtalo de nuevo.";
	}
}

function register_tetrabyblos() {
	global $pageview;
	$pageview = new Tetrabyblos();
	//wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
}

add_action( 'init', 'register_tetrabyblos' );
add_action( 'admin_menu', 'byblos_add_admin_menu' );
add_action( 'admin_init', 'byblos_settings_init' );

//function load_jquery() {
//    if ( ! wp_script_is( 'jquery', 'enqueued' )) {

        //Enqueue  
        //wp_deregister_script( 'jquery' );
        //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
        //wp_deregister_script('jquery');
		//wp_enqueue_script( 'jquery', plugin_dir_path( __FILE__ ).'js/my-great-script.js', array( 'jquery' ), '1.0.0', true );
        //wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', false, '1.4.4');
		//wp_enqueue_script('jquery');
		
		//Enqueue the jQuery UI theme css file from google:
        //wp_deregister_script('jquery-ui');
		//wp_register_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.8/jquery-ui.min.js', false, '1.8.8');
		//wp_enqueue_script('jquery-ui');
        
//    }
//}
//add_action( 'wp_enqueue_scripts', 'load_jquery' );



function byblos_add_admin_menu(  ) { 
    
     
	
	/* MENUS AND OPTIONS */
	add_menu_page( 'Tetrabyblos Plugin', 'Tetrabyblos Plugin', 'manage_options', 'tetrabyblos_plugin', 'byblos_options_page', 'dashicons-editor-customchar' ); 
	
    add_submenu_page('tetrabyblos_plugin','Upload custom images', 'Upload custom images','manage_options', 'user_role_editor_slug4', 'edit_user_roles_function4');	
	add_submenu_page('tetrabyblos_plugin','Translate Plugin', 'Translate Plugin','manage_options', 'user_role_editor_language', 'edit_user_roles_language');
	 
	add_submenu_page('tetrabyblos_plugin','Backup ALL', 'Backup ALL','manage_options', 'tetrabyblos_settings_save_all_slug', 'tetrabyblos_settings_save_all_page');
	add_submenu_page('tetrabyblos_plugin','Restore ALL', 'Restore ALL','manage_options', 'tetrabyblos_settings_restore_all_slug', 'tetrabyblos_settings_restore_all_page');
	add_submenu_page('tetrabyblos_plugin','Backup your Texts', 'Backup only Texts','manage_options', 'user_role_editor_slug', 'edit_user_roles_function');
    add_submenu_page('tetrabyblos_plugin','Restore your Texts', 'Restore your Texts','manage_options', 'user_role_editor_slug2', 'edit_user_roles_function2');
	
	/* add_submenu_page('tetrabyblos_plugin','Backup/Restore Settings', 'Backup/Restore Settings','manage_options', 'byblos_settings_slug', 'byblos_settings_page'); */
	
	add_submenu_page('tetrabyblos_plugin','Introduction & HELP', 'Introduction & HELP','manage_options', 'user_role_editor_slug_intro', 'edit_user_roles_function_intro');
	
	//add_submenu_page('tetrabyblos_plugin','License key', 'License key','manage_options', 'user_role_editor_lic', 'edit_user_roles_lic');
	//sample_license_management_page
	//add_submenu_page('tetrabyblos_plugin','License key', 'License key','manage_options', 'user_role_editor_lic', 'sample_license_management_page');
}

function edit_user_roles_lic(){
$message = "";
if (isset($_POST['license_key'])){
$api_params = array(
'slm_action' => 'slm_check',
'secret_key' => '5e1a4d7926d127.50500044',
'license_key' => $_POST['license_key'],
);
// Send query to the license manager server
$response = wp_remote_get(add_query_arg($api_params, 'http://www.tetrabyblos.com'), array('timeout' => 20, 'sslverify' => false));	
// Check for error in the response
if (is_wp_error($response)){
$message = "Unexpected Error! The query returned with an error.";
}
// License data.
$license_data = json_decode(wp_remote_retrieve_body($response));
if($license_data->result == 'success'){
	$message = "OK!" . $license_data->result;
} else {
	$message = "Wrong license..."  . $license_data->result;
}
echo $message . "<br>" . var_dump($license_data) . "<br>";
}
?>
<div style="width: 500px;text-align: justify;">
<h1>Tetrabyblos - License check</h1>
<p>...text...</p><?php echo $message; ?><br>
	<form method="POST" action="" method="POST">
		<input type='text' style='width: 400px;' name='license_key'>
        <input type="submit" name="submit" value="Validate!" />
    </form>
</div>

<?php

}



//INTRO
function edit_user_roles_function_intro(){
	$plugin_data = get_plugin_data( __FILE__ );
    $plugin_version = $plugin_data['Version'];
	$local_query = plugins_url('Tetrabyblos')."/html/";
	echo "
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}
.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}
.button2:hover {
  background-color: #008CBA;
  color: white;
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
    font-size: 17px;
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
iframe000 {
  width: 95%;
  height: 774px;
  padding:20px;

  -moz-border-radius: 12px;
  -webkit-border-radius: 12px;
  border:1px solid lightgrey;
  border-radius: 12px;

  -moz-box-shadow: 4px 4px 14px #000;
  -webkit-box-shadow: 4px 4px 14px #000;
  box-shadow: 4px 4px 14px #000;
}

</style>
<script>
var linkv1 = Math.floor((Math.random() * 1000) + 1);
var linkv2 = Math.floor((Math.random() * 1000) + 1);
</script>

	<h1>Introduction to Tetrabyblos - How to use it</h1>
	
	<h3>Version " . $plugin_version . "</h3>
	<div style=\"width: 774px;text-align: justify\">
	<p>This Plugin, allows the insertion of a a simple short code to display the complete horoscope of your users. Just insert it wherever you want to display the user interface.<br><b>Important notice: </b>ALLWAYS insert the shortcode in text mode, because in Visual mode the brackets or the quotation marks might be wrongly converted to their html code or entity and the shortcode won't work!<br><br>However, Tetrabyblos gives you also two usefull choices to work with: one, will calculate directly the natal chart of the user. If this is the case, you must place the following shortcode in your page:<br><br><center><b>[tetrabyblos action=\"natal\"]</b></center><br><br>In the second choice, the transits will be calculated instead:<br><br><center><b>[tetrabyblos action=\"transits\"]</b></center><br><br>In any of these options, you can give access only to <b>logged users</b> if you wish. So, for instance, if only logged users are allowed to calculate their natal chart, the shortcode must be the following in your page:<br><br><center><b>[tetrabyblos action=\"natal\" logged=\"yes\"]</b></center><br><br></p><hr>
		</div>
	
	
	
<div style='width: 774px;'>In this small section below, you have access to several html documents, from a small introduction to the plugin, to a quick manual for using it easely. Any doubt you might have regarding the options page or its implementation, you can look it here.<br><br>Clear skies.<br><br></div>
  <hr><br>

<div style='width: 774px;text-align: justify;'>	
<div class='tab'>
  <button class='tablinks' onclick=\"openTab(event, 'Introduction')\" id='defaultOpen'>Presentation</button>
  <button class='tablinks' onclick=\"openTab(event, 'Manual')\">Manual</button>
  <button class='tablinks' onclick=\"openTab(event, 'Faqs')\">Faqs</button>
</div>
<div id='Introduction' class='tabcontent'>
  <h3>Presenting Tetrabyblos Astrology Plugin for WordPress</h3>
  <p><iframe id=\"form-iframe-1\" name=\"form-iframe-1\" src=\"" . $local_query . "intro.html?var=<script>document.write(linkv1);</script>\" style='margin:0; width:100%; height:150px; border:none; overflow:hidden;'  scrolling='no' onload='AdjustIframeHeightOnLoad()'></iframe></p>
</div>
<div id='Manual' class='tabcontent'>
  <h3>Manual</h3>
  <p><iframe id=\"form-iframe\" name=\"form-iframe\" src=\"" . $local_query . "manual.html?var=<script>document.write(linkv2);</script>\" style='margin:0; width:100%; height:150px; border:none; overflow:hidden;'  scrolling='no' onload=''></iframe></p>
</div>	
<div id='Faqs' class='tabcontent'>
  <h3>Faqs and Troubleshooting</h3>
  <p><iframe id=\"form-iframe-2\" name=\"form-iframe-2\" src=\"" . $local_query . "faqs.html?var=<script>document.write(linkv3);</script>\" style='margin:0; width:100%; height:150px; border:none; overflow:hidden;'  scrolling='no' onload=''></iframe></p>
</div>
</div>
<br>

	<br><hr><br>
	
<script>

    

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName('tabcontent');
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = 'none';
    }
    tablinks = document.getElementsByClassName('tablinks');
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(' active', '');
    }
    document.getElementById(tabName).style.display = 'block';
    evt.currentTarget.className += ' active';
	
	//document.getElementById('form-iframe').src = document.getElementById('form-iframe').src
	//document.getElementById('form-iframe-1').src = document.getElementById('form-iframe-1').src
	
	AdjustIframeHeightOnLoad();
}
    document.getElementById('defaultOpen').click();
	

function AdjustIframeHeightOnLoad() { 
document.getElementById('form-iframe').style.height = document.getElementById('form-iframe').contentWindow.document.body.scrollHeight + 'px'; 
document.getElementById('form-iframe-1').style.height = document.getElementById('form-iframe-1').contentWindow.document.body.scrollHeight + 'px';
document.getElementById('form-iframe-2').style.height = document.getElementById('form-iframe-2').contentWindow.document.body.scrollHeight + 'px';
}


function AdjustIframeHeight(i) { document.getElementById('form-iframe').style.height = parseInt(i) + 'px'; }

</script>	
	
	
	
	";
}


//LANGUAGE SETTINGS
function edit_user_roles_language(){	
	
	$message = "";
	$filename = plugin_dir_path(__FILE__) . "dbase/users/myTranslation.txt";
	$my_url = plugins_url('Tetrabyblos')."/dbase/users/myTranslation.txt"; 
	
	/* Default text file in english: defaultTranslation.txt */
	
	
    $option_name = 'byblos_text_field_language_default';
	
	$mytext = tetrabyblos_get_language_array();
	
	$arrlength = count( $mytext );
	$v2 = '{';
    for($x=0;$x<$arrlength;$x++){
    $v2 .= '"' . $mytext[$x] . '" : "' . $mytext[$x] . '",';
    }
    $v2 .= '"nothing" : "nothing"}';
	
	
	
	if (!empty($_POST) && isset($_POST['id'])){
    $v1 = $_POST['id'];
	
	/* if($_POST['restore_submit']){$v1 = $mytext;} */
		
	$is_not_restore_submit = true;
	
	if(isset($_POST['restore_submit'])){
		$v1 = get_option( 'byblos_text_field_language_default' );
		$is_not_restore_submit = false;
	}
		
	if(isset($_POST['restore_mine_submit'])){
		$v2 = get_local_file_contents($filename);
		$v2 = file_get_contents($filename);
		$v2 = str_replace("\r", "", $v2);
        $v2 = str_replace("\n", "", $v2);
		//goto cont;
	}	
	
		//$request  = wp_remote_get( $filename );
        //$response = wp_remote_retrieve_body( $request );
		
	$v2 = "{";
	for($x=0;$x<$arrlength;$x++){
		$v2 .= '"' . $mytext[$x] . '" : "' . $v1[$x] . '",';
		$options['byblos_text_field_language'][$x] = $v1[$x]; 
	}
    $v2 .= '"nothing" : "nothing"}';
	cont:
	$option_name = 'byblos_text_field_language_json';
	if ( get_option( $option_name ) !== false ) {
    update_option( $option_name, $v2 );
    } else {
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $v2, $deprecated, $autoload );
    }
    
	if($is_not_restore_submit){
	file_put_contents($filename,$v2);
	}	
		
	$message = "Your settings were saved!...";
    }
	
	
	
	$option_name = 'byblos_text_field_language_json';
	
    if ( get_option( $option_name ) === false ) {
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $v2, $deprecated, $autoload );
		
    }

	/* echo get_option( $option_name ); */
	
	echo '
	<style>
    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 0px dotted black;
    }
    .tooltip .tooltiptext {
    visibility: hidden;
    width: 220px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
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
    </style>';
	
	$my_tip = array();
	for($i=0;$i<401;$i++){
		$my_tip[$i] = "";
	}

	$my_tip[11] = "<span class='tooltiptext'>Abreviation for ascending node.</span>";
	$my_tip[12] = "<span class='tooltiptext'>Abreviation for descending node.</span>";
	$my_tip[16] = "<span class='tooltiptext'>Abreviation for Part of Fortune.</span>";
	$my_tip[77] = "<span class='tooltiptext'>This field contains the 2 letters weekdays separated by a space - please keep this exact format.</span>";
	$my_tip[89] = "<span class='tooltiptext'>Abreviation for the era after Christ.</span>";
	$my_tip[90] = "<span class='tooltiptext'>Abreviation for the era before Christ.</span>";
	$my_tip[124] = "<span class='tooltiptext'>Referes to New or Full moon.</span>";
	$my_tip[125] = "<span class='tooltiptext'>Referes to New or Full moon.</span>";
	$my_tip[200] = "<span class='tooltiptext'>Note: this is a long sentence.</span>";
	$my_tip[255] = "<span class='tooltiptext'>Abreviation for 'essential dignity'.</span>";
	$my_tip[256] = "<span class='tooltiptext'>Abreviation for 'modern dignity'.</span>";
	$my_tip[257] = "<span class='tooltiptext'>'m.r.' is the abreviation for 'mutual reception'.</span>";


	
	echo "<h2>LANGUAGE SETTINGS</h2><br><br>";
	if($message) {echo "<div class='updated'><p>".$message."</p></div><br><br>";}
	echo "	 
	<form method='POST' action='' method='POST'>
	<table style='width: 600px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;' >
    <tbody>
	";	
	$opt_value = get_option( $option_name );
	$json = json_decode($opt_value, true);
	for($x=0;$x<$arrlength;$x++){
	$n = $x+1;
	if($x == 0){echo "<tr><td colspan='4'><h3>Planets, Signs & General strings</h3><p>These are the words and phrases that appear to the user when he uses the Plugin. In this section, you can change them to the shape or language that you want.<br><i>Note: Words are case sensitive. Avoid using quotes and double quotes.</i></p></td></tr>";}

	
    $options['byblos_text_field_language'][$x] = empty( $options['byblos_text_field_language'][$x] ) ? $mytext[$x] : $options['byblos_text_field_language'][$x];
	if($n % 2 !== 0){echo "<tr>";}
		
	$myword = $mytext[$x];
	$txt_value = $json[$myword];
	
		
	echo "<td valign='top'><b>" . $n . ". </b></td><td valign='top'>
	<div class='tooltip'>" . $my_tip[$n] . "
	<b><i>\"" . $myword . "\"</i></b> : <input type='text' style='width: 400px;' name='id[]' value='" .  $txt_value . "'></div></td>"; //</tr>
	if($n % 2 == 0){echo "</tr>";}
    }
    if($n % 2 != 0){echo "<td></td></tr>";}


    echo "
	</tbody></table>
	<br><br>
	<table style='width: 800px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;' >
    <tbody>
	<tr>
	<td style='text-align: center;'><input type='submit' name='submit' value='Save Translation' /></td>
	<td style='text-align: center;'><input type='submit' name='restore_submit' value='Restore Translation to default' /></td>
	<td style='text-align: center;'><input type='submit' name='restore_mine_submit' value='Restore your Translation' /></td>
	<td style='text-align: center;'><a href='".$my_url."' target='_blank'>Download your Language file</a></td>
	</tr>
	</tbody></table>	
    </form>
	";

}

function edit_user_roles_language_old(){	
	
	$message = "";
	$filename = plugin_dir_path(__FILE__) . "dbase/users/myTranslation.txt";
	$my_url = plugins_url('Tetrabyblos')."/dbase/users/myTranslation.txt"; 
	
    $option_name = 'byblos_text_field_language_default';
	$mytext = tetrabyblos_get_language_array();
	$arrlength = count( $mytext );
	$v2 = '{';
    for($x=0;$x<$arrlength;$x++){
    $v2 .= '"' . $mytext[$x] . '" : "' . $mytext[$x] . '",';
    }
    $v2 .= '"nothing" : "nothing"}';
	
	if (!empty($_POST) && isset($_POST['id'])){
    $v1 = $_POST['id'];
	
	/* if($_POST['restore_submit']){$v1 = $mytext;} */
	if(isset($_POST['restore_submit'])){$v1 = get_option( 'byblos_text_field_language_default' );}
		
	if(isset($_POST['restore_mine_submit'])){
		$v2 = get_local_file_contents($filename);
		$v2 = str_replace("\r", "", $v2);
        $v2 = str_replace("\n", "", $v2);
		//goto cont;
	}	
	
		//$request  = wp_remote_get( $filename );
        //$response = wp_remote_retrieve_body( $request );
		
	$v2 = "{";
	for($x=0;$x<$arrlength;$x++){
		$v2 .= '"' . $mytext[$x] . '" : "' . $v1[$x] . '",';
		$options['byblos_text_field_language'][$x] = $v1[$x]; 
	}
    $v2 .= '"nothing" : "nothing"}';
	cont:
	$option_name = 'byblos_text_field_language_json';
	if ( get_option( $option_name ) !== false ) {
    update_option( $option_name, $v2 );
    } else {
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $v2, $deprecated, $autoload );
    }
    
	file_put_contents($filename,$v2);
	$message = "Your settings were saved!...";
    }
	$option_name = 'byblos_text_field_language_json';
    if ( get_option( $option_name ) === false ) {
    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $v2, $deprecated, $autoload );
    }

	/* echo get_option( $option_name ); */
	
	echo '
	<style>
    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 0px dotted black;
    }
    .tooltip .tooltiptext {
    visibility: hidden;
    width: 220px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
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
    </style>';
	
	$my_tip = array();
	for($i=0;$i<401;$i++){
		$my_tip[$i] = "";
	}

	$my_tip[11] = "<span class='tooltiptext'>Abreviation for ascending node.</span>";
	$my_tip[12] = "<span class='tooltiptext'>Abreviation for descending node.</span>";
	$my_tip[16] = "<span class='tooltiptext'>Abreviation for Part of Fortune.</span>";
	$my_tip[77] = "<span class='tooltiptext'>This field contains the 2 letters weekdays separated by a space - please keep this exact format.</span>";
	$my_tip[89] = "<span class='tooltiptext'>Abreviation for the era after Christ.</span>";
	$my_tip[90] = "<span class='tooltiptext'>Abreviation for the era before Christ.</span>";
	$my_tip[124] = "<span class='tooltiptext'>Referes to New or Full moon.</span>";
	$my_tip[125] = "<span class='tooltiptext'>Referes to New or Full moon.</span>";
	$my_tip[200] = "<span class='tooltiptext'>Note: this is a long sentence.</span>";
	$my_tip[255] = "<span class='tooltiptext'>Abreviation for 'essential dignity'.</span>";
	$my_tip[256] = "<span class='tooltiptext'>Abreviation for 'modern dignity'.</span>";
	$my_tip[257] = "<span class='tooltiptext'>'m.r.' is the abreviation for 'mutual reception'.</span>";


	
	echo "<h2>LANGUAGE SETTINGS</h2><br><br>";
	if($message) {echo "<div class='updated'><p>".$message."</p></div><br><br>";}
	echo "	 
	<form method='POST' action='' method='POST'>
	<table style='width: 600px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;' >
    <tbody>
	";	
	$opt_value = get_option( $option_name );
	$json = json_decode($opt_value, true);
	for($x=0;$x<$arrlength;$x++){
	$n = $x+1;
	if($x == 0){echo "<tr><td colspan='4'><h3>Planets, Signs & General strings</h3><p>These are the words and phrases that appear to the user when he uses the Plugin. In this section, you can change them to the shape or language that you want.<br><i>Note: Words are case sensitive. Avoid using quotes and double quotes.</i></p></td></tr>";}

	
    $options['byblos_text_field_language'][$x] = empty( $options['byblos_text_field_language'][$x] ) ? $mytext[$x] : $options['byblos_text_field_language'][$x];
	if($n % 2 !== 0){echo "<tr>";}
		
	$myword = $mytext[$x];
	$txt_value = $json[$myword];
	
		
	echo "<td><b>" . $n . ". </b></td><td>
	<div class='tooltip'>" . $my_tip[$n] . "
	<input type='text' style='width: 400px;' name='id[]' value='" .  $txt_value . "'></div></td>"; //</tr>
	if($n % 2 == 0){echo "</tr>";}
    }
    if($n % 2 != 0){echo "<td></td></tr>";}


    echo "
	</tbody></table>
	<br><br>
	<table style='width: 800px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;' >
    <tbody>
	<tr>
	<td style='text-align: center;'><input type='submit' name='submit' value='Save Translation' /></td>
	<td style='text-align: center;'><input type='submit' name='restore_submit' value='Restore Translation to default' /></td>
	<td style='text-align: center;'><input type='submit' name='restore_mine_submit' value='Restore your Translation' /></td>
	<td style='text-align: center;'><a href='".$my_url."' target='_blank'>Download your Language file</a></td>
	</tr>
	</tbody></table>	
    </form>
	";

}	


/* END LANGUAGE SETTINGS */	




	
function edit_user_roles_function(){
    

if (!empty($_POST)){
$date = date('YmdHis');
$files = array('signs.txt','aspects.txt','houses.txt','general.txt');

foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.zip" ) as $zipfile ) {
	unlink($zipfile);
}
$zipname = plugin_dir_path( __FILE__ ) . "dbase/users/myTexts-$date.zip";
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE|ZipArchive::OVERWRITE);

foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.*" ) as $file ) {
	$zip->addFile($file,basename($file));
}
$zip->close();
$ziplink = plugins_url( "dbase/users/myTexts-$date.zip", __FILE__ );
echo "<div class='updated'><p>Your texts were zipped! If the download doesn't start automatically, please download them <a href='$ziplink'>here</a>.</p></div>";
echo "<script> document.location.href = '" . $ziplink . "'; </script>";
} else {
?>
<div style="width: 500px;text-align: justify;">
<h1>Tetrabyblos - BACKUP Report texts</h1>
<p>Here, you have the ability to backup your own interpretations texts, and download them so you can restore them later, at any time (either because some misconfiguration or because of an upgrade of Tetrabyblos). Just press <i>Backup texts</i> and download the file.</p><br>
	<form method="POST" action="" method="POST">
        <input type="submit" name="submit" value="Backup texts!" />
    </form>
</div>

<?php
}
}

function edit_user_roles_function2(){

    if(!empty($_FILES["zip_file"]["name"])) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
	
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "The file you are trying to upload is not a .zip file. Please try again.";
	}

	$target_path = plugin_dir_path( __FILE__ ) . "/dbase/users/".$filename;
	if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			$zip->extractTo(plugin_dir_path( __FILE__ ) . "/dbase/users/");
			$zip->close();
	
			unlink($target_path);
		}
		$message = "Your .zip file was uploaded and unpacked.";
	} else {	
		$message = "There was a problem with the upload. Please try again.";
	}
} else {
	$message = null;
}

?>

<div style="width: 500px;text-align: justify;">
<h1>Tetrabyblos - Restore Report texts</h1>
<p>In this section, you have the ability to restore your own interpretations texts, if they were saved to your computer in the backup option. Just upload the saved zip file, and automatically restore it by pressing <i>Upload texts</i>. Alternatively you can upload Max Heindel default zip file to restore everything as it was originally in the plugin (from your documents folder).</p><br>

<?php

if($message) echo "<div class='updated'><p>$message</p></div>"; ?>
<form enctype="multipart/form-data" method="POST" action="">
<label>Choose a zip file to upload: <input type="file" name="zip_file" /></label>
<br><br>
<input type="submit" name="submit" value="Upload texts!" />
</form>
</div>

<?php
}
function edit_user_roles_function4(){

    if(!empty($_FILES["image_file"]["name"])) {
	$filename = $_FILES["image_file"]["name"];
	$source = $_FILES["image_file"]["tmp_name"];
	$type = $_FILES["image_file"]["type"];
	$sign_planet = $_POST["sign_planet"];
	$maxDim = 400;
	
	list($width, $height, $type, $attr) = getimagesize($_FILES["image_file"]["tmp_name"]);
	
	$dir = plugin_dir_path( __FILE__ ) . "/uploads/";
    $extension = explode(".", $_FILES["image_file"]["name"]);
	$newfilename = $sign_planet . '.png';
	
	$imageFileType = strtolower(end($extension));	
	
    if($imageFileType != "jpg" and $imageFileType != "png" and $imageFileType != "jpeg"){
		$message = "Only .jpg, .jpeg and .png files are allowed. Sorry, your file was not uploaded.";
	} elseif ($width > $maxDim or $height > $maxDim or $imageFileType != "png"){		    
		    $file_name = $_FILES['image_file']['tmp_name'];
		    if($imageFileType == "jpg" or $imageFileType == "jpeg"){
				$image = imagecreatefromjpeg($file_name);
				$target_filename = $image;
				$filename = $image;
			}
            		
		    $target_filename = $file_name;
            
		    if ($width > $maxDim or $height > $maxDim){
		    $ratio = $width/$height;
			$message = "The maximum width/height of the file exceeds $maxDim pixels. Your image was resized.";
            if( $ratio > 1) {
                $new_width = $maxDim;
                $new_height = $maxDim/$ratio;
            } else {
                $new_width = $maxDim*$ratio;
                $new_height = $maxDim;
            }
			} else {
				$new_width = $width;
                $new_height = $height;
			}		
		
            $src = imagecreatefromstring( file_get_contents( $file_name ) );
            $dst = imagecreatetruecolor( $new_width, $new_height );
		    $background = imagecolorallocate($dst , 0, 0, 0);
		    imagecolortransparent($dst, $background);
		    imagealphablending($dst, false);
		    imagesavealpha($dst, true);
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagedestroy( $src );
            imagepng( $dst, $target_filename );
            imagedestroy( $dst );
		    move_uploaded_file($file_name, $dir . $newfilename);
		    $message .= " Image successfuly uploaded!";
	} else {
		move_uploaded_file($_FILES["image_file"]["tmp_name"], $dir . $newfilename);		
		$message = "Image successfuly uploaded!";
	}

} else {
	$message = null;
}
?>

<h1>Tetrabyblos - Custom images for Report texts</h1>
<div style="width: 500px;text-align: justify;">
<p>In this section, you have the ability to upload your own and customised images for the signs and the seven major planets (Sun, Moon, and from Mercury to Pluto) to be used in your own interpretations texts. The sign image will be placed in the ascendant interpretation text, and the planets with the highest score (in the Dorothean essential dignities system) - or simply all of them - in its respective sign. Choose your option in the main Plugin menu.</p><br>

<?php

if($message) echo "<div class='updated'><p>$message</p><br></div>"; ?>
<form enctype="multipart/form-data" method="POST" action="">
<label>Choose a image to upload in the format JPG, JPEG or PNG (it will be converted to PNG): <input type="file" name="image_file" /></label>
<br><br>
<label>Apply the image to:</label>
<select name="sign_planet" id="sign_planet">
  <option value="S1" selected>Sign: Aries</option>
  <option value="S2">Sign: Taurus</option>
  <option value="S3">Sign: Gemini</option>
  <option value="S4">Sign: Cancer</option>
  <option value="S5">Sign: Leo</option>
  <option value="S6">Sign: Virgo</option>
  <option value="S7">Sign: Libra</option>
  <option value="S8">Sign: Scorpio</option>
  <option value="S9">Sign: Sagittarius</option>
  <option value="S10">Sign: Capricorn</option>
  <option value="S11">Sign: Aquarius</option>
  <option value="S12">Sign: Piscis</option>
  <option value="P1">Body: Sun</option>
  <option value="P2">Body: Moon</option>
  <option value="P3">Body: Mercury</option>
  <option value="P4">Body: Venus</option>
  <option value="P5">Body: Mars</option>
  <option value="P6">Body: Jupiter</option>
  <option value="P7">Body: Saturn</option>
  <option value="P8">Body: Uranus</option>
  <option value="P9">Body: Neptune</option>
  <option value="P10">Body: Pluto</option>
</select>
<br><br>
<input type="submit" name="submit" value="Upload image!" />
</form>
</div>

<?php
}

function edit_user_roles_function3(){
$plugin_data = get_plugin_data( __FILE__ );
$plugin_version = $plugin_data['Version'];

$imgdir = plugins_url('Tetrabyblos').'/images/plugins.jpg';
$img = "<img src='" . $imgdir . "' style='width:500px;'>";
	
if (!empty($_POST)){
$date = date('Y-m-d H:i:s');
$to = 'rui.kepler@gmail.com';
$subject = 'Newsletter subscription';
$email = $_POST['myEmail'];
$url = get_site_url();
$message = "$email just subscribed Tetrabyblos newsletter at $date from $url.";
$status = wp_mail( $to, $subject, $message );
if($status){
    $message = "Your subscription was sent! Thank you very much.";
} else {
	$message = "Something went wrong... Please try again. :/";
}
} else {
	$message = null;
}
?>
<div style="width: 500px;text-align: justify;">
<h1>Tetrabyblos - News & Views</h1>
<?php if($message) echo "<div class='updated'><p>$message</p></div>"; ?>
You are using version <?php echo $plugin_version ?> of Tetrabyblos.<br>
<p>Here, you have the possibility of knowing the latest news regarding Tetrabyblos and other Astrology/Astronomy related information. If you wish, you can subscribe your email to our newsletter. :)</p><br>
	<form method="POST" action="" method="POST">
		<label>Your email: <input type="text" name="myEmail" /></label>
        <input type="submit" name="submit" value="Subscribe" />
    </form>
</div>

<?php
echo "<div style='width: 500px;text-align: justify;'><br>Checking for new versions...";
$update_check = "http://tetrabyblos.com/?swpm_api_action=version&key=38599a12f73ff860b99e983a3cce066c";
$response  = file_get_contents($update_check);
if( $response < 0) {
    echo "done. An unexpected error occurred.</div>";
} else {
$v_new = intval(str_replace(".","",$response));
$v_current = intval(str_replace(".","",$plugin_version));

	if($v_new > $v_current){
		echo "done.<br><b>New version available!</b> <b>If you are an UNREGISTERED USER</b>, please goto <a href='http://tetrabyblos.com' target='_blank'> Tetrabyblos website</a> and download it manualy, in your member's area. <br><b>If you are, however a REGISTERED USER</b> please go to the <b>General Plugin area</b> (where all your plugins are) and simply update it automatically. :) Clear skies.<br><br>" . $img . "</div>";
	} else {
		echo " No updates for now.</div>";
	}
}

}

function byblos_settings_init(  ) {
	
	register_setting( 'pluginPage', 'byblos_settings');

	add_settings_section(
		'pluginPage_section', 
		__( 'General settings', 'byblos' ), 
		'byblos_settings_section_callback', 
		'pluginPage'
	);
	
	
	 add_settings_field( 
		'byblos_text_field_title_1', 
		__( 'Title of the forms:', 'byblos' ), 
		'byblos_text_field_title_1_render', 
		'pluginPage', 
		'pluginPage_section' 
	);

	
    	add_settings_field( 
		'byblos_select_show_reports', 
		__( 'Show reports options:', 'byblos' ), 
		'byblos_select_show_reports_render', 
		'pluginPage', 
		'pluginPage_section' 
	);
	
	
	
/*	
    	add_settings_field( 
		'byblos_select_field_shortrep', 
		__( 'Show short descriptions of solar and ascendant signs:', 'byblos' ), 
		'byblos_select_field_shortrep_render', 
		'pluginPage', 
		'pluginPage_section' 
	);	
	
    	add_settings_field( 
		'byblos_select_field_1', 
		__( 'Show natal report interpretations:', 'byblos' ), 
		'byblos_select_field_1_render', 
		'pluginPage', 
		'pluginPage_section' 
	);
*/	
    	add_settings_field( 
		'byblos_select_field_35', 
		__( 'Show transits interpretations:', 'byblos' ), 
		'byblos_select_field_35_render', 
		'pluginPage', 
		'pluginPage_section' 
	);
	
    	add_settings_field( 
		'byblos_select_field_2', 
		__( 'Show advanced options to user:', 'byblos' ), 
		'byblos_select_field_2_render', 
		'pluginPage', 
		'pluginPage_section' 
	);

    	add_settings_field( 
		'byblos_select_field_hourformat', 
		__( 'Input time format system to show:', 'byblos' ), 
		'byblos_select_field_hourformat_render', 
		'pluginPage', 
		'pluginPage_section' 
	);	
	
	
	add_settings_field( 
		'byblos_select_field_pars', 
		__( 'Other Arabic Pars to show:', 'byblos' ), 
		'byblos_select_field_pars_render', 
		'pluginPage', 
		'pluginPage_section' 
	);
	
	    add_settings_field( 
		'byblos_select_field_77', 
		__( 'Formula to calculate Pars Fortuna:', 'byblos' ), 
		'byblos_select_field_77_render', 
		'pluginPage', 
		'pluginPage_section' 
	);

    	add_settings_field( 
		'byblos_select_field_4', 
		__( 'Select default values:', 'byblos' ), 
		'byblos_select_field_4_render', 
		'pluginPage', 
		'pluginPage_section' 
	);

		
    	add_settings_field( 
		'byblos_select_field_15', 
		__( 'Select essential dignities table and score system:', 'byblos' ), 
		'byblos_select_field_15_render', 
		'pluginPage', 
		'pluginPage_section' 
	);
	
	add_settings_section(
		'pluginPage_section_4', 
		__( 'Graphic settings', 'byblos' ), 
		'byblos_settings_section_callback_4', 
		'pluginPage'
	);
	
	    
    add_settings_field( 
		'byblos_select_field_3', 
		__( 'Define graphic options:', 'byblos' ), 
		'byblos_select_field_3_render', 
		'pluginPage', 
		'pluginPage_section_4' 
	);
	
	
	//HTML
	/* add_settings_field( 
		'textarea_html_output', 
		__( 'Define html output options:', 'byblos' ), 
		'setting_visual_fn', 
		'pluginPage', 
		'pluginPage_section_4' 
	); */
	
	
	
	
	

	add_settings_section(
		'pluginPage_section_2', 
		__( 'Bodies/aspects settings:', 'byblos' ), 
		'byblos_settings_section_callback_2', 
		'pluginPage'
	);	
	
    
    	add_settings_field( 
		'byblos_checkbox_field_7', 
		__( 'Check the bodies/points you wish to hide:', 'byblos' ), 
		'byblos_checkbox_field_7_render', 
		'pluginPage', 
		'pluginPage_section_2' 
	);	  

    
	
	add_settings_section(
		'pluginPage_section_3', 
		__( 'Display section settings:', 'byblos' ), 
		'byblos_settings_section_callback_2', 
		'pluginPage'
	);	
	
    
    	add_settings_field( 
		'byblos_checkbox_field_11', 
		__( 'Check the sections you wish to hide:', 'byblos' ), 
		'byblos_checkbox_field_11_render', 
		'pluginPage', 
		'pluginPage_section_3' 
	);
	
	
}

// WYSIWYG Visual Editor - Name: plugin_options[textarea_one]
function setting_visual_fn() {
	$options = get_option('byblos_settings');
	$options['textarea_html_output'] = empty( $options['textarea_html_output'] ) ? "<div><\/div>" : $options['textarea_html_output'];
	$args = array('textarea_rows' => 20, 'textarea_name' => "byblos_settings[textarea_html_output]");
	
	/* $filename = plugin_dir_path(__FILE__) . "css/template.txt"; */
	$filename = plugin_dir_path(__FILE__) . "dbase/users/template.txt";
	$default = file_get_contents($filename);
	$options['textarea_html_output'] = $default;
	
	
	/* $options['textarea_html_output'] = '<style>' . $options['textarea_css_output'] . '</style>' . $options['textarea_html_output'] .  '<script>' . $options['textarea_js_output'] . '</script>'; */
	
	?>
<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>

<table style="width: 630px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
    <tbody>
    <tr>
    <td>
	<?php	
	wp_editor( $options['textarea_html_output'], "byblos_settings[textarea_html_output]", $args );
	?>
	</td>
	<tr><td>
	<h3>DIVs Ids:</h3>
	<ul>
    <li>TETRA_TITLE: Title + name</li>
    <li>TETRA_BIRTH_DETAILS: birthdate details, and house+zodia settings</li>
    <li>TETRA_ASTRO_REPORT: astronomy report</li>
	<li>TETRA_CHART: graphical astrological chart</li>
	<li>TETRA_ASPECTS_GRID: graphical aspectarian grid</li>
	<li>TETRA_TRANSITS: calculate transits button</li>
	<li>TETRA_PLANETS: position of the planets</li>
	<li>TETRA_HOUSES: house cusps</li>
	<li>TETRA_STARS: stars positions</li>
	<li>TETRA_ASPECTS: astrological aspects</li>
	<li>TETRA_PARS: arabic parts</li>
	<li>TETRA_DIGS: dignities table</li>
	<li>TETRA_ELEMENTS: elements and qualities</li>
	<li>TETRA_VEDIC: vedic report</li>
	<li>TETRA_REPORTS: writen report</li>		
    </ul>  
	</td>	
	</tr>
	</tbody>
	</table>
</div>
    <?php
}

function byblos_select_show_reports_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_shortrep'] = empty( $options['byblos_select_field_shortrep'] ) ? 1 : $options['byblos_select_field_shortrep']; /* default no = 1 */
	$options['byblos_select_field_shortrepimg'] = empty( $options['byblos_select_field_shortrepimg'] ) ? 1 : $options['byblos_select_field_shortrepimg']; /* default yes = 2 */
	
	
	$options['byblos_select_field_1'] = empty( $options['byblos_select_field_1'] ) ? 1 : $options['byblos_select_field_1'];
	$options['byblos_select_nakshatra_report'] = empty( $options['byblos_select_nakshatra_report'] ) ? 3 : $options['byblos_select_nakshatra_report'];
	
	$options['byblos_nakshatras_references'] = empty( $options['byblos_nakshatras_references'] ) ? 1 : $options['byblos_nakshatras_references']; /* default no = 1 */
	
	?>
<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 0px dotted black;
}
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
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
</style>	
<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>
<table style="width: 630px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
<tbody>
<tr>
<td>
	<b>&bullet; Show short descriptions of solar and ascendant signs:</b><br>
    <select name='byblos_settings[byblos_select_field_shortrep]'>
		<option value='1' <?php selected( $options['byblos_select_field_shortrep'], 1 ); ?>>Not for now</option>
		<option value='2' <?php selected( $options['byblos_select_field_shortrep'], 2 ); ?>>Only solar sign description</option>
		<option value='3' <?php selected( $options['byblos_select_field_shortrep'], 3 ); ?>>Only ascendant sign description</option>
		<option value='4' <?php selected( $options['byblos_select_field_shortrep'], 4 ); ?>>Both solar and asc. sign description</option>
	</select><!-- &nbsp;&nbsp;<select name='byblos_settings[byblos_select_field_shortrepimg]'>
		<option value='1' <?php selected( $options['byblos_select_field_shortrepimg'], 1 ); ?>>With no icon image</option>
		<option value='2' <?php selected( $options['byblos_select_field_shortrepimg'], 2 ); ?>>With icon image</option>
	</select> -->
	
	</td>
	</tr>
	<tr>
	<td>
		<b>&bullet; Show natal report interpretations:</b><br>
	<select name='byblos_settings[byblos_select_field_1]'>
		<option value='1' <?php selected( $options['byblos_select_field_1'], 1 ); ?>>Not for now</option>
		<option value='2' <?php selected( $options['byblos_select_field_1'], 2 ); ?>>Yes!</option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>
		<b>&bullet; Show moon's nakshatra report:</b><br>
	<select name='byblos_settings[byblos_select_nakshatra_report]'>
		<option value='1' <?php selected( $options['byblos_select_nakshatra_report'], 1 ); ?>>Not for now</option>
		<!-- option value='2' Yes - with current defined zodiac system -->
		<option value='3' <?php selected( $options['byblos_select_nakshatra_report'], 3 ); ?>>Yes</option> <!--allways with Default Zodiac System (see below)-->
	</select>
	</td>
	</tr>
	<!--
	<tr>	
	<td>
		<b>&bullet; Show Nakshatras references in info table:</b><br>
	<select name='byblos_settings[byblos_nakshatras_references]'>
		<option value='1' <?php selected( $options['byblos_nakshatras_references'], 1 ); ?>>Not for now</option>
		<option value='2' <?php selected( $options['byblos_nakshatras_references'], 2 ); ?>>Yes</option>
	</select>
	</td>	
		
	</tr>
	-->
	
	
	</tbody>
	</table>
</div>
	
	
<?php
}


function byblos_text_field_title_1_render(  ) {
	
	$options = get_option( 'byblos_settings' );
    $options['byblos_text_field_title_1'] = empty( $options['byblos_text_field_title_1'] ) ? "Natal Chart Calculation" : $options['byblos_text_field_title_1'];
	$options['byblos_text_field_title_1_1'] = empty( $options['byblos_text_field_title_1_1'] ) ? "&ohm; &ndash; Natal Chart Results" : $options['byblos_text_field_title_1_1'];
	
	?>
    <b>Input Form:</b><br />
	<input type='text' style="width: 500px;" name='byblos_settings[byblos_text_field_title_1]' value='<?php echo $options['byblos_text_field_title_1']; ?>'>
    <br /><b>Results Form:</b><br />
    <input type='text' style="width: 500px;" name='byblos_settings[byblos_text_field_title_1_1]' value='<?php echo $options['byblos_text_field_title_1_1']; ?>'>
	<?php

}


function byblos_select_field_hourformat_render(  ) { 
	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_hourformat'] = empty( $options['byblos_select_field_hourformat'] ) ? 0 : $options['byblos_select_field_hourformat'];
?>
    <select name='byblos_settings[byblos_select_field_hourformat]'>
		<option value='0' <?php selected( $options['byblos_select_field_hourformat'], '1' ); ?>>Both 12 and 24 hour system (default)</option>
		<option value='12' <?php selected( $options['byblos_select_field_hourformat'], '2' ); ?>>Only 12 hour format (AM/PM)</option>
		<option value='24' <?php selected( $options['byblos_select_field_hourformat'], '3' ); ?>>Only 24 hour format (European)</option>
    </select>
    
<?php
/* echo $options['byblos_select_field_hourformat']; */
}



function byblos_select_field_77_render(  ) { 
	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_77'] = empty( $options['byblos_select_field_77'] ) ? 2 : $options['byblos_select_field_77'];
?>
    <select name='byblos_settings[byblos_select_field_77]'>
		<option value='1' <?php selected( $options['byblos_select_field_77'], '1' ); ?>>Allways use day formula both for diurnal and nocturnal charts (POF = ASC + MOON - SUN)</option>
		<option value='2' <?php selected( $options['byblos_select_field_77'], '2' ); ?>>Use diurnal (POF = ASC + MOON - SUN) and nocturnal (POF = ASC - MOON + SUN) formulas</option>
    </select>


<?php
}

function byblos_checkbox_field_7_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_checkbox_field_7'] = empty( $options['byblos_checkbox_field_7'] ) ? 0 : 1;
	$options['byblos_checkbox_field_8'] = empty( $options['byblos_checkbox_field_8'] ) ? 0 : 1;
	$options['byblos_checkbox_field_9'] = empty( $options['byblos_checkbox_field_9'] ) ? 0 : 1;
	
	$options['byblos_checkbox_field_10'] = empty( $options['byblos_checkbox_field_10'] ) ? 0 : 1;
	$options['byblos_checkbox_field_12'] = empty( $options['byblos_checkbox_field_12'] ) ? 0 : 1;
	$options['byblos_checkbox_field_15'] = empty( $options['byblos_checkbox_field_15'] ) ? 0 : 1;	
	
	$options['byblos_checkbox_field_outer'] = empty( $options['byblos_checkbox_field_outer'] ) ? 0 : 1;
	
	$options['byblos_checkbox_field_snode'] = empty( $options['byblos_checkbox_field_snode'] ) ? 0 : 1; //South Node
	
?>

<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>
<table style="width: 600px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
<tbody>
<tr>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_7]" name='byblos_settings[byblos_checkbox_field_7]' <?php checked( $options['byblos_checkbox_field_7'], 1 ); ?> value='1'> Soft aspects
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_8]" name='byblos_settings[byblos_checkbox_field_8]' <?php checked( $options['byblos_checkbox_field_8'], 1 ); ?> value='1'> Moon nodes	
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_9]" name='byblos_settings[byblos_checkbox_field_9]' <?php checked( $options['byblos_checkbox_field_9'], 1 ); ?> value='1'> Dark Moon (Lilith)	
</td>
</tr>
<tr>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_10]" name='byblos_settings[byblos_checkbox_field_10]' <?php checked( $options['byblos_checkbox_field_10'], 1 ); ?> value='1'> Pars Fortuna & Unfortune
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_12]" name='byblos_settings[byblos_checkbox_field_12]' <?php checked( $options['byblos_checkbox_field_12'], 1 ); ?> value='1'> Chiron	
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_15]" name='byblos_settings[byblos_checkbox_field_15]' <?php checked( $options['byblos_checkbox_field_15'], 1 ); ?> value='1'> Syzygy	
</td>
</tr>
	
<tr>
<td colspan="2">
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_outer]" name='byblos_settings[byblos_checkbox_field_outer]' <?php checked( $options['byblos_checkbox_field_outer'], 1 ); ?> value='1'> Outer planets (Uranus, Neptune and Pluto)
</td>
<td colspan="1">
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_snode]" name='byblos_settings[byblos_checkbox_field_snode]' <?php checked( $options['byblos_checkbox_field_snode'], 1 ); ?> value='1'> Moon South Node
</td>
</tr>

<tr>
<td><hr><input type='checkbox' onclick="togle2()"> <b>Select/Unselect all</b></td>
<td></td>
<td></td>
</tr>	
<tr>
<td colspan='3'>
<i>NOTE: Soft aspects include Semisquare, Quintile, Sesquisquare,Biquintile, Parallel and Cont. Parallel.</i>
</td>	
</tr>	
</tbody>
</table>	
</div>	
<script>
function togle2(){
var x0 = document.getElementById("byblos_settings[byblos_checkbox_field_7]");
x0.checked = !x0.checked;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_8]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_9]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_10]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_12]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_15]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_outer]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_snode]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
}
</script>	
	
	
	
<?php
}

function byblos_checkbox_field_11_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_checkbox_field_11'] = empty( $options['byblos_checkbox_field_11'] ) ? 0 : 1;	
	$options['byblos_checkbox_field_13'] = empty( $options['byblos_checkbox_field_13'] ) ? 0 : 1;
	$options['byblos_checkbox_field_16'] = empty( $options['byblos_checkbox_field_16'] ) ? 0 : 1;
	$options['byblos_checkbox_field_17'] = empty( $options['byblos_checkbox_field_17'] ) ? 0 : 1;
	$options['byblos_checkbox_field_18'] = empty( $options['byblos_checkbox_field_18'] ) ? 0 : 1;
	$options['byblos_checkbox_field_19'] = empty( $options['byblos_checkbox_field_19'] ) ? 0 : 1;
	$options['byblos_checkbox_field_astrorep'] = empty( $options['byblos_checkbox_field_astrorep'] ) ? 0 : 1;	
	$options['byblos_checkbox_field_bnow'] = empty( $options['byblos_checkbox_field_bnow'] ) ? 0 : 1;
	$options['byblos_checkbox_field_print'] = empty( $options['byblos_checkbox_field_print'] ) ? 0 : 1;
	
	$options['byblos_checkbox_field_bcalc_transits'] = empty( $options['byblos_checkbox_field_bcalc_transits'] ) ? 0 : 1;
	$options['byblos_checkbox_field_bcalc_again'] = empty( $options['byblos_checkbox_field_bcalc_again'] ) ? 0 : 1;
	
?>



<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>
<table style="width: 600px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
<tbody>
<tr>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_11]" name='byblos_settings[byblos_checkbox_field_11]' <?php checked( $options['byblos_checkbox_field_11'], 1 ); ?> value='1'> Major Stars
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_13]" name='byblos_settings[byblos_checkbox_field_13]' <?php checked( $options['byblos_checkbox_field_13'], 1 ); ?> value='1'> Vedic report	
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_16]" name='byblos_settings[byblos_checkbox_field_16]' <?php checked( $options['byblos_checkbox_field_16'], 1 ); ?> value='1'> Arabic Parts
</td>
</tr>
<tr>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_17]" name='byblos_settings[byblos_checkbox_field_17]' <?php checked( $options['byblos_checkbox_field_17'], 1 ); ?> value='1'> Dignities
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_18]" name='byblos_settings[byblos_checkbox_field_18]' <?php checked( $options['byblos_checkbox_field_18'], 1 ); ?> value='1'> Elements and qualities	
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_19]"  name='byblos_settings[byblos_checkbox_field_19]' <?php checked( $options['byblos_checkbox_field_19'], 1 ); ?> value='1'> List of aspects
</td>	
</tr>
<tr>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_bnow]"  name='byblos_settings[byblos_checkbox_field_bnow]' <?php checked( $options['byblos_checkbox_field_bnow'], 1 ); ?> value='1'> <b>"Now"</b> button
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_astrorep]"  name='byblos_settings[byblos_checkbox_field_astrorep]' <?php checked( $options['byblos_checkbox_field_astrorep'], 1 ); ?> value='1'> Astronomy small report	
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_print]"  name='byblos_settings[byblos_checkbox_field_print]' <?php checked( $options['byblos_checkbox_field_print'], 1 ); ?> value='1'> Print page (beta)
</td>
</tr>

<tr>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_bcalc_transits]"  name='byblos_settings[byblos_checkbox_field_bcalc_transits]' <?php checked( $options['byblos_checkbox_field_bcalc_transits'], 1 ); ?> value='1'> <b>"Calc. Transits"</b> button
</td>
<td>
<input type='checkbox' id="byblos_settings[byblos_checkbox_field_bcalc_again]"  name='byblos_settings[byblos_checkbox_field_bcalc_again]' <?php checked( $options['byblos_checkbox_field_bcalc_again'], 1 ); ?> value='1'> <b>"Calc. Again"</b> button
</td>
<td>

</td>
</tr>	
	
<tr>
<td colspan='3'>
<hr>
<input type='checkbox' onclick="togle()"> <b>Select/Unselect all</b>
<br><br>
<i>NOTE: the Astronomy small report includes the seasons and eclipses of the birth year, along with the Moon phases of the month.</i>	
</td>
</tr>		
</tbody>
</table>	
</div>
<script>
function togle(){
var x0 = document.getElementById("byblos_settings[byblos_checkbox_field_11]");
x0.checked = !x0.checked;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_13]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_16]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;	
var x = document.getElementById("byblos_settings[byblos_checkbox_field_17]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_18]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_19]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_astrorep]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_bnow]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_print]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
	
var x = document.getElementById("byblos_settings[byblos_checkbox_field_bcalc_transits]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
var x = document.getElementById("byblos_settings[byblos_checkbox_field_bcalc_again]");
//x.checked = !x.checked;
x.checked = x0.checked ? 1 : 0;
	
}
</script>

<?php

}

/* Show short written report */
function byblos_select_field_shortrep_render(  ) { 
	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_shortrep'] = empty( $options['byblos_select_field_shortrep'] ) ? 1 : $options['byblos_select_field_shortrep']; /* default no = 1 */
?>
	
<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 0px dotted black;
}
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
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
</style>

    <div class="tooltip">
	<span class="tooltiptext">Don't forget to save the settings below!</span>
    <select name='byblos_settings[byblos_select_field_shortrep]'>
		<option value='1' <?php selected( $options['byblos_select_field_shortrep'], 1 ); ?>>Not for now</option>
		<option value='2' <?php selected( $options['byblos_select_field_shortrep'], 2 ); ?>>Only solar sign description</option>
		<option value='3' <?php selected( $options['byblos_select_field_shortrep'], 3 ); ?>>Only ascendant sign description</option>
		<option value='4' <?php selected( $options['byblos_select_field_shortrep'], 4 ); ?>>Both solar and asc. sign description</option>
	</select>
	<p id="save_text_1" style="display:none;color: teal;"> Please save the settings below!</p>
    </div>
	
<?php

}

/* Show written report complete */
function byblos_select_field_1_render(  ) { 
	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_1'] = empty( $options['byblos_select_field_1'] ) ? 1 : $options['byblos_select_field_1'];
?>
	
<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 0px dotted black;
}
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
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
</style>

    <div class="tooltip">
	<span class="tooltiptext">Don't forget to save the settings below!</span>
    <br>
	<select name='byblos_settings[byblos_select_field_1]'>
		<option value='1' <?php selected( $options['byblos_select_field_1'], 1 ); ?>>Not for now</option>
		<option value='2' <?php selected( $options['byblos_select_field_1'], 2 ); ?>>Yes!</option>
	</select><p id="save_text_1" style="display:none;color: teal;"> Please save the settings below!</p>
    </div>
	
<?php

}

function byblos_select_field_35_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_35'] = empty( $options['byblos_select_field_35'] ) ? 1 : $options['byblos_select_field_35'];
	$options['byblos_select_field_transit'] = empty( $options['byblos_select_field_transit'] ) ? '' : $options['byblos_select_field_transit'];
?>
	
    
    <div style="width: 600px;border: 1px solid grey;padding: 15px;text-align: justify;border-radius: 15px;">
	<div class="tooltip">
    <span class="tooltiptext">Don't forget to save the settings below!</span>   
	<select name='byblos_settings[byblos_select_field_35]'>
		<option value='1' <?php selected( $options['byblos_select_field_35'], 1 ); ?>>Not for now</option>
		<option value='2' <?php selected( $options['byblos_select_field_35'], 2 ); ?>>Yes, text only</option>
		<option value='3' <?php selected( $options['byblos_select_field_35'], 3 ); ?>>Yes, both text and graphics</option>
	</select>
    <br><br>
    &bullet; Select Transits page to redirect requests:
    <br>
    <select name='byblos_settings[byblos_select_field_transit]' onchange='myFunction("save_text_2")'> 
    <option value="">
    <?php echo esc_attr( __( 'Select page' ) ); ?></option> 
    
<?php 

    $pages = get_pages(); 
    foreach ( $pages as $page ) {
	$pname = $page->post_name;
    $ptitle = $page->post_title;		
    $option = "<option value='" . $pname . "' " . selected( $options['byblos_select_field_transit'], $pname ); 
	$option .= ">" . $ptitle ."</option>";
	echo $option;
    }
?>
		</select></div><p>
		<b>Note:</b> Please select the correct transit page. If you are not using the default one (created by Tetrabyblos), do not forget to place in your custom page the shortcode <b>[byblostransits]</b> <i>(brackets included).</i>
		</p>
		</div>

<?php
}

function byblos_select_field_15_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_15'] = empty( $options['byblos_select_field_15'] ) ? 1 : $options['byblos_select_field_15'];
	$options['byblos_select_field_digsys'] = empty( $options['byblos_select_field_digsys'] ) ? 1 : $options['byblos_select_field_digsys'];

?>
    
    
    <div style="width: 600px;border: 1px solid grey;padding: 15px;text-align: justify;border-radius: 15px;">
	<div class="tooltip">
	<span class="tooltiptext">Don't forget to save the settings below!</span>
    <b>&bullet; Table of essential dignities to use:</b>
    <br>
    <select name='byblos_settings[byblos_select_field_15]'>
		<option value='1' <?php selected( $options['byblos_select_field_15'], 1 ); ?>>Ptolemy table</option>
		<option value='2' <?php selected( $options['byblos_select_field_15'], 2 ); ?>>Dorotheus table</option>
		<option value='3' <?php selected( $options['byblos_select_field_15'], 3 ); ?>>My Custom table</option>
	</select>
    <br><br>
    <b>&bullet; Score system to use:</b>
    <br><br>
    <select name='byblos_settings[byblos_select_field_digsys]'>
		<option value='1' <?php selected( $options['byblos_select_field_digsys'], 1 ); ?>>System I</option>
		<option value='2' <?php selected( $options['byblos_select_field_digsys'], 2 ); ?>>System II</option>
	</select>
    <br><br>
<div style="width: 600px;text-align: justify;">
<b>System I:</b> All the direct and mutual reception (m.r.) essential dignities and direct debilities are considered. A peregrine body is the one which doesn't have any direct or m.r. essential dignity and it's not considered to be peregrine if it's in fall or detriment.<br>
<b>System II:</b> All the essential dignities and debilities are considered, along with the mutual reception (m.r.) in rulership or exaltation. A peregrine body is the one which doesn't have any direct or m.r. essential dignity or direct debility.<br>
</div>
</div>		
</div>		
		
<?php
}

function byblos_select_field_2_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_2'] = empty( $options['byblos_select_field_2'] ) ? 0 : $options['byblos_select_field_2'];
?>
	

    <div class="tooltip">
	<span class="tooltiptext">Don't forget to save the settings below!</span>
		&bullet; Allow the user to choose the house and zodiac system: 
		<select name='byblos_settings[byblos_select_field_2]'>
		<option value='0' <?php selected( $options['byblos_select_field_2'], '0' ); ?>>No</option>
		<option value='1' <?php selected( $options['byblos_select_field_2'], '1' ); ?>>Yes</option>
		</select></div>

<?php
}


function byblos_select_field_3_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_3'] = empty( $options['byblos_select_field_3'] ) ? '0.9' : $options['byblos_select_field_3'];
	$options['byblos_select_field_16'] = empty( $options['byblos_select_field_16'] ) ? '1' : $options['byblos_select_field_16'];
	$options['byblos_select_field_17'] = empty( $options['byblos_select_field_17'] ) ? '200' : $options['byblos_select_field_17'];
	$options['byblos_select_field_6'] = empty( $options['byblos_select_field_6'] ) ? '2' : $options['byblos_select_field_6'];
	$options['byblos_select_field_14'] = empty( $options['byblos_select_field_14'] ) ? '2' : $options['byblos_select_field_14'];
	$options['byblos_select_field_chart'] = empty( $options['byblos_select_field_chart'] ) ? '0.7' : $options['byblos_select_field_chart'];
	
	$options['byblos_select_field_chart_type'] = empty( $options['byblos_select_field_chart_type'] ) ? '0' : $options['byblos_select_field_chart_type'];
	$options['byblos_select_field_chart_style'] = empty( $options['byblos_select_field_chart_style'] ) ? 0 : $options['byblos_select_field_chart_style'];
	
	$options['byblos_select_field_button_style'] = empty( $options['byblos_select_field_button_style'] ) ? "w3-button w3-blue w3-large w3-round" : $options['byblos_select_field_button_style'];
	$options['byblos_select_field_button_style_2'] = empty( $options['byblos_select_field_button_style_2'] ) ? "w3-btn w3-block w3-grey tetra-font" : $options['byblos_select_field_button_style_2'];
	
	$options['byblos_select_field_table_style'] = empty( $options['byblos_select_field_table_style'] ) ? "w3-table w3-small w3-striped w3-bordered w3-white tetra-font table-no-border" : $options['byblos_select_field_table_style'];
	$options['byblos_select_field_table_style_2'] = empty( $options['byblos_select_field_table_style_2'] ) ? "w3-white tetra-font-mobile table-no-border" : $options['byblos_select_field_table_style_2'];
	
	$options['byblos_select_field_table_style_3'] = empty( $options['byblos_select_field_table_style_3'] ) ? "w3-table w3-small w3-border-0 tetra-font" : $options['byblos_select_field_table_style_3'];
	$options['byblos_select_field_table_style_4'] = empty( $options['byblos_select_field_table_style_4'] ) ? "w3-leftbar w3-border-0 w3-white" : $options['byblos_select_field_table_style_4'];
	
	/* $filename = plugin_dir_path(__FILE__) . "css/template.txt"; */
	$filename = plugin_dir_path(__FILE__) . "dbase/users/template.txt";
	$default = file_get_contents($filename);
	$options['textarea_html_output'] = empty( $options['textarea_html_output'] ) ? $default : $options['textarea_html_output'];
	$args = array('textarea_rows' => 20, 'textarea_name' => "byblos_settings[textarea_html_output]", 'tinymce' => array('toolbar1'=> 'bold,italic,underline,bullist,numlist,link,unlink,forecolor,undo,redo,'),'quicktags' => array('buttons' => 'strong,em,underline,ul,ol,li,link,code'),'media_buttons' => false);	
	/* $options['textarea_html_output'] = $default; */
	
	?>
<script src="<?php echo plugins_url('Tetrabyblos') ?>/js/jscolor.js"></script>
<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>
<table style="width: 630px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
<tbody>
<tr>
<td>
        <b>&bullet; Chart type: </b><br>
	    <select name='byblos_settings[byblos_select_field_chart_type]'>
		<option value='0' <?php selected( $options['byblos_select_field_chart_type'], '0' ); ?>>Radix only</option>
		<option value='1' <?php selected( $options['byblos_select_field_chart_type'], '1' ); ?>>Radix & Transit</option>
		<option value='2' <?php selected( $options['byblos_select_field_chart_type'], '2' ); ?>>Vedic (north style)</option>
		</select>	
</td>
<td>
        <b>&bullet; Chart style: </b><br>
	    <select name='byblos_settings[byblos_select_field_chart_style]'>
		<option value='0' <?php selected( $options['byblos_select_field_chart_style'], '0' ); ?>>Color</option>
		<option value='1' <?php selected( $options['byblos_select_field_chart_style'], '1' ); ?>>Stroke (Black & white)</option>
		</select>	
</td>	
</tr>	

	
<tr>
<td>
    <!-- <div class="tooltip">
	<span class="tooltiptext">Don't forget to save the settings below!</span> -->
        <b>&bullet; Select scale design: </b><br>
	    <select name='byblos_settings[byblos_select_field_3]'>
		<option value='0.6' <?php selected( $options['byblos_select_field_3'], '0.6' ); ?>>60%</option>
		<option value='0.65' <?php selected( $options['byblos_select_field_3'], '0.65' ); ?>>65%</option>
		<option value='0.7' <?php selected( $options['byblos_select_field_3'], '0.7' ); ?>>70%</option>
		<option value='0.75' <?php selected( $options['byblos_select_field_3'], '0.75' ); ?>>75%</option>
		<option value='0.8' <?php selected( $options['byblos_select_field_3'], '0.8' ); ?>>80%</option>
		<option value='0.85' <?php selected( $options['byblos_select_field_3'], '0.85' ); ?>>85%</option>
		<option value='0.9' <?php selected( $options['byblos_select_field_3'], '0.9' ); ?>>90%</option>
		<option value='0.95' <?php selected( $options['byblos_select_field_3'], '0.95' ); ?>>95%</option>
		<option value='1.0' <?php selected( $options['byblos_select_field_3'], '1.0' ); ?>>100%</option>
		</select><!-- </div> -->
</td>
<td>
    <!-- <div class="tooltip">
	<span class="tooltiptext">Don't forget to save the settings below!</span> -->
        <b>&bullet; Graphic chart glyphs scale: </b><br>
	    <select name='byblos_settings[byblos_select_field_chart]'>
		<option value='0.7' <?php selected( $options['byblos_select_field_chart'], '0.7' ); ?>>70%</option>
		<option value='0.8' <?php selected( $options['byblos_select_field_chart'], '0.8' ); ?>>80%</option>
		<option value='0.9' <?php selected( $options['byblos_select_field_chart'], '0.9' ); ?>>90%</option>
		<option value='1' <?php selected( $options['byblos_select_field_chart'], '1' ); ?>>100%</option>
		<option value='1.1' <?php selected( $options['byblos_select_field_chart'], '1.1' ); ?>>110%</option>
		<option value='1.2' <?php selected( $options['byblos_select_field_chart'], '1.2' ); ?>>120%</option>
		<option value='1.3' <?php selected( $options['byblos_select_field_chart'], '1.3' ); ?>>130%</option>
		</select><!-- </div> -->	
</td>
</tr>
<tr>
<td>
        <b>&bullet; Show custom uploaded images for:</b><br>
	    <select name='byblos_settings[byblos_select_field_16]'>
		<option value='1' <?php selected( $options['byblos_select_field_16'], 1 ); ?>>none</option>
		<option value='2' <?php selected( $options['byblos_select_field_16'], 2 ); ?>>only the ascendant</option>
		<option value='3' <?php selected( $options['byblos_select_field_16'], 3 ); ?>>only the ascendant and most dignified planet</option>
		<option value='4' <?php selected( $options['byblos_select_field_16'], 4 ); ?>>all</option>
		</select>	
</td>	
<td>
        <b>&bullet; Custom images max. size:</b><br>
	    <select name='byblos_settings[byblos_select_field_17]'>
		<option value='50' <?php selected( $options['byblos_select_field_17'], 50 ); ?>>50 px</option>
		<option value='100' <?php selected( $options['byblos_select_field_17'], 100 ); ?>>100 px</option>
		<option value='150' <?php selected( $options['byblos_select_field_17'], 150 ); ?>>150 px</option>
		<option value='200' <?php selected( $options['byblos_select_field_17'], 200 ); ?>>200 px</option>
		<option value='250' <?php selected( $options['byblos_select_field_17'], 250 ); ?>>250 px</option>
		<option value='300' <?php selected( $options['byblos_select_field_17'], 300 ); ?>>300 px</option>
		<option value='350' <?php selected( $options['byblos_select_field_17'], 350 ); ?>>350 px</option>
		<option value='400' <?php selected( $options['byblos_select_field_17'], 400 ); ?>>400 px</option>
		</select>	
</td>
</tr>	
<tr>
	<td>
	    <b>&bullet; Show Solar Sign glyph and name: </b><br>
		<select name='byblos_settings[byblos_select_field_6]'>
		<option value='1' <?php selected( $options['byblos_select_field_6'], 1 ); ?>>No (hide both)</option>
		<option value='2' <?php selected( $options['byblos_select_field_6'], 2 ); ?>>Yes (show both)</option>
		<option value='3' <?php selected( $options['byblos_select_field_6'], 3 ); ?>>Just Sign Glyph</option>
		<option value='4' <?php selected( $options['byblos_select_field_6'], 4 ); ?>>Just Sign name</option>
		</select>
	
	</td>
	<td>
	    <b>&bullet; Show progress bar: </b><br>
		<select name='byblos_settings[byblos_select_field_14]'>
		<option value='1' <?php selected( $options['byblos_select_field_14'], '1' ); ?>>No</option>
		<option value='2' <?php selected( $options['byblos_select_field_14'], '2' ); ?>>Yes</option>
		</select>
	</td>
</tr>
<tr>
    <td colspan="2">
		<h2>CSS Options - CSS Class Style (W3.CSS):</h2>
		<p>In this small section, you can modify the appearence of the buttons, tables, etc. which appear in the plugin. Please use the classes defined in the <b>W3 Schools w3.css file</b>, very well  explained at <b>https://www.w3schools.com/w3css/</b> (both usage and syntax).</p><br>
        <b>&bullet; Main Buttons (Calculate, Now, etc.): </b><br>
	    <input type='text' style="width: 500px;" name='byblos_settings[byblos_select_field_button_style]' value='<?php echo $options['byblos_select_field_button_style']; ?>'>
	    <br>
		<b>&bullet; Advanced Options Button: </b><br>
	    <input type='text' style="width: 500px;" name='byblos_settings[byblos_select_field_button_style_2]' value='<?php echo $options['byblos_select_field_button_style_2']; ?>'>
	    <br><br><br>
        <b>&bullet; Table(s) &lt;TABLE&gt; TAG general: </b><br>
	    <input type='text' style="width: 500px;" name='byblos_settings[byblos_select_field_table_style]' value='<?php echo $options['byblos_select_field_table_style']; ?>'>
	    <br>
		<b>&bullet; Table(s) &lt;TD&gt; TAG general: </b><br>
	    <input type='text' style="width: 500px;" name='byblos_settings[byblos_select_field_table_style_2]' value='<?php echo $options['byblos_select_field_table_style_2']; ?>'>
	    <br>
		<!-- <br>
		<b>&bullet; HTML: </b><br>
	    <textarea name="" id="" placeholder="css code for sections" style="width: 500px;" rows="5" cols="50"></textarea>
	    <br>
		<b>&bullet; CHART COLORS: </b><br>
		Outer ring color:
		<input value="ffffff" class="jscolor {width:101, padding:0, shadow:false, borderWidth:0, backgroundColor:'transparent', insetColor:'#000'}" style="width: 27px;">
		Middle ring color:
		<input value="ff0000" class="jscolor {width:101, padding:0, shadow:false, borderWidth:0, backgroundColor:'transparent', insetColor:'#000'}" style="width: 27px;">
        Inner ring color:
		<input value="ffff00" class="jscolor {width:101, padding:0, shadow:false, borderWidth:0, backgroundColor:'transparent', insetColor:'#000'}" style="width: 27px;">
	    <br> -->		
       </td>	
</tr>
    <tr>
    <td colspan="2">
	<h2>Layout Options - CSS Class Style (W3.CSS):</h2>
	In this section, you have the ability to control how the differents results will appear in the results page. A quick example: if you want the planets and houses to appear in the same row, you could replace<br><br>
	<i>
	&lt;div class="w3-content w3-center" id="TETRA_PLANETS" style="margin: 0 auto;background-color: white;">&lt;/div&gt;<br>
    &lt;div class="w3-content w3-center" id="TETRA_HOUSES" style="margin: 0 auto;background-color: white;"&gt;&lt;/div&gt;<br>	
	</i>	
	<br><p>by:</p><br>		
	<i>
	&lt;div class="w3-row w3-border-0"&gt;<br>
    &lt;div class="w3-container w3-half w3-border-0"&gt;<br>
	&lt;div class="w3-content w3-center" id="TETRA_PLANETS" style="margin: 0 auto;background-color: white;">&lt;/div&gt;<br>
	&lt;div&gt;<br>
    &lt;div class="w3-container w3-half w3-border-0"&gt;<br>
    &lt;div class="w3-content w3-center" id="TETRA_HOUSES" style="margin: 0 auto;background-color: white;"&gt;&lt;/div&gt;<br>
	&lt;div&gt;<br>
	&lt;div&gt;<br>
	</i>	
	<br>
	Right next, you can select the hexadecimal decimal colors for your graphical chart. To make Mars glyph red (hexadecimal: #FF0000), for example, you just need to change this value:<br><br>
	<i>astrology_COLOR_MARS = "#FF0000";</i>
	<br><br>		
	And finally, the CSS for the tabs on the input page can also be changed.
	<br><br>
	<?php	
	wp_editor( $options['textarea_html_output'], "byblos_settings[textarea_html_output]", $args );
	?>
	</td>
	<tr><td colspan="2">
	<h3>DIVs refer to the following sections:</h3>
	<ul>
    <li>TETRA_TITLE: Title + name</li>
    <li>TETRA_BIRTH_DETAILS: birthdate details, and house+zodia settings</li>
    <li>TETRA_ASTRO_REPORT: astronomy report</li>
	<li>TETRA_CHART: graphical astrological chart</li>
	<li>TETRA_ASPECTS_GRID: graphical aspectarian grid</li>
	<li>TETRA_TRANSITS: calculate transits button</li>
	<li>TETRA_PLANETS: position of the planets</li>
	<li>TETRA_HOUSES: house cusps</li>
	<li>TETRA_STARS: stars positions</li>
	<li>TETRA_ASPECTS: astrological aspects</li>
	<li>TETRA_PARS: arabic parts</li>
	<li>TETRA_DIGS: dignities table</li>
	<li>TETRA_ELEMENTS: elements and qualities</li>
	<li>TETRA_VEDIC: vedic report</li>
	<li>TETRA_REPORTS: writen report</li>
	<li>TETRA_SHORT_REPORTS: writen short report for sun and ascendant sign</li>
    </ul>  
	
	</td>	
	</tr>
	
	
</tbody>
</table>	
</div>	
	
<?php

}


function byblos_select_field_4_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_4'] = empty( $options['byblos_select_field_4'] ) ? 0 : $options['byblos_select_field_4'];
	/* $options['byblos_select_field_5'] = empty( $options['byblos_select_field_5'] ) ? '-1' : $options['byblos_select_field_5']; */
	$options['byblos_select_field_5'] = is_null( $options['byblos_select_field_5'] ) ? '-1' : $options['byblos_select_field_5'];
	?>
	
<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>
<table style="width: 630px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
<tbody>
<tr>
<td style="width: 50%;">
	<b>&bullet; Default house system:</b>
    <select name='byblos_settings[byblos_select_field_4]'>
		<option value='0' <?php selected( $options['byblos_select_field_4'], '0' ); ?>>Placidus</option>
		<option value='13' <?php selected( $options['byblos_select_field_4'], '13' ); ?>>Alcabitus</option>
		<option value='1' <?php selected( $options['byblos_select_field_4'], '1' ); ?>>Campanus</option>
		<option value='11' <?php selected( $options['byblos_select_field_4'], '11' ); ?>>Equal house - Asc.</option>
		<option value='2' <?php selected( $options['byblos_select_field_4'], '2' ); ?>>Equal House - Whole sign</option>
		<option value='9' <?php selected( $options['byblos_select_field_4'], '9' ); ?>>Koch</option>
		<option value='7' <?php selected( $options['byblos_select_field_4'], '7' ); ?>>Morinus</option>
		<option value='8' <?php selected( $options['byblos_select_field_4'], '8' ); ?>>Meridian</option>
		<option value='6' <?php selected( $options['byblos_select_field_4'], '6' ); ?>>Porphyrius</option>
		<option value='14' <?php selected( $options['byblos_select_field_4'], '14' ); ?>>Neo-Porphyrius</option>
		<option value='3' <?php selected( $options['byblos_select_field_4'], '3' ); ?>>Vedic</option>
		<option value='5' <?php selected( $options['byblos_select_field_4'], '5' ); ?>>Regiomontanus</option>
		<option value='4' <?php selected( $options['byblos_select_field_4'], '4' ); ?>>Topocentric</option>
		</select>
	</td>
	<td style="width: 50%">
		<b>&bullet; Default Zodiac system:</b>
	<select name='byblos_settings[byblos_select_field_5]'>
		<option value='-1' <?php selected( $options['byblos_select_field_5'], '-1' ); ?>>Western - Tropical</option>
		<option value='0' <?php selected( $options['byblos_select_field_5'], '0' ); ?>>Sidereal - Fagan/Bradley</option>
		<option value='1' <?php selected( $options['byblos_select_field_5'], '1' ); ?>>Sidereal - Lahiri</option>
		<option value='2' <?php selected( $options['byblos_select_field_5'], '2' ); ?>>Sidereal - DeLuce</option>
		<option value='3' <?php selected( $options['byblos_select_field_5'], '3' ); ?>>Sidereal - B.V. Raman</option>
		<option value='4' <?php selected( $options['byblos_select_field_5'], '4' ); ?>>Sidereal - Usha/Shashi</option>
		<option value='5' <?php selected( $options['byblos_select_field_5'], '5' ); ?>>Sidereal - Krishnamurti</option>
		<option value='6' <?php selected( $options['byblos_select_field_5'], '6' ); ?>>Sidereal - Djwhal Khool</option>
		<option value='7' <?php selected( $options['byblos_select_field_5'], '7' ); ?>>Sidereal - Shri Yukteshwar</option>
		<option value='8' <?php selected( $options['byblos_select_field_5'], '8' ); ?>>Sidereal - J.N. Bhasin</option>
		<option value='9' <?php selected( $options['byblos_select_field_5'], '9' ); ?>>Sidereal - Hipparchos</option>
		<option value='10' <?php selected( $options['byblos_select_field_5'], '10' ); ?>>Sidereal - Sassanian</option>
		<option value='12' <?php selected( $options['byblos_select_field_5'], '12' ); ?>>Sidereal - J1900</option>
		<option value='13' <?php selected( $options['byblos_select_field_5'], '13' ); ?>>Sidereal - J1950</option>
		</select>
	</td>
	</tr>
	</tbody>
	</table>
</div>
	
	
<?php
}


function byblos_select_field_pars_render(  ) { 

	$options = get_option( 'byblos_settings' );
    $options['byblos_select_field_pars'] = empty( $options['byblos_select_field_pars'] ) ? '-1,' : $options['byblos_select_field_pars'];
	?>

<style>
div.multiple_select_checkbox {
    width: 550px;
    height: 200px;
    overflow-x: hidden;
    overflow-y: auto;
    border: 1px solid #CCCCCC;
    
  font-family: 'Verdana';
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 2px;
  font-size: 10px;
  padding: 1rem;
  background-color: #FAFCFD;
  border: 3px solid transparent;
  transition: .3s ease-in-out;
  
  &::-webkit-input-placeholder {
    color: #333;
    
    
}
</style>

<div class="tooltip">
<span class="tooltiptext">Don't forget to save the settings below!</span>
<table style="width: 550px;border: 1px solid grey;padding: 15px;text-align: left;border-radius: 15px;" >
<tbody>
<tr>
<td style="width: 50%;" colspan="2">
	<b>&bullet; Select Parts to show: </b><br><span id="formula" style="font-size: 12px;"></span><br>
<div class="multiple_select_checkbox" onmouseleave="document.getElementById('formula').innerHTML=' '">

<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Jupiter (R)'" style="display: none;"><input type="checkbox" name="slt_pars" value="0" onclick="validate_pars();">Life</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Spirit - Fortune (R)'"><input type="checkbox" name="slt_pars" value="1" onclick="validate_pars();">Pillar of horoscope - Nativities, permanence, constancy</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Mercury (R)'"><input type="checkbox" name="slt_pars" value="2" onclick="validate_pars();">Reasoning and eloquence</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + cusp of 2nd - lord of 2nd (R)'"><input type="checkbox" name="slt_pars" value="3" onclick="validate_pars();">Property</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Saturn (R)'"><input type="checkbox" name="slt_pars" value="4" onclick="validate_pars();">Debt</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Mercury (S)'"><input type="checkbox" name="slt_pars" value="5" onclick="validate_pars();">Treasure Trove</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Saturn (S)'"><input type="checkbox" name="slt_pars" value="6" onclick="validate_pars();">Brothers</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Mercury (S)'"><input type="checkbox" name="slt_pars" value="7" onclick="validate_pars();">Number of brothers</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + 10 Gemini - Sun (R)'"><input type="checkbox" name="slt_pars" value="8" onclick="validate_pars();">Death of brothers & sisters</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Sun (or Jupiter) (R)'"><input type="checkbox" name="slt_pars" value="9" onclick="validate_pars();">Parents</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Saturn (R)'"><input type="checkbox" name="slt_pars" value="10" onclick="validate_pars();">Death of parents</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - cusp of 2nd  (R)'"><input type="checkbox" name="slt_pars" value="11" onclick="validate_pars();">Grandparents</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Saturn (R)'"><input type="checkbox" name="slt_pars" value="12" onclick="validate_pars();">Ancestors and relations</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="13">Ancestors and relations</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Saturn (R)'"><input type="checkbox" name="slt_pars" value="14" onclick="validate_pars();">Real estate acc. Hermes</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Mercury (R)'"><input type="checkbox" name="slt_pars" value="15" onclick="validate_pars();">Real estate acc. some Persians</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Venus (S)'"><input type="checkbox" name="slt_pars" value="16" onclick="validate_pars();">Agriculture, tillage</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Lord of last syzygy - Saturn  (S)'"><input type="checkbox" name="slt_pars" value="17" onclick="validate_pars();">Issue of affairs [end of matter]</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Jupiter (Venus) (R)'"><input type="checkbox" name="slt_pars" value="18" onclick="validate_pars();">Children</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Mars  (S)'"><input type="checkbox" name="slt_pars" value="19" onclick="validate_pars();">Time and number of sexes</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="20">Condition of males</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="21">Condition of females</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - lord of Moon  (R)'"><input type="checkbox" name="slt_pars" value="22" onclick="validate_pars();">Whether expected birth is male or female</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Saturn  (R)'"><input type="checkbox" name="slt_pars" value="23" onclick="validate_pars();">Disease, defects, time of onset acc. Hermes</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Mercury (S)'"><input type="checkbox" name="slt_pars" value="24" onclick="validate_pars();">Disease, defects, time of onset acc. some of the ancients</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + dispositor lord of time- lord of time  (S)'"><input type="checkbox" name="slt_pars" value="25" onclick="validate_pars();">Captivity</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Mercury (S)'"><input type="checkbox" name="slt_pars" value="26" onclick="validate_pars();">Slaves</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="27">Marriage of men acc. Hermes</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="28">Marriage of men acc. Vettius Valens</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Sun (S)'"><input type="checkbox" name="slt_pars" value="29" onclick="validate_pars();">Trickery and deception of men and women</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Sun (S)'"><input type="checkbox" name="slt_pars" value="30" onclick="validate_pars();">Intercourse</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="31">Marriage of women (Hermes)</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="32">Marriage of women (Valens)</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Moon (S)'"><input type="checkbox" name="slt_pars" value="33" onclick="validate_pars();">Misconduct by women</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Moon (S)'"><input type="checkbox" name="slt_pars" value="34" onclick="validate_pars();">Trickery and deceit of men by women</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Moon (S)'"><input type="checkbox" name="slt_pars" value="35" onclick="validate_pars();">Intercourse</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="36">Unchastity of women</div>
<div id="multiple_select_checkbox_choice" style="display: none;"><input type="checkbox" name="slt_pars" value="37">Chastity of women</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Cusp of 7th - Venus (S)'"><input type="checkbox" name="slt_pars" value="38" onclick="validate_pars();">Marriage of men and women acc. Hermes</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Sun (S)'"><input type="checkbox" name="slt_pars" value="39" onclick="validate_pars();">Time of marriage (Hermes)</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Saturn (S)'"><input type="checkbox" name="slt_pars" value="40" onclick="validate_pars();">Fraudulent marriage & Facilitating it</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Saturn (R)'"><input type="checkbox" name="slt_pars" value="41" onclick="validate_pars();">Sons in law</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Mars (R)'"><input type="checkbox" name="slt_pars" value="42" onclick="validate_pars();">Lawsuits</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Degree of Saturn + Cusp of 8th - Moon (S)'"><input type="checkbox" name="slt_pars" value="43" onclick="validate_pars();">Death</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Lord of Asc (R)'" style="display: none;"><input type="checkbox" name="slt_pars" value="44" onclick="validate_pars();">Anairetai [anareta: destroyer]</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + dispositor of last syzygy - Saturn  (S)'"><input type="checkbox" name="slt_pars" value="45" onclick="validate_pars();">Year to be feared at birth for death, famine</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Degree of Mercury + Mars - Saturn (R)'"><input type="checkbox" name="slt_pars" value="46" onclick="validate_pars();">Place of murder and sickness</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Saturn (R)'"><input type="checkbox" name="slt_pars" value="47" onclick="validate_pars();">Danger of violence</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Cusp of 9th - Lord of 9th (S)'"><input type="checkbox" name="slt_pars" value="48" onclick="validate_pars();">Journeys</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + 15 Cancer - Saturn (R)'"><input type="checkbox" name="slt_pars" value="49" onclick="validate_pars();">By water</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Moon (R)'"><input type="checkbox" name="slt_pars" value="50" onclick="validate_pars();">Timidity and hiding</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Saturn (R)'"><input type="checkbox" name="slt_pars" value="51" onclick="validate_pars();">Deep reflection</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Saturn (R)'"><input type="checkbox" name="slt_pars" value="52" onclick="validate_pars();">Understanding and wisdom</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Sun (R)'"><input type="checkbox" name="slt_pars" value="53" onclick="validate_pars();">Traditions, knowledge of affairs</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Mercury (S)'"><input type="checkbox" name="slt_pars" value="54" onclick="validate_pars();">Knowledge whether true or false</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Degree of exaltation of the lord of time - lord of time  (R)'"><input type="checkbox" name="slt_pars" value="55" onclick="validate_pars();">Noble births</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Mercury (R)'"><input type="checkbox" name="slt_pars" value="56" onclick="validate_pars();">Kings and Sultans</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Mercury (R)'"><input type="checkbox" name="slt_pars" value="57" onclick="validate_pars();">Administrators, vazirs [ministers], etc.</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Sun (R)'"><input type="checkbox" name="slt_pars" value="58" onclick="validate_pars();">Sultan's victory, conquest</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Fortune - Saturn (R)'"><input type="checkbox" name="slt_pars" value="59" onclick="validate_pars();">Of those who rise in station</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Saturn (S)'"><input type="checkbox" name="slt_pars" value="60" onclick="validate_pars();">Celebrated persons of rank</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Saturn - Mars (R)'"><input type="checkbox" name="slt_pars" value="61" onclick="validate_pars();">Armies and police</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Saturn (S)'"><input type="checkbox" name="slt_pars" value="62" onclick="validate_pars();">Sultan. Those concerned In nativities</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Mercury (R)'"><input type="checkbox" name="slt_pars" value="63" onclick="validate_pars();">Merchants and their work</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Fortune - Spirit (R)'"><input type="checkbox" name="slt_pars" value="64" onclick="validate_pars();">Buying and selling</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Sun (R)'"><input type="checkbox" name="slt_pars" value="65" onclick="validate_pars();">Operations and orders in medical Treatment</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Venus (R)'"><input type="checkbox" name="slt_pars" value="66" onclick="validate_pars();">Mothers</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Spirit - Fortune (R)'"><input type="checkbox" name="slt_pars" value="67" onclick="validate_pars();">Glory</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Spirit - Fortune (R)'"><input type="checkbox" name="slt_pars" value="68" onclick="validate_pars();">Friendship and enmity</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Fortune (R)'"><input type="checkbox" name="slt_pars" value="69" onclick="validate_pars();">Known by men and revered, Constant in affairs</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Fortune (R)'"><input type="checkbox" name="slt_pars" value="70" onclick="validate_pars();">Success</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Fortune (R)'"><input type="checkbox" name="slt_pars" value="71" onclick="validate_pars();">Worldliness</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Jupiter (R)'"><input type="checkbox" name="slt_pars" value="72" onclick="validate_pars();">Hope</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Moon (S)'"><input type="checkbox" name="slt_pars" value="73" onclick="validate_pars();">Friends</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Spirit (S)'"><input type="checkbox" name="slt_pars" value="74" onclick="validate_pars();">Violence</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Moon (S)'"><input type="checkbox" name="slt_pars" value="75" onclick="validate_pars();">Abundance in house</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Mercury (R)'"><input type="checkbox" name="slt_pars" value="76" onclick="validate_pars();">Liberty of Person</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Venus - Jupiter (R)'"><input type="checkbox" name="slt_pars" value="77" onclick="validate_pars();">Praise and acceptation</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Saturn (S)'"><input type="checkbox" name="slt_pars" value="78" onclick="validate_pars();">Enmity acc. some of the ancients</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Cusp of 12th - Lord of 12th (S)'"><input type="checkbox" name="slt_pars" value="79" onclick="validate_pars();">Enmity acc. Hermes</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Fortune - Spirit (S)'" style="display: none;"><input type="checkbox" name="slt_pars" value="80" onclick="validate_pars();">Bad luck</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Sun (R)'" style="display: none;"><input type="checkbox" name="slt_pars" value="81" onclick="validate_pars();">Fortune or Lunar horoscope</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Moon (R)'" style="display: none;"><input type="checkbox" name="slt_pars" value="82" onclick="validate_pars();">Daemon and religion [Spirit]</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Spirit - Fortune (R)'"><input type="checkbox" name="slt_pars" value="83" onclick="validate_pars();">Friendship and love</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Fortune - Spirit (R)'"><input type="checkbox" name="slt_pars" value="84" onclick="validate_pars();">Despair & penury & fraud</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Fortune - Saturn (R)'"><input type="checkbox" name="slt_pars" value="85" onclick="validate_pars();">Captivity, prisons and escape therefrom</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Jupiter - Spirit (R)'"><input type="checkbox" name="slt_pars" value="86" onclick="validate_pars();">Victory, triumph & aid</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Fortune - Mars (R)'"><input type="checkbox" name="slt_pars" value="87" onclick="validate_pars();">Valour and bravery</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - degree of previous syzygy (S)'" style="display: none;"><input type="checkbox" name="slt_pars" value="88" onclick="validate_pars();">Hailaj [Hyleg, life-giver]</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Fortune (R)'"><input type="checkbox" name="slt_pars" value="89" onclick="validate_pars();">Debilitated bodies</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Saturn (R)'"><input type="checkbox" name="slt_pars" value="90" onclick="validate_pars();">Horsemanship, bravery</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Moon - Lord of Asc (R)'"><input type="checkbox" name="slt_pars" value="91" onclick="validate_pars();">Boldness, violence and murder</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Spirit - Mercury (R)'"><input type="checkbox" name="slt_pars" value="92" onclick="validate_pars();">Trickery and deceit</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Saturn (S)'"><input type="checkbox" name="slt_pars" value="93" onclick="validate_pars();">Necessity and wish</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Cusp of 3rd - Mars (S)'"><input type="checkbox" name="slt_pars" value="94" onclick="validate_pars();">Requirements and necessities acc. Egyptians</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mercury - Fortune (S)'"><input type="checkbox" name="slt_pars" value="95" onclick="validate_pars();">Realisation of needs and desires</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Sun - Mars (R)'"><input type="checkbox" name="slt_pars" value="96" onclick="validate_pars();">Retribution</div>
<div id="multiple_select_checkbox_choice" onmouseover="document.getElementById('formula').innerHTML='Formula: Asc + Mars - Mercury (R)'"><input type="checkbox" name="slt_pars" value="97" onclick="validate_pars();">Rectitude</div>

</div>
</td>
</tr>
<tr>
<!-- <td style="text-align: center;"><button type="button" onclick="validate_pars();">Add selected Parts</button> 
</td> -->
<td style="text-align: center;" colspan="2"><button type="button" onclick="clear_pars();">Clear selection</button>
<input type="hidden" name="byblos_settings[byblos_select_field_pars]" id="byblos_settings[byblos_select_field_pars]" value="<?php echo $options['byblos_select_field_pars'] ; ?>">	
</td>
</tr>
	</tbody>
	</table>
</div>

<script>
var myOpt = "<?php echo $options['byblos_select_field_pars'] ; ?>";
var curOpt = myOpt.split(',');
//if(curOpt.length > 0){
if(curOpt[0] > -1){
	for(i=0;i<curOpt.length;i++){
		var z = curOpt[i];
		document.getElementsByName("slt_pars")[z].setAttribute("checked",true);
	}		
}
	
function validate_pars(){
    var what = "";
	var count = 0;
    for (var i=0;i<document.getElementsByName("slt_pars").length;i++){
       if(document.getElementsByName("slt_pars")[i].checked == true){
		   what += document.getElementsByName("slt_pars")[i].value + ",";
	       count += 1;
	   }
    }
    what = what.substring(0, what.length - 1);
    document.getElementById('byblos_settings[byblos_select_field_pars]').setAttribute("value",what);
	//alert(count + " Part(s) have been chosen. Please save the settings below.");
	return;
}
	
function clear_pars(){
    for (var i=0;i<document.getElementsByName("slt_pars").length;i++){
       if(document.getElementsByName("slt_pars")[i].checked == true){
		   document.getElementsByName("slt_pars")[i].checked = false;
	   }
    }
    document.getElementById('byblos_settings[byblos_select_field_pars]').setAttribute("value",'-1,');
	//alert("List cleared. Please save the settings below.");
	return;
}
</script>


	
<?php
}



function byblos_settings_section_callback(  ) { 

	echo __( 'Enter your options details please:', 'byblos' );

}
function byblos_settings_section_callback_2(  ) { 

	echo __( 'Check your personal options please:', 'byblos' );
}

function byblos_settings_section_callback_3(  ) { 

	echo __( 'Check your personal options please:', 'byblos' );
}

function byblos_settings_section_callback_4(  ) { 

	echo __( 'Check your personal options please:', 'byblos' );
}

function byblos_options_page(  ) { 

   if ( isset( $_GET['settings-updated'] ) ) {
    echo "<div class='updated'><p>Settings updated successfully.</p></div>";
   } else {
    settings_errors();
   }
$plugin_data = get_plugin_data( __FILE__ );
$plugin_version = $plugin_data['Version'];
$link_url = admin_url( 'admin.php?page=user_role_editor_slug_intro');

?>
<form action='options.php' method='post'>
<style>
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
    font-size: 17px;
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
iframe {
  width: 80%;
  height: 600px;
  padding:20px;

  -moz-border-radius: 12px;
  -webkit-border-radius: 12px;
  border:1px solid lightgrey;
  border-radius: 12px;

  -moz-box-shadow: 4px 4px 14px #000;
  -webkit-box-shadow: 4px 4px 14px #000;
  box-shadow: 4px 4px 14px #000;
}
</style>

		<h1>Tetrabyblos Plugin - Version <?php echo $plugin_version; ?></h1>
	    <div style="width: 700px;text-align: justify">
		<p>This Plugin, allows the insertion of a a simple short code to display the complete horoscope of your users. For details and general use, see the Menu section <b>Introduction & Help</b> <a href='admin.php?page=user_role_editor_slug_intro'>here.</a></p><hr>
		</div>
	    <h2 style="color: #cc0000;">&bullet; Please, don't forget to allways press the "Save changes" button below after changing the parameters!</h2>

<?php
$doc_root = plugins_url('Tetrabyblos');
$image_file = $doc_root . "/images/save_all_settings.jpg";
$img_text = "<br><img src='".$image_file."' width='250px'><br>";
echo $img_text;
	
	    $file = plugins_url('Tetrabyblos') . "/data/logs.txt";
        $linecount = -1;
        $handle = fopen($file, "r");
        while(!feof($handle)){
         $line = fgets($handle);
         $linecount++;
         }
        fclose($handle);
	    if($linecount < 0){$linecount = 0;}
	    echo "<hr><b>Number of different charts done by your users until now :</b> " . $linecount . "<hr>";
	
	    if( get_page_by_title( 'Transits' ) == NULL ){
			//echo "Transits page exists!<br>";
			/* Begin */
			$my_post = array(
                'post_title'    => wp_strip_all_tags( 'Transits' ),
                'post_content'  => '[byblostransits]',
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'page',
                 );

	        $page_path = 'transits/';	
	        if( ! $page = get_page_by_path( $page_path ) ){
                wp_insert_post( $my_post );
	        }
			/* End */
		}
	    if( get_page_by_title( 'Transitos' ) == NULL ){
			//echo "Transitos page doesn't exists!<br>";
		}
	
	    

		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
	    echo "<hr><h2 style='color: red;'>Don't forget to save the settings here!</h2>";
		submit_button();
	    echo "<hr>";
	      
	    $local_query = plugins_url('Tetrabyblos')."/dbase/database.php?";
	    $local_query_transit = plugins_url('Tetrabyblos')."/dbase/transits.php?";
	    $local_functions = plugins_url('Tetrabyblos')."/myFunctions.php";
	    
	
	    $digfile = plugin_dir_path( __FILE__ ) . "dbase/users/custom.json";
	    
	    $dig_query = plugins_url('Tetrabyblos')."/dbase/dignities.php?file=".$digfile;
?>
        <br><br>
        <h1>Tetrabyblos Personal Interpretations & Dignities Editor</h1>
        <p>Please fill in the interpretations fields you want (in <i>Comments</i>) and <b>activate them</b> if you wish them to appear in your personal reports (when the option above <i>Show interpretations</i> is set to yes).<br>
        This way you can control your drafts and definitive texts. You can also configure your own <i>Custom Essential Dignities table</i> and use it by selecting it above, in the dignities table option.</p>
	</form>

<?php
$zip_date = 0;
foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.zip" ) as $file ) {
	$zip_date = filectime($file);
	$zip_name = $file;
}
$now = time();
$days_dif = floor(($zip_date - $now) / (60*60*24));
if($days_dif > 0){
	echo "<h3>Your last backup is <b>older than 3 days.</b> Please perform a backup, and save it to your computer.</h3><br><br>";
}
if($days_dif < 0){
	echo "<h3>You haven't any backup of your current texts. Please perform one, and save it to your computer.</h3><br><br>";
}
?>	

<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'General')" id="defaultOpen">General</button>

  <button class="tablinks" onclick="openTab(event, 'Signs_Intro')">Signs Intro</button>
	
  <button class="tablinks" onclick="openTab(event, 'Signs')">Signs</button>
  <button class="tablinks" onclick="openTab(event, 'Houses')">Houses</button>
  <button class="tablinks" onclick="openTab(event, 'Aspects')">Aspects</button>
  <button class="tablinks" onclick="openTab(event, 'Transits')">Transits</button>
  <button class="tablinks" onclick="openTab(event, 'Dignities')">Dignities</button>
  <button class="tablinks" onclick="openTab(event, 'Nakshatras')">Nakshatras</button>
</div>
<div id="General" class="tabcontent">
  <h3>General Texts</h3>
  <p><iframe src="<?php echo $local_query ?>file=general" ></iframe></p>
</div>

<div id="Signs_Intro" class="tabcontent">
  <h3>Signs Intro</h3>
  <p><iframe src="<?php echo $local_query ?>file=signs_short" ></iframe></p>
</div>

<div id="Signs" class="tabcontent">
  <h3>Planets in Signs</h3>
  <p><iframe src="<?php echo $local_query ?>file=signs" ></iframe></p>
</div>		
<div id="Houses" class="tabcontent">
  <h3>Planets in Houses</h3>
  <p><iframe src="<?php echo $local_query ?>file=houses" ></iframe></p>
</div>
<div id="Aspects" class="tabcontent">
  <h3>Aspects between Planets</h3>
  <p><iframe src="<?php echo $local_query ?>file=aspects" ></iframe></p>
</div>
<div id="Transits" class="tabcontent">
  <h3>Transits</h3>
  <p><iframe src="<?php echo $local_query_transit ?>file=Sun" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Moon" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Mercury" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Venus" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Mars" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Jupiter" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Saturn" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Uranus" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Neptune" ></iframe></p>
  <p><iframe src="<?php echo $local_query_transit ?>file=Pluto" ></iframe></p>
</div>
<div id="Dignities" class="tabcontent">
  <h3>Dignities - Custom</h3>
  <p><iframe src="<?php echo $dig_query ?>" ></iframe></p>
</div>

<div id="Nakshatras" class="tabcontent">
  <h3>Planets in Nakshatras</h3>
  <p><iframe src="<?php echo $local_query ?>file=nakshatras" ></iframe></p>
</div>

<br><br>
<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
    document.getElementById("defaultOpen").click();

	

</script>

<?php

}

function get_local_file_contents( $file_path ) {
    ob_start();
    include $file_path;
    $contents = ob_get_clean();
    return $contents;
}

/*class Encryption_OLD {
	
	
    var $skey = "[a8XS/E34N$;E3nPHK}kP}k`aZbe+bAr";   

    public  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public  function encode($value){ 
        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }

    public function decode($value){
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
}
*/
class Encryption {
	
	 var $skey = "[a8XS/E34N$;E3nPHK}kP}k`aZbe+bAr";
	 public function encode($string_to_encrypt){
		 return openssl_encrypt($string_to_encrypt,"AES-128-ECB",$this->skey);
	 }
	 public function decode($encrypted_string){
		 return openssl_decrypt($encrypted_string,"AES-128-ECB",$this->skey);
	 }
	
}

/**
 * Render the settings page
 */
function byblos_settings_page() {

	$options = get_option( 'byblos_settings' ); ?>
	<div class="wrap">
		<h2><?php
	    _e('Backup and Restore Plugin Settings'); ?></h2>


		<div class="metabox-holder">
			<div class="postbox">
				<h3><span><?php _e( 'Export Settings' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="pwsix_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'pwsix_export_nonce', 'pwsix_export_nonce' ); ?>
							<?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->

			<div class="postbox">
				<h3><span><?php _e( 'Import Settings' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.' ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p>
							<input type="file" name="import_file"/>
						</p>
						<p>
							<input type="hidden" name="pwsix_action" value="import_settings" />
							<?php wp_nonce_field( 'pwsix_import_nonce', 'pwsix_import_nonce' ); ?>
							<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->
		</div><!-- .metabox-holder -->

	</div><!--end .wrap-->
	<?php
}

/**
 * Process a settings export that generates a .json file of the shop settings
 */
function pwsix_process_settings_export() {

	if( empty( $_POST['pwsix_action'] ) || 'export_settings' != $_POST['pwsix_action'] )
		return;

	if( ! wp_verify_nonce( $_POST['pwsix_export_nonce'], 'pwsix_export_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	$settings = get_option( 'byblos_settings' );

	ignore_user_abort( true );

	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=pwsix-settings-export-' . date( 'Y-m-d-H-i' ) . '.json' );
	header( "Expires: 0" );

	echo json_encode( $settings );
	exit;
}
add_action( 'admin_init', 'pwsix_process_settings_export' );

/**
 * Process a settings import from a json file
 */
function pwsix_process_settings_import() {
	
	$message = "Ok";
	$link_url = admin_url( 'admin.php?page=user_role_editor_slug_intro');

	if( empty( $_POST['pwsix_action'] ) || 'import_settings' != $_POST['pwsix_action'] )
		return;

	if( ! wp_verify_nonce( $_POST['pwsix_import_nonce'], 'pwsix_import_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	if( empty( $_FILES['import_file']['name'] ) ) {
		/* wp_die( __( 'Please upload a file to import' ) ); */
		return;
	}
	
	$extension = end( explode( '.', $_FILES['import_file']['name'] ) );

	if( $extension != 'json' ) {
		/* wp_die( __( 'Please upload a valid .json file' ) ); */
		return;
	}

	$import_file = $_FILES['import_file']['tmp_name'];

	if( empty( $import_file ) ) {
		/* wp_die( __( 'Please upload a file to import' ) ); */
		return;
	}

	// Retrieve the settings from the file and convert the json object to an array.
	$settings = (array) json_decode( file_get_contents( $import_file ) );

	update_option( 'byblos_settings', $settings );
	/* return $message; */

	/* wp_safe_redirect( admin_url( 'admin.php?page=user_role_editor_slug_intro') ); */
	wp_safe_redirect( admin_url( 'admin.php?page=tetrabyblos_plugin') );
	exit;

}
add_action( 'admin_init', 'pwsix_process_settings_import' );



/* BACKUP ALL - SETTINGS, TEXTS AND LANGUAGE TRANSLATIONS */
/* Zip Settings */
/**
 * Render the Backup settings page
 */
function tetrabyblos_settings_save_all_page() {

	$options = get_option( 'byblos_settings' ); ?>
	<div>
			<div>
				<h3><span><?php _e( 'Backup Settings and configurations, text reports and language translation.' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Please wait a few seconds...' ); ?></p>
				</div>
			</div>
	<?php
    /* CONFIGURATION - SAVE SETTINGS ON FILE */
    $settings = get_option( 'byblos_settings' );
    $json_content = json_encode( $settings );
    $filename = plugin_dir_path(__FILE__) . "dbase/users/settings.txt";
    file_put_contents($filename,$json_content);
    /* LANGUAGE - SAVE */
    $filename = plugin_dir_path(__FILE__) . "dbase/users/myOwnTranslation.txt";
    $option_name = 'byblos_text_field_language_default';
    $mytext = tetrabyblos_get_language_array();
    $arrlength = count( $mytext );
    $temp = '{';
    for($x=0;$x<$arrlength;$x++){
    $temp .= '"' . $mytext[$x] . '" : "' . $mytext[$x] . '",';
    }
    $temp .= '"nothing" : "nothing"}';	
    file_put_contents($filename,$temp);

    /* ZIP ALL FILES FROM THE DBASE/USERS DIR TO MYTETRABYBLOS.ZIP */
    $date = date('YmdHis');
    foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.zip" ) as $zipfile ) {
	    unlink($zipfile);
    }
    $zipname = plugin_dir_path( __FILE__ ) . "dbase/users/myTetrabyblos-$date.zip";
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE|ZipArchive::OVERWRITE);
    foreach ( glob( plugin_dir_path( __FILE__ ) . "dbase/users/*.*" ) as $file ) {
	    $zip->addFile($file,basename($file));
    }
    $zip->close();
    /* Link of the Zip */ 
    $ziplink = plugins_url( "dbase/users/myTetrabyblos-$date.zip", __FILE__ );
    echo "<div class='updated'><p>Your texts were zipped! If the download doesn't start automatically, please download them <a href='$ziplink'>here</a>.</p></div>";
    echo "<script> document.location.href = '" . $ziplink . "'; </script>";
	exit;	
	
}
/* Unzip all files */
function tetrabyblos_settings_restore_all_page(){

  if(!empty($_FILES["zip_file"]["name"])) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
	
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "The file you are trying to upload is not a .zip file. Please try again.";
	}

	$target_path = plugin_dir_path( __FILE__ ) . "/dbase/users/".$filename;
	if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			$zip->extractTo(plugin_dir_path( __FILE__ ) . "/dbase/users/");
			$zip->close();
	
			unlink($target_path);
		}
		$message = "Your .zip file was uploaded and unpacked.<br>Your report texts were restored...";
		
		// Retrieve the settings from the file and convert the json object to an array.
		$import_file = plugin_dir_path( __FILE__ ) . "/dbase/users/settings.txt";
	    $settings = (array) json_decode( file_get_contents( $import_file ) );
		/* Update configurations and settings */
		//update_option( 'byblos_settings', $settings );
	    /* $message .= "<br>Your settings were restored..."; */
		$import_file = plugin_dir_path( __FILE__ ) . "/dbase/users/myOwnTranslation.txt";
		$texts = file_get_contents($import_file);
		$texts = str_replace("\r", "", $texts);
        $texts = str_replace("\n", "", $texts);
		$option_name = 'byblos_text_field_language_json';
	    if ( get_option( $option_name ) !== false ) {
          //update_option( $option_name, $texts );
          /* $message .= "<br>Your translation settings were restored..."; */
        } else {
          $deprecated = null;
          $autoload = 'no';
          //add_option( $option_name, $texts, $deprecated, $autoload );
         /* $message .= "<br>Your translation settings were restored..."; */
        }
		/* $message .= "<br>Done!.."; */
		
		
	} else {	
		$message = "There was a problem with the upload. Please try again.";
	}
} else {
	$message = null;
}

?>

<div style="width: 600px;text-align: justify;">
<h3>Tetrabyblos - Restore all settings and configurations, text reports and language translations</h3>
<p>In this section, you have the ability to restore your own interpretations texts, the settings that you defined for you and the language translation changes if they were saved to your computer in the "BACKUP ALL" option. Just upload the saved zip file, and automatically restore it by pressing <i>Upload FILE (something like myTetrabyblos-yyyymmddhhmmss.zip).</i></p><br>

<?php

if($message) echo "<div class='updated'><p>$message</p></div>"; ?>
<form enctype="multipart/form-data" method="POST" action="">
<label>Choose a zip file to upload: <input type="file" name="zip_file" /></label>
<br><br>
<input type="submit" name="submit" value="Upload FILE!" />
</form>
</div>

<?php
}
/* BACKUP ALL - SETTINGS, TEXTS AND LANGUAGE TRANSLATIONS */


// This is the secret key for API authentication. You configured it in the settings menu of the license manager plugin.
define('YOUR_SPECIAL_SECRET_KEY', '5e1a4d7926d127.50500044'); //Rename this constant name so it is specific to your plugin or theme.
// This is the URL where API query request will be sent to. This should be the URL of the site where you have installed the main license manager plugin. Get this value from the integration help page.
define('YOUR_LICENSE_SERVER_URL', 'http://www.tetrabyblos.com'); //Rename this constant name so it is specific to your plugin or theme.
// This is a value that will be recorded in the license manager data so you can identify licenses for this item/product.
define('YOUR_ITEM_REFERENCE', 'Tetrabyblos'); //Rename this constant name so it is specific to your plugin or theme.


function sample_license_management_page() {
    echo '<div class="wrap">';
    echo '<h2>Sample License Management</h2>';

    /*** License activate button was clicked ***/
    if (isset($_REQUEST['activate_license'])) {
        $license_key = $_REQUEST['sample_license_key'];


//######################Edit/Added by ParaTheme ########################################//
		if(is_multisite())
			{
				$domain = site_url();
			}
		else
			{
				$domain = $_SERVER['SERVER_NAME'];
			}

//######################Edit/Added by ParaTheme ########################################//


        // API query parameters
        $api_params = array(
            'slm_action' => 'slm_activate',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $domain, // Edit/Added by ParaTheme
            'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $response = wp_remote_get(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL), array('timeout' => 20, 'sslverify' => false));

        // Check for error in the response
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response
        
        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));
        
        // TODO - Do something with it.
        //var_dump($license_data);//uncomment it to look at the data
        
        if($license_data->result == 'success'){//Success was returned for the license activation
            
            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;
            
            //Save the license key in the options table
            update_option('sample_license_key', $license_key); 
        }
        else{
            //Show error to the user. Probably entered incorrect license key.
            
            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;
        }

    }
    /*** End of license activation ***/
    
    /*** License activate button was clicked ***/
    if (isset($_REQUEST['deactivate_license'])) {
        $license_key = $_REQUEST['sample_license_key'];

//######################Edit/Added by ParaTheme ########################################//

		if(is_multisite())
			{
				$domain = site_url();
			}
		else
			{
				$domain = $_SERVER['SERVER_NAME'];
			}
//######################Edit/Added by ParaTheme ########################################//


        // API query parameters
        $api_params = array(
            'slm_action' => 'slm_deactivate',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $domain, // Edit/Added by ParaTheme
            'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $response = wp_remote_get(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL), array('timeout' => 20, 'sslverify' => false));

        // Check for error in the response
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response
        
        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));
        
        // TODO - Do something with it.
        //var_dump($license_data);//uncomment it to look at the data
        
        if($license_data->result == 'success'){//Success was returned for the license activation
            
            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;
            
            //Remove the licensse key from the options table. It will need to be activated again.
            update_option('sample_license_key', '');
        }
        else{
            //Show error to the user. Probably entered incorrect license key.
            
            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;
        }
        
    }
    /*** End of sample license deactivation ***/
    
    ?>
    <p>Please enter the license key for this product to activate it. You were given a license key when you purchased this item.</p>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th style="width:100px;"><label for="sample_license_key">License Key</label></th>
                <td ><input class="regular-text" type="text" id="sample_license_key" name="sample_license_key"  value="<?php echo get_option('sample_license_key'); ?>" ></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="activate_license" value="Activate" class="button-primary" />
            <input type="submit" name="deactivate_license" value="Deactivate" class="button" />
        </p>
    </form>
    <?php
    
    echo '</div>';
}