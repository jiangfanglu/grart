<?php


defined('_JEXEC') or die('Restricted access');

class GrartController extends JControllerLegacy
{
    public function addArtworkToProducts(){
        $model =& $this ->getModel('Artworkstoproducts');
        $data = array();
        $option_values = $model-> getOptionValue();

        for($i=0;$i<count($_POST['select_artworks']);$i++){
            $artwork = $model-> getArtworkInfo($_POST['select_artworks'][$i]);
            $artwork_images = $model-> getProductImages($_POST['select_artworks'][$i]);
            $artwork_image_hero = $model-> getProductImageHero($_POST['select_artworks'][$i]);
            $tags = $model-> getArtworkTags($_POST['select_artworks'][$i]);
            $a_tags = "";
            $n=0;
            foreach($tags as $t){
                if($n<(count($tags)-1)){
                    $a_tags = $a_tags.$t->tag_name.",";
                }else{
                    $a_tags = $a_tags.$t->tag_name;
                }
                $n++;
            }
            
            echo $a_tags.'<br/>';
            $data[$i] = array(
                'artwork_info' => $artwork,
                'artwork_images' => $artwork_images,
                'artwork_image_hero'=>$artwork_image_hero,
                'option_values' => $option_values,
                'tags' => $a_tags
            );
       }
        $model -> addProduct($data);
        JFactory::getApplication() ->redirect(JUri::base().'index.php?option=com_grart&view=artworkstoproducts');
    }
    
    public function sendEmails(){
        $fileTemp = $_FILES['template']['tmp_name'];
        $fileName = (string)time()."_".$_FILES['template']['name'];
        $uploadPath = JPATH_ADMINISTRATOR.DS.'newsletters'.DS.$fileName;

        if(!JFile::upload($fileTemp, $uploadPath)) 
        {
                echo JText::_( 'ERROR MOVING FILE' );
                return;
        }else{
            $email_body = file_get_contents($uploadPath);
            $model_ns =& $this ->getModel('Newsletter');
            $subcribers = $model_ns -> getUserEmails(JRequest::getVar('user_group'));
            $config =& JFactory::getConfig();
            $sender = array( 
                $config->get('mailfrom'),
                $config->get( 'fromname' ) );
            
            $mailer = JFactory::getMailer();
            $mailer->setSender($sender);
            $mailer->isHTML(true);
            $mailer->Encoding = 'base64';
            $mailer->setSubject(JRequest::getVar('subject'));
            
            foreach($subcribers as $subcriber){
                $recipient = $subcriber -> email;
                $mailer->addRecipient($recipient);
                $body = str_replace('[field:name]', $subcriber -> name, $email_body);
                $mailer->setBody($body);
                try{
                    $mailer->Send();
                }catch(Exception $e){
                    echo $e->getMessage();
                }
            }
            echo "OK";
        }
    }
}