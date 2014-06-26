<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>

<?php
if (isset($_GET['format']) && $_GET['format'] == 'raw') {
    echo $this->loadTemplate('single_feature');
} else {
    ?>


    <div id="container_ext">
         <div id="header_ext">  
    <div id="menu_ext">
        <ul class="left sf-js-enabled" style="display: block;">
<li id="dashboard" ><a href="<?php echo JURI::base() . 'index.php?option=com_grart&view=artworkstoproducts' ?>" class="top">APPROVE</a></li>
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
                    <h1><img src="../components/com_opencart/admin/view/image/home.png" alt="^-^">Feature</h1>

                </div>

                <div class="content_dyn" id="content_dyn"> 

                    <h2><?php  echo $this->feature_result;?></h2>
                  
                    <table class="table-general">
                        <thead>
                            <tr>

                                <th>Artwork_id</th>
                                <th>Title</th>                            
                                <th>Product_id</th>
                                <th>Filename</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Category</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
    <?php foreach ($this->recent_products as $recent_product) { ?>
                            <tr>

                                <td><?php echo $recent_product->artwork_id; ?></td>
                                <td><?php echo $recent_product->title; ?></td>
                                <td><?php echo $recent_product->product_id; ?></td>
                                <td><?php echo $recent_product->filename; ?></td>
                                <td><?php echo $recent_product->username; ?></td>
                                <td><?php echo $recent_product->email; ?></td>
                                <td><?php echo $recent_product->category_name; ?></td>
                                <td>
                                    <input type="submit" name="feature" id="feature" value="Feature Me" 
                                           onclick =" return display_one_feature('content_dyn','_<?php echo $recent_product->artwork_id ?>', '<?php echo JURI::base() . 'index.php?option=com_grart&view=editFeatured&format=raw' ?>');"/>
                                    <input type="hidden" id="product_id_<?php echo $recent_product->artwork_id ?>" name="product_id_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->product_id; ?>" />
                                    <input type="hidden" id="title_<?php echo $recent_product->artwork_id ?>" name="title_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->title; ?>" />
                                    <input type="hidden" id="artwork_id_<?php echo $recent_product->artwork_id ?>" name="artwork_id_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->artwork_id; ?>" />
                                    <input type="hidden" id="category_name_<?php echo $recent_product->artwork_id ?>" name="category_name_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->category_name; ?>" />
                                    <input type="hidden" id="username_<?php echo $recent_product->artwork_id ?>" name="username_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->username; ?>" />
                                    <input type="hidden" id="email_<?php echo $recent_product->artwork_id ?>" name="email_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->email; ?>" />
<input type="hidden" id="category_id_<?php echo $recent_product->artwork_id ?>" name="category_id_<?php echo $recent_product->artwork_id ?>" value = "<?php echo $recent_product->category_id; ?>" />

                                   </td>
                            </tr>
    <?php } ?>

                    </table>
                    <div id="pagination" >
                        <form name="adminForm" id="adminForm" method="post" action="<?php echo JURI::base() ?>index.php?option=com_grart&view=editFutured"  >
    <?php echo $this->pagination->getListFooter(); ?>
                          <!--  <input type="hidden" name="view" value="approve" />-->
                        </form>
                    </div>

                </div>
            </div>
        </div>
<?php } ?>