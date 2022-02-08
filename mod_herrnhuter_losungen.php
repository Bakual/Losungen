<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2022 - Thomas Hunziker
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
