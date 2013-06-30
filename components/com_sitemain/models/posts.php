<?php

defined('_JEXEC') or die('Restricted access');

class SitemainModelPosts extends JModelItem
{
    public function getAllPosts($artist_id) {
        $postsAndComments = array();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT p.*, u.name FROM #__posts p
            right join #__users u on p.sender_id = u.id
            WHERE status=1 and (sender_id = " . $artist_id . " OR receiver_id = " . $artist_id.") 
            order by post_date desc limit 20";
        $db->setQuery($query);
        $posts = $db->loadObjectList();
        
        foreach ($posts as $post) {
            $post_id = $post->post_id;
            $query = $db->getQuery(true);
            $query = "SELECT c.*, u.name FROM #__comments c 
                inner join #__users u on u.id = c.user_id 
                WHERE post_id = " . $post_id." order by comment_date desc limit 3";
            $db->setQuery($query);
            $comments = $db->loadObjectList();
            
            $query = $db->getQuery(true);
            $query = "select count(*) as totalcount from #__comments where post_id = " . $post_id;
            $db->setQuery($query);
            $comments_total = $db->loadObject();
            
            $postsAndComments[$post_id] = array(
                'post' => $post,
                'comments' => $comments,
                'total_comments'=>$comments_total->totalcount
            );
        }
        return $postsAndComments;
    }
    
    public function saveNewPost($dataa) {
        $sender_id = JFactory::getUser()->id;
        $date = & JFactory::getDate();
        // $date->setOffset(1); to set the time zong. Not working.
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = new stdClass();
        $data->id = null;
        $data->sender_id = $sender_id;
        $data->receiver_id = (int)$dataa['artist_id'];
        $data->post_content = $dataa['content'];
        $data->post_date = $date->toSql(TRUE);
        $data->ip = $ip;
        if($dataa['isplain_content']!='1'){
            
            $param_array = 'media_url,url,title,content';
        }else{
            $param_array = "";
        }
        $data->param = $param_array;
        $db = JFactory::getDBO();
        //$query = $db->getQuery(true);
        $db->insertObject('#__posts', $data, "post_id");
        //echo "Model. saveNewPost function";
        return true;
    }

}


?>
