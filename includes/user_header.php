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
            <div id="artist_thumb200" class="yesthumb">
            <img src="/media/userthumbs/<?php echo $user -> id ?>/thumb_120.jpg" />
            </div>
            <div class="edit_avtr" onclick="return switchDialog(1);"></div>
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
            <div style="float:right;font-size: 20px;padding-top:8px;color:navy;"><?php echo JText::_('COM_SITENAIN_USER_CENTRE')?></div>
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