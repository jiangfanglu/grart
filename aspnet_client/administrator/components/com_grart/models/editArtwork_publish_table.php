<?php
defined('_JEXEC') or die('Restricted access');
class GrartModelEditArtwork_publish_table extends JModelItem
{
   /**
    * 
    * @return type
    */
    public function getArtworksApproved() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "Select * From #__artwork_publish WHERE 1 ORDER BY status,artwork_id";
        $db->setQuery($query);
        $approved_artworks = $db->loadObjectList();
        return $approved_artworks;
    }
}
?>
