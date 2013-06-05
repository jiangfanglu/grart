<?php

/**

 * @package	mod_facebookall_login

 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.

 * @license		GNU General Public License version 2 or later; see LICENSE.txt

 */



// no direct access

defined('_JEXEC') or die;

if(!defined('DS')){

   define('DS',DIRECTORY_SEPARATOR);

}

JHtml::_('behavior.keepalive');?>

<?php if ($type == 'logout') : ?>

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">

<?php if ($fball_settings ['showlogout'] == 1) : ?>

	<div class="login-greeting">
      <?php $session = JFactory::getSession();
	        $user_picture = $session->get('user_picture');?>
            <div style="float:left;"><img src="<?php if (!empty($user_picture)) { echo JURI::root().'images'.DS.'facebookall'.DS. $session->get('user_picture');} else {echo JURI::root().'media' . DS . 'com_facebookall' . DS .'images' . DS . 'noimage.png';}?>" alt="<?php echo $user->get('name');?>" style="width:80px; height:auto;background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #CCCCCC; display: block; margin: 2px 4px 4px 0; padding: 2px;"></a>
            </div>
	        <div style="font-weight:bold;">
	  <?php if($fball_settings ['showname'] == '0') : {
		      echo JText::_($fball_settings ['greeting'].' '.htmlspecialchars($user->get('name')));
	        } 
			else : {
		      echo JText::_($fball_settings ['greeting'].' '.htmlspecialchars($user->get('username')));
	        } 
          endif; ?>
	      <br />
	      
<div class="logout-button">
		<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	 </div></div></div>
<div style="clear:both;"></div>

<?php endif; ?>

</form>

<?php else : ?>

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-inline">

<?php

$document = &JFactory::getDocument();

$document->addScript(JURI::root().'media/com_facebookall/js/jquery1.4.2.min.js');

$document->addScript(JURI::root().'media/com_facebookall/js/fball_connect.js');
$fball_horicss = '#login-form tr, td {border:none !important;}';?>

    <?php if ($params->get('pretext')): ?>

		<div class="pretext">

		<p><?php echo $params->get('pretext'); ?></p>

		</div>

	<?php endif; ?>
<?php if ($fball_settings ['loginlayout'] == 0) { $document->addStyleDeclaration($fball_horicss); echo '<table><tbody><tr>';}?>
	<?php if ($fball_settings ['showicons'] == 0) : ?>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '<td style="padding:0px 10px 9px!important;">';}?>
	<div class="fball_ui" style="margin-bottom:10px;">
            <div class="fball_form" title="Facebook All">
      <?php if (empty($fball_settings ['changefbicon'])) {?>
              <a href="javascript:void(0);" title="Facebook" class="fball_login_facebook"><img src="<?php echo JURI::root().'media/com_facebookall/images/fball_login.gif';?>" style="cursor:pointer;" > </a>
      <?php }
	        else {?>
              <a href="javascript:void(0);" title="Facebook" class="fball_login_facebook"><img src="<?php echo $fball_settings ['changefbicon'];?>" style="height:<?php echo $fball_settings ['fbicon_height'];?>px;width:<?php echo $fball_settings ['fbicon_width'];?>px;cursor:pointer;" > </a>
      <?php }?>  
            </div>
            <div id="fball_facebook_auth">
            <input type="hidden" name="client_id" value="<?php echo $fball_settings['apikey'];?>" />
            <input type="hidden" name="redirect_uri" value="<?php echo urlencode(JURI::root())?>"/>
            </div>
	        <input type="hidden" id="fball_login_form_uri" value=""/>
            </div>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '</td>';}?>
	<?php endif; 

  if ($fball_settings ['showwithicons'] == 1) : ?>

	<div class="userdata">
