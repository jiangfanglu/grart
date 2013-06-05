<?php
defined('_JEXEC') or die;
 
// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');
 
// get a parameter from the module's configuration
//$userCount = $params->get('usercount');
$user = new ModCustomfooterHelper();
// get the items to display from the helper
$user = $user->getUser();
 
// include the template for display
require(JModuleHelper::getLayoutPath('mod_customfooter'));
?>
