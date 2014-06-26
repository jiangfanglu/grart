<?php
/**
* @package 		Facebook All
* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.
* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt
* @author		sourceaddons
* @download URL	http://www.sourceaddons.com
*/

defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');
jimport ('joomla.application.component.controller');

// Get an instance of the controller
$controller = JControllerLagecy::getInstance ('FacebookAll');

// Perform the requested task
$controller->execute (JRequest::getCmd ('task', 'display'));

// Redirect if set by the controller
$controller->redirect ();