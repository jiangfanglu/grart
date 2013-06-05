<?php

defined('_JEXEC') or die('Restricted access');
 
class SitemainViewSitemain extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
                $artists =& $this -> get('PopularArtists');
                $categorieModel =& $this -> getModel('Sitemain');
                $categories = $categorieModel -> getCategories(0);
                $featured_articles =& $this -> get('Featured');
                $featured_artworks =& $this -> get('FeaturedArtworks');
                
                $this ->assignRef('artists', $artists);
                $this ->assignRef('categories', $categories);
                $this ->assignRef('featured_articles', $featured_articles);
                $this ->assignRef('featured_artworks', $featured_artworks);
                
                // Display the view
                parent::display($tpl);
        }
}
?>