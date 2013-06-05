<?php
defined('_JEXEC') or die('Restricted access');
 JHtml::_('behavior.tooltip');
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
            <!-- <a href="<?php echo JURI::base() ?>index.php?option=com_opencart&amp;route=common/home&amp;token=132e5e4de34e7bde5a9b2fac6a490269">Home</a>-->
        </div>
        <div class="box">

            <div class="heading">
                <h1><img src="../components/com_opencart/admin/view/image/home.png" alt="^-^">Edit</h1>

            </div>


            <div class="content_dyn"> 
                <?php
                if (isset($this->new_approved_result)) {
                    echo "<p>" . $this->new_approved_result . "</p>";
                } elseif (isset($this->new_saved_msg)) {
                    echo "<p>" . $this->new_saved_msg . "</p>";
                }
                ?>

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
                    <?php foreach ($this->approved_artworks as $approved_artwork) { ?>
                        <tr>

                            <td><?php echo $approved_artwork->id; ?></td>
                            <td><?php echo $approved_artwork->artwork_id; ?></td>
                            <td><?php echo $approved_artwork->artwork_image_id; ?></td>
                            <td><?php echo $approved_artwork->product_id; ?></td>
                            <td><?php echo $approved_artwork->status; ?></td>
                            <td>
                                <form action="<?php echo JURI::base() . 'index.php?option=com_grart&view=editArtwork_publish_table' ?>" method="post" id="form"   >
                                    <input type="submit" name="edit" id="edit" value="Edit" />
                                    <input type="hidden" id="art-id" name="art-id" value = "<?php echo $approved_artwork->artwork_id; ?>" />
                                </form></td>
                        </tr>
                    <?php } ?>
                  
                </table>
                <div id="pagination" >
                    <form name="adminForm" id="adminForm" method="post" action="<?php echo JURI::base() . 'index.php?option=com_grart&view=approve' ?>"  >
                        <?php echo $this->pagination->getListFooter(); ?>
                      <!--  <input type="hidden" name="view" value="approve" />-->
                    </form>
                </div>

            </div>
        </div>
    </div>