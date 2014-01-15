<?php
/*SITEMAIN/ARTICLES*/
defined('_JEXEC') or die('Restricted access');
?>
<!--<div id="categories_breadcrumbs">
    <ul>
    <?php foreach($this->product_categories as $c){?>
      <li>
        <a href="<?php echo JURI::base()."index.php?option=com_opencart&Itemid=484&route=product/category&path=".$c->category_id ;?>">
            <?php echo $c->name;?>
        </a></li> 
    <?php } ?>
        </ul>
</div>-->
<h1>
    Information, Frequently Asked Questions, Guidelines, Tutorials and More
</h1>
<div style="width:100%;display:table;">
    <div class="article_left">
        <?php 
            foreach($this->categories as $c){
                if(isset($_GET['c_id'])){
                        if($_GET['c_id'] == (string)$c['category_id']){
                            $active_class_c = "active_c";
                            $active_class_is = "active_is";
                        }else{
                            $active_class_c = "";
                            $active_class_is = "";
                        }
                    }
                    ?>

        <div id="category_<?php echo (string)$c['category_id'] ?>" class="category_item <?php echo $active_class_c ?>" >
                        <?php echo $c['category_name'] ?>
        </div>

        <div class="article_items <?php echo $active_class_is ?>" id="article_items_<?php echo (string)$c['category_id'] ?>">
        <?php
                foreach($c['cate_articles'] as $a){
                    if(isset($_GET['a_id'])){
                        if($_GET['a_id'] == (string)$a['article_id']){
                            $active_class_a = "active_a";
                        }else{
                            $active_class_a = "";
                        }
                    }
                    ?>
                    <div class="article_item <?php echo $active_class_a ?>">
                        <a href='<?php echo JUri::base().'index.php?option=com_sitemain&view=articles&c_id='.$a['category_id'].'&a_id='.$a['article_id'] ?>'><?php echo $a['article_name'] ?></a>
                    </div>
           <?php } ?>
        </div>
<script>
    jQuery('#category_<?php echo (string)$c['category_id'] ?>').click(function(){
        jQuery('#article_items_<?php echo (string)$c['category_id'] ?>').slideToggle('fast');
    });
</script>
        <?php
            }
        ?>
    </div>
    <div class="article_right" id="article_right_1">
        <div class="article_title">
            <?php echo $this -> article -> title ?>
        </div>
        <div class="divder_bg_dynamic">&nbsp;</div>
        <div class="article_content">
            <?php echo $this -> article -> introtext?>
        </div>
    </div>
</div>
<script>
function showArticles(obj_id, target_id){
    if($(target_id).style.display == 'block'){
        $(target_id).style.display = 'none';
    }else{
        $(target_id).style.display = 'block';
    }
}
</script>
