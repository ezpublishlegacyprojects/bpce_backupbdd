<?php
$module = $Params['Module'];
$http = eZHTTPTool::instance();

include_once( 'kernel/common/template.php' );

$ini = eZINI::instance( 'site.ini' );
$vardir=$ini->variable( 'FileSettings', 'VarDir' );
$path=$vardir."/log/";
$i=-1;
eZDir::recursiveList($path, $path, $files);
foreach ($files as $file) {        
		if ($file['type'] != 'file') continue;
		$path_parts = pathinfo($file['name']);
		$filename=$path_parts['filename'];
		$extension=$path_parts['extension'];
		if ($extension != 'sql') continue;
		$i++;
		$date_save=explode("-",substr($filename,-15));
		$savebdd_timestamp=mktime($date_save[3]/100, 0, 0, $date_save[1], $date_save[2], $date_save[0]);
		$savebdd_name=substr($filename,0,strripos($filename,"_"));
		$savebdd_filename_original=$file['name'];
		$listebdd[$i]["savebdd_timestamp"]=	$savebdd_timestamp;
		$listebdd[$i]["savebdd_name"]=	$savebdd_name;
		$listebdd[$i]["savebdd_filename_original"]=	$savebdd_filename_original;
}
$tpl = templateInit();
$tpl->setVariable( 'title', 'Dump List' );
$tpl->setVariable( 'listebdd', $listebdd );

	
$Result = array();
$Result['content'] = $tpl->fetch( 'design:backupbdd/list.tpl' );
$Result['left_menu'] = 'design:parts/backupbdd/menu.tpl';
$Result['path'] = array( array( 'url' => false,'text' => ezi18n( 'bpce_backupbdd', 'Dump list' ) ) );

?>