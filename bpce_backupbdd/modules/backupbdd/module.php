<?php

$Module = array( 'name' => 'Backup BDD',
                 'variable_params' => true );

$ViewList = array();

$ViewList['list'] = array(
	"functions" => array( 'backupbdd' ),
    "script" => "list.php",
    "default_navigation_part" => 'ezbackupbddnavigationpart',
    "params" => array( ) );

$ViewList['download'] = array(
	"functions" => array( 'backupbdd' ),
    "script" => "download.php",
    "default_navigation_part" => 'ezbackupbddnavigationpart',
    "params" => array('bddfile' ) );

$ViewList['createbackupbdd'] = array(
	"functions" => array( 'backupbdd' ),
    "script" => "createbackupbdd.php",
    "default_navigation_part" => 'ezbackupbddnavigationpart',
    "params" => array('bddfile' ) );
		
	
$ViewList['delete'] = array(
	"functions" => array( 'backupbdd' ),
    "script" => "delete.php",
    "default_navigation_part" => 'ezbackupbddnavigationpart',
    "params" => array('bddfile' ) );
	
   /* "functions" => array( 'backupbdd' ),*/
$FunctionList = array();
$FunctionList['backupbdd'] = array( );

?>