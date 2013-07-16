<?php
defined('_JEXEC') or die('Restricted access');

class SitemainModelArticles extends JModelItem
{
    public function getArticleItem($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__content
                  where id = ".(string)$id;
        $db->setQuery($query);
        $article = $db->loadObject();
        
        return $article;
    }
    
    public function getProductCategories($parent_id = 0) {
	$db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT cd.category_id, cd.name 
                FROM oc_category c 
                LEFT JOIN oc_category_description cd 
                ON (c.category_id = cd.category_id) 
                LEFT JOIN oc_category_to_store c2s 
                ON (c.category_id = c2s.category_id) 
                WHERE c.parent_id = ".(string)$parent_id." AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)";
        $db->setQuery((string)$query);
        $categories = $db->loadObjectList();
	return $categories;
        
    }
    
    public function getCategories(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select cc.id as article_id, catid, cc.title as article_title 
                    from #__categories as c 
                    inner join #__content as cc
                    on cc.catid = c.id
                    where parent_id = 1 and c.published = 1";
        $db->setQuery($query);
        $articles = $db->loadObjectList();
        
        $query = $db->getQuery(true);
        $query = "select DISTINCT catid, c.title as category_title 
                    from #__categories as c 
                    inner join #__content as cc
                    on cc.catid = c.id
                    where parent_id = 1 and c.published = 1";
        $db->setQuery($query);
        $categories = $db->loadObjectList();
        
        $cates =array();
        $x=0;
        foreach($categories as $c){
            $cates[$x] = array(
                'category_id' => $c -> catid,
                'category_name' => $c -> category_title,
                'cate_articles' => array()
            );
            $y=0;
            foreach($articles as $a){
                if($a -> catid == $c -> catid){
                    $cates[$x]['cate_articles'][$y] = array(
                        'category_id' => $a -> catid,
                        'article_id' => $a -> article_id,
                        'article_name' => $a -> article_title
                    );
                    $y++;
                }
            }
            $x++;
        }
        
        return $cates;
        
    }
}
?>
