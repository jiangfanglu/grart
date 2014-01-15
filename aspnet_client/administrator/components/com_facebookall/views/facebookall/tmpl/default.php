<?php

defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');

JHtml::_('behavior.tooltip');

jimport ('joomla.plugin.helper');
jimport( 'joomla.html.html.tabs');
?>


<div>
<form action="<?php echo JRoute::_('index.php?option=com_facebookall&view=facebookall&layout=default'); ?>" method="post" name="adminForm" id="adminForm">

<div style="float:left; width:70%;">

<?php

$options = array(
    'onActive' => 'function(title, description){
        description.setStyle("display", "block");
		title.addClass("open").removeClass("closed");
	}',
    'onBackground' => 'function(title, description){
        description.setStyle("display", "none");
        title.addClass("closed").removeClass("open");
    }',
    'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
    'useCookie' => true, // this must not be a string. Don't use quotes.
);
echo JHtml::_('tabs.start', 'pane', $options);
echo JHtml::_('tabs.panel', JText::_('COM_FACEBOOKALL_BASIC_SETTING'), 'panel1');
?>

<!-- Form basic Box -->

	 <div>

<table class="form-table facebookall_table">

	<tr>

	<th class="head" colspan="2"><?php echo JText::_('COM_FACEBOOKALL_SETTING_API'); ?></small></th>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_API_KEY'); ?></th>

	<td><input size="60" type="text" name="settings[apikey]" id="apikey" value="<?php echo (isset ($this->settings ['apikey']) ? htmlspecialchars ($this->settings ['apikey']) : ''); ?>" /></td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_API_SECRET'); ?></th>

	<td>

		<input size="60" type="text" name="settings[apisecret]" id="apisecret" value="<?php echo (isset ($this->settings ['apisecret']) ? htmlspecialchars ($this->settings ['apisecret']) : ''); ?>" /></td>

	</tr>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_USEAPI'); ?></th>

	<td>

	<?php   $useapi_curl = "";



			$useapi_fopen = "";

			$useapi = (isset($this->settings['useapi']) ? $this->settings['useapi'] : "");



			if ($useapi == '1' ) $useapi_curl = "checked='checked'";



			else if ($useapi == '0') $useapi_fopen = "checked='checked'";



			else $useapi_curl = "checked='checked'";?>

	

	<input name="settings[useapi]" id ="curl" type="radio"  <?php echo $useapi_curl;?>value="1" />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_USEAPI_CURL'); ?> <br />

 <input name="settings[useapi]" id = "fopen" type="radio" <?php echo $useapi_fopen;?>value="0" />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_USEAPI_FOPEN'); ?>

	</td>

	</tr>
	<tr >
    <td>
      <div class="fballrow fballrow_fbbutton">
          <div class="blank">
		    <input id="sitebase_url" type="hidden" value="<?php echo JURI::root();?>" />
            <a href="javascript:void(0);" onclick="MakeApiRequest();"><b style="color:#FFFFFF !important;"><?php echo JText::_('COM_FACEBOOKALL_SETTING_VERIFY_API'); ?></b>
			</a>
		  </div>
        </div>
    </td>
    <td><div id="showmsg" style="font-weight:bold;"></div></td>
  </tr>

	</table>

	<table class="form-table facebookall_table">

	<tr>

	<th class="head" colspan="2"><?php echo JText::_('COM_FACEBOOKALL_SETTING_BASIC'); ?></th>

	</tr>

	<tr>

  <th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_BASIC_REDIRECT'); ?></th>

  <td>

<?php 

$db = &JFactory::getDBO();

$query = "SELECT menutype FROM #__menu_types";

$db->setQuery($query);

$mrows = $db->loadObjectList();

?>

<?php $setredirct = (isset($this->settings['setredirct']) ? $this->settings['setredirct'] : "");?>

<select id="setredirct" name="settings[setredirct]">

<option value="default" selected="selected">---Default---</option>

<?php

foreach ($mrows as $mrow) {?>

<optgroup label="<?php echo $mrow->menutype;?>" style="background:#E7EBF2;">

<?php

$query = "SELECT m.id, m.title,m.level,mt.menutype FROM #__menu AS m

     INNER JOIN #__menu_types AS mt ON mt.menutype = m.menutype

     WHERE mt.menutype = '".$mrow->menutype."' AND m.published = '1' ORDER BY m.level,m.menutype";

$db->setQuery($query);

$rows = $db->loadObjectList();

foreach ($rows as $row) {

?>

<option <?php if ($row->id == $setredirct) { echo " selected=\"selected\""; } ?>value="<?php echo $row->id;?>">

<?php 

  if($row->level == 1) { echo '&nbsp;-&nbsp;';}

  if($row->level == 2) { echo '&nbsp;-&nbsp;-&nbsp;';}

  if($row->level == 3) { echo '&nbsp;-&nbsp;-&nbsp;-&nbsp;';}

  if($row->level == 4) { echo '&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;';}

  if($row->level == 5) { echo '&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;';}

  echo $row->title;?>

  </option>

  </optgroup>

<?php }}?>

