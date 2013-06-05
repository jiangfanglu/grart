<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//Uncomment and change as required the following settings if you need custom settings for multistore or connect to another opencart installation etc.

//define('USE_JOOMLA_BUTTONS','0');
//define('DONT_SHOW_HEADER_JCART','0');
define('DONT_SHOW_FOOTER_JCART','1');
define('DONT_SHOW_MENUS_JCART','0');
//define('ENABLE_VQMOD_JCART','0');
//define('ENABLE_VQMOD_USECACHE','0');
//define('SHOP_SEO_KEY','shop'); // don't change it,if you change it then you need to change shop keyword in .httaccess file also
//define('ITEMID','');
//define('MAIN_HTTP_SERVER', '');
//define('USE_MANUL_DB', '0');
//define('DB_DRIVER', 'mysql');
//define('DB_HOSTNAME', '');
//define('DB_USERNAME', '');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', '');
//define('DB_PREFIX', 'oc_');
define('DB_PREFIX_JOOMLA', 'z2act_');

if(!defined("DS") && defined("DIRECTORY_SEPARATOR"))
define("DS",DIRECTORY_SEPARATOR);

$main_dir=JPATH_SITE.DS;
$main_full_url=JURI::base();

$j_config=new JConfig();

define('HTTP_SERVER_TEMP', $main_full_url);

$mycom_params =  JComponentHelper::getParams('com_opencart');
//start get params
$shopSeoKey="";
$itemID="";
$useJoomlaButton="";
$dontShowHeaderjCart="";
$dontShowFooterjCart="";
$dontShowMenusjCart="";
$enableVqmodForjCart="";
$enableVqmodUseCache="";
$dontIncludejQueryLibrary="";
$dontShowLeftRightColumn="";
$mainHttpServer="";
$redirectToMainHttpServer="";
$useJoomlaDB="1";
$dbuserName="";
$dbuserPassword="";
$dbuserHost="";
$dbName="";
$dbuserPrefix="";
$useCustomColor="";
$defaultTxtColor="";
$defaultButtonBoxColor="";
$defaultButtonHoverColor="";


