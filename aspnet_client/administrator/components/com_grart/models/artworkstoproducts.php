<?php

defined('_JEXEC') or die('Restricted access');

class GrartModelArtworkstoproducts extends JModelItem {
    private $OPTIONID = 15;
    private $BASIC_PRICE = 9.99;
    
    public function getArtworks(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT u.id as user_id,description,meta_desc, created, title, u.name, artwork_id, filename, status FROM #__artwork_info ai
                inner join #__users u on u.id = ai.user_id
                left join #__artwork_images aim on aim.artwork_id = ai.id
                where ai.status = 0 and aim.hero = 1 
                limit 20";
        $db->setQuery($query);
        $arworks = $db->loadObjectList();
        return $arworks;
    }
    
    public function getArtworksByFilterParams($key=null,$key_value=null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT u.id as user_id,description,meta_desc, created, title, u.name, artwork_id, filename, status FROM #__artwork_info ai
                inner join #__users u on u.id = ai.user_id
                left join #__artwork_images aim on aim.artwork_id = ai.id
                where ai.status = 0 and aim.hero = 1 and ".$key." like '%".$key_value."%'";
        $db->setQuery($query);
        $arworks = $db->loadObjectList();
        return $arworks;
    }
    public function getArtworksByPageLimit($limit=null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        
        if(isset($_SESSION['filter_type'])){
            $query = "SELECT u.id as user_id,description,meta_desc, created, title, u.name, artwork_id, filename, status FROM #__artwork_info ai
                inner join #__users u on u.id = ai.user_id
                left join #__artwork_images aim on aim.artwork_id = ai.id
                where ai.status = 0 and aim.hero = 1 and ".$_SESSION['filter_type']." like '%".$_SESSION['filter_key']."%' 
                    limit ";
        }else{
            $query = "SELECT u.id as user_id,description,meta_desc, created, title, u.name, artwork_id, filename, status FROM #__artwork_info ai
                inner join #__users u on u.id = ai.user_id
                left join #__artwork_images aim on aim.artwork_id = ai.id
                where ai.status = 0 and aim.hero = 1 
                limit ";
        }
        
        $query = $query.$limit;
        $db->setQuery($query);
        $arworks = $db->loadObjectList();
        return $arworks;
    }
    public function getArtworksByOrder($key=null){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        switch($key){
            case 'artwork_id':
                $key = "artwork_id";
                break;
            case 'title':
                $key = "title";
                break;
            case 'name':
                $key = "u.name";
                break;
            case 'userid':
                $key = "u.id";
                break;
            case 'date':
                $key = "created";
                break;
            default:
                echo "Nothing";
        }
        if(isset($_SESSION['filter_type'])){
            $query = "SELECT u.id as user_id,description,meta_desc, created, title, u.name, artwork_id, filename, status FROM #__artwork_info ai
                inner join #__users u on u.id = ai.user_id
                left join #__artwork_images aim on aim.artwork_id = ai.id
                where ai.status = 0 and aim.hero = 1 and ".$_SESSION['filter_type']." like '%".$_SESSION['filter_key']."%' 
                order by ".$key." ".$_SESSION['order_type'];
        }else{
            $query = "SELECT u.id as user_id,description,meta_desc, created, title, u.name, artwork_id, filename, status FROM #__artwork_info ai
                inner join #__users u on u.id = ai.user_id
                left join #__artwork_images aim on aim.artwork_id = ai.id
                where ai.status = 0 and aim.hero = 1 
                order by ".$key." ".$_SESSION['order_type'];
        }
        
        $db->setQuery($query);
        $arworks = $db->loadObjectList();
        return $arworks;
    }
    
    public function getOptionValue(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select option_value_id,price from oc_option_value_description where option_id =".$this->OPTIONID;
        $db->setQuery($query);
        $options_values = $db->loadObjectList();
        return $options_values;
    }
    
    public function getProductImages($artwork_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__artwork_images where artwork_id =".$artwork_id." and hero<>1 order by hero desc";
        $db->setQuery($query);
        $objs = $db->loadObjectList();
        return $objs;
    }
    
    public function getProductImageHero($artwork_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__artwork_images where artwork_id =".$artwork_id." and hero=1";
        $db->setQuery($query);
        $objs = $db->loadObject();
        return $objs;
    }
    
    public function getArtworkTags($artwork_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__tags where artwork_id =".$artwork_id;
        $db->setQuery($query);
        $obj = $db->loadObjectList();
        return $obj;
    }
    public function getArtworkInfo($artwork_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "select * from #__artwork_info where id =".$artwork_id;
        $db->setQuery($query);
        $obj = $db->loadObject();
        return $obj;
    }
    