</select>

  </td>

 </tr>
 <tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_ALT_REDIRECT'); ?></th>

	<td><?php echo JText::_('COM_FACEBOOKALL_SETTING_ALT_REDIRECT_DESC'); ?>
	<input size="60" type="text"  placeholder="http://example.com/page" name="settings[optionalredirect]" id="apikey" value="<?php echo (isset ($this->settings ['optionalredirect']) ? htmlspecialchars ($this->settings ['optionalredirect']) : ''); ?>" /></td>

	</tr>

 <tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_LINK'); ?></th>

	<td>

	<?php   $yeslink = "";

            $notlink = "";

            $linkaccount = (isset($this->settings['linkaccount'])  ? $this->settings['linkaccount'] : "");



			if ($linkaccount == '1') $yeslink = "checked='checked'";



			else if ($linkaccount == '0') $notlink = "checked='checked'";



			else $yeslink = "checked='checked'";?>

	

     <input name="settings[linkaccount]" type="radio" <?php echo $yeslink;?> value="1"  />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_YES'); ?> <br />

     <input name="settings[linkaccount]" type="radio" <?php echo $notlink;?>value="0"   />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_NO'); ?>

</td>

	</tr>
	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_BYEPASS'); ?></th>

	<td>

	<?php   $yesbyepass = "";

            $notbyepass = "";

            $byepasslogin = (isset($this->settings['byepasslogin'])  ? $this->settings['byepasslogin'] : "");



			if ($byepasslogin == '1') $yesbyepass = "checked='checked'";



			else if ($byepasslogin == '0') $notbyepass = "checked='checked'";



			else $notbyepass = "checked='checked'";?>

	

     <input name="settings[byepasslogin]" type="radio" <?php echo $yesbyepass;?> value="1"  />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_BYEPASS_YES'); ?> <br />

     <input name="settings[byepasslogin]" type="radio" <?php echo $notbyepass;?>value="0"   />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_BYEPASS_NO'); ?>

</td>

	</tr>

	<?php if (JPluginHelper::isEnabled('system', 'k2')) {?>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_K2'); ?></th>

	<td>

<input type="text"  name="settings[k2group]" size="2" style="width:50px !important;" value="<?php echo (isset ($this->settings ['k2group']) ? htmlspecialchars ($this->settings ['k2group']) : '2'); ?>" />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_K2ID'); ?>.

</td>

	</tr>

	<?php }?>

	

 </table>

<table class="form-table facebookall_table">

	<tr>

	<th class="head" colspan="2"><?php echo JText::_('COM_FACEBOOKALL_SETTING_FRONT'); ?></small></th>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_FRONT_TEXT'); ?></th>

	<td><input size="60" type="text" name="settings[greeting]" id="settings[greeting]" value="<?php echo (isset ($this->settings ['greeting']) ? htmlspecialchars ($this->settings ['greeting']) : 'Hi'); ?>" /></td>

	</tr>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_NAME'); ?></th>

	<td>

	<?php    $showonlyname = "";



			$showusername = "";

	       $showname = (isset($this->settings['showname'])  ? $this->settings['showname'] : "");



			if ($showname == '0') $showonlyname = "selected='selected'";



			else if ($showname == '1') $showusername = "selected='selected'";



			else $showonlyname = "selected='selected'";?>

	

<select id="showname" name="settings[showname]">

  <option <?php echo $showonlyname;?>value="0"  ><?php echo JText::_('COM_FACEBOOKALL_NAME'); ?></option>

  <option <?php echo $showusername;?>value="1"><?php echo JText::_('COM_FACEBOOKALL_USERNAME'); ?></option>

</select>

</td>

	</tr>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_FORM'); ?></th>

	<td>

	<?php   $yesshowwithicons = "";



			$notshowwithicons = "";

			$showwithicons = (isset($this->settings['showwithicons'])  ? $this->settings['showwithicons'] : "");



			if ($showwithicons == '1') $yesshowwithicons = "checked='checked'";



			else if ($showwithicons == '0') $notshowwithicons = "checked='checked'";



			else $yesshowwithicons = "checked='checked'";?>

	

    <input name="settings[showwithicons]" type="radio"  <?php echo $yesshowwithicons;?>value="1"  />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_FORM_YES'); ?>

  <br />  <input name="settings[showwithicons]" type="radio" <?php echo $notshowwithicons;?>value="0"  />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_FORM_NO'); ?>

