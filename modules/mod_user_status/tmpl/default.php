<?php defined('_JEXEC') or die('Restricted access'); // no direct access 
jimport('joomla.filesystem.folder');?>
<?php //echo JText::_('RANDOM USERS'); ?>
<?php 
$current_user = JFactory::getUser();
if($current_user->guest){
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
    $actual_link = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?$_SERVER[QUERY_STRING]"; 
    $_SESSION['redirect_after_login']=$actual_link;
}
$user_thumb_path = DS.'media'.DS.'userthumbs'.DS.(string)$current_user->id;
if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
    $thumb_path = '/media/userthumbs/'.(string)$current_user->id.'/thumb_120.jpg';
}else{
    $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
}
?>
<ul class="user_status_btns"> 
<?php if ($user->guest) { ?>
<!--    <li><a href="/index.php?option=com_opencart&route=account/login">Login</a></li>-->
    <li><a id="main_login">Login</a>
    <li><a href="/index.php?option=com_opencart&route=account/register">Join</a></li>
    
<?php } else { ?>
    <li class="userlinkli"><a id="userlink" href="/index.php?option=com_sitemain&view=usermanager" onMouseOut="closeStuff('img_caption_fixed')" onMouseOver="setCaptionText_fixed('Click to go to My Manager');showStuff('userlink','img_caption_fixed', -35, 30)"><img src="<?php echo $thumb_path; ?>" alt="" /><?php echo JFactory::getUser()->name ?></a></li>
<!--    <li id="mymanager" onmouseover="showDropdown();"><a href="/index.php?option=com_sitemain&view=usermanager">My Manager</a></li>-->
    
<li class="userlinklir"><a href="/index.php?option=com_opencart&route=account/logout"  onMouseOut="closeStuff('img_caption_fixed')" onMouseOver="setCaptionText_fixed('Log out');showStuff('signoutbtn','img_caption_fixed', -20, 30)">
            <img src="/templates/shop_template/images/sign-out.png" alt="log out" id="signoutbtn" />
        </a>
    </li>
<li class="userlinklir"><a href="/index.php?option=com_sitemain&view=upload" onMouseOut="closeStuff('img_caption_fixed')" onMouseOver="setCaptionText_fixed('Upload Artworks');showStuff('uploadarty','img_caption_fixed', -40, 30)">
            <img id="uploadarty" src="/templates/shop_template/images/upload.png" alt="upload"/>
        </a></li>
    
<?php } ?>
</ul>

<div id="mymanagerdropdown" onmouseout="hideStuff(this);">
         <ul>
             <li class="head"><a href="/index.php?option=com_sitemain&view=usermanager">My Manager</a></li>
             <li class="itemm"><a href="/index.php?option=com_sitemain&view=usermanager">Account</a></li>
             <li class="itemm"><a href="/index.php?option=com_opencart&route=checkout/checkout">Checkout</a></li>
             <li class="itemm"><a href="/index.php?option=com_opencart&route=account/wishlist">Wishlist</a></li>
        </ul>
</div>

<script>                
    function showDropdown(){
        $('mymanagerdropdown').style.display = 'block';
        var position = xy('mymanager');
        $('mymanagerdropdown').style.left = (position[0] - 6) + 'px';
        $('mymanagerdropdown').style.top = '2px';
    }
</script>