if(version_compare(JVERSION, '1.6.0', '<' ) == 1){
	if($mycom_params->get('shopSeoKey')!=""){
		$shopSeoKey=$mycom_params->get('shopSeoKey');
	}
	if($mycom_params->get('itemID')!=""){
		$itemID=$mycom_params->get('itemID');
	}
	if($mycom_params->get('useJoomlaButton')!=""){
		$useJoomlaButton=$mycom_params->get('useJoomlaButton');
	}
	if($mycom_params->get('dontShowHeaderjCart')!=""){
		$dontShowHeaderjCart=$mycom_params->get('dontShowHeaderjCart');
	}
	if($mycom_params->get('dontShowFooterjCart')!=""){
		$dontShowFooterjCart=$mycom_params->get('dontShowFooterjCart');
	}
	if($mycom_params->get('dontShowMenusjCart')!=""){
		$dontShowMenusjCart=$mycom_params->get('dontShowMenusjCart');
	}
	if($mycom_params->get('enableVqmodForjCart')!=""){
		$enableVqmodForjCart=$mycom_params->get('enableVqmodForjCart');
	}
	if($mycom_params->get('enableVqmodUseCache')!=""){
		$enableVqmodUseCache=$mycom_params->get('enableVqmodUseCache');
	}
	if($mycom_params->get('dontIncludejQueryLibrary')!=""){
		$dontIncludejQueryLibrary=$mycom_params->get('dontIncludejQueryLibrary');
	}
	if($mycom_params->get('dontShowLeftRightColumn')!=""){
		$dontShowLeftRightColumn=$mycom_params->get('dontShowLeftRightColumn');
	}
	if($mycom_params->get('mainHttpServer')!=""){
		$mainHttpServer=$mycom_params->get('mainHttpServer');
	}
	if($mycom_params->get('redirectToMainHttpServer')!=""){
		$redirectToMainHttpServer=$mycom_params->get('redirectToMainHttpServer');
	}
	if($mycom_params->get('useJoomlaDB')!=""){
		$useJoomlaDB=$mycom_params->get('useJoomlaDB');
	}
	if($mycom_params->get('dbuserName')!=""){
		$dbuserName=$mycom_params->get('dbuserName');
	}
	if($mycom_params->get('dbuserPassword')!=""){
		$dbuserPassword=$mycom_params->get('dbuserPassword');
	}
	if($mycom_params->get('dbuserHost')!=""){
		$dbuserHost=$mycom_params->get('dbuserHost');
	}
	if($mycom_params->get('dbName')!=""){
		$dbName=$mycom_params->get('dbName');
	}
	if($mycom_params->get('dbuserPrefix')!=""){
		$dbuserPrefix=$mycom_params->get('dbuserPrefix');
	}
	if($mycom_params->get('useCustomColor')!=""){
		$useCustomColor=$mycom_params->get('useCustomColor');
	}
	if($mycom_params->get('defaultTxtColor')!=""){
		$defaultTxtColor=$mycom_params->get('defaultTxtColor');
	}
	if($mycom_params->get('defaultButtonBoxColor')!=""){
		$defaultButtonBoxColor=$mycom_params->get('defaultButtonBoxColor');
	}
	if($mycom_params->get('defaultButtonHoverColor')!=""){
		$defaultButtonHoverColor=$mycom_params->get('defaultButtonHoverColor');
	}
}
else{
	if($mycom_params->get('params.shopSeoKey')!=""){
		$shopSeoKey=$mycom_params->get('params.shopSeoKey');
	}
	if($mycom_params->get('params.itemID')!=""){
		$itemID=$mycom_params->get('params.itemID');
	}
	if($mycom_params->get('params.useJoomlaButton')!=""){
		$useJoomlaButton=$mycom_params->get('params.useJoomlaButton');
	}
	if($mycom_params->get('params.dontShowHeaderjCart')!=""){
		$dontShowHeaderjCart=$mycom_params->get('params.dontShowHeaderjCart');
	}
	if($mycom_params->get('params.dontShowFooterjCart')!=""){
		$dontShowFooterjCart=$mycom_params->get('params.dontShowFooterjCart');
	}
	if($mycom_params->get('params.dontShowMenusjCart')!=""){
		$dontShowMenusjCart=$mycom_params->get('params.dontShowMenusjCart');
	}
	if($mycom_params->get('params.enableVqmodForjCart')!=""){
		$enableVqmodForjCart=$mycom_params->get('params.enableVqmodForjCart');
	}
	if($mycom_params->get('params.enableVqmodUseCache')!=""){
		$enableVqmodUseCache=$mycom_params->get('params.enableVqmodUseCache');
	}
	if($mycom_params->get('params.dontIncludejQueryLibrary')!=""){
		$dontIncludejQueryLibrary=$mycom_params->get('params.dontIncludejQueryLibrary');
	}
	if($mycom_params->get('params.dontShowLeftRightColumn')!=""){
		$dontShowLeftRightColumn=$mycom_params->get('params.dontShowLeftRightColumn');
	}
	if($mycom_params->get('params.mainHttpServer')!=""){
		$mainHttpServer=$mycom_params->get('params.mainHttpServer');
	}
	if($mycom_params->get('params.redirectToMainHttpServer')!=""){
		$redirectToMainHttpServer=$mycom_params->get('params.redirectToMainHttpServer');
	}
	if($mycom_params->get('params.useJoomlaDB')!=""){
		$useJoomlaDB=$mycom_params->get('params.useJoomlaDB');
	}
	if($mycom_params->get('params.dbuserName')!=""){
		$dbuserName=$mycom_params->get('params.dbuserName');
	}
	if($mycom_params->get('params.dbuserPassword')!=""){
		$dbuserPassword=$mycom_params->get('params.dbuserPassword');
	}
	if($mycom_params->get('params.dbuserHost')!=""){
		$dbuserHost=$mycom_params->get('params.dbuserHost');
	}
	if($mycom_params->get('params.dbName')!=""){
		$dbName=$mycom_params->get('params.dbName');
	}
	if($mycom_params->get('params.dbuserPrefix')!=""){
		$dbuserPrefix=$mycom_params->get('params.dbuserPrefix');
	}
	if($mycom_params->get('params.defaultTxtColor')!=""){
		$defaultTxtColor=$mycom_params->get('params.defaultTxtColor');
	}
	if($mycom_params->get('params.useCustomColor')!=""){
		$useCustomColor=$mycom_params->get('params.useCustomColor');
	}
	if($mycom_params->get('params.defaultButtonBoxColor')!=""){
		$defaultButtonBoxColor=$mycom_params->get('params.defaultButtonBoxColor');
	}
	if($mycom_params->get('params.defaultButtonHoverColor')!=""){
		$defaultButtonHoverColor=$mycom_params->get('params.defaultButtonHoverColor');
	}

}
//end get params

