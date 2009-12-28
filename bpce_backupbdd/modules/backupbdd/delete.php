<?php
$module = $Params['Module'];
$http = eZHTTPTool::instance();
$file = $Params['bddfile'];
$ini = eZINI::instance( 'site.ini' );
$vardir=$ini->variable( 'FileSettings', 'VarDir' );
$path=$vardir."/log/";
$result=unlink( $path.'/'.$file );
$result=unlink( $path.'/'.$file.".gz" );
include_once( 'kernel/common/template.php' );
$tpl = templateInit();
$tpl->setVariable( 'title', 'Deletion of '.$file );
$tpl->setVariable( 'texte', $result );
	
$Result = array();
$Result['content'] = $tpl->fetch( 'design:backupbdd/delete.tpl' );
$Result['left_menu'] = 'design:parts/backupbdd/menu.tpl';
$Result['path'] = array( array( 'url' => false,'text' => ezi18n( 'bpce_backupbdd', 'Dump list' ) ) );

?>