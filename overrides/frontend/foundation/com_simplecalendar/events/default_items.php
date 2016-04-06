
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
defined('_JEXEC') or die;

JHtml::_('behavior.framework');
JHtml::_('behavior.tooltip');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
	<fieldset class="filters btn-toolbar">
		<?php if ($this->params->get('filter_field') != 'hide') :?>
			<div class="btn-group">
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_SIMPLECALENDAR_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_SIMPLECALENDAR_FILTER_SEARCH_DESC'); ?>" />
			</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="btn-group pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>
	</fieldset>
	<?php endif; ?>
<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_SIMPLECALENDAR_NO_EVENTS'); ?>	 </p>
<?php else : ?>
	<table class="category table table-striped table-bordered table-hover">
		<?php if ($this->params->get('show_headings', '1')) : ?>
		<thead>
			<tr>
			<?php foreach ( $this->columns as $row ): ?>
			<?php $class = $row->cssclass != '' ? 'class="' . $row->cssclass . '" ' : ' '; ?>
			<?php $style = $row->style != '' ? 'style="' . $row->style . ';" ' : ' '; ?>
			<th id="categorylist_header_<?php echo $row->colname; ?>" <?php echo $class . $style; ?>>
				<?php echo JHtml::_('grid.sort', str_replace('\'','',$row->caption), $row->colname, $listDirn, $listOrder); ?>
			</th>
			<?php endforeach; ?>
			</tr>
		</thead>
		<?php endif; ?>
		<tbody>
			<?php foreach ($this->items as $i => $event) : ?>
				<?php if ($this->items[$i]->state == 0) : ?>
				<tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
				<?php else: ?>
				<tr class="cat-list-row<?php echo $i % 2; ?>" >
				<?php endif; ?>
				<?php foreach ( $this->columns as $row ): ?>
				<?php $class = $row->cssclass != '' ? 'class="' . $row->cssclass . '" ' : ' '; ?>
				<?php $style = $row->style != '' ? 'style="' . $row->style . '" ' : ' '; ?>
				<td headers="categorylist_header_<?php echo $row->colname; ?>" <?php echo $class . $style; ?>>
					<?php echo SCOutput::decodeColumns($row->colname, $event);?>
				</td>
				<?php endforeach; ?>
			<?php endforeach; ?>			
		</tbody>
	</table>
	<input type="hidden" name="limitstart" value="" />
	<input type="hidden" name="task" value="" />
	<?php if ($this->params->get('show_pagination')) : ?>
	<div class="pagination" style="clear:both;">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="counter pull-right">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
	<div>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	</div>
</form>
<?php endif; ?>