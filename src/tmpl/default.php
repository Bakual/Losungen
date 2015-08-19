<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die;

JHtml::_('bootstrap.popover', '.losung', array('trigger' => 'manual'));
Jhtml::_('bootstrap.tooltip');
?>
<div id="losungen_<?php echo $module->id; ?>" class="losungen">
	<?php if ($params->get('show_text', 1)) : ?>
		<div class="introtext"><?php echo JText::_($params->get('text', 'MOD_HERRNHUTER_LOSUNGEN_INTROTEXT_DEFAULT')); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_date', 1)) : ?>
		<div class="datum"><?php echo JHtml::_('date', '', JText::_($params->get('date_format', 'DATE_FORMAT_LC4'))); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_sunday', 1) && $losung['Sonntag']) : ?>
		<div class="sonntag"><?php echo $losung['Sonntag']; ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_losungstext', 1)) : ?>
		<div class="losungstext"><?php echo ModHerrnhuterlosungenHelper::formatText($losung['Losungstext']); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_losungsvers', 1)) : ?>
		<div class="losungsvers"><?php echo ModHerrnhuterlosungenHelper::linkScripture($losung['Losungsvers'], $params); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_lehrtext', 1)) : ?>
		<div class="lehrtext"><?php echo ModHerrnhuterlosungenHelper::formatText($losung['Lehrtext']); ?></div>
	<?php endif; ?>
	<?php if ($params->get('show_lehrtextvers', 1)) : ?>
		<div class="lehrtextvers"><?php echo ModHerrnhuterlosungenHelper::linkScripture($losung['Lehrtextvers'], $params); ?></div>
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
	<div class="small">
		<a href="#" class="losung" onclick="jQuery(this).popover('toggle');return false;" data-placement="top" data-title="<?php echo JText::_('MOD_HERRNHUTER_LOSUNGEN_INFO'); ?>" data-content="<?php echo JText::_('MOD_HERRNHUTER_LOSUNGEN_INFO_POPOVER'); ?>">
			<?php echo JText::_('MOD_HERRNHUTER_LOSUNGEN_INFO'); ?>
		</a>
	</div>
</div>