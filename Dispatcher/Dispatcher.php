<?php
/**
 * @package     HerrnhuterLosungen
 * @author      Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   © 2025 - Thomas Hunziker
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

namespace Sermonspeaker\Module\HerrnhuterLosungen\Site\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
	use HelperFactoryAwareTrait;

	/**
	 * Returns the layout data.
	 *
	 * @return  array|bool
	 *
	 * @since   7.0.0
	 */
	protected function getLayoutData(): array|bool
	{
		$data   = parent::getLayoutData();
		$params = $data['params'];

		$cacheparams               = new \stdClass;
		$cacheparams->cachemode    = 'id';
		$cacheparams->class        = $this->getHelperFactory()->getHelper('HerrnhuterLosungenHelper');
		$cacheparams->method       = 'getLosung';
		$cacheparams->methodparams = [$params];
		$cacheparams->modeparams   = Factory::getDate()->format('Y-m-d');

		$data['losung'] = ModuleHelper::moduleCache($this->module, $params, $cacheparams);

		if (!$data['losung'])
		{
			echo Text::_('MOD_HERRNHUTER_LOSUNGEN_NO_FILE_FOUND');

			return false;
		}

		return $data;
	}
}
