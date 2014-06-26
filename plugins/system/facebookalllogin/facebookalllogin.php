<?php
defined ('_JEXEC') or die ('Restricted access');
if (!defined('DS')) {
  define('DS',DIRECTORY_SEPARATOR);
}

jimport ('joomla.plugin.plugin');
jimport ('joomla.filesystem.file');
jimport ('joomla.user.helper');
jimport ('joomla.mail.helper' );
jimport ('joomla.application.component.helper');
jimport ('joomla.application.component.modelform');
jimport ('joomla.application.component.controller' );
jimport ('joomla.event.dispatcher');
jimport ('joomla.plugin.helper');
jimport ('joomla.utilities.date');

// Check if plugins file is correctly installed.
if (!JFile::exists (dirname (__FILE__) . DS . 'facebookalllogin_helper.php')) {
  JError::raiseNotice ('sociallogin_plugin', JText::_ ('Facebook all login plugin not installed correctly.'));
  return;
}

// Includes plugins required files.
require_once(dirname (__FILE__) . DS . 'facebookalllogin_helper.php');

/*
 * Class plugin.
 */

class plgSystemFacebookalllogin extends JPlugin {

/*
 * Class constructor.
 */
  function plgSystemFacebookalllogin(&$subject, $config) {
    parent::__construct($subject,$config);
  }

/*
 * Plugin class function that calls on after plugin intialise.
 */
  function onAfterInitialise() {
    $fball_settings = array(); $fbdata = array();
	$mainframe = JFactory::getApplication();
    $db = JFactory::getDBO();
	$config = JFactory::getConfig();
    $authorize = JFactory::getACL();
	$language = JFactory::getLanguage();
    $language->load('com_users');
    $fball_settings = plgSystemFacebookAllLoginHelper::facebookall_getsettings ();
    if (isset($_GET['code'])) {
      $code = $_GET['code'];
      parse_str(plgSystemFacebookAllLoginHelper::get_fb_contents("https://graph.facebook.com/oauth/access_token?" . 'client_id=' . $fball_settings ['apikey'] . '&redirect_uri=' . urlencode(JURI::root()) .'&client_secret=' .  $fball_settings ['apisecret'] . '&code=' . urlencode($code)));?>
      <script>
           window.opener.wp_fball({'action' : 'fball','fball_access_token' : '<?php echo $access_token ?>'});
           window.close();
      </script>

<?php }
	  if (isset($_REQUEST['redirect_to'])) {
	    if(!empty($_REQUEST['fball_access_token'])) {
	      $fbuser_info = json_decode(plgSystemFacebookAllLoginHelper::get_fb_contents("https://graph.facebook.com/me?access_token=".$_REQUEST['fball_access_token']));
	      $fbdata = plgSystemFacebookAllLoginHelper::get_fbuserprofile_data($fbuser_info);
		}
		else {
		    $mainframe->enqueueMessage(JText::_('Not get access token from facebook please check your app settings.'));
			return false;
		}
		 
		if (!empty($fbdata['email']) AND !empty($fbdata['id'])) {
		 // Filter username form data.
		 if(!empty($fbdata['name'])) {
		   $username = $fbdata['name'];
           $name = $fbdata['first_name'];
		 }
         else if (!empty($fbdata['first_name']) && !empty($fbdata['last_name'])) {
           $username = $fbdata['first_name'].$fbdata['last_name'];
           $name = $fbdata['first_name'];
         }
		 else {
		   $user_emailname = explode('@', $fbdata['email']);
           $username = $user_emailname[0];
           $name = $user_emailname[0];
         }
		 
		 // Check user id exist.
		 if (!empty($fbdata['id'])) {
		   $query="SELECT u.id FROM #__users AS u INNER JOIN #__facebookall_users AS fu ON fu.id = u.id WHERE fu.facebookall_id = ".$db->Quote ($fbdata['id']);
           $db->setQuery($query);
           $user_id = $db->loadResult();
         }
         // If not then check for email exist.
         if (empty($user_id)) {
            $user_id = plgSystemFacebookAllLoginHelper::useremailExists($fbdata['email']);
         }
         
        $newfbuser = true;
        if (isset($user_id) AND !empty($user_id)) {
          $user =& JFactory::getUser($user_id);
          if ($user->id == $user_id) {
            $newfbuser = false;
			if (!empty($user_id)) {
              $query = "SELECT facebookall_id from #__facebookall_users WHERE facebookall_id=".$db->Quote ($fbdata['id'])." AND id = " . $db->Quote ($user_id);
              $db->setQuery($query);
              $link_id = $db->loadResult();
			  if (empty($link_id) && $fball_settings ['linkaccount'] == '1') {
                $profile_Image = $fbdata['thumbnail'];
                if (empty($profile_Image)) {
                  $profile_Image = JURI::root().'media' . DS . 'com_facebookall' . DS .'images' . DS . 'noimage.png';
                }
                $userImage = $user->username . $user_id . '.jpg';
                $fballlogin_savepath = JPATH_ROOT.DS.'images'.DS.'facebookall'.DS;
              
				// Trying to insert image.
                plgSystemFacebookAllLoginHelper::fball_user_picture($fballlogin_savepath, $profile_Image, $userImage);
		        // Add new id to db.
                $sql = "INSERT INTO #__facebookall_users SET id = " . $db->Quote ($user_id).", facebookall_id=".$db->Quote ($fbdata['id']).", picture = " . $db->Quote ($userImage).", access_token =".$db->quote ($_REQUEST['fball_access_token']);
                $db->setQuery ($sql);
                $db->execute();
              }
		    }
          }
        }
		if ($newfbuser == true AND empty($user_id)) {
          //Get the ACL
		  $acl = &JFactory::getACL ();
          //Ggenerate a new JUser Object
		  $user = new JUser;

		  // If user registration is not allowed, show 403 not authorized.
          $usersConfig = JComponentHelper::getParams( 'com_users' );
          if ($usersConfig->get('allowUserRegistration') == '0') {
            JError::raiseWarning( '', JText::_( 'User registration is disabled.'));
            return false;
          }

	      // Default to Registered.
          $defaultUserGroups = $usersConfig->get('new_usertype', 2);
          if (empty($defaultUserGroups)) {
            $defaultUserGroups = 'Registered';
          }

          // if username already exists
          $username = plgSystemFacebookAllLoginHelper::usernameExists($username);
          //Insert data 
          jimport ('joomla.user.helper');
          $userdata = array ();
          $userdata ['name'] = $db->escape($name);
          $userdata ['username'] = $db->escape($username);
          $userdata ['email'] = $fbdata['email'];
          $userdata ['usertype'] = 'deprecated';
          $userdata ['groups'] = array($defaultUserGroups);
          $userdata ['registerDate'] = JFactory::getDate ()->toSql ();
          $userdata ['password'] = JUserHelper::genRandomPassword ();
          $userdata ['password2'] = $userdata ['password'];
          $useractivation = $usersConfig->get( 'useractivation' );
		  
          // Check if the user needs to activate their account.
		  if (($useractivation == 1) || ($useractivation == 2) AND $fball_settings ['byepasslogin'] == 0) {
			$userdata['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
			$userdata['block'] = 1;
		  }
          else {
            $userdata ['activation'] = '';
            $userdata ['block'] = 0;
          }
		  if (!$user->bind ($userdata)) {
            JError::raiseWarning ('', JText::_ ('COM_USERS_REGISTRATION_BIND_FAILED'));
            return false;
          }

          //Save the user
          if (!$user->save()) {
            JError::raiseWarning ('', JText::_ ('User registration failed. please try again.'));
            return false;
          }
          $user_id = $user->get ('id');

          // Trying to insert image.
          $profile_Image = $fbdata['thumbnail'];
          if (empty($profile_Image)) {
            $profile_Image = JURI::root().'media' . DS . 'com_facebookall' . DS .'images' . DS . 'noimage.png';
          }
          $userImage = $username . $user_id . '.jpg';
          $fballlogin_savepath = JPATH_ROOT.DS.'images'.DS.'facebookall'.DS;
          plgSystemFacebookAllLoginHelper::fball_user_picture($fballlogin_savepath, $profile_Image, $userImage);

          // Remove.
          $sql = "DELETE FROM #__facebookall_users WHERE facebookall_id = " . $db->Quote ($fbdata['id']);
          $db->setQuery ($sql);
          if ($db->execute()) {
		    //Add new id to db
            $sql = "INSERT INTO #__facebookall_users SET id = " . $db->quote ($user_id) . ",  facebookall_id = " . $db->Quote ($fbdata['id']).", picture = " . $db->Quote ($userImage).", access_token =".$db->quote ($_REQUEST['fball_access_token']);
            $db->setQuery ($sql);
            $db->execute();
          }
		  
		  // Inserting profile in k2.
		  if (plgSystemFacebookAllLoginHelper::facebookall_component_isEnabled('com_k2') == 1) {
            plgSystemFacebookAllLoginHelper::facebookall_comk2profiles($user_id, $username, $profile_Image, $userImage, $fbdata);
          }
		  
		  // Inserting profile in kunena.
		  if (plgSystemFacebookAllLoginHelper::facebookall_component_isEnabled('com_kunena') == 1) {
            plgSystemFacebookAllLoginHelper::facebookall_kunenaprofiles($user_id, $profile_Image, $userImage, $fbdata);
          }
		  
		  // Inserting profile in Jomsocial.
          if (plgSystemFacebookAllLoginHelper::facebookall_component_isEnabled('community') == 1) {
		    plgSystemFacebookAllLoginHelper::facebookall_jomsocialprofiles($user_id, $profile_Image, $userImage);
			plgSystemFacebookAllLoginHelper::jomsocial_saveProfile($fbdata, $user_id);
          }

		  // Inserting profile in Community builder.
          if (plgSystemFacebookAllLoginHelper::facebookall_component_isEnabled('comprofiler') == 1) {
		 	plgSystemFacebookAllLoginHelper::facebookall_cbprofiles($user_id, $profile_Image, $userImage, $fbdata);
          }
		  
          // Inserting profile in joomla profile plugin.
          if (JPluginHelper::isEnabled('user', 'profile')) {
            plgSystemFacebookAllLoginHelper::facebookall_jpluginprofiles($user_id, $fbdata);
		  }

          if ($useractivation == '2' AND $fball_settings ['byepasslogin'] == 0){
		    plgSystemFacebookAllLoginHelper::send_notification($user, $useractivation, $userdata['activation']);
			$mainframe->enqueueMessage(JText::_('COM_USERS_REGISTRATION_COMPLETE_VERIFY'));
			return false;
		  } 
		  elseif ($useractivation == '1' AND $fball_settings ['byepasslogin'] == 0) {
		    plgSystemFacebookAllLoginHelper::send_notification($user, $useractivation, $userdata['activation']);
			$mainframe->enqueueMessage(JText::_('COM_USERS_REGISTRATION_COMPLETE_ACTIVATE'));
			return false;
		  } 
		  else {
		    plgSystemFacebookAllLoginHelper::send_notification($user, $useractivation, $userdata['activation']);
		  }
        }
		if (isset ($user_id) AND is_numeric ($user_id) AND !empty ($user_id)) {
		  $user = &JFactory::getUser ($user_id);
		  plgSystemFacebookAllLoginHelper::facebookall_wallpost($_REQUEST[ 'fball_access_token' ], $fbdata['id'],$newfbuser);
          if (is_object ($user)) {
            $app = JFactory::getApplication ();
			$query = 'SELECT `id`, `username`, `password` FROM `#__users` WHERE id = ' . $db->Quote ($user->get ('id'));
			$db->setQuery ($query);
			$result = $db->loadObject ();
            if ($result AND ! empty ($result->username)) {
              JPluginHelper::importPlugin ('user');
              $options = array ();
			  $options ['action'] = 'core.login.site';
			  $fb_redirect = plgSystemFacebookAllLoginHelper::getReturnURL();
			  $session = JFactory::getSession();
			  $query = "SELECT picture from #__facebookall_users WHERE facebookall_id=".$db->Quote ($fbdata['id'])." AND id = " . $user->get('id');
              $db->setQuery($query);
              $user_picture = $db->loadResult();
			  $session->set('user_picture', $user_picture);
			  $session->set('redirect_url', trim ($fb_redirect), 'plg_facebookalllogin');
			  $response->username = $result->username;
			  $result = $app->triggerEvent ('onUserLogin', array (
							(array) $response,
							$options
					));
        	  return true;
            }
			}
          }
		}
		else {
		    $mainframe->enqueueMessage(JText::_('Not get any profile data from facebook please check your facebook app settings.'));
			return false;
		}
      } 
    }
    function onAfterRoute() {
	  $fball_settings = plgSystemFacebookAllLoginHelper::facebookall_getsettings ();
	  $session = JFactory::getSession();
	  $redirect_url = $session->get('redirect_url', null, 'plg_facebookalllogin');
      if (!empty($redirect_url)){
		$session->clear('redirect_url', 'plg_facebookalllogin');
		$app =& JFactory::getApplication();
		$fball_settings['optionalredirect'] = (!empty($fball_settings['optionalredirect']) ? $fball_settings['optionalredirect'] : '');
		if (empty($fball_settings['optionalredirect'])) {
		  $app->redirect($redirect_url);
		}
		else {
		  $app->redirect($fball_settings['optionalredirect']);
		}
      }
	}
}