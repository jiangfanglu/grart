<?php

defined('_JEXEC') or die('Restricted access');
class SitemainViewArtistviewall extends JViewLegacy
{
    function display($tpl=NULL){
        
        $app = JFactory::getApplication();
            if(!$_GET['artist_id']){
                $app ->redirect(JURI::base());
            }
            
            $model =& $this ->getModel('Artistviewall');
            $artist = $model -> getArtist($_GET['artist_id']);
            $partworks = $model -> getAllArtworks($_GET['artist_id']);
            $follower_count = $model -> getFollowerCount($_GET['artist_id']);
            $reviews = $model -> getReviews($_GET['artist_id']);
            $totalreviews = $model -> getTotalReviewNumber($_GET['artist_id']);
            $partworks_count = count($partworks);
            
            $this ->assignRef('artist', $artist);
            $this ->assignRef('reviews', $reviews);
            $this ->assignRef('totalreviews', $totalreviews);
            $this ->assignRef('partworks', $partworks);
            $this ->assignRef('follower_count', $follower_count);
            $this ->assignRef('partworks_count', $partworks_count);
            
            $user = JFactory::getUser();
            $this ->assignRef('user', $user);
            
            $iffollowed = $model -> checkFollowStatus($_GET['artist_id'],$user->id);
            $this -> assignRef('iffollowed',$iffollowed);
            
            $followers = $model -> getFollowers($_GET['artist_id']);
            $this -> assignRef('followers',$followers);
        parent::display($tpl);
    }
}
?>
