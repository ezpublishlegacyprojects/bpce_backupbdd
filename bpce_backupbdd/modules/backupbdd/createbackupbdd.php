<?php
$module = $Params['Module'];
$http = eZHTTPTool::instance();

include_once( 'kernel/common/template.php' );
$tpl = templateInit();
$tpl->setVariable( 'title', 'Launch of save process' );

$ini = eZINI::instance( 'site.ini' );
$vardir=$ini->variable( 'FileSettings', 'VarDir' );
$ourFileName = $vardir.'/log/creation.txt';
if (file_exists($ourFileName)){
$tpl->setVariable( 'texte', 'in process' );
}else{
$ourFileHandle = fopen($ourFileName, 'x+') or die("can't open file");
fwrite($ourFileHandle, "test");
fclose($ourFileHandle);
$tpl->setVariable( 'texte', 'Launched' );
}
$Result = array();
$Result['content'] = $tpl->fetch( 'design:backupbdd/createbackupbdd.tpl' );
$Result['left_menu'] = 'design:parts/backupbdd/menu.tpl';
$Result['path'] = array( array( 'url' => false,'text' => ezi18n( 'bpce_backupbdd', 'liste' ) ) );

?>