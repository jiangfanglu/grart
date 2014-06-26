<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 */
class SitemainModelArtistgallery extends JModelItem
{
    public function getArtist($artist_id = null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__user_profiles');
        $query->where('user_id='.$artist_id);
        $db->setQuery((string)$query);
        $user_profiles = $db->loadObjectList();
        
        $query = $db->getQuery(true);
        $query->select('name as artist_name,portfolio, website_url');
        $query->from('#__users as u');
        $query->join('inner', '#__artist as a on u.id = a.user_id');
        $query->where('a.user_id='.$artist_id);
        $db->setQuery($query);
        $artist_obj = $db->loadObject();
        
        $country='';
        $city='';
        $region='';
        foreach($user_profiles as $up){
            if($up->profile_key == 'profile.country'){
                $country = $up->profile_value;
            }
            if($up->profile_key == 'profile.city'){
                $city = $up->profile_value;
            }
            if($up->profile_key == 'profile.region'){
                $region = $up->profile_value;
            }
        }
        $artist=array(
            'artist' => $artist_obj,
            'country' => $country,
            'region' => $region,
            'city' => $city
        );
        return $artist;
    }
    
    public function getFollowerCount($user_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select count(*) as f_count from #__artist_follower where artist_user_id=".(string)$user_id;
        $db->setQuery((string)$query);
        $follower = $db->loadObject();
        return $follower;
    }
    
    public function getHeroImageFileName($artwork_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT filename, user_id FROM #__artwork_info ai
                inner join #__artwork_images aim on ai.id = aim.artwork_id
                where hero = 1 and artwork_id = 14".$artwork_id;
        $db->setQuery($query);
        $filename = $db ->loadObject();
        return $filename;
    }
    
    public function getUser($customer_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT u.name, u.id as user_id FROM #__users u
                    inner join oc_customer c on c.email = u.email
                    where customer_id = ".$customer_id;
        $db->setQuery($query);
        $user = $db ->loadObject();
        return $user;
    }
    
    public function getArtworks($status = null, $artist_id=null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('filename,title,description,meta_desc,category_id,ATIM.id as artwork_image_id,ap.artwork_id,ATI.status,width,height,product_id');
        $query->from('#__artwork_info AS ATI');
        $query->join('inner','#__artwork_images AS ATIM on ATI.id = ATIM.artwork_id');
        $query->join('left','#__artwork_publish AS ap on ATI.id = ap.artwork_id');
        if($status == 1){
            $query->where('ATI.user_id='.(string)$artist_id.' and ATI.status =1 and ATIM.hero = 1');
        }else{
            $query->where('ATI.user_id='.(string)$artist_id.' and ATI.status=0 ');
        }
        
        
        $db->setQuery((string)$query,0,30);
        $images = $db->loadObjectList();
        return $images;
    }
    
    
    
}
?>
