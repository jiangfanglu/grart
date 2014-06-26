<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>

<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($products) { ?>
  <div class="wishlist-info">
      <?php foreach ($products as $product) { ?>
      <div class="product" id="wishlist-row<?php echo $product['product_id']; ?>">
        
		<div class="product_summary">
			
						
			<h2><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>
			
			<p><?php echo $product['stock']; ?></p>
			  
			<?php if ($product['price']) { ?>
				<p class="price">
				  <?php if (!$product['special']) { ?>
				  <?php echo $product['price']; ?>
				  <?php } else { ?>
				  <del><?php echo $product['price']; ?></del> <b><?php echo $product['special']; ?></b>
				  <?php } ?>
				</p>
			<?php } ?>
			
			<a class="button" onclick="addToCart('<?php echo $product['product_id']; ?>',$(this));"><?php echo $button_cart; ?></a>
			<p><a href="<?php echo $product['remove']; ?>"><?php echo $button_remove; ?></a>
			
		</div>
		
        <?php if ($product['thumb']) { ?>
            <a class="product_thumb" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
        <?php } ?>
  	</div>
      <?php } ?>
   </div>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>