</td>

	</tr>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_GREETING'); ?></th>

	<td>

	<?php   $yesshowlogout = "";



			$notshowlogout = "";

$showlogout = (isset($this->settings['showlogout'])  ? $this->settings['showlogout'] : "");

			if ($showlogout == '1') $yesshowlogout = "checked='checked'";



			else if ($showlogout == '0') $notshowlogout = "checked='checked'";



			else $yesshowlogout = "checked='checked'";?>

	

	<input name="settings[showlogout]" type="radio" <?php echo $yesshowlogout;?> value="1" />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_GREETING_YES'); ?>

   <br /> <input name="settings[showlogout]" type="radio" <?php echo $notshowlogout;?>value="0"  />&nbsp;&nbsp;<?php echo JText::_('COM_FACEBOOKALL_SETTING_GREETING_NO'); ?>

	</td>

	</tr>

<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_ICONS'); ?></th>

	<td>

	<?php    $topshowicons = "";



			$botshowicons = "";

	$showicons = (isset($this->settings['showicons']) ? $this->settings['showicons'] : "");



			if ($showicons == '0') $topshowicons = "selected='selected'";



			else if ($showicons == '1') $botshowicons = "selected='selected'";



			else $topshowicons = "selected='selected'";?>

	

<select id="showicons" name="settings[showicons]">

  <option <?php echo $topshowicons;?>value="0" ><?php echo JText::_('COM_FACEBOOKALL_SETTING_ICONS_TOP'); ?></option>

  <option <?php echo $botshowicons;?>value="1" ><?php echo JText::_('COM_FACEBOOKALL_SETTING_ICONS_BOT'); ?></option>

</select>

</td>

	</tr>	
<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_IMAGE');?></th>

	<td>
	 <?php echo JText::_('COM_FACEBOOKALL_SETTING_IMAGE_DESC'); ?><br />
	<input size="60" type="text" name="settings[changefbicon]" placeholder="http://example.com/images/fbicon.png" id="settings[changefbicon]" value="<?php echo (isset ($this->settings ['changefbicon']) ? htmlspecialchars ($this->settings ['changefbicon']) : ''); ?>" /><br />
	<?php echo JText::_('COM_FACEBOOKALL_SETTING_IMAGE_HEIGHT'); ?> <input size="2" type="text" name="settings[fbicon_height]" style="width:50px !important;" placeholder="50" id="settings[fbicon_height]" value="<?php echo (isset ($this->settings ['fbicon_height']) ? htmlspecialchars ($this->settings ['fbicon_height']) : ''); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo JText::_('COM_FACEBOOKALL_SETTING_IMAGE_WIDTH'); ?> <input size="2" type="text" name="settings[fbicon_width]" style="width:50px !important;" placeholder="50" id="settings[fbicon_width]" value="<?php echo (isset ($this->settings ['fbicon_width']) ? htmlspecialchars ($this->settings ['fbicon_width']) : ''); ?>" /></span>

	
	</td>

	</tr>
	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_SETTING_LAYOUT'); ?></th>

	<td>

	<?php    $loginform_horizontal = "";



			$loginform_vertical = "";

	$loginlayout = (isset($this->settings['loginlayout']) ? $this->settings['loginlayout'] : "");



			if ($loginlayout == '0') $loginform_horizontal = "selected='selected'";



			else if ($loginlayout == '1') $loginform_vertical = "selected='selected'";



			else $loginform_vertical = "selected='selected'";?>

	

<select id="loginlayout" name="settings[loginlayout]">

  <option <?php echo $loginform_horizontal;?>value="0" ><?php echo JText::_('COM_FACEBOOKALL_SETTING_LAYOUT_HORI'); ?></option>

  <option <?php echo $loginform_vertical;?>value="1" ><?php echo JText::_('COM_FACEBOOKALL_SETTING_LAYOUT_VERTICAL'); ?></option>

</select>

</td>

	</tr>

</table>



</div>

<!-- Form basic ends-->

<?php echo JHtml::_('tabs.panel', JText::_('COM_FACEBOOKALL_WALL_SETTING'), 'panel2');?>

<!-- Wall Post Box -->

	 <div>

<table class="form-table facebookall_table">

	<tr>

	<th class="head" colspan="2"><?php echo JText::_('COM_FACEBOOKALL_WALL_NEW_SETTING'); ?></th>

	</tr>

	<tr>

	<th><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_SETTING'); ?></th>

	<td>

	<?php   $enablenewpost = "";

            $enablenewpost = (isset($this->settings['enablenewpost']) == 'on'  ? 'on' : 'off');

			if ($enablenewpost == 'on') $enablenewpost = "checked='checked'";

    ?>

