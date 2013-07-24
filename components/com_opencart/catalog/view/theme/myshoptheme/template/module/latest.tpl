<div class="box">
  <!--<div class="box-heading"><?php echo $heading_title; ?></div>-->
  <div class="box-content" style="margin-top: 10px;">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      
            <div id="product_<?php echo $product['product_id'];?>" class="cell_product_item">
              <?php if ($product['thumb']) { ?>
                    <div class="image_product"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
              <?php } ?>
<!--                    <div class="btn_add_to_cart" onclick="addToCart('<?php echo $product['product_id']; ?>');" title="Add to Cart">+</div>-->
                    <div class="btn_add_to_wish" onclick="addToWishList('<?php echo $product['product_id']; ?>');" onmouseover="showDesc(this, 1,'<?php echo $text_add_to_wishlist ?>')" onmouseout="showDesc(this, 0,'+')">+</div>
                    <div class="price_tag">
                        <div>
                            <?php if (!$product['special']) { ?>
                                            <?php echo $product['price']; ?>
                                            <?php } else { ?>
                                            <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                            <?php } ?>
                        </div>
                    </div>
                    <div class="p_user" id="p_info_<?php echo $product['product_id'];?>">
                        <div class="leftt">
                            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                        </div>
                        <div class="rightt" id="artist_<?php echo $product['product_id'];?>">
                            <img src="/templates/shop_template/images/ajax-loader_star.gif" />
                        </div>
                    </div>
                    
            </div>
            <script>
                    
                    $("#product_<?php echo $product['product_id'];?>").mouseover(function (e) {
                        $("#p_info_<?php echo $product['product_id'];?>").slideDown('fast');
                        var url = "/index.php?option=com_sitemain&task=getuserthumb&tmpl=component&product_id=<?php echo $product['product_id'];?>"
                        loadJQContent_plain(url,"artist_<?php echo $product['product_id'];?>");
//                        var position = $("#product_<?php echo $product['product_id'];?>").position();
//                        $("#desc_<?php echo $product['product_id'];?>").css('top', position.top-10);
//                        $("#desc_<?php echo $product['product_id'];?>").css('left', position.left-10);
//                        $("#desc_<?php echo $product['product_id'];?>").fadeIn(150);
//                        $("#desc_<?php echo $product['product_id'];?>").css('z-index', 1);
                    }).mouseleave(function (e) {
                        $("#p_info_<?php echo $product['product_id'];?>").slideUp('slow');
                    });
               </script>
      <?php } ?>
    </div>
  </div>
</div>

<!--      <?php foreach ($products as $product) { ?>
      
            <div id="desc_<?php echo $product['product_id'];?>" class="cell_product_item_alt">
              <?php if ($product['thumb']) { ?>
                    <div class="image_product"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
              <?php } ?>
              <div class="btn_add_to_cart" onclick="addToCart('<?php echo $product['product_id']; ?>');"  onmouseover="showDesc(this, 1,'Add to Cart')" onmouseout="showDesc(this, 0,'+')">+</div>
              <div class="btn_add_to_wish" onclick="addToWishList('<?php echo $product['product_id']; ?>');" onmouseover="showDesc(this, 1,'Add to Wishlist')" onmouseout="showDesc(this, 0,'+')">+</div>
                    <div class="product_cell_text">
                            <div class="p_left">
                                  <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                                  <?php if ($product['rating']) { ?>
                                     <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                                  <?php }else{ ?>
                                      <div class="rating"><img src="catalog/view/theme/default/image/stars-0.png" alt="" /></div>
                                  <?php } ?>
                                  
                            </div>
                            <div class="p_right">
                                  <?php if ($product['price']) { ?>
                                          <div class="price">
                                            <?php if (!$product['special']) { ?>
                                            <?php echo $product['price']; ?>
                                            <?php } else { ?>
                                            <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                            <?php } ?>
                                          </div>
                                    <?php } ?>
                            </div>             

                    <div class="cart">
                        <input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />
                    </div>

                  
                      </div>
            </div>
            
           <script>
                    $("#desc_<?php echo $product['product_id'];?>").mouseleave(function (e) {
                            $("#desc_<?php echo $product['product_id'];?>").fadeOut(150);
                            $("#desc_<?php echo $product['product_id'];?>").css('z-index', 0);
                    });
               </script>
      <?php } ?>-->