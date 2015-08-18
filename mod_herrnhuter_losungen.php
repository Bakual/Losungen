<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$document = JFactory::getDocument();
$date     = JFactory::getDate();

$cacheparams               = new stdClass;
$cacheparams->cachemode    = 'id';
$cacheparams->class        = 'ModHerrnhuterlosungenHelper';
$cacheparams->method       = 'getLosung';
$cacheparams->methodparams = $params;
$cacheparams->modeparams   = $date->format('Y-m-d');

$losung = JModuleHelper::moduleCache($module, $params, $cacheparams);

if (!$losung)
{
	echo JText::_('MOD_HERRNHUTER_LOSUNGEN_NO_FILE_FOUND');
	return;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_herrnhuter_losungen', $params->get('layout', 'default'));



$ausgabe       = "";
$arbeitsstring = "";
$sonntag_txt   = "";
$gefunden      = "";


$modid = $module->id;

$char_set           = $params->get('char_set');

$datum_on      = $params->get('datum_on');
$datumselect   = $params->get('datumselect');
$zusatztext_on = $params->get('zusatztext_on');
$zusatztext    = $params->get('zusatztext');

$sonntag_on = $params->get('sonntag_on');

$losung_txt_on      = $params->get('losung_txt_on');
$losung_txt_vers_on = $params->get('losung_txt_vers_on');
$lehr_txt_on        = $params->get('lehr_txt_on');
$lehr_txt_vers_on   = $params->get('lehr_txt_vers_on');

$popup_bib_on     = $params->get('popup_bib_on');
$popup_bib_width  = $params->get('popup_bib_width');
$popup_bib_height = $params->get('popup_bib_height');
if ($popup_bib_on == "2")
{
	$popup_bib = " rel=\"{handler: 'iframe', size: {x: $popup_bib_width, y: $popup_bib_height}, onClose: function() {}}\"";
}
else
{
	$popup_bib = "";
}

$bibel_on      = $params->get('bibel_on');
$bibel_version = $params->get('bibel_version');

$links_on     = $params->get('links_on');
$link1_url    = $params->get('link1_url');
$link1_titel  = $params->get('link1_titel');
$link2_url    = $params->get('link2_url');
$link2_titel  = $params->get('link2_titel');
$links_line   = $params->get('links_line');

$modal_rel_link_on     = $params->get('modal_rel_link_on');
$modal_rel_link_width  = $params->get('modal_rel_link_width');
$modal_rel_link_height = $params->get('modal_rel_link_height');
if ($modal_rel_link_on == "1")
{
	$modal_rel_link = " rel=\"{handler: 'iframe', size: {x: $modal_rel_link_width, y: $modal_rel_link_height}, onClose: function() {}}\"";
}
else
{
	$modal_rel_link = "";
}

$pfeil_on    = $params->get('pfeil_on');
$pfeil_url   = $params->get('pfeil_url');
$pfeil_width = $params->get('pfeil_width');
if (strtoupper($pfeil_width) == "X")
{
	$pfeil_width = "";
}
else
{
	$pfeil_width = "width=\"$pfeil_width\"";
}

$pfeil_height = $params->get('pfeil_height');
if (strtoupper($pfeil_height) == "X")
{
	$pfeil_height = "";
}
else
{
	$pfeil_height = "height=\"$pfeil_height\"";
}

$pfeil_hspace = $params->get('pfeil_hspace');
$pfeil_vspace = $params->get('pfeil_vspace');
$pfeil_align  = $params->get('pfeil_align');
if ($pfeil_align == "standard")
{
	$pfeil_align = "";
}
else
{
	$pfeil_align = "align=\"$pfeil_align\"";
}

$css_use    = $params->get('css_use');
$losung_css = $params->get('losung_css');
$losung_css = str_replace(".los_" . $modid . "_", ".los_", $losung_css);
$losung_css = str_replace(".los_", ".los_" . $modid . "_", $losung_css);
$csshead    = "";


if ($char_set == "UTF-8")
{
	$link1_titel = utf8_decode($link1_titel);
	$link2_titel = utf8_decode($link2_titel);
	$zusatztext  = utf8_decode($zusatztext);
}
if ($modal_rel_link_on == "1"  or $popup_bib_on == "2")
{
	JHTML::_('behavior.modal');
}

