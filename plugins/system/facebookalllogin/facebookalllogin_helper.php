<?php
defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');


/*
 * SocialLogin plugin helper class.
 */
class plgSystemFacebookAllLoginHelper {
	
/*
 * Get the databse settings.
 */
	public static function facebookall_getsettings () {
      $fball_settings = array ();
      $db = JFactory::getDBO ();
	  $sql = "SELECT * FROM #__facebookall_settings";
      $db->setQuery ($sql);
      $rows = $db->LoadAssocList ();
      if (is_array ($rows)) {
        foreach ($rows AS $key => $data) {
          $fball_settings [$data ['setting']] = $data ['value'];
        }
      }
      return $fball_settings;
    }

/*
 * Get the databse settings.
 */
	public static function facebookall_component_isEnabled ($cmp_name) {
      $db = JFactory::getDbo();
      $db->setQuery("SELECT enabled FROM #__extensions WHERE name = '".$cmp_name."'");
      $is_enabled = $db->loadResult();
      return $is_enabled;
    }

	
/*
 * Get the wall post settings.
 */
	public static function facebookall_wallpost ($access_token, $fbid, $newfbuser) {
	  $fball_settings = self::facebookall_getsettings ();
	  $fball_settings['enablenewpost'] = (!empty($fball_settings['enablenewpost']) ? $fball_settings['enablenewpost'] : '');
      if ($fball_settings['enablenewpost'] == 'on' && $newfbuser == true) {
	    $attachment =  array(
          'access_token' => $access_token,
          'message' => $fball_settings['new_post_message'],
          'name' => $fball_settings['new_post_title'],
          'link' => $fball_settings['new_post_url'],
          'description' => $fball_settings['new_post_desc'],
          'picture'=>$fball_settings['new_post_pic']
        );
        self::facebookall_wallpost_curl ($attachment,$fbid);
	  }
	  $fball_settings['enableoldpost'] = (!empty($fball_settings['enableoldpost']) ? $fball_settings['enableoldpost'] : '');
	  if ($fball_settings['enableoldpost'] == 'on' && $newfbuser == false) {
	    $attachment =  array(
          'access_token' => $access_token,
          'message' => $fball_settings['old_post_message'],
          'name' => $fball_settings['old_post_title'],
          'link' => $fball_settings['old_post_url'],
          'description' => $fball_settings['old_post_desc'],
          'picture'=>$fball_settings['old_post_pic']
        );
		self::facebookall_wallpost_curl ($attachment,$fbid);
	  }
    }
	
/*
 * Get the wall post settings.
 */
	public static function facebookall_wallpost_curl ($attachment,$fbid) {
	  if (function_exists('curl_init')) {
	    $url = "https://graph.facebook.com/".$fbid."/feed";
        // set the target url
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
        $result = curl_exec($ch);
        curl_close ($ch);
      }
    }
	
/**
 * Function that getting api settings.
 */
  public static function get_fb_contents( $url ) {
    $fball_settings = self::facebookall_getsettings ();
    if ($fball_settings['useapi'] == 1) {
      $curl = curl_init();
	  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	  curl_setopt( $curl, CURLOPT_URL, $url );
	  curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
      $response = curl_exec( $curl );
      curl_close( $curl );
      return $response;
    }
	else {
	   $response = file_get_contents($url);
	   return $response;
	}
  }
  
/*
 * Check if the given email exists
 */
	public static function useremailExists ($email)
	{
		//Database handler
		$db = JFactory::getDBO ();

		//Get user for email
		$sql = "SELECT id FROM #__users WHERE email = " . $db->quote ($email);
		$db->setQuery ($sql);
		$user_id = $db->loadResult ();

		//Done
		return $user_id;
	}
	

/*
 * Function that checking username exist then adding index to it.
 */
   public static function usernameExists($username) {
     $nameexists = true;
     $index = 0;
     $userName = $username;
     while ($nameexists == true) {
       if (JUserHelper::getUserId($userName) != 0) {
         $index++;
         $userName = $username.$index;
       } 
	   else {
         $nameexists = false;
       }
     }
     return $userName;
   }
   
/*
 * Function getting return url after login.
 */
   public static function getReturnURL() {
     $app = JFactory::getApplication();
     $router = $app->getRouter();
	 $fball_settings = self::facebookall_getsettings ();
	 $check_rewrite = $app->getCfg('sef_rewrite');
     $url = null;
	 $db = JFactory::getDbo();
     if ($itemid = $fball_settings['setredirct']) {
	   if ($fball_settings['setredirct'] != 'default') {
	     if ($router->getMode() == JROUTER_MODE_SEF) {
		   $query = "SELECT path FROM #__menu WHERE id = ".$itemid;
           $db->setQuery($query);
           $url = $db->loadResult();
		   if($check_rewrite == '0' AND !empty($url)) {
		      $url = 'index.php/'.$url;
		   }
         }
         else {
           $query = "SELECT link FROM #__menu WHERE id = ".$itemid;
           $db->setQuery($query);
            $url = $db->loadResult();
         }
	   }
     }
     if (!$url) {
       // stay on the same page
       $uri = clone JFactory::getURI();
       $vars = $router->parse($uri);
       unset($vars['lang']);
       if ($router->getMode() == JROUTER_MODE_SEF) {
         if (isset($vars['Itemid'])) {
           $itemid = $vars['Itemid'];
           $menu = $app->getMenu();
           $item = $menu->getItem($itemid);
           unset($vars['Itemid']);
           if (isset($item) && $vars == $item->query) {
		     $query = "SELECT path FROM #__menu WHERE id = '".$itemid."' AND home = 1";
             $db->setQuery($query);
             $home_url = $db->loadResult();
			 if ($home_url) {
			   $url = 'index.php'; 
			 }
		     else {
               $query = "SELECT path FROM #__menu WHERE id = ".$itemid;
               $db->setQuery($query);
               $url = $db->loadResult();
			   if($check_rewrite == '0' AND !empty($url)) {
		         $url = 'index.php/'.$url;
		       }
			 }
           }
           else {
             // get article url path
             $articlePath = &JFactory::getURI()->getPath();
             $url = $articlePath;
           }
         }
         else {
          $articlePath = &JFactory::getURI()->getPath();
          $url = $articlePath;
         }
       }
       else {
        $url = 'index.php?'.JURI::buildQuery($vars);
       }
     }
     return $url;
  }

/*
 * Function getting user data from facebook.
 */
   public static function get_fbuserprofile_data($fbuser_info) {
     $fbdata['id'] = (!empty($fbuser_info->id) ? $fbuser_info->id : '');
	 $fbdata['first_name'] = (!empty($fbuser_info->first_name) ? $fbuser_info->first_name : '');
     $fbdata['last_name'] = (!empty($fbuser_info->last_name) ? $fbuser_info->last_name : '');
	 $fbdata['name'] = (!empty($fbuser_info->name) ? $fbuser_info->name : '');
	 $fbdata['dob'] = (!empty($fbuser_info->birthday) ? $fbuser_info->birthday : '');
     $fbdata['gender'] = (!empty($fbuser_info->gender) ? $fbuser_info->gender : '');
     $fbdata['company'] =  (!empty( $fbuser_info->work[0]->employer->name) ?  $fbuser_info->work[0]->employer->name : '');
	 $fbdata['location'] =  (!empty( $fbuser_info->location->name) ?  $fbuser_info->location->name : '');
	 $location = (!empty($fbuser_info->hometown->name) ? $fbuser_info->hometown->name : '');
	 if (!empty($location)) {
	   $location = explode(',', $location);
	 }				
	 $fbdata['city'] = (!empty($location[0]) ? $location[0] : $fbdata['location']);
     $fbdata['state'] = (!empty($location[1]) ? trim($location[1]) : $fbdata['location']);
	 $fbdata['country'] = (!empty($location[2]) ? trim($location[2]) : '');
     $fbdata['address'] = (!empty($fbuser_info->hometown->name) ? $fbuser_info->hometown->name : '');
	 if (empty($fbdata['address'])) {
	   $fbdata['address'] = (!empty($fbuser_info->hometown->name) ? $fbuser_info->hometown->name : $fbdata['location']);
	 }
	 $fbdata['email'] = (!empty($fbuser_info->email) ? $fbuser_info->email : '');
     $fbdata['thumbnail'] = "https://graph.facebook.com/" . $fbdata['id'] . "/picture?type=large";
     $fbdata['aboutme'] = (!empty($fbuser_info->bio) ? $fbuser_info->bio : "");
	 $fbdata['website'] = (!empty( $fbuser_info->link) ? $fbuser_info->link : "");
	 $fbdata['college'] = (!empty($fbuser_info->education[1]->school->name) ? $fbuser_info->education[1]->school->name :'');
	 $fbdata['clg_year'] = (!empty($fbuser_info->education[1]->year->name) ? $fbuser_info->education[1]->year->name :'');
	 if (empty($fbdata['college'])) {
	   $fbdata['college'] = (!empty($fbuser_info->education[0]->school->name) ? $fbuser_info->education[0]->school->name :'');
	   $fbdata['clg_year'] = (!empty($fbuser_info->education[0]->year->name) ? $fbuser_info->education[0]->year->name :'');
	 }
	 return $fbdata;
   }
   

/*
 * Function that remove unescaped char from string.
 */
   public static function fball_user_picture($path, $profile_Image, $userImage) {
	  $fball_settings = self::facebookall_getsettings ();
      if ($fball_settings['useapi'] == 1) {
        $ch = curl_init($profile_Image);
        $fp = fopen($path . $userImage, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
		curl_close($ch);
        fclose($fp);
      }
      else {
        $thumb_image = @file_get_contents($profile_Image);
        if (@$http_response_header == NULL) {
          $profile_Image = str_replace('https', 'http', $profile_Image);
          $thumb_image = @file_get_contents($profile_Image);
        }
        $thumb_file = $path . $userImage;
        @file_put_contents($thumb_file, $thumb_image);
     }
   }
  
/*
 * Function that sending all notification to user and admin.
 */ 
   public static function send_notification(&$user, $useractivation, $userdata) {
        $application = JFactory::getApplication();
        $config = JFactory::getConfig();
		$db = JFactory::getDbo();
		$params = JComponentHelper::getParams('com_users');
		$sendpassword = $params->get('sendpassword', 1);
     // Compile the notification mail values.
		$data = $user->getProperties();
		$data['activation'] = $userdata;
		$data['fromname']	= $config->get('fromname');
		$data['mailfrom']	= $config->get('mailfrom');
		$data['sitename']	= $config->get('sitename');
		$data['siteurl']	= JUri::root();

		// Handle account activation/confirmation emails.
		if ($useractivation == 2)
		{
			// Set the link to confirm the user email.
			$uri = JURI::getInstance();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			if ($sendpassword)
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY',
					$data['name'],
					$data['sitename'],
					$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			}
			else
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
					$data['siteurl'],
					$data['username']
				);
			}
		}
		elseif ($useractivation == 1)
		{
			// Set the link to activate the user account.
			$uri = JURI::getInstance();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			if ($sendpassword)
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
					$data['name'],
					$data['sitename'],
					$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			}
			else
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
					$data['siteurl'],
					$data['username']
				);
			}
		}
		else
		{

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl']
			);
		}

		// Send the registration email.
		$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

		//Send Notification mail to administrators
		if (($params->get('useractivation') < 2) && ($params->get('mail_to_admin') == 1)) {
			$emailSubject = JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBodyAdmin = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_NOTIFICATION_TO_ADMIN_BODY',
				$data['name'],
				$data['username'],
				$data['siteurl']
			);

			// get all admin users
			$query = 'SELECT name, email, sendEmail' .
					' FROM #__users' .
					' WHERE sendEmail=1';

			$db->setQuery( $query );
			$rows = $db->loadObjectList();

			// Send mail to all superadministrators id
			foreach( $rows as $row )
			{
				$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBodyAdmin);

				// Check for an error.
				if ($return !== true) {
					$application->enqueueMessage(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'), 'error');
					return false;
				}
			}
		}
		// Check for an error.
		if ($return !== true) {
			$application->enqueueMessage(JText::_('COM_USERS_REGISTRATION_SEND_MAIL_FAILED'), 'error');

			// Send a system message to administrators receiving system mails
			$db = JFactory::getDBO();
			$q = "SELECT id
				FROM #__users
				WHERE block = 0
				AND sendEmail = 1";
			$db->setQuery($q);
			$sendEmail = $db->loadColumn();
			if (count($sendEmail) > 0) {
				$jdate = new JDate();
				// Build the query to add the messages
				$q = "INSERT INTO ".$db->quoteName('#__messages')." (".$db->quoteName('user_id_from').
				", ".$db->quoteName('user_id_to').", ".$db->quoteName('date_time').
				", ".$db->quoteName('subject').", ".$db->quoteName('message').") VALUES ";
				$messages = array();

				foreach ($sendEmail as $userid) {
					$messages[] = "(".$userid.", ".$userid.", '".$jdate->toSql()."', '".JText::_('COM_USERS_MAIL_SEND_FAILURE_SUBJECT')."', '".JText::sprintf('COM_USERS_MAIL_SEND_FAILURE_BODY', $return, $data['username'])."')";
				}
				$q .= implode(',', $messages);
				$db->setQuery($q);
				$db->execute();
			}
			return false;
		}
   }

