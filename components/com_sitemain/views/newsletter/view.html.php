<?php

/*News Ltter*/
defined('_JEXEC') or die('Restricted access');

class SitemainViewNewsletter extends JViewLegacy{
    function display($tpl = null){
        $user = JFactory::getUser();
        $model =& $this->getModel('Newsletter');
        if($user->guest){
            $categories = $model -> getCategories(0);
        }else{
            $categories = $model -> getCategories(1);
        }
        $this ->assignRef('categories', $categories);
        
        $subscribed = $this -> checkIfSubscribed();
        $this ->assignRef('subscribed', $subscribed);
        parent::display($tpl);
    }
    
    function checkIfSubscribed(){
        $user = JFactory::getUser();
        $model =& $this->getModel('Newsletter');
        if($user->guest){
            if($_POST['newsletter_email']!='' && $_POST['newsletter_email']!='example@example.com'){
                $na_status = $model -> checkIfSubscribed($_POST['newsletter_email']);
            }else if(isset($_SESSION['ns_subscribed']) && $_SESSION['ns_subscribed'] == true){
                $na_status = true;
            }else{
                $na_status = false;
            }
        }else{
            $na_status = $model -> checkIfSubscribed($model->getUserEmail($user->id));
        }
        return $na_status;
    }
}
?>
