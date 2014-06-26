<?php

defined('_JEXEC') or die('Restricted access');
$num_total = count($this->featured_articles);
$NUMBER_OF_ARTICLES_SHOWN_PER_PAGE = 2;
$lastfa = end($this->featured_articles);
$n = 0;
$i = 0;
$div_ids = array();
$x = 0;
?>

<?php foreach($this->featured_articles as $fa){
    $params  = $fa->params;
    $images  = json_decode($fa->images);
 ?>
<?php 
if($n % $NUMBER_OF_ARTICLES_SHOWN_PER_PAGE == 0) {
    if($n == 0){
        echo "<div class='blog_a_c' id='blog_fp_".(string)$fa->id."'>";
    }else{
        echo "<div class='blog_a_c' id='blog_fp_".(string)$fa->id."' style='display:none;'>";
    }
    $div_ids[$x] = 'blog_fp_'.(string)$fa->id;
    $x += 1;
}
?>
    <div class="frontpage_blog_item">
        <?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>

        <div class="frontpage_blog_item_img"> 
            <img src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/> 
        </div>
        <?php endif; ?>
        <div class="frontpage_blog_item_title">
          <?php echo $fa->title; ?>
        </div>
        <div class="frontpage_blog_item_text">
          <?php echo $fa->introtext; ?>
        </div>
        <div class="frontpage_blog_item_link">
            <a href='<?php echo "index.php?option=com_content&view=article&id=".(string)$fa->id?>' >View the whole article &gt;&gt;</a>
        </div>

    </div>
<?php
if($n % $NUMBER_OF_ARTICLES_SHOWN_PER_PAGE == 0){
    $i += $NUMBER_OF_ARTICLES_SHOWN_PER_PAGE ;
}
echo $n == ($i - 1) || $lastfa == $fa ? "</div>" : "" ; 
?>
<?php 
    $n += 1;
} ?>
<div style="width:<?php echo (string)(1040-(1040-20*($i/$NUMBER_OF_ARTICLES_SHOWN_PER_PAGE))/2); ?>px;padding-left:<?php echo (string)(1040-20*($i/$NUMBER_OF_ARTICLES_SHOWN_PER_PAGE))/2 ;?>px;">
<?php for($i=0;$i<count($div_ids);$i++){
    if($i==0){
        echo "<div class='choose_article a_active' onmouseover=\"setArtticle(this,'".$div_ids[$i]."')\">&nbsp;</div>";
    }else{
        echo "<div class='choose_article' onmouseover=\"setArtticle(this,'".$div_ids[$i]."')\">&nbsp;</div>";
    }
} ?>
</div>
