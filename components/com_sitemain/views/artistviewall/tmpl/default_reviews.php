<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.folder');
?>
<?php foreach($this->reviews as $r){ 
    $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.(string)$r['sender']->user_id;
    if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
        $thumb_path = '/media/userthumbs/'.(string)$r['sender']->user_id.'/thumb_120.jpg';
    }else{
        $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
    }
    ?>
<div style="width:870px;margin:0px 10px 5px 10px;background:#fff;">
    <div style="width:65px;padding:10px;">
        <a href="<?php echo Juri::base() ?>index.php?option=com_opencart&route=product/product&product_id=<?php echo $r['review_item']->product_id ?>">
            <img style="width:65px;" src="<?php echo juri::base().'media/uploaded_artwork/'.(string)$r['review_item']->user_id.'/200/'.$r['review_item']->filename ?>" title="<?php echo $r['review_item'] -> title ?>" alt="<?php echo $r['review_item'] -> title ?>" />
        </a>
    </div>
    <div  style="width:715px;padding-top: 10px;" >
        <div style="width:715px;font-style: italic;font-size: 16px;" >
            <a href="<?php echo Juri::base() ?>index.php?option=com_opencart&route=product/product&product_id=<?php echo $r['review_item']->product_id ?>">
            @<?php echo $r['review_item']->title ?>
            </a>
        </div>
        <div style="width:715px;font-size: 14px;padding:0px 0px 5px 5px;" >
            "<?php echo $r['review_item']->text ?>"
        </div>
        <div style="width:715px;font-size: 14px;color:#ccc;padding-bottom: 5px;" >
            Posted on <?php echo date('Y-m-d',  strtotime($r['review_item']->date_added)) ?>
        </div>
    </div>
    <div style="width:50px;padding:10px;" >
        <a href="<?php echo juri::base().'index.php?option=com_sitemain&view=artist&artist_id='.$r['sender']->user_id ?>">
            <img style="width:50px;"  src="<?php echo $thumb_path ?>" title="<?php echo $r['sender'] -> name ?>" alt="<?php echo $r['sender'] -> name ?>" />
        </a>
    </div>
</div>

<?php } ?>