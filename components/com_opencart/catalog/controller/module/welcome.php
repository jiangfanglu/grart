<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
class ControllerModuleWelcome extends Controller {
	protected function index($setting) {
		$this->language->load('module/welcome');
		
    	$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
    	
		$this->data['message'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/welcome.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/welcome.tpl';
		} else {
			$this->template = 'default/template/module/welcome.tpl';
		}
		$mod_var_name=basename(	__FILE__,".php")."_mod_data";
		$this->data['template_dir'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render();
	}
}
?>