/*
 * Make compatible facebookall with k2.
 */
  public static function facebookall_comk2profiles($user_id, $username, $profile_Image, $userImage, $fbdata) {
	$fball_settings = self::facebookall_getsettings ();
	JPlugin::loadLanguage('com_k2');
    JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
    $row = &JTable::getInstance('K2User', 'Table');
    $k2id = self::getK2UserID($user_id);
    JRequest::setVar('id', $k2id, 'post');
    $row->bind(JRequest::get('post'));
    $row->set('userID', $user_id);
    $row->set('userName',  $username);
    $row->set('ip', $_SERVER['REMOTE_ADDR']);
    $row->set('hostname', gethostbyaddr($_SERVER['REMOTE_ADDR']));
    $row->set('notes', '');
    $row->set('group', trim($fball_settings['k2group']));
	if ($fbdata['gender'] == 'male') {
	  $fbdata['gender'] ='m';
	}
	if ($fbdata['gender'] == 'female') {
	  $fbdata['gender'] ='f';
	}
    $row->set('gender', $fbdata['gender']);
    $row->set('url', $fbdata['website']);
    $row->set('description', $fbdata['aboutme']);
    $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'users'.DS;
	self::fball_user_picture($savepath, $profile_Image, $userImage);
    $row->set('image', $userImage);
    $row->store();
  }

