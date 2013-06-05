<?php

defined('_JEXEC') or die('Restricted access');

$controller = JControllerLegacy::getInstance('Image');
$input = JFactory::getApplication()->input;

$controller->execute($input->get('task'));
$controller->redirect();
?>

