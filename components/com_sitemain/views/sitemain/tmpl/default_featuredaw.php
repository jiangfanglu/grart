<?php
defined('_JEXEC') or die('Restricted access');
$jsscript =<<<EOD
$(function(){
  $('#featuredaw').masonry({
    // options
    itemSelector : '.featuredaw_item',
    columnWidth : 220
  });
});
EOD;

$doc = & JFactory::getDocument();
$doc->addScriptDeclaration( $jsscript );
?>

    <?php foreach($this->featured_artworks as $fa){ ?>
    <div class="featuredaw_item">
    <a href="<?php echo JURI::base().'index.php?option=com_opencart&route=product/product&product_id='.$fa->product_id; ?>">
    <img src="<?php echo JURI::base().'media'.DS.'uploaded_artwork'.DS.$fa->user_id.DS.'200'.DS.$fa->filename; ?>"/>
    </a>
    </div>
    <?php } ?>