// assing params to defined varialbes

if(!defined("SHOP_SEO_KEY") && $shopSeoKey!=""){
	define('SHOP_SEO_KEY', $shopSeoKey);
}
elseif(!defined("SHOP_SEO_KEY")){
	define('SHOP_SEO_KEY','shop');
}

if(!defined("ITEMID") && $itemID!=""){
	define('ITEMID', $itemID);
}

if(!defined("USE_JOOMLA_BUTTONS") && $useJoomlaButton!=""){
	define('USE_JOOMLA_BUTTONS', $useJoomlaButton);
}
elseif(!defined("USE_JOOMLA_BUTTONS")){
	define('USE_JOOMLA_BUTTONS', "0");
}

if(!defined("DONT_SHOW_HEADER_JCART") && $dontShowHeaderjCart!=""){
	define('DONT_SHOW_HEADER_JCART', $dontShowHeaderjCart);
}
elseif(!defined("DONT_SHOW_HEADER_JCART")){
	define('DONT_SHOW_HEADER_JCART', "0");
}

if(!defined("DONT_SHOW_FOOTER_JCART") && $dontShowFooterjCart!=""){
	define('DONT_SHOW_FOOTER_JCART', $dontShowFooterjCart);
}
elseif(!defined("DONT_SHOW_FOOTER_JCART")){
	define('DONT_SHOW_FOOTER_JCART', "0");
}

if(!defined("DONT_SHOW_MENUS_JCART") && $dontShowMenusjCart!=""){
	define('DONT_SHOW_MENUS_JCART', $dontShowMenusjCart);
}
elseif(!defined("DONT_SHOW_MENUS_JCART")){
	define('DONT_SHOW_MENUS_JCART', "1");
}

if(!defined("ENABLE_VQMOD_JCART") && $enableVqmodForjCart!=""){
	define('ENABLE_VQMOD_JCART', $enableVqmodForjCart);
}
elseif(!defined("ENABLE_VQMOD_JCART")){
	define('ENABLE_VQMOD_JCART', "0");
}

if(!defined("ENABLE_VQMOD_USECACHE") && $enableVqmodUseCache!=""){
	define('ENABLE_VQMOD_USECACHE', $enableVqmodUseCache);
}
elseif(!defined("ENABLE_VQMOD_USECACHE")){
	define('ENABLE_VQMOD_USECACHE', "0");
}


if(!defined("DONT_INCLUDE_JQUERY_JCART") && $dontIncludejQueryLibrary!=""){
	define('DONT_INCLUDE_JQUERY_JCART', $dontIncludejQueryLibrary);
}
elseif(!defined("DONT_INCLUDE_JQUERY_JCART")){
	define('DONT_INCLUDE_JQUERY_JCART', "0");
}

if(!defined("DONT_SHOW_LEFTRIGHT_COLUMN") && $dontShowLeftRightColumn!=""){
	define('DONT_SHOW_LEFTRIGHT_COLUMN', $dontShowLeftRightColumn);
}
elseif(!defined("DONT_SHOW_LEFTRIGHT_COLUMN")){
	define('DONT_SHOW_LEFTRIGHT_COLUMN', "1");
}

