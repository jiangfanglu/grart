<?php



// no direct access

defined('_JEXEC') or die('Restricted access');?>

<table class="adminform"><tbody><tr>

        

        <td><span style="padding:10px;"><font size="3"><b>Hi, <a href="#"><?php echo JFactory::getUser()->username;?></a> </b> <b>Visit our website <a href="http://www.sourceaddons.com" target="_blank">www.sourceaddons.com</a> for documentation, support or any help.</b></font></span></td><td><b>Follow us on:</b><br />

		<a href="https://www.facebook.com/pages/Source-addons/162763307197548" target="_blank"><img src="components/com_facebookall/assets/img/iconfacebook.png" alt="facebook"></a>

		<a href="https://twitter.com/sourceaddons" target="_blank"><img src="components/com_facebookall/assets/img/twitter.png" alt="twitter"></a>

		<a href="http://www.linkedin.com/pub/source-addons/5a/61a/80b" target="_blank"><img src="components/com_facebookall/assets/img/linkedin.png" alt="linkedin"></a>

		<a href="http://pinterest.com/sourceaddons/" target="_blank"><img src="components/com_facebookall/assets/img/pinterest.png" alt="pinterest"></a>

		</td>

        </tr></tbody></table>

<table class="adminform"><tr>

<td width="55%" valign="top">



<div id="cpanel">

    <div style="float:left;">

            <div class="icon">

                <a href="index.php?option=com_facebookall&view=mainpanel" >

                <img src="components/com_facebookall/assets/img/joomla.png" height="50px" width="50px">

                <span><?php echo JText::_('COM_FACEBOOKALL_MAINPANEL'); ?></span>

                </a>

            </div>

    </div>

    <div style="float:left;">

            <div class="icon">

                <a href="index.php?option=com_facebookall&view=facebookall" >

                <img src="components/com_facebookall/assets/img/configuration.gif" height="50px" width="50px">

                <span><?php echo JText::_('COM_FACEBOOKALL_CONFIG'); ?></span>

                </a>

            </div>

    </div>

    <div style="float:left;">

            <div class="icon">

                <a href="index.php?option=com_facebookall&view=users" >

                <img src="components/com_facebookall/assets/img/fbuser.png" height="50px" width="50px">

                <span><?php echo JText::_('COM_FACEBOOKALL_CONNECTED_USERS'); ?></span>

                </a>

            </div>

    </div>

    <div style="float:left;">

            <div class="icon">

                <a href="http://www.sourceaddons.com" target="_blank" >

                <img src="components/com_facebookall/assets/img/support.png" height="50px" width="50px">

                <span><?php echo JText::_('COM_FACEBOOKALL_HELP'); ?></span>

                </a>

            </div>

    </div>



    <div style="float:left;">

            <div class="icon">

                <a href="http://www.sourceaddons.com" target="_blank" >

                <img src="components/com_facebookall/assets/img/article.png" height="50px" width="50px">

                <span><?php echo JText::_('COM_FACEBOOKALL_DOC'); ?></span>

                </a>

            </div>

    </div>

	<?php

	       $app_id = (!empty($this->app_result->id) ? $this->app_result->id : "");

		   $app_name = (!empty($this->app_result->name) ? $this->app_result->name : "");

		   $app_url = (!empty($this->app_result->link) ? $this->app_result->link : "");

		   $app_icon = (!empty($this->app_result->icon_url) ? $this->app_result->icon_url : "");

		   $app_logo = (!empty($this->app_result->logo_url) ? $this->app_result->logo_url : "");

		   $app_daily_users = (!empty($this->app_result->daily_active_users) ? $this->app_result->daily_active_users : "0");

		   $app_weak_users = (!empty($this->app_result->weekly_active_users) ? $this->app_result->weekly_active_users : "0");

		   $app_month_users = (!empty($this->app_result->monthly_active_users) ? $this->app_result->monthly_active_users : "0");

	?>

	<div style="float:left; width:615px;">

	<fieldset style="padding:5px">

            <legend>Your Facebook App Info</legend>

                    <div>

                    <div style="float:left;width:80px">

					<?php if (!empty($app_id)) {?>

             <img src="<?php echo $app_logo;?>" /> </div>

                <div style="float: left; margin: 0 0 0 20px">

                    <p style="margin:0 0 5px 0;">Application ID: <b><?php echo $app_id;?></b></p>

					<p style="margin:0 0 5px 0;">Application Name: <b><?php echo $app_name;?></b></p>

                    <p style="margin:0 0 5px 0;">Site URL: <b><?php echo JURI::root();?></b></p>

                    <p style="margin:0 0 5px 0;">Site Domain(s): <b><?php echo $_SERVER['HTTP_HOST'];?></b></p>

					<p style="margin:0 0 5px 0;">Application Url: <a href="<?php echo $app_url;?>" target="_blank"><?php echo $app_url;?></a></p>

              </div>

		</div>

		<?php } else {?>

				   <p style="margin:0 0 5px 0; color:#FF0000; width:500px;">Not get any configured app info for your site. please <a href="index.php?option=com_facebookall&view=facebookall">configure facebook app</a> and make sure cURL/FSOCKOPEN is enabled in your php.ini</p>

				<?php }?>



    </fieldset>

    </div>

	 <div style="float:left;width: 615px">

            <fieldset style="padding: 5px;">

                <legend>Your App Statistics</legend>

				<?php if (!empty($app_id)) {?>

                <!--<p style="margin:0 0 5px 0;"><b>Total Connected Users: </b> <?php //echo $app_id;?></p>-->

                <p style="margin:0 0 5px 0;"><b>Active Monthly Users:</b> <?php echo $app_month_users;?></p>

                <p style="margin:0 0 5px 0;"><b>Active Weekly Users:</b> <?php echo $app_weak_users;?></p>

                <p style="margin:0 0 5px 0;"><b>Active Daily Users:</b> <?php echo $app_daily_users;?></p>

                <p> For more information about your statistics <a target="_BLANK" href="http://www.facebook.com/insights/?sk=ao_<?php echo $app_id;?>">Visit Facebook Insights</a></p>

				<?php } else {?>

				   <p style="margin:0 0 5px 0; color:#FF0000; width:500px;">Not get any configured app info for your site. please <a href="index.php?option=com_facebookall&view=facebookall">configure facebook app</a> and make sure cURL/FSOCKOPEN is enabled in your php.ini</p>

				<?php }?>



            </fieldset>

			</div>

 </div>

</td></tr></table>