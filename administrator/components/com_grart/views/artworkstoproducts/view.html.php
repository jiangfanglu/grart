<?php
defined('_JEXEC') or die('Restricted access');

class GrartViewArtworkstoproducts extends JViewLegacy {

    public function display($tpl = null) {
        if(strtoupper($_SERVER['REQUEST_METHOD']) != 'POST'){
            if (isset($_GET['query_type']) && $_GET['query_type'] == "order") {
                if(isset($_SESSION['order_type'])){
                    if($_SESSION['order_type'] == "desc"){
                        $_SESSION['order_type'] = "asc";
                    }else{
                        $_SESSION['order_type'] = "desc";
                    }
                }else{
                    $_SESSION['order_type'] = "desc";
                }
                $model =& $this ->getModel('Artworkstoproducts');
                $artworks = $model -> getArtworksByOrder($_GET['order_filter']);
            }else{
                $artworks =& $this -> get('Artworks');
            }
        }else{
            $model =& $this ->getModel('Artworkstoproducts');
            
            if($_GET['query_type'] == "filter"){
                switch($_POST['filter_type']){
                    case "artwork_id":
                        $_SESSION['filter_type'] = "artwork_id";
                        break;
                    case "artwork_title":
                        $_SESSION['filter_type'] = "title";
                        break;
                    case "artist_name":
                        $_SESSION['filter_type'] = "u.name";
                        break;
                    case "description":
                        $_SESSION['filter_type'] = "description";
                        break;
                    default:
                        echo 'nothing';
                }
                $_SESSION['filter_key'] = $_POST['filter_key'];
                $artworks = $model -> getArtworksByFilterParams($_SESSION['filter_type'],$_POST['filter_key']);
            }elseif ($_GET['query_type'] == "pagelimit") {
                $artworks = $model -> getArtworksByPageLimit($_POST['page_limit']);
            }
        }
        $this ->assignRef('artworks', $artworks);
        
        parent::display($tpl);
    }
}
?>
