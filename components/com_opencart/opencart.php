<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$app = JFactory::getApplication();

if(!isset($_GET["view"]) && isset($_REQUEST["view"]))
$_GET["view"]=$_REQUEST["view"];
if(!isset($_GET["route"]) && isset($_REQUEST["route"]))
$_GET["route"]=$_REQUEST["route"];
if(!isset($_GET["Itemid"]) && isset($_REQUEST["Itemid"]))
$_GET["Itemid"]=$_REQUEST["Itemid"];

if(!isset($_GET["route"]) && isset($_GET["view"])){
	if(isset($_GET["Itemid"])){
		//$cur_menu = JSite::getMenu();
		$cur_menu = $app->getMenu();
                $cur_params = $cur_menu->getParams($_GET["Itemid"]);		
	}
	
	if($_GET["view"]=="home")
		$_GET["route"]="common/home";
	elseif($_GET["view"]=="account")
		$_GET["route"]="account/account";
	elseif($_GET["view"]=="cart")
		$_GET["route"]="checkout/cart";
	elseif($_GET["view"]=="checkout")
		$_GET["route"]="checkout/checkout";
	elseif($_GET["view"]=="wishlist")
		$_GET["route"]="account/wishlist";
	elseif($_GET["view"]=="contact")
		$_GET["route"]="information/contact";
	elseif($_GET["view"]=="products" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["product_id"]=$cur_params->get('product_id');
		$_GET["route"]="product/product";
	}
	elseif($_GET["view"]=="categories" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["path"]=$cur_params->get('category_path');
		$_GET["route"]='product/category';
	}
	elseif($_GET["view"]=="manufacturers" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["manufacturer_id"]=$cur_params->get('manufacturer_id');
		$_GET["route"]='product/manufacturer/info';
	}
	elseif($_GET["view"]=="information" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["information_id"]=$cur_params->get('information_id');
		$_GET["route"]='information/information';
	}
	elseif($_GET["view"]=="others" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["route"]=$cur_params->get('route');		
	}
}
if(isset($_REQUEST["route"]) && $_REQUEST["route"]=="common/login")
$_GET["view"]="admin";
if((isset($_GET["view"]) && $_GET["view"]=="admin" ) || (isset($_GET["token"]) && isset($_SESSION["show_admin"]))){	
	// start admin panel for frontend
	if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
		// Access check. for joomla 1.6
		if (!JFactory::getUser()->authorise('core.manage', 'com_opencart'))
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
	}
	if(!defined("ITEM_ID")){
		if(defined("ITEMID"))
			define('ITEM_ID', 'Itemid='.ITEMID.'&');
		elseif(isset($_REQUEST["Itemid"])){
			define('ITEM_ID', 'Itemid='.$_REQUEST["Itemid"].'&');
			define('ITEMID',''.$_REQUEST["Itemid"].'');
		}
		else
			define('ITEM_ID', '');
	}
	$_SESSION["show_admin"]="Yes";
	define('HTTP_SERVER', JURI::base());
	require_once('./components/com_opencart/admin/config.php');	
	//echo opencart output in joomla
	global $replace_outputs_array;
	ob_start();
	$pgn=isset($_REQUEST["pgn"])?$_REQUEST["pgn"]:"index";
	if(file_exists("./components/com_opencart/admin/".$pgn.".php"))
		require_once("./components/com_opencart/admin/".$pgn.".php");
	else
		echo "<h1><b>File Not Found</b></h1>";
	
	$replace_outputs_array["../components/com_opencart/admin/"]="components/com_opencart/admin/";
	$replace_outputs_array["option=com_opencart"]="option=com_opencart&view=admin";
	$output = ob_get_contents();
	ob_end_clean();

	foreach($replace_outputs_array as $key=>$value){
		$output=str_replace($key,$value,$output);
	}
	global $replace_outputs_check_array;
	
	foreach($replace_outputs_check_array as $single_array){
		if(!strstr($output,$single_array["existing_var"])){
			$output=str_replace($single_array["search"],$single_array["replace"],$output);
		}
	}
	echo $output;
	// end admin panel for frontend
}
else{
	unset($_SESSION["show_admin"]);
	require_once(dirname(__FILE__).'/config.php');
	ob_start();
	$pgn=isset($_REQUEST["pgn"])?$_REQUEST["pgn"]:"index";
	if(file_exists(dirname(__FILE__)."/".$pgn.".php"))
		require_once(dirname(__FILE__)."/".$pgn.".php");
	else
		echo "<h1><b>File Not Found</b></h1>";
	$output = ob_get_contents();
	ob_end_clean();
	
	global $replace_output_array;
	foreach($replace_output_array as $key=>$value){
		if(defined("HTTP_SERVER_TEMP") && defined("HTTP_SERVER") && HTTP_SERVER!=HTTP_SERVER_TEMP && !defined("REDIRECT_HTTP_SERVER"))
		$value=str_replace(HTTP_SERVER_TEMP,HTTP_SERVER,$value);
		
		$output=str_replace($key,$value,$output);			
	}
	
	global $replace_output_check_array;
	foreach($replace_output_check_array as $single_array){
		if(!strstr($output,$single_array["existing_var"])){
			if(defined("HTTP_SERVER_TEMP") && defined("HTTP_SERVER") && HTTP_SERVER!=HTTP_SERVER_TEMP && !defined("REDIRECT_HTTP_SERVER"))
			$single_array["replace"]=str_replace(HTTP_SERVER_TEMP,HTTP_SERVER,$single_array["replace"]);	
		
			$output=str_replace($single_array["search"],$single_array["replace"],$output);		
		}	
	}
	
	echo $output;
	
	if (isset($_REQUEST['tmpl'])) {
		if($_REQUEST['tmpl']=="component")
			exit();
	}

}


?>