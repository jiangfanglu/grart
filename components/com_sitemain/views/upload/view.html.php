<?php

defined('_JEXEC') or die('Restricted access');

class SitemainViewUpload extends JViewLegacy
{
        
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $app = JFactory::getApplication();
            if(JFactory::getUser()->guest){
                $_SESSION['redirect_after_login'] = urldecode(JUri::base().'index.php?option=com_sitemain&view=upload');
                $app->redirect('/index.php?option=com_opencart&route=account/login');
            }
            
            $artist =& $this -> get('IfArtist');
            if(!$artist){
                $app->redirect('/index.php?option=com_sitemain&view=usermanager');
            }
            
            
            $categories =& $this -> get('Options');
            $this->assignRef('categories', $categories);
            
            // Display the view
            parent::display($tpl);
        }
}
//get the hosts name
jimport('joomla.environment.uri' );
$host = JURI::root();

//add the links to the external files into the head of the webpage (note the 'administrator' in the path, which is not nescessary if you are in the frontend)
$document =& JFactory::getDocument();
//$document->addScript($host.'components/com_sitemain/swfupload/swfupload.js');
//$document->addScript($host.'components/com_sitemain/swfupload/swfupload.queue.js');
//$document->addScript($host.'components/com_sitemain/swfupload/swfupload.swfobject.js');
//$document->addScript($host.'components/com_sitemain/swfupload/fileprogress.js');
//$document->addScript($host.'components/com_sitemain/swfupload/handlers.js');
//$document->addStyleSheet($host.'components/com_sitemain/swfupload/default.css');

//when we send the files for upload, we have to tell Joomla our session, or we will get logged out 
$session = & JFactory::getSession();

$user=JFactory::getUser();
$userID = $user->get('id');

$checkFormDataJs = "

function closeInfoAlert(){
    $('info_alert').style.display = 'none';
    return false;
}

function validateForm(){

    var f_title = $('title').value;
    var f_categoryid = $('category_id').value;
    var f_desc = $('desc').value;
    var f_meta_desc = $('meta_desc').value;
    var f_filedata = $('Filedata').value;
    var f_tags = $('tags').value;
    var patt1 = new RegExp(/[^a-zA-Z0-9\,\s]/);
    
    if(f_title == '' || f_categoryid == '0' || f_desc == '' || f_meta_desc == '' || f_filedata == '' || f_tags == ''){
        $('info_text').innerHTML = 'Fields can not be empy';
        
        $('info_alert').style.display = 'block';
        return false;
    }else if(f_meta_desc.length > 200){
        $('info_text').innerHTML = 'Meta Description can not be 200 and more.';
        
        $('info_alert').style.display = 'block';
        return false
    }else if(patt1.test(f_tags)){
        $('info_text').innerHTML = 'Ilegal character(s) enterred: Tags';
        
        $('info_alert').style.display = 'block';
        return false
    }else{
        if($('terms_conds').checked){
            $('btnSubmit').value = 'Uploading';
            $('btnSubmit').disabled = true;
            return true;
        }else{
            
            $('info_text').innerHTML = 'You have to agree and terms and conditions to upload a artwork';
            $('info_alert').style.display = 'block';
            return false;
        }
    }
    
}


    ";


$document->addScriptDeclaration($checkFormDataJs);  
?>