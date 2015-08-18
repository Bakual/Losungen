<?php
/**
 * @package         HerrnhuterLosungen
 * @author          Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license         http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die;

JHtml::_('bootstrap.popover', '.losung', array('trigger' => 'manual'));
?>

<div class="small center">
	<a href="#" class="losung" onclick="jQuery(this).popover('toggle');return false;" data-placement="top" data-title="<?php echo JText::_('MOD_HERRNHUTER_LOSUNGEN_INFO'); ?>" data-content="<?php echo JText::_('MOD_HERRNHUTER_LOSUNGEN_INFO_POPOVER'); ?>">
		<?php echo JText::_('MOD_HERRNHUTER_LOSUNGEN_INFO'); ?>
	</a>
</div>