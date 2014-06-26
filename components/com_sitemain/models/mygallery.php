<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 *  Model
 */
class SitemainModelMygallery extends JModelItem
{
    
    public $ARTWORK_PUBLISH_STATUS_PENDING = 0;
    public $ARTWORK_PUBLISH_STATUS_DISABLED = 2;
    public $ARTWORK_PUBLISH_STATUS_PUBLISHED = 1;
    
    public $arwork_id = 0;
    
 public function getOptions() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT * FROM oc_category c 
            LEFT JOIN oc_category_description cd ON (c.category_id = cd.category_id) 
            LEFT JOIN oc_category_to_store c2s ON (c.category_id = c2s.category_id) 
            WHERE c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)";
        $db->setQuery((string)$query);
        $categories = $db->loadObjectList();
        
        $categories_arr = array();
        $n=0;
        foreach($categories as $c){
            if($c->parent_id == 0){
                $categories_arr[$n] = array(
                    'parent' => $c,
                    'children' => $this -> getCategoryArray($categories, $c)
                );
                $n++;
            }
        }
        return $categories_arr;
    }
    
    function getCategoryArray($categories, $parent){
        $children = array();
        $n=0;
        foreach($categories as $c_tmp){
            if($c_tmp->parent_id == $parent->category_id){
                $children[$n] = $c_tmp;
                $n++;
            }
        }
        return $children;
    }
    
    public function getArworkId(){
        return $arwork_id;
    }
    
    public function setArtworkId(){
        $arwork_id = JRequest::getVar('artwork_id');
    }
    
    public function getArtworks(){
        $userid = JFactory::getUser()->id;
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('filename,title,description,meta_desc,category_id,artwork_id');
        $query->from('#__artwork_info AS ATI');
        $query->join('inner','#__artwork_images AS ATIM on ATI.id = ATIM.artwork_id');
        $query->where('ATI.user_id='.(string)$userid.' and ATIM.hero =1');
        $db->setQuery((string)$query);
        $images = $db->loadObjectList();
        return $images;
    }
    
    public function getArtwork($artwork_id = null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__artwork_info');
        $query->where('id='.(string)$artwork_id);
        $db->setQuery((string)$query);
        $artwork = $db->loadObject();
        return $artwork;
    }
    
    public function getArtworkImages($artworkid=null){
        $db = JFactory::getDbo();
      
        $query = $db->getQuery(true);
        $query->select('ATIM.id,hero,ATIM.artwork_id, filename,title,description,meta_desc,category_id');
        $query->from('#__artwork_info AS ATI');
        $query->join('inner','#__artwork_images AS ATIM on ATI.id = ATIM.artwork_id');
        $query->where('ATI.id='.(string)$artworkid);
        $db->setQuery((string)$query);
        $images = $db->loadObjectList();
        return $images;
    }
    
    public function updateArtworkInfo($data){
        $db = JFactory::getDbo();
 
        $query = $db->getQuery(true);

        $fields = array(
            "title='".$data['title']."'",
            "meta_desc='".$data['meta_desc']."'",
            "description='".$data['description']."'",
            "category_id=".$data['category_id']);

        $conditions = array(
            'id='.$data['artwork_id']);

        $query->update($db->quoteName('#__artwork_info'))->set($fields)->where($conditions);

        $db->setQuery($query);

        try {
            $result = $db->query(); 
        } catch (Exception $e) {
        }
    }
    
    public function checkArtworkStatus($artwork_id = null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__artwork_info');
        $query->where('id='.(string)$artwork_id);
        $db->setQuery((string)$query);
        $artwork = $db->loadObject();
        
        if($artwork -> status == 1){
            return false;
        }else{
            return true;
        }
    }
    
    public function deleteArtwork($artwork_id = null){
        $db = & JFactory::getDBO();   
         $query = $db->getQuery(true);
         $query->delete('#__artwork_info');             
         $query->where('id='.$artwork_id);             
         $db->setQuery($query);
         $db->query(); 
         return true;
    }
    
    public function sendArtworkAction($artwork_id, $msg, $action){
        $db = JFactory::getDbo();
        
        $data =new stdClass();
        $data->id = null;
        $data->artwork_id = $artwork_id;
        $data->msg = $msg;
        $data->actions = $action;
        $data->read_status = 0;
        
        $db->insertObject( '#__artwork_actions', $data, id );
        return true;
    }
}
?>
