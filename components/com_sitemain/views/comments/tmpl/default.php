<?php
defined('_JEXEC') or die('Restricted access');
?>
 <?php $include_path = JPATH_SITE.DS.'includes'.DS.'comment_item.php' ?>
<?php foreach($this -> comments as $comment){ 
        $sender_thumb_path = DS . 'media' . DS . 'userthumbs' . DS . (string) $comment->user_id;
        if (JFolder::exists(JPATH_SITE . $sender_thumb_path)) {
                $thumb_path = '/media/userthumbs/' . (string)  $comment->user_id . '/thumb_120.jpg';
            } else {
                $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
            }
        ?>
    <?php include($include_path); ?>
    <?php } ?>
