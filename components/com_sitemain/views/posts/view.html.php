<?php

defined('_JEXEC') or die('Restricted access');
class SitemainViewPosts extends JViewLegacy
{
    function display($tpl=NULL){
        $artist_id = JRequest::getVar('artist_id');
        $user = JFactory::getUser();
        $model =& $this->getModel('Posts');
        $post = $model->getAllPosts($artist_id);
        $this->assignRef('posts', $post);
        $this->assignRef('artist_id', $artist_id);
        $this->assignRef('current_user', $user);
        parent::display($tpl);
    }
}
?>
