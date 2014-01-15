<?php
/**
* @package 		Facebook All
* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.
* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt
* @author		sourceaddons
* @download URL	http://www.sourceaddons.com
*/


defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');
jimport ('joomla.application.component.modellist');

/**
 * Facebook All Model.
 */
class FacebookAllModelFacebookAll extends JModelList
{
	/**
	 * Save Settings.
	 */
	public function saveSettings ()
	{
		//Get database handle
		$db = $this->getDbo ();
		$api_settings = array();
        $mainframe = JFactory::getApplication();
		//Read Settings
		$settings = JRequest::getVar ('settings');
		$settings['apikey'] = trim($settings['apikey']);
		$settings['apisecret'] = trim($settings['apisecret']);
        if (empty($settings['apikey']) OR empty($settings['apisecret'])) {
		  JError::raiseWarning ('', JText::_ ('COM_FACEBOOKALL_APIKEY_ERROR'));
		  $mainframe->redirect (JRoute::_ ('index.php?option=com_facebookall&view=facebookall&layout=default', false));
		}
		else {
		  $sql = "DELETE FROM #__facebookall_settings";
		  $db->setQuery ($sql);
		  $db->query ();
          //Insert new settings
		  foreach ($settings as $k => $v)
		  {
			echo $sql = "INSERT INTO #__facebookall_settings ( setting, value )" . " VALUES ( " . $db->Quote ($k) . ", " . $db->Quote ($v) . " )";
			$db->setQuery ($sql);
			$db->query ();
		  }
		}
	 }

	/**
	 * Read Settings
	 */
	public function getSettings ()
	{
		$settings = array ();
        $db = $this->getDbo ();
        $sql = "SELECT * FROM #__facebookall_settings";
		$db->setQuery ($sql);
		$rows = $db->LoadAssocList ();

		if (is_array ($rows))
		{
			foreach ($rows AS $key => $data)
			{
				$settings [$data['setting']] = $data ['value'];
				
			}
		}

		return $settings;
	}

 }