if(!defined("MAIN_HTTP_SERVER") && $mainHttpServer!=""){
	define('MAIN_HTTP_SERVER', $mainHttpServer);
}


if(!defined("USE_CUSTOM_COLOR_TEMPLATE") && $useCustomColor!=""){
	define('USE_CUSTOM_COLOR_TEMPLATE', $useCustomColor);
}
elseif(!defined("USE_CUSTOM_COLOR_TEMPLATE")){
	define('USE_CUSTOM_COLOR_TEMPLATE', "0");
}
if(!defined("DEFAULT_TXT_COLOR_TEMPLATE") && $defaultTxtColor!=""){
	define('DEFAULT_TXT_COLOR_TEMPLATE', $defaultTxtColor);
}
elseif(!defined("DEFAULT_TXT_COLOR_TEMPLATE")){
	define('DEFAULT_TXT_COLOR_TEMPLATE', "999999");
}
if(!defined("DEFAULT_BUTTONBOX_COLOR_TEMPLATE") && $defaultButtonBoxColor!=""){
	define('DEFAULT_BUTTONBOX_COLOR_TEMPLATE', $defaultButtonBoxColor);
}
elseif(!defined("DEFAULT_BUTTONBOX_COLOR_TEMPLATE")){
	define('DEFAULT_BUTTONBOX_COLOR_TEMPLATE', "00A7E5");
}
if(!defined("DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE") && $defaultButtonHoverColor!=""){
	define('DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE', $defaultButtonHoverColor);
}
elseif(!defined("DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE")){
	define('DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE', "267799");
}


if($redirectToMainHttpServer!="" && $redirectToMainHttpServer=="1" && defined("MAIN_HTTP_SERVER") && !defined("HTTP_SERVER")){
	define('HTTP_SERVER', MAIN_HTTP_SERVER);
	define('HTTP_IMAGE', HTTP_SERVER_TEMP."components/com_opencart/image/");
	define('REDIRECT_HTTP_SERVER', "Yes");
}

if(!defined("USE_MANUL_DB") && $useJoomlaDB=="0"){
	define('USE_MANUL_DB', '1');
}
elseif(!defined("USE_MANUL_DB")){
	define('USE_MANUL_DB', '0');
}

if(defined("USE_MANUL_DB") && USE_MANUL_DB=="1"){
	if(!defined("DB_DRIVER"))
	define('DB_DRIVER', 'mysql');
	if(!defined("DB_USERNAME"))
	define('DB_USERNAME', $dbuserName);
	if(!defined("DB_PASSWORD"))
	define('DB_PASSWORD', $dbuserPassword);
	if(!defined("DB_HOSTNAME"))
	define('DB_HOSTNAME', $dbuserHost);
	if(!defined("DB_DATABASE"))
	define('DB_DATABASE', $dbName);
	if(!defined("DB_PREFIX"))
	define('DB_PREFIX', $dbuserPrefix);
}
else{
	if(!defined("DB_DRIVER"))
	define('DB_DRIVER', 'mysql');
	if(!defined("DB_USERNAME"))
	define('DB_USERNAME', $j_config->user);
	if(!defined("DB_PASSWORD"))
	define('DB_PASSWORD', $j_config->password);
	if(!defined("DB_HOSTNAME"))
	define('DB_HOSTNAME', $j_config->host);
	if(!defined("DB_DATABASE"))
	define('DB_DATABASE', $j_config->db);
	if(!defined("DB_PREFIX"))
	define('DB_PREFIX', 'oc_');
}

// DIR
if(!defined("DIR_APPLICATION"))
define('DIR_APPLICATION', $main_dir.'components/com_opencart/catalog/');

if(!defined("DIR_SYSTEM"))
define('DIR_SYSTEM', $main_dir.'components/com_opencart/system/');

