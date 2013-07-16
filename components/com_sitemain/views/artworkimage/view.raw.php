<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewArtworkimage extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $model =& $this ->getModel('Artworkimage');
            $artwork = $model -> getArtwork($_GET['artwork_id']);
            $this->assignRef('artwork', $artwork);
            
            $width = $artwork->width;
            $height = $artwork->height;
            
            if($width==$height){
                $style="width:510px;height:510px;margin-left:75px;";
            }else if($width>$height){
                $h = 660*($height/$width);
                $style="width:660px;height:".$h."px;margin-top:".((510 - $h)/2)."px;";
            }else{
                $w = 510*($width/$height);
                $style="width:".$w."px;height:510px;margin-left:".((660-$w)/2)."px;";
            }
            $this->assignRef('style', $style);
            parent::display($tpl);
        }
          
}
?>
