<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
    <ul class="link_list">
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
</div>

