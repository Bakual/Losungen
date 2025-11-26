<?php
/**
 * @package     HerrnhuterLosungen
 * @author      Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   © 2025 - Thomas Hunziker
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

namespace Sermonspeaker\Module\HerrnhuterLosungen\Site\Field;

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die();

/**
 * Dateformat Field class.
 *
 * @since  1.0
 */
class DateformatField extends ListField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $type = 'Dateformat';

	/**
	 * Method to get the field options.
	 *
	 * @return  array   The field option objects.
	 * @since   1.6
	 */
	public function getOptions(): array
	{
		// Initialize variables.
		$options     = array();
		$date        = HTMLHelper::date('', 'Y-m-d H:m:s');
		$dateformats = array('DATE_FORMAT_LC1', 'DATE_FORMAT_LC2', 'DATE_FORMAT_LC3', 'DATE_FORMAT_LC4', 'MOD_HERRNHUTER_LOSUNGEN_DATEFORMAT_SHORT');

		foreach ($dateformats AS $key => $format)
		{
			$options[$key]['value'] = $format;
			$options[$key]['text']  = HTMLHelper::date($date, Text::_($format));
		}

		return $options;
	}
}
