<?php
    /*
     * com_sitemain, artists
     */
   defined('_JEXEC') or die('Restricted access');
   jimport('joomla.filesystem.folder');
?>
<div class="artists_heading">
    <?php 
        if(isset($_GET['keyword'])){
            echo "Searched: '".$_GET['keyword']."'. Well, let's hope you have found we you have been looking for";
        }else{
            echo "Come meet our talent artists";
        }
    ?>
</div>
<div class="artists_list">
    <?php foreach($this -> artists as $flr){ 
        $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.(string)$flr['artist']->uid;
        if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
            $thumb_path = '/media/userthumbs/'.(string)$flr['artist']->uid.'/thumb_120.jpg';
        }else{
            $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
        }

        ?>
    <div class="p_artist_outter">
        <div class="p_artist_imgg"> 
            <a href="<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$flr['artist']->uid ;?>">
                <img src="<?php echo $thumb_path; ?>" />
            </a>
        </div>
        <div class="p_artist_frame" onclick="goartist('<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$flr['artist']->uid; ?>')">
            &nbsp;
        </div>
        
        <div class="p_artist_info">

                <a href='<?php echo JURI::base().'index.php?option=com_sitemain&view=artist&artist_id='.(string)$flr['artist']->uid ;?>'><?php echo $flr['artist']->name; ?></a><br/>
            <?php echo $flr['artist']->profile_value; ?>
        </div>
        <div class="p_artist_status">
            <img src="/templates/shop_template/images/artwork_logo.gif" title="Artworks" />
            <?php echo $flr['artwork_count']; ?> | 
            <img src="/templates/shop_template/images/fans_logo.gif" title="Followers" />
            <?php echo $flr['follower_count']; ?>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    function goartist(url){
        window.location.href = url;
    }
</script>