if(!defined("DIR_DATABASE"))
define('DIR_DATABASE', $main_dir.'components/com_opencart/system/database/');

if(!defined("DIR_LANGUAGE"))
define('DIR_LANGUAGE', $main_dir.'components/com_opencart/catalog/language/');

if(!defined("DIR_TEMPLATE") && !defined("DIR_DEFAULT_TEMPLATE"))
define('DIR_TEMPLATE', $main_dir.'components/com_opencart/catalog/view/theme/');

if(!defined("DIR_CONFIG"))
define('DIR_CONFIG', $main_dir.'components/com_opencart/system/config/');

if(!defined("DIR_IMAGE"))
define('DIR_IMAGE', $main_dir.'components/com_opencart/image/');

if(!defined("DIR_CACHE"))
define('DIR_CACHE', $main_dir.'components/com_opencart/system/cache/');

if(!defined("DIR_DOWNLOAD"))
define('DIR_DOWNLOAD', $main_dir.'components/com_opencart/download/');

if(!defined("DIR_LOGS"))
define('DIR_LOGS', $main_dir.'components/com_opencart/system/logs/');

if(defined("ITEMID"))
	define('ITEM_ID', 'Itemid='.ITEMID.'&');
elseif(isset($_REQUEST["Itemid"])){
	define('ITEM_ID', 'Itemid='.$_REQUEST["Itemid"].'&');
	define('ITEMID',''.$_REQUEST["Itemid"].'');
}
else
	define('ITEM_ID', '');

