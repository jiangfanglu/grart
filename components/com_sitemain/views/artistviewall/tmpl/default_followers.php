<?php

defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.folder');
?>

<?php foreach($this -> followers as $flr){ 
    
    $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.(string)$flr['follower']->follower_user_id;
    if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
        $thumb_path = '/media/userthumbs/'.(string)$flr['follower']->follower_user_id.'/thumb_120.jpg';
    }else{
        $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
    }
    
    ?>
<a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
    <img style="width:51px;" class="usr_thumb" src="<?php echo $thumb_path; ?>" />
</a>





<!--<div style="width:210px;background: #fff;margin:5px; float: left;">
    <div style="width:51px;margin:3px;border:1px solid #eee; font-family: Tahoma">
            <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
                <img style="width:51px;" class="usr_thumb" src="<?php echo $thumb_path; ?>" />
            </a>
    </div>
    <div style="width:141px; padding: 5px;">
        <div style="width:141px;  color: #000;font-weight: bold;">
            <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
                <?php echo $flr['follower']->uname; ?>
            </a>
        </div>
        <div style="width:141px; color:#ccc; font-size: 12px;">
            <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=artworks&artist_id='.$flr['follower']->follower_user_id ?>">
                <?php echo $flr['artwork_count']; ?> Artworks
            </a><br/>
            <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=followers&artist_id='.$flr['follower']->follower_user_id ?>">
                <?php echo $flr['follower_count']; ?> Followers
            </a>
        </div>
    </div>
</div>-->
<?php } ?>