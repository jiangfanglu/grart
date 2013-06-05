<?php
defined('_JEXEC') or die;
 
// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');
 
// get a parameter from the module's configuration
//$userCount = $params->get('usercount');
$userstatushelper = new ModUserStatusHelper();
// get the items to display from the helper
$user = $userstatushelper->getUser();
 
// include the template for display
require(JModuleHelper::getLayoutPath('mod_user_status'));
?>
