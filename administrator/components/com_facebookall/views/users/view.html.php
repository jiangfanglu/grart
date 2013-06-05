<?php

/**

* @package 		Facebook All

* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.

* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt

* @author		sourceaddons

* @download URL	http://www.sourceaddons.com

*/



 

// no direct access

 

defined( '_JEXEC' ) or die( 'Restricted access' );

 

jimport( 'joomla.application.component.view');

 

class FacebookAllViewusers extends JViewLegacy

{

    function display($tpl = null)

    { 

		JToolBarHelper::title( JText::_( 'Facebook All Connected Users' ),'users' );



		$lists['search']=  JRequest::getVar( "search");

		// Get data from the model

		$items =& $this->get('Data');	

		$pagination =& $this->get('Pagination');

		$totalcusers = $this->get('Total');

		$this->state = $this->get('State');

 		// push data into the template

		$this->assignRef('items', $items);	

		$this->assignRef('pagination', $pagination);

		$this->assignRef('delete', $pagination);

		$this->assignRef('lists',	$lists);

		$this->assignRef('totalcusers', $totalcusers);

		parent::display($tpl);

    }

}

