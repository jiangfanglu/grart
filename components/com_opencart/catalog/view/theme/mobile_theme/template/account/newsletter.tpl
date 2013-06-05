<?php echo $header; ?>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="content">
        <label><?php echo $entry_newsletter; ?></label>
        <?php if ($newsletter) { ?>
              <label class="radio_top"><input class="radio" type="radio" name="newsletter" value="1" checked="checked" />
              <?php echo $text_yes; ?></label>
              <label class="radio_bottom"><input class="radio" type="radio" name="newsletter" value="0" />
              <?php echo $text_no; ?></label>
              <?php } else { ?>
              <label class="radio_top"><input class="radio" type="radio" name="newsletter" value="1" />
              <?php echo $text_yes; ?></label>
              <label class="radio_bottom"><input class="radio" type="radio" name="newsletter" value="0" checked="checked" />
              <?php echo $text_no; ?></label>
              <?php } ?>

    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right"><input class="button" type="submit" value="<?php echo $button_continue; ?>"/></div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>