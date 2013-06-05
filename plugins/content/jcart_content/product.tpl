<?php if($this->params->get('showAddtoCartButtonPlugin')) {?>
	<?php JHTML::stylesheet('stylesheet.css', "components/com_opencart/catalog/view/theme/default/stylesheet/");?>
<?php } ?>  
<div>
	<?php if($this->params->get('showProductTitlePlugin')) { ?>
		<h1><?php echo $heading_title; ?></h1>
	<?php } ?> 
	<div style="float:left;padding-right:15px;">
		<?php if($thumb && $this->params->get('showProductImagePlugin')) { ?>
			<div class="image">
				<a href="<?php echo $prod_url;?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a>
			</div>
		<?php } ?>
		<?php if($this->params->get('showProductPricePlugin')) { ?>
			<?php if ($price) { ?>
				<div style="font-weight: bold;"><?php echo $text_price; ?>
				<?php if (!$special) { ?>
				<?php echo $price; ?>
				<?php } else { ?>
				<span  style="text-decoration: line-through;"><?php echo $price; ?></span> <span style="font-weight: bold;"><?php echo $special; ?></span>
				<?php } ?>
				</div>
			<?php } ?>
		 <?php } ?>  
		  
		<?php if($this->params->get('showProductRatingPlugin')) { ?>
			<div style="padding-top:5px;">	
				<img src="components/com_opencart/catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />		
			</div>	
		<?php } ?> 
				
		<?php if($this->params->get('showAddtoCartButtonPlugin')) {?>
			<div style="padding-top:5px;">
				<input type="button" onclick="addToCart('<?php echo $product_id; ?>');" class="button" value="<?php echo $button_cart; ?>" />  
			</div>
		<?php } ?>  
		
		    			
	</div>	
	<?php if($this->params->get('showProductDescriptionPlugin')) {?>
		<div>
			<?php echo $description; ?>	 
		</div>   
	<?php } ?> 
</div>