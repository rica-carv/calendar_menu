<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Templates for event calendar displays
 *
 * $Source: /cvs_backup/e107_0.8/e107_plugins/calendar_menu/templates/calendar_template.php,v $
 * $Revision$
 * $Date$
 * $Author$
 */

/**
 *	e107 Event calendar plugin
 *
 * Templates for event calendar displays
 *
 *	@package	e107_plugins
 *	@subpackage	event_calendar
 *	@version 	$Id$;
 *
 */


if (!defined('e107_INIT')) { exit; }
if (!defined('USER_WIDTH')){ define('USER_WIDTH','width:auto'); }

//global $sc_style;

  $ec_images_path = e_IMAGE;
  $ec_images_path_abs = e_IMAGE_ABS;
  if (!defined('EC_RECENT_ICON')) 
  {
	define('EC_RECENT_ICON',e_IMAGE.'generic/new.png');
	define('EC_RECENT_ICON_ABS',e_IMAGE_ABS.'generic/new.png');
  }		// Filename of icon used to flag recent events




// TIME SWITCH BUTTONS ------------------------------------------------------------
$sc_style['EC_PREV_MONTH']['pre'] = "<span class='defaulttext'>";
$sc_style['EC_PREV_MONTH']['post'] = "</span>";

$sc_style['EC_CURRENT_MONTH']['pre'] = "<b>";
$sc_style['EC_CURRENT_MONTH']['post'] = "</b>";

$sc_style['EC_NEXT_MONTH']['pre'] = "<span class='defaulttext'>";
$sc_style['EC_NEXT_MONTH']['post'] = "</span>";

$sc_style['EC_PREV_YEAR']['pre'] = '';
$sc_style['EC_PREV_YEAR']['post'] = '';

$sc_style['EC_MONTH_LIST']['pre'] = '';
$sc_style['EC_MONTH_LIST']['post'] = '';

$sc_style['EC_NEXT_YEAR']['pre'] = '';
$sc_style['EC_NEXT_YEAR']['post'] = '';


$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['time_table'] = "
<table cellpadding='0' cellspacing='1' class='table fborder'>
<tr>
	<td class='forumheader' style='width:18%; text-align:left'>{EC_PREV_MONTH}</td>
	<td class='fcaption' style='width:64%; text-align:center'>{EC_CURRENT_MONTH}</td>
	<td class='forumheader' style='width:18%; text-align:right'>{EC_NEXT_MONTH}</td>
</tr>\n
<tr>
	<td class='forumheader3' style='text-align:left'>{EC_PREV_YEAR}</td>
	<td class='fcaption' style='text-align:center; vertical-align:middle'>{EC_MONTH_LIST}</td>
	<td class='forumheader3' style='text-align:right'>{EC_NEXT_YEAR}</td>
</tr>\n
</table>";



// NAVIGATION BUTTONS
//$sc_style['NAV_LINKCURRENTMONTH']['pre'] = "<span class='btn button' style='width:120px; '>";
//$sc_style['NAV_LINKCURRENTMONTH']['post'] = "</span>";
$sc_style['EC_NAV_LINKCURRENTMONTH']['pre'] = "";
$sc_style['EC_NAV_LINKCURRENTMONTH']['post'] = "";

$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_navigation_table'] = "
<div style='text-align:center; margin-bottom:20px;'>
<form method='post' action='" . e_SELF . "?" . e_QUERY . "' id='calform'>
<table class='table'>
<tr>
<td style='text-align:center;'>{EC_NAV_CATEGORIES} {EC_NAV_BUT_ALLEVENTS} {EC_NAV_BUT_VIEWCAT} {EC_NAV_BUT_ENTEREVENT} {EC_NAV_BUT_SUBSCRIPTION} {EC_NAV_BUT_PRINTLISTS} {EC_NAV_LINKCURRENTMONTH}</td>
</tr>\n
</table>
</form>
</div>";



// EVENT LIST ------------------------------------------------------------
$sc_style['EC_EVENTLIST_CAPTION']['pre'] = "<tr><td class='fcaption' colspan='2'>";
$sc_style['EC_EVENTLIST_CAPTION']['post'] = ":<br /><br /></td></tr>\n";