<?php if ($fball_settings ['loginlayout'] == 0) { echo '<td>';}?>
		<div id="form-login-username" class="control-group">

			<div class="controls">

				<div class="input-prepend input-append">

					<span class="add-on"><i class="icon-user tip" title="<?php echo JText::_('MOD_FACEBOOKALL_LOGIN_VALUE_USERNAME') ?>"></i><label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_FACEBOOKALL_LOGIN_VALUE_USERNAME'); ?></label></span><input id="modlgn-username" type="text" name="username" class="input-small" tabindex="1" size="18" placeholder="<?php echo JText::_('MOD_FACEBOOKALL_LOGIN_VALUE_USERNAME') ?>" /><a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" class="btn hasTooltip" title="<?php echo JText::_('MOD_FACEBOOKALL_LOGIN_FORGOT_YOUR_USERNAME'); ?>"><i class="icon-question-sign"></i></a>

				</div>

			</div>

		</div>
		 <?php if ($fball_settings ['loginlayout'] == 0) { echo '</td><td>';}?>

		<div id="form-login-password" class="control-group">

			<div class="controls">

				<div class="input-prepend input-append">

					<span class="add-on"><i class="icon-lock tip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"></i><label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label></span><input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="2" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" /><a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" class="btn hasTooltip" title="<?php echo JText::_('MOD_FACEBOOKALL_LOGIN_FORGOT_YOUR_PASSWORD'); ?>"><i class="icon-question-sign"></i></a>

				</div>

			</div>

		</div>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '</td>';}?>
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '<td style="padding-left:20px !important;">';}?>
		<div id="form-login-remember" class="control-group checkbox">

			<label for="modlgn-remember" class="control-label"><?php echo JText::_('MOD_FACEBOOKALL_LOGIN_REMEMBER_ME') ?></label> <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>

		</div>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '</td>';}?>
		<?php endif; ?>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '<td style="padding-left:10px !important;">';}?>
		<div id="form-login-submit" class="control-group">

			<div class="controls">

				<button type="submit" tabindex="3" name="Submit" class="btn btn-primary btn"><?php echo JText::_('JLOGIN') ?></button>

			</div>

		</div>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '</td>';}?>
		<?php

			$usersConfig = JComponentHelper::getParams('com_users');

			if ($usersConfig->get('allowUserRegistration') AND $fball_settings ['loginlayout'] == 1) : ?>

			<ul class="unstyled">

				<li>

					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">

					<?php echo JText::_('MOD_FACEBOOKALL_LOGIN_REGISTER'); ?> <i class="icon-arrow-right"></i></a>

				</li>



			</ul>

		<?php endif; ?>

		<input type="hidden" name="option" value="com_users" />

		<input type="hidden" name="task" value="user.login" />

		<input type="hidden" name="return" value="<?php echo $return; ?>" />

		<?php echo JHtml::_('form.token'); ?>

	</div>

	<?php endif; ?>

	<?php if ($fball_settings ['showicons'] == 1) : ?>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '<td style="padding:0px 10px 9px!important;">';}?>
	<div class="fball_ui">
            <div class="fball_form" title="Facebook All">
      <?php if (empty($fball_settings ['changefbicon'])) {?>
              <a href="javascript:void(0);" title="Facebook" class="fball_login_facebook"><img src="<?php echo JURI::root().'media/com_facebookall/images/fball_login.gif';?>" style="cursor:pointer;" > </a>
      <?php }
	        else {?>
              <a href="javascript:void(0);" title="Facebook" class="fball_login_facebook"><img src="<?php echo $fball_settings ['changefbicon'];?>" style="height:<?php echo $fball_settings ['fbicon_height'];?>px;width:<?php echo $fball_settings ['fbicon_width'];?>px;cursor:pointer;" > </a>
      <?php }?>  
            </div>
            <div id="fball_facebook_auth">
            <input type="hidden" name="client_id" value="<?php echo $fball_settings['apikey'];?>" />
            <input type="hidden" name="redirect_uri" value="<?php echo urlencode(JURI::root())?>"/>
            </div>
	        <input type="hidden" id="fball_login_form_uri" value=""/>
            </div>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '</td>';}?>
	<?php endif; ?>
<?php if ($fball_settings ['loginlayout'] == 0) { echo '</tr></tbody></table>';}?>
	 <?php if ($params->get('posttext')): ?>

		<div class="posttext">

		<p><?php echo $params->get('posttext'); ?></p>

		</div>

	<?php endif; ?>

</form>

<?php endif; ?>