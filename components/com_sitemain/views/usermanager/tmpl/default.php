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
<?php include('/includes/user_header.php');?>
<div class="full_screen" style="margin-top:10px;">

    <div id="user_right_column">
        <div id="profile_content">
            
        </div>
    </div>
    
    
</div>