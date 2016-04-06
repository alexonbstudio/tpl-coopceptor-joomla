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

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<?php if (empty($this->items)) : ?>
	<p> <?php //echo JText::_('COM_SIMPLECALENDAR_NO_EVENTS'); ?>	 </p>
<?php else : ?>

<?php endif; 
$showHeaders = false;

// initialize some counters...
$currentMonthYear = '';
$oldMonthYear = ''; // new to takle error notices

$currentCategory = 0;
$oldCategory = 0;

$i = 0;
if (!isset($html))
	$html = '';
if (!isset($tdStyle))
	$tdStyle = '';
if (!isset($tdClass))
	$tdClass = '';

$colspan = 0;

$colspan = sizeof($this->columns);

?>
<div class="events_container">

<?php
$catid_var = JRequest::getInt('catid');
$catid_param = $this->params->get('catid');


$highlighter = '';
$highlighter = "<style type=\"text/css\">
div#simplecal tr.sc_highlight {
	background-color: #" . $this->config->get('frontend_link_color') . ";";
	
	// if( !$this->config->detailview_registered_only || $this->user->id != 0 ) {
		$highlighter .= " cursor: pointer;";
	// }
	$highlighter .= "}\n</style>";
	
	$this->document->addCustomTag($highlighter);

?>

<form action="<?php echo JRoute::_('index.php?view=events&catid=' . $this->app->input->get('catid')); ?>" 
	method="post" name="adminForm">
	

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
<?php
$tdClass = 'class="sc_rows"';
$tdStyle = 'style="padding-left: 4px;"';
$html =  '';
?>
<table class="sc_table" style="width:99%;">
<?php 
$td = '';
$thStyle = '';

if ( $this->config->get('show_headers', '0') ): ?>
<thead>
	<tr class="sc_column_header">
	<?php foreach ( $this->columns as $row ): ?>
		<?php $class = $row->cssclass != '' ? 'class="sc_column_header ' . $row->cssclass . '" ' : 'class="sc_column_header" '; ?>
		<?php $style = $row->style != '' ? 'style="' . $row->style . '" ' : ' '; ?>
		<th <?php echo $class . $style ?>>
			<?php echo $row->caption; ?>
		</th>
	<?php endforeach; ?>
	</tr>
</thead>
<?php endif; ?>

<tbody>
<?php 
$i = 0;
foreach ($this->items as $item): 
	$i++;
	$firstRow = '';
	$body = '';
	$tr = '';
	$currentMonthYear = (string) JHtml::_('date', $item->start_dt, JText::_('Y')) . JHtml::_('date', $item->start_dt, "m");
	$currentCategory = $item->catid;

	if ( $currentMonthYear != $oldMonthYear ) 
	{
		if ( $i != 1 ) 
		{
			$firstRow = ' style="padding-top: 8px;" ';
		}
		$tr .= '<tr><td class="sc_header" '. $firstRow .'colspan="'.$colspan.'"><b>'.JHTML::_('date', $item->start_dt, "F Y").'</b></td></tr>';
	}
	$oldMonthYear = $currentMonthYear;
	
	$link = JRoute::_( SimpleCalendarHelperRoute::getEventRoute($item->slug, $item->catslug));
	
	$tr .= '<tr onmouseover="this.bgColor = \'#' . $this->config->get('frontend_link_color') . '\'';
	if ( true /* !$this->config->detailview_registered_only */ || $this->user->id != 0) {
		$tr .= ', this.style.cursor=\'pointer\'" ';
		$tr .= 'onclick="document.location.href=\'' . $link . '\'" ';
	} else {
		$tr .= '" ';
	}
	$tr .= 'onmouseout ="this.bgColor = \'\'" ';
	$tr .= 'valign="top" >';
	echo $tr;
	foreach ( $this->columns as $row ): ?>
		<?php $class = $row->cssclass != '' ? 'class="sc_rows ' . $row->cssclass . '" ' : 'class="sc_rows" '; ?>
		<?php $style = $row->style != '' ? 'style="' . $row->style . '" ' : ' '; ?>
		<td headers="categorylist_header_<?php echo $row->colname; ?>" <?php echo $class . $style; ?>>
			<?php echo SCOutput::decodeColumns($row->colname, $item);?>
		</td>
	<?php endforeach; ?>	
	</tr>
<?php endforeach; ?>

<?php if ( $i == 0 ): ?>
		</table>
	</form>
	<br /><b><?php echo  JText::_('COM_SIMPLECALENDAR_NO_EVENTS') ?></b>
<?php else: ?>
			</tbody>
		</table>
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
	</form>
<?php endif; ?>

<?php echo '' // $html . "\n" . $footer . "\n" . $body; ?>
</div>