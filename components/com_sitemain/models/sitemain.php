<?php

defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 */
class SitemainModelSitemain extends JModelItem
{
    public $DB_PREFIX = 'oc_';
    
    public function getFeatured(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT * FROM #__content a
                inner join #__content_frontpage fp
                on a.id = fp.content_id
                order by fp.ordering desc;";
        $db->setQuery((string)$query);
        $featured = $db->loadObjectList();
        return $featured;
    }
    
    public function getFeaturedArtworks(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select count(*) as categoryitem_count ,product_id,  af.order, artwork_image_id,category_id, artwork_id, user_id, filename from  
                 (select product_id, iaf.order, artwork_image_id, category_id , ai.id, artwork_id, user_id, filename
                from #__artwork_featured as iaf 
                inner join #__artwork_images as ai 
                on iaf.artwork_image_id = ai.id 
                order by iaf.order desc) as af 
                group by category_id";
        $db->setQuery((string)$query);
        $fartworks = $db->loadObjectList();
	return $fartworks;
    }
    
    public function getCategories($parent_id = 0) {
	$db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT cd.category_id, cd.name 
                FROM oc_category c 
                LEFT JOIN oc_category_description cd 
                ON (c.category_id = cd.category_id) 
                LEFT JOIN oc_category_to_store c2s 
                ON (c.category_id = c2s.category_id) 
                WHERE c.parent_id = ".(string)$parent_id." AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name) limit 8";
        $db->setQuery((string)$query);
        $categories = $db->loadObjectList();
	return $categories;
        
    }
    
    //need modify, no popular machenism yet
    public function getPopularArtists(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__artist at');
        $query->join('inner','#__users u on u.id = at.user_id');
        $db->setQuery((string)$query,0,8);
        $artists = $db->loadObjectList();
        return $artists;
    }
    
    
}
?>
