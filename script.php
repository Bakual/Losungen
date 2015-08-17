<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

/**
 * Class Mod_herrnhuter_losungenInstallerScript
 *
 * @since  1.0.0
 */
class Mod_herrnhuter_losungenInstallerScript
{
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @param   string                      $type    'install', 'update' or 'discover_install'
	 * @param   JInstallerAdapterComponent  $parent  Installerobject
	 *
	 * @return  boolean  false will terminate the installation
	 */
	public function preflight($type, $parent)
	{
		$min_version = (string) $parent->get('manifest')->attributes()->version;

		$jversion = new JVersion;

		if (!$jversion->isCompatible($min_version))
		{
			JFactory::getApplication()->enqueueMessage(JText::sprintf('MOD_HERRNHUTER_VERSION_UNSUPPORTED', $min_version), 'error');

			return false;
		}

		return true;
	}
}
