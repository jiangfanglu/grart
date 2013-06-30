<?php

defined('_JEXEC') or die('Restricted access');
$sender_id = JFactory::getUser()->id;
?>
<div id="compose_post">
        <form name="wall" id="wall"  method="get" >
            <div class="posts_item_line">
                <div class="share_icon">
                    <img src="/templates/shop_template/images/pen_active.png" style="width:20px;" />
                </div>
                <div class="share_icon">
                    <img src="/templates/shop_template/images/camera-2.png" style="width:20px;" />
                </div>
            </div>
            <div class="posts_item_line status_content">
                <textarea id="content" name="content" style="color:#ddd;"><?php echo JText::_('COM_SITEMAIN_WRITE_SOMETHING')?></textarea>
                <input type="hidden" id="sender_id" value= '<?php echo $sender_id  ?>'>
                <input type="hidden" id="isplain_content" value= '1'>
                <input type="hidden" id="artist_id" value=' <?php echo $this ->artist_id  ?>'>
            </div>
            <div class="posts_item_line" style="text-align: right;">
                <input type="button" id="new_post" onclick="saveNewPost(1,2);" value="<?php echo JText::_('COM_SITEMAIN_SHARE')?>" class="submit_btn">
            </div>
        </form>


    </div>
<script>
jQuery('#content').focus(function(){
    if(jQuery(this).html()=='<?php echo jText::_('COM_SITEMAIN_WRITE_SOMETHING')?>'){
        jQuery(this).html('');
    }
    jQuery(this).css('color','#2e2d2d');
});
jQuery('#content').focusout(function(){
    if(jQuery(this).html()==""){
        jQuery(this).html('<?php echo jText::_('COM_SITEMAIN_WRITE_SOMETHING')?>');
    }
    jQuery(this).css('color','#ddd');
});
</script>

