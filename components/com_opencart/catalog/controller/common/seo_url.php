<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		if((isset($this->request->get['route']) && $this->request->get['route']!="common/home") || (isset($this->request->get['_route_']) && trim($this->request->get['_route_'])=="") || (isset($this->request->get['_route_']) && $this->request->get['_route_']=="/"))
		unset($this->request->get['_route_']);
		
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}
		
		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);
			
			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
				
				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);
					
					if ($url[0] == 'product_id') {
						$this->request->get['product_id'] = $url[1];
					}
					
					if ($url[0] == 'category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} elseif(!in_array($url[1],explode("_",$this->request->get['path']))) {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}	
					
					if ($url[0] == 'manufacturer_id') {
						$this->request->get['manufacturer_id'] = $url[1];
					}
					
					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}	
				} 
				elseif(strstr($part,"-")){
					$alias_parts=explode("-",$part);
					if($alias_parts[0]=="p")
						$this->request->get['product_id']=$alias_parts[1];
					elseif($alias_parts[0]=="m")
						$this->request->get['manufacturer_id']=$alias_parts[1];
					elseif($alias_parts[0]=="i")
						$this->request->get['information_id']=$alias_parts[1];
					elseif($alias_parts[0]=="c"){
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $alias_parts[1];
						} elseif(!in_array($alias_parts[1],explode("_",$this->request->get['path']))) {
							$this->request->get['path'] .= '_' . $alias_parts[1];
						}
					}
						
				}
			}
			
			
			if (isset($this->request->get['product_id'])) {
				$this->request->get['route'] = 'product/product';
			} elseif (isset($this->request->get['path'])) {
				$this->request->get['route'] = 'product/category';
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$this->request->get['route'] = 'product/manufacturer/info';
			} elseif (isset($this->request->get['information_id'])) {
				$this->request->get['route'] = 'information/information';
			}
			
			
			if((!isset($this->request->get['route']) || trim($this->request->get['route'])==""  || $this->request->get['route']=="common/home") && isset($this->request->get['_route_'])){
				$routes_predefined = array(
							'product'=>'product/product',
							'information'=>'information/information',
							'contact'=>'information/contact',
							'sitemap'=>'information/sitemap',
							'account'=>'account/account',
							'checkout'=>'checkout/checkout',
							'category'=>'product/category',
							'manufacturer'=>'product/manufacturer',
							'home'=>'common/home',
							'cart'=>'checkout/cart',
							);
				$routes_predefined_flip = array_flip($routes_predefined);				
				if(in_array($this->request->get['_route_'],$routes_predefined_flip))
					$this->request->get['route'] = $routes_predefined[$this->request->get['_route_']];	
				else
					$this->request->get['route'] = $this->request->get['_route_'];	
				
				
			}
			
			if (isset($this->request->get['route'])) {
				return $this->forward($this->request->get['route']);
			}
		}
	}
	
	public function rewrite($link) {
		
		if($this->config->get('config_seo_url')&& !strstr($link,"tmpl=component")) {
			$url_data = parse_url(str_replace('&amp;', '&', $link));
		
			if(defined("SHOP_SEO_KEY"))
				$url = '/'.SHOP_SEO_KEY;
			else
				$url = '/shop';
			
			$data = array();
			
			parse_str($url_data['query'], $data);
			
			foreach ($data as $key => $value) {
				if (isset($data['route'])) {
					if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
					
						if ($query->num_rows) {
							$url .= '/' . $query->row['keyword'];
							
							unset($data[$key]);
						}
						else{
							$prefix_url=substr($key,0,1);
							
							if($prefix_url=="p")
								$url_alias = $this->_get_product($value);
							elseif($prefix_url=="m")
								$url_alias = $this->_get_manufacturer($value);
							elseif($prefix_url=="i")
								$url_alias = $this->_get_information($value);
							if($url_alias!=""){
								$url .= '/' .$prefix_url.'-'.$value.'-'.$url_alias;
								unset($data[$key]);
							}
						}					
					} elseif ($key == 'path') {
						$categories = explode('_', $value);
						
						$count_categories=0;
						foreach ($categories as $category) {
							$count_categories=$count_categories+1;
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
					
							if ($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
								if(count($categories)==$count_categories)
								unset($data[$key]);
							}
							else{
								$url_alias = $this->_get_category($category);
								$url .= '/c-'.$category.'-'.$url_alias;
								unset($data[$key]);
							}							
						}						
					}
					
				}
			}
			$routes_predefined = array(
								'product'=>'product/product',
								'information'=>'information/information',
								'contact'=>'information/contact',
								'sitemap'=>'information/sitemap',
								'account'=>'account/account',
								'checkout'=>'checkout/checkout',
								'category'=>'product/category',
								'manufacturer'=>'product/manufacturer',
								'home'=>'common/home',
								'cart'=>'checkout/cart',								
								);
			$routes_predefined_flip = array_flip($routes_predefined);				
			if(isset($data['route']) && $url == '/'.SHOP_SEO_KEY){
				if(in_array($data['route'],$routes_predefined))
					$url .= '/' .$routes_predefined_flip[$data['route']];
				else
					$url .= '/' .$data['route'];
			}
			if ($url && $url != '/'.SHOP_SEO_KEY) {
				unset($data["option"]);
				unset($data["Itemid"]);
				unset($data['route']);
			
				$query = '';
				$query_joomla='';
				if ($data) {
					foreach ($data as $key => $value) {
						$query .= '&' . $key . '=' . $value;
					}
					$query_joomla=$query;
					if ($query) {
						$query = '?' . trim($query, '&');
					}
				}
				if(JFactory::getApplication()->getRouter()->getMode() && $this->config->get('config_seo_url')){
					if(defined("ITEMID"))
						$route_url = JRoute::_("index.php?option=com_opencart".$query_joomla."&".ITEM_ID."_route_=".str_replace('/'.SHOP_SEO_KEY.'/',"",$url));
					else
						$route_url = JRoute::_("index.php?option=com_opencart".$query_joomla."&_route_=".str_replace('/'.SHOP_SEO_KEY.'/',"",$url));
					
					if(!strstr($route_url,"http://") && !strstr($route_url,"https://")){
						return $url_data['scheme'] . '://' . $url_data['host'] . (isset($url_data['port']) ? ':' . $url_data['port'] : '') . $route_url;
					}
					else{
						return $route_url;
					}
				}
				else
					return $url_data['scheme'] . '://' . $url_data['host'] . (isset($url_data['port']) ? ':' . $url_data['port'] : '') . str_replace('/index.php', '', $url_data['path']) . $url . $query;
			} else {
				return $link;
			}
		} else {
			return $link;			
		}		
	}	
	
	private function _get_product($pid){
		$query = $this->db->query("
				SELECT p.product_id, pd.name, pc.category_id FROM " . DB_PREFIX . "product AS p 
				LEFT JOIN " . DB_PREFIX . "product_description AS pd ON pd.product_id = p.product_id 
				LEFT JOIN " . DB_PREFIX . "product_to_category AS pc ON pc.product_id = p.product_id
				WHERE pd.language_id = ".(int)$this->config->get('config_language_id')." AND p.status = 1 AND p.product_id=".(int)$pid);
				
		return $this->safe_name($query->row['name']);
			
		
	}

	private function _get_category($cid){
	
		$query = $this->db->query("
				SELECT c.category_id, c.parent_id, cd.name FROM " . DB_PREFIX . "category AS c 
				LEFT JOIN " . DB_PREFIX . "category_description AS cd ON cd.category_id = c.category_id 
				WHERE cd.category_id = c.category_id AND cd.language_id = ".(int)$this->config->get('config_language_id')." AND c.status = 1 AND c.category_id=".(int)$cid);
			return $this->safe_name($query->row['name']);			
	}


	private function _get_manufacturer($mid){
		$query = $this->db->query("SELECT manufacturer_id, name FROM " . DB_PREFIX . "manufacturer where  manufacturer_id=".(int)$mid);
		return $this->safe_name($query->row['name']);	
	}

	private function _get_information($iid){
	
		$query = $this->db->query("SELECT i.information_id, id.title FROM " . DB_PREFIX . "information AS i LEFT JOIN " . DB_PREFIX . "information_description AS id ON id.information_id = i.information_id WHERE id.information_id = i.information_id AND id.language_id = ".(int)$this->config->get('config_language_id')." AND i.status = 1 AND i.information_id=".(int)$iid);
		return $this->safe_name($query->row['title']);	
	}

	private function safe_name($name){
		jimport( 'joomla.filter.output' );		
		return JFilterOutput::stringURLSafe($name);
	}
	
	
}
?>