<?php
/**
 * @package	mod_facebookall_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$params->def('greeting', 1);

$type	= modFacebookallLoginHelper::getType();
$return	= modFacebookallLoginHelper::getReturnURL($params, $type);
$fball_settings = modFacebookallLoginHelper::facebookall_getsettings();
$user	= JFactory::getUser();

require JModuleHelper::getLayoutPath('mod_facebookall_login', $params->get('layout', 'default'));