<?php foreach ($this -> posts as $post) {
            $sender_thumb_path = DS . 'media' . DS . 'userthumbs' . DS . (string) $post->sender_id;
            // $receiver_thumb_path = DS . 'media' . DS . 'userthumbs' . DS . (string) $post->receiver_id;
            if (JFolder::exists(JPATH_SITE . $sender_thumb_path)) {
                $thumb_path = '/media/userthumbs/' . (string)  $post['post']->sender_id . '/thumb_120.jpg';
            } else {
                $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
            }
            if($post['post']->param!=""){
                $arry = explode(',',$post['post']->param);
                $param_array = array(
                    'media_url'=>$arry[0],
                    'url'=>$arry[1],
                    'title'=>$arry[2],
                    'content'=>$arry[3]
                );
            }
            ?>

<div class="posts_item" id="post_<?php echo $post['post']->post_id ?>">
    <div class="posts_item_line">
        <div class="posts_item_user">
            <a href="index.php?option=com_sitemain&view=artist&artist_id=698">
                <img src="<?php echo $thumb_path ?>" title=''  alt='' />
            </a>
        </div>
        <div class="posts_item_bio">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=artist&artist_id='.$post['post']->sender_id) ?>" >
                <?php echo $post['post']->name ?>
            </a>
            <span style="color:#000!important;"><?php echo JText::_('COM_SITEMAIN_SHARED')?></span>
 <?php echo $post['post']->post_content ?><br/>
            <span style="color:#ccc!important;font-size: 12px!important;"><?php echo $post['post']->post_date ?></span>
            
        </div>
        <?php 
        if($this->current_user->id == $post['post']->sender_id){?>
        <div class="posts_item_contrl" id="post_ctrl_<?php echo $post['post']->post_id ?>">
            <img src="/templates/shop_template/images/pen_active.png" />
        </div>
        <div>
            
        </div>
        <script>
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').mouseenter(function(){
                var p = jQuery(this).position();
                setCaptionText('<?php echo JText::_('COM_SITEMAIN_EDIT') ?>');
                jQuery('#img_caption').css('top',p.top+15);
                jQuery('#img_caption').css('left',p.left-15);
                jQuery('#img_caption').css('display','table');
            });
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').mouseleave(function(){
                jQuery('#img_caption').hide();
            });
        </script>
        <?php }else{ ?>
        <div class="posts_item_contrl" 
             id="post_ctrl_<?php echo $post['post']->post_id ?>">
            <img src="/templates/shop_template/images/close.png" />
        </div>
        <script>
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').mouseenter(function(){
                var p = jQuery(this).position();
                setCaptionText('<?php echo JText::_('COM_SITEMAIN_HIDE') ?>');
                jQuery('#img_caption').css('top',p.top+15);
                jQuery('#img_caption').css('left',p.left-15);
                jQuery('#img_caption').css('display','table');
            });
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').mouseleave(function(){
                jQuery('#img_caption').hide();
            });
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').click(function(){
                jQuery('#post_<?php echo $post['post']->post_id ?>').fadeOut('fast');
            });
        </script>
        <?php } ?>
        
    </div>
    
    <?php if($post['post']->param!=""){ ?>
        <div class="posts_item_line posts_content_content">
            <div>
                <a href="<?php echo $param_array['url'] ?>">
                    <img src="<?php echo $param_array['media_url'] ?>" alt="" title="" />
                </a>
            </div>
            <div class="posts_content_content_right">
                <div>
                    <div class="posts_content_content_right_title">
                        <a href="<?php echo $param_array['url'] ?>">
                            <?php echo $param_array['title'] ?>
                        </a>
                    </div>
                    <div class="posts_content_content_right_content">
                        <?php echo $param_array['content'] ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="posts_item_line">
        <div class="posts_functions">
            <a href="#" onclick="return add_like()"><?php echo JText::_('COM_SITEMAIN_LIKE')?></a>
            <a id="comment_link_<?php echo $post['post']->post_id ?>"><?php echo JText::_('COM_SITEMAIN_COMMENT')?></a>
            <a href="#" onclick="return add_share()"><?php echo JText::_('COM_SITEMAIN_SHARE_IN_GRART')?></a>
        </div>
        <div class="posts_content_content_right_share" id="share_<?php echo $post['post']->post_id ?>">
            <div class="sptw">
                <?php echo JText::_('COM_SITEMAIN_SPREAD_THE_WORD') ?>
            </div>
            <div>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-qq.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-qqweibo.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-qzone.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-sinaweibo.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-renren.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-kaixin001.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-douban.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-flickr.png" /></a>
                <a href=""><img src="/templates/shop_template/images/social_icons/cn/16/16-google.png" /></a>
            </div>
        </div>
    </div>
</div>
<script>
        jQuery('#post_<?php echo $post['post']->post_id ?>').mouseenter(function(){
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').css('display','table');
            jQuery('#share_<?php echo $post['post']->post_id ?>').css('display','table');
        });
        jQuery('#post_<?php echo $post['post']->post_id ?>').mouseleave(function(){
            jQuery('#post_ctrl_<?php echo $post['post']->post_id ?>').hide();
            jQuery('#share_<?php echo $post['post']->post_id ?>').hide();
        });
    </script>
    <div class="add_comment" id="add_comment_<?php echo $post['post']->post_id ?>">
        <?php 
        $sender_thumb_path = DS . 'media' . DS . 'userthumbs' . DS . (string) $this->current_user->id;
        if (JFolder::exists(JPATH_SITE . $sender_thumb_path)) {
                $thumb_path = '/media/userthumbs/' . (string)  $this->current_user->id . '/thumb_120.jpg';
            } else {
                $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
            }
        ?>
        <div style="border: 1px solid #eee;">
            <a href="">
                <img src="<?php echo $thumb_path ?>" alt="" title="" />
            </a>
        </div>
        <div style="margin:-2px 0px 0px 5px;">
            <textarea id="comment_content_<?php echo $post['post']->post_id ?>" 
                      name="comment_content_<?php echo $post['post']->post_id ?>"><?php echo jText::_('COM_SITEMAIN_COMMENT')?></textarea>
        </div>
        <script>
        jQuery('#comment_content_<?php echo $post['post']->post_id ?>').keydown(function(event){
            if(event.which == 13)
            {
                event.preventDefault();
                saveNewComment('comments_<?php echo $post['post']->post_id ?>',
                <?php echo $post['post']->post_id ?>,
                    'comment_content_<?php echo $post['post']->post_id ?>');
            }     
         });
         </script>
    </div>
    <script>
        jQuery('#comment_link_<?php echo $post['post']->post_id ?>').click(function(){
            <?php if($this->current_user->id == 0){ ?>
                jQuery('#login_anywhere_out').fadeIn('slow');
            <?php }else{ ?>
                jQuery('#add_comment_<?php echo $post['post']->post_id ?>').css('display','table');
            <?php } ?>
        });
        jQuery('#comment_content_<?php echo $post['post']->post_id ?>').focus(function(){
            if(jQuery(this).html()=='<?php echo jText::_('COM_SITEMAIN_COMMENT')?>'){
                jQuery(this).html('');
            }
            jQuery(this).css('color','#2e2d2d');
        });
        jQuery('#comment_content_<?php echo $post['post']->post_id ?>').focusout(function(){
            if(jQuery(this).html()==""){
                jQuery(this).html('<?php echo jText::_('COM_SITEMAIN_COMMENT')?>');
            }
            jQuery(this).css('color','#ddd');
        });
    </script>
    <div id="comments_<?php echo $post['post']->post_id ?>" class="share_comments">
        <?php $include_path = JPATH_SITE.DS.'includes'.DS.'comment_item.php' ?>
    <?php foreach($post['comments'] as $comment){ 
        $sender_thumb_path = DS . 'media' . DS . 'userthumbs' . DS . (string) $comment->user_id;
        if (JFolder::exists(JPATH_SITE . $sender_thumb_path)) {
                $thumb_path = '/media/userthumbs/' . (string)  $comment->user_id . '/thumb_120.jpg';
            } else {
                $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
            }
        ?>
        <?php include($include_path); ?>
    <?php } ?>
        </div>
       <?php if($post['total_comments'] >  count($post['comments'])){ ?>
            <div onclick="loadMoreComment('comments_<?php echo $post['post']->post_id ?>',<?php echo $post['post']->post_id ?>)" id="loadmore_<?php echo $post['post']->post_id ?>" class="loadmore">
                <input type="hidden" id="current_comment_page_<?php echo $post['post']->post_id ?>" name="current_comment_page_<?php echo $post['post']->post_id ?>" value="1" />
                <?php echo JText::_('COM_SITEMAIN_SHOW_MORE').JText::_('COM_SITEMAIN_COMMENT') ?>
            </div>
        <?php } ?>
<?php } ?>