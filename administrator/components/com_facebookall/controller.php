<?php

/**

* @package 		Facebook All

* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.

* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt

* @author		sourceaddons

* @download URL	http://www.sourceaddons.com

*/



defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');

jimport ('joomla.application.component.controller');



/**

 * Controller of FacebookAll component.

 */

class FacebookAllController extends JControllerLegacy

{

	

	public function display() {

	

			require_once JPATH_COMPONENT.'/helpers/facebookall.php';

			facebookallHelper::addSubmenu(JRequest::getCmd('view', 'facebookall'));



			switch (JRequest::getVar( 'view' )){

				case "facebookall":

							JRequest::setVar('view', 'facebookall' );

							break;

				case "users":

							JRequest::setVar('view', 'users' );

							break;

				default:

							JRequest::setVar('view', 'mainpanel' );

			}



			parent::display();

	}



	/**

	 * Save settings

	 */

	public function apply ()

	{

	    $mainframe = JFactory::getApplication();

		$model = &$this->getModel ();

		$model->saveSettings ();

		$mainframe->enqueueMessage (JText::_ ('COM_FACEBOOKALL_SETTING_SAVED'));

		$this->setRedirect (JRoute::_ ('index.php?option=com_facebookall&view=facebookall&layout=default', false));

	}

	

	/**

	 * Save and close settings

	 */

	public function save()

	{  

	    $mainframe = JFactory::getApplication();

		$model = &$this->getModel();

		$model->saveSettings ();

		$mainframe->enqueueMessage (JText::_ ('COM_FACEBOOKALL_SETTING_SAVED'));	

        $this->setRedirect (JRoute::_ ('index.php', false));

	}

	

	/**

	 * cancel settings

	 */

	public function cancel ()

	{

		$this->setRedirect (JRoute::_ ('index.php', false));

	}



}

