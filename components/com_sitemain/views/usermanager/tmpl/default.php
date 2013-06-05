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

                    <?php if($this -> userthumb_folder){ ?>
                        <div id="artist_thumb200" class="yesthumb">
                        <img src="/media/userthumbs/<?php echo $this -> user -> id ?>/thumb_120.jpg" />
                        </div>
                        <div class="edit_avtr"><a onclick="return switchDialog(1);" >
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </a></div>
                    <?php }else{ ?>
                        <div id="artist_thumb200" class="nothumb">
                        <a onclick="return switchDialog(1);" >Upload a photo</a>
                        </div>
                    <?php } ?>

<!--                <div id="artist_portfolio">
                <?php if($this -> artist_not){ ?>
                    <div class="alert alert-info">
                        You are not a Artist yet <a id="bec_artist" href="/index.php?option=com_sitemain&task=registerartist"><b>Become an Artist</b></a>
                    </div>
                <?php }else{ ?>
                    <div class="account_artist_edit">
                        <div id="account_portfolio">Portfolio</div>
                        <div class="edit">
                            <img onclick="return showStuff('account_portfolio','portfolio_container',0,19)" src="/templates/shop_template/images/edit_icon.gif" alt="Edit" />
                        </div>
                    </div>
                    <div id="portfolio_container">
                        <div style="width:600px;text-align: right;"><a onclick="closeStuff('portfolio_container');return false;">x</a></div>
                        <div>
                                <textarea id="portfolio" name="portfolio" class="disabled" disabled="true"><?php 

                                    if($this -> artist -> portfolio == ""){
                                        echo "Start your portfolio here";
                                    } else{
                                        echo $this -> artist -> portfolio;
                                    }

									
									
                                            ?>
                                </textarea>
                         </div>
                        <div>
                            <div class="ctrl_btn"><a href="#" id="update_portfolio"  style="display:none;">Update</a></div>
                            <div class="ctrl_btn"><a href="#" id="edit_btn_portfolio" 
                               onclick="return switchConent('portfolio','edit_btn_portfolio','cancel_btn_portfolio');">Edit</a></div>
                            <div class="ctrl_btn"><a href="#" id="cancel_btn_portfolio" 
                               onclick="return switchConent('portfolio','edit_btn_portfolio','cancel_btn_portfolio');" style="display:none;">Cancel</a></div>
                        </div>
                        <div id="ajax_loader" style="width:200px;display:none;" ><img src="<?php echo $this->baseurl ?>/templates/shop_template/images/ajax-loader.gif" /></div>
                        <script>
                            function switchConent(textElementID,editBtn,cancelBtn){
                                if($(textElementID).disabled == false){
                                    $(textElementID).className = "disabled";
                                    $(textElementID).disabled = true;
                                    $(editBtn).style.display = "block";
                                    $(cancelBtn).style.display = "none";
                                    $('update_portfolio').style.display = "none";
                                }else{
                                    $(textElementID).className = "enabled";
                                    $(textElementID).disabled = false;
                                    $(editBtn).style.display = "none";
                                    $(cancelBtn).style.display = "block";
                                    $('update_portfolio').style.display = "block";
                                }
                                return false;
                            }


                        </script>
                    </div>
                    <div class="account_artist_edit">
                        <div id="account_website">Website URL</div>
                        <div class="edit">
                            <img onclick="return showStuff('account_website','website_url_edit',0,19)" src="/templates/shop_template/images/edit_icon.gif" alt="Edit" />
                        </div>
                    </div>
                    <div id="website_url_edit">
                        
                    </div>
                <?php } ?>
                </div>-->
                
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