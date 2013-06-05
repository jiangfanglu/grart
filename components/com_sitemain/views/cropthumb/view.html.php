<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewCropthumb extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $user = JFactory::getUser();
            
            $this ->assignRef('user', $user);
            parent::display($tpl);
        }
}

?>
