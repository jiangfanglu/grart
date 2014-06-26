<?php
/*sitemain/artwork*/
defined('_JEXEC') or die('Restricted access');

?>
    
    <?php if(count($this -> images)>0){ ?>

<div id="artwork_main_top">
            <div class="form_label artwork_width">
                Images Of This Artwork
            </div>
            <div id="artwork_main_small">
                <?php 
                    foreach($this -> artimages as $img){
                        $imgname = $img->filename;
                        ?>
                <div style="width:80px;">
                <div class='artwork_main_small_in' id="frame_<?php echo $img-> id ?>">
                    <a rel="lightbox[artwork]" title="FILE" href="<?php echo JURI::base().'media'.DS.'uploaded_artwork'.DS.$this->user->id.DS.$imgname ?>">     
                   <?php echo "<img class='little_thumb' src='".DS.'media'.DS.'uploaded_artwork'.DS.$this->user->id.DS.'200'.DS.$imgname."'/>"; ?>
                    </a>
                </div>
                <div id="<?php echo 'set_primary_check'.$img-> id ?>" style="padding-left:35px;">
                    <input type="radio" name="artwork_primary" id="artwork_primary" value="<?php echo $img-> artwork_id."_".$img-> id ?>" <?php echo $img->hero == 1 ? 'checked' : '' ?> />
                </div>
                    </div>
               <?php
                        }
                ?>
            </div>
    <div class="form_note" style="width:600px!important;">"SET PRIMARY" lets you to choose which image in this set to display as the product thumbnail.</div>
    <div style="width:100%;">
        <input type="button" id="setprimary_btn" class="submit_btn" value="SET PRIMARY" onclick="setPrimary();" />
    </div>
</div>
        
        <div id="artwork_main_down">
            
            <form id="artwork_form">
                <div class="form_line artwork_width">
                    <div class="form_label">
                        Title:
                    </div>
                    <div class="form_input">
                            <input class="grart artwork_widthedit" type="text" id="title" name="title" value="<?php echo $this -> artwork -> title ; ?>" />
                    </div>
<!--                    <input type="hidden" id="hidden_title" name="hidden_title" value="<?php echo $this -> artwork -> title ; ?>" />-->
                </div>
                
                <div class="form_line artwork_width">
                    <div class="form_label">Meta Description: 
                    </div>
                    <div class="form_input">
                        <textarea class="grart artwork_widthedit" id="meta_desc" name="meta_desc" ><?php echo $this -> artwork -> meta_desc ; ?></textarea>
                    </div>
                </div>
                
                <div class="form_line artwork_width">
                    <div class="form_label">Description: 
                    </div>
                    <div class="value_line">
                        <textarea class="grart artwork_widthedit" id="description" name="description" rows="10" ><?php echo $this -> artwork -> description ; ?></textarea>
                    </div>
                </div>
                <div class="form_line artwork_width">
                    <div class="form_label artwork_width">Category: 
                    </div>
                    <div class="value_line">
                        <select id="category_id" name="category_id" class="grart">
                            <option value="0">Please select</option>
                            
                             <?php
                             $artwork_category_id = $this -> artwork -> category_id;
                            foreach($this -> categories as $cate){
                                 echo $cate['children'];
                                 if(count($cate['children'])>0 ){
                                     echo "<optgroup label='".$cate['parent']->name."'>";
                                    foreach($cate['children'] as $ca){
                                        if($ca->category_id == $artwork_category_id){
                                            echo "<option selected='selected' class='child_option' value='".$ca->category_id."'>".$ca->name."</option>";
                                        }else{
                                            echo "<option class='child_option' value='".$ca->category_id."'>".$ca->name."</option>";
                                        }
                                        
                                    }
                                    echo "</optgroup>";
                                 }else{
                                     if($cate['parent']->category_id == $artwork_category_id){
                                          echo "<option selected='selected' class='parent_option' value='".$cate['parent']->category_id."'>".$cate['parent']->name."</option>";  
                                    }else{
                                        echo "<option class='parent_option' value='".$cate['parent']->category_id."'>".$cate['parent']->name."</option>";
                                    }
                                     
                                 }

                            }
                            ?>
                        </select>
                    
                    </div>
               </div>
                <div class="form_line artwork_width">
                    <div class="form_label artwork_width">Artwork Status: </div>
                    <div class="value_line">
                    <div id="text_status"><?php echo $this -> status ; ?></div>
                    </div>
                </div>
                <input class="submit_btn" type="button" value="Update" id="submit_btn" onclick="updateArwork();" />
                <input class="delete_btn" type="button" value="Caution!! Delete This Artwork" id="delete_btn" onclick="return confirmDelete('/index.php?option=com_sitemain&format=raw&task=deleteartwork&artwork_id=<?php echo $this -> artwork -> id; ?>');" />
                <input type="hidden" id="hidden_artwork_id" name="hidden_artwork_id" value="<?php echo $this -> artwork -> id ; ?>" />
            </form>
            
        </div>
    
    <?php } ?>
