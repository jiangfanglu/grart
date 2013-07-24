<div style="padding-top: 20px;">
    <h4><?php echo $heading_title ?></h4>
    <?php foreach ($products as $product) { ?>
      
      <div style="width:180px;float:left;display:table;margin-bottom: 5px;">
        <?php if ($product['thumb']) { ?>
        <div style="width:60px;float:left;"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div style="width:110px;float:left;padding-left:10px;font-style: italic;"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div style="width:110px;float:left;padding-left:10px;">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
<!--        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>-->
        
        <div class="btn_add_to_cart_alt" onclick="addToCart('<?php echo $product['product_id']; ?>');"  onmouseover="showDesc(this, 1,'Add to Cart')" onmouseout="showDesc(this, 0,'+')">+</div>
      </div>
      
 <?php } ?>
</div>

