
  <!--<div class="box-heading"><?php echo $heading_title; ?></div>-->
  <div class="box-content category_width">
    <div class="box-category category_width">
        <h4><?php echo $heading_title ?></h4>
      <ul>
        <?php foreach ($categories as $category) { ?>
        <li>
          
          <?php if ($category['children']) { ?>
                <?php if ($category['category_id'] == $category_id) { ?>
                <a class="active" id="category_<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
                <?php } else { ?>
                <a id="category_<?php echo $category['category_id']; ?>"><span id="expand_<?php echo $category['category_id'] ?>">+</span> <?php echo $category['name']; ?> </a>
                <?php } ?>
                
                <ul id="cate_<?php echo $category['category_id']; ?>">
                  <?php foreach ($category['children'] as $child) { ?>
                  <li>
                    <?php if ($child['category_id'] == $child_id) { ?>
                       <a href="<?php echo $child['href']; ?>" class="active"> <?php echo $child['name']; ?></a>
                    <?php } else { ?>
                       <a href="<?php echo $child['href']; ?>"> <?php echo $child['name']; ?></a>
                    <?php } ?>
                  </li>
                  <?php } ?>
                </ul>
                
                <script>
                   $("#category_<?php echo $category['category_id']; ?>").click(function () {
                      if($("#expand_<?php echo $category['category_id'] ?>").html() == "+"){
                        $("#expand_<?php echo $category['category_id'] ?>").html('-');
                      }else{
                        $("#expand_<?php echo $category['category_id'] ?>").html('+');
                      }
                      $("#cate_<?php echo $category['category_id']; ?>").slideToggle('slow');
                    });
                </script>
                
          <?php }else{ ?>
                <?php if ($category['category_id'] == $category_id) { ?>
                   <a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
                <?php } else { ?>
                   <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                <?php } ?>
          <?php } ?>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
