<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!class_exists("Template")){
class Template {
		public $data = array();
		
		public function fetch($filename) {
			$file = DIR_TEMPLATE . $filename;
		
			if (file_exists($file)) {
				extract($this->data);
				
				ob_start();
		  
				include($file);
		  
				$content = ob_get_contents();
	
				ob_end_clean();
	
				return $content;
			} else {
				trigger_error('Error: Could not load template ' . $file . '!');
				exit();
			}	
		}
	}
}
?>