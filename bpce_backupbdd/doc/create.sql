DROP TABLE IF EXISTS bpce_backupbdd;
CREATE TABLE bpce_backupbdd(
	id 				int(11) 		NOT NULL auto_increment,
	base			varchar(255) 	NOT NULL default '',
	description		varchar(64) 	NOT NULL default '',
	date_package  int(11)    NOT NULL,
	PRIMARY KEY( id )
);