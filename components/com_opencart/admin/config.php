<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


//define('DONT_SHOW_ADMIN_LOGIN', '0');
//define('ENABLE_VQMOD_JCART','0');
//define('ENABLE_VQMOD_USECACHE','0');
//define('USE_MANUL_DB', '0');
//define('DB_DRIVER', 'mysql');
//define('DB_HOSTNAME', '');
//define('DB_USERNAME', '');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', '');
//define('DB_PREFIX', 'oc_');
if(!defined("DS") && defined("DIRECTORY_SEPARATOR"))
define("DS",DIRECTORY_SEPARATOR);

$main_dir=JPATH_SITE.DS;
$main_full_url=JURI::base();
$main_full_url=str_replace("administrator/","",$main_full_url);

$j_config=new JConfig();
// HTTP
if(!defined("HTTP_SERVER"))
define('HTTP_SERVER', $main_full_url."administrator/");
define('HTTP_CATALOG', $main_full_url);
define('HTTP_IMAGE', $main_full_url."components/com_opencart/image/");

// DIR
define('DIR_APPLICATION', $main_dir.'components/com_opencart/admin/');
define('DIR_SYSTEM', $main_dir.'components/com_opencart/system/');
define('DIR_DATABASE', $main_dir.'components/com_opencart/system/database/');
define('DIR_LANGUAGE', $main_dir.'components/com_opencart/admin/language/');
define('DIR_TEMPLATE', $main_dir.'components/com_opencart/admin/view/template/');
define('DIR_CONFIG', $main_dir.'components/com_opencart/system/config/');
define('DIR_IMAGE', $main_dir.'components/com_opencart/image/');
define('DIR_CACHE', $main_dir.'components/com_opencart/system/cache/');
define('DIR_DOWNLOAD', $main_dir.'components/com_opencart/download/');
define('DIR_LOGS', $main_dir.'components/com_opencart/system/logs/');
define('DIR_CATALOG', $main_dir.'components/com_opencart/catalog/');

