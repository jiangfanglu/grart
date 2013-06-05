<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.module.helper');
$module = JModuleHelper::getModule('mod_simplefileuploadv1.3','Simple File Upload v1.3');
?>

<div class="container">
    <h3>Upload your artwork</h3>
    <div>
        <?php echo JModuleHelper::renderModule($module); ?>
    </div>
</div>