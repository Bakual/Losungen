<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

JFormHelper::loadFieldClass('list');

/**
 * Dateformat Field class.
 *
 * @since  1.0
 */
class JFormFieldDateformat extends JFormFieldList
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
	public function getOptions()
	{
		// Initialize variables.
		$options     = array();
		$date        = JHtml::Date('', 'Y-m-d H:m:s', true);
		$dateformats = array('DATE_FORMAT_LC', 'DATE_FORMAT_LC1', 'DATE_FORMAT_LC2', 'DATE_FORMAT_LC3', 'DATE_FORMAT_LC4');

		foreach ($dateformats AS $key => $format)
		{
			$options[$key]['value'] = $format;
			$options[$key]['text']  = JHtml::Date($date, JText::_($format), true);
		}

		// TODO: Maybe I can get rid of that option
		$options = array_merge($options, parent::getOptions());

		return $options;
	}
}
