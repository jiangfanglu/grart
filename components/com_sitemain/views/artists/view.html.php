<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewArtists extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            if(isset($_GET['keyword'])){
                $model =& $this ->getModel('Artists');
                $artists = $model -> getArtistsBySearchName($_GET['keyword']);
            }else{
                $artists =& $this -> get('Artists');
            }
            
            $this -> assignRef('artists',$artists);

            parent::display($tpl);
        }
}
?>
