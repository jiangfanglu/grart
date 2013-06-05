<?php
defined('_JEXEC') or die('Restricted access');

$inital_vars=<<<EOD
var vars = {
            'init_x' : 150,
            'init_y' : 45,
            'init_width' : 60,
            'init_height' : 60,
            'IE':document.all?true:false,
            'tempX' : 0,
            'tempY' : 0,
            'dargging' : 0,
            'enlarge' : 0,
            'square' : 60,
            'mouseOffSet_x' : 0,
            'mouseOffSet_y' : 0,
            'start_point_x' : 0,
            'start_point_y' : 0,
            'start_point_width' : 0,
            'start_point_height' : 0,
            'ratio' : 1,
            'ctrl_size' : 5,
            'reszie_type' : 'se',
            'original_image_div_id' : 'taggedimg',
            'thumb_preview_div_outer' : 'preview_out',
            'thumb_preview_div_inner' : 'preview_in',
            'thumb_preview' : 'preview_img',
            'croping_url' : '/index.php?option=com_sitemain&task=createthumb' //parameters: x,y,width,height
    };
    window.addEvent("domready", function(){ init_croping(vars['init_x'],vars['init_y'],vars['init_width'],vars['init_height']); });

EOD;





$doc = & JFactory::getDocument();
$doc->addScriptDeclaration( $inital_vars );
?>
<div id="info_alert" class="alert alert-error" style="margin-top: 10px;display: none;">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <span id="info_text">
            &nbsp;
        </span>
</div>

<div id="taggedimg" onmouseup="enlarge_end()">
  <img src="/media/userthumbs/<?php echo $this->user->id ?>/temp_thumb.jpg" />
</div>

<div id="preview_out" style="display:none;">
  <div id="preview_in">
       <img src="/media/userthumbs/<?php echo $this->user->id ?>/temp_thumb.jpg" id="preview_img" />
</div>
</div>

<div id="mdiv" onmouseup="enlarge_end()">
  <div id="mdiv_left">
        <div id="mdiv_lt" onmousedown="enlarge_start('nw')" onmouseup="enlarge_end()"><!-- --></div>
        <div id="mdiv_lm"><!-- --></div>
        <div id="mdiv_lb" onmousedown="enlarge_start('sw')" onmouseup="enlarge_end()"><!-- --></div>
  </div>

  <div id="mdiv_center">
        <div id="mdiv_ct"><!-- --></div>
        <div id="mdiv_cm" onmousedown="startPoint()" onmouseup="endPoint()" ><!-- --></div>
        <div id="mdiv_cb"><!-- --></div>
  </div>

  <div id="mdiv_right">
        <div id="mdiv_rt" onmousedown="enlarge_start('ne')" onmouseup="enlarge_end()"><!-- --></div>
        <div id="mdiv_rm"><!-- --></div>
        <div id="mdiv_rb" onmousedown="enlarge_start('se')" onmouseup="enlarge_end()"><!-- --></div>
  </div>
</div>

<div>
  <input type="button" name="crop" value="Create Avartar" onclick="return cropImage(); " />
</div>

<div id="upload_avatar_photo_contianer">
    <div id="upload_avartar">
        <div id="ajax_loader" style="display:none;" ><img src="<?php echo $this->baseurl ?>/templates/shop_template/images/ajax-loader.gif" /></div>
    </div>
</div>

