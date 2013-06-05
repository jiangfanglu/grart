<?php
defined('_JEXEC') or die('Restricted access');
class SitemainModelArtist_products extends JModelItem
{
    function getGrartConfig($key=null){
        $db = JFactory::getDbo();
        $query = $db ->getQuery(true);
        $query = "select gc.value from #__grart_config gc
                    where gc.key = '".$key."'";
        $db ->setQuery($query);
        $config_value = $db ->loadObject();
        return $config_value -> value;
    }
    function getBalance(){
        $receivable = $this->getSalesTotal()* (floatval($this->getGrartConfig('COMMISION_RATE'))) - $this->getTotalPayment();
        return $receivable;
    }
    
    function getProductsSales(){
        $db = JFactory::getDbo();
        $query = $db ->getQuery(true); 
        $query = "select ari.artwork_id, oo.order_status_id ,filename, ap.product_id, sum(quantity) as total_sales_number, 
                price*quantity as sales_total_amount, title
                from oc_order oo
                right join oc_order_product op on op.order_id = oo.order_id
                right join #__artwork_publish ap on ap.product_id = op.product_id
                right join #__artwork_info ai on ai.id = ap.artwork_id 
                right join #__artwork_images ari on ai.id = ari.artwork_id
                where oo.order_status_id = 5 and ai.user_id = ".$this->getUserId()." and ap.status = ".$this->getGrartConfig('ARTWORK_PUBLISH_STATUS_PUBLISHED')." and ari.hero = 1
                group by ap.product_id;";
        $db ->setQuery($query);
        $products = $db ->loadObjectList();
        return $products;
    }
    
    
    
    
    function getSalesTotal(){
        $db = JFactory::getDbo();
        $query = $db ->getQuery(true);        
        $query = "select quantity, price, op.order_id, oo.date_added
                    from oc_order oo
                    right join oc_order_product op on op.order_id = oo.order_id
                    right join #__artwork_publish ap on ap.product_id = op.product_id
                    right join #__artwork_info ai on ai.id = ap.artwork_id
                    where user_id = ".$this->getUserId()." and ap.status=".$this->getGrartConfig('ARTWORK_PUBLISH_STATUS_PUBLISHED');;
        $db ->setQuery($query);
        $orders = $db ->loadObjectList();
        $sales_total = 0;
        foreach($orders as $o){
            $sales_total += $o->quantity * $o->price;
        }
        return $sales_total;
    }
    function getTotalPayment(){
        $db = JFactory::getDbo();
        $query = $db ->getQuery(true);
        $query = "select sum(payment_amount) as total_payment
                    from #__artist_payment
                    where user_id = ".$this->getUserId();
        $db ->setQuery($query);
        $total_amount = $db ->loadObject();
        if($total_amount -> total_payment == null){
            return 0;
        }else{
            return $total_amount -> total_payment;
        }
    }
    function getUserId(){
        $user = JFactory::getUser();
        return (string)$user->id;
    }
}
?>
