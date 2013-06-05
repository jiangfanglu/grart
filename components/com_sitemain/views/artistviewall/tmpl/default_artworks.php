<?php
defined('_JEXEC') or die('Restricted access');
?>
<?php if(count($this-> partworks)>0){ 
    $n=0; ?>
    <?php foreach($this-> partworks as $aw){ ?>                
<div class="gimgg" id="<?php echo 'artwork_brick_'.$aw->product_id?>">
    <div>
    <a href="<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id ?>">
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
    window.location.href = '<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$aw->product_id ?>';
});
</script>
    <?php } ?>


<div>
    <div>
        
    </div>
    <div>
        
    </div>
</div>
<?php }else{ ?>
<div class='sub_message'>
    This artist has not uploaded any art works yet.
</div>
<?php } ?>