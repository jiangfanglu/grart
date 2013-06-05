<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<jdoc:include type="head" />
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/shop.js" type="text/javascript"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.masonry.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/lightbox.js" type="text/javascript"></script>
<!--	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />-->
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_alt.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/opencart.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/lightbox.css" type="text/css" />
</head> 
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=575263575817684";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



    <div class="top_bar">
        <div class="header_top">
                    <div class="header_in_toleft">
                        <div class="logoo">
                            <a href="<?php echo $this->baseurl ?>">
                                <img src="<?php echo $this->baseurl ?>/templates/shop_template/images/grart_logo_beta.gif" />
                            </a>
                        </div>
<!--                        <jdoc:include type="modules" name="position-1" style="none" />-->
                        <div class="navli">
                            <ul>
                                <li><a href="<?php echo JUri::base() ?>">Home</a></li>
                                <li><a href="<?php echo JUri::base()."index.php?option=com_opencart" ?>">Shop</a></li>
                            </ul>
                        </div>
                        <div class="search_box">
                            <div class="search_box_input">
                                <form id="" action="/index.php?option=com_sitemain&task=search" method="post" onsubmit="return validateSearchForm();">
                                    <input type="text" id="search_content" name="search_content" class="search_text" />
                                    <input type="submit" class="search_btn" value="Search" />
                                    <input type="hidden" id="search_category" name="search_category" value="shop" />
                                </form>
                            </div>
                            <div id="sb_isc" style="width:59px;" class="search_box_input_select_category" onclick="showCategorySelect()">
                                in 'shop'
                            </div>
                        </div>
                        <div id="search_category_select" onmouseout="hideStuff(this)">
                            <ul>
                                <li onclick="setSearchCategory('shop')">Shop</li>
                                <li onclick="setSearchCategory('artists')">Artists</li>
                                <li onclick="setSearchCategory('help')">Help</li>
                            </ul>
                        </div>
                        <script>
                            function validateSearchForm(){
                                if($('search_content').value=="" || $('search_category').value==""){
                                    alert('No input was detected; or you forgot to choose a category');
                                    return false;
                                }else{
                                    return true;
                                }
                                
                            }
                            function setSearchCategory(target_text){
                                $('search_category_select').style.display = 'none';
                                $('sb_isc').innerHTML = 'in \''+target_text+'\'';
                                $('search_category').value = target_text;
                            }
                            
                            function showCategorySelect(){
                                $('search_category_select').style.display = 'block';
                                var position = xy('sb_isc');
                                $('search_category_select').style.left = position[0] + 'px';
                                $('search_category_select').style.top = position[1] + 25 + 'px';
                            }
                        </script>
                    </div>
                        
<!--                        <div class="header_in_toright">
                            <div>
                                <jdoc:include type="modules" name="position-10" style="none" />
                            </div>
                        </div>-->
                    
                        <div class="header_in_toright">
                            <div>
                               <jdoc:include type="modules" name="user3" style="none" />
                               
                            </div>
                        </div>
                </div>
    </div>

        <div id="loadingbar">
            <div id="loadingbarinner">&nbsp;</div>
        </div>
        <script>
        var loaderlength = 0;
        var myVar=setInterval(function(){
            loader()
        },20);
        function loader()
        {
            if($('loadingbar').style.display == 'none'){
                $('loadingbarinner').style.width = '0px';
            }else{
                if((loaderlength + 10) < 1040){
                    $('loadingbarinner').style.width = loaderlength +'px';
                }
                loaderlength += 5;
            }
        }
    
        </script>
<!--<div class="info_uploadaw">
    Start your journey here today <a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=upload');?>">Upload your artwork</a>
                </div>-->

<div id="login_anywhere_out">
    <div id="login_anywhere_in">
        <div id="close_button" class="close_button"><img src="/templates/shop_template/images/close_button.png" /></div>
        <div id="l_heading">
            <div class="left">Member Login</div>
            <div class="right"> <a href="<?php echo JUri::base() ?>index.php?option=com_opencart&route=account/forgotten">Forgotten Password</a></div>
            
        </div>
        <form action="<?php echo JUri::base() ?>index.php?option=com_opencart&route=account/login" method="post" enctype="multipart/form-data">
      
        <div class="l_content">
            <input type="text" id="login_email" name="email" value="Email" />
        </div>
        <div class="l_content">
            <input type="password" id="login_password" name="password" value="Password" />
        </div>
        <div class="l_button">
            <input type="submit" value="Login" class="product-button" /> or 
            <input type="button" id="signupbtn" value="Sign Up" class="product-button" />
        </div>
            </form>
    </div>
</div>
<script>
jQuery("#signupbtn").click(function(){
    document.location.href = '<?php echo juri::base().'index.php?option=com_opencart&route=account/register' ?>';
});
jQuery("#login_email").focus(function(){
if (this.value == "Email")
{
    this.value = "";
    jQuery(this).css('color','#2e2d2d');
 }
});
jQuery("#login_password").focus(function(){
if (this.value == "Password")
{
    this.value = "";
    jQuery(this).css('color','#2e2d2d');
 }
});
jQuery("#login_email").blur(function(){

    if (this.value == "")
    {
        this.value = "Email";
        jQuery(this).css('color','#ccc');
    }
});
jQuery("#login_password").blur(function(){

    if (this.value == "")
    {
        this.value = "Password";
        jQuery(this).css('color','#ccc');
    }
});
</script>
    <div class="body" id="main_content">
<!--        <div class="alert alert-error">
                <span>
        GRART.com.au is under testing mode, any materials used are samples. If it breaches your right, please let us know. We will remove the content upon your request  as soon as we can. Any request, please send to jiangfanglu@hotmail.com
                </span>
        </div>-->
                <div class="container-main">
                    <jdoc:include type="component" />
                </div>
                <div class="footer">
                    <jdoc:include type="modules" name="customfooter" style="none" />
                    <jdoc:include type="modules" name="footer" />
                </div> 
    </div>
</body>
</html>