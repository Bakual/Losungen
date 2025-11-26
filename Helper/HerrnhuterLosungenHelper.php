<?php
/**
 * @package     HerrnhuterLosungen
 * @author      Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   © 2025 - Thomas Hunziker
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

namespace Sermonspeaker\Module\HerrnhuterLosungen\Site\Helper;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;

defined('_JEXEC') or die();

/**
 * Helper class for Herrnhuter Losungen module
 *
 * @since  1.0
 */
class HerrnhuterLosungenHelper
{
	/**
	 * Get Losung from XML
	 *
	 * @return  array|false
	 *
	 * @throws \Exception
	 * @since   1.0
	 */
	public static function getLosungAjax(): false|array
	{
		$input = Factory::getApplication()->input;

		if ($input->get('nav') == 'prev')
		{
			$date = strtotime($input->get('date') . ' - 1 day');
		}
		else
		{
			$date = strtotime($input->get('date') . ' + 1 day');
		}

		$module  = ModuleHelper::getModule('mod_herrnhuter_losungen');
		$params  = new Registry($module->params);
		$files   = array();
		$files[] = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen ' . date('Y', $date). '.xml';
		$files[] = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen Free ' . date('Y', $date) . '.xml';
		$files[] = JPATH_ROOT . '/' . trim($params->get('path'), '/') . '/Losungen_Free_' . date('Y', $date) . '.xml';

		foreach ($files as $file)
		{
			if (file_exists($file))
			{
				if ($xml = simplexml_load_file($file))
				{
					$index             = date('z', $date);
					$losung            = (array) $xml->Losungen[(int) $index];
					$losung['Sonntag'] = (string) $xml->Losungen[(int) $index]->Sonntag;
					$losung['LosungstextFormatiert']     = self::formatText($losung['Losungstext']);
					$losung['Losungsverslink']     = self::linkScripture($losung['Losungsvers'], $params);
					$losung['LehrtextFormatiert']     = self::formatText($losung['Lehrtext']);
					$losung['Lehrtextverslink']     = self::linkScripture($losung['Lehrtextvers'], $params);
					$losung['DatumUS']         = HTMLHelper::_('date', $losung['Datum'], 'Y-m-d');
					$losung['DatumFormatiert'] = HTMLHelper::_('date', $losung['Datum'], Text::_($params->get('date_format', 'DATE_FORMAT_LC4')));

					return $losung;
				}
			}
		}

		return false;
	}

	/**
	 * Get Losung from XML
	 *
	 * @param Registry $params module parameters
	 *
	 * @return  array|false
	 *
	 * @since   1.0
	 */
	public static function getLosung(Registry $params): false|array
	{
		$date  = Factory::getDate();
		$files = array();
		$path  = trim($params->get('path', ''), '/');

		$files[] = JPATH_ROOT . '/' . $path . '/Losungen ' . $date->year . '.xml';
		$files[] = JPATH_ROOT . '/' . $path . '/Losungen Free ' . $date->year . '.xml';
		$files[] = JPATH_ROOT . '/' . $path . '/Losungen_Free_' . $date->year . '.xml';

		foreach ($files as $file)
		{
			if (file_exists($file))
			{
				if ($xml = simplexml_load_file($file))
				{
					$index                     = $date->dayofyear;
					$losung                    = (array) $xml->Losungen[(int) $index];
					$losung['Sonntag']         = (string) $xml->Losungen[(int) $index]->Sonntag;

					return $losung;
				}
			}
		}

		return false;
	}

	/**
	 * @param   string  $text  Bibleverse
	 *
	 * @return string
	 *
	 * @since   1.0
	 */
	public static function formatText(string $text): string
	{
		// In XML intro passages which state who is the speaker are formatted as such: /Jesus spricht:/
		if (!str_starts_with($text, '/'))
		{
			return $text;
		}

		$text = substr_replace($text, '<span class="sprecher">', 0, 1);
		$text = str_replace('/', '</span>', $text);

		return $text;
	}

	/**
	 * @param   string    $scripture  Bibleverse
	 * @param   Registry  $params     module parameters
	 *
	 * @return string
	 *
	 * @since   1.0
	 */
	public static function linkScripture(string $scripture, Registry $params): string
	{
		$translation = $params->get('bible_version_custom', $params->get('bible_version', 'LUT'));
		$url = 'https://www.bibleserver.com/' . $translation . '/' . $scripture;

		switch ($params->get('link_scripture', 1))
		{
			case 0:
				return $scripture;
			case 1:
				$title = Text::_('MOD_HERRNHUTER_LOSUNGEN_SCRIPTURELINK_NEW_WINDOW');

				return '<a title="' . $title . '" href="' . $url . '" target="_blank" class="losungstext hasTooltip">'
					. $scripture . '</a>';
			case 2:
				$title   = Text::_('MOD_HERRNHUTER_LOSUNGEN_SCRIPTURELINK_POPUP');
				$width   = $params->get('popup_width', 900);
				$height  = $params->get('popup_height', 600);
				$onclick = "Popup=window.open('" . $url . "','popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,"
					. 'width=' . $width . ',height=' . $height . ",left='+(screen.availWidth/2-(" . $width . "/2))+',top='+(screen.availHeight/2-(" . $height . "/2)));return false;";

				return '<a title="' . $title . '" href="#" onclick="' . $onclick . '" class="losungstext hasTooltip">'
					. $scripture . '</a>';
		}

		return '';
	}

	/**
	 * @param   integer                    $index     Bibleverse
	 * @param   \Joomla\Registry\Registry  $params    module parameters
	 * @param   integer                    $moduleId  module ID
	 *
	 * @return string
	 *
	 * @since   1.0
	 */
	public static function linkExtern(int $index, Registry $params, int $moduleId): string
	{
		if ($index !== 1 && $index !== 2)
		{
			return '';
		}

		$url  = $params->get('link' . $index . '_url');
		$text = $params->get('link' . $index . '_title');
		$html = '';

		if ($params->get('link_icon_class'))
		{
			$html = '<span class="fa ' . $params->get('link_icon_class') . '"> </span> ';
		}

		if ($params->get('link_mode', 1) == 1)
		{
			$html .= '<a href="' . $url . '" target="_blank">' . $text . '</a>';
		}
		else
		{
			$id     = 'losung_' . $moduleId . '_link_' . $index;
			$params = array(
				'title'  => $text,
				'url'    => $url,
				'height' => $params->get('modal_height', 600),
			);
			$html   .= HtmlHelper::_('bootstrap.renderModal', $id, $params);
			$html   .= '<a href="#' . $id . '" data-bs-toggle="modal" >' . $text . '</a>';
		}

		return $html;
	}
}