$CALENDARBOOTSTRAP3_TEMPLATE['event']['eventlist_table_start'] = "<table class='table fborder eventlist_table_start'>{EC_EVENTLIST_CAPTION}";
$CALENDARBOOTSTRAP3_TEMPLATE['event']['eventlist_table_end'] = "</table>";



// EVENT ARCHIVE ------------------------------------------------------------
$sc_style['EC_EVENTARCHIVE_CAPTION']['pre'] = "<tr><td colspan='2' class='fcaption'>";
$sc_style['EC_EVENTARCHIVE_CAPTION']['post'] = "</td></tr>\n";

$CALENDARBOOTSTRAP3_TEMPLATE['event']['archive_table_start'] = "<br /><table class='table fborder archive_table_start'>{EC_EVENTARCHIVE_CAPTION}";


$CALENDARBOOTSTRAP3_TEMPLATE['event']['archive_table'] = "
<tr>
	<td style='width:35%; vertical-align:top' class='forumheader3'>{EC_EVENT_RECENT_ICON}{EC_EVENTARCHIVE_DATE}</td>
	<td style='width:65%' class='forumheader3'>{EC_EVENTARCHIVE_HEADING}</td>
</tr>\n";
//<br />{EVENTARCHIVE_DETAILS}
$CALENDARBOOTSTRAP3_TEMPLATE['event']['archive_table_empty'] = "<tr><td colspan='2' class='forumheader3'>{EC_EVENTARCHIVE_EMPTY}</td></tr>\n";
$CALENDARBOOTSTRAP3_TEMPLATE['event']['archive_table_end'] = "</table>";



// EVENT SHOW EVENT ------------------------------------------------------------
$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_table_start'] = "<table class='table fborder event_table_start'>";
$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_table_end'] = "</table>";

$sc_style['EC_EVENT_HEADING_DATE']['pre'] = "";
$sc_style['EC_EVENT_HEADING_DATE']['post'] = "";

$sc_style['EC_EVENT_DETAILS']['pre'] = "<tr><td colspan='2' class='forumheader3'>";
$sc_style['EC_EVENT_DETAILS']['post'] = "</td></tr>\n";

$sc_style['EC_EVENT_LOCATION']['pre'] = "<tr><td colspan='2' class='forumheader3'><b>".EC_LAN_32."</b> ";
$sc_style['EC_EVENT_LOCATION']['post'] = "</td></tr>";

$sc_style['EC_EVENT_AUTHOR']['pre'] = "<b>".EC_LAN_31."</b> ";
$sc_style['EC_EVENT_AUTHOR']['post'] = "&nbsp;";

$sc_style['EC_EVENT_CONTACT']['pre'] = "<b>".EC_LAN_33."</b> ";
$sc_style['EC_EVENT_CONTACT']['post'] = "&nbsp;";

$sc_style['EC_EVENT_THREAD']['pre'] = "<tr><td colspan='2' class='forumheader3'><span class='smalltext'>";
$sc_style['EC_EVENT_THREAD']['post'] = "</span></td></tr>\n";

$sc_style['EC_EVENT_CATEGORY']['pre'] = "<b>".EC_LAN_30."</b> ";
$sc_style['EC_EVENT_CATEGORY']['post'] = "&nbsp;";

$sc_style['EC_EVENT_DATE_START']['pre'] = '';
$sc_style['EC_EVENT_DATE_START']['post'] = '';

$sc_style['EC_EVENT_TIME_START']['pre'] = '';
$sc_style['EC_EVENT_TIME_START']['post'] = '';

$sc_style['EC_EVENT_DATE_END']['pre'] = '';
$sc_style['EC_EVENT_DATE_END']['post'] = '';

$sc_style['EC_EVENT_TIME_END']['pre'] = '';
$sc_style['EC_EVENT_TIME_END']['post'] = '';

$sc_style['EC_EVENT_EVENT_DATE_TIME']['pre'] =  "<b>".EC_LAN_29."</b> ";
$sc_style['EC_EVENT_EVENT_DATE_TIME']['post'] = '';

$sc_style['EC_IFNOT_ALLDAY']['pre'] = EC_LAN_144;
$sc_style['EC_IFNOT_ALLDAY']['post'] = "";

