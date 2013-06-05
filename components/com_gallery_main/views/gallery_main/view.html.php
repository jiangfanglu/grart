<?php

defined('_JEXEC') or die('Restricted access');
 
class Gallery_mainViewGallery_main extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
                // Assign data to the view
                $this->msg = $this->get('Msg');
                
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
                        return false;
                }
                
                // Display the view
                parent::display($tpl);
        }
}
?>
