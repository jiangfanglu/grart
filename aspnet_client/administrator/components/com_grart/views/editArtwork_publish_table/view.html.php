<?php


defined('_JEXEC') or die('Restricted access');


class GrartViewEditArtwork_publish_table extends JViewLegacy
{
	// Overwriting JView display method
     public function display($tpl = null)
        {
              $model =$this ->getModel("EditArtwork_publish_table");
              $approved_artworks=$model->getArtworksApproved();
              $post=JRequest::get('post');
            $edit_artwork_id = $post['art-id'];
              
//              $images =& $this -> get('Artworkimages');
                $this->assignRef("approved_artworks", $approved_artworks);
              $this->assignRef("edit_artwork_id", $edit_artwork_id);
             // $this->assignRef("save_result", $val);
              
                parent::display($tpl);
 
        }
 
       
}

?>