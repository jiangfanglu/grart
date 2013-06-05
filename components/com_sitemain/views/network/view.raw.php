<?php
defined('_JEXEC') or die('Restricted access');
class SitemainViewNetwork extends JViewLegacy
{
    public function display($tpl = null) {
        
        $user = JFactory::getUser();
        $model =& $this ->getModel('Network');
        $reviews = $model -> getReviews($user->id);
        $followers = $model -> getFollowers($user->id);
        $followeings = $model -> getFollowings($user->id);
        
        $this->assignRef('reviews', $reviews);
        $this->assignRef('followers', $followers);
        $this->assignRef('followeings', $followeings);
        parent::display($tpl);
    }
}
?>
