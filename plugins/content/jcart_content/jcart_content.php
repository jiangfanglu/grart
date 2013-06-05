<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
class plgContentJoocart_Content extends JPlugin
{	
	public function onPrepareContent( &$row, &$params, $page=0 )
	{
		$this->onContentPrepare('',$row, $params, $page);
	}
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Simple performance check to determine whether article should process further.
		if (JString::strpos($article->text, 'jcart product_id') === false) {
			return true;
		}
		if(file_exists(JPATH_SITE."/components/com_opencart/index_mod.php")){		
			// Define the regular expression for the product_id.
			$regex = "#\[jcart product_id=(\d+)\]#";
		
			// Perform the replacement.
			preg_match_all($regex, $article->text,$matches);
			if(count($matches[1])){
				require_once(JPATH_SITE."/components/com_opencart/index_mod.php");
				//load product model
				$model_prod='catalog/product';
				$file_prod  = DIR_APPLICATION . 'model/' . $model_prod . '.php';
				$class_prod = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $model_prod);
				
				if (file_exists($file_prod)) {
					include_once($file_prod);					
					$model_catalog_product= new $class_prod($registry);
				}
				//load tool image model
				$model_image='tool/image';
				$file_image  = DIR_APPLICATION . 'model/' . $model_image . '.php';
				$class_image = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $model_image);
				
				if (file_exists($file_image)) {
					include_once($file_image);					
					$model_tool_image= new $class_image($registry);
				}
				
				
				//load lanugage
				$language->load('product/product');
				
				$url = $registry->get('url');	
				$config=$registry->get('config');
				$currency=$registry->get('currency');
				$tax=$registry->get('tax');
				$customer=$registry->get('customer');
				//$url_jcart->addRewrite($seo_url);
				foreach($matches[1] as $i=>$product_id){
					
					 
					$product_info = $model_catalog_product->getProduct($product_id);
					
					if ($this->params->get('showProductImagePlugin')) {
						$product_data['thumb'] = $model_tool_image->resize($product_info['image'], $this->params->get('imgWidthPlguin'), $this->params->get('imgHeightPlguin'));
					} else {
						$product_data['thumb'] = '';
					}					
					$product_data['heading_title'] = $product_info['name'];
					$product_data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
					$product_data['review_status'] = $config->get('config_review_status');
					$product_data['reviews'] = sprintf($language->get('text_reviews'), (int)$product_info['reviews']);
					$product_data['rating'] = (int)$product_info['rating'];
					$product_data['button_cart'] = $language->get('button_cart');					
					$product_data['text_price'] = $language->get('text_price');
					$product_data['prod_url']=$url->link('product/product', 'product_id=' . $product_id);
					if (($config->get('config_customer_price') && $customer->isLogged()) || !$config->get('config_customer_price')) {
						$product_data['price'] = $currency->format($tax->calculate($product_info['price'], $product_info['tax_class_id'], $config->get('config_tax')));
					} else {
						$product_data['price'] = false;
					}
								
					if ((float)$product_info['special']) {
						$product_data['special'] = $currency->format($tax->calculate($product_info['special'], $product_info['tax_class_id'], $config->get('config_tax')));
					} else {
						$product_data['special'] = false;
					}
					ob_start();
					extract($product_data);
					require(dirname(__FILE__)."/product.tpl");
					$output_product=ob_get_contents();
					ob_end_clean();				
					
					$article->text=str_replace($matches[0][$i],$output_product,$article->text);
					if(!strstr($article->text,'<div id="notification"></div>'))
					$article->text='<div id="notification"></div>'.$article->text;
				}
			}
		}	
		return true;
	}
}
?>