<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="review-list">

  <div class="author">
      <img src="<?php echo $review['thumb_url'] ?>" alt="<?php echo $review['author']; ?>" /><br/>
      <b><?php echo $review['author']; ?></b><br/>
      <span><?php echo $review['date_added']; ?></span>
  </div>
  <div class="text">
      <div style="width:100%;min-height:55px;"><?php echo $review['text']; ?></div>
      <div class="r_report"><a>Like</a> <a>Report</a></div>
  
  </div>
  <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $review['rating'] . '.png'; ?>" alt="<?php echo $review['reviews']; ?>" /></div>
  
</div>
<?php } ?>
<div class="pagination"><?php echo $pagination; ?></div>
<?php } else { ?>
<div class="content"><?php echo $text_no_reviews; ?></div>
<?php } ?>