$mycom_params =  JComponentHelper::getParams('com_opencart');
$dontShowLogin="";
$enableVqmodForjCart="";
$enableVqmodUseCache="";
$useJoomlaDB="1";
$dbuserName="";
$dbuserPassword="";
$dbuserHost="";
$dbName="";
$dbuserPrefix="";
if(version_compare(JVERSION, '1.6.0', '<' ) == 1){
	if($mycom_params->get('dontShowLogin')!=""){
		$dontShowLogin=$mycom_params->get('dontShowLogin');
	}
	if($mycom_params->get('enableVqmodForjCart')!=""){
		$enableVqmodForjCart=$mycom_params->get('enableVqmodForjCart');
	}
	if($mycom_params->get('enableVqmodUseCache')!=""){
		$enableVqmodUseCache=$mycom_params->get('enableVqmodUseCache');
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
}
else{
	if($mycom_params->get('params.dontShowLogin')!=""){
		$dontShowLogin=$mycom_params->get('params.dontShowLogin');
	}
	if($mycom_params->get('params.enableVqmodForjCart')!=""){
		$enableVqmodForjCart=$mycom_params->get('params.enableVqmodForjCart');
	}
	if($mycom_params->get('params.enableVqmodUseCache')!=""){
		$enableVqmodUseCache=$mycom_params->get('params.enableVqmodUseCache');
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
}

if(!defined("DONT_SHOW_ADMIN_LOGIN") && $dontShowLogin!=""){
	define('DONT_SHOW_ADMIN_LOGIN', $dontShowLogin);
}
elseif(!defined("DONT_SHOW_ADMIN_LOGIN")){
	define('DONT_SHOW_ADMIN_LOGIN', "0");
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
global $replace_outputs_array;
$replace_outputs_array=array(
		'index.php?route='=>'index.php?option=com_opencart&route=',
		'index.php?token='=>'index.php?option=com_opencart&token=',
		'Powered By <a href="http://www.opencart.com">OpenCart</a>'=>'Powered By <a href="http://www.soft-php.com">jCart</a>',
		'="view/'=>'="../components/com_opencart/admin/view/',
		'\'view/image/'=>'\'../components/com_opencart/admin/view/image/',
		'"view/image/'=>'"../components/com_opencart/admin/view/image/',
		'$.'=>'jQuery.',
		'$('=>'jQuery(',
		'<div id="container">'=>'<div id="container_ext">',
		'"header"'=>'"header_ext"',
		'\"header\"'=>'\"header_ext\"',
		'"content"'=>'"content_ext"',
		'\"content\"'=>'\"content_ext\"',
		'class="button"'=>'class="button_ext"',
		'class=\"button\"'=>'class=\"button_ext\"',
		'id="button"'=>'id="button_ext"',
		'id=\"button\"'=>'id=\"button_ext\"',
		'"search"'=>'"search_ext"',
		'\"search\"'=>'\"search_ext\"',
		'"menu"'=>'"menu_ext"',
		'"breadcrumb"'=>'"breadcrumb_ext"',
		'"banner"'=>'"banner_ext"',
		'"footer"'=>'"footer_ext"',
		'#header '=>'#header_ext ',
		'#content '=>'#content_ext ',
		'.button '=>'.button_ext ',
		'.button:'=>'.button_ext:',
		'\'#content\''=>'\'#content_ext\'',
		'#container '=>'#container_ext ',
		'#footer '=>'#footer_ext ',
		'#menu '=>'#menu_ext ',
		'load(\'index.php?option=com_opencart&'=>'load(\'index.php?option=com_opencart&tmpl=component&',
		'load(\\\'index.php?option=com_opencart&'=>'load(\\\'index.php?option=com_opencart&tmpl=component&',
		'index.php?option=com_opencart&route=checkout/manual&token='=>'index.php?option=com_opencart&tmpl=component&route=checkout/manual&token=',
		'index.php?option=com_opencart&route=common/filemanager&token='=>'index.php?option=com_opencart&route=common/filemanager&tmpl=component&token=',
		': \'index.php?option=com_opencart&'=>': \'index.php?option=com_opencart&tmpl=component&',
		HTTP_CATALOG.'index.php?option=com_opencart&route=feed/'=>HTTP_CATALOG.'index.php?option=com_opencart&tmpl=component&route=feed/',
		'index.php?option=com_opencart&route=sale/order/invoice&'=>'index.php?option=com_opencart&route=sale/order/invoice&tmpl=component&',
		' name="option"'=>' name="option_ext"',
		'name=\\\'option'=>'name=\\\'option_ext',
		'<img src="index.php?option=com_opencart&'=>'<img src="index.php?option=com_opencart&tmpl=component&',
		'<link rel="stylesheet" type="text/css" href="index.php?option=com_opencart&'=>'<link rel="stylesheet" type="text/css" href="index.php?option=com_opencart&tmpl=component&',
		'index.php?option=com_opencart&route=tool/backup/backup&'=>'index.php?option=com_opencart&route=tool/backup/backup&tmpl=component&',
		);
global $replace_outputs_check_array;
$replace_outputs_check_array[]=array(
'search'=>'<script type="text/javascript" src="../components/com_opencart/admin/view/javascript/jquery/tabs.js"></script>','replace'=>'<script type="text/javascript" src="../components/com_opencart/admin/view/javascript/jquery/tabs.js"></script>
			<script type="text/javascript">
		jQuery.noConflict();
	</script>','existing_var'=>'jQuery.noConflict();');

global $replace_templates_files_array;
$replace_templates_files_array=array(
			'#header '=>'#header_ext ',
			'#content '=>'#content_ext ',
			'#menu '=>'#menu_ext ',
			'#search '=>'#search_ext ',
			'#footer '=>'#footer_ext ',
			'#container '=>'#container_ext ',
			'#breadcrumb '=>'#breadcrumb_ext ',
			'#banner '=>'#banner_ext ',
			'#logo '=>'#logo_ext ',
			'#button '=>'#button_ext ',
			'#box '=>'#box_ext ',
			'#left '=>'#left_ext ',
			'#right '=>'#right_ext ',

			'.header '=>'.header_ext ',
			'.content '=>'.content_ext ',
			'.menu '=>'.menu_ext ',
			'.search '=>'.search_ext ',
			'.footer '=>'.footer_ext ',
			'.container '=>'.container_ext ',
			'.breadcrumb '=>'.breadcrumb_ext ',
			'.banner '=>'.banner_ext ',
			'.logo '=>'.logo_ext ',
			'.button '=>'.button_ext ',
			'.box '=>'.box_ext ',
			'.left '=>'.left_ext ',
			'.right '=>'.right_ext ',


			'#header{'=>'#header_ext{',
			'#content{'=>'#content_ext{',
			'#menu{'=>'#menu_ext{',
			'#search{'=>'#search_ext{',
			'#footer{'=>'#footer_ext{',
			'#container{'=>'#container_ext{',
			'#breadcrumb{'=>'#breadcrumb_ext{',
			'#banner{'=>'#banner_ext{',
			'#logo{'=>'#logo_ext{',
			'#button{'=>'#button_ext{',
			'#box{'=>'#box_ext{',
			'#container_ext{
	width:'=>'#container_ext{
	speech-rate:',
			'#container_ext {
	width:'=>'#container_ext {
	speech-rate:',
			'#left{'=>'#left_ext{',
			'#right{'=>'#right_ext{',


			'.header{'=>'.header_ext{',
			'.content{'=>'.content_ext{',
			'.menu{'=>'.menu_ext{',
			'.search{'=>'.search_ext{',
			'.footer{'=>'.footer_ext{',
			'.container{'=>'.container_ext{',
			'.breadcrumb{'=>'.breadcrumb_ext{',
			'.banner{'=>'.banner_ext{',
			'.logo{'=>'.logo_ext{',
			'.button{'=>'.button_ext{',
			'.box{'=>'.box_ext{',
			'.container_ext{
	width:'=>'.container_ext{
	speech-rate:',
			'.container_ext {
	width:'=>'.container_ext {
	speech-rate:',
			'.left{'=>'.left_ext{',
			'.right{'=>'.right_ext{',

			'#header,'=>'#header_ext,',
			'#content,'=>'#content_ext,',
			'#menu,'=>'#menu_ext,',
			'#search,'=>'#search_ext,',
			'#footer,'=>'#footer_ext,',
			'#container,'=>'#container_ext,',
			'#breadcrumb,'=>'#breadcrumb_ext,',
			'#banner,'=>'#banner_ext,',
			'#logo,'=>'#logo_ext,',
			'#button,'=>'#button_ext,',
			'#box,'=>'#box_ext,',
			'#left,'=>'#left_ext,',
			'#right,'=>'#right_ext,',

			'.header,'=>'.header_ext,',
			'.content,'=>'.content_ext,',
			'.menu,'=>'.menu_ext,',
			'.search,'=>'.search_ext,',
			'.footer,'=>'.footer_ext,',
			'.container,'=>'.container_ext,',
			'.breadcrumb,'=>'.breadcrumb_ext,',
			'.banner,'=>'.banner_ext,',
			'.logo,'=>'.logo_ext,',
			'.button,'=>'.button_ext,',
			'.box,'=>'.box_ext,',
			'.left,'=>'.left_ext,',
			'.right,'=>'.right_ext,',


			'#header:'=>'#header_ext:',
			'#content:'=>'#content_ext:',
			'#menu:'=>'#menu_ext:',
			'#search:'=>'#search_ext:',
			'#footer:'=>'#footer_ext:',
			'#container:'=>'#container_ext:',
			'#breadcrumb:'=>'#breadcrumb_ext:',
			'#banner:'=>'#banner_ext:',
			'#logo:'=>'#logo_ext:',
			'#button:'=>'#button_ext:',
			'#box:'=>'#box_ext:',
			'#left:'=>'#left_ext:',
			'#right:'=>'#right_ext:',


			'.header:'=>'.header_ext:',
			'.content:'=>'.content_ext:',
			'.menu:'=>'.menu_ext:',
			'.search:'=>'.search_ext:',
			'.footer:'=>'.footer_ext:',
			'.container:'=>'.container_ext:',
			'.breadcrumb:'=>'.breadcrumb_ext:',
			'.banner:'=>'.banner_ext:',
			'.logo:'=>'.logo_ext:',
			'.button:'=>'.button_ext:',
			'.box:'=>'.box_ext:',
			'.left:'=>'.left_ext:',
			'.right:'=>'.right_ext:',

			'html {'=>'html_ext {',
			'body {'=>'body_ext {',
			'html,'=>'html_ext,',
			'body,'=>'body_ext,',
			'html{'=>'html_ext{',
			'body{'=>'body_ext{',

			'width: 510px;'=>'',
			'960px;'=>'100%;',
			'980px;'=>'100%;',

			'.htabs {'=>'.htabs { overflow: auto;',
			'#container_ext {
	width:'=>'#container_ext {
	//width:',
			'width: 100px;'=>'width: 80px;',
			'background: url(\'../image/tab_'=>'//background: url(\'../image/tab_',
			'background: url(\'../image/header_'=>'//background: url(\'../image/header_',
			'padding-top: 2px;'=>'//padding-top: 2px;',
			'margin-left: 190px;'=>'margin-left: 0px;',
			'margin-left: 190px;'=>'margin-left: 0px;',
			);

global $replace_files_array;
$replace_files_array[]=array(
'file'=>'catalog/controller/checkout/cart.php','search'=>'request->get[\'option\']','replace'=>'request->get[\'option_ext\']','existing_var'=>'request->get[\'option_ext\']');
$replace_files_array[]=array(
'file'=>'catalog/controller/checkout/cart.php','search'=>'request->post[\'option\']','replace'=>'request->post[\'option_ext\']','existing_var'=>'request->post[\'option_ext\']');
$replace_files_array[]=array(
'file'=>'catalog/controller/module/information.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');

$replace_files_array[]=array(
'file'=>'catalog/controller/module/bestseller.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');

$replace_files_array[]=array(
'file'=>'catalog/controller/module/category.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');


$replace_files_array[]=array(
'file'=>'catalog/controller/module/featured.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');


$replace_files_array[]=array(
'file'=>'catalog/controller/module/google_talk.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');

$replace_files_array[]=array(
'file'=>'catalog/controller/module/latest.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');


$replace_files_array[]=array(
'file'=>'catalog/controller/module/manufacturer.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');


$replace_files_array[]=array(
'file'=>'catalog/controller/module/special.php','search'=>'$this->render();','replace'=>'$mod_var_name=basename(__FILE__,".php")."_mod_data";
		$this->data[\'template_dir\'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();','existing_var'=>'global');

$replace_files_array[]=array(
'file'=>'catalog/model/checkout/order.php','search'=>'index.php?route=','replace'=>'index.php?option=com_opencart&route=','existing_var'=>'com_opencart');
?>