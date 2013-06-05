<?php
    /*
     * com_sitemain, artist
     */
   defined('_JEXEC') or die('Restricted access');
   //echo $this -> artist['country'];
   jimport('joomla.filesystem.folder');
   
//$positionss = array();
//$n=0;
//$start_top = 70;
//$start_left = 20;
//$left = 0;
//$top = 0;
//$col = 3;
//$col_width = 210;
//$row = 1;
//$current_col = 0;
//$margin = 5;
//$col_height_total = 0;

//foreach($this-> artworks as $d){
//    $col_height_total = $start_top + 0;
//    if($n%$col==0){
//        $left = 0;
//        $current_col = 0;
//        $row = $n/$col;
//    }
//    $current_col += 1;
//    $left = $start_left + $left + $col_width;
//    
//    for($i=$current_col;$i<=($row*$col);$i+=$col){
//        $col_height_total += 200*($this-> artworks[$i-1]->height/$this-> artworks[$i-1]->width)+$margin;
//    }
//    
//    $positionss[$n] = array(
//        'left'=>(string)$left,
//        'top'=>(string)$col_height_total
//    );
//    $n += 1;
//}


//$jsscript =<<<EOD
//window.addEvent('domready',function() {
//    
//});
//EOD;
//
//$doc = & JFactory::getDocument();
//$doc->addScriptDeclaration( $jsscript );

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


<div id="fb-root"></div>
<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=575263575817684";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->

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
            
            <div id="arty_numbers" onMouseOut="closeStuff('img_caption')" onMouseOver="setCaptionText('Products');showStuff('arty_numbers','img_caption', -15, 25)">
                <div class="arty_img">
                    <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=artworks&artist_id='.$_GET['artist_id'] ?>">
                    <img src="/templates/shop_template/images/artwork_logo.gif" /></a>
                </div>
                <div class="arty_nu">
                    <?php echo $this -> partworks_count ; ?>
                </div>
            </div>
            <div id="arty_followers" onMouseOut="closeStuff('img_caption')" onMouseOver="setCaptionText('Followers');showStuff('arty_followers','img_caption', -15, 25)">
                <div id="fan_logo" class="arty_img">
                    <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=followers&artist_id='.$_GET['artist_id'] ?>">
                    <img src="/templates/shop_template/images/fans_logo.gif" /></a>
                </div>
                <div class="arty_nu">
                    <?php echo $this -> follower_count -> f_count ; ?>
                </div>
            </div>
            
<!--            <div>
                <div class="fb-like" data-send="false" data-layout="box_count" data-width="150" data-show-faces="false"></div>
            </div>-->
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
    <div id="artist_right">
        <div id="arty_arty" class="right_col">
            <div class="aw_heading">
                <div style="float:left;width:50%;">PRODUCTS &nbsp;&nbsp;FROM &nbsp;&nbsp;THIS &nbsp;&nbsp;ARTIST</div>
                <div style="float:left;width:50%;text-align: right;">
                    <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artistviewall&type=artworks&artist_id='.$_GET['artist_id'] ?>">
                        Gallery
                    </a>
                </div>
                
            </div>
            <div id="all_aw">
                <?php if(count($this-> partworks)>0){ 
                    $n=0; ?>
                    <?php foreach($this-> partworks as $aw){ ?>
    <?php 
        
//            echo "<div class='gimg' style='left:".$positionss[$n]['left']."px;top:".$positionss[$n]['top']."px;'>
//                <img src='".DS.'media'.DS.'uploaded_artwork'.DS.$_GET['artist_id'].DS.'200'.DS.$aw->filename."'/>
//                </div>";
//            $n+=1;
    ?>            
                
                <div class="gimgg" id="<?php echo 'artwork_brick_'.$aw->product_id?>">
                    <div>
                    <a href="<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id."&path=".$aw->category_id ?>">
                          <img src='<?php echo DS.'media'.DS.'uploaded_artwork'.DS.$_GET['artist_id'].DS.'200'.DS.$aw->filename; ?>'/>
                    </a>
                        </div>
                    <div class="gimgg_caption" id="<?php echo 'artwork_brick_caption_'.$aw->product_id?>" style="display:none;">
                        <h3>
                            <?php echo strlen($aw->title) > 16 ? substr($aw->title,0,16).'...' : $aw->title ?> 
                        </h3>
                        <p><?php echo strlen($aw->description) > 150 ? substr($aw->description,0,150).'...' : $aw->description ?></p>
                    </div>
                </div>
                <script>
                jQuery('#<?php echo 'artwork_brick_'.$aw->product_id?>').mouseover(function(){
                    jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").fadeIn("fast");
                });
                jQuery('#<?php echo 'artwork_brick_'.$aw->product_id?>').mouseleave(function(){
                    jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").fadeOut("fast");
                });
                jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").click(function(){
                    window.location.href = '<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id."&path=".$aw->category_id ?>';
                });
                </script>
                    <?php } ?>
                <?php }else{ ?>
                <div class='sub_message'>
                    This artist has not uploaded any art works yet.
                </div>
                <?php } ?>
                
                
                
            </div>
        </div>
    </div>
    
    <div id="arty_right_right">
        <div id="arty_fans">
            <div class="item_heading">
                <div class="left">
                    <div><img src="/templates/shop_template/images/fans_logo.gif" /></div>
                    <div class="padding-left1"><?php echo $this -> follower_count -> f_count ; ?> followers</div>
                </div>
                <div class="right">
                    <a href="<?php echo JUri::base()."index.php?option=com_sitemain&view=artistviewall&type=followers&artist_id=".$_GET['artist_id'] ?>" >View all</a>
                </div>
            </div>
            
            <?php 
            if(count($this -> followers) > 0){
                echo $this->loadTemplate('follower'); 
            }else{ ?>
                <div class="sub_message">
                    No follower yet 
                    <?php if($disabled == ''){ ?>
                    <a id="other_follow" style="text-decoration: underline">Follow</a>
                    <?php }?>
                </div>
            <?php } ?>
        </div>
        
        <div class="divider_258">
            
        </div>
        
        <div id="arty_comments">
            <div class="item_heading" >
                <div class="left">
                    <div><img src="/templates/shop_template/images/comment_logo.gif" /></div>
                    <div class="padding-left1"><?php echo $this -> totalreviews ?> reviews</div>
                </div>
                <div class="right">
                    <a href="<?php echo JUri::base()."index.php?option=com_sitemain&view=artistviewall&type=reviews&artist_id=".$_GET['artist_id'] ?>" >View all</a>
                </div>
            </div>
            <?php echo count($this->reviews) == 0 ? "<div class='sub_message'>No review on this artist's products yet</div>" : "" ?>
            
            <?php foreach($this->reviews as $r){ ?>
            
            <div class="arty_comments_item">
                <div class="arty_comments_item_top">
                    <div class="left">
                        on <b>'<?php echo $r['review_item']->title ?>'</b> by <?php echo $r['sender'] == null ? 'guest' : $r['sender']->name ?>
                    </div>
                    <div class="right">
                        <?php echo date('Y-m-d',  strtotime($r['review_item']->date_added)) ?>
                    </div>
                </div>
                <div class="arty_comments_item_content">
                    <a href="<?php echo Juri::base() ?>index.php?option=com_opencart&route=product/product&product_id=<?php echo $r['review_item']->product_id ?>"><?php echo $r['review_item']->text ?></a>
                </div>
            </div>
            
            <?php } ?>
        </div>
        
    </div>
    
    

    
    
    
    <div>
        
    </div>
    <?php } ?>
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