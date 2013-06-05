<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="review-list">

  <div class="author">
      <img src="<?php echo $review['thumb_url'] ?>" alt="<?php echo $review['author']; ?>" /><br/>
  </div>
  <div class="text">
      <b><?php echo $review['author']; ?></b><br/>
      <div style="width:100%;margin:5px 0px 5px 0px;"><?php echo $review['text']; ?></div>
      <div id="datetime"><?php echo date("M d, Y h:m",$review['date_added']); ?>
<!--      - Like - Report-->
      </div>
  </div>
  <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $review['rating'] . '.png'; ?>" alt="<?php echo $review['reviews']; ?>" /></div>
  
</div>
<?php } ?>
<div class="pagination"><?php echo $pagination; ?></div>
<?php } else { ?>
<div class="content"><?php echo $text_no_reviews; ?></div>
<?php } ?>
