<?php

/**

* @package 		Facebook All

* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.

* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt

* @author		sourceaddons

* @download URL	http://www.sourceaddons.com

*/



// no direct access

defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

class FacebookAllViewmainpanel extends JViewLegacy

{

       

    function display($tpl = null)

    {

	    $document = &JFactory::getDocument ();

		$document->addStyleSheet ('components/com_facebookall/assets/css/facebookall.css');

	    JToolBarHelper::title( JText::_( 'COM_FACEBOOKALL_OVERVIEW' ), 'fbmainpanel');

	    $this->form = $this->get ('Form');

        $app_settings = $this->app_getSettings ();

		$app_settings['apikey'] = (!empty($app_settings['apikey']) ? $app_settings['apikey'] : "");
		
		$url = "https://graph.facebook.com/".$app_settings['apikey'];

         if (function_exists('curl_init')) {

            //curl is the preferred function

		   $url = "https://graph.facebook.com/".$app_settings['apikey'];

           $curl = curl_init();

	       curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

	       curl_setopt( $curl, CURLOPT_URL, $url );

	       curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );

           $app_result = curl_exec( $curl );

           curl_close( $curl );

           $app_result = json_decode($app_result);

		 }
		 else {
		 
		   $app_result = @file_get_contents($url);
		   $app_result = json_decode($app_result);
		 
		 }
           //pass on the variables to the view

        $this->assignRef('app_result', $app_result);

        parent::display($tpl);

    }

	

	/**

	 * Read Settings

	 */

   function app_getSettings ()

	{

		$settings = array ();

        $db = &JFactory::getDBO();

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

