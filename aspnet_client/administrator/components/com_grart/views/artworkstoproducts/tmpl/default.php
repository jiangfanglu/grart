<?php
defined('_JEXEC') or die('Restricted access');
?>
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
<?php if(!isset($_GET['format'])){ ?>
<h2>Transfer artworks to products</h2>
<form id="filter" action="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=filter'?>" method="post">
    <fieldset>
        <legend>Filter</legend>
        <input type="text" name="filter_key" id="fitler_key" />
        <select id="filter_type" name="filter_type">
            <option value="artwork_id">Artwork ID</option>
            <option value="artwork_title">Artwork Title</option>
            <option value="artist_name">Artist Name</option>
            <option value="description">Keyword in Description</option>
        </select>
        <input type="submit" name="submit" value="Update" onclick="" />
    </fieldset>
</form>
<form id="change_limit" action="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=pagelimit'?>" method="post">
    <table style="border:0px;">
        <tr style="border:0px;">
            <td>
                Show
            </td>
            <td>
                <select name="page_limit" id="page_limit" style="width:auto!important;">
                    
                    <option value="20" <?php echo isset($_POST['page_limit']) && $_POST['page_limit'] == '20' ? 'selected' : '' ?> >20</option>
                    <option value="50" <?php echo isset($_POST['page_limit']) && $_POST['page_limit'] == '50' ? 'selected' : '' ?> >50</option>
                    <option value="100" <?php echo isset($_POST['page_limit']) && $_POST['page_limit'] == '100' ? 'selected' : '' ?> >100</option>
                </select>
            </td>
            <td>per page</td>
            
        </tr>
    </table>
</form>
<script>
    jQuery('#page_limit').change(function(){
        jQuery('#change_limit').submit();
    });
</script>
<?php } ?>
<form id="approving" action="<?php echo JUri::base().'index.php?option=com_grart&task=addArtworkToProducts'?>" method="post" >
<div id="atp_content" style="width:100%;">
    <table class="list">
        <tr>
            <th>
                <input type="checkbox" name="select_item" id="select_item" value="aosdjiadjasidjai" />
            </th>
            <th colspan="7" style="text-align: left!important;padding:3px;">
                <input type="submit" name="patch_aprove" id="patch_aprove" value="aprove"/>
            </th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>Image</th>
            <th><a href="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=order&order_filter=artwork_id'?>">Artwork ID</a></th>
            <th><a href="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=order&order_filter=title'?>">Title</a></th>
            <th><a href="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=order&order_filter=name'?>">Artist</a></th>
            <th><a href="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=order&order_filter=userid'?>">Artist ID</a></th>
            <th><a href="<?php echo JUri::base().'index.php?option=com_grart&view=artworkstoproducts&query_type=order&order_filter=date'?>">Created at</a></th>
            <th>Status</th>
        </tr>
        <?php foreach($this->artworks as $a){ ?>
            <tr>
                <td>
                    <input type="checkbox" id="select_artworks[]" name="select_artworks[]" value="<?php echo $a->artwork_id ?>" />
                </td>
                <td>
                    <a onclick="javascript:showDisplay('display_<?php echo $a->artwork_id ?>',1);">
                        <img src="<?php echo '/media/uploaded_artwork/'.$a->user_id.'/200/'.$a->filename ?>" style="width:70px;" />
                    </a>
                    
                </td>
                <td><?php echo $a->artwork_id ?></td>
                <td><?php echo $a->title ?></td>
                <td><?php echo $a->name ?></td>
                <td><?php echo $a->user_id ?></td>
                <td><?php echo $a->created ?></td>
                <td><?php echo $a->status ?></td>
            </tr>
            <tr style="display:none;" id="display_<?php echo $a->artwork_id ?>">
                <td><a onclick="javascript:showDisplay('display_<?php echo $a->artwork_id ?>',0);">x</a></td>
                <td colspan="7">
                    <table>
                        <tr>
                            <td>
                                <a href="<?php echo '/media/uploaded_artwork/'.$a->filename ?>" target="_blank">
                                    <img src="<?php echo '/media/uploaded_artwork/'.$a->user_id.'/200/'.$a->filename ?>" />
                                </a>
                            </td>
                            <td>
                                <table>
                                    <tr><td><?php echo $a->title ?></td></tr>
                                    <tr><td><?php echo $a->description ?></td></tr>
                                    <tr><td><?php echo $a->meta_desc ?></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</form>
<script>
    jQuery('#select_item').change(function(){
        jQuery('#approving input:checkbox').each(function(){
            if(jQuery(this).val() != jQuery('#select_item').val()){
                if(jQuery(this).is(':checked')) {
                    jQuery(this).prop('checked',false);
                } else {
                    jQuery(this).prop('checked',true);
                }
            }
        });
    });
</script>
<script>
    function showDisplay(id,status){
        switch(status){
            case 1:
                document.getElementById(id).style.display = "table-row";
                break;
            case 0:
                document.getElementById(id).style.display = "none";
                break;
            default:
                return;
        }
    }
</script>