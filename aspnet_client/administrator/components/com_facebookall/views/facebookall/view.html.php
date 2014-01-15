<?php

/**

* @package 		Facebook All

* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.

* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt

* @author		sourceaddons

* @download URL	http://www.sourceaddons.com

*/



defined ('_JEXEC') or die ('Restricted access');

jimport ('joomla.application.component.view');



/**

 * Class generate view.

 */

class FacebookAllViewFacebookAll extends JViewLegacy

{

	public $settings;

	

	/**

	 * Facebook All - Display administration area

	 */

	public function display ($tpl = null)

	{

		$document = &JFactory::getDocument ();

		$document->addStyleSheet ('components/com_facebookall/assets/css/facebookall.css');
		$document->addScript ('components/com_facebookall/assets/js/makeapi_request.js');

		$model = &$this->getModel ();

		$this->settings = $model->getSettings ();

     	$this->form = $this->get ('Form');

		$this->addToolbar ();

        parent::display ($tpl);

	}



	

	/**

	 * Facebook All - Add admin option on toolbar

	 */

	protected function addToolbar ()

	{

		JRequest::setVar ('hidemainmenu', false);

		JToolBarHelper::title (JText::_ ('COM_FACEBOOKALL_CONFIG_TITLE'), 'configuration.gif');

		JToolBarHelper::apply ('apply');

		JToolBarHelper::save($task = 'save', $alt = 'JTOOLBAR_SAVE');

		JToolBarHelper::cancel ('cancel');

	}

}