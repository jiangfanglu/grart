<?php
/*Artist network*/
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.folder');
?>
    <div class="left">
        <div class="heading">
                Your followers
       </div>
        <div style="width:435px;">
            <?php if(count($this->followers) == 0){ ?>
                <div class="not_found">
                    You do not have any followers <br/>
                    <a href="<?php echo Juri::base() ?>index.php?option=com_sitemain&view=">Promote yourself</a>
                </div>
            <?php }?>
            <?php 
            $n=0;
            foreach($this->followers as $f){ ?>
        <div class="user_item<?php echo $n%2==0 ? '_alt' : '' ?>">
            <div class="user_item_thumb">
                <?php
                $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.$f['follower']->follower_user_id;
                if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
                    if($f['follower'] == null){
                        $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                    }else{
                        $thumb_path = '/media/userthumbs/'.$f['follower']->follower_user_id.'/thumb_120.jpg';
                    }
                }else{
                    $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                }
                ?>
                <a href="<?php echo Juri::base() ?>index.php?option=com_sitemain&view=artist&artist_id=<?php echo $f['follower']->follower_user_id ?>">
                    <img src="<?php echo $thumb_path ?>" title="<?php echo $f['follower']->uname ?>">
                </a>
            </div>
            <div class="user_item_comment">
                <a href="<?php echo Juri::base() ?>index.php?option=com_sitemain&view=artist&artist_id=<?php echo $f['follower']->follower_user_id ?>">
                <?php echo $f['follower'] -> uname; ?></a><br/>
                <span>
                    A: <?php echo $f['follower_count'] ?> F: <?php echo $f['artwork_count'] ?>
                </span>
            </div>
        </div>
        
        
            <?php 
            $n++;
            } ?>
        
        </div>
                <div class="heading">
                Your followings
       </div>
        <div style="width:435px;">
            <?php if(count($this->followeings) == 0){ ?>
                <div class="not_found">
                    You are not following anyone <br/>
                    <a href="<?php echo Juri::base() ?>index.php?option=com_sitemain&view=artists">Discover your favourite artists here</a>
                </div>
            <?php }?>
            <?php 
            $n=0;
            foreach($this->followeings as $f){ ?>
        <div class="user_item<?php echo $n%2==0 ? '_alt' : '' ?>">
            <div class="user_item_thumb">
                <?php
                $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.$f['following']->follower_user_id;
                if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
                    if($f['following'] == null){
                        $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                    }else{
                        $thumb_path = '/media/userthumbs/'.$f['following']->follower_user_id.'/thumb_120.jpg';
                    }
                }else{
                    $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                }
                ?>
                <a href="<?php echo Juri::base() ?>index.php?option=com_sitemain&view=artist&artist_id=<?php echo $f['following']->follower_user_id ?>">
                    <img src="<?php echo $thumb_path ?>" title="<?php echo $f['following']->uname ?>">
                </a>
            </div>
            <div class="user_item_comment">
                <a href="<?php echo Juri::base() ?>index.php?option=com_sitemain&view=artist&artist_id=<?php echo $f['following']->follower_user_id ?>">
                <?php echo $f['following'] -> uname; ?></a><br/>
                <span>
                    A: <?php echo $f['follower_count'] ?> F: <?php echo $f['artwork_count'] ?>
                </span>
            </div>
        </div>
        
        
            <?php 
            $n++;
            } ?>
        
        </div>
    </div>
    <div class="right">
        <div class="heading" style="width:434px;">
                Reviews on all your products
       </div>
        <?php if(count($this->reviews) == 0){ ?>
                <div class="not_found">
                    Your products don not have any reviews yet
                </div>
            <?php }?>
          <?php 
          $n=0;
          foreach($this->reviews as $r){ 
              ?>
        
        <div class="comment_item<?php echo $n%2==0 ? '_alt' : '' ?>">
            <div class="comment_item_thumb">
                <?php
                $user_thumb_path = DS.'media'.DS.'userthumbs'.DS.$r['sender']->user_id;
                if(JFolder::exists(JPATH_SITE.$user_thumb_path)){
                    if($r['sender'] == null){
                        $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                    }else{
                        $thumb_path = '/media/userthumbs/'.$r['sender']->user_id.'/thumb_120.jpg';
                    }
                }else{
                    $thumb_path = '/templates/shop_template/images/default_thumb_120.jpg';
                }
                ?>
                <a href="">
                    <img src="<?php echo $thumb_path ?>" title="<?php echo $r['sender']->uname ?>">
                </a>
            </div>
            <div class="comment_item_comment">
                <a href="<?php echo Juri::base() ?>index.php?option=com_opencart&route=product/product&product_id=<?php echo $r['review_item']->product_id ?>">
                    <?php echo trim($r['review_item'] -> text) ?>
                </a>
                <br/>
                <span># <?php echo date('M d, Y',  strtotime($r['review_item']->date_added)) ?></span>
            </div>
            <div class="comment_item_art">
                <div class="comment_item_art_thumb">
                    <a href="<?php echo Juri::base() ?>index.php?option=com_opencart&route=product/product&product_id=<?php echo $r['review_item']->product_id ?>">
                        <img src="/media/uploaded_artwork/<?php echo $r['image_url']->user_id.'/200/'.$r['image_url']->filename ?>" title="<?php echo $r['image_url']->title ?>">
                    </a>
                </div>
            </div>
        </div>
          <?php 
          $n++;
          } ?>
    </div>