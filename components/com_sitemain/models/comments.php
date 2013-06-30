<?php

defined('_JEXEC') or die('Restricted access');

class SitemainModelComments extends JModelItem
{
    function getComments($post_id){
        if(isset($_GET['page'])){
            $page = JRequest::getVar('page');
        }else{
            $page = 1;
        }
        $per_page = 3;
        $limit = $page*$per_page;
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT c.*, u.name FROM #__comments c 
                inner join #__users u on u.id = c.user_id 
                WHERE post_id = " . $post_id." order by comment_date desc limit " . (string)$limit;
        $db->setQuery($query);
        $comments = $db->loadObjectList();
        return $comments;
    }
    
    function saveNewComment($data_comment){
        $sender_id = JFactory::getUser()->id;
        $date = & JFactory::getDate();
        // $date->setOffset(1); to set the time zong. Not working.
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = new stdClass();
        $data->id = null;
        $data->user_id = $sender_id;
        $data->post_id = (int)$data_comment['post_id'];
        $data->comment_content = $data_comment['comment_content'];
        $data->comment_date = $date->toSql(TRUE);
        $data->ip = $ip;
        $db = JFactory::getDBO();
        //$query = $db->getQuery(true);
        $db->insertObject('#__comments', $data, "comment_id");
        //echo "Model. saveNewPost function";
        return true;
    }

}


?>
