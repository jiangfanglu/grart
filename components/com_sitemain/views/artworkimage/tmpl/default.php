<?php
defined('_JEXEC') or die('Restricted access');
?>
<div id="gallery_box">
    <div id="show_artwork">
        <img id="art_image_temp" style="<?php echo $this->style; ?>" src="<?php echo '/media/uploaded_artwork/'.$this->artwork->user_id."/small/".$this->artwork->filename ;?>" title="" alt="" />
        <img id="art_image_original" style="display:none;<?php echo $this->style; ?>" src="<?php echo '/media/uploaded_artwork/'.$this->artwork->filename ;?>" title="" alt="" />
        <script>
            jQuery('#art_image_original').load(function(){
                jQuery('#art_image_temp').css('display','none');
                jQuery(this).css('display','block');
            });
        </script>
    </div>
    <div id="artwork_bio">
        <div id="title_author">
            <b><?php echo $this->artwork->title?></b><br/>
            <?php echo $this->artwork->name?>
        </div>
        <div id="buy_button" class="show_gallery_right_cell">
            <div class="follow_button">&nbsp;
            </div>
        </div>
        
        <div id="art_desc" class="show_gallery_right_cell">
            <?php echo $this->artwork->description ?>
        </div>
        <div id="share_buttons" class="show_gallery_right_cell">
            <a>Share</a>
        </div>
    </div>
</div>
<div id="author_thumb">
            <a href="<?php echo juri::base()."index.php?option=com_sitemain&view=artist&artist_id=".$this->artwork->user_id?>">
            <?php if(JFolder::exists(JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.(string)$this->artwork->user_id)){?>
            <img src="/media/userthumbs/<?php echo $this->artwork->user_id; ?>/thumb_120.jpg" />
            <?php }else{ ?>
            <img src="/templates/shop_template/images/default_thumb_120.jpg" />
            <?php } ?>
            </a>
</div>
<script>
    jQuery(window).load(function(){
        var position = jQuery('#show_artwork').position();
        jQuery('#author_thumb').css('left',(position.left -50)+'px');
    });
</script>