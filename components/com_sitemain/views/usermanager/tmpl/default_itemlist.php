<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="usermanager_ctrl">
    <div class="usermanager_ctrl_heading">
                User Home
    </div>
    <div class="usermanager_ctrl_text">
        <ul>
<!--            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_&format=raw'; ?>');">User Home</a></li>-->
            <?php if(!$this -> artist_not){ ?>
            <li class="usermmngr_li <?php echo $this -> artist_not ? '' : 'active' ?>"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_sitemain&view=network&format=raw'; ?>');">Social</a></li>
            <?php } ?>
        </ul>
    </div>
    <?php if($this -> artist_not){ ?>
        <div class="usermanager_ctrl_heading" style="margin-bottom: 10px;">
            You are not a Artist yet <a id="bec_artist" href="/index.php?option=com_sitemain&task=registerartist"><b>Become an Artist</b></a>
        </div>
    <?php }else{ ?>
            <div class="usermanager_ctrl_heading">
                Artist Profile
            </div>
            <div class="usermanager_ctrl_text">
                <ul>
                    <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_sitemain&view=artistprofile&format=raw'; ?>');">Edit Profile</a></li>
                </ul>
            </div>
            <div class="usermanager_ctrl_heading">
                Artwork
            </div>
            <div class="usermanager_ctrl_text">
                <ul>
                    <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_sitemain&view=artist_products&format=raw'; ?>');">My Balance</a></li>
                    <li class="usermmngr_li"><a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=mygallery'; ?>">All Artworks</a></li>
                </ul>
            </div>
    <?php } ?>
    <div class="usermanager_ctrl_heading">
        Shop
    </div>
    <div class="usermanager_ctrl_text">
        <ul>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=checkout/cart1&format=raw'; ?>');">Shopping Cart</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/order1&format=raw'; ?>');">Order History</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/wishlist1&format=raw'; ?>');">Wishlist</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/transaction1&format=raw'; ?>');">Transactions</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/return1&format=raw'; ?>');">Return Requests</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/reward1&format=raw'; ?>');">Reward Points</a></li>
        </ul>
    </div>
    <div class="usermanager_ctrl_heading">
        Account
    </div>
    <div class="usermanager_ctrl_text">
        <ul>
            <li class="usermmngr_li <?php echo $this -> artist_not ? 'active' : '' ?>"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/edit1&format=raw'; ?>');">Edit Account</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/password1&format=raw'; ?>');">Change Password</a></li>
            <li class="usermmngr_li"><a href="#" onclick="return getUserContent(this, 'profile_content','<?php echo JURI::base().'index.php?option=com_opencart&route=account/address1&format=raw'; ?>');">Change Address</a></li>
        </ul>
    </div>
</div>