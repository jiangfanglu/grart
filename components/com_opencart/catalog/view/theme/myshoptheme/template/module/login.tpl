<?php if (isset($request->get['route']) && ($request->get['route'] == 'account/account' || $request->get['route'] == 'account/login' || $request->get['route'] == 'account/logout')) { ?>
<?php } elseif($logged) { ?>
      <div class="box">
  <div class="top"><img src="catalog/view/theme/default/image/icon_user_login.png" alt="" /><?php echo $text_welcome; ?></div>
  <div class="middle" id="information" style="text-align: left;">
	<?php echo $text_greeting; ?>
 
  <div style="text-align: center;border-bottom:1px solid #ccc;padding: 15px 0;"><a href="<?php echo $account_logout;?>" class="button"><span><?php echo $button_logout; ?></span></a></div>
  <div id="information" style="margin-top: 10px;>
<p style="margin:0;"><b><?php echo $text_my_account; ?></b></p>
    <ul>
      <li><a href="<?php echo $account_edit;?>"><?php echo $text_information; ?></a></li>
      <li><a href="<?php echo $account_password;?>"><?php echo $text_password; ?></a></li>
      <li><a href="<?php echo $account_address;?>"><?php echo $text_address; ?></a></li>
    </ul>
    &nbsp;
    <p style="margin:0;"><b><?php echo $text_my_orders; ?></b></p>
    <ul>
      <li><a href="<?php echo $account_order;?>"><?php echo $text_history; ?></a></li>
      <li><a href="<?php echo $account_download;?>"><?php echo $text_download; ?></a></li>
    </ul>
    &nbsp;
    <p style="margin:0;"><b><?php echo $text_my_newsletter; ?></b></p>
    <ul>
      <li><a href="<?php echo $account_newsletter;?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
    </div> </div>
  <div class="bottom">&nbsp;</div>
</div>

	<?php } else { ?>
	<div class="box">
  <div class="top"><img src="catalog/view/theme/default/image/icon_user_logout.png" alt="" /><?php echo $heading_title; ?></div>
  <div class="middle" id="information" style="text-align: left;">
	
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="module_login"> 
	<b><?php echo $entry_email_address; ?></b><br />
    <span style="text-align: left;"><input type="text" name="email" style="width:150px;" /></span>
    <br />
    <b><?php echo $entry_password; ?></b><br />
    <input type="password" name="password" style="width:150px;" />
        <br />
		<br />
	<div style="text-align: center;"><a onclick="$('#module_login').submit();" class="button"><span><?php echo $button_login; ?></span></a></div>
	 <ul style="margin-top:15px">
    <li><a href="<?php echo $account_register;?>" class=""><span><?php echo $text_create; ?></span></a></li>
	<li><a href="<?php echo $account_forgotten;?>" class=""><span><?php echo $text_forgotten; ?></span></a></li>
	</ul>
    </form>
    
  </div>
	
  <script type="text/javascript"><!--
  $('#module_login input').keydown(function(e) {
	  if (e.keyCode == 13) {
		  $('#module_login').submit();
	  }
  });
  //--></script>
  <div class="bottom">&nbsp;</div>
</div>	
    <?php } ?>