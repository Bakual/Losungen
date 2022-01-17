<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
/** @var \Joomla\CMS\Application\SiteApplication $app */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('mod_herrnhuter_losungen.changedate', 'mod_herrnhuter_losungen/change-date.js', [], ['defer' => true]);

HtmlHelper::_('bootstrap.popover', '.losungPopover');
HtmlHelper::_('bootstrap.tooltip');

if ($params->get('load_css', 1))
{
	HtmlHelper::_('stylesheet', 'mod_herrnhuter_losungen/losung.css', array('relative' => true));
}
?>
<div id="losungen_<?php echo $module->id; ?>" class="losungen<?php echo $moduleclass_sfx; ?>">
	<?php if ($params->get('show_text', 1) || $params->get('show_date', 1)) : ?>
		<div class="introzeile">
			<?php if ($params->get('show_text', 1)) : ?>
				<span class="introtext"><?php echo Text::_($params->get('text', 'MOD_HERRNHUTER_LOSUNGEN_INTROTEXT_DEFAULT')); ?></span>
			<?php endif; ?>
			<?php if ($params->get('show_date', 1)) : ?>
				<button type="button" id="losungButtonPrev" class="fa fa-chevron-left"
						data-losungnavigation="prev"></button>
				<span id="losungDatum" class="datum"
					  data-losungdatum="<?php echo HtmlHelper::_('date', '', 'Y-m-d'); ?>"><?php echo HtmlHelper::_('date', '', Text::_($params->get('date_format', 'DATE_FORMAT_LC4'))); ?></span>
				<button type="button" id="losungButtonNext" class="fa fa-chevron-right"
						data-losungnavigation="next"></button>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ($params->get('show_sunday', 1) && $losung['Sonntag']) : ?>
		<div class="sonntag"><?php echo $losung['Sonntag']; ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_losungstext', 1)) : ?>
		<div id="losungsText"
			 class="losungstext"><?php echo ModHerrnhuterlosungenHelper::formatText($losung['Losungstext']); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_losungsvers', 1)) : ?>
		<div id="losungsVers"
			 class="losungsvers"><?php echo ModHerrnhuterlosungenHelper::linkScripture($losung['Losungsvers'], $params); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_lehrtext', 1)) : ?>
		<div id="lehrText"
			 class="lehrtext"><?php echo ModHerrnhuterlosungenHelper::formatText($losung['Lehrtext']); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_lehrtextvers', 1)) : ?>
		<div id="lehrTextVers"
			 class="lehrtextvers"><?php echo ModHerrnhuterlosungenHelper::linkScripture($losung['Lehrtextvers'], $params); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_links')) : ?>
		<div class="links">
			<ul class="<?php echo $params->get('link_ul_class'); ?>">
				<?php if ($params->get('link1_url') and $params->get('link1_title')) : ?>
					<li><?php echo ModHerrnhuterlosungenHelper::linkExtern(1, $params, $module->id); ?></li>
				<?php endif; ?>
				<?php if (($params->get('show_links') == 2) and $params->get('link2_url') and $params->get('link2_title')) : ?>
					<li><?php echo ModHerrnhuterlosungenHelper::linkExtern(2, $params, $module->id); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>
	<div class="copyright">
		<a role="button" class="losungPopover" data-bs-placement="top" data-bs-toggle="popover"
		   title="<?php echo Text::_('MOD_HERRNHUTER_LOSUNGEN_INFO'); ?>"
		   data-bs-content="<?php echo Text::_('MOD_HERRNHUTER_LOSUNGEN_INFO_POPOVER'); ?>">
			<?php echo Text::_('MOD_HERRNHUTER_LOSUNGEN_INFO'); ?>
		</a>
	</div>
</div>
