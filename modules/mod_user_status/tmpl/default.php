<?php defined('_JEXEC') or die('Restricted access'); // no direct access 
jimport('joomla.filesystem.folder');?>
<?php ?>
<?php 
$current_user = JFactory::getUser();
//$user_thumb_path = DS.'media'.DS.'userthumbs'.DS.(string)$current_user->id;
//if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
//    $thumb_path = '/media/userthumbs/'.(string)$current_user->id.'/thumb_120.jpg';
//}else{
//    $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
//}
?>
<ul class="user_status_btns"> 
    <li class="userlinkli" id="wishlist-total">
        <a href="<?php echo JRoute::_('index.php?option=com_opencart&route=account/wishlist')?>">
            <?php echo JText::_('MOD_USER_STATUS_WISHLIST')?> (<?php echo count($_SESSION['wishlist']);?>)
        </a>
    </li>
    <li class="userlinkli">
        <a href="<?php echo JRoute::_('hindex.php?option=com_opencart&route=checkout/cart')?>">
            <?php echo JText::_('MOD_USER_STATUS_CART')?>
        </a>
    </li>
    <li class="userlinkli">
        <a href="<?php echo JRoute::_('index.php?option=com_opencart&&route=checkout/checkout')?>">
            <?php echo JText::_('MOD_USER_STATUS_CHECKOUT')?>
        </a>
    </li>
    <li>|</li>
<?php if ($user->guest) { ?>
<!--    <li><a href="/index.php?option=com_opencart&route=account/login">Login</a></li>-->
    <li id="main_login_li"><a id="main_login">
            <?php echo JText::_('MOD_USER_STATUS_LOGIN')?>
        </a></li>
    <li><a href="/index.php?option=com_opencart&route=account/register"><?php echo JText::_('MOD_USER_STATUS_SINGUP')?></a></li>
    
<?php } else { ?>
    <li class="userlinkli"><a id="userlink" href="/index.php?option=com_sitemain&view=usermanager" onMouseOut="closeStuff('img_caption_fixed')" onMouseOver="setCaptionText_fixed('Click to go to My Manager');showStuff('userlink','img_caption_fixed', -35, 30)">
<!--            <img src="<?php echo $thumb_path; ?>" alt="" />-->
                <?php echo JFactory::getUser()->name ?></a></li>
<!--    <li id="mymanager" onmouseover="showDropdown();"><a href="/index.php?option=com_sitemain&view=usermanager">My Manager</a></li>-->
    <li class="userlinklir"><a href="/index.php?option=com_sitemain&view=upload" onMouseOut="closeStuff('img_caption_fixed')" onMouseOver="setCaptionText_fixed('Upload Artworks');showStuff('uploadarty','img_caption_fixed', -40, 30)">
            <img id="uploadarty" src="/templates/shop_template/images/upload.png" alt="upload"/>
        </a></li>
<li class="userlinklir"><a href="/index.php?option=com_opencart&route=account/logout"  onMouseOut="closeStuff('img_caption_fixed')" onMouseOver="setCaptionText_fixed('Log out');showStuff('signoutbtn','img_caption_fixed', -20, 30)">
           <?php echo JText::_('MOD_USER_STATUS_SINGOUT')?>
        </a>
    </li>

    
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