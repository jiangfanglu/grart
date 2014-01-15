<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewArtistgallery extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $app = JFactory::getApplication();
            if(!$_GET['artist_id']){
                $app ->redirect(JURI::base());
            }
            $model =& $this ->getModel('Artistgallery');
            $artist = $model -> getArtist($_GET['artist_id']);
            $partworks = $model -> getArtworks(1,$_GET['artist_id']);
            $artworks = $model -> getArtworks(0,$_GET['artist_id']);
            $follower_count = $model -> getFollowerCount($_GET['artist_id']);
            $partworks_count = count($partworks);
            
            $this ->assignRef('artist', $artist);
            $this ->assignRef('partworks', $partworks);
            $this ->assignRef('artworks', $artworks);
            $this ->assignRef('follower_count', $follower_count);
            $this ->assignRef('partworks_count', $partworks_count);
            
            $user = JFactory::getUser();
            $this ->assignRef('user', $user);
            
            parent::display($tpl);
        }
          
}
?>
