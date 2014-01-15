<?php
    /*
     * com_sitemain, artist
     */
   defined('_JEXEC') or die('Restricted access');
   jimport('joomla.filesystem.folder');
   

?>

<div id="info_alert" class="alert alert-error" style="display: none">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <span id="info_text">
        </span>
</div>

<?php $header_path = JPATH_BASE.DS.'includes'.DS.'artist_header.php'?>
<?php require $header_path ?>
<div id="artist_left_colume">
    <?php echo $this->loadTemplate("compose"); ?>
    <?php echo $this->loadTemplate("posts"); ?>
</div>
<div id="artist_right_colume">
    <div class="artist_right_div">
        <div class="artist_right_div_title">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
                <?php echo JText::_('COM_SITEMAIN_PORTFOLIO'); ?>
            </a>
        </div>
        <div class="artist_right_div_content">
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
    </div>
    <div class="artist_right_div">
        <div class="artist_right_div_title">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
            <?php echo JText::_('COM_SITEMAIN_WEBSITE'); ?>
                </a>
        </div>
        <div class="artist_right_div_content">
            <?php 
                    if($this -> artist['artist'] -> website_url == null){
                        echo jText::_('COM_SITEMAIN_NO_WEBISTE_PROVIDED');
                    }else{
                        $webiste_href = $this -> artist['artist'] -> website_url;
                        //$webiste_url = strlen($this -> artist['artist'] -> website_url) > 20 ? substr($this -> artist['artist'] -> website_url,0,20).'...' : $this -> artist['artist'] -> website_url;
                        ?>
            <a href="http://<?php echo  $webiste_href ;  ?>" target="_blank"><?php echo $webiste_href ;  ?></a>
                <?php    }
                ?>
                
        </div>
    </div>
    <div class="artist_right_div">
        <div class="artist_right_div_title">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
            <?php echo JText::_('COM_SITEMAIN_GALLERY'); ?>
            </a> (<?php echo $this -> partworks_count ; ?>)
        </div>
        <div class="artist_right_div_content">
            <?php if(count($this-> partworks)>0){ 
                    $n=0; ?>
                    <?php foreach($this-> partworks as $aw){ ?>
            <div id="<?php echo 'artwork_brick_'.$aw->product_id?>">
                    <a href="<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id."&path=".$aw->category_id ?>">
                          <img src='<?php echo DS.'media'.DS.'uploaded_artwork'.DS.$_GET['artist_id'].DS.'200'.DS.$aw->filename; ?>'/>
                    </a>
<!--                    <div class="gimgg_caption" id="<?php echo 'artwork_brick_caption_'.$aw->product_id?>" style="display:none;">
                        <h3>
                            <?php echo strlen($aw->title) > 16 ? substr($aw->title,0,16).'...' : $aw->title ?> 
                        </h3>
                        <p><?php echo strlen($aw->description) > 150 ? substr($aw->description,0,150).'...' : $aw->description ?></p>
                    </div>-->
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
                    <?php echo JText::_('COM_SITEMAIN_THIS_ARTIST_HAS_NOT_UPLOADED_ANY_WORKS_YET')?>
                <?php } ?>
        </div>
    </div>
    <div class="artist_right_div">
        <div class="artist_right_div_title">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
            <?php echo JText::_('COM_SITEMAIN_FOLLOWERS'); ?></a> (<?php echo $this -> follower_count -> f_count ; ?>)
        </div>
        <div class="artist_right_div_content">
            <?php 
            if(count($this -> followers) > 0){
                echo $this->loadTemplate('follower'); 
            }else{ ?>
                    <?php echo JText::_('COM_SITEMAIN_NO_FOLLOWERS')?>
            <?php } ?>
        </div>
    </div>
    <div class="artist_right_div">
        <div class="artist_right_div_title">
            <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=') ?>">
            <?php echo JText::_('COM_SITEMAIN_PRODUCT_REVIEWS'); ?></a> (<?php echo $this -> totalreviews ?>)
        </div>
        <div class="artist_right_div_content">
             <?php echo count($this->reviews) == 0 ? "<div class='sub_message'>No review on this artist's products yet</div>" : "" ?>
            
            <?php 
            $n=0;
            foreach($this->reviews as $r){ ?>
            
            <div class="arty_comments_item" style="<?php echo $n%2!=0 ? 'background:#fff' : '' ?>">
                <div class="arty_comments_item_top">
                    <div class="left">
                        <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=artist&artist_id='.$r['sender']->user_id) ?>">
                            <?php echo $r['sender'] == null ? 'guest' : $r['sender']->name ?>
                        </a>
                        <?php echo JText::_('COM_SITEMAIN_ON_PRODUCT')?>
                        <b><a href="<?php echo Juri::base() ?>index.php?option=com_opencart&route=product/product&product_id=<?php echo $r['review_item']->product_id ?>"><?php echo $r['review_item']->title ?></a></b> 
                        <?php echo JText::_('COM_SITEMAIN_SAYS')?>
                    </div>
                    <div class="right">
                        <?php echo date('Y-m-d',  strtotime($r['review_item']->date_added)) ?>
                    </div>
                </div>
                <div class="arty_comments_item_content">
                    <?php echo $r['review_item']->text ?>
                </div>
            </div>
            
            <?php 
            $n++;
            } ?>
        </div>
    </div>
</div>
<?php if($this->artist['artist'] == null){ ?>
         <h2>He/She is not an artist yet, no profile page is provided, Sorry !</h2> <br/>
         <a href="/">Back</a>
    <?php }else{ ?>
    <?php } ?>

