<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
/**
 * Gallery Main Component Controller
 */
class SitemainController extends JControllerLegacy
{
    public $ARTWORK_ACTION_DELETE = 1;
    public $ARTWORK_ACTION_MODIFY = 2;
    public $MAX_SCREEN_WIDTH = 1040;
    
    public function image(){
        echo "<div class='simgle_img'>
                <img src='/media/uploaded_artwork/".JRequest::getVar('userid')."/".JRequest::getVar('filename')."' />
            </div>";
        
    }
    
    public function setimageprimary(){
        $getData = JRequest::get('post');
        $model = $this -> getModel('Artwork');
        $string = explode('_',$getData['artwork_primary']);
        $artwork_id = $string[0];
        $artwork_image_id = $string[1];
        $model -> setPrimaryImage($artwork_id, $artwork_image_id);
        //echo $getData['artwork_primary'];
    }
    
    public function getuserthumb(){
        $model = $this -> getModel('Artist');
        $artist = $model-> getArtistByProductID(JRequest::getVar('product_id'));
        $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.(string)$artist->user_id;
        if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
            $thumb_path = '/media/userthumbs/'.(string)$artist->user_id.'/thumb_120.jpg';
        }else{
            $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
        }
        echo "<a href='".JRoute::_('index.php?option=com_sitemain&view=artist&artist_id='.$artist->user_id)."'><img src='$thumb_path' alt='$artist->name' title='$artist->name' /></a>";
    }
    
    public function setRedirectionSession(){
        $_SESSION['redirect_after_login']= urldecode(JRequest::getVar('current_url'));
        echo 'session_set';
    }

    public function test(){
        echo JPATH_ADMINISTRATOR;
    }
    
    public function checkuser(){
        if(JFactory::getUser()->guest){
            $app = JFactory::getApplication();
            $app->redirect('/index.php?option=com_opencart&route=account/login');
        }
    }
    
    public function search(){
        $app = JFactory::getApplication();
        switch (JRequest::getVar('search_category')) {
            case 'shop':
                $app ->redirect('/index.php?option=com_opencart&route=product/search&filter_name='.urlencode(JRequest::getVar('search_content')));
                break;
            case 'artists':
                $app ->redirect('/index.php?option=com_sitemain&view=artists&keyword='.urlencode(JRequest::getVar('search_content')));
                break;
            case 'articles':
                $app ->redirect('/index.php?option=com_search&view=search&ordering=newest&searchphrase=all&searchword='.urlencode(JRequest::getVar('search_content')));
                break;
        }
        
    }


    public function uploadmultiplefiles(){
        $this -> checkuser();
        $user_id = (string)JFactory::getUser()->get('id');
        
        foreach($_FILES['Filedata']['name'] as $name => $value){
            //this is the name of the field in the html form, filedata is the default name for swfupload
            //so we will leave it as that
            $fieldName = 'Filedata';
            $fileError = $_FILES[$fieldName]['error'][$name];
            if ($fileError > 0) 
            {
                    switch ($fileError) 
                    {
                    case 1:
                    echo JText::_( 'FILE TO LARGE THAN PHP INI ALLOWS' );
                    return;

                    case 2:
                    echo JText::_( 'FILE TO LARGE THAN HTML FORM ALLOWS' );
                    return;

                    case 3:
                    echo JText::_( 'ERROR PARTIAL UPLOAD' );
                    return;

                    case 4:
                    echo JText::_( 'ERROR NO FILE' );
                    return;
                    }
            }
            $fileSize = $_FILES[$fieldName]['size'][$name];
            if($fileSize > 10000000)
            {
                echo JText::_( 'FILE BIGGER THAN 10MB' );
                return;
            }
            $fileName = $user_id."_".$_FILES[$fieldName]['name'][$name];
            $uploadedFileNameParts = explode('.',$fileName);
            $uploadedFileExtension = array_pop($uploadedFileNameParts);
            $validFileExts = explode(',', 'jpeg,jpg,png,gif,tiff');

            $extOk = false;
            foreach($validFileExts as $key => $value)
            {
                    if( preg_match("/$value/i", $uploadedFileExtension ) )
                    {
                            $extOk = true;
                    }
            }
            if ($extOk == false) 
            {
                    echo JText::_( 'INVALID EXTENSION' );
                    return;
            }
            $fileTemp = $_FILES[$fieldName]['tmp_name'][$name];
            $imageinfo = getimagesize($fileTemp);
            $okMIMETypes = 'image/jpeg,image/pjpeg,image/png,image/x-png,image/gif,image/tiff';
            $validFileTypes = explode(",", $okMIMETypes);           

            if( !is_int($imageinfo[0]) || !is_int($imageinfo[1]) ||  !in_array($imageinfo['mime'], $validFileTypes) )
            {
                    echo JText::_( 'INVALID FILETYPE' );
                    return;
            }

            $tempPath = JPATH_SITE.DS.'media'.DS.'uploaded_artwork';

            if(JFolder::exists($tempPath.DS.$user_id)){
                //$uploadPath = $tempPath.DS.$user_id.DS.$fileName;
                $uploadPath = $tempPath.DS.$fileName;

                $this -> saveimages($fileTemp,$uploadPath ,$tempPath,$fileName);
            }else{
                if(JFolder::create($tempPath.DS.$user_id,0777)){

                    //$uploadPath = $tempPath.DS.$user_id.DS.$fileName;
                    $uploadPath = $tempPath.DS.$fileName;

                    $this -> saveimages($fileTemp, $uploadPath ,$tempPath,$fileName);
                }else{
                        echo JText::_( 'ERROR CREATING FOLDER' );
                        return;
                }
            }

        }
        $this -> savePhotoData($_FILES['Filedata']['name']);

        
        
    }
    
    public function saveimages($fileTemp, $uploadPath, $uploadPathParent, $fileName){
        $user_id = (string)JFactory::getUser()->get('id');
        if(!JFile::upload($fileTemp, $uploadPath)) 
        {
                echo JText::_( 'ERROR MOVING FILE' );
                return;
        }else{
            JFile::copy($uploadPath, JPATH_SITE.DS."components".DS."com_opencart".DS."image".DS."data".DS.$fileName);
            
            $this -> createthumbnails($fileName,$uploadPathParent, 200);
            $this -> createthumbnails($fileName,$uploadPathParent, 600);
            $this -> createSmallPic($fileName,$uploadPathParent);
            //JFile::copy($uploadPath, JPATH_SITE.DS."components".DS."com_opencart".DS."image".DS."data".DS.$fileName);
            //$thumb_path = $imagefolder.DS.$user_id.DS.$size.DS.$filename;
            
            
        }
    }
    
    public function createSmallPic($filename,$imagefolder){
        $user_id = (string)JFactory::getUser()->get('id');
        $image = new JImage();
        $image ->loadFile($imagefolder.DS.$filename);
        $width = $image ->getWidth();
        $height = $image ->getHeight();
        $image2 = new JImage();
        $image2 = $image ->resize($width*0.1, $height*0.1);
        $thumb_path = $imagefolder.DS.$user_id.DS.'small'.$filename;
        if(JFolder::exists($imagefolder.DS.$user_id.DS.'small')){
            $image2 ->toFile($thumb_path);
        }else{
            if(JFolder::create($imagefolder.DS.$user_id.DS.'small',0777)){
                $image2 ->toFile($thumb_path);
            }else{
                    echo JText::_( 'ERROR CREATING FOLDER' );
                    return;
            }
        }
        $image = null;
        $image2 = null;
    }

    public function createthumbnails($filename,$imagefolder, $size){
        $user_id = (string)JFactory::getUser()->get('id');
        $image = new JImage();
        $image ->loadFile($imagefolder.DS.$filename);
        
        $width = $image ->getWidth();
        $height = $image ->getHeight();
        
        $image2 = new JImage();
        
        $ratio = $width/$height;
        
        if($height > $width){
            $image2 = $image ->resize($size, $size/$ratio);
            $left = 0;
            $top = ($size/$ratio - $size)/2;
        }elseif($height < $width){
            $image2 = $image ->resize($size*$ratio, $size);
            $left = ($size*$ratio - $size)/2;
            $top = 0;
        }else{
            $image2 = $image ->resize($size, $size);
            $top = 0;
            $left = 0;
        }
        
        $image2 = $image2 -> crop($size, $size, $left, $top);
        
        $thumb_path = $imagefolder.DS.$user_id.DS.$size.DS.$filename;
        
        if(JFolder::exists($imagefolder.DS.$user_id.DS.$size)){
            $image2 ->toFile($thumb_path);
        }else{
            if(JFolder::create($imagefolder.DS.$user_id.DS.$size,0777)){
                $image2 ->toFile($thumb_path);
            }else{
                    echo JText::_( 'ERROR CREATING FOLDER' );
                    return;
            }
        }
        $image = null;
        $image2 = null;
    }
    
    public function uploadfile(){
        $this -> checkuser();
        $user_id = (string)JFactory::getUser()->get('id');
        
        //this is the name of the field in the html form, filedata is the default name for swfupload
        //so we will leave it as that
        $fieldName = 'Filedata';

        //any errors the server registered on uploading
        $fileError = $_FILES[$fieldName]['error'];
        if ($fileError > 0) 
        {
                switch ($fileError) 
                {
                case 1:
                echo JText::_( 'FILE TO LARGE THAN PHP INI ALLOWS' );
                return;

                case 2:
                echo JText::_( 'FILE TO LARGE THAN HTML FORM ALLOWS' );
                return;

                case 3:
                echo JText::_( 'ERROR PARTIAL UPLOAD' );
                return;

                case 4:
                echo JText::_( 'ERROR NO FILE' );
                return;
                }
        }

        //check for filesize
        $fileSize = $_FILES[$fieldName]['size'];
        if($fileSize > 5000000)
        {
            echo JText::_( 'FILE BIGGER THAN 5MB' );
        }

        //check the file extension is ok
        $fileName = $_FILES[$fieldName]['name'];
        $uploadedFileNameParts = explode('.',$fileName);
        $uploadedFileExtension = array_pop($uploadedFileNameParts);

        $validFileExts = explode(',', 'jpeg,jpg,png,gif,tiff');

        //assume the extension is false until we know its ok
        $extOk = false;

        //go through every ok extension, if the ok extension matches the file extension (case insensitive)
        //then the file extension is ok
        foreach($validFileExts as $key => $value)
        {
                if( preg_match("/$value/i", $uploadedFileExtension ) )
                {
                        $extOk = true;
                }
        }

        if ($extOk == false) 
        {
                echo JText::_( 'INVALID EXTENSION' );
                return;
        }

        //the name of the file in PHP's temp directory that we are going to move to our folder
        $fileTemp = $_FILES[$fieldName]['tmp_name'];

        //for security purposes, we will also do a getimagesize on the temp file (before we have moved it 
        //to the folder) to check the MIME type of the file, and whether it has a width and height
        $imageinfo = getimagesize($fileTemp);

        //we are going to define what file extensions/MIMEs are ok, and only let these ones in (whitelisting), rather than try to scan for bad
        //types, where we might miss one (whitelisting is always better than blacklisting) 
        $okMIMETypes = 'image/jpeg,image/pjpeg,image/png,image/x-png,image/gif';
        $validFileTypes = explode(",", $okMIMETypes);           

        //if the temp file does not have a width or a height, or it has a non ok MIME, return
        if( !is_int($imageinfo[0]) || !is_int($imageinfo[1]) ||  !in_array($imageinfo['mime'], $validFileTypes) )
        {
                echo JText::_( 'INVALID FILETYPE' );
                return;
        }

        //lose any special characters in the filename
        //$fileName = preg_replace("/[^A-Za-z0-9]/i", "-", $fileName);

        //always use constants when making file paths, to avoid the possibilty of remote file inclusion
        $tempPath = JPATH_SITE.DS.'media'.DS.'uploaded_artwork';
        
        if(JFolder::exists($tempPath.DS.$user_id)){
            $uploadPath = $tempPath.DS.$user_id.DS.$fileName;

            if(!JFile::upload($fileTemp, $uploadPath)) 
            {
                    echo JText::_( 'ERROR MOVING FILE' );
                    return;
            }
            $this -> savePhotoData($fileName);
        }else{
            if(JFolder::create($tempPath.DS.$user_id,0777)){

                $uploadPath = $tempPath.DS.$user_id.DS.$fileName;

                if(!JFile::upload($fileTemp, $uploadPath)) 
                {
                        echo JText::_( 'ERROR MOVING FILE' );
                        return;
                }
                $this -> savePhotoData($fileName);
            }else{
                    echo JText::_( 'ERROR CREATING FOLDER' );
                    return;
            }
        }
    }
    
    public function uploadsuccess(){
        $this -> checkuser();
        echo 'Uploaded successfully';
    }
    
    public function savePhotoData($filename = null){
        $model = $this -> getModel('Upload');
        if(is_array($filename)){
            if($model -> saveDataMultiple($filename)){
                $app = JFactory::getApplication();
                $app ->redirect("/index.php?option=com_sitemain&view=usermanager");
            }else{
                echo JText::_( 'ERROR SAVING_DATA' );
                return;
            }
        }else{
            if($model -> saveData($filename)){
                $app = JFactory::getApplication();
                $app ->redirect("/index.php?option=com_sitemain&view=usermanager");
            }else{
                echo JText::_( 'ERROR SAVING_DATA' );
                return;
            }
        }
    }
    
    public function updateartworkinfo(){
        $getData = JRequest::get('post');
        $model = $this -> getModel('Mygallery');
        $model -> updateArtworkInfo($getData);
    }
    
    public function deleteartwork(){
        $model = $this -> getModel('Mygallery');
        $status = $model -> checkArtworkStatus(JRequest::getVar('artwork_id'));
        
        //$app = JFactory::getApplication();
        
        if($status){
            if($model -> deleteArtwork(JRequest::getVar('artwork_id'))){
                $msg = "Artwork deleted";
                //$app ->redirect("/index.php?option=com_sitemain&view=mygallery&msg=".urlencode($msg));
            }
        }else{
            $msg = "Artwork published, can not delete, artist request to delete it";
            if($model -> sendArtworkAction(JRequest::getVar('artwork_id'),$msg,$ARTWORK_ACTION_DELETE)){
                $msg = "Artwork published, can not delete, a notification has been sent to the webmaster";
                //$app ->redirect("/index.php?option=com_sitemain&view=mygallery&msg=".urlencode($msg));
            }
        }
        echo $msg;
    }
    
    public function registerartist(){
        $app = JFactory::getApplication();
        $model =& $this ->getModel('Usermanager');
        if($model -> registerArtist()){
            $msg = "You are an artist now. Welcome aboard";
            $app ->redirect("/index.php?option=com_sitemain&view=usermanager&msg=".urlencode($msg));
        }
    }
    
    public function updatePortfolio(){
        $app = JFactory::getApplication();
        $getData = JRequest::get('post');
        $model =& $this ->getModel('Artistprofile');
        $model -> updateArtistProfile($getData);
        return true;
    }
    
    public function uploadAvartPhoto(){
        $app = JFactory::getApplication();
        $user_id = JFactory::getUser() -> id;
        
        $fieldName = 'Filedata';
        $fileError = $_FILES[$fieldName]['error'];
        if ($fileError > 0) 
        {
                switch ($fileError) 
                {
                case 1:
                echo JText::_( 'FILE TO LARGE THAN PHP INI ALLOWS' );
                return;

                case 2:
                echo JText::_( 'FILE TO LARGE THAN HTML FORM ALLOWS' );
                return;

                case 3:
                echo JText::_( 'ERROR PARTIAL UPLOAD' );
                return;

                case 4:
                echo JText::_( 'ERROR NO FILE' );
                return;
                }
        }
        $fileSize = $_FILES[$fieldName]['size'];
        if($fileSize > 5000000)
        {
            echo JText::_( 'FILE BIGGER THAN 5MB' );
        }
        $fileName = $_FILES[$fieldName]['name'];
        $uploadedFileNameParts = explode('.',$fileName);
        $uploadedFileExtension = array_pop($uploadedFileNameParts);

        $validFileExts = explode(',', 'jpeg,jpg,png,gif');
        $extOk = false;
        foreach($validFileExts as $key => $value)
        {
                if( preg_match("/$value/i", $uploadedFileExtension ) )
                {
                        $extOk = true;
                }
        }

        if ($extOk == false) 
        {
                echo JText::_( 'INVALID EXTENSION' );
                return;
        }
        $fileTemp = $_FILES[$fieldName]['tmp_name'];
        $imageinfo = getimagesize($fileTemp);
        $okMIMETypes = 'image/jpeg,image/pjpeg,image/png,image/x-png,image/gif';
        $validFileTypes = explode(",", $okMIMETypes);           
        if( !is_int($imageinfo[0]) || !is_int($imageinfo[1]) ||  !in_array($imageinfo['mime'], $validFileTypes) )
        {
                echo JText::_( 'INVALID FILETYPE' );
                return;
        }
        $tempPath = JPATH_SITE.DS.'media'.DS.'userthumbs';
        $MAX_SCREEN_WIDTH = 940;
        if(JFolder::exists($tempPath.DS.$user_id)){
            $uploadPath = $tempPath.DS.$user_id.DS.'temp_thumb.jpg';

            if(!JFile::upload($fileTemp, $uploadPath)) 
            {
                    echo JText::_( 'ERROR MOVING FILE' );
                    return;
            }else{
                $image = new JImage();
                $image ->loadFile($uploadPath);
                $width = $image->getWidth();
                $height = $image->getHeight();
                
                if($width > $MAX_SCREEN_WIDTH){
                    $image = $image -> resize($MAX_SCREEN_WIDTH, $height*($MAX_SCREEN_WIDTH/$width));
                    $image ->toFile($uploadPath);
                }
            }
        }else{
            if(JFolder::create($tempPath.DS.$user_id,0777)){

                $uploadPath = $tempPath.DS.$user_id.DS.'temp_thumb.jpg';

                if(!JFile::upload($fileTemp, $uploadPath)) 
                {
                        echo JText::_( 'ERROR MOVING FILE' );
                        return;
                }else{
                    $image = new JImage();
                    $image ->loadFile($uploadPath);
                    $width = $image->getWidth();
                    $height = $image->getHeight();

                    if($width>$MAX_SCREEN_WIDTH){
                        $image = $image -> resize($MAX_SCREEN_WIDTH, $height*($MAX_SCREEN_WIDTH/$width));
                        $image -> toFile($uploadPath);
                    }
                }
            }else{
                    echo JText::_( 'ERROR CREATING FOLDER' );
                    return;
            }
        }
        $app -> redirect('/index.php?option=com_sitemain&view=cropthumb');
    }
    
    public function createthumb(){
        $user = JFactory::getUser();
        $image_path = JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.$user->id.DS.'temp_thumb.jpg';
        $image = new JImage($image_path);
        
        $image = $image ->crop(JRequest::getVar('width'), 
                JRequest::getVar('height'), 
                JRequest::getVar('x'), 
                JRequest::getVar('y'));
        $image = $image ->resize(200, 200);
        $image_path_200 = JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.$user->id.DS.'thumb_200.jpg';
        $image ->toFile($image_path_200);
        
        $image = $image ->resize(120, 120);
        $image_path_120 = JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.$user->id.DS.'thumb_120.jpg';
        $image ->toFile($image_path_120);
        
        JFile::delete($image_path);
    }
    
    public function addFollower(){
        $app = JFactory::getApplication();
        $getData = JRequest::get('post');
        $model =& $this ->getModel('Artist');
        $model -> addArtistFollower($getData);
        return true;
    }
    
    public function deletenewslettersubscribtion(){
        $app = JFactory::getApplication();
        
        $data = array(
            'email' => $_POST['email']
        );
        
        $model =& $this ->getModel('Newsletter');
        if($model-> unsubscribe($data)){
            $_SESSION['ns_subscribed'] = false;
            $app ->redirect(JUri::base().'index.php?option=com_sitemain&view=newsletter&msg=Unsubscribed+successfully!');
        }
    }
    
    public function addnewslettersubscribtion(){
        $user = JFactory::getUser();
        $app = JFactory::getApplication();
        
        if($user->guest){
            $registered = 0;
        }else{
            $registered = 1;
        }
        
        $data = array(
            'email' => $_POST['email'],
            'name' => $_POST['mail_name'],
            'registered' => $registered,
            'topics' => $_POST['Topics']
        );
        
        $model =& $this ->getModel('Newsletter');
        if($model-> subscribe($data)){
            $_SESSION['ns_subscribed'] = true;
            $app ->redirect(JUri::base().'index.php?option=com_sitemain&view=newsletter&msg=Subscribed+successfully!');
        }else{
            $app ->redirect(JUri::base().'index.php?option=com_sitemain&view=newsletter&msg=You+have+already+subscribed');
        }
    }
    
     function save_new_posts() {
       // echo "controller.save posts";
         $data = JRequest::get('post');
       // echo "+++$artist_id++++$content";
        $model = $this->getModel('Posts');
        $result = $model->saveNewPost($data);
        if ($result) {
            //$display = $model->getAllPostsForDisplay($artist_id);
            echo "OK";
        } else {
            echo "Error occurred. Please try later.";
        }
    }
    
    function save_new_comment() {
        $data = JRequest::get('post');
        $model = $this->getModel('Comments');
        $result = $model->saveNewComment($data);
        if ($result) {
            echo "OK";
        } else {
            echo "Error occurred. Please try later.";
        }
    }

    function delete_post() {
        $post_id = JRequest::getVar('post_id');
        $model = $this->getModel('Posts');
        $result = $model->deletePost($post_id);
        if ($result) {
            echo "The post has been deleted.";
        } else {
            echo "Error occurred. Please try later.";
        }
    }

    function delete_comment() {
        $comment_id = JRequest::getVar('comment_id');
        $model = $this->getModel('Posts');
        echo "***" . $comment_id;
        $result = $model->deleteComment($comment_id);
        if ($result) {
            echo "The comment has been deleted.";
        } else {
            echo "Error occurred. Please try later.";
        }
    }
    
    function shareartwork($title,$desc,$artwork_id,$filename){
        $user = JFactory::getUser();
        $media_url = JPATH_BASE.DS.'media'.DS.'uploaded_artwork'.DS.$user->id.DS.'200'.DS.$filename;
        $url= "index.php?option=com_sitemain&view=artistgallery&artist_id=".$user->id."&artwork_id=".$artwork_id;
        $params = $media_url.',';
        $params .= $url.',';
        $params .= $title.',';
        $params .= $desc;
        $receiver_ids = JRequest::getVar('$receiver_ids');
        $model =& $this ->getModel('Upload');
        if($model->shareWithFriends($user->id,$receiver_ids,$params)){
            return true;
        }
    }
    
}
?>