// The $EVENT_EVENT_DATETIME strings are used with the EC_EVENT_EVENT_DATE_TIME shortcode.
// There are four cases, each with a corresponding index into $EVENT_EVENT_DATETIME:
// 	0 - Normal event, starting and finishing on different dates (the 'original' default)
//	1 - Normal event, starting and finishing on the same day
//	2 - All-day event, starting and finishing on different days
//	3 - All-day event, starting and finishing on the same day
$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_datetime'][0]  = "{EC_EVENT_DATE_START}".EC_LAN_144."{EC_EVENT_TIME_START}<b>  ".EC_LAN_69."</b> {EC_EVENT_DATE_END}{EC_IFNOT_ALLDAY=EC_EVENT_TIME_END}";
$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_datetime'][1]  = "{EC_EVENT_DATE_START} ".EC_LAN_84." {EC_EVENT_TIME_START}".EC_LAN_85."{EC_EVENT_TIME_END}";
$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_datetime'][2]  = "{EC_EVENT_DATE_START} <b>".EC_LAN_69."</b> {EC_EVENT_DATE_END}";
$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_datetime'][3]  = "{EC_EVENT_DATE_START}";

$CALENDARBOOTSTRAP3_TEMPLATE['event']['event_table'] = "
<tr>
  <td >
	<a href='#{EC_EVENT_ID}' class='e-show-if-js e-expandit fcaption' style='display:inline-block; cursor:pointer; text-align:left; border:0px solid #000; width:100%' title='".EC_LAN_132."'>{EC_EVENT_RECENT_ICON}{EC_EVENT_CAT_ICON}{EC_EVENT_HEADING_DATE}{EC_IFNOT_ALLDAY=EC_EVENT_TIME_START}&nbsp;-&nbsp;{EC_EVENT_TITLE}</a>
	<div id='{EC_EVENT_ID}' {EC_EVENT_DISPLAYCLASS} style='padding-top:10px; padding-bottom:10px; text-align:left;'>
	  <table style='width:100%;'  cellspacing='0' cellpadding='0'>
		<tr><td colspan='2' class='forumheader3'>{EC_EVENT_AUTHOR} {EC_EVENT_CAT_ICON} {EC_EVENT_CATEGORY} {EC_EVENT_CONTACT} {EC_EVENT_OPTIONS}</td></tr>
		<tr><td colspan='2' class='forumheader3'>{EC_EVENT_EVENT_DATE_TIME}</td></tr>\n
		{EC_EVENT_LOCATION}
		{EC_EVENT_DETAILS}
		{EC_EVENT_THREAD}
	  </table>
	</div>
  </td>
</tr>\n
";

$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['time_table']  = " 
<div class='calendar-wrapper'>
  <div class='calendar-navigation'>
    <div class='row forumheader hidden-xs'>
      <div class='month-browser col-md-12  text-center '>
      	<button class='calendar_nav btn btn-default pull-left'>	{EC_PREV_MONTH} </button>
      	<button class='current-month btn btn-primary'>	<b>{EC_CURRENT_MONTH}</b> </button>	
        <button class='calendar_nav btn btn-default pull-right'>	{EC_NEXT_MONTH}		</button>
      </div>
    </div>   
    <div class='row forumheader visible-xs text-center'> 
      	<button class='calendar_nav btn btn-default col-xs-12'>	{EC_PREV_MONTH} </button>
      	<button class='current-month btn btn-primary col-xs-12'>	<b>{EC_CURRENT_MONTH}</b> </button>	
        <button class='calendar_nav btn btn-default col-xs-12'>	{EC_NEXT_MONTH}		</button>
    </div>
    <div class='row forumheader'>
      <div class='year-browser  col-md-12  text-center'>
      	<button class='calendar_nav btn btn-default pull-left'>	{EC_PREV_YEAR} </button>
      	<button class='current-month btn btn-default hidden-xs'>	<b>{EC_MONTH_LIST}</b> </button>	
        <button class='calendar_nav btn btn-default pull-right'>	{EC_NEXT_YEAR}	</button>
      </div>
    </div>
  </div>
 ";
 
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_start']        = "<div class='respcalendar'  >";
//header row
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_header_start'] = "<ul class='weekdays'>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_header']       = "<li class='day_of_week'>{EC_CALENDAR_CALENDAR_HEADER_DAY}</li>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_header_end']   = "</ul><ul class='days'>";
//end
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_end']          = "</div>";

