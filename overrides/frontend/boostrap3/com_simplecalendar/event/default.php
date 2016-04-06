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

jimport( 'joomla.mail.helper' );

$document 	= JFactory::getDocument();
// $canEdit = $this->item->params->get('access-edit');

$lang = JFactory::getLanguage();
$langTag = $lang->getTag();

JHtmlBehavior::framework();
JHtml::_('behavior.caption');
JHtml::_('behavior.tooltip');
		
// check if LatLonGoogleMaps is active & API key is provided (in backend-params)
if ( $this->params->get('use_gmap', '1') == '1' ) {
	$document->addScript('http://maps.googleapis.com/maps/api/js?sensor=false');
}

?>
<span class="buttons">
<?php
if ( !$this->print )
{
	echo SCOutput::showIcon('back'); 

	if( $this->params->get('show_print_icon', '1') )
	{
		$printlink = JRoute::_('index.php?view=event&catid='.$this->item->catslug.'&id='.$this->item->slug.'&print=1&tmpl=component');
		echo SCOutput::showIcon('printpreview', $printlink);
	}
	
	if( $this->params->get('show_mail_icon', '1') )
	{
		echo SCOutput::showIcon('email');
	}
	
	if( $this->params->get('show_vcal_icon', '1') )
	{
		$vcallink = JRoute::_('index.php?view=event&catid='.$this->item->catslug.'&id='.$this->item->slug.'&vcal=1');
		echo SCOutput::showIcon('vcal', $vcallink);
	}
} 
else
{
	echo SCOutput::showIcon('print');
}

