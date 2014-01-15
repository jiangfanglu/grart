<?php
defined('_JEXEC') or die('Restricted access');
class GrartModelGrart extends JModelItem
{
      var $_total = null;
    var $_pagination = null;

    function __construct() {
        parent::__construct();

        $mainframe = JFactory::getApplication();

        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }
   public function getArtworkList()
   {
       $db = JFactory::getDbo();
       $query = $db->getQuery(true);
       $query = "Select * From #__artwork_info";
     //  $db->setQuery($query);
     //  $artworks = $db->loadObjectList();
      $artworks= $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
       return $artworks;
   }
    function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query =  "Select * From #__artwork_info";
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }
    
    function getPagination()
  {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
  }
  
  /**
   * 
   * @return type
   * NOT IN USE
   */
   public function getArtworkImage()
   {
       $db = JFactory::getDbo();
       $query = $db->getQuery(true);
       $query = "Select category_id,status,ai.id, artwork_id, filename,user_id From #__artwork_images aim
           inner join  #__artwork_info ai on ai.id = aim.artwork_id";
       $db->setQuery($query);
       $images = $db->loadObjectList();
       return $images;
   }
}
?>
