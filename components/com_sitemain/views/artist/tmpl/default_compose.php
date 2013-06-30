<?php

defined('_JEXEC') or die('Restricted access');

?>
&nbsp;
<script>
    <?php $url = JUri::base()."index.php?option=com_sitemain&view=posts&format=raw&artist_id=".JRequest::getVar('artist_id') ?>
    loadJQContent('<?php echo $url ?>','artist_left_colume');
</script>