<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Version
global $config_code_from_config_file,$joomla_db_code_from_config_file,$replace_array_code_from_config_file,$ajax_index_file_code_from_config_file,$index_db_code_from_config_file,$error_handler_indexmod_code_from_config_file;

// Configuration
require_once(dirname(__FILE__).'/config.php');
   

if(defined("ENABLE_VQMOD_JCART") && ENABLE_VQMOD_JCART=="1"){
	// vQmod
	require_once(dirname(__FILE__).'/vqmod/vqmod.php');
	global $vqmod;
	$vqmod = new VQMod();
	if(defined("ENABLE_VQMOD_USECACHE") && ENABLE_VQMOD_USECACHE=="1"){
		$vqmod->useCache = true;
	}
	// VQMODDED Startup
	require_once($vqmod->modCheck(DIR_SYSTEM . 'startup.php'));
	
	// Application Classes
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/customer.php'));
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/affiliate.php'));
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/currency.php'));
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/tax.php'));
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/weight.php'));
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/length.php'));
	require_once($vqmod->modCheck(DIR_SYSTEM . 'library/cart.php'));
	
}
else{
	// Startup
	require_once(DIR_SYSTEM . 'startup.php');
	
	// Application Classes
	require_once(DIR_SYSTEM . 'library/customer.php');
	require_once(DIR_SYSTEM . 'library/affiliate.php');
	require_once(DIR_SYSTEM . 'library/currency.php');
	require_once(DIR_SYSTEM . 'library/tax.php');
	require_once(DIR_SYSTEM . 'library/weight.php');
	require_once(DIR_SYSTEM . 'library/length.php');
	require_once(DIR_SYSTEM . 'library/cart.php');
}
// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$registry->set('config', $config);

// Database 
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);
global $joomla_db;
$JConfig = new JConfig();
$joomla_db=new DB(DB_DRIVER, $JConfig->host, $JConfig->user, $JConfig->password, $JConfig->db);

// Store
if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
	$store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`ssl`, 'www.', '') = '" . $db->escape('https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
} else {
	$store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`url`, 'www.', '') = '" . $db->escape('http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
}

if ($store_query->num_rows) {
	$config->set('config_store_id', $store_query->row['store_id']);
} else {
	$config->set('config_store_id', 0);
}
		
// Settings
$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '0' OR store_id = '" . (int)$config->get('config_store_id') . "' ORDER BY store_id ASC");

