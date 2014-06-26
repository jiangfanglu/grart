<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
class ControllerModuleCarousel extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		//$this->document->addScript('catalog/view/javascript/jquery/jquery.jcarousel.min.js');
		$document_joomla = JFactory::getDocument();	
		if (file_exists('components/com_opencart/catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css')) {
			//$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css');
			$document_joomla->addStyleSheet('components/com_opencart/catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css');			
		} else {
			//$this->document->addStyle('catalog/view/theme/default/stylesheet/carousel.css');
			$document_joomla->addStyleSheet('components/com_opencart/catalog/view/theme/default/stylesheet/carousel.css');
		}
						
		$this->data['limit'] = $setting['limit'];
		$this->data['scroll'] = $setting['scroll'];
				
		$this->data['banners'] = array();
		
		$results = $this->model_design_banner->getBanner($setting['banner_id']);
		  
		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				$this->data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}
		
		$this->data['module_id'] = $module++; 
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/carousel.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/carousel.tpl';
		} else {
			$this->template = 'default/template/module/carousel.tpl';
		}
		
		$mod_var_name=basename(	__FILE__,".php")."_mod_data";
		$this->data['template_dir'] = $this->template;
		global $$mod_var_name;
		$$mod_var_name = $this->data;
		$this->render(); 
	}
}
?>