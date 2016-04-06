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

require JPATH_COMPONENT . DS . 'helpers' . DS . 'vcal.class.php';
$vcalfile = new vCal();

$app= JFactory::getApplication();

$vcalfile->setHeader();
$vcalfile->setCalendarTimeZone($app->getCfg('offset'));

foreach($this->items as $item) {
	$vcalfile->emptyElements();
	$vcalfile->setTimeZone(/* $app->getCfg('offset')*/ 0 );
// 	$vcalfile->setCategory($item->catname);
	$vcalfile->setSummary($item->name);
	$vcalfile->setDescription($item->contact_name . " " . strip_tags($item->description));
	$vcalfile->setModified($item->modified_dt);
	$vcalfile->setUID($item->id);
	if ( $item->contact_name != '' ) {
		$vcalfile->setOrganizer($item->contact_name, $item->contact_email);
	}

	if ( strtotime($item->start_time) != strtotime($item->end_time) ) {
			
		$hours1 = intval(date("G", strtotime($item->start_time)));
		$mins1 	= intval(date("i", strtotime($item->start_time)));
		if ( $item->end_time == NULL || $item->end_time == '50:00:00' ){
			$item->end_time = $item->start_time;
			$hours2 = intval(date("G", strtotime($item->end_time) + 3600));
		} else {
			$hours2 = intval(date("G", strtotime($item->end_time)));
		}
		$mins2 	= intval(date("i", strtotime($item->end_time)));
			
		$start_dt_ts = mktime( $hours1, $mins1, 0, date("n", strtotime($item->start_dt)), date("j", strtotime($item->start_dt)), date("Y", strtotime($item->start_dt))  );
		if (strtotime($item->end_dt)) {
			$end_dt_ts = mktime( $hours2, $mins2, 0, date("n", strtotime($item->end_dt)), date("j", strtotime($item->end_dt)), date("Y", strtotime($item->end_dt))  );
		} else {
			$end_dt_ts = mktime( $hours2, $mins2, 0, date("n", strtotime($item->start_dt)), date("j", strtotime($item->start_dt)), date("Y", strtotime($item->start_dt))  );
		}
		$has_time = 1;
	} else {
		$start_dt_ts = mktime( 0, 0, 0, date("n", strtotime($item->start_dt)), date("j", strtotime($item->start_dt)), date("Y", strtotime($item->start_dt))  );
		if (strtotime($item->end_dt)) {
			$end_dt_ts = mktime( 0, 0, 0, date("n", strtotime($item->end_dt)), date("j", strtotime($item->end_dt))+1, date("Y", strtotime($item->end_dt))  );
		} else {
			$end_dt_ts = $start_dt_ts;
		}
		$has_time = 0;
	}

	$vcalfile->setDST($start_dt_ts);

	if ( $has_time ) {
		$vcalfile->setStartDate($start_dt_ts);
		$vcalfile->setEndDate($end_dt_ts);
	} else {
		$vcalfile->setAllDayStart($start_dt_ts);
		$vcalfile->setAllDayEnd($end_dt_ts);
	}

	if ($item->venue != '') {
		$vcalfile->setLocation($item->venue);
	}
	if ($item->latlon != '') {
		$vcalfile->setGeoPosition(str_replace(',', ';', $item->latlon));
	}
	if ($item->contact_website != '') {
		$vcalfile->setURL($item->contact_website);
	}
	$vcalfile->setItemId($item->id);
	$vcalfile->setCreated($item->created_dt);
	$vcalfile->setEventBody();
}

$vcalfile->setFilename('simplecalendar_full');
$vcalfile->setFooter();
$vcalfile->generateHTMLvCal();
?>