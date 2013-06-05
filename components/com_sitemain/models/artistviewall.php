<?php

defined('_JEXEC') or die('Restricted access');

class SitemainModelArtistviewall extends JModelItem
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
    
        public function getTotalReviewNumber($user_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT count(*) as total 
                FROM #__artwork_info ai 
                right join #__artwork_publish ap on ai.id = ap.artwork_id
                right join oc_review r on r.product_id = ap.product_id
                where ai.user_id = ".$user_id." and r.status = 1";
        $db->setQuery($query);
        $reviews = $db ->loadObject();
        return $reviews -> total;
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
    
    
    public function checkFollowStatus($a_id, $f_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__artist_follower where 
            artist_user_id =".(string)$a_id.' and follower_user_id='.(string)$f_id;
        $db->setQuery($query);
        $row = $db->loadObjectList();
        
        if(count($row) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function getFollowers($a_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select u.name as uname, af.* from #__artist_follower as af
                    inner join #__users as u
                    on af.follower_user_id = u.id
                    where af.artist_user_id = ".(string)$a_id." limit 50";
        $db->setQuery($query);
        $followerids = $db->loadObjectList();
        $current_user_id = JFactory::getUser()->id;
        $followers = array();
        $i=0;
        foreach($followerids as $fi){
            $query = $db->getQuery(true);
            $query = "select count(*) as f_count from #__artist_follower where artist_user_id=".(string)$fi->follower_user_id;
            $db->setQuery($query);
            $follower_count = $db->loadObject();
            
            $query = $db->getQuery(true);
            $query = "select count(*) as a_count from #__artwork_info where user_id=".(string)$fi->follower_user_id;
            $db->setQuery($query);
            $artwork_count = $db->loadObject();
            
            $followers[$i]=array(
                'follower_count' => $follower_count -> f_count,
                'artwork_count' => $artwork_count -> a_count,
                'follower' => $fi,
                'isfollowed' => $this->checkFollowStatus($fi->follower_user_id, $current_user_id)
                    );
            $i+=1;
        }
        return $followers;
    }
    
    public function getReviews($user_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT ap.product_id, r.text, r.date_added, customer_id, ap.artwork_id, ai.title, aim.filename, ai.user_id
                FROM #__artwork_info ai 
                right join #__artwork_publish ap on ai.id = ap.artwork_id
                right join oc_review r on r.product_id = ap.product_id 
                left join #__artwork_images aim on aim.artwork_id = ai.id 
                where ai.user_id = ".$user_id." and r.status = 1 and aim.hero=1 order by r.date_added desc limit 50";
        $db->setQuery($query);
        $reviews = $db ->loadObjectList();
        
        $arr_reviews = array();
        $n=0;
        foreach($reviews as $r){
            $arr_reviews[$n] = array(
                'review_item' => $r,
                'sender' => $this -> getUser($r->customer_id)
            );
            $n++;
        }
        return $arr_reviews;
    }
    
    public function getAllArtworks($artist_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('filename,title,description,meta_desc,category_id,ap.artwork_id,ATI.status,width,height,product_id');
        $query->from('#__artwork_info AS ATI');
        $query->join('inner','#__artwork_images AS ATIM on ATI.id = ATIM.artwork_id');
        $query->join('left','#__artwork_publish AS ap on ATI.id = ap.artwork_id');
        $query->where('ATI.user_id='.(string)$artist_id.' limit 50');
        
        $db->setQuery((string)$query);
        $images = $db->loadObjectList();
        return $images;
    }
}
?>
