<?php
defined('_JEXEC') or die('Restricted access');

class SitemainModelNetwork extends JModelItem
{
        public function getFollowers($a_id){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query = "select u.name as uname, af.* from #__artist_follower as af
                        inner join #__users as u
                        on af.follower_user_id = u.id
                        where af.artist_user_id = ".(string)$a_id;
            $db->setQuery($query);
            $followerids = $db->loadObjectList();

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
                    'follower' => $fi
                        );
                $i+=1;
            }
            return $followers;
        }
        
        public function getFollowings($a_id){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query = "select u.name as uname, af.* from #__artist_follower as af
                        inner join #__users as u
                        on af.follower_user_id = u.id
                        where af.follower_user_id = ".(string)$a_id;
            $db->setQuery($query);
            $followerids = $db->loadObjectList();

            $following = array();
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
                    'following' => $fi
                        );
                $i+=1;
            }
            return $following;
        }
    
        public function getReviews($user_id){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query = "SELECT ap.product_id, r.text, r.date_added, customer_id, ap.artwork_id, ai.title 
                    FROM #__artwork_info ai 
                    right join #__artwork_publish ap on ai.id = ap.artwork_id
                    right join oc_review r on r.product_id = ap.product_id
                    where ai.user_id = ".$user_id." and r.status = 1 
                    order by r.date_added desc";
            $db->setQuery($query);
            $reviews = $db ->loadObjectList();

            $arr_reviews = array();
            $n=0;
            foreach($reviews as $r){
                $arr_reviews[$n] = array(
                    'review_item' => $r,
                    'sender' => $this -> getUser($r->customer_id),
                    'image_url' => $this -> getHeroImageFileName($r -> artwork_id)
                );
                $n++;
            }
            return $arr_reviews;
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
        $query = "SELECT filename, ai.user_id, ai.title FROM #__artwork_info ai
                inner join #__artwork_images aim on ai.id = aim.artwork_id
                where hero = 1 and artwork_id = ".$artwork_id;
        $db->setQuery($query);
        $filename = $db ->loadObject();
        return $filename;
    }
    
    public function getUser($customer_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT u.name, u.id as user_id FROM #__users u
                    inner join joomla.oc_customer c on c.email = u.email
                    where customer_id = ".$customer_id;
        $db->setQuery($query);
        $user = $db ->loadObject();
        return $user;
    }
}
?>
