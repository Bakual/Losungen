<?php
/**
* Herrnhuter Losungen XML J3.x
* @version    : 3.x_131128
* @package    : Joomla
* @license    : GNU General Public License version 2 or later; see LICENSE.txt
* @copyright  : Copyright (C) 2013 Dietmar Isenbart. All rights reserved.
* @website    : http://di-side.de
*
* @Description: Anzeige der Herrnhuter Tageslosung aus den Daten der 'Losungen Free xxxx.xml' (xxxx=aktuelles Jahr),
*               welches sich im Joomlaroot oder einem Verzeichnis darin, befinden muss.
*               Die 'Losungen Free xxxx.xml' gibt es kostenlos bei http://www.losungen.de/download/download.php
*               Anleitung/Infos/Updates zum Modul unter: http://di-side.de/
**/

defined('_JEXEC') or die;

    $version = "131128";
    $modulname = "mod_herrnhuter_losungen_xml_J3.x";

	$ausgabe 					= "";
	$arbeitsstring 				= "";
	$sonntag_txt 				= "";
	$gefunden 					= "";
	
	$document	= "";		
	$document	= JFactory::getDocument();
    $mosConfig_live_site 		= JURI::base(); // J!2.5
    $mosConfig_absolute_path 	= JPATH_SITE; // J!2.5

    $datumssuche        		= $today = date("Y") . "-" . $today = date("m") . "-" . $today = date("d") . "T00:00:00";
    $copyright_filename 		= $modulname . ".html";
    if (substr($mosConfig_live_site, -1, 1) == "/") {
        $livesitemodulepfad 	= $mosConfig_live_site . "modules/mod_herrnhuter_losungen_xml_J3.x/";
    }else{
         $livesitemodulepfad 	= $mosConfig_live_site . "/modules/mod_herrnhuter_losungen_xml_J3.x/";
    }
   
    $copyright_file     = $mosConfig_absolute_path ."/modules/mod_herrnhuter_losungen_xml_J3.x/" . $copyright_filename;

    $modid              = $module->id;

    $los_cache_file_del = $params->get('los_cache_file_del');
    $los_cache_filename = "los_" . $modid . "_cache";
    $los_cache_dir      = $mosConfig_absolute_path ."/cache/";
    $los_cache_file     = $los_cache_dir . $los_cache_filename;

    $losungspfad        = $params->get('losungspfad');
    $losungsverzeichnis = $mosConfig_absolute_path . "/" . $losungspfad . "Losungen Free " . $today = date("Y") . ".xml";
    $char_set           = $params->get('char_set');

    $datum_on           = $params->get('datum_on');
    $datumselect        = $params->get('datumselect');
    $zusatztext_on      = $params->get('zusatztext_on');
    $zusatztext         = $params->get('zusatztext');

    $sonntag_on         = $params->get('sonntag_on');

    $losung_txt_on      = $params->get('losung_txt_on');
    $losung_txt_vers_on = $params->get('losung_txt_vers_on');
    $lehr_txt_on        = $params->get('lehr_txt_on');
    $lehr_txt_vers_on   = $params->get('lehr_txt_vers_on');

    $popup_bib_on     = $params->get('popup_bib_on');
    $popup_bib_width  = $params->get('popup_bib_width');
    $popup_bib_height = $params->get('popup_bib_height');
    if($popup_bib_on == "2") {
        $popup_bib = " rel=\"{handler: 'iframe', size: {x: $popup_bib_width, y: $popup_bib_height}, onClose: function() {}}\"";
        }else{
            $popup_bib = "";
    }

    $bibel_on           = $params->get('bibel_on');
    $bibel_version      = $params->get('bibel_version');

    $infolink_pos       = $params->get('infolink_pos');
    $links_on           = $params->get('links_on');
    $link1_url          = $params->get('link1_url');
    $link1_titel        = $params->get('link1_titel');
    $link2_url          = $params->get('link2_url');
    $link2_titel        = $params->get('link2_titel');
    $links_line         = $params->get('links_line');

    $modal_rel_link_on    = $params->get('modal_rel_link_on');
    $modal_rel_link_width = $params->get('modal_rel_link_width');
    $modal_rel_link_height= $params->get('modal_rel_link_height');
    if($modal_rel_link_on == "1") {
        $modal_rel_link = " rel=\"{handler: 'iframe', size: {x: $modal_rel_link_width, y: $modal_rel_link_height}, onClose: function() {}}\"";
        }else{
            $modal_rel_link = "";
    }

    $pfeil_on           = $params->get('pfeil_on');
    $pfeil_url          = $params->get('pfeil_url');
    $pfeil_width        = $params->get('pfeil_width');
    if(strtoupper($pfeil_width) == "X") {
        $pfeil_width = "";
        }else{
            $pfeil_width = "width=\"$pfeil_width\"";
    }

    $pfeil_height  = $params->get('pfeil_height');
    if(strtoupper($pfeil_height) == "X") {
        $pfeil_height = "";
        }else{
            $pfeil_height = "height=\"$pfeil_height\"";
    }

    $pfeil_hspace       = $params->get('pfeil_hspace');
    $pfeil_vspace       = $params->get('pfeil_vspace');
    $pfeil_align        = $params->get('pfeil_align');
    if($pfeil_align == "standard") {
        $pfeil_align = "";
        }else{
            $pfeil_align = "align=\"$pfeil_align\"";
    }

    $css_use    = $params->get('css_use');
    $losung_css = $params->get('losung_css');
    $losung_css = str_replace(".los_" . $modid . "_", ".los_", $losung_css);
    $losung_css = str_replace(".los_", ".los_" . $modid . "_", $losung_css);
	$csshead 	= "";
	
    $copyright_file_neu = $params->get('copyright_file_neu');

    $copyright_width    = $params->get('copyright_width');
    $copyright_height   = $params->get('copyright_height');

    $modal_rel_info_on    = $params->get('modal_rel_info_on');
    if($modal_rel_info_on == "1") {
        $modal_rel_info = " rel=\"{handler: 'iframe', size: {x: $copyright_width, y: $copyright_height}, onClose: function() {}}\"";
        }else{
            $modal_rel_info = "";
    }

    $templatecss_on     = $params->get('templatecss_on');
    $copyright_css      = $params->get('copyright_css');
    $copyright_css = str_replace("<br />", "\r\n", $copyright_css);
    $copyright_css = str_replace("<br>", "\r\n", $copyright_css);

    if ($char_set == "UTF-8") {
       $link1_titel = utf8_decode ($link1_titel);
       $link2_titel = utf8_decode ($link2_titel);
       $zusatztext  = utf8_decode ($zusatztext);
    }
	if($modal_rel_link_on == "1" or $modal_rel_info_on == "1" or $popup_bib_on == "2") {
		JHTML::_( 'behavior.modal' );
	}
	
   // *****Cachefile löschen!
    if ($los_cache_file_del == "1" or $copyright_file_neu == 1) {
        // gesamten Joomlacache löschen bis auf index.html
        $handle = opendir($los_cache_dir);
        while ($file = readdir ($handle)) {
            if($file != "." && $file != "..") {
                if(is_dir($los_cache_dir."/".$file)) {
                } else {
                    // kompletter Pfad
                    $compl = $los_cache_dir."/".$file;
                    if(($file != "index.html")) { unlink($compl); }
                }
            }
        }
        closedir($handle);
    }

    // ***** Cachefile nutzen
    if ((file_exists($los_cache_file)) and date("Ymd", filemtime( $los_cache_file )) == date("Ymd")) {
        $temp = filemtime( $los_cache_file ) ;
        $date_file = date("Ymd", $temp);
        $datenow = date("Ymd");
        //ist Losungcache von heute, dann ausgeben
        if ($date_file == $datenow) {
            $handle = fopen($los_cache_file,"r");
            $ausgabe = fread($handle,filesize ($los_cache_file));
            fclose($handle);
            if ($css_use == "0") {
				$csshead = "\n<!-- Begin CSS-Daten $modulname $version * (C) 2013 by Dietmar Isenbart * Ichthys-Soft - Freeware * http://di-side.de -->\n<style type=\"text/css\">\n" . $losung_css . "\n</style>\n<!-- End CSS-Daten $modulname $version -->\n";
				$document->addCustomTag($csshead);
			}
            echo $ausgabe;
        }

    // kein Cachefile nutzen bzw. neu erstellen
    }else{

        // Prüfung XML-Losung vorhanden
        if (file_exists($losungsverzeichnis)) {
            $OpenFile = fopen($losungsverzeichnis, "r");

            // wenn XML-Losung vorhanden Ausgabe daraus erstellen
            if ($OpenFile != false) {
                $arbeitsstring .= fread($OpenFile, filesize ($losungsverzeichnis));
                fclose($OpenFile);

                // Steuerzeichen löschen
                for($i=0; $i<15; $i++) {
                    $arbeitsstring = str_replace (chr($i), "", $arbeitsstring);
                }
                    $suche= '/' . $datumssuche . '(.*)<\/Losungen>/U';
                    preg_match($suche, $arbeitsstring, $gefunden);
                    $arbeitsstring = utf8_decode ( $gefunden[1] );
                    // IE Fehler beseitigen 
                    $arbeitsstring = str_replace('&apos;', '\'', $arbeitsstring);

                // Datum anzeigen
                if ($datum_on == 1) {
                    $taglang = array("Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag");
                    $tagkurz = array("So","Mo","Di","Mi","Do","Fr","Sa");
                    $Monatlang = array("","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
                    $MonatlangOE1 = array("","Jänner","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
                    $MonatlangOE2 = array("","Jänner","Feber","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");

                    switch ($datumselect) {

                    case 24:
                         //*  Zusatztext statt Datum verwenden
                         $datum = "";
                         break;
                    case 0:
                         //*  Dienstag, 1. Januar 2013
                         $datum = $taglang[date("w")] . ", " . date("d"). ". " . $Monatlang[date("n")] . " " . date("Y");
                         break;
                    case 1:
                         //*  Dienstag, 1. Januar 13
                         $datum = $taglang[date("w")] . ", " . date("d") . ". " . $Monatlang[date("n")] . " " . date("y");
                         break;
                    case 2:
                         //*  Di 1. Januar 2013
                         $datum = $tagkurz[date("w")] . " " . date("d"). ". " . $Monatlang[date("n")] . " " . date("Y");
                         break;
                    case 3:
                         //*  Di 1. Januar 13
                         $datum = $tagkurz[date("w")] . " " . date("d"). ". " . $Monatlang[date("n")] . " " . date("y");
                         break;
                    case 4:
                         //*  Dienstag, 1.01.2013
                         $datum = $taglang[date("w")] . ", " . date("d") . "." . date("m") . "." . date("Y");
                         break;
                    case 5:
                         //*  Dienstag, 1.01.13
                         $datum = $taglang[date("w")] . ", " . date("d") . "." . date("m") . "." . date("y");
                         break;
                    case 6:
                         //*  Di 1.01.2013
                         $datum = $tagkurz[date("w")] . " " . date("d") . "." . date("m") . "." . date("Y");
                         break;
                    case 7:
                         //*  Di 1.01.13
                         $datum = $tagkurz[date("w")] . " " . date("d") . "." . date("m") . "." . date("y");
                         break;
                    case 8:
                         //*  1. Januar 2013
                         $datum = date("d"). ". " . $Monatlang[date("n")] . " " . date("Y");
                         break;
                    case 9:
                         //*  1. Januar 13
                         $datum = $tagkurz[date("w")] . " " . date("d"). ". " . $Monatlang[date("n")] . " " . date("Y");
                         break;
                    case 10:
                         //*  1.01.2013
                         $datum = date("d") . "." . date("m") . "." . date("Y");
                         break;
                    case 11:
                         //*  1.01.13
                         $datum = date("d") . "." . date("m") . "." . date("y");
                         break;
                    case 12:
                         //*  Dienstag, 1. Jänner(Februar) 2013
                         $datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("Y");
                         break;
                    case 13:
                         //*  Dienstag, 1. Jänner(Februar) 13
                         $datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("y");
                         break;
                    case 14:
                         //*  Di 1. Jänner(Februar) 2013
                         $datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("Y");
                         break;
                    case 15:
                         //*  Di 1. Jänner(Februar) 13
                         $datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("y");
                         break;
                    case 16:
                         //*  1. Jänner(Februar) 2013
                         $datum = date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("Y");
                         break;
                    case 17:
                         //*  1. Jänner(Februar) 13
                         $datum = date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("y");
                         break;
                    case 18:
                         //*  Dienstag, 1. Jänner(Feber) 2013
                         $datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("Y");
                         break;
                    case 19:
                         //*  Dienstag, 1. Jänner(Feber) 13
                         $datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("y");
                         break;
                    case 20:
                         //*  Di 1. Jänner(Feber) 2013
                         $datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("Y");
                         break;
                    case 21:
                         //*  Di 1. Jänner(Feber) 13
                         $datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("y");
                         break;
                    case 22:
                         //*  1. Jänner(Feber) 2013
                         $datum = date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("Y");
                         break;
                    case 23:
                         //*  1. Jänner(Feber) 13
                         $datum = date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("y");
                         break;
                    }

                    // Zusatztext vor Datum?
                    if ($zusatztext_on >= 1) {
                         if ($zusatztext_on == 1) {
                              $datum = "\n<div class=\"los_" . $module->id . "_datum\">" . $zusatztext . " " . $datum . "</div>\n";
                         }else{
                              $datum = "\n<div class=\"los_" . $module->id . "_datum\">" . $datum . " " . $zusatztext . "</div>\n";
                         } 
                    }else{
                         $datum = "\n<div class=\"los_" . $module->id . "_datum\">" . $datum . "</div>\n";
                    }
                }

                // Sonntagtext suchen und Formate zuweisen </wtag>
                preg_match('/<Wtag>(.*)<\/Wtag>/U', $arbeitsstring, $gefunden);
                if ($sonntag_on >= 1 and $gefunden[1] == "Sonntag") {				
                preg_match('/<Sonntag>(.*)<\/Sonntag>/U', $arbeitsstring, $gefunden);
                     $sonntag_txt = "<div class=\"los_" . $modid . "_sonntagtxt\">" . $gefunden[1] . "</div>\n";
                }

                // Losungstext suchen und Formate zuweisen
                preg_match('/<Losungstext>(.*)<\/Losungstext>/U', $arbeitsstring, $gefunden);
                $losung_txt = str_replace(':/', ':<***>', $gefunden[1]);
                $losung_txt = str_replace('/', '<i>', $losung_txt);
                $losung_txt = str_replace(':<***>', '</i>:', $losung_txt);
                $losung_txt = str_replace('#', '"', $losung_txt);
                $losung_txt = "<div class=\"los_" . $modid . "_losungtxt\">" . $losung_txt . "</div>\n";

                // Losungstextlink suchen und Formate zuweisen
                preg_match('/<Losungsvers>(.*)<\/Losungsvers>/U', $arbeitsstring, $gefunden);
                $losung_txt_vers = $gefunden[1];

                // Lehrtext suchen und Formate zuweisen
                preg_match('/<Lehrtext>(.*)<\/Lehrtext>/U', $arbeitsstring, $gefunden);
                $lehr_txt = str_replace(':/', ':<***>', $gefunden[1]);
                $lehr_txt = str_replace('/', '<i>', $lehr_txt);
                $lehr_txt = str_replace(':<***>', '</i>:', $lehr_txt);
                $lehr_txt = str_replace('#', '"', $lehr_txt);
                $lehr_txt = "<div class=\"los_" . $modid . "_lehrtxt\">" . $lehr_txt . "</div>\n";

                // Lehrtextlink suchen und Formate zuweisen
                preg_match('/<Lehrtextvers>(.*)<\/Lehrtextvers>/U', $arbeitsstring, $gefunden);
                $lehr_txt_vers = $gefunden[1];
			
                if ($bibel_on == 1) {
					if($popup_bib_on == "0") { // neues Fenster
						$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster öffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_losungtxt_link\">$losung_txt_vers</a></div>\n";
					}
					if($popup_bib_on == "1") { // PopUp
						$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster öffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_losungtxt_link\" onclick=\"Popup=window.open('http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$popup_bib_width,height=$popup_bib_height,left='+(screen.availWidth/2-($popup_bib_width/2))+',top='+(screen.availHeight/2-($popup_bib_height/2))+'');return false;\">$losung_txt_vers</a></div>\n";
					}
					if($popup_bib_on == "2") { // Lightbox
						$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster öffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers\" class=\"modal los_" . $modid . "_losungtxt_link\" target=\"_blank\" $popup_bib>$losung_txt_vers</a></div>\n";  
					}

                }else{
                    $losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\">$losung_txt_vers</div>\n";
                }

                if ($bibel_on == 1) {
					if($popup_bib_on == "0") { // neues Fenster
						$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster öffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_lehrtxt_link\">$lehr_txt_vers</a></div>\n";
					}
					if($popup_bib_on == "1") { // PopUp
						$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster öffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_lehrtxt_link\" onclick=\"Popup=window.open('http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$popup_bib_width,height=$popup_bib_height,left='+(screen.availWidth/2-($popup_bib_width/2))+',top='+(screen.availHeight/2-($popup_bib_height/2))+'');return false;\">$lehr_txt_vers</a></div>\n";
					}
					if($popup_bib_on == "2") { // Lightbox
						$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster öffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers\" class=\"modal los_" . $modid . "_lehrtxt_link\" target=\"_blank\"$popup_bib>$lehr_txt_vers</a></div>\n";
					}

                }else{
                    $lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\">$lehr_txt_vers</div>\n";
                }

                // Sonntag über Datum anzeigen
                if ($sonntag_on == 1) {
                    $ausgabe .= $sonntag_txt;
                }

                // Datum anzeigen
                if ($datum_on == 1) {
                   $ausgabe .= $datum;
                }

                // Sonntag unter Datum anzeigen
                if ($sonntag_on == 2) {
                    $ausgabe .= $sonntag_txt;
                }

                // Losungtext anzeigen
                if ($losung_txt_on == 1) {
                    $ausgabe .= $losung_txt;
                    if ($losung_txt_vers_on == 1) {
                        $ausgabe .= $losung_txt_vers;
                    }
                }

                // Lehrtext anzeigen
                if ($lehr_txt_on == 1) {
                    $ausgabe .= $lehr_txt;
                    if ($lehr_txt_vers_on == 1) {
                        $ausgabe .= $lehr_txt_vers;
                    }
                }

				if ($infolink_pos == 0) {
					$style_info = " style=\"margin-top: 8px;\" ";
					$style_ext = "";
					}else{
					$style_info = "";
					$style_ext = " style=\"margin-top: 8px;\" ";
				}
				
				
                // Grafik anzeigen
                if ($pfeil_on == 1) {

					
					if ($infolink_pos == 0) {
						// Infolink ausgeben
						if($modal_rel_info_on == "1") {
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"Copyright-Informationen\" class=\"modal los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" target=\"_blank\"$modal_rel_info>Info Herrnhuter Losungen</a></div>\n";
						}else{
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"Copyright-Informationen\" class=\"los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" onclick=\"Popup=window.open('$livesitemodulepfad" . "$copyright_filename','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$copyright_width,height=$copyright_height,left='+(screen.availWidth/2-($copyright_width/2))+',top='+(screen.availHeight/2-($copyright_height/2))+'');return false;\">Info Herrnhuter Losungen</a></div>\n";
						}
                    }

                    // extene Links anzeigen?
                    // 1. Link anzeigen
                    if ($links_on >= 1) {
						if($modal_rel_link_on == "1") {
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"" . $style_ext . "><img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link1_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}else{	
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"" . $style_ext . "><img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link1_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}

                        // 2. Link anzeigen
                        if ($links_on == 2) {
                            // untereinander
                            if ($links_line == 1) {
                                $ausgabe .= "<br>\n";
                            }
                            // nebeneinander 
								if ($modal_rel_link_on >= 1) {
									$ausgabe .= "<img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link2_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
								}else{
									$ausgabe .= "<img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link2_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
								}
							}
                    $ausgabe .= "</div>\n";
                    }
					if ($infolink_pos == 1) {
						// Infolink ausgeben
						if($modal_rel_info_on == "1") {
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"Copyright-Informationen\" class=\"modal los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" target=\"_blank\"$modal_rel_info>Info Herrnhuter Losungen</a></div>\n";
						}else{
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><img src=\"" . $mosConfig_live_site . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"Copyright-Informationen\" class=\"los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" onclick=\"Popup=window.open('$livesitemodulepfad" . "$copyright_filename','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$copyright_width,height=$copyright_height,left='+(screen.availWidth/2-($copyright_width/2))+',top='+(screen.availHeight/2-($copyright_height/2))+'');return false;\">Info Herrnhuter Losungen</a></div>\n";
						}
                    }
                }

                //Grafik nicht anzeigen
                if ($pfeil_on == 0) {

					if ($infolink_pos == 0) {
						// Infolink ausgeben
						if($modal_rel_info_on == "1") {
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><a title=\"Copyright-Informationen\" class=\"modal los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" target=\"_blank\"$modal_rel_info>Info Herrnhuter Losungen</a></div>\n";
						}else{
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><a title=\"Copyright-Informationen\" class=\"los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" onclick=\"Popup=window.open('$livesitemodulepfad" . "$copyright_filename','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$copyright_width,height=$copyright_height,left='+(screen.availWidth/2-($copyright_width/2))+',top='+(screen.availHeight/2-($copyright_height/2))+'');return false;\">Info Herrnhuter Losungen</a></div>\n";
						}
                    }

                    // extene Links anzeigen?
                    // 1. Link anzeigen
                    if ($links_on >= 1) {
						if ($modal_rel_link_on >= 1) {
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"" . $style_ext . "><a title=\"" . $link1_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}else{
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"" . $style_ext . "><a title=\"" . $link1_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}
                        // 2. Link anzeigen
                        if ($links_on == 2) {
                            // untereinander
                            if ($links_line == 1) {
                                $ausgabe .= "<br>\n";
                            // nebeneinander
                            }else{
                                $ausgabe .= "&nbsp;&nbsp;&nbsp;";
                            }
									if ($modal_rel_link_on >= 1) {
										$ausgabe .= "<a title=\"" . $link2_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
									}else{
										$ausgabe .= "<a title=\"" . $link2_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
									}
								}
                        $ausgabe .= "</div>\n";
                    }
					if ($infolink_pos == 1) {
						// Infolink ausgeben
						if($modal_rel_info_on == "1") {
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><a title=\"Copyright-Informationen\" class=\"modal los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" target=\"_blank\"$modal_rel_info>Info Herrnhuter Losungen</a></div>\n";
						}else{
							$ausgabe .= "<div class=\"los_" . $modid . "_info_link\"" . $style_info . "><a title=\"Copyright-Informationen\" class=\"los_" . $modid . "_info_link\" href=\"$livesitemodulepfad" . $copyright_filename . "\" onclick=\"Popup=window.open('$livesitemodulepfad" . "$copyright_filename','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$copyright_width,height=$copyright_height,left='+(screen.availWidth/2-($copyright_width/2))+',top='+(screen.availHeight/2-($copyright_height/2))+'');return false;\">Info Herrnhuter Losungen</a></div>\n";
						}
                    }
                }
            // CSS-Head
            if ($css_use == "0") {
				$csshead = "\n<!-- Begin CSS-Daten $modulname $version * (C) 2013 by Dietmar Isenbart * Ichthys-Soft - Freeware * http://di-side.de -->\n<style type=\"text/css\">\n" . $losung_css . "\n</style>\n<!-- End CSS-Daten $modulname $version -->\n";
				$document->addCustomTag($csshead);
				$ausgabe = "\n<!-- Begin $modulname $version * (C) 2013 by Dietmar Isenbart * Ichthys-Soft - Freeware * http://di-side.de -->\n<div class=\"los_" . $modid . "_content\">\n" . $ausgabe .= "</div>\n";
			}
            // CSS-Body
            if ($css_use == "1") {
				$ausgabe = "\n<!-- Begin $modulname $version * (C) 2013 by Dietmar Isenbart * Ichthys-Soft - Freeware * http://di-side.de -->\n<style type='text/css'>\n" . $losung_css . "</style>\n" . "<div class=\"los_" . $modid . "_content\">\n" . $ausgabe .= "</div>\n";
            }
            // CSS-Nein
            if ($css_use == "2") {
				$ausgabe = "\n<!-- Begin $modulname $version * (C) 2013 by Dietmar Isenbart * Ichthys-Soft - Freeware * http://di-side.de -->\n<div class=\"los_" . $modid . "_content\">\n" . $ausgabe .= "</div>\n";
            }
            }

            if ($char_set == "UTF-8") {
                $ausgabe = utf8_encode ( $ausgabe );
                echo $ausgabe;
            }else{
                echo $ausgabe;
            }

            // Losungscache erstellen
			$handle = fopen($los_cache_file,"w");
			if (!fwrite($handle, $ausgabe)) {
				print "Kann die Datei $los_cache_filename nicht schreiben";
			}
			fclose($handle);
			echo "<small>Cachefile erstellt<br></small>\n";

        // wenn /losung/heutigelosung nicht vorhanden Fehler ausgeben
        }else{
            $ausgabe = "Es ist keine aktuelle Losung vorhanden, bitte informieren Sie den Webmaster.";
            echo $ausgabe;
        }
    }

    // ***** copyrightfile löschen?
    if($copyright_file_neu == 1) {
        // copyrightfile löschen!
        if (file_exists($copyright_file)) {
            unlink($copyright_file);
        }
    }

    if ($los_cache_file_del == "1" or $copyright_file_neu == 1) {

$dummy = "{\"los_cache_file_del\":\""        .  $params->set('los_cache_file_del',0) . "\"," .
         "\"losungspfad\":\""               .  $params->get('losungspfad') . "\"," .
         "\"char_set\":\""                  .  $params->get('char_set') . "\"," .
         "\"datum_on\":\""                  .  $params->get('datum_on') . "\"," .
         "\"datumselect\":\""               .  $params->get('datumselect') . "\"," .
         "\"zusatztext_on\":\""             .  $params->get('zusatztext_on') . "\"," .
         "\"zusatztext\":\""                .  $params->get('zusatztext') . "\"," .
         "\"sonntag_on\":\""                .  $params->get('sonntag_on') . "\"," .
         "\"losung_txt_on\":\""             .  $params->get('losung_txt_on') . "\"," .
         "\"losung_txt_vers_on\":\""        .  $params->get('losung_txt_vers_on') . "\"," .
         "\"lehr_txt_on\":\""               .  $params->get('lehr_txt_on') . "\"," .
         "\"lehr_txt_vers_on\":\""          .  $params->get('lehr_txt_vers_on') . "\"," .
         "\"bibel_on\":\""                  .  $params->get('bibel_on') . "\"," .
         "\"bibel_version\":\""             .  $params->get('bibel_version') . "\"," .
         "\"popup_bib_on\":\""              .  $params->get('popup_bib_on') . "\"," .
         "\"popup_bib_width\":\""           .  $params->get('popup_bib_width') . "\"," .
         "\"popup_bib_height\":\""          .  $params->get('popup_bib_height') . "\"," .
         "\"infolink_pos\":\""              .  $params->get('infolink_pos') . "\"," .
         "\"links_on\":\""                  .  $params->get('links_on') . "\"," .
         "\"link1_url\":\""                 .  $params->get('link1_url') . "\"," .
         "\"link1_titel\":\""               .  $params->get('link1_titel') . "\"," .
         "\"link2_url\":\""                 .  $params->get('link2_url') . "\"," .
         "\"link2_titel\":\""               .  $params->get('link2_titel') . "\"," .
         "\"links_line\":\""                .  $params->get('links_line') . "\"," .
         "\"modal_rel_link_on\":\""         .  $params->get('modal_rel_link_on') . "\"," .
         "\"modal_rel_link_width\":\""      .  $params->get('modal_rel_link_width') . "\"," .
         "\"modal_rel_link_height\":\""     .  $params->get('modal_rel_link_height') . "\"," .
         "\"pfeil_on\":\""                  .  $params->get('pfeil_on') . "\"," .
         "\"pfeil_url\":\""                 .  $params->get('pfeil_url') . "\"," .
         "\"pfeil_width\":\""               .  $params->get('pfeil_width') . "\"," .
         "\"pfeil_height\":\""              .  $params->get('pfeil_height') . "\"," .
         "\"pfeil_hspace\":\""              .  $params->get('pfeil_hspace') . "\"," .
         "\"pfeil_vspace\":\""              .  $params->get('pfeil_vspace') . "\"," .
         "\"pfeil_align\":\""               .  $params->get('pfeil_align') . "\"," .
         "\"css_use\":\""                   .  $params->get('css_use') . "\"," .
         "\"losung_css\":\""                .  $params->set('losung_css',$losung_css) . "\"," .
         "\"copyright_file_neu\":\""        .  $params->set('copyright_file_neu',0) . "\"," .
         "\"modal_rel_info_on\":\""         .  $params->get('modal_rel_info_on') . "\"," .
         "\"copyright_width\":\""           .  $params->get('copyright_width') . "\"," .
         "\"copyright_height\":\""          .  $params->get('copyright_height') . "\"," .
         "\"templatecss_on\":\""            .  $params->get('templatecss_on') . "\"," .
         "\"copyright_css\":\""             .  str_replace("\n", "\r", $params->get('copyright_css')) . "\"}";

        //$dummy = strip_tags($dummy,'\r\n');

        $db = & JFactory::getDBO(); // J!2.5
        $query = "UPDATE #__modules SET params='$dummy' WHERE (id=$modid)";
        $db->setQuery($query);
        $db->query();

        echo "<small>Parameter aktualisiert<br></small>\n";

    }

    // ***** Erstellung / Prüfung der mod_herrnhuter_losungen_xml_J3.x.html
    if (file_exists($copyright_file)) {
        $infohtml = "";
    }else{
         $db =& JFactory::getDBO(); // J!2.5

         $sql = 'SELECT template'
         . ' FROM #__templates_menu'
         . ' WHERE client_id = 0'
         . ' AND menuid = 0';
         $db->setQuery( $sql );
         $cur_template = $db->loadResult();


        $infohtml = "<html>\n" .
         "  <head>\n" .
         "    <meta name=\"robots\" content=\"index\">\n" .
         "    <meta name=\"keywords\" content=\"Losung, Herrnhuter-Losung, Tageslosung, Joomla, Mambo, Joomlamodul, $modulname, Ichthys-Soft - Freeware, di-side.de\">\n" .
         "    <meta http-equiv=\"content-type\" content=\"text/html;charset=iso-8859-1\">\n" .
         "    <title>Copyright-Hinweise $modulname $version</title>\n" .
         "    <meta name=\"author\" content=\"Dietmar Isenbart * Ichthys-Soft - Freeware * http://di-side.de *\">\n" .
         "    <meta name=\"description\" content=\"Copyright-Hinweise zu den Losungen der Evangelischen Br&uuml;der-Unit&auml;t Herrnhut und dem mod_herrnhuter_losungen_xml_J3.x\" >\n";

    if($templatecss_on == 1) {
        $infohtml .= "\n    <link rel=\"stylesheet\" href=\"$mosConfig_live_site" . "templates/$cur_template/css/template.css\" type=\"text/css\"/>";
    }
        $infohtml .= "\n    <style type=\"text/css\" media=\"screen\"><!--\n " . utf8_decode ($copyright_css) . " \n--></style>\n" .
         "  </head>\n" .
         "  <body>\n" .
         "    <div class=\"cr_inner\">\n" .
         "      <div class=\"cr_headline\">Informationen zu dieser Internet-Losungsausgabe</div>\n" .
         "      <div class=\"cr_bodyline\">Die Losungen der Herrnhuter Br&uuml;dergemeine</div>\n" .
         "      <div class=\"cr_content\">Die auf dieser Website dargestellten Losungsdaten sind urheberrechtlich gesch&uuml;tzt und wurden kostenlos von der <a href=\"http://ebu.de/\" target=\"_blank\" title=\"Die Homepage der Herrnhuter Br&uuml;der-Unit&auml;t besuchen\">&copy; Evangelischen Br&uuml;der-Unit&auml;t - Herrnhuter Br&uuml;dergemeinde</a> zur Verf&uuml;gung gestellt.\n" .
         "        <br><br>\n" .
         "        Weitere Informationen und Freewareprogramme sind hier zu finden: <a href=\"http://www.losungen.de\" target=\"_blank\" title=\"Zur Herrnhuter Losungs-Seite\">www.losungen.de</a>.\n" .
         "        <br><br>\n" .
         "        Alle Bibeltexte aus der Luther-Bibel 1984/99 unterliegen dem Copyright der Deutschen Bibelgesellschaft, Stuttgart.\n" .
         "      </div>\n" .
         "      <div class=\"cr_bodyline\">Joomla 2.5 - 3.x Modul &#39;$modulname&#39;  Version: $version</div>\n" .
         "      <div class=\"cr_content\">Das auf dieser Homepage verwendete <strong>$modulname</strong>, zur Anzeige der Losungsdaten auf einer beliebigen Modulposition, innerhalb des CMS Joomla V2.5 - V3.x, wird auf <a href=\"http://di-side.de\" target=\"_blank\" title=\"Kostenlose christliche Joomla-Erweiterungen\">Ichthys-Soft - Freeware</a> kostenlos zum Download angeboten.<br />\n" .
         "        <br />\n" .
         "        Eine Anleitung mit Installationshinweisen ist dort ebenfalls zu finden.\n" .
         "        <br />&copy; 2013 by Dietmar Isenbart\n" .
         "      </div>\n" .
         "  </body>\n" .
         "</html>\n";

        $handle = fopen($copyright_file,"w");
        if (!fwrite($handle, $infohtml)) {
             print "Kann die Datei $copyright_filename nicht speichern";
        }
        fclose($handle);
        echo "<small>Copyrightfile aktualisiert<br></small>\n";
    }
    echo "<!-- End $modulname $version -->\n";
?>
