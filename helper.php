<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

/**
 * Helper class for Herrnhuter Losungen module
 *
 * @since  1.0
 */
abstract class ModHerrnhuterlosungenHelper
{
	/**
	 * Get Losung from XML
	 *
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public static function getLosung($params)
	{
		$date = JFactory::getDate();
		$file = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen Free ' . $date->year . '.xml';

		if (file_exists($file))
		{
			if ($xml = simplexml_load_file($file))
			{
				$index  = $date->dayofyear;
				$losung = (array) $xml->Losungen[(int)$index];
				unset ($losung['Sonntag']);

				return $losung;
				$suche = '/' . $date . '(.*)<\/Losungen>/U';
				preg_match($suche, $arbeitsstring, $gefunden);
				$arbeitsstring = utf8_decode($gefunden[1]);
				// IE Fehler beseitigen
				$arbeitsstring = str_replace('&apos;', '\'', $arbeitsstring);

				// Datum anzeigen
				if ($datum_on == 1)
				{
					$taglang      = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
					$tagkurz      = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");
					$Monatlang    = array("", "Januar", "Februar", "M�rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
					$MonatlangOE1 = array("", "J�nner", "Februar", "M�rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
					$MonatlangOE2 = array("", "J�nner", "Feber", "M�rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");

					switch ($datumselect)
					{

						case 24:
							//*  Zusatztext statt Datum verwenden
							$datum = "";
							break;
						case 0:
							//*  Dienstag, 1. Januar 2013
							$datum = $taglang[date("w")] . ", " . date("d") . ". " . $Monatlang[date("n")] . " " . date("Y");
							break;
						case 1:
							//*  Dienstag, 1. Januar 13
							$datum = $taglang[date("w")] . ", " . date("d") . ". " . $Monatlang[date("n")] . " " . date("y");
							break;
						case 2:
							//*  Di 1. Januar 2013
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $Monatlang[date("n")] . " " . date("Y");
							break;
						case 3:
							//*  Di 1. Januar 13
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $Monatlang[date("n")] . " " . date("y");
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
							$datum = date("d") . ". " . $Monatlang[date("n")] . " " . date("Y");
							break;
						case 9:
							//*  1. Januar 13
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $Monatlang[date("n")] . " " . date("Y");
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
							//*  Dienstag, 1. J�nner(Februar) 2013
							$datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("Y");
							break;
						case 13:
							//*  Dienstag, 1. J�nner(Februar) 13
							$datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("y");
							break;
						case 14:
							//*  Di 1. J�nner(Februar) 2013
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("Y");
							break;
						case 15:
							//*  Di 1. J�nner(Februar) 13
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("y");
							break;
						case 16:
							//*  1. J�nner(Februar) 2013
							$datum = date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("Y");
							break;
						case 17:
							//*  1. J�nner(Februar) 13
							$datum = date("d") . ". " . $MonatlangOE1[date("n")] . " " . date("y");
							break;
						case 18:
							//*  Dienstag, 1. J�nner(Feber) 2013
							$datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("Y");
							break;
						case 19:
							//*  Dienstag, 1. J�nner(Feber) 13
							$datum = $taglang[date("w")] . ", " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("y");
							break;
						case 20:
							//*  Di 1. J�nner(Feber) 2013
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("Y");
							break;
						case 21:
							//*  Di 1. J�nner(Feber) 13
							$datum = $tagkurz[date("w")] . " " . date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("y");
							break;
						case 22:
							//*  1. J�nner(Feber) 2013
							$datum = date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("Y");
							break;
						case 23:
							//*  1. J�nner(Feber) 13
							$datum = date("d") . ". " . $MonatlangOE2[date("n")] . " " . date("y");
							break;
					}

					// Zusatztext vor Datum?
					if ($zusatztext_on >= 1)
					{
						if ($zusatztext_on == 1)
						{
							$datum = "\n<div class=\"los_" . $module->id . "_datum\">" . $zusatztext . " " . $datum . "</div>\n";
						}
						else
						{
							$datum = "\n<div class=\"los_" . $module->id . "_datum\">" . $datum . " " . $zusatztext . "</div>\n";
						}
					}
					else
					{
						$datum = "\n<div class=\"los_" . $module->id . "_datum\">" . $datum . "</div>\n";
					}
				}

				// Sonntagtext suchen und Formate zuweisen </wtag>
				preg_match('/<Wtag>(.*)<\/Wtag>/U', $arbeitsstring, $gefunden);
				if ($sonntag_on >= 1 and $gefunden[1] == "Sonntag")
				{
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

				if ($bibel_on == 1)
				{
					if ($popup_bib_on == "0")
					{ // neues Fenster
						$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster �ffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_losungtxt_link\">$losung_txt_vers</a></div>\n";
					}
					if ($popup_bib_on == "1")
					{ // PopUp
						$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster �ffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_losungtxt_link\" onclick=\"Popup=window.open('http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$popup_bib_width,height=$popup_bib_height,left='+(screen.availWidth/2-($popup_bib_width/2))+',top='+(screen.availHeight/2-($popup_bib_height/2))+'');return false;\">$losung_txt_vers</a></div>\n";
					}
					if ($popup_bib_on == "2")
					{ // Lightbox
						$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster �ffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$losung_txt_vers\" class=\"modal los_" . $modid . "_losungtxt_link\" target=\"_blank\" $popup_bib>$losung_txt_vers</a></div>\n";
					}

				}
				else
				{
					$losung_txt_vers = "<div class=\"los_" . $modid . "_losungtxt_link\">$losung_txt_vers</div>\n";
				}

				if ($bibel_on == 1)
				{
					if ($popup_bib_on == "0")
					{ // neues Fenster
						$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster �ffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_lehrtxt_link\">$lehr_txt_vers</a></div>\n";
					}
					if ($popup_bib_on == "1")
					{ // PopUp
						$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster �ffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers\" target=\"_blank\" class=\"los_" . $modid . "_lehrtxt_link\" onclick=\"Popup=window.open('http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=$popup_bib_width,height=$popup_bib_height,left='+(screen.availWidth/2-($popup_bib_width/2))+',top='+(screen.availHeight/2-($popup_bib_height/2))+'');return false;\">$lehr_txt_vers</a></div>\n";
					}
					if ($popup_bib_on == "2")
					{ // Lightbox
						$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\"><a title=\"Bibelabschnitt im neuem Fenster �ffnen\" href=\"http://www.bibleserver.com/index.php?language=1&s=1#/text/$bibel_version/$lehr_txt_vers\" class=\"modal los_" . $modid . "_lehrtxt_link\" target=\"_blank\"$popup_bib>$lehr_txt_vers</a></div>\n";
					}

				}
				else
				{
					$lehr_txt_vers = "<div class=\"los_" . $modid . "_lehrtxt_link\">$lehr_txt_vers</div>\n";
				}

				// Sonntag �ber Datum anzeigen
				if ($sonntag_on == 1)
				{
					$ausgabe .= $sonntag_txt;
				}

				// Datum anzeigen
				if ($datum_on == 1)
				{
					$ausgabe .= $datum;
				}

				// Sonntag unter Datum anzeigen
				if ($sonntag_on == 2)
				{
					$ausgabe .= $sonntag_txt;
				}

				// Losungtext anzeigen
				if ($losung_txt_on == 1)
				{
					$ausgabe .= $losung_txt;
					if ($losung_txt_vers_on == 1)
					{
						$ausgabe .= $losung_txt_vers;
					}
				}

				// Lehrtext anzeigen
				if ($lehr_txt_on == 1)
				{
					$ausgabe .= $lehr_txt;
					if ($lehr_txt_vers_on == 1)
					{
						$ausgabe .= $lehr_txt_vers;
					}
				}


				// Grafik anzeigen
				if ($pfeil_on == 1)
				{


					// extene Links anzeigen?
					// 1. Link anzeigen
					if ($links_on >= 1)
					{
						if ($modal_rel_link_on == "1")
						{
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"><img src=\"" . JUri::root() . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link1_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}
						else
						{
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"><img src=\"" . JUri::root() . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link1_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}

						// 2. Link anzeigen
						if ($links_on == 2)
						{
							// untereinander
							if ($links_line == 1)
							{
								$ausgabe .= "<br>\n";
							}
							// nebeneinander
							if ($modal_rel_link_on >= 1)
							{
								$ausgabe .= "<img src=\"" . JUri::root() . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link2_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
							}
							else
							{
								$ausgabe .= "<img src=\"" . JUri::root() . $pfeil_url . "\" border=\"0\" hspace=\"$pfeil_hspace\" vspace=\"$pfeil_vspace\" $pfeil_width $pfeil_height $pfeil_align /><a title=\"" . $link2_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
							}
						}
						$ausgabe .= "</div>\n";
					}
				}

				//Grafik nicht anzeigen
				if ($pfeil_on == 0)
				{

					// extene Links anzeigen?
					// 1. Link anzeigen
					if ($links_on >= 1)
					{
						if ($modal_rel_link_on >= 1)
						{
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"" . $style_ext . "><a title=\"" . $link1_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}
						else
						{
							$ausgabe .= "<div class=\"los_" . $modid . "_ext_links\"" . $style_ext . "><a title=\"" . $link1_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link1_url . "\" target=\"_blank\"$modal_rel_link>" . $link1_titel . "</a>\n";
						}
						// 2. Link anzeigen
						if ($links_on == 2)
						{
							// untereinander
							if ($links_line == 1)
							{
								$ausgabe .= "<br>\n";
								// nebeneinander
							}
							else
							{
								$ausgabe .= "&nbsp;&nbsp;&nbsp;";
							}
							if ($modal_rel_link_on >= 1)
							{
								$ausgabe .= "<a title=\"" . $link2_titel . "\" class=\"modal los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
							}
							else
							{
								$ausgabe .= "<a title=\"" . $link2_titel . "\" class=\"los_" . $modid . "_ext_links\" href=\"" . $link2_url . "\" target=\"_blank\"$modal_rel_link>" . $link2_titel . "</a>\n";
							}
						}
						$ausgabe .= "</div>\n";
					}
				}
				// CSS-Head
				if ($css_use == "0")
				{
					$csshead = "<style type=\"text/css\">\n" . $losung_css . "\n</style>";
					$document->addCustomTag($csshead);
					$ausgabe = "<div class=\"los_" . $modid . "_content\">\n" . $ausgabe .= "</div>\n";
				}
				// CSS-Body
				if ($css_use == "1")
				{
					$ausgabe = "<style type='text/css'>\n" . $losung_css . "</style>\n" . "<div class=\"los_" . $modid . "_content\">\n" . $ausgabe .= "</div>\n";
				}
				// CSS-Nein
				if ($css_use == "2")
				{
					$ausgabe = "<div class=\"los_" . $modid . "_content\">\n" . $ausgabe .= "</div>\n";
				}
			}

			if ($char_set == "UTF-8")
			{
				$ausgabe = utf8_encode($ausgabe);
				echo $ausgabe;
			}
			else
			{
				echo $ausgabe;
			}


			// wenn /losung/heutigelosung nicht vorhanden Fehler ausgeben
		}

		return true;
	}
}
