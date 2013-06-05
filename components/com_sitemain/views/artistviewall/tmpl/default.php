<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.folder');
if($this -> iffollowed){
    $btn_text = "Followed";
    $disabled = "disabled='true'";
}else if((int)JFactory::getUser()->id == (int)$_GET['artist_id']){
    $btn_text = "Self";
    $disabled = "disabled='true'";
}else{
    $btn_text = "Follow";
    $disabled = "";
}
?>
<div id="info_alert" class="alert alert-error" style="display: none">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <span id="info_text">
        </span>
</div>
<div class="full_screen" style="margin-top: 10px;" id="artist_content">
    <?php if($this->artist['artist'] == null){ ?>
         <h2>He/She is not an artist yet, no profile page is provided, Sorry !</h2> <br/>
         <a href="/">Back</a>
    <?php }else{ ?>
    <div id="artist_left">
        <div class="thumb_120">
            <a href="<?php echo juri::base()."index.php?option=com_sitemain&view=artist&artist_id=".$_GET['artist_id']?>">
            <?php if(JFolder::exists(JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.JRequest::getVar('artist_id'))){?>
            <img src="/media/userthumbs/<?php echo JRequest::getVar('artist_id'); ?>/thumb_120.jpg" />
            <?php }else{ ?>
            <img src="/templates/shop_template/images/default_thumb_120.jpg" />
            <?php } ?>
            </a>
        </div>
        <div class="artist_region">
            <div class="line_s">
                <a href="<?php echo JUri::base()."index.php?option=com_sitemain&view=artist&artist_id=".$_GET['artist_id'] ?>">
                    <?php echo $this-> artist['artist'] -> artist_name; ?>
                </a>
            </div>
            <div class="line">
                <?php echo $this-> artist['region'].' <b>'.$this-> artist['country'].'</b>'; ?>
            </div>
        </div>
        <div style="width:150px;margin-top: 5px;">
                
                <input type="button" id="main_follow_btn" value="<?php echo $btn_text; ?>" class="submit_btn" <?php echo $disabled; ?> />
                <input type="hidden" id="artist_id" value="<?php echo $_GET['artist_id'] ;?>" />
                <input type="hidden" id="user_id" value="<?php echo $this -> user -> id ;?>" /> 
                <input type="button" id="main_message_btn" value="Message" class="submit_btn" />
            </div>
        <div class="arty_status">
            <div id="arty_potfolio">
                About
            </div>
<!--            <div id="arty_portfolio_content" onmouseout="hideStuff(this)">
                <div><?php echo strip_tags($this -> artist['artist'] -> portfolio) ?></div>
                <div onclick="closeStuff('arty_portfolio_content')"  style="float: right; cursor: pointer;"><img src="/templates/shop_template/images/cross.gif" /></div>
            </div>-->
            <div id="arty_portfolio_content_alt">
                <div id="ctn_half"><?php echo strlen(strip_tags($this -> artist['artist'] -> portfolio)) > 100 ? substr(strip_tags($this -> artist['artist'] -> portfolio),0,100)."..." : strip_tags($this -> artist['artist'] -> portfolio) ?>
                    <a id="p_readmore">Read more</a>
                </div>
                <div id="ctn_full" style="display:none;">
                    <?php echo strip_tags($this -> artist['artist'] -> portfolio) ?> <a id="p_readless">Read less</a>
                
                </div>
                <script>
                    jQuery('#p_readmore').click(function(){
                        jQuery('#ctn_half').css('display','none');
                        jQuery('#ctn_full').fadeIn('Fast');
                    });
                    jQuery('#p_readless').click(function(){
                        jQuery('#ctn_full').css('display','none');
                        jQuery('#ctn_half').fadeIn('Fast');
                    });
                </script>
            </div>
            <div id="arty_website">
                Website
            </div>
            <div id="arty_website_content">
                <?php 
                    if($this -> artist['artist'] -> website_url == null){
                        $webiste_url = "<div class='sub_message'>No webiste URL provided</div>";
                    }else{
                        $webiste_href = $this -> artist['artist'] -> website_url;
                        $webiste_url = strlen($this -> artist['artist'] -> website_url) > 20 ? substr($this -> artist['artist'] -> website_url,0,20).'...' : $this -> artist['artist'] -> website_url;
                    }
                ?>
                <div><a href="http://<?php echo  $webiste_url ;  ?>" target="_blank"><?php echo $webiste_url ;  ?></a></div>
            </div>
            
            <div id="arty_numbers" onMouseOut="closeStuff('img_caption')" onMouseOver="setCaptionText('Artworks');showStuff('arty_numbers','img_caption', -15, 25)">
                <div class="arty_img"><a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=artworks&artist_id='.$_GET['artist_id'] ?>">
                    <img src="/templates/shop_template/images/artwork_logo.gif" /></a></div>
                <div class="arty_nu">
                    <?php echo $this -> partworks_count ; ?>
                </div>
            </div>
            <div id="arty_followers" onMouseOut="closeStuff('img_caption')" onMouseOver="setCaptionText('Followers');showStuff('arty_followers','img_caption', -15, 25)">
                <div id="fan_logo" class="arty_img"><a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=followers&artist_id='.$_GET['artist_id'] ?>">
                    <img src="/templates/shop_template/images/fans_logo.gif" /></a></div>
                <div class="arty_nu">
                    <?php echo $this -> follower_count -> f_count ; ?>
                </div>
            </div>
            
            <div>
                <div class="share_title" style="color:#2e2d2d;">
                    Share this artist on
                </div>
                <div class="share_links">
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
                </div>
            </div>
            
        </div>
    </div>

    <div id="arty_viewall_right">
        <div id="arty_navigate">
            <a href="<?php echo juri::base()."index.php?option=com_sitemain&view=artist&artist_id=".$_GET['artist_id']?>">
            <?php echo $this-> artist['artist'] -> artist_name; ?>
            </a> <span style="color:#ccc;padding:0px 5px 0px 5px;">\</span> view all
        </div>
        <div id="arty_viewall_menu">
            <ul id="viewall_menu">
                <li onclick="switchViewAllContent('artwork', 'vamuenuitem', this)" class="vamuenuitem <?php echo $_GET['type']=='artworks' ? 'active' : '' ?>">Gallery</li>
                <li onclick="switchViewAllContent('followers', 'vamuenuitem', this)" class="vamuenuitem <?php echo $_GET['type']=='followers' ? 'active' : '' ?>">Followers</li>
                <li onclick="switchViewAllContent('reviews', 'vamuenuitem', this)" class="vamuenuitem <?php echo $_GET['type']=='reviews' ? 'active' : '' ?>">Product Reviews</li>
            </ul>
        </div>
        <script>
            function switchViewAllContent(current_type, menu_class_name, obj){
                setActive(menu_class_name, obj);
                switch(current_type){
                    case 'artwork':
                        setActive('vacontent', $('artwork_container'));
                        break;
                    case 'followers':
                        setActive('vacontent', $('followers_container'));
                        break;
                    case 'reviews':
                        setActive('vacontent', $('reviews_container'));
                        break;
                    default:
                        return;
                }
            }
    
        </script>
        <div id="arty_viewall_content">
            <div id="artwork_container" class="vacontent <?php echo $_GET['type']=='artworks' ? 'active' : '' ?>">
                <?php 
                if(count($this -> partworks) > 0){
                    echo $this->loadTemplate('artworks'); 
                }else{ ?>
                    <div class="sub_message">
                        This artist has not uploaded any artworks yet
                    </div>
                <?php } ?>
            </div>
            <div id="followers_container" class="vacontent <?php echo $_GET['type']=='followers' ? 'active' : '' ?>">
                <?php 
                if(count($this -> followers) > 0){
                    echo $this->loadTemplate('followers'); 
                }else{ ?>
                    <div class='sub_message' style="padding:5px; width:80%;">
                        There is no follower yet 
                    </div>
                <?php } ?>
            </div>
            <div id="reviews_container" class="vacontent <?php echo $_GET['type']=='reviews' ? 'active' : '' ?>">
                <?php 
                if(count($this -> reviews) > 0){
                    echo $this->loadTemplate('reviews'); 
                }else{ ?>
                    <div class="sub_message">
                        There is not any product reviews yet.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
function setCaptionText(text){
    $('img_caption_text').innerHTML = text;
}
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

<div id="img_caption">
    <div id="img_caption_arrow"><img src="<?php echo JUri::base().'templates/shop_template/images/arrowup.png'?>" /></div>
    <div id="img_caption_text">Artworks</div>
</div>