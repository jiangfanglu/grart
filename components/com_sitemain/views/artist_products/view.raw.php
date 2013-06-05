<?php

/*News Ltter*/
defined('_JEXEC') or die('Restricted access');

class SitemainViewArtist_products extends JViewLegacy{
    function display($tpl = null){
        $user = JFactory::getUser();
        
        $total_payment =& $this -> get('TotalPayment');
        $this ->assignRef('total_payment', $total_payment);
        
        $salesTotal =& $this -> get('SalesTotal');
        $this ->assignRef('salesTotal', $salesTotal);
        
        $balance =& $this -> get('Balance');
        $this ->assignRef('balance', $balance);
        
        $products =& $this -> get('ProductsSales');
        $this ->assignRef('products', $products);
        $this ->assignRef('user', $user);
        parent::display($tpl);
    }
}
?>
