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
		$date    = JFactory::getDate();
		$files   = array();
		$files[] = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen ' . $date->year . '.xml';
		$files[] = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen Free ' . $date->year . '.xml';
		$files[] = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen_Free_' . $date->year . '.xml';

		foreach ($files as $file)
		{
			if (file_exists($file))
			{
				if ($xml = simplexml_load_file($file))
				{
					$index             = $date->dayofyear;
					$losung            = (array) $xml->Losungen[(int) $index];
					$losung['Sonntag'] = (string) $xml->Losungen[(int) $index]->Sonntag;

					return $losung;
				}
			}
		}

		return false;
	}

	/**
	 * @param  string  $text  Bibleverse
	 *
	 * @return string
	 */
	public static function formatText($text)
	{
		// In XML intro passages which state who is the speaker are formatted as such: /Jesus sprich:/
		if (strpos($text, '/') !== 0)
		{
			return $text;
		}

		$text = substr_replace($text, '<span class="sprecher">', 0, 1);
		$text = str_replace('/', '</span>', $text);

		return $text;
	}

	/**
	 * @param  string                     $scripture  Bibleverse
	 * @param  \Joomla\Registry\Registry  $params     module parameters
	 *
	 * @return string
	 */
	public static function linkScripture($scripture, $params)
	{
		$url = 'http://www.bibleserver.com/text/' . $params->get('bible_version', 'LUT') . '/' . $scripture;

		switch ($params->get('link_scripture', 1))
		{
			case 0:
				return $scripture;
			case 1:
				$title = JText::_('MOD_HERRNHUTER_LOSUNGEN_SCRIPTURELINK_NEW_WINDOW');

				return '<a title="' . $title . '" href="' . $url . '" target="_blank" class="losungstext hasTooltip">'
				. $scripture . '</a>';
			case 2:
				$title   = JText::_('MOD_HERRNHUTER_LOSUNGEN_SCRIPTURELINK_POPUP');
				$width   = $params->get('popup_width', 900);
				$height  = $params->get('popup_height', 600);
				$onclick = "Popup=window.open('" . $url . "','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,"
					. 'width=' . $width . ',height=' . $height . ",left='+(screen.availWidth/2-(" . $width . "/2))+',top='+(screen.availHeight/2-(" . $height . "/2)));return false;";

				return '<a title="' . $title . '" href="#" onclick="' . $onclick . '" class="losungstext hasTooltip">'
				. $scripture . '</a>';
		}
	}

	/**
	 * @param  integer                    $index     Bibleverse
	 * @param  \Joomla\Registry\Registry  $params    module parameters
	 * @param  integer                    $moduleId  module ID
	 *
	 * @return string
	 */
	public static function linkExtern($index, $params, $moduleId)
	{
		if ($index !== 1 && $index !== 2)
		{
			return;
		}

		$url  = $params->get('link' . $index . '_url');
		$text = $params->get('link' . $index . '_title');
		$html = '';

		if ($params->get('link_icon_class'))
		{
			$html = '<span class="icon ' . $params->get('link_icon_class') . '"> </span> ';
		}

		if ($params->get('link_mode', 1) == 1)
		{
			$html .= '<a href="' . $url . '" target="_blank">' . $text . '</a>';
		}
		else
		{
			$id = 'losung_' . $moduleId . '_link_' . $index;
			$params = array(
				'title'  => $text,
				'url'    => $url,
				'height' => $params->get('modal_height', 600),
			);
			$html .= JHtml::_('bootstrap.renderModal', $id, $params);
			$html .= '<a href="#' . $id . '" data-toggle="modal" >' . $text . '</a>';
		}

		return $html;
	}
}
