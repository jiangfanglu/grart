<?php
    /*
     * com_sitemain, artistprofile
     */
   defined('_JEXEC') or die('Restricted access');
 
//$doc = & JFactory::getDocument();
//$doc->addScriptDeclaration( $ajax );
?>
<div class="form_body">
            <div class="form_line">
                <div class="form_label" style="width:600px;">Website</div>
                <div class="form_input">
                    <input type="text" style="width:839px;" id="websiteurl" name="websiteurl" value="<?php echo $this->artist->website_url?>" />
                </div>
                <div class="form_note">
                    <?php
                    if($this->artist->website_url == ""){
                        echo "You webiste is not provided. Having one can definitely drive more customers to your artworks.";
                    }
                    ?>
                </div>
            </div>
            
            <div class="form_line">
                <div class="form_label" style="width:600px;">Portfolio</div>
                <div class="form_input">
                    <textarea id="portfolio" style="width:859px;" name="portfolio"><?php echo $this->artist->portfolio?></textarea>
                </div>
                <div class="form_note"></div>
            </div>
            
            <div class="form_line">
                <div class="form_label">
                    
                </div>
                <div class="form_input">
                    <input type="hidden" value="<?php echo JFactory::getUser() -> id; ?>" id="user_id" name="user_id" />
                    <input type="button" onclick="updatePorto()" value="Update" id="btnSubmit" class="submit_btn" />
                </div>
                <div class="form_note">
                    
                    
                </div>
            </div>
</div>
