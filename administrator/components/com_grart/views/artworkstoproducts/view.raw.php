<?php
defined('_JEXEC') or die('Restricted access');

class GrartViewArtworkstoproducts extends JViewLegacy {

    public function display($tpl = null) {
        $artworks =& $this -> get('Artworks');
        $this ->assignRef('artworks', $artworks);
        parent::display($tpl);
    }
}
?>
