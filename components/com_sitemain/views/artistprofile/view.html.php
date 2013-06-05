<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewArtistprofile extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $user = JFactory::getUser();
            $model =& $this ->getModel('Artistprofile');
            $artist = $model->getArtistProfile($user->id);
            $this ->assignRef('artist', $artist);

            parent::display($tpl);
        }
}
?>
