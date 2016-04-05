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
?>

<div class="sc_info_container" >
	<?php if ( $this->params->get('show_category', '1') ): ?>
	<span>
		<?php 
		echo JHTml::_(
			'image', 
			'components/com_simplecalendar/assets/images/category.png', 
			JText::_('COM_SIMPLECALENDAR_CATEGORY'),
			array('title'=>JText::_( 'COM_SIMPLECALENDAR_CATEGORY' ))
		);
		$link = JRoute::_( SimpleCalendarHelperRoute::getCategoryRoute($this->item->catslug));
		echo '&nbsp;<a href="'. $link . '">' . $this->item->catname .'</a>';
		?>
	</span>
	<?php endif; ?>
	
	<?php if ( $this->params->get('show_created', '1') ): ?>
	<span> | </span>
	<span>
		<?php 
		echo JHtml::_(
			'image', 
			'components/com_simplecalendar/assets/images/date_add.png', 
			JText::_('COM_SIMPLECALENDAR_FIELD_CREATED_LABEL'),
			array('title'=>JText::_( 'COM_SIMPLECALENDAR_FIELD_CREATED_LABEL' ))
		);
		echo '&nbsp;' . JHTML::_('date', $this->item->created_dt, JText::_('DATE_FORMAT_LC2'));
		?>
	</span>
	<?php endif; ?>
	
	<?php if ( $this->params->get('show_modified', '1') &&
				$this->item->modified_dt != '0000-00-00 00:00:00' &&
				$this->item->modified_dt != $this->item->created_dt ): ?>
	<span> | </span>
	<span>
		<?php 
		echo JHtml::_(
			'image', 
			'components/com_simplecalendar/assets/images/date_edit.png', 
			JText::_('COM_SIMPLECALENDAR_FIELD_MODIFIED_LABEL'),
			array('title'=>JText::_( 'COM_SIMPLECALENDAR_FIELD_MODIFIED_LABEL' ))
		);
		echo '&nbsp;' . JHTML::_('date', $this->item->modified_dt, JText::_('DATE_FORMAT_LC2'));
		?>
	</span>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_username', '1') && $this->item->created_by != 0 ): ?>
	<span> | </span>
	<span>
		<?php 
		echo JHtml::_(
			'image', 
			'components/com_simplecalendar/assets/images/user.png', 
			JText::_('COM_SIMPLECALENDAR_FIELD_CREATED_BY_LABEL'),
			array('title'=>JText::_( 'COM_SIMPLECALENDAR_FIELD_CREATED_BY_LABEL' ))
		);
		$event_owner = JFactory::getUser($this->item->created_by);
		echo '&nbsp;' . $event_owner->name;
		?>
	</span>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_hits', '1') ): ?>
	<span> | </span>
	<span>
		<?php 
		echo JHtml::_(
			'image', 
			'components/com_simplecalendar/assets/images/chart_bar.png', 
			JText::_('COM_SIMPLECALENDAR_FIELD_HITS_LABEL'),
			array('title'=>JText::_( 'COM_SIMPLECALENDAR_FIELD_HITS_LABEL' ))
		);
		echo '&nbsp;' . $this->item->hits;
		?>
	</span>
	<?php endif; ?>
	
</div>