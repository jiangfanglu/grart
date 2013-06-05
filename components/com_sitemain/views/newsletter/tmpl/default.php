<?php
/*News Ltter*/
defined('_JEXEC') or die('Restricted access');
?>
<div class="container">
    
    <div class="form_heading">
        Subscribe to Our News Letters
    </div>
    <div class="divder_bg">&nbsp;</div>
    <div id="info_alert" class="alert alert-error" style="display: <?php echo isset($_GET['msg']) ? 'block' : 'none' ?>;">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <span id="info_text"><?php echo isset($_GET['msg']) ? $_GET['msg'] : '' ?></span>
    </div>
    <div class="form_body">
        <?php if(!$this->subscribed){?>
        <form id="subscribe" action="<?php echo Juri::base().'index.php?option=com_sitemain&task=addnewslettersubscribtion' ?>" method="post"> <!--  -->
            <div class="form_line upload_width">
                <div class="form_label upload_width">Your EMAIL</div>
                <div class="form_input">
                    <input type="text" id="email" name="email" value="<?php echo isset($_POST['newsletter_email']) ? $_POST['newsletter_email'] : "" ?>" />
                </div>
                <div class="form_note"></div>
            </div>
            <div class="form_line upload_width">
                <div class="form_label upload_width">Your Name</div>
                <div class="form_input">
                    <input type="text" id="mail_name" name="mail_name" value="" />
                </div>
                <div class="form_note"></div>
            </div>
            <div class="form_line upload_width">
                <div class="form_label upload_width">Topics</div>
                <div class="form_input">
                    <?php foreach($this->categories as $c){ ?>
                            <input type="checkbox" id="Topics[]" name="Topics[]" value="<?php echo $c->id?>" />
                            <label><?php echo $c->value ?></label>
                    <?php } ?> 
                </div>
                <div class="form_note"></div>
            </div>
            <div class="form_line upload_width">
                <div class="form_label upload_width"></div>
                <div class="form_input">
                    <input type="submit" name="submit" id="submit" class="submit_btn" value="Subcribe" />
                </div>
                <div class="form_note"></div>
            </div>
        </form>
        <?php }else{ ?>
        <form id="unsubcribe" action="<?php echo Juri::base().'index.php?option=com_sitemain&task=deletenewslettersubscribtion' ?>" method="post">
            <div class="form_line upload_width">
                <div class="form_label upload_width">Your subscribed EMAIL</div>
                <div class="form_input">
                    <input type="text" id="email" name="email" value="<?php echo isset($_POST['newsletter_email']) ? $_POST['newsletter_email'] : "" ?>" />
                </div>
                <div class="form_note"></div>
            </div>
            <div class="form_line upload_width">
                <div class="form_label upload_width"></div>
                <div class="form_input">
                    <input type="submit" name="submit" id="submit" class="submit_btn" value="Unsubcribe" />
                </div>
                <div class="form_note"></div>
            </div>
        </form>
        <?php } ?>
    </div>
</div>
