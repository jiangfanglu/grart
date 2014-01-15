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
// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );
// Create the controller

$classname    = 'FacebookAllController';
$controller   = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getWord( 'task' ) );
// Redirect if set by the controller
$controller->redirect ();
