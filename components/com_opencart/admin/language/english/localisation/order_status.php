<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Heading
$_['heading_title']    = 'Order Status';

// Text
$_['text_success']     = 'Success: You have modified order statuses!';

// Column
$_['column_name']      = 'Order Status Name';
$_['column_action']    = 'Action';

// Entry
$_['entry_name']       = 'Order Status Name:';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify order statues!';
$_['error_name']       = 'Order Status Name must be between 3 and 32 characters!';
$_['error_default']    = 'Warning: This order status cannot be deleted as it is currently assigned as the default store order status!';
$_['error_download']   = 'Warning: This order status cannot be deleted as it is currently assigned as the default download status!';
$_['error_store']      = 'Warning: This order status cannot be deleted as it is currently assigned to %s stores!';
$_['error_order']      = 'Warning: This order status cannot be deleted as it is currently assigned to %s orders!';
?>