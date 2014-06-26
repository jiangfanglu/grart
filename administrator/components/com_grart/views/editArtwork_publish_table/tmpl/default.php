<?php
defined('_JEXEC') or die('Restricted access');
?>
<div id="container_ext">
    <div id="header_ext">  
        <div id="menu_ext">
            <ul class="left sf-js-enabled" style="display: block;">
         <li id="dashboard" ><a href="<?php echo JURI::base() . 'index.php?option=com_grart' ?>" class="top">APPROVE</a></li>
                    <li id="catalog" class=""><a href="<?php echo JURI::base() . 'index.php?option=com_grart&view=approve' ?>" class="top">Approved Artwork</a>
                    <li id="catalog" class="" class="selected"><a href="<?php echo JURI::base() . 'index.php?option=com_grart&view=editFeatured' ?>" class="top">Feature</a>
            </ul>
        </div>  
    </div>          
    <div id="content_ext">
        <div class="breadcrumb_ext">
            <!-- <a href="<?php echo JURI::base() ?>administrator/index.php?option=com_opencart&amp;route=common/home&amp;token=132e5e4de34e7bde5a9b2fac6a490269">Home</a>-->
        </div>
        <div class="box">

            <div class="heading">
                <h1><img src="../components/com_opencart/admin/view/image/home.png" alt="^-^"> Edit</h1>

            </div>


            <div class="content_ext"> 
                   <table class="table-general">
                    <thead>
                        <tr>
                           
                            <th>Approved_id</th>
                            <th>Artwork_id</th>
                            <th>Artwork_image_id</th>
                            <th>Product_id</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                  
                
                    <?php foreach ($this->approved_artworks as $approved_artwork) {
                       
                        if ($this->edit_artwork_id != $approved_artwork->artwork_id) {//if this artwork is not the one for edit.
                            ?>
                            <tr>
                                
                                <td><?php echo $approved_artwork->id; ?></td>
                                <td><?php echo $approved_artwork->artwork_id; ?></td>
                                <td><?php echo $approved_artwork->artwork_image_id; ?></td>
                                <td><?php echo $approved_artwork->product_id; ?></td>
                                <td><?php echo $approved_artwork->status; ?></td>
                                <td>
                                    <form action="<?php echo JURI::base() ?>index.php?option=com_grart&view=approve" method="post" id="form"   >
                                        <input type="submit" name="edit" id="edit" value="Edit" disabled="disabled"/>
                                        <input type="hidden" id="art-id" name="art-id" value = "<?php echo $approved_artwork->artwork_id; ?>" />
                                    </form></td>
                            </tr>



                        <?php
                        } else {//the artwork which is in edit mode
                            ?>
                            <form action="<?php echo JURI::base() ?>index.php?option=com_grart&view=approve" method="post" id="form"   >
                            <tr>
                              
                                <td><?php echo $approved_artwork->id; ?></td>
                                <td><?php echo $approved_artwork->artwork_id; ?></td>
                                <td><input type="text" id="artwork_image_id" name="artwork_image_id" value="<?php echo $approved_artwork->artwork_image_id; ?>" /></td>
                                <td><input type="text" id="product_id" name="product_id" size="6" value ="<?php echo $approved_artwork->product_id; ?>"/></td>
                                <td><input type="text" id="status1" name="status1" size ="3" value="<?php echo $approved_artwork->status; ?>"/></td>
                                <td>
                                    
                                        <input type="submit" name="save" id="save" value="save" />
                                        <input type="hidden" id="art-id" name="art-id" value = "<?php echo $approved_artwork->artwork_id; ?>" />
                                  </td>
                          
                            </tr>
                   </form>
                            <?php
                        }
                    }
                    ?>
                </table>


            </div>

        </div>
    </div>
</div>