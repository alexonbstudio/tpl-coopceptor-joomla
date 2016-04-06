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
global $mainframe;

JTable :: addIncludePath(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_simplecalendar' . DS . 'tables');
require JPATH_COMPONENT . DS . 'helpers' . DS . 'vcal.class.php';
$uri = JURI::getInstance();

// new vCal object
$vcalfile = new vCal();
$config = JFactory::getConfig();
$vcalfile->setTimeZone($config->get('config.offset'));
$vcalfile->setCategory($this->item->catname);
$vcalfile->setSummary($this->item->name);
$vcalfile->setGeoPosition(str_replace(',', ';', $this->item->latlon));
$vcalfile->setCreated($this->item->created_dt);
$vcalfile->setModified($this->item->created_dt);


$vcalfile->setURL( $uri->toString( array('scheme', 'host', 'port')) . $this->item->link );
$description =  $this->item->name . " " . $this->item->venue . " / " .
				$this->item->org_name . " " . $this->item->contact_name;
if ($this->item->price > 0 ) {
	$description .= " " . JText::_('Price') . " " . $this->item->price;
}
$vcalfile->setDescription($description);

$hours1 = intval(date("G", strtotime($this->item->start_time)));
$mins1 	= intval(date("i", strtotime($this->item->start_time)));
$hours2 = intval(date("G", strtotime($this->item->end_time)));
$mins2 	= intval(date("i", strtotime($this->item->end_time)));

$date1_ts = mktime( $hours1, $mins1, 0, date("n", strtotime($this->item->start_dt)), date("j", strtotime($this->item->start_dt)), date("Y", strtotime($this->item->start_dt))  );
		
if ( strtotime($this->item->end_dt) ) {
	$date2_ts = mktime( $hours2, $mins2, 0, date("n", strtotime($this->item->end_dt)), date("j", strtotime($this->item->end_dt)), date("Y", strtotime($this->item->end_dt))  );
} else {
	$date2_ts = mktime( $hours2, $mins2, 0, date("n", strtotime($this->item->start_dt)), date("j", strtotime($this->item->start_dt)), date("Y", strtotime($this->item->start_dt))  );
}
$has_time = 1;		

$vcalfile->setDST($date1_ts);	

if ($has_time) {
	$vcalfile->setStartDate($date1_ts);
	$vcalfile->setEndDate($date2_ts);
} else {
	$vcalfile->setAllDayStart($date1_ts);
	$vcalfile->setAllDayEnd($date2_ts);
}

$vcalfile->setLocation($this->item->venue);
$vcalfile->setFilename($this->item->id . '-' . JApplication::stringURLSafe($this->item->name));

$vcalfile->setHeader();
$vcalfile->setEventBody();
$vcalfile->setFooter();
$vcalfile->generateHTMLvCal();

?>
