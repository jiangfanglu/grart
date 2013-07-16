<?php
defined('_JEXEC') or die('Restricted access');
$user = JFactory::getUser();
$tempPath = JPATH_SITE.DS.'media'.DS.'userthumbs'.DS.(string)$user->id;
            
if(!JFolder::exists($tempPath)){
    $userthumb_folder = false;
}else{
    $userthumb_folder = true;
}
$active=array('','','','','');
$shop_active=array('','','','','','');
$account_active=array('','','','');
$arry = explode('_',JRequest::getVar('cur'));
$active[$arry[0]]="active";
if($arry[0]=='3'){
    $shop_active[$arry[1]]="active";
}
if($arry[0]=='4'){
    $account_active[$arry[1]]="active";
}
?>
<div id="usermenus" class="usermanager_ctrl">
    <div class="centerdiv">
        <?php if($userthumb_folder){ ?>
    <!--        <div id="artist_thumb200" class="yesthumb">
            <img src="/media/userthumbs/<?php echo $user -> id ?>/thumb_120.jpg" />
            </div>
            <div class="edit_avtr"><a onclick="return switchDialog(1);" >
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a></div>-->
        <?php }else{ ?>
            <div id="artist_thumb200" class="nothumb">
            <a onclick="return switchDialog(1);" >Upload a photo</a>
            </div>
        <?php } ?>
        <div>
            <ul>
                <li class="<?php echo $active[0] ?>"><a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=network&cur=0_0'; ?>"><?php echo JText::_('COM_SITEMAIN_USER_HOME')?></a></li>
                <li class="<?php echo $active[1] ?>"><a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artistprofile&cur=1_0'; ?>"><?php echo JText::_('COM_SITEMAIN_EDIT_PROFILE')?></a></li>
                <li class="<?php echo $active[2] ?>"><a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=mygallery&cur=2_0'; ?>"><?php echo JText::_('COM_SITEMAIN_ARTWORK')?></a></li>
                <li class="<?php echo $active[3] ?>" id="shop_items_menu"><a><?php echo JText::_('COM_SITEMAIN_SHOP_ITEMS')?></a></li>
                <li class="<?php echo $active[4] ?>" id="account_menu"><a><?php echo JText::_('COM_SITEMAIN_ACCOUNT')?></a></li>
            </ul>
        </div>
    </div>
</div>
<div id="shop_items" class="usermanager_ctrl_text">
    <div class="centerdiv">
    <ul>
        <li class="<?php echo $shop_active[0] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=checkout/cart1&cur=3_0'; ?>">Shopping Cart</a></li>
        <li class="<?php echo $shop_active[1] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/order1&cur=3_1'; ?>">Order History</a></li>
        <li class="<?php echo $shop_active[2] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/wishlist1&cur=3_2'; ?>">Wishlist</a></li>
        <li class="<?php echo $shop_active[3] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/transaction1&cur=3_3'; ?>">Transactions</a></li>
        <li class="<?php echo $shop_active[4] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/return1&cur=3_4'; ?>">Return Requests</a></li>
        <li class="<?php echo $shop_active[5] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/reward1&cur=3_5'; ?>">Reward Points</a></li>
    </ul></div>
</div>
<div id="account_items" class="usermanager_ctrl_text">
    <div class="centerdiv">
    <ul>
        <li class="<?php echo $account_active[0] ?>"><a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist_products&cur=4_0'; ?>"><?php echo JText::_('COM_SITEMAIN_MY_BALANCE')?></a></li>
        <li class="<?php echo $account_active[1] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/edit1&cur=4_1'; ?>">Edit Account</a></li>
        <li class="<?php echo $account_active[2] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/password1&cur=4_2'; ?>">Change Password</a></li>
        <li class="<?php echo $account_active[3] ?>"><a href="<?php echo JURI::base().'index.php?option=com_opencart&route=account/address1&cur=4_3'; ?>">Change Address</a></li>
    </ul></div>
</div>
<script>
jQuery('#account_menu').mouseover(function(){
    if(jQuery('#shop_items').css('display')=='block'){
        jQuery('#shop_items').css('display', 'none');
    }
    jQuery('#account_items').css('display', 'block');
});
jQuery('#account_items').mouseleave(function(){
    jQuery('#account_items').css('display', 'none');
});
jQuery('#shop_items_menu').mouseover(function(){
    if(jQuery('#account_items').css('display')=='block'){
        jQuery('#account_items').css('display', 'none');
    }
    jQuery('#shop_items').css('display', 'block');
});
jQuery('#shop_items').mouseleave(function(){
    jQuery('#shop_items').css('display', 'none');
});
</script>