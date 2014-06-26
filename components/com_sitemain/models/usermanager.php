<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 */
class SitemainModelUsermanager extends JModelItem
{
    public function getArtist(){
        $user = JFactory::getUser();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__artist');
        $query->where('user_id='.(string)$user->id);
        $db->setQuery((string)$query);
        $artist = $db->loadObject();
        
        return $artist;
    }
    
    public function registerArtist(){
        $user = JFactory::getUser();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->insert('#__artist'); 
        $query->set('`user_id`='.(string)$user->id);
        $db->setQuery($query);
        $db->query();
        
        return true;
    }
    
    public function updatePortfolio($data){
        $user = JFactory::getUser();
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $fields = array("portfolio='".$data['portfolio']."'");

        $conditions = array(
            'user_id='.(string)$user -> id);

        $query->update($db->quoteName('#__artist'))->set($fields)->where($conditions);

        $db->setQuery($query);

        try {
            $result = $db->query(); 
        } catch (Exception $e) {
        }
        
        return true;
    }
}

?>
