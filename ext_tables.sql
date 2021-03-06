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

CREATE TABLE tx_cal_exception_event_mm (
	sorting_foreign int(11) DEFAULT '0' NOT NULL,
);


CREATE TABLE tx_cal_index (
	start DATETIME DEFAULT NULL NULL,
	stop DATETIME DEFAULT NULL NULL,
 INDEX `start` (`start`),
 INDEX `stop` (`stop`)
);

CREATE TABLE tx_cal_recurrence_index (
	uid int(11) unsigned NOT NULL auto_increment,
	tablename varchar(30) DEFAULT '' NOT NULL,
	start DATETIME DEFAULT NULL NULL,
	stop DATETIME DEFAULT NULL NULL,
	event_uid int(11) DEFAULT '-1' NOT NULL,
	event_deviation_uid int(11) DEFAULT '-1' NOT NULL,
	PRIMARY KEY (uid),
	KEY start (start),
	KEY event_uid (event_uid),
	KEY event_uid_start (event_uid,start)

	);



#
# Table structure for table 'tx_cal_organizer'
#
CREATE TABLE tx_cal_organizer (

	title varchar(255) DEFAULT '' NOT NULL

);

#
# Table structure for table 'tx_cal_exception_event'
#
CREATE TABLE tx_cal_exception_event (

	title varchar(255) DEFAULT '' NOT NULL,
	tx_extbase_type varchar(255) DEFAULT '' NOT NULL,
	start DATE DEFAULT NULL NULL,
	stop DATE DEFAULT NULL NULL,
 INDEX `start` (`start`),
 INDEX `stop` (`stop`)

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

