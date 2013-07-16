<?php
defined('_JEXEC') or die('Restricted access');
?>
<?php $header_path = JPATH_BASE.DS.'includes'.DS.'artist_header.php'?>
<?php require $header_path ?>
<div id="artist_gallery" class="featuredaw">
    <?php if(count($this-> partworks)>0){ 
            $n=0; ?>
            <?php foreach($this-> partworks as $aw){ ?>
                <div id="<?php echo 'artwork_brick_'.$aw->product_id?>" class="gimgg">
                    <div><a href="<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id."&path=".$aw->category_id ?>">
                              <img src='<?php echo DS.'media'.DS.'uploaded_artwork'.DS.$_GET['artist_id'].DS.'200'.DS.$aw->filename; ?>'/>
                        </a></div>
                    <div style="font-size: 12px;padding:3px 5px; background: #2e2d2d;color:#fff;margin-top:-190px;">
                        <?php echo JText::_('COM_SITEMAIN_BUY')?>
                    </div>
                </div>
                <div class="gimgg_caption" id="<?php echo 'artwork_brick_caption_'.$aw->product_id?>" style="display:none;">
<!--                            <h3>
                                <?php echo strlen($aw->title) > 16 ? substr($aw->title,0,16).'...' : $aw->title ?> 
                            </h3>
                            <p><?php echo strlen($aw->description) > 150 ? substr($aw->description,0,150).'...' : $aw->description ?></p>-->
                        
                        <div class="buy">
                            <a href="<?php echo JRoute::_("index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id."&path=".$aw->category_id) ?>">
                                <?php echo JText::_('COM_SITEMAIN_BUY')?>
                            </a>
                        </div>
                        <div class="add" onclick="addToWishList('<?php echo JUri::base() ?>','<?php echo $aw->product_id ?>');">
                            <img src="/templates/shop_template/images/add.png" alt="<?php echo JText::_('COM_SITEMAIN_ADD_TO_WISHLIST')?>" title="<?php echo JText::_('COM_SITEMAIN_ADD_TO_WISHLIST')?>" />
                        </div>
                        <div class="expand" id="<?php echo 'expand_'.$aw->product_id?>">
                            <img src="/templates/shop_template/images/expand-3.png" alt="<?php echo JText::_('COM_SITEMAIN_EXPAND')?>" title="<?php echo JText::_('COM_SITEMAIN_EXPAND')?>" />
                        </div>
                </div>
                <script>
                jQuery('#<?php echo 'artwork_brick_'.$aw->product_id?>').mouseenter(function(){
                    jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").css('display','table');
                });
                jQuery('#<?php echo 'artwork_brick_caption_'.$aw->product_id?>').mouseleave(function(){
                    setTimeout(function(){
                        if(!jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").is(':hover')){
                            jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").css('display','none');
                        }
                    },50);
                });
                jQuery('#<?php echo 'expand_'.$aw->product_id?>').click(function(){
                    jQuery('#gallery_bg').css('display','block');
                    jQuery('#display_container').css('display','table');
                    jQuery('#close_it').css('display','block');
                    jQuery("#main_content").addClass("modal-open");
                    loadJQContent('index.php?option=com_sitemain&view=artworkimage&format=raw&artwork_id=<?php echo $aw->artwork_id?>','display_container');
                });
//                jQuery("#<?php echo 'artwork_brick_caption_'.$aw->product_id?>").click(function(){
//                    window.location.href = '';
//                });
                </script>
            <?php } ?>
        <?php }else{ ?>
                    <?php echo JText::_('COM_SITEMAIN_THIS_ARTIST_HAS_NOT_UPLOADED_ANY_WORKS_YET')?>
        <?php } ?>
     
                
                <div id="checkout_other_artist">
                    <img src="/templates/shop_template/images/ellipsis.png" /><br/>
                    <a href="<?php echo JRoute::_('index.php?option=com_sitemain&view=artists')?>">
                        <?php echo JText::_('COM_SITEMAIN_CHECK_OUT_OTHER_ARTIST')?>
                    </a>
                </div>           
                
                
     <?php if(count($this-> artworks)>0){ 
            $n=0; ?>
            <?php foreach($this-> artworks as $aw){ ?>
                <div id="<?php echo 'artwork_brick_atim'.$aw->artwork_image_id?>" class="gimgg">
                        <a href="<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id."&path=".$aw->category_id ?>">
                              <img src='<?php echo DS.'media'.DS.'uploaded_artwork'.DS.$_GET['artist_id'].DS.'200'.DS.$aw->filename; ?>'/>
                        </a>
                </div>
                <div class="gimgg_caption" id="<?php echo 'artwork_brick_caption_atim'.$aw->artwork_image_id?>" style="display:none;">
                    <div class="expand_alt">
                            <img src="/templates/shop_template/images/expand-3.png" alt="<?php echo JText::_('COM_SITEMAIN_EXPAND')?>" title="<?php echo JText::_('COM_SITEMAIN_EXPAND')?>" />
                        </div>
                </div>
                <script>
                    jQuery('#<?php echo 'artwork_brick_atim'.$aw->artwork_image_id?>').mouseenter(function(){
                    jQuery("#<?php echo 'artwork_brick_caption_atim'.$aw->artwork_image_id?>").css('display','table');
                });
                jQuery('#<?php echo 'artwork_brick_caption_atim'.$aw->artwork_image_id?>').mouseleave(function(){
                    setTimeout(function(){
                        if(!jQuery("#<?php echo 'artwork_brick_caption_atim'.$aw->artwork_image_id?>").is(':hover')){
                            jQuery("#<?php echo 'artwork_brick_caption_atim'.$aw->artwork_image_id?>").css('display','none');
                        }
                    },50);
                });
                </script>
            <?php } ?>
        <?php }else{ ?>
            <?php echo JText::_('COM_SITEMAIN_THIS_ARTIST_HAS_NOT_UPLOADED_ANY_WORKS_YET')?>
        <?php } ?>
</div>
<div id="gallery_bg"></div>
<div id="close_it"></div>
<div id="display_container"></div>
<script>
jQuery('#close_it').click(function(){
    jQuery('#gallery_bg').css('display','none');
    jQuery('#display_container').css('display','none');
    jQuery('#close_it').css('display','none');
    jQuery('#display_container').html('');
    jQuery("#main_content").removeClass("modal-open");
});
</script>