$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_weekswitch']   = "</ul><ul class='days'>";
// empty day
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_day_non']      = "<li class='calendar-day out_of_range'> </li>";
//today
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_day_today']    = "
<li class='calendar-day'><div class='date day_cell'><em>{EC_CALENDAR_CALENDAR_DAY_TODAY_HEADING}  </span></em>";

//day has events
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_day_event']    = "
<li class='calendar-day'><div class='date day_cell'><b>{EC_CALENDAR_CALENDAR_DAY_EVENT_HEADING}</b>";

// display events ------------------------------------------------------------
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['showevent'] = "
  <div class='show-info forumheader'> {EC_SHOWEVENT_IMAGE} {EC_SHOWEVENT_INDICAT}  {EC_SHOWEVENT_HEADING}
    <div class='show-time'>
      {EC_CALENDAR_CALENDAR_RECENT_ICON}
    </div>
  </div> 
 ";
 
// end of timetable
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['time_table_end']         = "</div>"; 

// no events and not today
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_day_empty'] = "
<li class='calendar-day'><div class='date day_cell'>{EC_CALENDAR_CALENDAR_DAY_EMPTY_HEADING}   </div>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar']['calendar_day_end']   = "</li>";



//------------------------------------------
// Calendar menu - 'Small' calendar
//------------------------------------------
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['hdg_link_class'] = "class='forumlink'";			// Class, and optional style, for menu heading if its a clickable link

$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['start'] = '<div class="e107 e107-mini-calendar  text-center">';
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['table_start'] =  '<table class="table table-striped table-bordered">';	 

$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['end'] = "</table></div>";

// Blank cells at beginning and end
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_non'] = "<td class='case2 text-center'><div>&nbsp;</div></td>";  

//header row
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['header_start'] = '
<tr class="e107-mini-calendar-header">';
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['header_front'] = '<th class="text-center">';
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['header_back'] = "</th>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['header_end'] = "</tr><tr>";


$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['weekswitch'] = "</tr><tr>";

// Start and end CSS for date cells - six cases to decode, determined by array index:
//    	1 - Today, no events
//		2 - Some other day, no events
//		3 - Today with events
//		4 - Some other day with events
//		5 - today with events, one or more of which has recently been added/updated
//		6 - Some other day with events, one or more of which has recently been added/updated
// all classes can be rewritten in css with .e107-mini-calendar .case1  ... selectors 
 
//today, no events
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_start']['1'] = "<td class='case1 text-center bg-warning'><div>";

// no events and not today
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_start']['2'] = "<td class='case2 text-center'><div>";

//day has events - same whether its today or not
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_start']['3'] = "<td class='case3 text-center'><div>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_start']['4'] = "<td class='case4 text-center bg-info'><div>";
// day has events, one which is recently added/updated
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_start']['5'] = "<td class='case5 text-center bg-danger'><div>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_start']['6'] = "<td class='case6 text-center bg-success'><div>";
// Example highlight using background colour:
//$CALENDAR_MENU_DAY_START['5'] = "<td class='indent' style='width:14.28%; padding:1px; text-align:center; background-color: #FF8000;'>";
//$CALENDAR_MENU_DAY_START['6'] = "<td class='indent' style='width:14.28%; padding:1px; text-align:center; background-color: #FF0000; '>";
 
 
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_end']['1'] = "</div></td>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_end']['2'] = "</div></td>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_end']['3'] = "</div></td>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_end']['4'] = "</div></td>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_end']['5'] = "</div></td>";
$CALENDARBOOTSTRAP3_TEMPLATE['calendar_menu']['day_end']['6'] = "</div></td>";

//============================================================================
// Next event menu template
$CALENDARBOOTSTRAP3_WRAPPER['next_event_menu']['EC_NEXT_EVENT_TIME'] = EC_LAN_144."{---}";
$CALENDARBOOTSTRAP3_WRAPPER['next_event_menu']['EC_NEXT_EVENT_ICON'] = "<img class='img-responsive' src='{---}' alt='' />";

$CALENDARBOOTSTRAP3_TEMPLATE['next_event_menu']['cal_fe_line'] = "
{EC_NEXT_EVENT_RECENT_ICON}  
{EC_NEXT_EVENT_ICON}    
{EC_NEXT_EVENT_DATE}    
{EC_NEXT_EVENT_TIME}    
<br />
<strong>{EC_NEXT_EVENT_TITLE}</strong>
{EC_NEXT_EVENT_GAP}";
 
?>