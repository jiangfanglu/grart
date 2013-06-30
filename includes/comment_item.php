<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="comment_item">
    <div style="border: 1px solid #eee;">
        <a href>
            <img src="<?php echo $thumb_path ?>" alt="" title="" />
        </a>
    </div>
    <div class="comment_item_content" >
        <span class="name">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=artist&artist_id='.$comment->user_id)?>">
                <?php echo $comment->name ?>
            </a>
        </span><?php echo $comment->comment_content ?><br/>
        <span class="date"><?php echo $comment->comment_date ?></a></span>
    </div>
</div>