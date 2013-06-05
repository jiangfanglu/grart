<?php 
defined('_JEXEC') or die('Restricted access'); 

$email_default_value = "example@example.com";

$script = <<<EOD
        function setBlank(obj){
            if(obj.value == '$email_default_value'){
                obj.value = "";
                obj.style.color = "#000";
            }else if(obj.value == ''){
                obj.value = "$email_default_value";
                obj.style.color = "#ccc";
            }
        }
   
EOD;

jimport('joomla.filesystem.folder');
?>

<!--<div class="divder_bg_dynamic">&nbsp;</div>-->
<div id="realfooter_ctner">
    <div id="news_letter" class="full_screen">
        <form action="<?php echo JUri::base().'index.php?option=com_sitemain&view=newsletter' ?>" onsubmit="return validateEmail('newsletter_email');" method="post">
        <div class="ns_input"><input style="color:#ccc;" onfocus="setBlank(this)" onblur="setBlank(this)" type="text" value="<?php echo $email_default_value; ?>" id="newsletter_email" name="newsletter_email"/></div>
        <div class="ns_input"><input type="submit" class="submit_btn" id="news_letter_btn" value="Subscribe our newsletter"/></div>
        </form>
        <div id="site_social">
            <div class="fb_btn">Like us on Social Medias</div>
            <div class="fb_btn">
                <div class="fb-like" data-href="http://www.grart.com.au" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-colorscheme="light"></div>
            </div>
            <div class="twitter_btn">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.grart.com.au">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="google_btn">
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="medium" data-href="http://www.grart.com.au"></div>

                <!-- Place this tag after the last +1 button tag. -->
                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
            </div>
            

        </div>
    </div>
    <script>
        <?php echo $script;?>
    </script>
<!--    <div class="divder_bg">&nbsp;</div>-->
    
    <div id="realfooter" class="full_screen">

        <div id="links">
            <div id="links_categories" class="linkcolume">
                <div class="footer_title">Product Category</div>
                <ul>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Drawings
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Cartoon
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Creative Photography
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Patterns
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Abstract
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Art for Kids
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Classic Replica
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com'); ?>">
                            Crafted
                    </a></li>
                </ul>
            </div>
            
            <div id="links_info" class="linkcolume">
                <div class="footer_title">Help</div>
                <ul>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=80&a_id=71'); ?>">
                            F.A.Q
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=80&a_id=79'); ?>">
                            Artist's Guide
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=80&a_id=81'); ?>">
                            How To's
                     </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=80&a_id=72'); ?>">
                            Shipping Options
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=80&a_id=73'); ?>">
                            Payment Options
                     </a></li>
                     <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=80&a_id=80'); ?>">
                            Return Policy
                     </a></li>
                </ul>
            </div>
            <div id="links_services" class="linkcolume">
                <div class="footer_title">About</div>
                <ul>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=83&a_id=75'); ?>">
                            Contact Us 
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=83&a_id=74'); ?>">
                            Company
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=83&a_id=76'); ?>">
                            Terms & Conditions
                    </a></li>
                     <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=articles&c_id=83&a_id=78'); ?>">
                            Privacy Policy
                    </a></li>
                </ul>
            </div>
            
            <div id="links_accounts" class="linkcolume">
                <div class="footer_title">Account</div>
                <ul>
                    <?php if(JFactory::getUser()->id == 0 ){ ?>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_opencart&route=account/register'); ?>">
                         Sign UP
                    </a></li>
                    <?php } ?>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_opencart&route=account/order'); ?>">
                            Order Status
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_opencart&route=account/wishlist'); ?>">
                            Wishlist
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_opencart&route=account/return/insert'); ?>">
                            Make a Return
                    </a></li>
                </ul>
            </div>
            
            <div id="links_extra" class="linkcolume">
                <div class="footer_title">Extra</div>
                <ul>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=newsletter'); ?>">
                            Newsletter Subscription
                     </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=artists'); ?>">
                         Artists   
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_opencart&Itemid=484&route=account/voucher'); ?>">
                            Gift Vouchers
                    </a></li>
                    <li><a href="<?php echo JRoute::_('/index.php?option=com_opencart&Itemid=484&route=product/special'); ?>">
                            Specials
                    </a></li>
                     <li><a href="<?php echo JRoute::_('/index.php?option=com_sitemain&view=sitemap'); ?>">
                            Sitemap
                    </a></li>
                </ul>
            </div>
        </div>
        <div id="followus">
            <!-- AddThis Follow BEGIN -->
            <p>Follow Us</p>
            <div class="addthis_toolbox addthis_32x32_style addthis_default_style">
            <a class="addthis_button_facebook_follow" addthis:userid="grart"></a>
            <a class="addthis_button_twitter_follow" addthis:userid="grart"></a>
            <a class="addthis_button_google_follow" addthis:userid="grart"></a>
            <a class="addthis_button_pinterest_follow" addthis:userid="grart"></a>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-518ddce9075880ba"></script>
            <!-- AddThis Follow END -->

        </div>
