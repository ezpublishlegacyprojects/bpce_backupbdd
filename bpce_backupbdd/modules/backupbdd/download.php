<?php
$module = $Params['Module'];
$file = $Params['bddfile'];
$ini = eZINI::instance( 'site.ini' );
$vardir=$ini->variable( 'FileSettings', 'VarDir' );
$path=$vardir."/log/";
header( 'Content-Description: File Transfer' );
header( 'Content-Type: application/octet-stream' );
header( 'Content-Disposition: attachment; filename='.$file );
header( 'Content-Transfer-Encoding: binary' );
header( 'Expires: 0' );
header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
header( 'Pragma: public' );
ob_clean();
flush();
readfile( $path.'/'.$file );
?>