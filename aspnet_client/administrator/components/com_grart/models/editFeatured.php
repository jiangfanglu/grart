<?php

defined('_JEXEC') or die('Restricted access');

class GrartModelEditFeatured extends JModelItem {

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

    public function getRecentProduct() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT ai.id AS artwork_id,
ai.title,
op.product_id,
aim.filename,
u.username,
u.email,
ai.category_id,
cd.name AS category_name
FROM joomla.oc_product op 
LEFT JOIN #__artwork_publish ap 
ON (op.product_id = ap.product_id)
LEFT JOIN #__artwork_info ai
ON (ai.id=ap.artwork_id)
LEFT JOIN #__users u
ON (u.id=ai.user_id)
LEFT JOIN #__artwork_images aim
ON (ai.id=aim.artwork_id)
LEFT JOIN joomla.oc_category_description cd
ON (cd.category_id = ai.category_id)
WHERE datediff(op.date_added, CURRENT_TIMESTAMP ())<100
AND aim.hero=1
AND op.product_id NOT IN 
(SELECT product_id FROM #__product_featured)
            ";
        //  $db->setQuery($query);
        //  $approved_artworks = $db->loadObjectList();
        $product_list = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        return $product_list;
    }

    function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = "SELECT ai.id AS artwork_id,
ai.title,
op.product_id,
aim.filename,
u.username,
u.email,
ai.category_id,
cd.name AS category_name
FROM joomla.oc_product op 
LEFT JOIN #__artwork_publish ap 
ON (op.product_id = ap.product_id)
LEFT JOIN #__artwork_info ai
ON (ai.id=ap.artwork_id)
LEFT JOIN #__users u
ON (u.id=ai.user_id)
LEFT JOIN #__artwork_images aim
ON (ai.id=aim.artwork_id)
LEFT JOIN joomla.oc_category_description cd
ON (cd.category_id = ai.category_id)
WHERE datediff(op.date_added, CURRENT_TIMESTAMP ())<100
AND aim.hero=1
AND op.product_id NOT IN 
(SELECT product_id FROM #__product_featured)
";
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }

    function getPagination() {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_pagination;
    }
    
    
    function getImageList($artwork_id){
         $db = JFactory::getDbo();
        $query = $db->getQuery(true);
         $query = "Select filename,id From #__artwork_images WHERE `artwork_id`=$artwork_id";
        $db->setQuery($query);
        $image_filenames = $db->loadObjectList();
        if(empty($image_filenames))
            return "No Image available";
        else
            return $image_filenames;
    }
    
    function getUserID($artwork_id)
    {
         $db = JFactory::getDbo();
        $query = $db->getQuery(true);
         $query = "Select user_id From #__artwork_info WHERE `id`=$artwork_id";
        $db->setQuery($query);
        $user_id = $db->loadObject();
        If(empty($user_id))
            return "No User_id found";
        else{
            return $user_id;
        }
    }
     public function saveFeaturedProduct($artwork_image_id,$order,$category_id,$product_id) {
        $db = JFactory::getDbo();
        $data = new stdClass();
                $data->id = null;
                $data->artwork_image_id = "$artwork_image_id";
                $data->order ="$order";
                $data->category_id="$category_id";
                $data->product_id="$product_id";
                $db = JFactory::getDBO();
              
               // $new_approved_artwork_id[] = $artwork_id;
      //  $query = "INSERT INTO  #__product_featured (artwork_image_id,order,category_id,product_id ) VALUES ('"$artwork_image_id"', '"$order"','"$category_id"','"$product_id"')";
     //   $db->setQuery($query);
        try {
// Execute the query in Joomla 3.0.
             $db->insertObject('#__product_featured', $data, 'id');
            return "Product  $product_id has been make featured!";
        } catch (Exception $e) {
//print the errors
            return "Error! Feature has not been saved!";
        }
    }

}

?>