// Initialize some variables
$dateText = SCOutput::getDatesType( $this->item->start_dt, $this->item->end_dt, $this->item->reserve_dt );
$dateString = SCOutput::getFormattedDate( $this->item->start_dt, $this->item->end_dt, $this->item->reserve_dt, $this->params->get('date_long_format'), $this->params->get('date_short_format'));
$timeString = SCOutput::getFormattedTime( $this->item->start_time, $this->item->end_time, $this->params->get('time_format'), true);

	
?>			
</span>
<div class="page-header">
<h2>
<?php
echo $this->item->name ; 
if ( $this->item->featured )
{
	echo '&nbsp;' . JHTML::tooltip(
			JText::_('COM_SIMPLECALENDAR_FEATURED_DESC'),
			JText::_('COM_SIMPLECALENDAR_FEATURED'),
			'../../../components/com_simplecalendar/assets/images/star_on.png',
			'',
			'',
			false
		) ;
}
// Check if we can edit the event
if ( ($this->canDo->get('core.edit') || ( $this->canDo->get('core.edit.own') && $this->user->id == $this->item->created_by)) && !$this->print )
{
	$this->item->uri = $this->uri;
	$link = JRoute::_(SimpleCalendarHelperRoute::getFormRoute($this->item->slug) . '&task=event.edit&return=' . base64_encode($this->uri));
	echo '&nbsp;' . SCOutput::showIcon('edit', $link);
}
?>
</h2>
</div>
<div class="sc_detail_wrapper">
<div class="sc_detail_left">
<dl class="sc_detail">
	<dt class="sc_detail"><?php echo SCOutput::getDatesType($this->item->start_dt, $this->item->end_dt, $this->item->reserve_dt); ?>:</dt>
	<dd class="sc_detail"><?php echo $dateString; ?>
	<?php 
	if( $this->item->statusid != 0 )
	{
		if ( $this->item->status_color != '' )
		{
			$colored_status = "<span class=\"sc_status\" style=\"background-color:#" . $this->item->status_color . 
				";border:1 px solid #" . $this->item->status_color . 
				";\">&nbsp;&nbsp;&nbsp;</span>";
		} 
		else
		{
			$colored_status = '<span><small>' . JText::_('STATUS') . '</small></span>';
		}
		echo '&nbsp;' . JHtml::tooltip(
			$this->item->status_description,
			JText::_('COM_SIMPLECALENDAR_STATUS_LABEL'),
			'',
			$colored_status,
			'',
			false
		);
	} ?>
	</dd>
	<?php 
	if($timeString != '')
	{
		if ( strlen($timeString) > 5 ) 
		{
			echo '<dt class="sc_detail">' . JText::_('COM_SIMPLECALENDAR_TIMES'). ':</dt>';
		} 
		else
		{
			echo '<dt class="sc_detail">' . JText::_('COM_SIMPLECALENDAR_TIME'). ':</dt>';
		}
		echo '<dd class="sc_detail">' . $timeString . '</dd>';
	}
	if ($this->params->get('customfield1_label') != '' && $this->item->customfield1 != '')
	{
		echo '<dt class="sc_detail">' . $this->params->get('customfield1_label') . ':</dt>';
		echo '<dd class="sc_detail">' . $this->item->customfield1 . '</dd>';
	}
	if ($this->item->venue != '')
	{
		echo '<dt class="sc_detail">' . JText::_('COM_SIMPLECALENDAR_VENUE') . ':</dt>';
		echo '<dd class="sc_detail">' . $this->item->venue . '</dd>';
	}
	if ($this->item->address != '')
	{
		echo '<dt class="sc_detail">' . JText::_('COM_SIMPLECALENDAR_ADDRESS') . ':</dt>';
		echo '<dd class="sc_detail">' . $this->item->address . '</dd>';
	}
	if ($this->item->organizer_id != '0')
	{
		echo '<dt class="sc_detail">'. JText::_('COM_SIMPLECALENDAR_ORGANIZER') . ':</dt>';
		echo '<dd class="sc_detail">'. $this->item->org_name;
		if ($this->item->org_contact_website != '' || $this->item->org_contact_website != Null) {
			echo '&nbsp;&nbsp;<a href="' . $this->item->org_contact_website . '" target="_blank">';
			echo JHTML::_('image', 'components/com_simplecalendar/assets/images/world_link.png', JText::_( 'COM_SIMPLECALENDAR_WEBSITE' ), array('align' => 'absolutemiddle', 'title'=>JText::_( 'COM_SIMPLECALENDAR_WEBSITE' ))) .'</a>';
		}
		echo '</dd>';
	}
	if($this->item->contact_name != '')
	{  
		echo '<dt class="sc_detail">'.JText::_('COM_SIMPLECALENDAR_CONTACT_PERSON').':</dt>';
		echo '<dd class="sc_detail">'.$this->item->contact_name;
		if ($this->item->contact_email != '' && JMailHelper::isEmailAddress($this->item->contact_email))
		{
			$row = new stdClass;
 			$row->text = '&nbsp;&nbsp;<a href="mailto:' . $this->item->contact_email.'">'.JHTML::_('image', 'components/com_simplecalendar/assets/images/email_go.png', JText::_( 'COM_SIMPLECALENDAR_EMAIL' ), array('align' => 'absolutemiddle', 'title'=>JText::_( 'COM_SIMPLECALENDAR_EMAIL' ))).'</a>';
			$row->text = ',' . JHTML::_('email.cloak', $this->item->contact_email);
			echo $row->text;
		}
		echo '</dd>';
	} 
	if ($this->item->contact_website != '' && $this->item->contact_website != $this->item->org_contact_website)
	{
		echo '<dt class="sc_detail">'. JText::_('COM_SIMPLECALENDAR_WEBSITE') . ':</dt>';
		if ( strlen($this->item->contact_website) > 48 )
		{
			echo '<dd class="sc_detail"><a href="' . $this->item->contact_website . '" target="_blank">' . substr($this->item->contact_website, 0, 32) . '...</a></dd>';
		} 
		else
		{
			echo '<dd class="sc_detail"><a href="' . $this->item->contact_website . '" target="_blank">' . $this->item->contact_website . '</a></dd>';
		}
	}
	if ($this->item->contact_telephone != '')
	{
		echo '<dt class="sc_detail">'. JText::_('COM_SIMPLECALENDAR_CONTACT_TELEPHONE') . ':</dt>';
		echo '<dd class="sc_detail">'. $this->item->contact_telephone .'</dd>';
	}
	if ($this->params->get('customfield2_label') != '' && $this->item->customfield2 != '')
	{
		echo '<dt class="sc_detail">' . $this->params->get('customfield2_label') . ':</dt>';
		echo '<dd class="sc_detail">' . $this->item->customfield2 . '</dd>';
	}
	if ( $this->item->price != '' )
	{
		echo '<dt class="sc_detail">' . JText::_('COM_SIMPLECALENDAR_PRICE') . ':</dt>';
		echo '<dd class="sc_detail">' . $this->params->get('currency', '') . ' '. $this->item->price . '</dd>';
	}
	if ( $this->item->state != '1' )
	{
		echo '<dt class="sc_detail">'. JText::_('COM_SIMPLECALENDAR_PUBLISHING_STATUS') . ':</dt>';
		switch($this->item->state)
		{
			case '2':
				echo '<dd class="sc_detail">' . JText::_('JARCHIVED') . '</dd>';
				break;
			case '-1':
				echo '<dd class="sc_detail">' . JText::_('JTRASHED') . '</dd>';
				break;
			case '0':
			default:
				echo '<dd class="sc_detail">' . JText::_('JUNPUBLISHED') . '</dd>';
				break;
		} 
	}
