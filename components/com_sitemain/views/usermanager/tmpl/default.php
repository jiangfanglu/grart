<?php
   defined('_JEXEC') or die('Restricted access');
   
   if(!$this -> artist_not){
       $load_default = "loadPage('/index.php?option=com_sitemain&view=network&format=raw');";
   }else{
       $load_default = "loadPage('/index.php?option=com_opencart&route=account/edit1&format=raw');";
   }
   $ajax = <<<EOD
            window.addEvent('domready',function() {
                $load_default
           });
           function loadPage(url){
                    loaderlength = 0;
                    $('loadingbar').style.display = "block";
                    var url = url;
                     var ajax = new Request({
                          url: url,
                          method: 'get',
                          onSuccess:function(response){
                               $("profile_content").innerHTML = response;
                               $('loadingbar').style.display = "none";
                          },
                          onError:function(){
                                $('info_alert').style.display = 'block';
                                $("info_text").innerHTML = 'Bad';
                            }
                     }).send();
            }
EOD;
 
$doc = & JFactory::getDocument();
$doc->addScriptDeclaration( $ajax );



?>
<div id="info_alert" class="alert alert-error" style="margin-top: 10px;display: <?php echo isset($_GET['msg']) ? 'block' : 'none' ; ?>">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <span id="info_text">
            <?php
                if(isset($_GET['msg'])){
                    echo $_GET['msg'];
                }
            ?>
        </span>
</div>

<div class="full_screen" style="margin-top:10px;">
    <div id="user_left_column">
        <div id="artist_profile">
                <?php echo $this -> loadTemplate('itemlist'); ?>
        </div>
    </div>
    <div id="user_right_column">
        <div id="profile_content">
            
        </div>
    </div>
    
    
</div>
<div id="upload_avatar_photo_contianer">
    <div id="upload_avartar">
        <div style="width:100%;text-align: right;" class="close"><a onclick="return switchDialog(0);">x</a></div>
        <form action="/index.php?option=com_sitemain&task=uploadavartphoto"  method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Choose a photo</legend>
                <input type="file" id="Filedata" name="Filedata"  />
            </fieldset>
            <input class="submit_btn" type="submit" value="Upload" onclick="return showLoader();" />
        </form>
        <div id="ajax_loader2" style="display:none;" ><img src="<?php echo $this->baseurl ?>/templates/shop_template/images/ajax-loader.gif" /></div>
    </div>
</div>

<script>
    function switchDialog(status){
        if(status == 1){
            $('upload_avatar_photo_contianer').style.display = "block";
            $('upload_avartar').style.display = "block";
        }else{
            $('upload_avatar_photo_contianer').style.display = "none";
            $('upload_avartar').style.display = "none";
        }
        return false;
    }
    
    function showLoader(){
        $('ajax_loader2').style.display = 'block';
        return true;
    }
</script>

<div id="ajax_loader_gif" style="display:none;">
    <div style="margin-left:auto;margin-right:auto;margin-top:50px;">
    <img src="<?php echo $this->baseurl ?>/templates/shop_template/images/ajax-loader.gif" />
    </div>
</div>