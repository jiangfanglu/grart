<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if ( !function_exists('version_compare') || version_compare( phpversion(), '5', '<' ) )
	include_once( 'ckeditor_php4.php' ) ;
else
	include_once( 'ckeditor_php5.php' ) ;
