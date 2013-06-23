<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewUsermanager extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $user = JFactory::getUser();
            $app = JFactory::getApplication();
            
            if(JFactory::getUser()->guest){
                $app->redirect('/index.php?option=com_opencart&route=account/login');
            }
            
            $tempPath = JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.(string)$user->id;
            
            if(!JFolder::exists($tempPath)){
                $userthumb_folder = false;
            }else{
                $userthumb_folder = true;
            }
            
            $this ->assignRef('userthumb_folder', $userthumb_folder);
            
            $artist = $this -> get('Artist');
            
            if($artist == null){
                $artist_not = true;
            }else{
                $artist_not = false;
            }

            $this ->assignRef('artist_not', $artist_not);
            $this ->assignRef('artist', $artist);
            $this ->assignRef('user', $user);
            
            parent::display($tpl);
        }
}
?>
