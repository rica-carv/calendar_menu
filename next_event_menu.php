<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Forthcoming events menu handler for event calendar
 *
 */

/**
 *	e107 Event calendar plugin
 *
 * Forthcoming events menu handler for event calendar
 *
 *	@package	e107_plugins
 *	@subpackage	event_calendar
 */

if (!defined('e107_INIT')) { exit; }
$e107 = e107::getInstance();

if (!$e107->isInstalled('calendar_menu')) return '';


if (!isset($ecal_class) || !is_object($ecal_class)) 
{
	require_once(e_PLUGIN.'calendar_menu/ecal_class.php');
	$ecal_class = new ecal_class;
}

// See if the page is already in the cache
$cache_tag = 'nq_event_cal_next';
if($cacheData = $e107->ecache->retrieve($cache_tag, $ecal_class->max_cache_time))
{
	echo $cacheData;
	return;
}

include_lan(e_PLUGIN.'calendar_menu/languages/'.e_LANGUAGE.'.php');
$calSc = e107::getScBatch('calendar', 'calendar_menu');

//require_once(e_PLUGIN.'calendar_menu/calendar_shortcodes.php');
//$calSc = new event_calendar_shortcodes();

/* for now, both templates are the same */
if(deftrue('BOOTSTRAP') === 3)  {
   $calendartemplate   = e107::getTemplate('calendar_menu', 'calendarbootstrap3' , 'next_event_menu' );
   $calSc->wrapper('calendarbootstrap3/next_event_menu'); // default.
}
else {
	 $calendartemplate   = e107::getTemplate('calendar_menu', 'calendarlegacy' , 'next_event_menu' );
	 $calSc->wrapper('calendarlegacy/next_event_menu'); // default.

}

$EVENT_CAL_FE_LINE = $calendartemplate['cal_fe_line'];

// Values defined through admin pages
$menu_title = varset($this->ecal_class->pref['eventpost_menuheading'],EC_LAN_140);
$days_ahead = varset($this->ecal_class->pref['eventpost_daysforward'],30);			// Number of days ahead to go
$show_count = varset($this->ecal_class->pref['eventpost_numevents'],3);				// Number of events to show
$show_recurring = varset($this->ecal_class->pref['eventpost_checkrecur'],1);			// Zero to exclude recurring events
$link_in_heading = varset($this->ecal_class->pref['eventpost_linkheader'],0);			// Zero for simple heading, 1 to have clickable link


$start_time = $ecal_class->cal_timedate;
$end_time = $start_time + (86400 * $days_ahead) - 1;


$cal_text = '';

$calSc->ecalClass = &$ecal_class;			// Give shortcodes a pointer to calendar class

$ev_list = $ecal_class->get_n_events($show_count, $start_time, $end_time, varset($ecal_class->pref['eventpost_fe_set'],FALSE), $show_recurring, 
						'event_id,event_start, event_thread, event_title, event_recurring, event_allday, event_category', 'event_cat_icon');


$cal_totev = count($ev_list);

if ($cal_totev > 0)
{
	foreach ($ev_list as $thisEvent)
	{
		$cal_totev --;    // Can use this to modify inter-event gap
		$calSc->numEvents = $cal_totev;				// Number of events to display
		$calSc->event = $thisEvent;					// Give shortcodes the event data
		
		$cal_text .= $tp->parseTemplate($EVENT_CAL_FE_LINE,FALSE, $calSc);
	}
}
else
{
	if ($this->ecal_class->pref['eventpost_fe_hideifnone']) return '';
	$cal_text.= EC_LAN_141;
}

$calendar_title = $tp->toHTML($menu_title,FALSE,'TITLE');		// Allows multi-language title, shortcodes
if ($link_in_heading == 1)
{
	$calendar_title = "<a class='forumlink' href='".e_PLUGIN_ABS."calendar_menu/event.php' >".$calendar_title."</a>";
}

// Now handle the data, cache as well
ob_start();					// Set up a new output buffer
e107::getRender()->tablerender($calendar_title, $cal_text, 'next_event_menu');
$cache_data = ob_get_flush();			// Get the page content, and display it
$e107->ecache->set($cache_tag, $cache_data);	// Save to cache

unset($ev_list);	

?>
