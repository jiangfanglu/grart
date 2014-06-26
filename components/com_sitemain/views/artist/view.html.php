<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewArtist extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $app = JFactory::getApplication();
            if(!$_GET['artist_id']){
                $app ->redirect(JURI::base());
            }
            $model =& $this ->getModel('Artist');
            $artist = $model -> getArtist($_GET['artist_id']);
            $partworks = $model -> getArtworks(1,$_GET['artist_id']);
            $artworks = $model -> getArtworks(0,$_GET['artist_id']);
            $follower_count = $model -> getFollowerCount($_GET['artist_id']);
            $reviews = $model -> getReviews($_GET['artist_id']);
            $totalreviews = $model -> getTotalReviewNumber($_GET['artist_id']);
            $partworks_count = count($partworks);
            
            $this ->assignRef('artist', $artist);
            $this ->assignRef('reviews', $reviews);
            $this ->assignRef('totalreviews', $totalreviews);
            $this ->assignRef('partworks', $partworks);
            $this ->assignRef('artworks', $artworks);
            $this ->assignRef('follower_count', $follower_count);
            $this ->assignRef('partworks_count', $partworks_count);
            
            $user = JFactory::getUser();
            $this ->assignRef('user', $user);
            
            $iffollowed = $model -> checkFollowStatus($_GET['artist_id'],$user->id);
            $this -> assignRef('iffollowed',$iffollowed);
            
            $followers = $model -> getFollowers($_GET['artist_id']);
            $this -> assignRef('followers',$followers);
            
            $this -> setSession($_GET['artist_id']);
            
            parent::display($tpl);
        }
        
        public function setSession($user_id){
              if(isset($_SESSION['recent_artists'])){
                  $exist = false;
                  foreach($_SESSION['recent_artists'] as $s){
                      if($s['user_id']==$user_id){
                          $exist = true;
                      }
                  }
                  if(!$exist){
                      $tmp = array(
                          'user_id' => $user_id
                      );
                      array_push($_SESSION['recent_artists'], $tmp);
                  }
              }else{
                  session_start();
                  $_SESSION['recent_artists'] = array();
                  $_SESSION['recent_artists'][0] = array(
                      'user_id' => $user_id
                  );
              }
          }
          
}
?>