    public function addProduct($data){
        $db = JFactory::getDbo();
        foreach($data as $d){
            $query = $db->getQuery(true);
            $product =new stdClass();
            $product->id = null;
            $product->model = "dummy";
            $product->sku = "";
            $product->upc = "";
            $product->ean = "";
            $product->jan = "";
            $product->isbn = "";
            $product->mpn = "";
            $product->location = "";
            $product->quantity = 1;
            $product->stock_status_id = 7;
            $product->length_class_id = 1;
            $product->sort_order = 1;
            $product->image = "data/".$d['artwork_image_hero']->filename;
            $product->manufacturer_id = 1;
            $product->shipping = 1;
            $product->price = $this->BASIC_PRICE;
            $product->points = 0;
            $product->tax_class_id = 0;
            $product->date_available = date('Y-m-d');
            $product->date_added = date('Y-m-d h:m:s');
            $product->status = 1;

            try{
                $db->insertObject( 'oc_product', $product, id );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            $product_id = $db->insertId();
            
            $query = $db->getQuery(true);
            $product_description = new stdClass();
            $product_description->product_id = $product_id;
            $product_description->language_id = 1;
            $product_description->name = $d['artwork_info']->title;
            $product_description->description = $d['artwork_info']->description;
            $product_description->meta_description = $d['artwork_info']->meta_desc;
            $product_description->meta_keyword = $d['tags'];
            $product_description->tag = $d['tags'];
            try{
                $db->insertObject( 'oc_product_description', $product_description );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            $query = $db->getQuery(true);
            $product_to_category = new stdClass();
            $product_to_category->product_id = $product_id;
            $product_to_category->category_id = $d['artwork_info']->category_id;
            try{
                $db->insertObject( 'oc_product_to_category', $product_to_category );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            $query = $db->getQuery(true);
            $product_to_store = new stdClass();
            $product_to_store->product_id = $product_id;
            $product_to_store->store_id = 0;
            try{
                $db->insertObject( 'oc_product_to_store', $product_to_store );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            $query = $db->getQuery(true);
            $product_option = new stdClass();
            $product_option->id = null;
            $product_option->product_id = $product_id;
            $product_option->option_id = $this->OPTIONID;
            $product_option->required = 1;

            try{
                $db->insertObject( 'oc_product_option', $product_option, id );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            $product_option_id = $db->insertId();
            
            $query = $db->getQuery(true);
            foreach($d['option_values'] as $d_option_value){
                $product_option_value = new stdClass();
                $product_option_value->id = null;
                $product_option_value->product_option_id = $product_option_id;
                $product_option_value->product_id = $product_id;
                $product_option_value->option_id = $this->OPTIONID;
                $product_option_value->option_value_id = $d_option_value->option_value_id;
                $product_option_value->quantity =999;
                $product_option_value->subtract=1;
                $product_option_value->price=$d_option_value->price;
                $product_option_value->price_prefix="+";
                $product_option_value->weight_prefix="+";
                $product_option_value->points=0;
                $product_option_value->points_prefix="+";
                $product_option_value->weight=0;
                try{
                    $db->insertObject( 'oc_product_option_value', $product_option_value, id );
                }catch(Exception $e){
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
                $product_option_value = null;
            }
            
            $query = $db->getQuery(true);
            $x=0;
            foreach($d['artwork_images'] as $product_img){
                $product_image = new stdClass();
                $product_image->id = null;
                $product_image->product_id = $product_id;
                $product_image->image = "data/".$product_img->filename;
                $product_image->sort_order = $x;
                try{
                    $db->insertObject( 'oc_product_image', $product_image, id );
                }catch(Exception $e){
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
                $product_image = null;
                $x++;
            }
            
            
            $artwork_publish = new stdClass();
            $artwork_publish->id = null;
            $artwork_publish->product_id = $product_id;
            $artwork_publish->artwork_id = $d['artwork_info']->id;
            $artwork_publish->artwork_image_id = $d['artwork_image_hero']->id;
            $artwork_publish->status = 1;
            try{
                $db->insertObject( '#__artwork_publish', $artwork_publish, id );
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            
            $artwork_publish = null;
            $product_images = null;
            $product_option_value = null;
            $product_to_store = null;
            $product_to_category = null;
            $product_description = null;
            $product = null;
            $product_option = null;
            
            $query = $db->getQuery(true);
            $query = "update #__artwork_info set status=1 where id=".$d['artwork_info']->id;
            $db->setQuery($query);
            try{
                    $db->query();
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            
//            
//            $query = $db->getQuery(true);
//            $query = "update #__artwork_publish set status=1 where artwork_id=".$d['artwork_info']->id;
//            $db->setQuery($query);
//            try{
//                    $db->query();
//            }catch(Exception $e){
//                echo 'Caught exception: ',  $e->getMessage(), "\n";
//            }
        }
    }
    
}
?>
