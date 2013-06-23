<?php
defined('_JEXEC') or die('Restricted access');
if($this -> iffollowed){
    $btn_text = '<input type="button" id="main_unfollow_btn" value="'.JText::_('COM_SITEMAIN_FOLLOWED').'" class="submit_btn" />';
}else if((int)JFactory::getUser()->id == (int)$_GET['artist_id']){
    $btn_text = "";
}else{
    $btn_text = '<input type="button" id="main_follow_btn" value="'.JText::_('COM_SITEMAIN_FOLLOW').'" class="submit_btn" />';
}

?>
<div id="artist_navigation">
    <div>
        <a href="<?php echo juri::base()."index.php?option=com_sitemain&view=artist&artist_id=".$_GET['artist_id']?>">
        <?php if(JFolder::exists(JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.JRequest::getVar('artist_id'))){?>
        <img src="/media/userthumbs/<?php echo JRequest::getVar('artist_id'); ?>/thumb_120.jpg" />
        <?php }else{ ?>
        <img src="/templates/shop_template/images/default_thumb_120.jpg" />
        <?php } ?>
        </a>
    </div>
    <div>
        <ul>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_STATUS') ?>
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_GALLERY') ?> (<?php echo $this -> partworks_count ; ?>)
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_FOLLOWERS') ?> (<?php echo $this -> follower_count -> f_count ; ?>)
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_PRODUCT_REVIEWS') ?>
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_ABOUT_ARTIST') ?>
                </a>
            </li>
        </ul>
        </div>
</div>
<div id="artist_header">
    
    <div id="artist_header_extra">
        <?php 
            $lang =& JFactory::getLanguage();
            $locales = $lang->getLocale();
            ?>
            
            <?php if($locales[0]=="zh_CN.utf8"){ ?>
                 <!-- Baidu Button BEGIN -->
                <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
                <span class="bds_more">分享到：</span>
                <a class="bds_qzone"></a>
                <a class="bds_tsina"></a>
                <a class="bds_tqq"></a>
                <a class="bds_renren"></a>
                <a class="bds_t163"></a>
                <a class="shareCount"></a>
                </div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                <!-- Baidu Button END -->
            <?php }else{ ?>
       
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_preferred_1"></a>
                <a class="addthis_button_preferred_2"></a>
                <a class="addthis_button_preferred_3"></a>
                <a class="addthis_button_preferred_4"></a>
                <a class="addthis_button_compact"></a>
                <a class="addthis_counter addthis_bubble_style"></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-518ddce9075880ba"></script>
                <!-- AddThis Button END -->
        <?php } ?>
    </div>
    <div id="artist_header_name">
        <div>
            <?php echo $this-> artist['artist'] -> artist_name; ?> <?php //echo $this-> artist['region'].' <b>'.$this-> artist['country'].'</b>'; ?>
        </div>
        <div style="padding:5px 10px;">
            <?php echo $btn_text; ?>
                <input type="hidden" id="artist_id" value="<?php echo $_GET['artist_id'] ;?>" />
                <input type="hidden" id="user_id" value="<?php echo $this -> user -> id ;?>" /> 
        </div>  
    </div>
    <div id="artist_header_nav">
        <ul>
            <li class="<?php echo JRequest::getVar('view') == 'artist' ? 'active' : ''?>">
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=artist&artist_id='.JRequest::getVar('artist_id')) ?>">
                    <?php echo JText::_('COM_SITEMAIN_STATUS') ?>
                </a>
            </li>
            <li>|</li>
            <li class="<?php echo JRequest::getVar('view') == 'artist_gallery' ? 'active' : ''?>">
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_GALLERY') ?> (<?php echo $this -> partworks_count ; ?>)
                </a>
            </li>
            <li>|</li>
            <li class="<?php echo JRequest::getVar('view') == 'artist_friends' ? 'active' : ''?>">
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_FOLLOWERS') ?> (<?php echo $this -> follower_count -> f_count ; ?>)
                </a>
            </li>
            <li>|</li>
            <li class="<?php echo JRequest::getVar('view') == 'artist_reviews' ? 'active' : ''?>">
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_PRODUCT_REVIEWS') ?>
                </a>
            </li>
            <li>|</li>
            <li class="<?php echo JRequest::getVar('view') == 'artist_about' ? 'active' : ''?>">
                <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                    <?php echo JText::_('COM_SITEMAIN_ABOUT_ARTIST') ?>
                </a>
            </li>
        </ul>
    </div>
    <div id="artist_header_user">
        <a href="<?php echo juri::base()."index.php?option=com_sitemain&view=artist&artist_id=".$_GET['artist_id']?>">
        <?php if(JFolder::exists(JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.JRequest::getVar('artist_id'))){?>
        <img src="/media/userthumbs/<?php echo JRequest::getVar('artist_id'); ?>/thumb_120.jpg" />
        <?php }else{ ?>
        <img src="/templates/shop_template/images/default_thumb_120.jpg" />
        <?php } ?>
        </a>
    </div>
</div>
<script>

$('main_follow_btn').addEvent('click',function(e){
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