<?php

defined('_JEXEC') or die('Restricted access');

class GrartViewEditFeatured extends JViewLegacy {

    // Overwriting JView display method
    public function display($tpl = null) {
        $model = $this->getModel("EditFeatured");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = JRequest::get('post');
            $artwork_image_id = $data['image'];
            $order = $data['order'];
            $category_id = $data['category_id'];
            $product_id = $data['product_id'];
            $feature_result = $model->saveFeaturedProduct($artwork_image_id, $order, $category_id, $product_id);
        }



        $products = $model->getRecentProduct();
        $pagination = $model->getPagination();
        $this->assignRef('feature_result', $feature_result);
        $this->assignRef('pagination', $pagination);
        $this->assignRef('recent_products', $products);
        parent::display($tpl);
    }

}

?>