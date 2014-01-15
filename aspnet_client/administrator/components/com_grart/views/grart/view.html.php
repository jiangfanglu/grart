<?php


defined('_JEXEC') or die('Restricted access');


class GrartViewGrart extends JViewLegacy
{
	// Overwriting JView display method
     public function display($tpl = null)
        {
//              $model = $this ->getModel("Grart");
//              $artworks = $model -> getArtworkList();
//              
////              $images =& $this -> get('Artworkimages');
//                $pagination = $model->getPagination();
//
//            $this->assignRef('pagination', $pagination);
//              $this->assignRef("artworks", $artworks);
              $app = JFactory::getApplication();
              $app->redirect(JUri::base()."index.php?option=com_grart&view=artworkstoproducts");
                parent::display($tpl);
 
        }
 
       
}

?>