<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Installer\Adapter\ComponentAdapter;
use Joomla\CMS\Installer\InstallerScript;

/**
 * Class Mod_herrnhuter_losungenInstallerScript
 *
 * @since  1.0.0
 */
class Mod_herrnhuter_losungenInstallerScript extends InstallerScript
{
	/**
	 * A list of files to be deleted
	 *
	 * @var    array
	 * @since  3.6
	 */
	protected $deleteFiles = array(
		'modules/mod_herrnhuter_losungen/language/de-CH/de-CH.mod_herrnhuter_losungen.ini',
		'modules/mod_herrnhuter_losungen/language/de-CH/de-CH.mod_herrnhuter_losungen.sys.ini',
		'modules/mod_herrnhuter_losungen/language/de-DE/de-DE.mod_herrnhuter_losungen.ini',
		'modules/mod_herrnhuter_losungen/language/de-DE/de-DE.mod_herrnhuter_losungen.sys.ini',
		'modules/mod_herrnhuter_losungen/language/en-GB/en-GB.mod_herrnhuter_losungen.ini',
		'modules/mod_herrnhuter_losungen/language/en-GB/en-GB.mod_herrnhuter_losungen.sys.ini',
	);

	/**
	 * Minimum Joomla! version required to install the extension
	 *
	 * @var    string
	 * @since  2.0.0
	 */

	protected $minimumJoomla = '4.0.0';

	/**
	 * Function to perform changes during postflight
	 *
	 * @param   string            $type    The action being performed
	 * @param   ComponentAdapter  $parent  The class calling this method
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function postflight($type, $parent)
	{
		$this->removeFiles();
	}
}
