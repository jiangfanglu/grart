<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="user_admin_container" id="user_admin_container_all">
    <div class="account_left">
        <div class="list_box">
            <div class="list_box_title">
                Wishlist
            </div>
            <div class="list_box_content" id="wishlist">
                <div id="wishlist_content" style="width:100%;"><img src="<?php echo $this->baseurl ?>/templates/shop_template/images/ajax-loader.gif" /></div>
                <div class="account_view_complete"><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/wishlist'; ?>" target="_blank">View/Modify complete wishlist</a></div>
            </div>
        </div>
        
        <div class="list_box">
            <div class="list_box_title">
                Order History
            </div>
            <div class="list_box_content" id="orderlist">
                <div id="orderlist_content" style="width:100%;"><img src="<?php echo $this->baseurl ?>/templates/shop_template/images/ajax-loader.gif" /></div>
                <div class="account_view_complete"><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/order'; ?>" target="_blank">View complete order history</a></div>
            </div>
        </div>
        
        <div class="list_box">
            <div class="list_box_title">
                Shopping Cart
            </div>
            <div class="list_box_content" id="shoppingcart">
                <div id="cart_content"></div>
                <div class="account_view_complete"><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=checkout/cart'; ?>" target="_blank">View shopping cart</a></div>
            </div>
        </div>
    </div>
    <div class="account_right">
        <div>
            <h4>Account</h4>
            <ul>
                <li><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/edit' ; ?>" target="_blank">Edit Account</a></li>
                <li><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/password' ; ?>" target="_blank">Change Password</a></li>
                <li><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/address' ; ?>" target="_blank">Change Address</a></li>
            </ul>
        </div>
        <div>
            <h4>Order</h4>
            <ul>
                <li><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/reward' ; ?>" target="_blank">My Reward Points</a></li>
                <li><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/return' ; ?>" target="_blank">View Return Requests</a></li>
                <li><a href="<?php echo JURI::base().'index.php?option=com_opencart&Itemid=484&route=account/transaction' ; ?>" target="_blank">My Transactions</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
<?php echo $script; ?>
</script>