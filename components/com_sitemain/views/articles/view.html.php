<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewArticles extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {

            $model =& $this ->getModel('Articles');
            $categories = $model -> getCategories();

            $this ->assignRef('categories', $categories);
            
            if(!isset($_GET['a_id']) || !isset($_GET['c_id'])){
                $article = $model -> getArticleItem($categories[0]['cate_articles'][0]['article_id']);
                $_GET['a_id'] = $categories[0]['cate_articles'][0]['article_id'];
                $_GET['c_id'] = $categories[0]['category_id'];
            }else{
                $article = $model -> getArticleItem($_GET['a_id']);
            }
            $this ->assignRef('article', $article);
            
            $product_categories = $model -> getProductCategories(0);
            $this ->assignRef('product_categories', $product_categories);
            parent::display($tpl);
        }
}
?>
