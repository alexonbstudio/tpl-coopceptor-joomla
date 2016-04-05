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

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');

// Create shortcut to parameters.
$params = $this->state->get('params');
//$images = json_decode($this->item->images);
//$urls = json_decode($this->item->urls);
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'event.cancel' || document.formvalidator.isValid(document.id('adminForm')))
		{
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task);
		}
	}
</script>
<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
	<?php if ($params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_simplecalendar&view=form&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
		<div class="btn-toolbar">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('event.save')">
					<span class="icon-ok"></span>&#160;<?php echo JText::_('JSAVE') ?>
				</button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="Joomla.submitbutton('event.cancel')">
					<span class="icon-cancel"></span>&#160;<?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
		</div>
		<fieldset>
			<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('COM_SIMPLECALENDAR_TAB_EVENT_DETAILS');?></a></li>
			<li><a href="#organizer" data-toggle="tab"><?php echo JText::_('COM_SIMPLECALENDAR_TAB_ORGANIZER');?></a></li>
			<li><a href="#extended" data-toggle="tab"><?php echo JText::_('COM_SIMPLECALENDAR_TAB_EXTENDED_INFO');?></a></li>
			<li><a href="#publishing" data-toggle="tab"><?php echo JText::_('COM_SIMPLECALENDAR_TAB_PUBLISHING_DETAILS');?></a></li>
			<li><a href="#metadata" data-toggle="tab"><?php echo JText::_('COM_SIMPLECALENDAR_TAB_METADATA_OPTIONS');?></a></li>
			<?php if ($this->canDo->get('core.admin')): ?>
			<li><a href="#access" data-toggle="tab"><?php echo JText::_('COM_SIMPLECALENDAR_TAB_ACCESS_OPTIONS');?></a></li>
			<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="details">
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('name'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('name'); ?>		
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('alias'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('alias'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('catid'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('catid'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('venue'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('venue'); ?><br />
						<?php echo $this->form->getInput('address'); ?><br />
						<?php echo $this->form->getInput('latlon'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('start_dt'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('start_dt'); ?>&nbsp;
						<?php echo $this->form->getInput('start_time'); ?>
					</div>
				</div>
				<div class="control-group">
					<?php if ( $this->item->end_dt != null && $this->item->end_dt != '' && $this->item->end_dt != '0000-00-00' ): ?>
					<div class="control-label">
						<?php echo $this->form->getLabel('end_dt'); ?>
					</div>
					<div class="controls">
						<span id="span_end_dt"><?php echo $this->form->getInput('end_dt'); ?>&nbsp;
						<?php echo $this->form->getInput('end_time'); ?></span>
					</div>
					<?php else: ?>
					<div class="control-label">
						<?php echo $this->form->getLabel('end_dt'); ?>
					</div>
					<div class="controls">
						<span id="span_end_dt_checkbox"><small><?php echo '<input type="checkbox" id="show_end_dt" onclick="showEndDate(this)" value="" />' . ' ' . JText::_('COM_SIMPLECALENDAR_ADD_DATE'); ?></small></span>
						<span id="span_end_dt" style="display:none;"><?php echo $this->form->getInput('end_dt'); ?>&nbsp;
						<?php echo $this->form->getInput('end_time'); ?></span>
					</div>
					<?php endif;?>
				</div>
				<div class="control-group">
					<?php if ( $this->item->reserve_dt != null && $this->item->reserve_dt != '' && $this->item->reserve_dt != '0000-00-00' ): ?>
					<div class="control-label">
						<?php echo $this->form->getLabel('reserve_dt'); ?>
					</div>
					<div class="controls">
						<span id="span_reserve_dt"><?php echo $this->form->getInput('reserve_dt'); ?></span>
					</div>
					<?php else: ?>
					<div class="control-label">
						<?php echo $this->form->getLabel('reserve_dt'); ?>
					</div>
					<div class="controls">
						<span id="span_reserve_dt_checkbox"><small><?php echo '<input type="checkbox" id="show_reserve_dt" onclick="showReserveDate(this)" value="" />' . ' ' . JText::_('COM_SIMPLECALENDAR_ADD_DATE'); ?></small></span>
						<span id="span_reserve_dt" style="display:none;"><?php echo $this->form->getInput('reserve_dt'); ?></span>
					</div>
					<?php endif; ?>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('id'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('id'); ?>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="organizer">
				<?php foreach ($this->form->getFieldset('organizer') as $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="tab-pane" id="extended">
				<div id="image">
						<?php foreach ($this->form->getFieldset('image') as $field) : ?>
							<div class="control-group">
								<div class="control-label">
									<?php echo $field->label; ?>
								</div>
								<div class="controls">
									<?php echo $field->input; ?>
								</div>
							</div>
						<?php endforeach; ?>
				</div>
			<?php foreach ($this->form->getFieldset('extended') as $field) : ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $field->label; ?>
					</div>
					<div class="controls">
						<?php echo $field->input; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="tab-pane" id="publishing">
				<?php foreach ($this->form->getFieldset('publish') as $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="tab-pane" id="otherparams">
				<?php foreach ($this->form->getFieldset('otherparams') as $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="tab-pane" id="metadata">
				<?php foreach ($this->form->getFieldset('metadata') as $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
	
		<!-- begin ACL definition-->
		<?php if ($this->canDo->get('core.admin')): ?>
		<div class="tab-pane" id="access">
			<div class="control-label">
				<?php echo $this->form->getLabel('rules'); ?>
			</div>
			<div class="controls">
				<?php echo $this->form->getInput('rules'); ?>
			</div>
	  	</div>
	  <?php endif; ?>
 		 <!-- end ACL definition-->
 		 	</div>
	</fieldset>
	<?php // Add additional fields from plugins ?>
	<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
		<?php if ( $fieldset->name != 'details' && $fieldset->name != 'metadata' 
 			&& $fieldset->name != 'organizer' && $fieldset->name != 'publish' 
 			&& $fieldset->name != 'extended' && $fieldset->name != 'accesscontrol'
 			&& $fieldset->name != 'image' ): ?>
			<?php $fields = $this->form->getFieldset($fieldset->name);?>
			<?php foreach ($fields as $field) : ?>
				<div class="control-group">
					<?php if ($field->hidden) : ?>
						<div class="controls">
							<?php echo $field->input;?>
						</div>
					<?php else:?>
						<div class="control-label">
							<?php echo $field->label; ?>
							<?php if (!$field->required && $field->type != "Spacer") : ?>
								<span class="optional"><?php echo JText::_('COM_SIMPLECALENDAR_OPTIONAL');?></span>
							<?php endif; ?>
						</div>
						<div class="controls"><?php echo $field->input;?></div>
					<?php endif;?>
				</div>
			<?php endforeach;?>
		<?php endif ?>
	<?php endforeach;?>
	<div class="btn-toolbar">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('event.save')">
					<span class="icon-ok"></span>&#160;<?php echo JText::_('JSAVE') ?>
				</button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="Joomla.submitbutton('event.cancel')">
					<span class="icon-cancel"></span>&#160;<?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
		</div>
		
	<?php // endif; ?>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
	<input type="hidden" name="task" value="" />
	
	</form>
</div>
