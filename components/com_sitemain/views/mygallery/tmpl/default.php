<?php

/*
com_sitemain/mygallery
 */
defined('_JEXEC') or die('Restricted access');


?>
     <?php if(count($this -> images)>0){ ?>
            <?php
                if(isset($_GET['msg'])){
                    $displaystyle = 'block';
                }else{
                    $displaystyle = 'none';
                }
            ?>
    
    <div id="info_alert" class="alert alert-error" style="display: <?php echo $displaystyle;  ?>;">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <div id="info_text">
            <?php
                if(isset($_GET['msg'])){
                    echo JRequest::getVar('msg');
                }else{
                    echo 'Oops';
                }
            ?>
        </div>
    </div>
    <?php }else{ ?>
    <div id="info_alert" class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <div id="info_text">You have no artwork uploaded</div>
    </div>
    <?php } ?>
    
    <?php include('/includes/user_header.php');?>
    
    <?php if(count($this -> images)>0){ ?>
    <div id="artwork_thumb" style="margin-top:50px;">
        <?php
        
        foreach($this -> images as $img){
            $imgname = $img->filename;
            if((string)$img->artwork_id == $this -> var_artwork_id){
                $active_class = 'image_thumbnail_active';
            }else{
                $active_class = '';
            }
         ?>
        <div class="image_thumbnail <?php echo $active_class; ?>">
            <a onclick="return getArwork(this,'<?php echo JRoute::_('/index.php?option=com_sitemain&view=artwork&format=raw&artwork_id='.(string)$img -> artwork_id); ?>');" href="#">
                <?php echo "<img src='".DS.'media'.DS.'uploaded_artwork'.DS.$this->user->id.DS.'200'.DS.$imgname."'/>"; ?>
            </a>
        </div>
            
            
        <?php } ?>
    </div>
    <?php } ?>
<div id="gallery_bg"><div id="artwork_main"></div></div>
<div class="close_it_big_alt" id="close_edit_image"></div>
<script>
jQuery('#close_edit_image').click(function(){
    jQuery('#gallery_bg').css('display','none');
    jQuery('#close_edit_image').css('display','none');
    jQuery('body').css('overflow','auto')
});
</script>