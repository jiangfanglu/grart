<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<?php //echo JText::_('RANDOM USERS'); ?>
<?php 
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
$actual_link = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?$_SERVER[QUERY_STRING]"; 
$_SESSION['redirect_after_login']=$actual_link;
?>
<ul class="user_status_btns"> 
<?php if ($user->guest) { ?>
<!--    <li><a href="/index.php?option=com_opencart&route=account/login">Login</a></li>-->
    <li><a id="main_login">Login</a>
    <li><a href="/index.php?option=com_opencart&route=account/register">Join</a></li>
    
<?php } else { ?>
    <li>Hi, <?php echo JFactory::getUser()->name ?></li>
    <li id="mymanager" onmouseover="showDropdown();"><a href="/index.php?option=com_sitemain&view=usermanager">My Manager</a></li>
    <li><a href="/index.php?option=com_sitemain&view=upload">Upload Artworks</a></li>
    <li><a href="/index.php?option=com_opencart&route=account/logout">Log out</a></li>
    
    
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