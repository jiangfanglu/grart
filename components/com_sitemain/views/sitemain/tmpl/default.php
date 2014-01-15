<?php
/* com_sitemain/views/sitemain */

defined('_JEXEC') or die('Restricted access');
//include_once (JPATH_ROOT.DS.'components'.DS.'com_sitemain'.DS.'header.php');

jimport('joomla.filesystem.folder');

?>

<div class="container">
    
    <div class="featuredaw">
        <div class="hero-unit">
<!--            Hero Unit Placement-->
       <?php 
    $i=0;
    foreach($this->categories as $c){ ?>
    <div class="frontpage_categories" style="background:<?php echo $this->colors[$i] ?>;">
        <a href="<?php echo JURI::base()."index.php?option=com_opencart&Itemid=484&route=product/category&path=".$c->category_id ;?>">
                <?php echo $c->name; ?>
        </a>
    </div>
    <?php 
        $i++;
    } ?>
        </div>
        <div class="hero-unit_right">
            <div class="patist_title"><?php echo JText::_('COM_SITEMAIN_MEET_OUR_POPULAR_ARTIST')?>  </div>
            <?php foreach($this->artists as $ats){?>
                <div id="artist_<?php echo $ats->user_id ?>" class="p_artist_img"> 
                    <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$ats -> user_id ;?>">

                        <?php if(JFolder::exists(JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.(string)$ats -> user_id)){ ?>
                        <img src="/media/userthumbs/<?php echo $ats -> user_id ?>/thumb_120.jpg" />
                        <?php }else{ ?>
                        <img src="/templates/shop_template/images/default_thumb_120.jpg" />
                        <?php } ?>
                    </a>
                </div>
                <div id="artist_name_<?php echo $ats->user_id ?>" class="p_artist_name">
                    <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$ats -> user_id ;?>">
                        <?php echo substr($ats->name,0,15); ?> 
                    </a>
                </div>
            <script>
                jQuery('#artist_<?php echo $ats->user_id ?>').mouseover(function(){
                    jQuery('#artist_name_<?php echo $ats->user_id ?>').fadeIn('fast');
                });
                jQuery('#artist_name_<?php echo $ats->user_id ?>').mouseleave(function(){
                    jQuery('#artist_name_<?php echo $ats->user_id ?>').fadeOut('fast');
                });
            </script>
            <?php } ?>
            <div class="patist_more">
                <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artists';?>">
                    <?php echo JText::_('COM_SITEMAIN_MORE')?>
                </a>
            </div>
        </div>
        <?php //echo $this->loadTemplate('featuredaw'); ?>
    </div>
    
<!--    <div class="divder_bg">&nbsp;</div>-->
    

    <div class="popular_artist">
        
        
         <div class="hero_cell">
<!--                <div class="hero_cell_left">
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=account/register"?>">
                        <img src="<?php echo Juri::base()."/templates/shop_template/images/joinnow.jpg"?>" />
                    </a>
                </div>-->
                <div class="hero_cell_right">
                    <?php echo JText::_('COM_SITEMAIN_HERO_ARTISIT') ?>
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=account/register"?>">
                        <?php echo JText::_('COM_SITEMAIN_UPLOAD') ?>
                    </a>
                    
                </div>
            </div>
            <div class="hero_cell">
<!--                <div class="hero_cell_left">
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart"?>">
                         <img src="<?php echo Juri::base()."/templates/shop_template/images/browse.jpg"?>" />
                    </a>
                </div>-->
                <div class="hero_cell_right">
                    <?php echo JText::_('COM_SITEMAIN_HERO_BUYERS') ?>
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart"?>">
                        <?php echo JText::_('COM_SITEMAIN_GO_SHOPPING') ?>
                    </a>
                    
                </div>
            </div>
    </div>
    
<!--    <div class="divder_line">&nbsp;</div>
    
    <div class="comments_blogs">
        <div class="grart_blog">
            <?php echo $this->loadTemplate('article'); ?>
        </div>
    </div>-->
</div>