/*
 * Function getting k2 plugin userID.
 */
  public static function getK2UserID($id) {
    $db = &JFactory::getDBO();
    $query = "SELECT id FROM #__k2_users WHERE userID={$id}";
    $db->setQuery($query);
    $result = $db->loadResult();
    return $result;
  }
  
/*
 * Make compatible facebookall with CB.
 */

    public static function facebookall_cbprofiles($user_id, $profile_Image, $userImage, $fbdata) {

     $db =& JFactory::getDBO();

     $cbsavepath = JPATH_ROOT.DS.'images'.DS.'comprofiler'.DS;

     self::fball_user_picture($cbsavepath, $profile_Image, $userImage);

     $cbquery = "INSERT IGNORE INTO #__comprofiler(id,user_id,firstname,lastname,avatar) VALUES ('".$user_id."','".$user_id."','".$fbdata['first_name']."','".$fbdata['last_name']."','".$userImage."')";

     $db->setQuery($cbquery);

     $db->execute();

   }

	
/*
 * Make compatible facebookall with Jomsocial.
 */

   public static function facebookall_jomsocialprofiles($user_id, $profile_Image, $userImage) {
	 $db =& JFactory::getDBO();
	 $joomsavepath = JPATH_ROOT.DS.'images'.DS.'avatar'.DS;
     $dumpuserImage = 'images/avatar/'.$userImage;
     self::fball_user_picture($joomsavepath, $profile_Image, $userImage);
     $joomquery = "INSERT IGNORE INTO #__community_users(userid,avatar,thumb) VALUES('".$user_id."','".$dumpuserImage."','".$dumpuserImage."')";
     $db->setQuery($joomquery);    
	 $db->execute();
   }
	
