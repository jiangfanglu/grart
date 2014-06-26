<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 */
class SitemainModelArtistprofile extends JModelItem
{
    
    public function getArtistProfile($user_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__artist where user_id=".(string)$user_id;
        $db->setQuery($query);
        $artist = $db->loadObject();
        return $artist;
    }
    
    public function updateArtistProfile($data){
        $user = JFactory::getUser();
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $fields = array("portfolio='".$data['portfolio']."'",
            "website_url='".$data['websiteurl']."'");

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