foreach ($query->rows as $setting) {
	if (!$setting['serialized']) {
		$config->set($setting['key'], $setting['value']);
	} else {
		$config->set($setting['key'], unserialize($setting['value']));
	}
}
//#######jCart Changes Start##################
//Set HTTP_SERVER value
if(!defined("HTTP_SERVER")){
	if($config->get('config_url') && trim($config->get('config_url'))!="" && $config->get('config_url')!="http://www.yoursite.com/")
		define('HTTP_SERVER', $config->get('config_url'));
	else{
		if ($config->get('config_use_ssl') && isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1')))
			define('HTTP_SERVER', str_replace("http://","https://",HTTP_SERVER_TEMP));
		else
			define('HTTP_SERVER', str_replace("https://","http://",HTTP_SERVER_TEMP));
	}
}

if(!defined("HTTP_IMAGE")){
	define('HTTP_IMAGE', HTTP_SERVER . 'components/com_opencart/image/');
}
//set HTTPS_SERVER value
if(!defined("HTTPS_SERVER")){
	if ($config->get('config_use_ssl') && $config->get('config_ssl') && trim($config->get('config_ssl'))!="" ) {
		define('HTTPS_SERVER',$config->get('config_ssl'));	
	} 
	elseif ($config->get('config_use_ssl')) {
		define('HTTPS_SERVER',str_replace("http://","https://",HTTP_SERVER));	
	} else {
		define('HTTPS_SERVER', HTTP_SERVER);	
	}
}
if(!defined("HTTPS_IMAGE")){
	define('HTTPS_IMAGE', HTTPS_SERVER . 'components/com_opencart/image/');
}


// Log
$log = new Log($config->get('config_error_filename'));
$registry->set('log', $log);

//#######jCart Changes End##################

if (!$store_query->num_rows) {
	$config->set('config_url', HTTP_SERVER);
	$config->set('config_ssl', HTTPS_SERVER);
}

// Url
$url = new Url($config->get('config_url'), $config->get('config_use_ssl') ? $config->get('config_ssl') : $config->get('config_url'));	
$registry->set('url', $url);

// Request
$request = new Request();
$registry->set('request', $request);
 
// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
$registry->set('response', $response); 
		
// Cache
$cache = new Cache();
$registry->set('cache', $cache); 

// Session
$session = new Session();

$joomla_lang = JFactory::getLanguage();
$def_lang=$joomla_lang->getTag();
$def_lang=explode("-",$def_lang);
$def_lang=$def_lang[0];
if(isset($_REQUEST["lang"]) && strlen($_REQUEST["lang"])=="2"){
	if((isset($session->data['language']) && $session->data['language']!=$_REQUEST["lang"]) || !isset($session->data['language'])){
		$session->data['language'] = $_REQUEST["lang"];
	}

}
elseif((isset($session->data['language']) && isset($def_lang) && $session->data['language']!=$def_lang) || !isset($session->data['language'])){
	if(isset($def_lang) &&  strlen($def_lang)==2){
		$session->data['language'] = $def_lang;
	}
}

$registry->set('session', $session); 

// Language Detection
$languages = array();

$query = $db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = '1'"); 

foreach ($query->rows as $result) {
	$languages[$result['code']] = $result;
}

$detect = '';

if (isset($request->server['HTTP_ACCEPT_LANGUAGE']) && ($request->server['HTTP_ACCEPT_LANGUAGE'])) { 
	$browser_languages = explode(',', $request->server['HTTP_ACCEPT_LANGUAGE']);
	
	foreach ($browser_languages as $browser_language) {
		foreach ($languages as $key => $value) {
			if ($value['status']) {
				$locale = explode(',', $value['locale']);

				if (in_array($browser_language, $locale)) {
					$detect = $key;
				}
			}
		}
	}
}

if (isset($session->data['language']) && array_key_exists($session->data['language'], $languages) && $languages[$session->data['language']]['status']) {
	$code = $session->data['language'];
} elseif (isset($request->cookie['language']) && array_key_exists($request->cookie['language'], $languages) && $languages[$request->cookie['language']]['status']) {
	$code = $request->cookie['language'];
} elseif ($detect) {
	$code = $detect;
} else {
	$code = $config->get('config_language');
}

if (!isset($session->data['language']) || $session->data['language'] != $code) {
	$session->data['language'] = $code;
}

if (!isset($request->cookie['language']) || $request->cookie['language'] != $code) {	  
	setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $request->server['HTTP_HOST']);
}			

$config->set('config_language_id', $languages[$code]['language_id']);
$config->set('config_language', $languages[$code]['code']);

// Language	
$language = new Language($languages[$code]['directory']);
$language->load($languages[$code]['filename']);	
$registry->set('language', $language); 

// Document
$registry->set('document', new Document()); 		

// Customer
$registry->set('customer', new Customer($registry));

// Affiliate
$registry->set('affiliate', new Affiliate($registry));

if (isset($request->get['tracking']) && !isset($request->cookie['tracking'])) {
	setcookie('tracking', $request->get['tracking'], time() + 3600 * 24 * 1000, '/');
}
		
// Currency
$registry->set('currency', new Currency($registry));

// Tax
$registry->set('tax', new Tax($registry));

// Weight
$registry->set('weight', new Weight($registry));

// Length
$registry->set('length', new Length($registry));

// Cart
$registry->set('cart', new Cart($registry));

//  Encryption
$registry->set('encryption', new Encryption($config->get('config_encryption')));
		
// Front Controller 
$controller = new Front($registry);

// Maintenance Mode
$controller->addPreAction(new Action('common/maintenance'));

// SEO URL's
$controller->addPreAction(new Action('common/seo_url'));	
	
// Router
if (isset($request->get['route'])) {
	$action = new Action($request->get['route']);
} else {
	$action = new Action('common/home');
}

// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

?>