<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
	if($use_separate_db!="Yes"){
		require_once(JPATH_SITE."/configuration.php");	
		$j_config=new JConfig();	
		$host=$j_config->host;
		$user=$j_config->user;
		$pass=$j_config->password;
		$dbname=$j_config->db;
	}
	$con=mysql_connect($host,$user,$pass);
	if($con!=false){
		mysql_select_db($dbname,$con);
	}
	if($db_file_name!="")
	$filename=dirname(__FILE__).$db_file_name;
	else
	$filename=dirname(__FILE__)."/install.sql";		
	$ignoreerrors=true;
	$file_content = file($filename);
	$query = "";
	foreach($file_content as $sql_line) {
		$tsl = trim($sql_line);
		if (($tsl != "") && (strpos($tsl, "--") != 0 || strpos($tsl, "--") != 1) && (substr($tsl, 0, 1) != "#")) {
			$query .= $sql_line;
			if(preg_match("/;\s*$/", $sql_line)) {
				//echo $query;
				$result = mysql_query($query);
				if (!$result && !$ignoreerrors) die(mysql_error());
				if (!$result){
					$sqlErrorCode = mysql_errno();
					$sqlErrorText = mysql_error();
					echo $sqlErrorCode.$sqlErrorText;			
				}
				$query = "";
			}
		}
	}
?>
