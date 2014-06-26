<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

 

<div class="login-content" style="padding-top:30px;">
    <div class="left">
        <div class="content">
            <div class="heading1">Join Us As</div>
            
            <div class="desc_colum">
                    Artist
                    <ul>
                        <li>Create your profile</li>
                        <li>Upload your artworks and share</li>
                        <li>Sell copies of your artworks, and get paid by us</li>
                        <li>Interact with your followers</li>
                        <li>Buy art supplies at low prices with your credits from selling</li>
                    </ul>
                </div>
            <div class="or_divide" style="padding-right: 20px;padding-top: 10px;">
                <img src="/templates/shop_template/images/or.png" />
            </div>
                <div class="desc_colum">
                    Regular User
                    <ul>
                        <li>Explore a world of art</li>
                        <li>Buy framed or unframed prints and crafts from our artists</li>
                        <li>Get along with your favourite artist and share</li>
                        <li>Check out the latest exhibition of our artists</li>
                    </ul>
                </div>
            <p style="font-size: 14px;">Or, you can be both...</p>
            <div style="width:400px;">
                 <input type="button" id="login_signup_btn" value="Create Account" class="product-button" />
                 <script>
                     $("#login_signup_btn").click(function(){
                            document.location.href = '<?php echo $register; ?>';
                        });
             </script>
            </div>
        </div>
        </div>
    <div class="right">
        <div class="or_divide" style="padding-right: 20px;padding-top: 80px;">
                <img src="/templates/shop_template/images/or.png" />
       </div>
        <div id="login_in">
           <div id="l_heading">
                <div class="leftt">Member Login</div>
                <div class="rightt"> <a href="<?php echo JUri::base() ?>index.php?option=com_opencart&route=account/forgotten">Forgotten Password</a></div>

            </div>
            <form action="<?php echo JUri::base() ?>index.php?option=com_opencart&route=account/login" method="post" enctype="multipart/form-data">

            <div class="l_content">
                <input type="text" id="loginn_email" name="email" value="Email" />
            </div>
            <div class="l_content">
                <input type="password" id="loginn_password" name="password" value="Password" />
            </div>
            <div class="l_button">
                <input type="submit" value="Login" class="product-button" />
            </div>
                </form>
        </div>
    </div>
  </div>
<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#login').submit();
	}
});
//--></script> 
<script>
jQuery("#loginn_email").focus(function(){
if (this.value == "Email")
{
    this.value = "";
    jQuery(this).css('color','#2e2d2d');
 }
});
jQuery("#loginn_password").focus(function(){
if (this.value == "Password")
{
    this.value = "";
    jQuery(this).css('color','#2e2d2d');
 }
});
jQuery("#loginn_email").blur(function(){

    if (this.value == "")
    {
        this.value = "Email";
        jQuery(this).css('color','#ccc');
    }
});
jQuery("#loginn_password").blur(function(){

    if (this.value == "")
    {
        this.value = "Password";
        jQuery(this).css('color','#ccc');
    }
});
</script>