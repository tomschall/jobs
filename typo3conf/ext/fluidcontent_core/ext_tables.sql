#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	content_options text,
	content_variant varchar(255) default NULL,
	content_version varchar(255) default NULL,
    header_position varchar(6) DEFAULT '' NOT NULL,
    table_bgColor int(11) unsigned DEFAULT '0' NOT NULL,
    table_border tinyint(3) unsigned DEFAULT '0' NOT NULL,
    table_cellpadding tinyint(3) unsigned DEFAULT '0' NOT NULL,
    table_cellspacing tinyint(3) unsigned DEFAULT '0' NOT NULL
);
