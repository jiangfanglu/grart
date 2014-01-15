<?php

defined('_JEXEC') or die('Restricted access');
class SitemainViewComments extends JViewLegacy
{
    function display($tpl=NULL){
        $post_id = JRequest::getVar('post_id');
        $model =& $this->getModel('Comments');
        $comments = $model->getComments($post_id);
        $this->assignRef('comments', $comments);
        parent::display($tpl);
    }
}
?>
