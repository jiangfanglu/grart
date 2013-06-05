<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
  
class ControllerModuleStore extends Controller {
	protected function index() {
		$status = true;
		
		if ($this->config->get('store_admin')) {
			$this->load->library('user');
		
			$this->user = new User($this->registry);
			
			$status = $this->user->isLogged();
		}
		
		if ($status) {
			$this->language->load('module/store');
			
			$this->data['heading_title'] = $this->language->get('heading_title');
			
			$this->data['text_store'] = $this->language->get('text_store');
			
			$this->data['store_id'] = $this->config->get('config_store_id');
			
			$this->data['stores'] = array();
			
			$this->data['stores'][] = array(
				'store_id' => 0,
				'name'     => $this->language->get('text_default'),
				'url'      => HTTP_SERVER . 'index.php?option=com_opencart&'.ITEM_ID.'route=common/home'
			);
			
			$this->load->model('setting/store');
			
			$results = $this->model_setting_store->getStores();
			
			foreach ($results as $result) {
				$this->data['stores'][] = array(
					'store_id' => $result['store_id'],
					'name'     => $result['name'],
					'url'      => $result['url'] . 'index.php?option=com_opencart&'.ITEM_ID.'route=common/home'
				);
			}
	
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/store.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/store.tpl';
			} else {
				$this->template = 'default/template/module/store.tpl';
			}
			$mod_var_name=basename(	__FILE__,".php")."_mod_data";
			$this->data['template_dir'] = $this->template;
			global $$mod_var_name;
			$$mod_var_name = $this->data;
			$this->render();			
		}
	}
}
?>