<?php if(defined("DONT_SHOW_LEFTRIGHT_COLUMN") && DONT_SHOW_LEFTRIGHT_COLUMN=="0"){?>
<?php if ($modules) { ?>
<div id="column-left">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
</div>
<?php } ?> 
<?php } ?>
