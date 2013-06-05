<?php
/*News Ltter*/
defined('_JEXEC') or die('Restricted access');
 
class SitemainModelNewsletter extends JModelItem
{
    public function getCategories($require_register=NULL){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        if($require_register==0){
            $query = "select * from #__newsletter_category where require_register = ".$require_register;
        }else{
            $query = "select * from #__newsletter_category";
        }
        
        $db->setQuery($query);
        $categories = $db->loadObjectList();
        return $categories;
    }
    
    public function checkIfSubscribed($email=NULL){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__newsletter_subscription where email='".$email."' and subscribed = 1" ;
        
        $db->setQuery($query);
        $subscriber = $db->loadObject();
        
        if(count($subscriber)>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function getUserEmail($user_id=null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__users where id=".$user_id;
        
        $db->setQuery($query);
        $subscriber = $db->loadObject();
        return $subscriber->email;
    }
    
    public function subscribe($dataa){
        $db = JFactory::getDbo();
        if($this -> checkIfSubscribed($dataa['email'])){
            return false;
        }else{
            $data =new stdClass();
            $data->id = null;
            $data->email = $dataa['email'];
            $data->name = $dataa['name'];
            $data->subscribed = 1;
            $data->registered = $dataa['registered'];
            try{
                $db->insertObject( '#__newsletter_subscription', $data, id );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            $nsid = $db->insertId();

            foreach($dataa['topics'] as $t){
                $query = $db->getQuery(true);
                $query->insert('#__newsletter_category_subscription'); 
                $query->set('`ns_id`='.(string)$nsid);
                $query->set('`ns_category_id`='.(string)$t);
                try{
                    $db->setQuery($query);
                    $db->query();
                }catch(Exception $e){
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }

            return true;
        }
        
    }
    public function unsubscribe($data){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "update #__newsletter_subscription set subscribed = 0 where email=".$data['email'];
        
        try{
            $db->setQuery($query);
            $db->query();
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        return true;
    }
}
?>