<input name="settings[enablenewpost]" type="checkbox"  <?php echo $enablenewpost;?>value="on"  />	</td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_TITLE'); ?></th>

	<td><input size="60" type="text" name="settings[new_post_title]" id="settings[new_post_title]" value="<?php echo (isset ($this->settings ['new_post_title']) ? htmlspecialchars ($this->settings ['new_post_title']) : ''); ?>" /></td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_URL'); ?></th>

	<td>

		<input size="60" type="text" name="settings[new_post_url]" id="settings[new_post_url]" value="<?php echo (isset ($this->settings ['new_post_url']) ? htmlspecialchars ($this->settings ['new_post_url']) : ''); ?>" /></td>

	</tr>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_MESSAGE'); ?></th>

	<td><textarea rows="3" cols="71"  name="settings[new_post_message]" id="settings[new_post_message]" value="<?php echo (isset ($this->settings ['new_post_message']) ? htmlspecialchars ($this->settings ['new_post_message']) : ''); ?>" /></textarea></td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_PICTURE'); ?></th>

	<td>

		<input size="60" type="text" name="settings[new_post_pic]" id="settings[new_post_pic]" value="<?php echo (isset ($this->settings ['new_post_pic']) ? htmlspecialchars ($this->settings ['new_post_pic']) : ''); ?>" /></td>

	</tr>

<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_DESC'); ?></th>

	<td>

		<textarea rows="3" cols="71"  name="settings[new_post_desc]" id="settings[new_post_desc]" value="<?php echo (isset ($this->settings ['new_post_desc']) ? htmlspecialchars ($this->settings ['new_post_desc']) : ''); ?>" /></textarea></td>

	</tr>

	

	</table>

<table class="form-table facebookall_table">

	<tr>

	<th class="head" colspan="2"><?php echo JText::_('COM_FACEBOOKALL_WALL_RETURN_SETTING'); ?></th>

	</tr>

	<tr>

	<th><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_RETURN'); ?></th>

	<td>

	<?php   $enableoldpost = "";

            $enableoldpost = (isset($this->settings['enableoldpost']) == 'on'  ? 'on' : 'off');

			if ($enableoldpost == 'on') $enableoldpost = "checked='checked'";

    ?>

<input name="settings[enableoldpost]" type="checkbox"  <?php echo $enableoldpost;?>value="on"  />	</td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_TITLE'); ?></th>

	<td><input size="60" type="text" name="settings[old_post_title]" id="settings[old_post_title]" value="<?php echo (isset ($this->settings ['old_post_title']) ? htmlspecialchars ($this->settings ['old_post_title']) : ''); ?>" /></td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_URL'); ?></th>

	<td>

		<input size="60" type="text" name="settings[old_post_url]" id="settings[old_post_url]" value="<?php echo (isset ($this->settings ['old_post_url']) ? htmlspecialchars ($this->settings ['old_post_url']) : ''); ?>" /></td>

	</tr>

	<tr>

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_MESSAGE'); ?></th>

	<td><textarea rows="3" cols="71"  name="settings[old_post_message]" id="settings[old_post_message]" value="<?php echo (isset ($this->settings ['old_post_message']) ? htmlspecialchars ($this->settings ['old_post_message']) : ''); ?>" /></textarea></td>

	</tr>

	<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_PICTURE'); ?></th>

	<td>

		<input size="60" type="text" name="settings[old_post_pic]" id="settings[old_post_pic]" value="<?php echo (isset ($this->settings ['old_post_pic']) ? htmlspecialchars ($this->settings ['old_post_pic']) : ''); ?>" /></td>

	</tr>

<tr >

	<th scope="fballrow"><?php echo JText::_('COM_FACEBOOKALL_WALL_POST_DESC'); ?></th>

	<td>

		<textarea rows="3" cols="71"  name="settings[old_post_desc]" id="settings[old_post_desc]" value="<?php echo (isset ($this->settings ['old_post_desc']) ? htmlspecialchars ($this->settings ['old_post_desc']) : ''); ?>" /></textarea></td>

	</tr>

	

	</table>



</div>

<!-- Wall Post ends-->



<?php echo JHtml::_('tabs.end');?>

</div>	

<input type="hidden" name="task" value="" />

</form>

<div style="width:28%; float:right; margin-top:33px;">

<div>
<fieldset>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XLZSDLXWGA5DA">
<table>
<tr><td><input type="hidden" name="on0" value="if this extension useful to you. would you buy me a coffee/beer"><b>If this extension is useful to you. would you buy me a coffee/beer.</b></td></tr><tr><td><select name="os0">
	<option value="Coffee">Coffee $5.00 USD</option>
	<option value="Special coffee">Special coffee $10.00 USD</option>
	<option value="Beer">Beer $20.00 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="components/com_facebookall/assets/img/paypal-buyme.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

</fieldset>
</div>
</div>

</div>