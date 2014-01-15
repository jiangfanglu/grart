<?php

defined('_JEXEC') or die('Restricted access');

class GrartViewNewsletter extends JViewLegacy
{
    public function display($tpl = null) {
        $categories =& $this->get('SubscriptionCategories');
        $this ->assignRef('categories', $categories);
        parent::display($tpl);
    }
}
?>
