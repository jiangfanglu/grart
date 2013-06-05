<?php
/**
* @package 		Facebook All
* @copyright	Copyright (C)  - http://www.sourceaddons.com. All rights reserved.
* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt
* @author		sourceaddons
* @download URL	http://www.sourceaddons.com
*/

// No direct access
defined('_JEXEC') or die;
class facebookallHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	$vName	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{
		
		JSubMenuHelper::addEntry(
			JText::_('COM_FACEBOOKALL_MAINPANEL'),
			'index.php?option=com_facebookall&view=mainpanel',
			$vName == 'mainpanel'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_FACEBOOKALL_CONFIG'),
			'index.php?option=com_facebookall&view=facebookall',
			$vName == 'configuration'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_FACEBOOKALL_CONNECTED_USERS'),
			'index.php?option=com_facebookall&view=users',
			$vName == 'connectedusers'
		);
	}
}
