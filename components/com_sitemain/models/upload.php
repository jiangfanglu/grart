<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 */
class SitemainModelUpload extends JModelItem
{
    
    private $ARTWORK_PUBLISH_STATUS_PENDING = 0;
    private $ARTWORK_PUBLISH_STATUS_DISABLED = 2;
    private $ARTWORK_PUBLISH_STATUS_PUBLISHED = 1;
    //user might only want to upload, and have artwork hosted by us, but not published
    public $ARTWORK_PUBLISH_STATUS_ONLY_COLLECTION = 1;
    
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
    
    public function saveData($filename = null){
        $user_id = (string)JFactory::getUser()->get('id');
        
        $image_path = JPATH_SITE.DS.'media'.DS.'uploaded_artwork'.DS.$user_id.DS.$filename;
        $image = new JImage();
        $image ->loadFile($image_path);
        
        $width = $image->getWidth();
        $height = $image->getHeight();
        
        $tags = preg_split("/[\s,]/", JRequest::getVar('tags'));
        
        $db = JFactory::getDbo();
        
        $data =new stdClass();
        $data->id = null;
        $data->title = JRequest::getVar('title');
        $data->category_id = JRequest::getVar('category_id');
        $data->user_id = $user_id;
        $data->description = JRequest::getVar('desc');
        $data->meta_desc = JRequest::getVar('meta_desc');
        $data->filename = $filename;
        $data->width = $width;
        $data->height = $height;
        $data->status = $this->ARTWORK_PUBLISH_STATUS_PENDING;
        
        
        try{
               $db->insertObject( '#__artwork', $data, id );
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        
        $photoid = $db->insertId();
        
        foreach($tags as $tag){
            $query = $db->getQuery(true);
            $query->insert('#__tags'); 
            $query->set('`artwork_id`='.(string)$photoid);
            $query->set('`tag_name`="'.$tag.'"');
            try{
                $db->setQuery($query);
                $db->query();
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        
        return true;
    }
    
    public function saveDataMultiple($filename = null){
        $user_id = (string)JFactory::getUser()->get('id');
        $db = JFactory::getDbo();
        $tags = preg_split("/[\s,]/", JRequest::getVar('tags'));
        
        $data =new stdClass();
        $data->id = null;
        $data->title = JRequest::getVar('title');
        $data->category_id = JRequest::getVar('category_id');
        $data->user_id = $user_id;
        $data->description = JRequest::getVar('desc');
        $data->meta_desc = JRequest::getVar('meta_desc');
        $date =& JFactory::getDate();
        $data->created = $date->toSql();
        
        $data->status = $this->ARTWORK_PUBLISH_STATUS_PENDING;
        
        
        try{
               $db->insertObject( '#__artwork_info', $data, id );
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        $artworkid = $db->insertId();
        
        foreach($tags as $tag){
            $query = $db->getQuery(true);
            $query->insert('#__tags'); 
            $query->set('`artwork_id`='.(string)$artworkid);
            $query->set('`tag_name`="'.$tag.'"');
            try{
               $db->setQuery($query);
                $db->query();
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
        }
        
        $i=0;
        foreach($filename as $name => $value){
            $image_path = JPATH_SITE.DS.'media'.DS.'uploaded_artwork'.DS.$user_id.'_'.$filename[$name];
            $image = null;
            $image = new JImage();
            $image ->loadFile($image_path);

            $width = $image->getWidth();
            $height = $image->getHeight();
            
            
            $query = $db->getQuery(true);
            $query->insert('#__artwork_images'); 
            $query->set('`filename`="'.$user_id.'_'.$filename[$name].'"');
            $query->set('`width`='.$width);
            $query->set('`height`='.$height);
            $query->set('`artwork_id`='.$artworkid);
            $query->set('`user_id`='.$user_id);
            if($i == 0){
                $hero = 1;
            }else{
                $hero = 0;
            }
            $query->set('`hero`='.$hero);
            try{
                $db->setQuery($query);
                $db->query();
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            $i = $i + 1;
        }
        return true;
    }
    
    
    public function shareWithFriends($artist_id,$receiver_ids,$params){
        //$sender_id = JFactory::getUser()->id;
        $date = & JFactory::getDate();
        $db = JFactory::getDBO();
        $ip = $_SERVER['REMOTE_ADDR'];
        
        foreach($receiver_ids as $r_id){
            $query = $db->getQuery(true);
            $data = new stdClass();
            $data->id = null;
            $data->sender_id = $artist_id;
            $data->receiver_id = (int)$r_id;
            $data->post_content = JText::_('COM_SITEMAIN_ARTIST_UPLOAD_IMAGE_SHARE');
            $data->post_date = $date->toSql(TRUE);
            $data->ip = $ip;
            $param_array = $params;
            $data->param = $param_array;
            try{
                $db->insertObject('#__posts', $data, "post_id");
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            $data = null;
        }
        
        //echo "Model. saveNewPost function";
        return true;
        
    }


    public function getIfArtist(){
        $user = JFactory::getUser();
        $db = JFactory::getDbo();
        
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__artist');
        $query->where('user_id='.(string)$user->id);
        $db->setQuery((string)$query);
        $artist = $db->loadObject();
        
        if($artist == null){
            return false;
        }else{
            return true;
        }
        
        
    }
}
?>
