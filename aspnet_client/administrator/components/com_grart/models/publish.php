<?php

defined('_JEXEC') or die('Restricted access');

class GrartModelPublish extends JModelItem {

    public function insertToTableProduct($artwork_ids = null) {
        
          $db = JFactory::getDbo();
        //     if(empty($this->artwork_ids))
        foreach ($artwork_ids as $artwork_id) {
            $data = new stdClass();
            $data->id = null;
            $data->status = '0';
            $db = JFactory::getDBO();
            $db->insertObject('oc_product', $data, 'id');

            $result = $data->id;

            $artwork_product[$artwork_id] = $result;
        }
        return $artwork_product;
       
    }
    
    /**
     * 
     It's no use.
     */
    public function get($approved_ids=null)
   {
       $db = JFactory::getDbo();
       $query = $db->getQuery(true);
       $ids = join(',',$approved_ids);
       $query = "Select * From #__artwork_publish WHERE `id` IN (".$ids.")";
       $db->setQuery($query);
       $approved_artworks = $db->loadObjectList();
       return $approved_artworks;
   }

}

?>
