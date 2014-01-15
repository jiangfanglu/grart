<?php

defined('_JEXEC') or die('Restricted access');

class GrartViewApprove extends JViewLegacy {

// Overwriting JView display method
    public function display($tpl = null) {
        $model = $this->getModel("Approve");
        $ids = JRequest::getVar('selected'); //check box result from previous page
        $isSave = JRequest::getVar('save'); // A save button was click for an edit item

        if (isset($isSave)) {//A save button was pressed from previous page
            $artwork_id = JRequest::getVar('art-id');
            $artwork_image_id = JRequest::getVar('artwork_image_id'); //the edited item
            $product_id = JRequest::getVar('product_id');
            $status1 = JRequest::getVar('status1');
            $saveResult = $model->saveEditedItem($artwork_id, $artwork_image_id, $product_id, $status1); //Save changed info to database
            $approved_all_artworks = $model->getArtworksApproved(); //Display all item in table "artwork_publish" with status=0
            $pagination = $model->getPagination();

            $this->assignRef('pagination', $pagination);
            $this->assignRef("new_saved_msg", $saveResult);
            $this->assignRef("approved_artworks", $approved_all_artworks);
        } elseif (isset($ids)) {//That's from select box(es) of artwork list chosen for approving
            $approvedResult = $model->approveArtworkList($ids);
            $approved_all_artworks = $model->getArtworksApproved();
            $pagination = $model->getPagination();

            $this->assignRef('pagination', $pagination);
            $this->assignRef("new_approved_result", $approvedResult);
            $this->assignRef("approved_artworks", $approved_all_artworks);
//              $images =& $this -> get('Artworkimages');
        } elseif (!isset($ids)) {//if the select box is empty.
            $approved_all_artworks = $model->getArtworksApproved();
            $approvedResult = "No artwork selected for approving!";
            $pagination = $model->getPagination();

            $this->assignRef('pagination', $pagination);
            $this->assignRef("new_approved_result", $approvedResult);
            $this->assignRef("approved_artworks", $approved_all_artworks);
        }
        parent::display($tpl);
    }

}

?>