CREATE TABLE event (
	event_id int(11) unsigned NOT NULL auto_increment,
	event_start int(10) NOT NULL default '0',
	event_end int(10) NOT NULL default '0',
	event_allday tinyint(1) unsigned NOT NULL default '0',
	event_recurring tinyint(1) unsigned NOT NULL default '0',
	event_datestamp int(10) unsigned NOT NULL default '0',
	event_title varchar(200) NOT NULL default '',
	event_location text NOT NULL,
	event_details text NOT NULL,
	event_author varchar(100) NOT NULL default '',
	event_contact varchar(200) NOT NULL default '',
	event_category smallint(5) unsigned NOT NULL default '0',
	event_thread varchar(100) NOT NULL default '',
	event_rec_m tinyint(2) unsigned NOT NULL default '0',
	event_rec_y tinyint(2) unsigned NOT NULL default '0',
	PRIMARY KEY  (event_id),
	KEY event_start (event_start)
	) ENGINE=MyISAM;
	CREATE TABLE event_cat (
	event_cat_id smallint(5) unsigned NOT NULL auto_increment,
	event_cat_name varchar(100) NOT NULL default '',
	event_cat_icon varchar(100) NOT NULL default '',
	event_cat_class int(10) unsigned NOT NULL default '0',
	event_cat_subs tinyint(3) unsigned NOT NULL default '0',
	event_cat_ahead tinyint(3) unsigned NOT NULL default '0',
	event_cat_msg1 text,
	event_cat_msg2 text,
	event_cat_notify  tinyint(3) unsigned NOT NULL default '0',
	event_cat_last int(10) unsigned NOT NULL default '0',
	event_cat_today int(10) unsigned NOT NULL default '0',
	event_cat_lastupdate int(10) unsigned NOT NULL default '0',
	event_cat_addclass int(10) unsigned NOT NULL default '0',
	event_cat_description text,
	event_cat_force_class int(10) unsigned NOT NULL default '0',
	PRIMARY KEY  (event_cat_id)
	) ENGINE=MyISAM;
	CREATE TABLE event_subs (
	event_subid int(10) unsigned NOT NULL auto_increment,
	event_userid  int(10) unsigned NOT NULL default '0',
	event_cat  int(10) unsigned NOT NULL default '0',
	PRIMARY KEY  (event_subid)
	) ENGINE=MyISAM;
