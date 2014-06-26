<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewMygallery extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
            $app = JFactory::getApplication();
            
            if(JFactory::getUser()->guest){
                $app->redirect('/index.php?option=com_opencart&route=account/login');
            }
            
            $user = JFactory::getUser();    
                
            $images =& $this -> get('Artworks');
            
            $this->assignRef('images', $images);
            $this->assignRef('user', $user);
            
            if(count($this -> images)>0){
                if(!JRequest::getVar('artwork_id')){
                    $var_artwork_id = $images[0] -> artwork_id;
                }else{
                    $var_artwork_id = JRequest::getVar('artwork_id');
                }

                $this->assignRef('var_artwork_id', $var_artwork_id);
                $artmodel =& $this ->getModel('Mygallery');
                $artimages = $artmodel -> getArtworkImages($var_artwork_id);
                $artwork = $artmodel -> getArtwork($var_artwork_id);

                $this->assignRef('artimages', $artimages);
                $this->assignRef('artwork', $artwork);

                $categories =& $this -> get('Options');
                $this->assignRef('categories', $categories);

                foreach($categories as $cate){
                    if($artwork -> category_id == $cate -> category_id){
                        $category = $cate -> name;
                    }
                }

                $this->assignRef('cate_name', $category);

                switch ($artwork -> status) {
                    case 0:
                        $status = "Pending";
                        break;
                    case 1:
                        $status = "Published";
                        break;
                    case 2:
                        $status = "Disabled";
                        break;
                }
                $this->assignRef('status', $status);
            }
            
            // Display the view
            parent::display($tpl);
        }
}
?>