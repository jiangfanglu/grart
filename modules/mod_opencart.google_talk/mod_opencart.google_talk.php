<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if($params->get("extension_id")==""){
	$extension_var= str_replace("mod_opencart.","",basename(preg_replace('@\(.*\(.*$@', '', __FILE__),".php"))."_mod_data";
	$real_id=$extension_var;
	if($extension_var=="shopping_cart_mod_data")
		$extension_var="cart_mod_data";
	elseif($extension_var=="categories_mod_data")
		$extension_var="category_mod_data";
	elseif($extension_var=="specials_mod_data")
		$extension_var="special_mod_data";
	elseif($extension_var=="bestsellers_mod_data")
		$extension_var="bestseller_mod_data";
}else{
	$extension_var= $params->get("extension_id")."_mod_data";
	$real_id=$extension_var;
	if($extension_var=="shopping_cart_mod_data")
		$extension_var="cart_mod_data";
}
global $$extension_var,$config;
require_once(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))."/../../components/com_opencart/index_mod.php");
if(is_array($$extension_var))
extract($$extension_var);
if(isset($template_dir) && file_exists(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))."/../../components/com_opencart/catalog/view/theme/".$template_dir)){
	$template_dir=str_replace("_home","",$template_dir);
	ob_start();

	include(dirname(__FILE__)."/../../components/com_opencart/catalog/view/theme/".$template_dir);
	$mod_output = ob_get_contents();
	ob_end_clean();
	global $replace_output_array;
	foreach($replace_output_array as $key=>$value){
		$mod_output=str_replace($key,$value,$mod_output);
	}
	$exclude_modules=array("header_mod_data","footer_mod_data","cart_mod_data");
	if(!in_array($real_id,$exclude_modules)){
		global $replace_module_output_check_array;
		foreach($replace_module_output_check_array as $single_array){
			if(!strstr($mod_output,$single_array["existing_var"])){
				$mod_output=str_replace($single_array["search"],$single_array["replace"],$mod_output);
			}
		}
	}
	if(isset($config) && $params->get("use_jcart_stylesheet")!="0"){
		$template_name=$config->get('config_template');
		$document = JFactory::getDocument();
		$document->addStyleSheet("components/com_opencart/catalog/view/theme/".$template_name."/stylesheet/stylesheet.css");		
	}
	$change_modules=array("language_mod_data","currency_mod_data","cart_mod_data");
	if(in_array($real_id,$change_modules)){
		echo '<div id="header_ext"><table><tr><td>'.$mod_output.'</td></tr></table></div>';
	}
	else
	echo $mod_output;
	
	if(isset($heading_title))
	$module->title=$heading_title;
}
else{
	echo "Enable module from jCart admin: Extensions->Modules";
}
?>