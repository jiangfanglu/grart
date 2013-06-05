<?php
defined('_JEXEC') or die('Restricted access');
?>
<div id="container_ext">
   <div id="header_ext">  
    <div id="menu_ext">
        <ul class="left sf-js-enabled" style="display: block;">
                <li id="dashboard" ><a href="<?php echo JURI::base() . 'index.php?option=com_grart&view=artworkstoproducts' ?>" class="top">APPROVE</a></li>
                <li id="dashboard" ><a href="<?php echo JURI::base() . 'index.php?option=com_grart&view=newsletter' ?>" class="top">Newsletter</a></li>
                <li id="dashboard" ><a href="<?php echo JURI::base() . 'index.php?option=com_grart&view=printoptions' ?>" class="top">Printing Options</a></li>
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
                <h1><img src="../components/com_opencart/admin/view/image/home.png" alt="^-^"> APPROVAL</h1>
                <div class="buttons">
                    <input type="submit" id="approval" name ="approval" value="Approve" onclick="jQuery('#form').attr('action', '<?php echo JURI::base() . 'index.php?option=com_grart&view=approve' ?>');
                            jQuery('#form').submit();"/>
                </div>
            </div>
            <div class="content_ext"> 

                <form action="<?php echo JURI::base() . 'index.php?option=com_grart&view=approve' ?>" method="post" id="form"   >
                    <table class="table-general">
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="jQuery('input[name*=\'selected\']').attr('checked', this.checked);" /></th>

                                <th>Artwork_id</th>
                                <th>User_id</th>
                                <th>Category_id</th>
                                <th>title</th>
                                <th>description</th>
<!--                                <th>filename</th>-->
                                <th>status</th>

                            </tr>
                        </thead>
                        <?php foreach ($this->artworks as $artwork) { ?>
                            <tr>
                                <td><input type="checkbox" class ="artwork"  name ="selected[]" value="<?php echo $artwork->id; ?>"/></td>
                                <td><?php echo $artwork->id; ?></td>
                                <td><?php echo $artwork->user_id; ?></td>
                                <td><?php echo $artwork->category_id; ?></td>
                                <td><?php echo $artwork->title; ?></td>
                                <td><?php echo substr($artwork->description, 0,50); ?></td>
<!--                                <td><?php echo $artwork->filename; ?></td>-->
                                <td><?php echo $artwork->status; ?></td>
                            </tr>



                        <?php } ?>
                    </table>
<div id="pagination" >
                    <form name="adminForm" id="adminForm" method="post" action="<?php echo JURI::base() . 'index.php?option=com_grart&view=grart' ?>"  >
                        <?php echo $this->pagination->getListFooter(); ?>
                      <!--  <input type="hidden" name="view" value="approve" />-->
                    </form>
                </div>

                    <div class="buttons">
                        <input type="submit" id="approval" name ="approval" value="Approve" onclick="jQuery('#form').attr('action', '<?php echo JURI::base() . 'index.php?option=com_grart&view=approve' ?>');
                            jQuery('#form').submit();"/>
                    </div>


                </form>
                
            </div>

        </div>
    </div>
</div>