<?php

defined('_JEXEC') or die('Restricted access');

class GrartModelApprove extends JModelItem {

    var $_total = null;
    var $_pagination = null;

    function __construct() {
        parent::__construct();

        $mainframe = JFactory::getApplication();

        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }

    /**
     * 
     * @param type $artwork_ids
     * @return A list of approved artwork ids.
     * This function is to approve artwork according the artwork id selected.
     * An entry for each artwork will be inserted  into Table "artwork_publish".
     */
    public function approveArtworkList($artwork_ids = null) {

        $approved_result = "Artwork: ";
        $existed_artwork_id = array();
        $new_approved_artwork_id = array();

        //     if(empty($this->artwork_ids))

        foreach ($artwork_ids as $artwork_id) {
            if (!$this->isApproved($artwork_id)) {
                $data = new stdClass();
                $data->id = null;
                $data->artwork_id = "$artwork_id";
                $data->status = '0';
                $db = JFactory::getDBO();
                $db->insertObject('#__artwork_publish', $data, 'id');
                $new_approved_artwork_id[] = $artwork_id;
            } else {
                $existed_artwork_id[] = $artwork_id;
            }
        }


        if (count($existed_artwork_id) > 0) {
            $ids = implode(",", $existed_artwork_id);
            $result1 = "Artwork " . $ids . ' already apporved!<br />';
        }
        if (count($new_approved_artwork_id) > 0) {
            $ids = implode(",", $new_approved_artwork_id);
            $result2 = "Artwork " . $ids . ' were apporved succesfully!';
        }
        if (isset($result1) && isset($result2)) {
            $approved_result = $result1 . $result2;
        } elseif (isset($result1)) {
            $approved_result = $result1;
        } elseif (isset($result2)) {
            $approved_result = $result2;
        }
        return $approved_result;
    }

    /**
     * 
     * @param type $artwork_id
     * @return boolean 
     * TRUE: The artwork is appoved already(no need to approve again)
     * FALSE: The artwork is not approved yet.
     * This function is to check whether the artwork has been approved already
     */
    public function isApproved($artwork_id = null) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "Select * From #__artwork_publish WHERE `artwork_id`=$artwork_id";
        $db->setQuery($query);
        $approved_artworks = $db->loadObject();
        if (empty($approved_artworks))
            return FALSE;
        else
            return TRUE;
    }

    public function saveEditedItem($artwork_id, $artwork_image_id, $product_id, $status1) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "UPDATE #__artwork_publish SET artwork_image_id=$artwork_image_id, product_id=$product_id, status=$status1 WHERE `artwork_id`=$artwork_id";
        $db->setQuery($query);
        try {
// Execute the query in Joomla 3.0.
            $result = $db->execute();
            return "Changes to Artwork $artwork_id have been saved succesfully!";
        } catch (Exception $e) {
//print the errors
            return "Error! Changes have not been saved!";
        }
    }

    /*
     * Display all item in table "artwork_publish" with status=0
     */

    public function getArtworksApproved() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "Select * From #__artwork_publish WHERE 1 ORDER BY status,artwork_id";
        //  $db->setQuery($query);
        //  $approved_artworks = $db->loadObjectList();
        $approved_artworks = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        return $approved_artworks;
    }

    function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query =  "Select * From #__artwork_publish WHERE 1 ORDER BY status,artwork_id";
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }
    
    function getPagination()
  {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
  }

}

?>
