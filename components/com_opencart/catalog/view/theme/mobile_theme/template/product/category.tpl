<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($description) { ?>
    <?php echo $description; ?>
  <?php } ?>
  <?php if ($categories) { ?>
    <ul class="link_list test">
      <?php foreach ($categories as $category) { ?>
      <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
      <?php } ?>
    </ul>
  <?php } ?>
  <?php if ($products) { ?>
  <div class="product-list">
    <?php foreach ($products as $product) { ?>
	<div class="product">
		<div class="product_summary">
      
			  <h2><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>	
				
			  
			  <?php if ($product['price']) { ?>
			  <div class="price">
				<?php if (!$product['special']) { ?>
				<?php echo $product['price']; ?>
				<?php } else { ?>
				<span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
				<?php } ?>
				<?php if ($product['tax']) { ?>
				<br />
				<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
				<?php } ?>
			  </div>
			  <?php } ?>
			  
			  <?php if ($product['rating']) { ?>
			  <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
			  <?php } ?>
			  
				<input class="button" type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>',$(this));" />

    		</div>
			
		  <?php if ($product['thumb']) { ?>
		  <div class="image">
		  	<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a>
		  
		  </div>
		  <?php } ?>

		  <p class="left"><a onclick="addToWishList('<?php echo $product['product_id']; ?>',$(this));"><?php echo $button_wishlist; ?></a></p>
		  	  
		</div>
	<?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  <?php if (!$categories && !$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>