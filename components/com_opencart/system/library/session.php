<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class Session {
	public $data = array();
			
  	public function __construct() {		
		if (!session_id()) {
			@ini_set('session.use_cookies', 'On');
			@ini_set('session.use_trans_sid', 'Off');
			
			@session_set_cookie_params(0, '/');
			@session_start();
		}
	
		$this->data =& $_SESSION;
	}
}
?>