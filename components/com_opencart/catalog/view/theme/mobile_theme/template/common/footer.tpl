<?php if((isset($_REQUEST["route"]) && $_REQUEST["route"]=="common/home") || (isset($_REQUEST["_route_"]) && $_REQUEST["_route_"]=="home") || (!isset($_REQUEST["_route_"]) && !isset($_REQUEST["route"]))){?>

	  <div class="box">
		<div class="box-heading"><?php echo $text_information; ?></div>
		<ul class="link_list">
		  <?php foreach ($informations as $information) { ?>
		  <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
		  <?php } ?>
		</ul>
	  </div>
	<div class="box">
	  <div class="box-heading"><?php echo $text_service; ?></div>
		<ul class="link_list">
		  <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
		  <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
		</ul>
	</div>
	<div class="box">
	  <div class="box-heading"><?php echo $text_extra; ?></div>
		<ul class="link_list">
		  <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
		  <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
		  <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
		  <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		</ul>
	</div>
<?php } ?>
<?php echo $currency; ?>
<?php echo $language; ?>

<div id="footer">
<?php echo $powered; ?></div>
<!-- 
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
</div>
</body></html>