global $replace_output_array;
$replace_output_array=array(
			'index.php?route='=>'index.php?option=com_opencart&'.ITEM_ID.'route=',
			'index.php?option=com_opencart&route=module/manufacturer/css'=>'index.php?option=com_opencart&tmpl=component&route=module/manufacturer/css',
			'catalog/view/javascript/jquery/thickbox/thickbox-compressed.js'=>'catalog/view/javascript/jquery/thickbox/thickbox.js',
			'"catalog/'=>'"'.HTTP_SERVER_TEMP.'components/com_opencart/catalog/',
			'=\"catalog'=>'=\"'.HTTP_SERVER_TEMP.'components/com_opencart/catalog',
			'src="image/'=>'src="'.HTTP_SERVER_TEMP.'components/com_opencart/image/',
			'\'catalog/'=>'\''.HTTP_SERVER_TEMP.'components/com_opencart/catalog/',
			'$.'=>'jQuery.',
			'$('=>'jQuery(',
			'<div id="container">'=>'<div id="container_ext">',
			'"header"'=>'"header_ext"',
			'\"header\"'=>'\"header_ext\"',
			'"content"'=>'"content_ext"',
			'\"content\"'=>'\"content_ext\"',
			'class="button"'=>(USE_JOOMLA_BUTTONS=="1")?'class="button"':'class="button_ext"',
			'class=\"button\"'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"button\"':'class=\"button_ext\"',
			'id="button"'=>(USE_JOOMLA_BUTTONS=="1")?'id="button"':'id="button_ext"',
			'id=\"button\"'=>(USE_JOOMLA_BUTTONS=="1")?'id=\"button\"':'id=\"button_ext\"',
			'"search"'=>'"search_ext"',
			'\"search\"'=>'\"search_ext\"',
			'"menu"'=>'"menu_ext"',
			'"breadcrumb"'=>'"breadcrumb_ext"',
			'"logo"'=>'"logo_ext"',
			'"banner"'=>'"banner_ext"',
			'"footer"'=>'"footer_ext"',
			'"box"'=>'"box_ext"',
			'load(\'index.php?option=com_opencart&'=>'load(\'index.php?option=com_opencart&tmpl=component&',
			'load(\\\'index.php?option=com_opencart&'=>'load(\\\'index.php?option=com_opencart&tmpl=component&',
			'index.php?option=com_opencart&route=common/filemanager&token='=>'index.php?option=com_opencart&route=common/filemanager&tmpl=component&token=',
			': \'index.php?option=com_opencart&'=>': \'index.php?option=com_opencart&tmpl=component&',
			'.post(\'index.php?option=com_opencart&'=>'.post(\'index.php?option=com_opencart&tmpl=component&',
			'.get(\'index.php?option=com_opencart&'=>'.get(\'index.php?option=com_opencart&tmpl=component&',
			' name="option['=>' name="option_ext[',
			' value="option['=>' value="option_ext[',
			'name=\\\'option['=>'name=\\\'option_ext[',
			'<img src="index.php?option=com_opencart&'=>'<img src="index.php?option=com_opencart&tmpl=component&',
			'<link rel="stylesheet" type="text/css" href="index.php?option=com_opencart&'=>'<link rel="stylesheet" type="text/css" href="index.php?option=com_opencart&tmpl=component&',
			'-x.jpg"'=>'-80x80.jpg"',
			'jQuery(\'#cart_total\').html(json[\'total\']);'=>'jQuery(\'#cart_total\').html(json[\'total\']);
			jQuery(\'#cart_module .content_ext\').html(json[\'output\']);
			',
			'Powered By <a href="http://www.opencart.com">OpenCart</a>'=>'Powered By <a href="http://www.soft-php.com">jCart</a>',
			'<a class="colorbox" href="index.php?option=com_opencart&'=>'<a class="colorbox" href="index.php?option=com_opencart&tmpl=component&',
			'<a class="colorbox" href="'.HTTP_SERVER_TEMP.'index.php?option=com_opencart&'=>'<a class="colorbox" href="'.HTTP_SERVER_TEMP.'index.php?option=com_opencart&tmpl=component&',
			'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",HTTP_SERVER_TEMP).'index.php?option=com_opencart&'=>'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",HTTP_SERVER_TEMP).'index.php?option=com_opencart&tmpl=component&',
			'<img src="'.HTTP_SERVER_TEMP.'index.php?option=com_opencart&'=>'<img src="'.HTTP_SERVER_TEMP.'index.php?option=com_opencart&tmpl=component&',
			'url: \'index.php?option=com_opencart'=>'url: \''.HTTP_SERVER_TEMP.'index.php?option=com_opencart',
			'<a class="colorbox" href="'.HTTP_SERVER_TEMP.SHOP_SEO_KEY.'/information/information/info?'=>'<a class="colorbox" href="'.HTTP_SERVER_TEMP.'index.php?option=com_opencart&tmpl=component&route=information/information/info&',
			'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",HTTP_SERVER_TEMP.SHOP_SEO_KEY.'/information/information/info?')=>'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",HTTP_SERVER_TEMP.'index.php?option=com_opencart&tmpl=component&route=information/information/info&'),
			);

global $replace_output_check_array;
$replace_output_check_array[]=array(
'search'=>'<script type="text/javascript" src="'.HTTP_SERVER_TEMP.'components/com_opencart/catalog/view/javascript/jquery/tabs.js"></script>','replace'=>'<script type="text/javascript" src="'.HTTP_SERVER_TEMP.'components/com_opencart/catalog/view/javascript/jquery/tabs.js"></script>
			<script type="text/javascript">
		jQuery.noConflict();
	</script>','existing_var'=>'jQuery.noConflict();');



//for main system(not module)

$replace_output_check_array[]=array('search'=>'<script type="text/javascript"><!--
jQuery.tabs(\'.tabs a\');
//--></script>','replace'=>'<script type="text/javascript" src="components/com_opencart/catalog/view/javascript/jquery/tab.js"></script>
<script type="text/javascript"><!--
jQuery.tabs(\'.tabs a\');
//--></script>','existing_var'=>'jQuery.tabs = function(selector, start) {');

$replace_output_check_array[]=array('search'=>'method="post" enctype="multipart/form-data" id="product">','replace'=>'method="post" enctype="multipart/form-data" id="product"><input type="hidden" name="item_param"  value="'.ITEM_ID.'" />','existing_var'=>'<input type="hidden" name="item_param"');


$replace_output_check_array[]=array('search'=>'class="right"','replace'=>'class="right_ext"','existing_var'=>'class="right_ext"');
$replace_output_check_array[]=array('search'=>'class="left"','replace'=>'class="left_ext"','existing_var'=>'class="left_ext"');

$replace_output_check_array[]=array('search'=>'class=\"right\"','replace'=>'class=\"right_ext\"','existing_var'=>'class=\"right_ext\"');
$replace_output_check_array[]=array('search'=>'class=\"left\"','replace'=>'class=\"left_ext\"','existing_var'=>'class=\"left_ext\"');

//for module
global $replace_module_output_check_array;
$replace_module_output_check_array[]=array(
'search'=>'<script type="text/javascript" src="'.HTTP_SERVER_TEMP.'components/com_opencart/catalog/view/javascript/jquery/tabs.js"></script>','replace'=>'<script type="text/javascript" src="'.HTTP_SERVER_TEMP.'components/com_opencart/catalog/view/javascript/jquery/tabs.js"></script>
			<script type="text/javascript">
		jQuery.noConflict();
	</script>','existing_var'=>'jQuery.noConflict();');

$replace_module_output_check_array[]=array('search'=>'<div class="box-heading">','replace'=>'<div style="display:none;" class="box-heading">','existing_var'=>'<div style="display:none;" class="box-heading">');

$replace_module_output_check_array[]=array('search'=>'<div class="bottom">&nbsp;</div>','replace'=>'<div class="bottom" style="display:none;">&nbsp;</div>','existing_var'=>'<div class="bottom" style="display:none;">&nbsp;</div>');

$replace_module_output_check_array[]=array('search'=>'<div class="top">','replace'=>'<div class="top"  style="display:none;">','existing_var'=>'<div class="top"  style="display:none;">');
$replace_module_output_check_array[]=array('search'=>'class="box"','replace'=>'class="box_ext"','existing_var'=>'class="box_ext"');

$replace_module_output_check_array[]=array('search'=>'class="box_ext"','replace'=>'class="box_extt"','existing_var'=>'class="box_extt"');


$replace_module_output_check_array[]=array('search'=>'class="right"','replace'=>'class="right_ext"','existing_var'=>'class="right_ext"');
$replace_module_output_check_array[]=array('search'=>'class="left"','replace'=>'class="left_ext"','existing_var'=>'class="left_ext"');

$replace_module_output_check_array[]=array('search'=>'class=\"right\"','replace'=>'class=\"right_ext\"','existing_var'=>'class=\"right_ext\"');
$replace_module_output_check_array[]=array('search'=>'class=\"left\"','replace'=>'class=\"left_ext\"','existing_var'=>'class=\"left_ext\"');

$replace_module_output_check_array[]=array('search'=>'<div id="cart">','replace'=>'<div id="cart_module">','existing_var'=>'<div id="cart_module">');
$replace_module_output_check_array[]=array('search'=>'<div class="heading">','replace'=>'<div style="display:none;" class="heading">','existing_var'=>'<div style="display:none;" class="heading">');
$replace_module_output_check_array[]=array('search'=>'<td class="image">','replace'=>'<td style="display:none;" class="image">','existing_var'=>'<td style="display:none;" class="image">');
$replace_module_output_check_array[]=array('search'=>'default/image/remove-small.png"','replace'=>'default/image/remove.png"','existing_var'=>'default/image/remove.png"');

$replace_output_check_array[]=array('search'=>'" class="button_ext">','replace'=>'" class="button_ext" style="font-weight:bold;color:#FFFFFF;">','existing_var'=>'" class="button_ext" style="font-weight:bold;color:#FFFFFF;">');
$replace_output_check_array[]=array('search'=>'<a class="button_ext" href="','replace'=>'<a style="font-weight:bold;color:#FFFFFF;" class="button_ext" href="','existing_var'=>'<a style="font-weight:bold;color:#FFFFFF;" class="button_ext" href="');

?>