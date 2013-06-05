<?php

defined('_JEXEC') or die;
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class  JFormFieldSitemain extends JFormFieldList{
    protected $type = 'sitemain';
    
    protected function getOptions() {
        //parent::getOptions();
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('category_id,name');
        $query->from('oc_category_description');
        $db->setQuery((string)$query);
        $categories = $db->loadObjectList();
        $options = array();
        if($categories){
            foreach($categories as $category){
                $options[] = JHtml::_('select.option', $category->category_id, $category->name );
            }
        }
        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}

?>
