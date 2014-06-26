<?php

defined('_JEXEC') or die('Restricted access');

$controller = JControllerLegacy::getInstance('Uploadfile');
$input = JFactory::getApplication()->input;

$controller->execute($input->get('task'));
$controller->redirect();

?>
