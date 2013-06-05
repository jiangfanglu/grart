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
}