<?php
/**
 *	com_simplecalendar - a simple calendar component for Joomla
 *  Copyright (C) 2008-2013 Fabrizio Albonico
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.framework');
?>
<div class="events<?php // echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading', '1')) : ?>
	<div class="page-header">
		<h2>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h2>
	</div>
<?php endif; ?>
<div class="page-header">
<h2>
	<?php 
	// Page title, taken from the menu or from the page_title option in menu options
	echo JHtml::_('content.prepare', $this->params->get('page_title'), '', 'com_simplecalendar.category');
	if ( $this->canDo->get('core.create') && $this->app->input->get('tmpl') != 'component' ) 
	{
		$link = JRoute::_(SimpleCalendarHelperRoute::getFormRoute(0) . '&return=' .  base64_encode($this->uri));
		echo '&nbsp;' . SCOutput::showIcon('new', $link);
	} 
	?>
</h2>
<?php if ( $this->params->get('page_subtitle', '') != '' ): ?>
<h3>
	<?php echo $this->params->get('page_subtitle', ''); ?>
</h3>
<?php endif; ?>
</div>
<span class="buttons"><?php 
if ( $this->app->input->get('tmpl') != 'component')
{
	if ( $this->params->get('show_print_icon_list', '1') ) 
	{
		echo SCOutput::showIcon('printpreview', JRoute::_(SimpleCalendarHelperRoute::getCategoryRoute($this->app->input->get('catid')) . '&tmpl=component'));
	}
	if ( $this->params->get('show_vcal_icon_list', '1') )
	{
		echo SCOutput::showIcon('vcal', JRoute::_(SimpleCalendarHelperRoute::getCategoryRoute($this->app->input->get('catid')) . '&tmpl=component&vcal=1'));
	}
}
else
{
	echo SCOutput::showIcon('print');
}
?>
</span>


<?php
// //DEBUG
// var_dump($this->params->def('show_description', 1), 'default.php, line 67');
// exit;
?>

<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="intro_text">
	<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
		<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->category->description) : ?>
		<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_simplecalendar.category'); ?>
	<?php endif; ?>
	<div class="sc_clear"></div>
	</div>
<?php else: ?>
	<?php if ( $this->params->get('intro_text', '') != '' ): ?>
		<div class="intro_text"><?php echo $this->params->get('intro_text', '') ?>
			<div class="clr"></div>
		</div>
	<?php elseif ( $this->config->get('intro_text', '') != '' ): ?>
		<div class="intro_text"><?php echo $this->config->intro_text; ?>
			<div class="clr"></div>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php // Subcategories ?>
<?php if ( $this->params->get('show_subcat_desc', '1') == '1' && count($this->children) > 0 ): ?>
<div class="events_subcategories"><?php echo JText::_('COM_SIMPLECALENDAR_SUBCATEGORIES_LABEL') . ': '; ?>
	<?php foreach ( $this->children as $child ): ?>
		<a href="<?php echo JRoute::_(SimpleCalendarHelperRoute::getCategoryRoute($child->id))?>"><?php echo $child->title; ?></a>&nbsp;
	<?php endforeach; ?>
</div>
<?php endif;?>

<?php echo $this->loadTemplate($this->list_style); ?>

</div>
<div class="clr"></div>
<div class="sc-footer">
<?php echo SCOutput::showFooter(); ?>
</div>
