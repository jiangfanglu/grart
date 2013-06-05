<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerCommonMaintenance extends Controller {
    public function index() {
        if ($this->config->get('config_maintenance')) {
			$route = '';
			
			if (isset($this->request->get['route'])) {
				$part = explode('/', $this->request->get['route']);
				
				if (isset($part[0])) {
					$route .= $part[0];
				}			
			}
			
			// Show site if logged in as admin
			$this->load->library('user');
			
			$this->user = new User($this->registry);
			//Mainatance code change start
			jimport("joomla.user.helper");
			$joomla_user= JFactory::getUser();
			$allow_user="no";
			if($joomla_user->get('id')>0)
			{
				$JConfig = new JConfig();
				global $joomla_db;
				$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where id= '".$joomla_user->get('id')."'");
				$user_type=$result->row["usertype"];
				if($user_type=="deprecated" || $user_type=="Super Administrator" || $user_type=="Administrator" || $user_type=="Manager"){
					$allow_user="yes";
				}
			}
			if (($route != 'payment') && !$this->user->isLogged() && $allow_user!="yes") {
				return $this->forward('common/maintenance/info');
			}	
			//	Maintance code change stop				
        }
    }
		
	public function info() {
        $this->load->language('common/maintenance');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->data['heading_title'] = $this->language->get('heading_title');
                
        $this->document->breadcrumbs = array();

        $this->document->breadcrumbs[] = array(
            'text'      => $this->language->get('text_maintenance'),
			'href'      => $this->url->link('common/maintenance'),
            'separator' => false
        ); 
        
        $this->data['message'] = $this->language->get('text_message');
      
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/maintenance.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/common/maintenance.tpl';
        } else {
            $this->template = 'default/template/common/maintenance.tpl';
        }
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
		
		$this->response->setOutput($this->render());
    }
}
?>