<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 */
class SitemainModelArtists extends JModelItem
{
    public function getArtists(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select u.name, a.user_id as uid, profile_key, profile_value from #__artist as a
                inner join #__users as u on a.user_id = u.id
                left join #__user_profiles up on a.user_id = up.user_id 
                where profile_key = 'profile.country'";
        $db->setQuery($query);
        $artistsids = $db->loadObjectList();
        
        $artists = array();
        $i=0;
        foreach($artistsids as $fi){
            $artists[$i] = $this -> iterateArtists($fi);
            $i+=1;
        }
        return $artists;
    }
    
    public function getArtistsBySearchName($keyword){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select u.name, a.user_id as uid, profile_key, profile_value from #__artist as a
                inner join #__users as u on a.user_id = u.id
                left join #__user_profiles up on a.user_id = up.user_id 
                    where profile_key = 'profile.country' and u.name like '%".(string)$keyword."%'";
        $db->setQuery($query);
        $artistsids = $db->loadObjectList();
        
        $artists = array();
        $i=0;
        foreach($artistsids as $fi){
            $artists[$i] = $this -> iterateArtists($fi);
            $i+=1;
        }
        return $artists;
    }
    
    function iterateArtists($artist){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select count(*) as f_count from #__artist_follower where artist_user_id=".(string)$artist->uid;
        $db->setQuery($query);
        $follower_count = $db->loadObject();

        $query = $db->getQuery(true);
        $query = "select count(*) as a_count from #__artwork_info where user_id=".(string)$artist->uid;
        $db->setQuery($query);
        $artwork_count = $db->loadObject();

        $artist=array(
            'follower_count' => $follower_count -> f_count,
            'artwork_count' => $artwork_count -> a_count,
            'artist' => $artist
                );
        return $artist;
    }
}
?>
