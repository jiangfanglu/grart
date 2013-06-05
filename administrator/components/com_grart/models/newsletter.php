<?php

defined('_JEXEC') or die('Restricted access');

class GrartModelNewsletter extends JModelItem
{
    public function getSubscriptionCategories(){
        $db = JFactory::getDbo();
        $query = "select * from #__newsletter_category";
        $db->setQuery($query);
        $categories = $db->loadObjectList();
        return $categories;
    }
    
    public function getUserEmails($category_id){
        $db = JFactory::getDbo();
        $query = "select email, name from #__newsletter_subscription ns 
            inner join #__newsletter_category_subscription ncs on ns.id = ncs.ns_id 
            where subscribed = 1 and ns_category_id = ".$category_id;
        $db->setQuery($query);
        $emails = $db->loadObjectList();
        return $emails;
    }
    
}

?>
