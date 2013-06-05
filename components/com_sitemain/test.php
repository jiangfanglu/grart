<?php

defined('_JEXEC') or die('Restricted access');

$controller = JControllerLegacy::getInstance('Test');
$input = JFactory::getApplication()->input;

$controller->execute($input->get('task'));
$controller->redirect();
?>
