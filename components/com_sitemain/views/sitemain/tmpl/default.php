<?php
/* com_sitemain/views/sitemain */

defined('_JEXEC') or die('Restricted access');
//include_once (JPATH_ROOT.DS.'components'.DS.'com_sitemain'.DS.'header.php');

jimport('joomla.filesystem.folder');


//$positionss = array();
//$n=0;
//$start_top = 20;
//$start_left = 0;
//$left = 0;
//$top = 0;
//$col = 4;
//$col_width = 210;
//$row = 1;
//$current_col = 0;
//$margin = 5;
//$col_height_total = 0;
//
//foreach($divarr as $d){
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
//        $col_height_total += $divarr[$i-1]+$margin;
//    }
//    
//    $positionss[$n] = array(
//        'left'=>(string)$left,
//        'top'=>(string)$col_height_total
//    );
//    $n += 1;
//}


?>

<div class="container">
    <?php 
//        $n=0;
//        foreach($divarr as $d){
//            echo "<div class='gimg' style='height:".(string)$d."px;left:".$positionss[$n]['left']."px;top:".$positionss[$n]['top']."px;'>&nbsp;</div>";
//            $n+=1;
//        }
    ?>
    <div id="categories_breadcrumbs">
        <ul>
        <?php foreach($this->categories as $c){?>
          <li>
            <a href="<?php echo JURI::base()."index.php?option=com_opencart&Itemid=484&route=product/category&path=".$c->category_id ;?>">
                <?php echo strtoupper($c->name);?>
            </a></li>
            <li class="divider">|</li>
        <?php } ?>
            <li>
                <a href="<?php echo JUri::base().'index.php?option=com_opencart' ?>">
                    MORE
                </a>
            </li>
            </ul>
    </div>
    
    <div class="divder_bg">&nbsp;</div>
    
    <div class="featuredaw">
        <div class="hero-unit">
<!--            Hero Unit Placement-->
       <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=account/register"?>">
            <img src="<?php echo Juri::base()."/templates/shop_template/images/hero.jpg"?>" /></a>
        </div>
        <div class="hero-unit_right">
            <div class="hero_cell" style="border-bottom: 1px solid #eee;">
                <div class="hero_cell_left">
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=account/register"?>">
                        <img src="<?php echo Juri::base()."/templates/shop_template/images/joinnow.jpg"?>" />
                    </a>
                </div>
                <div class="hero_cell_right">
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=account/register"?>">
                        Wish to sell your art works? It is as easy as JOIN and UPLOAD. Now, get started!
                    </a>
                    
                </div>
            </div>
            <div class="hero_cell">
                <div class="hero_cell_left">
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart"?>">
                         <img src="<?php echo Juri::base()."/templates/shop_template/images/browse.jpg"?>" />
                    </a>
                </div>
                <div class="hero_cell_right">
                    <a href="<?php echo Juri::base()."index.php?option=com_opencart"?>">
                        Looking to buy arts? Browse through our products from those talented artists.
                    </a>
                    
                </div>
            </div>
        </div>
        <?php //echo $this->loadTemplate('featuredaw'); ?>
    </div>
    
<!--    <div class="divder_bg">&nbsp;</div>-->
    
    <div class="popular_artist">
        <div class="patist_title">Meet Our Popular Artists  </div>
        <div style="width:1040px;float: left;margin-top: 10px;">
            <?php foreach($this->artists as $ats){?>
                <div class="p_artist_img"> 
                    <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$ats -> user_id ;?>">

                        <?php if(JFolder::exists(JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.(string)$ats -> user_id)){ ?>
                        <img src="/media/userthumbs/<?php echo $ats -> user_id ?>/thumb_120.jpg" />
                        <?php }else{ ?>
                        <img src="/templates/shop_template/images/default_thumb_120.jpg" />
                        <?php } ?>
                    </a>
                </div>
                <div class="p_artist_name">
                    <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$ats -> user_id ;?>">
                        <?php echo substr($ats->name,0,15); ?> 
                    </a>
                </div>
            <?php } ?>
        </div>
        
    </div>
    
    <div class="divder_line">&nbsp;</div>
    
    <div class="comments_blogs">
        <div class="grart_blog">
            <?php echo $this->loadTemplate('article'); ?>
        </div>
    </div>
</div>