/*
 * Make compatible facebookall with kunena.
 */

   public function facebookall_kunenaprofiles($user_id, $profile_Image, $userImage, $fbdata) {
     $db =& JFactory::getDBO();
     $userImage = 'avatar'.$userImage;
     if ($fbdata['gender'] == 'male') {
       $fbdata['gender'] = '1';
     }
     else if ($fbdata['gender'] == 'female') {
       $fbdata['gender'] = '2';
     }
	 $kunenadob = new JDate($fbdata['dob']);
     $fbdata['dob'] = $kunenadob->toFormat('%Y-%m-%d');
     $kunenasavepath = JPATH_ROOT.DS.'media'.DS.'kunena'.DS.'avatars'.DS.'users'.DS;
     $dumpuserImage = 'users/'.$userImage;
     self::fball_user_picture($kunenasavepath, $profile_Image, $userImage);
	 $kunenaquery = "UPDATE #__kunena_users SET userid = '".$user_id."',avatar = '".$dumpuserImage."',gender = '".$fbdata['gender']."',birthdate = '".$fbdata['dob']."',location = '".$fbdata['address']."',personalText = '".$fbdata['aboutme']."',facebook = '".$fbdata['id']."',websiteurl = '".$fbdata['website']."' WHERE userid = '".$user_id."'";
     $db->setQuery($kunenaquery);
     $db->execute();
   }

