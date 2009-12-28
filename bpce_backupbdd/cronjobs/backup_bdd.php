<?php
/**
 * Cronjob that will export all classes definition as a package file.
 * Will only update the package if classes have been modified since last version
 *
 * @version $Id$
 * @copyright 2009
 *
 * @todo add an ini file to get the parameters from
 */
$ini = eZINI::instance( 'site.ini' );
$vardir=$ini->variable( 'FileSettings', 'VarDir' );
$creationFileName = $vardir.'/log/creation.txt';
if( file_exists( $creationFileName )){
	if( file_exists( $vardir.'/log/lock2.txt' )){
		if ( !$isQuiet ) $cli->output( 'Save already launched' );		
	}else{
		$lockFileName = $vardir.'/log/lock2.txt';
		$ourFileHandle = fopen($lockFileName, 'x+') or die("can't open file");
		fwrite($ourFileHandle, "test");
		fclose($ourFileHandle);
		$dbhost=$ini->variable( 'DatabaseSettings', 'Server' );
		$dbuser=$ini->variable( 'DatabaseSettings', 'User' );
		$dbpass=$ini->variable( 'DatabaseSettings', 'Password' );
		$dbname=$ini->variable( 'DatabaseSettings', 'Database' );
		$backupFile = $vardir."/log/".$dbname ."_". date("Y-m-d-H")."00". '.sql';
		if( is_file( $backupFile ) or is_file( $backupFile.".gz" ) ){
			if ( !$isQuiet ) $cli->output( ' bdd ' . $backupFile .' already saved');		
		}else{
			if( strtoupper (substr(PHP_OS, 0,3)) == 'WIN' ) {
				$command = "mysqldump.exe --opt -h $dbhost -u $dbuser ";
				if ($dbpass!=""){
				$command .= "-p$dbpass";
				}
				$command .= " $dbname > $backupFile";
			} else {
				$backupFile .= '.gz';
				$command = "mysqldump --opt -h $dbhost -u $dbuser ";
				if ($dbpass!=""){
				$command .= "-p$dbpass";
				}
				$command .= " $dbname | gzip > $backupFile";
			}		
			if ( !$isQuiet ) $cli->output( $command);
			system($command);
			if ( !$isQuiet ) $cli->output( 'Saved bdd ' . $backupFile );		
		}
		$fileini = eZINI::instance( 'file.ini' );
		$iscluster=$fileini->variable( 'ClusteringSettings', 'FileHandler' );
		if( ( $iscluster=="eZDBFileHandler" ) ){
			$dbhost=$fileini->variable( 'ClusteringSettings', 'DBHost' );
			$dbuser=$fileini->variable( 'ClusteringSettings', 'DBUser' );
			$dbpass=$fileini->variable( 'ClusteringSettings', 'DBPassword' );
			$dbname=$fileini->variable( 'ClusteringSettings', 'DBName' );
			$backupFile = $vardir."/sql/".$dbname ."_". date("Y-m-d-H")."00". '.sql';
			if( is_file( $backupFile ) or is_file( $backupFile.".gz" ) ){
				if ( !$isQuiet ) $cli->output( ' bdd ' . $backupFile .' already saved');		
			}else{
				if( strtoupper (substr(PHP_OS, 0,3)) == 'WIN' ) {
					$command = "mysqldump.exe --opt -h $dbhost -u $dbuser ";
					if ($dbpass!=""){
					$command .= "-p$dbpass ";
					}
					$command .= " $dbname > $backupFile";
				} else {
					$backupFile .= '.gz';
					$command = "mysqldump --opt -h $dbhost -u $dbuser ";
					if ($dbpass!=""){
					$command .= "-p$dbpass";
					}
					$command .= " $dbname | gzip > $backupFile";
				}		
				if ( !$isQuiet ) $cli->output( $command);
				system($command);
				if ( !$isQuiet ) $cli->output( 'Saved bdd ' . $backupFile );		
			}
		}
		unlink($lockFileName);
		unlink($creationFileName);
	}	
}else{
	if ( !$isQuiet ) $cli->output( 'No process launch' );	
}
		
		
		
?>