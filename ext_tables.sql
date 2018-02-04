#
# Table structure for table 'tx_cal_event'
#
CREATE TABLE tx_cal_event (

	title varchar(255) DEFAULT '' NOT NULL,
	organizer int(11) unsigned DEFAULT '0',
	exception_event_group int(11) unsigned DEFAULT '0' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
	start DATETIME DEFAULT NULL NULL,
	stop DATETIME DEFAULT NULL NULL,
 INDEX `start` (`start`),
 INDEX `stop` (`stop`)
);


#
# Table structure for table 'tx_cal_organizer'
#
CREATE TABLE tx_cal_organizer (

	title varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_cal_exception_event'
#
CREATE TABLE tx_cal_exception_event (

	title varchar(255) DEFAULT '' NOT NULL,
	start_date date DEFAULT '0000-00-00',
	stop_date date DEFAULT '0000-00-00',

);

#
# Table structure for table 'tx_cal_exception_event_group'
#
CREATE TABLE tx_cal_exception_event_group (

	exception_event int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_cal_event'
#
CREATE TABLE tx_cal_event (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'tx_calendar_event_exceptioneventgroup_mm'
#
CREATE TABLE tx_calendar_event_exceptioneventgroup_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_cal_organizer'
#
CREATE TABLE tx_cal_organizer (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'tx_cal_exception_event'
#
CREATE TABLE tx_cal_exception_event (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'tx_calendar_exceptioneventgroup_exceptonevent_mm'
#
CREATE TABLE tx_calendar_exceptioneventgroup_exceptonevent_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