/*
 * Make compatible facebookall with joomla profile plugin.
 */   

   public static function facebookall_jpluginprofiles($user_id, $fbdata) {
     $db = JFactory::getDBO ();
     $data = array();
     $data['profile']['address1'] = $fbdata['address'];
     $data['profile']['address2'] = $fbdata['address'];
	 $data['profile']['city'] = $fbdata['city'];
     $data['profile']['country'] = $fbdata['country'];
     $data['profile']['dob'] = $fbdata['dob'];
     $data['profile']['aboutme'] = $fbdata['aboutme'];
     $data['profile']['website'] = $fbdata['website'];
     //Sanitize the date
     if (!empty($data['profile']['dob'])) {
	   $date = new JDate($data['profile']['dob']);
       $data['profile']['dob'] = $date->toFormat('%Y-%m-%d');
     }
     else {
       $data['profile']['dob'] = $data['profile']['dob'];
     }
     $tuples = array();
     $order	= 1;
     foreach ($data['profile'] as $k => $v) {
	   $tuples[] = '('.$user_id.', '.$db->quote('profile.'.$k).', '.$db->quote($v).', '.$order++.')';
     }
     $db->setQuery('INSERT INTO #__user_profiles VALUES '.implode(', ', $tuples));
     $db->execute();
   }

/* ================================ Making compatible with jomsocial =====================================*/   

