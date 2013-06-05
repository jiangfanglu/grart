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
<div class="arty_fans_item">
    <div class="arty_fans_item_img">
        <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
            <img class="usr_thumb" src="<?php echo $thumb_path; ?>" />
        </a>
    </div>
    <div class="arty_fans_item_info" style="font-size: 14px;">
         <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
             <?php echo $flr['follower']->uname; ?>
         </a>
    </div>
    <div class="arty_fans_item_btn">
        <div style="width:80px;float:left;">
            <div class="padding-top1"><img class="arty_no" src="/templates/shop_template/images/artwork_logo.gif" /></div>
            <div class="padding-top1">
                <?php echo $flr['artwork_count']; ?>
            </div>
            <div class="padding-top1"> | </div>
            <div class="padding-top1"><img class="arty_fan" src="/templates/shop_template/images/fans_logo.gif" /></div>
            <div class="padding-top1">
                <?php echo $flr['follower_count']; ?>
            </div>
        </div>
        <?php
        if($flr['isfollowed']){
            $butn_value = "Followed";
            $btn_disable = "disabled='true'";
        }else if((int)$this->user->id == (int)$flr['follower']->follower_user_id){
            $butn_value = "Followed";
            $btn_disable = "disabled='true'";
        }else{
            $butn_value = "Follow";
            $btn_disable = "";
        }
        ?>
        <div class="sty_btn_toright"><input type="button" class="submit_btn" value="<?php echo $butn_value; ?>" <?php echo $btn_disable; ?> /></div>

    </div>
</div>
<?php } ?>