<?php
defined('_JEXEC') or die('Restricted access'); 
class SitemainModelArtworkimage extends JModelItem
{
    function getArtwork($artwork_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('u.name, filename,title,description,meta_desc,category_id,ATI.user_id,ATIM.id as artwork_image_id,ap.artwork_id,ATI.status,width,height,product_id');
        $query->from('#__artwork_info AS ATI');
        $query->join('inner','#__artwork_images AS ATIM on ATI.id = ATIM.artwork_id');
        $query->join('left','#__artwork_publish AS ap on ATI.id = ap.artwork_id');
        $query->join('right','#__users AS u on ATI.user_id = u.id');
        $query->where('ap.artwork_id='.(string)$artwork_id);
        $db->setQuery((string)$query);
        $image = $db->loadObject();
        return $image;
    }
}
?>