/*
 * check Jomsocial profile.
 */   

  public static function getEditableProfile($userId,  $profileType = 0) {
    $db =& JFactory::getDBO();
    $data = array();
    $user =& JFactory::getUser($userId);
    $data['id'] = $user->id;
    $data['name'] = $user->name;
    $data['email'] = $user->email;

    // Attach custom fields into the user object		
    $query	= 'SELECT field.*, value.'.$db->nameQuote('value').' , value.'.$db->nameQuote('access')
				. 'FROM ' . $db->nameQuote('#__community_fields') . ' AS field '
				. 'LEFT JOIN ' . $db->nameQuote('#__community_fields_values') . ' AS value '
 				. 'ON field.'.$db->nameQuote('id').'=value.'.$db->nameQuote('field_id').' AND value.'.$db->nameQuote('user_id').'=' . $db->Quote($userId);

    // Build proper query for multiple profile types.
    if( $profileType != 0 ) {
      $query2 = 'SELECT '.$db->nameQuote('field_id').' FROM ' . $db->nameQuote( '#__community_profiles_fields' ) . ' '
					. 'WHERE ' . $db->nameQuote( 'parent' ) . '=' . $db->Quote( $profileType );
      $db->setQuery( $query2 );
      $filterIds = $db->loadResultArray();
      if ( empty( $filterIds ) ) {
        $data['fields'] = array();
        return $data;
      }
      $query .= ' WHERE field.'.$db->nameQuote('id').' IN (' . implode( ',' , $filterIds ) . ')';
      $query .= ' AND field.'.$db->nameQuote('published').'=' . $db->Quote( '1' );
    }
    else {
      $query .= ' WHERE field.'.$db->nameQuote('published').'=' . $db->Quote('1');
    }
    $query .= ' ORDER BY field.'.$db->nameQuote('ordering');
    $db->setQuery( $query );
    $result	= $db->loadAssocList();
	if ($db->getErrorNum()) {
      JError::raiseError( 500, $db->stderr());
    }
	$data['fields']	= array();
	for($i = 0; $i < count($result); $i++) {
			// We know that the groups will definitely be correct in ordering.			
			if($result[$i]['type'] == 'group')
			{
				$group	= $result[$i]['name'];
				// Group them up			
				if(!isset($data['fields'][$group]))
				{
					// Initialize the groups.
					$data['fields'][$group]	= array();
				}
			}

			// Re-arrange options to be an array by splitting them into an array
			if(isset($result[$i]['options']) && $result[$i]['options'] != '')
			{
				$options	= $result[$i]['options'];
				$options	= explode("\n", $options);
				array_walk($options, array( 'JString' , 'trim' ) );
				$result[$i]['options']	= $options;
			}

			// Only append non group type into the returning data as we don't
			if($result[$i]['type'] != 'group'){
				if(!isset($group))
					$data['fields']['ungrouped'][]	= $result[$i];
				else
					$data['fields'][$group][]	= $result[$i];
			}
		}
		//$this->_dump($data);
		return $data;
  }
  public static function jomsocial_saveProfile($fbdata, $userId)
	{
		$document	= JFactory::getDocument();
		$mainframe	=& JFactory::getApplication();
		$values		= array();
		$profileType ="";
	    $profiles	= self::getEditableProfile( $userId,  $profileType);
        $date = new JDate($fbdata['dob']);
        $curdate = $date->toFormat('%Y-%m-%d %H:%M:%S');
        $fbdata['dob'] = $curdate;
	    if ($fbdata['gender'] == 'male') {
          $fbdata['gender'] = 'Male';
        }
        else if ($fbdata['gender'] == 'female') {
          $fbdata['gender'] = 'Female';
        }
		$fbdata = array ('','',$fbdata['gender'], $fbdata['dob'], $fbdata['aboutme'], '','', '', $fbdata['address'], $fbdata['state'], $fbdata['city'], $fbdata['country'], $fbdata['website'],'', $fbdata['college'], $fbdata['clg_year']);
		foreach( $profiles['fields'] as $group => $fields ) {
		  foreach( $fields as $data ) {
			$fieldValue	= new stdClass();
			$postData	= $fbdata[$data['id']];
			// Retrieve the privacy data for this particular field.
			$fieldValue->access	= JRequest::getInt( 'privacy' . $data['id'] , 0 , 'POST' );
			  $fieldValue->value =  $postData;
			$values[ $data['id'] ]	= $fieldValue;
         }
	   }
	   // Rebuild new $values with field code
       $valuesCode = array();
       foreach( $values as $key => $val ) {
         $fieldCode = self::getFieldCode($key);
		 if( $fieldCode ) {
			$valuesCode[$fieldCode] = $val->value;
		 }
	   }
       self::saveProfile($userId, $values);
   }

   public static function getFieldCode( $fieldId ) {
     $db  = JFactory::getDBO();
     $query	= 'SELECT ' . $db->nameQuote( 'fieldcode' ) . ' FROM '
				. $db->nameQuote( '#__community_fields' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'id' ) . '=' . $db->Quote( $fieldId );
     $db->setQuery( $query );
     $result = $db->loadResult();
     return $result; 
   }

   public static function saveProfile($userId, $fields) {
     jimport('joomla.utilities.date');
    $db  = JFactory::getDBO();
	 foreach($fields as $id => $value) {
       $table =& JTable::getInstance( 'FieldValue' , 'CTable' );
       if( !$table->load( $userId , $id ) ) {
         $table->user_id	= $userId;
         $table->field_id = $id;
       }
       if (is_object($value)) {
         $table->value = $value->value;
         $table->access = $value->access;
       }
       if (is_string($value)) {
         $table->value = $value;
       }
       $table->store();
     }
   }
   
/* ===============================End jom social code ================================================*/
}