?>
</dl>
</div>
<?php if($this->params->get('use_gmap') == '1' && $this->item->latlon != '' ): ?>
<div class="sc_map_wrapper">
	<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $this->item->latlon; ?>&size=180x200&zoom=<?php echo $this->params->get('gmap_zoom', '11'); ?>&maptype=roadmap&markers=color:blue|<?php echo $this->item->latlon; ?>&sensor=false" />
	<div class="sc_map_description">
		<div class="sc_map_button">
			<?php
				$latlon = explode(',', $this->item->latlon);
				$lat = $latlon[0];
				$lon = $latlon[1]; 
			?><a href="http://www.panoramio.com/map/#lt=<?php echo $lat; ?>&ln=<?php echo $lon; ?>&z=4&k=2" target="blank">
				<?php echo JHTML::_('image', 'components/com_simplecalendar/assets/images/image.png', JText::_( 'COM_SIMPLECALENDAR_PANORAMIO' ), array('title'=>JText::_( 'COM_SIMPLECALENDAR_PANORAMIO' ))).'</a>'; ?>
			</a>
		</div>
		<div class="sc_map_button">
			<a href="http://maps.google.com/maps?f=d&daddr=<?php echo $this->item->latlon; ?>&place=<?php echo $this->item->venue; ?>&event=<?php echo $this->item->name; ?>" target="blank">
				<?php echo JHTML::_('image', 'components/com_simplecalendar/assets/images/car.png', JText::_( 'COM_SIMPLECALENDAR_GET_DIRECTIONS' ), array('title'=>JText::_( 'COM_SIMPLECALENDAR_GET_DIRECTIONS' ))).'</a>'; ?>
			</a>
		</div>
		<div class="sc_map_button">
			<a href="http://maps.google.com/maps?f=q&geocode=&q=<?php echo $this->item->latlon; ?>&place=<?php echo $this->item->venue; ?>&event=<?php echo $this->item->name; ?>" target="blank">
				<?php echo JHTML::_('image', 'components/com_simplecalendar/assets/images/map.png', JText::_( 'COM_SIMPLECALENDAR_OPEN_FULL_MAP' ), array('title'=>JText::_( 'COM_SIMPLECALENDAR_OPEN_FULL_MAP' ))).'</a>'; ?>
			</a>
		</div>
	</div>
</div>
<?php endif; ?>
<div class="sc_social_container">
<?php 
if ( $this->params->get('show_social_buttons', '1') ) 
{
	echo $this->loadTemplate('social'); 
} ?>
</div>
<?php 
if ( $this->item->description != '' ):
	if ( $this->params->get('show_description_title', '0') == '1' ): ?>
		<h3 class="additional_info"><?php echo JText::_('COM_SIMPLECALENDAR_ADDITIONAL_INFORMATION'); ?> </h3>
	<?php endif; ?>
	<div id="description">
	<?php echo $this->item->description; ?>
	</div>
<?php endif; ?>
</div>

<?php if ( $this->params->get('show_info_container', '1') )
{
	echo $this->loadTemplate('container'); 
}
?> 

<div class="sc-footer">
<?php 
echo SCOutput::showFooter();
?>
<?php 
// JComments integration
if ( file_exists(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php') )
{
	require_once(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php');
	echo JComments::show($this->item->id, 'com_simplecalendar', $this->item->name);
}
?>
</div>