<!--        <div class="fb-comments" data-href="http://www.grart.com.au" data-width="400" data-num-posts="3"></div>-->
    </div>
    
    
</div>
<div class="divder_line">&nbsp;</div>


<div id="view_history">
    <div id="vh_content">
        <div class="heading">Viewed Products:</div>
        <div class="vh_list">
            <?php foreach($_SESSION['recent_products'] as $p){ ?>
            <a href="<?php echo JUri::base().'index.php?option=com_opencart&route=product/product&product_id='.$p['product_id'] ?>">
                <img style="width:50px!important;" src="<?php echo $p['thumb_url'] ?>" /> 
            </a>
            <?php } ?>
        </div>
        <div class="heading">Viewed Artists:</div>
        <div class="vh_list">
            <?php foreach($_SESSION['recent_artists'] as $a){ ?>
            <a href="<?php echo JUri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$a['user_id'] ?>">
                <?php 
                $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.$a['user_id'];
                if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
                    $thumb_path = '/media/userthumbs/'.$a['user_id'].'/thumb_120.jpg';
                }else{
                    $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                }

                ?>
                
                <img style="width:50px!important;" src="<?php echo JUri::base().$thumb_path ?>" /> 
            </a>
            <?php } ?>
        </div>
    </div>
</div>
<div id="vh_bar">
<!--        <span id="svh">Show<br/>Recent<br/>Viewed</span>-->
    <div onclick="showVHContent()"><img src="<?php echo Juri::base()."/templates/shop_template/images/quicklink_viewed.gif"?>" /></div>
    <div>
        <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=checkout/cart" ?>">
        <img src="<?php echo Juri::base()."/templates/shop_template/images/quicklink_cart.gif"?>" />
        </a>
    </div>
    <div>
        <a href="<?php echo Juri::base()."index.php?option=com_opencart&route=account/wishlist" ?>">
        <img src="<?php echo Juri::base()."/templates/shop_template/images/quicklink_wishlist.gif"?>" />
        </a>
    </div>
    <div>
        <a href="<?php echo Juri::base()."index.php?option=com_sitemain&view=articles&c_id=80&a_id=71" ?>">
        <img src="<?php echo Juri::base()."/templates/shop_template/images/quicklink_help.gif"?>" />
        </a>
    </div>
        <input type="hidden" id="checkRV" name="checkRV" value="1" />
</div>
<script>

    $('vh_bar').style.display = 'table';
    var position = xy('main_content');
    $('vh_bar').style.left = position[0] + 1048+'px';
    
    function showVHContent(){
        if($('checkRV').value == '0'){
            $('checkRV').value = '1';
            //$('svh').innerHTML = "Hide<br/>Recent<br/>Viewed";
            //$('vh_bar').style.left =  "1010px";
            $('view_history').style.display = "none";
        }else{
            $('checkRV').value = '0';
            //$('svh').innerHTML = "Show<br/>Recent<br/>Viewed";
            //$('vh_bar').style.left = "5px";
            $('view_history').style.display = "block";
        }
        
    }
</script>
<script>
jQuery('#main_login').click(function(){
    jQuery('#login_anywhere_out').fadeIn('slow');
});
jQuery('#close_button').click(function(){
    jQuery('#login_anywhere_out').fadeOut('slow');
});
jQuery('#login_anywhere_out').click(function(){
    var isHovered = jQuery('#login_anywhere_in').is(":hover");
    if(!isHovered){
        jQuery('#login_anywhere_out').fadeOut('slow');
    }
});
</script>