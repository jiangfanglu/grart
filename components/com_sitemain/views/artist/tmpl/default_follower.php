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
        <a id="follower_link_<?php echo $flr['follower']->follower_user_id ?>" href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
            <img class="usr_thumb" src="<?php echo $thumb_path; ?>" />
        </a>

<div id="follower_box_<?php echo $flr['follower']->follower_user_id ?>" class="follower_box">
    <div class="follower_box_thumb">
        <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
                <img src="<?php echo $thumb_path; ?>" />
         </a>
    </div>
    <div class="">
        <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$flr['follower']->follower_user_id ?>">
             <?php echo $flr['follower']->uname; ?>
         </a>
    </div>
    <div class="follower_box_count">
            <div>
                <img src="/templates/shop_template/images/image.png" /></div>
            <div>
                <?php echo $flr['artwork_count']; ?>
            </div>
            <div> | </div>
            <div>
                <img src="/templates/shop_template/images/users.png" /></div>
            <div>
                <?php echo $flr['follower_count']; ?>
            </div>
    </div>
    <div class="follower_box_this">
        <img src="/templates/shop_template/images/this.png" />
    </div>
</div>

<script>
jQuery("#follower_link_<?php echo $flr['follower']->follower_user_id ?>").mouseenter(function(){
    var p = jQuery("#follower_link_<?php echo $flr['follower']->follower_user_id ?>").position();
    jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").css('left',p.left-10);
    jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").css('top',p.top-215);
    jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").fadeIn('fast');
});
jQuery("#follower_link_<?php echo $flr['follower']->follower_user_id ?>").mouseleave(function(){
     setTimeout(function(){ 
         if (!jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").is(':hover')){
            jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").fadeOut('fast');
         }
     },2000);
});
jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").mouseleave(function(){
    jQuery("#follower_box_<?php echo $flr['follower']->follower_user_id ?>").fadeOut('fast');
});
</script>

<?php } ?>
<script>
    $('other_follow').addEvent('click',function(e){
         e.stop();
         if($('user_id').value == '0'){
            window.location.href = "/index.php?option=com_opencart&route=account/login";
            return;
         }
         $('main_follow_btn').value = 'Processing';
         var url = '/index.php?option=com_sitemain&task=addFollower';
         var a = new Request({
              url: url,
              method: 'post',
              onSuccess:function(response){
                   $('info_alert').style.display = 'block';
                   $("info_text").innerHTML = 'You have successfully followed this artist';
                   $('main_follow_btn').value = 'Followed';
                   $('main_follow_btn').disabled = true;
              },
              onError:function(){
                    $('info_alert').style.display = 'block';
                    $("info_text").innerHTML = 'Bad';
                }
         }).post({'follower_id':$('user_id').value,
                  'artist_id':$('artist_id').value  });
    });
</script>