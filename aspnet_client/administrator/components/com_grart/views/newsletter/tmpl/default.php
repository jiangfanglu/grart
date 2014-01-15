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
    <div>
        <form action="<?php echo JUri::base().'index.php?option=com_grart&task=sendEmails'?>"  method="post" enctype="multipart/form-data">
        <h1>Send newsletters</h1>
        <h4>Select a user group</h4>
        <p>
            <select name="user_group" id="user_group">
                <?php foreach($this->categories as $category){ ?>
                   <option value="<?php echo $category->id ?>"><?php echo $category->value ?></option>
                <?php } ?>
            </select>
        </p>
        <h4>Email subject</h4>
        <p>
            <input type="text" name="subject" id="subject" />
        </p>
        <h4>Upload Email HTML file</h4>
        <p><input type="file" name="template" id="template" /></p>
        <p><input type="submit" value="Send" name="submit" /></p>
        </form>
    </div>
</div>