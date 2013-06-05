function closeInfoAlert(){
    $('info_alert').style.display = 'none';
}
function closeStuff(id){
    $(id).style.display = 'none';
}
 function showStuff(t,s, left,top){
    $(s).style.display = 'block';
    var position = xy(t);
    $(s).style.left = position[0]+ left + 'px';
    $(s).style.top = position[1] + top + 'px';
    return false;
}

//IMAGE CROPING JS
//COPY RIGHT FANGLU JIANG
function $(obj){
    return document.getElementById(obj);
}

function setCaptionText(text){
    $('img_caption_text').innerHTML = text;
}
function setCaptionText_fixed(text){
    $('img_caption_text_fixed').innerHTML = text;
}


function init_croping(x,y,width,height){
        vars['IE'] = document.all?true:false;
        if (!vars['IE']) document.captureEvents(Event.MOUSEMOVE);
        document.onmousemove = getMouseXY;
        document.onmousedown = disabletext;
         $(vars['thumb_preview_div_outer']).style.width = width +"px";
         $(vars['thumb_preview_div_outer']).style.height = height +"px";
         $('mdiv').style.top = y + vars['ctrl_size']*2 +"px";
         $('mdiv').style.left = x + vars['ctrl_size']*2 + "px";
         $('mdiv').style.width = width + vars['ctrl_size']*2 + "px";
         $('mdiv').style.height = height + vars['ctrl_size']*2 + "px";
}
function disabletext(e){
    return false;
}
function updateSelectedArea(var_size){
    setting_size = var_size

    if(getDivWidth(vars['original_image_div_id'])>=getDivHeight(vars['original_image_div_id'])){
        if(setting_size >= getDivHeight(vars['original_image_div_id'])){
            setting_size = getDivHeight(vars['original_image_div_id'])
        }
    }else{
        if(setting_size >= getDivWidth(vars['original_image_div_id'])){
            setting_size = getDivWidth(vars['original_image_div_id'])
        }
    }

    var size = setting_size + vars['ctrl_size']*2 + "px";
    var size_inner = setting_size + "px";

    vars['ratio'] = vars['square']/setting_size
    $(vars['thumb_preview']).style.width = getDivWidth(vars['original_image_div_id'])*vars['ratio'];
    $(vars['thumb_preview']).style.height = getDivHeight(vars['original_image_div_id'])*vars['ratio'];

    $('mdiv').style.width = size;
    $('mdiv').style.height = size;
    $('mdiv_cm').style.width = size_inner;
    $('mdiv_cm').style.height = size_inner;

    $('mdiv_left').style.height = size;
    $('mdiv_center').style.width = size_inner;
    $('mdiv_center').style.height = size;
    $('mdiv_right').style.height = size;

    $('mdiv_ct').style.width = size_inner;
    $('mdiv_cb').style.width = size_inner;
    $('mdiv_lm').style.height = size_inner;
    $('mdiv_rm').style.height = size_inner;

    if((getDivY('mdiv')+getDivHeight('mdiv'))>(getDivY(vars['original_image_div_id'])+getDivHeight(vars['original_image_div_id']))){
        $('mdiv').style.top = getDivY(vars['original_image_div_id'])+getDivHeight(vars['original_image_div_id']) - getDivHeight('mdiv');
    }
    if((getDivX('mdiv')+getDivWidth('mdiv'))>(getDivX(vars['original_image_div_id'])+getDivWidth(vars['original_image_div_id']))){
        $('mdiv').style.left = getDivX(vars['original_image_div_id'])+getDivWidth(vars['original_image_div_id']) - getDivWidth('mdiv');
    }
	return false;
}

function enlarge_start(type){
    vars['reszie_type'] = type;
    vars['dargging']=1;
    vars['enlarge']=1;
    vars['start_point_x'] = getDivX('mdiv');
    vars['start_point_y'] = getDivY('mdiv');
    vars['start_point_width'] = getDivWidth('mdiv');
    vars['start_point_height'] = getDivHeight('mdiv');
	return false;
}

function enlarge_end(){
    vars['dargging']=0
    vars['enlarge']=0
    savePosition(getDivX(vars['original_image_div_id']),getDivY(vars['original_image_div_id']));
	return false;
}

function startPoint(){
    vars['dargging']=1;
    vars['mouseOffSet_x'] = vars['tempX']-getDivX('mdiv');
    vars['mouseOffSet_y'] = vars['tempY']-getDivY('mdiv');
	return false;
}

function endPoint(){
    vars['dargging']=0;
    savePosition(getDivX(vars['original_image_div_id']),getDivY(vars['original_image_div_id']));
	return false;
}

function getDivX(target){
    return $(target).offsetLeft;
}
function getDivY(target){
    return $(target).offsetTop;
}
function getDivWidth(target){
    return $(target).offsetWidth;
}
function getDivHeight(target){
    return $(target).offsetHeight;
}

function savePosition(x,y){
    $(vars['thumb_preview_div_inner']).style.marginLeft = "-"+(getDivX('mdiv')-x + vars['ctrl_size'])*vars['ratio']+'px';
    $(vars['thumb_preview_div_inner']).style.marginTop = "-"+(getDivY('mdiv')-y + vars['ctrl_size'])*vars['ratio']+'px';
	return false;
}
function cropImage(){
    var selected_width = getDivWidth('mdiv') - vars['ctrl_size']*2;
    var selected_x = getDivX('mdiv') - getDivX(vars['original_image_div_id']) + vars['ctrl_size'];
    var selected_y = getDivY('mdiv') - getDivY(vars['original_image_div_id']) + vars['ctrl_size'];
    output = "x=" +  selected_x + "&y=" + selected_y+"&width="+selected_width+"&height="+selected_width;
    doAjax(vars['croping_url'],selected_x,selected_y,selected_width,selected_width);
    return false;
}

function getMouseXY(e) {
  if (vars['IE']) { 
    vars['tempX'] = event.clientX + document.body.scrollLeft;
    vars['tempY'] = event.clientY + document.body.scrollTop;
  } else {  
    vars['tempX'] = e.pageX;
    vars['tempY'] = e.pageY;
  }  
  if (vars['tempX'] < 0){vars['tempX'] = 0}
  if (vars['tempY'] < 0){vars['tempY'] = 0}

  if(vars['dargging']==1){
        if(vars['enlarge'] == 1){
            if(vars['reszie_type'] == "nw"){
                diff_x = vars['start_point_x'] - vars['tempX'];
                diff_y = vars['start_point_y'] - vars['tempY'];
                if(diff_x >= diff_y){
                    $('mdiv').style.left = vars['tempX'] + "px";
                    $('mdiv').style.top = vars['start_point_y'] - diff_x + "px";
                    current_width = vars['start_point_width'] + diff_x - vars['ctrl_size']*2;
                }else{
                    $('mdiv').style.left = vars['start_point_x'] - diff_y + "px";
                    $('mdiv').style.top = vars['tempY'] + "px";
                    current_width = vars['start_point_height'] + diff_y - vars['ctrl_size']*2;
                }
            }else if(vars['reszie_type'] == "ne"){
                diff = vars['tempY'] - vars['start_point_y'];
                $('mdiv').style.left = vars['start_point_x'] + "px";
                $('mdiv').style.top = vars['tempY'] + "px";
                current_width = vars['start_point_height'] - diff - vars['ctrl_size']*2;
            }else if(vars['reszie_type'] == "sw"){
                diff_x = vars['start_point_x'] - vars['tempX'];
                diff_y = vars['tempY'] - (vars['start_point_y']+vars['start_point_height']);

                if(diff_x >= diff_y){
                    $('mdiv').style.left = vars['tempX'] + "px";
                    $('mdiv').style.top = vars['start_point_y'] + "px";
                    current_width = vars['start_point_width'] + diff_x - vars['ctrl_size']*2;
                }else{
                    $('mdiv').style.left = vars['start_point_x'] - diff_y + "px";
                    $('mdiv').style.top = vars['start_point_y'] + "px";
                    current_width = vars['start_point_height'] + diff_y - vars['ctrl_size']*2;
                }
            }else{
                $('mdiv').style.left = vars['start_point_x'] + "px";
                 $('mdiv').style.top = vars['start_point_y'] + "px";
                current_width = vars['tempX'] - getDivX('mdiv') - vars['ctrl_size'];
            }
            $(vars['thumb_preview_div_inner']).style.marginLeft = "-"+(getDivX('mdiv')-getDivX(vars['original_image_div_id']) + vars['ctrl_size'])*vars['ratio']+'px';
            $(vars['thumb_preview_div_inner']).style.marginTop = "-"+(getDivY('mdiv')-getDivY(vars['original_image_div_id']) + vars['ctrl_size'])*vars['ratio']+'px';
            updateSelectedArea(current_width);
        }

        if(vars['enlarge'] == 0){
            if((vars['tempX']-getDivX(vars['original_image_div_id'])-vars['mouseOffSet_x'])<=0){
                  $('mdiv').style.left = getDivX(vars['original_image_div_id']) - vars['ctrl_size'] +"px";
            }else if((getDivX(vars['original_image_div_id'])+getDivWidth(vars['original_image_div_id']))-vars['mouseOffSet_x']<=vars['tempX']){
                  $('mdiv').style.left = (getDivX(vars['original_image_div_id']) - vars['ctrl_size'] +getDivWidth(vars['original_image_div_id']))-getDivWidth('mdiv')+"px";
            }else{
                  $('mdiv').style.left = (vars['tempX'] - vars['mouseOffSet_x'] - vars['ctrl_size'] )+"px";
            }
            if((vars['tempY']-getDivY(vars['original_image_div_id'])-vars['mouseOffSet_y'])<=0){
                  $('mdiv').style.top = getDivY(vars['original_image_div_id']) - vars['ctrl_size'] +"px";
            }else if((getDivY(vars['original_image_div_id'])+getDivHeight(vars['original_image_div_id']))-vars['mouseOffSet_y']<=vars['tempY']){
                  $('mdiv').style.top = (getDivY(vars['original_image_div_id']) - vars['ctrl_size'] +getDivHeight(vars['original_image_div_id']))-getDivHeight('mdiv')+"px";
            }else{
                  $('mdiv').style.top = (vars['tempY'] - vars['mouseOffSet_y'] - vars['ctrl_size'] )+"px";
            }
        }
  }
  return true
}
function doAjax(url,x,y,width,height) {
    $('ajax_loader').style.display = 'block';
    $('upload_avatar_photo_contianer').style.display = 'block';
    $('upload_avartar').style.display = 'block';
    var a = new Request({
        url: url,
        method: 'post',
        onSuccess:function(response){
             $('info_alert').style.display = 'block';
             $("info_text").innerHTML = 'Thumbnail created successfully';
             $('ajax_loader').style.display = 'none';
             $("upload_avartar").innerHTML = 'Thumbnail created successfully. <br/> Redirecting...';
             window.location = "index.php?option=com_sitemain&view=usermanager"
        },
        onError:function(){
              $('info_alert').style.display = 'block';
              $("info_text").innerHTML = 'Bad';
          }
   }).post({'x':x,
            'y':y,
            'width':width,
            'height':height});
}
//END OF CROPING IMAGE JS

function showCurrentImage(id,ids){
    var arr=ids.split(",");
    for(i=0;i<arr.length;i++){
        tmp = 'image_' + arr[i];
        tmp2 = 'frame_' + arr[i];
        if(arr[i] == id){
            $(tmp).style.display = "block";
            $(tmp2).style.backgroundColor = "#ccc";
        }else{
            $(tmp).style.display = "none";
            $(tmp2).style.backgroundColor = "#fff";
        }
    }
    return false;
}

function switchEditConent(textElementID,editElementID,editBtn,cancelBtn){
    $(textElementID).style.display = "none";
    $(editElementID).style.display = "block";
    $(editBtn).style.display = "none";
    $(cancelBtn).style.display = "block";
    return false;
}
function switchTextConent(textElementID,editElementID,editBtn,cancelBtn){
    $(textElementID).style.display = "block";
    $(editElementID).style.display = "none";
    $(editBtn).style.display = "block";
    $(cancelBtn).style.display = "none";
    return false;
}

function setHiddenValueSelect(hiddenId, fieldID){
    $(hiddenId).value = $(fieldID)[$(fieldID).selectedIndex].value;
    return false;
}
function setHiddenValue(hiddenId, fieldID){
    $(hiddenId).value = $(fieldID).value;
    return false;
}

function confirmDelete(url){
    if(confirm('Are you sure you want to delete this artwork?')){
            doRequest(url);
        }
        return false;
}



function doRequest(url){
    loaderlength = 0;
    $('loadingbar').style.display = "block";
    var dr = new Request({
          url: url,
          method: 'get',
          onSuccess:function(response){
              $('loadingbar').style.display = "none";
              showMsg(response);
          },
          onError:function(){
                $('info_alert').style.display = 'block';
                $("info_text").innerHTML = 'Bad';
            }
     }).send();
    return false;
}

function showMsg(msg){
    $('info_alert').style.display = 'block';
    $("info_text").innerHTML = msg;
    setTimeout(function(){
        //$('info_alert').fade('out');
        $('info_alert').setStyle('display', 'none');
    },3000);
}
function setPrimary(){
    loaderlength = 0;
    $('loadingbar').style.display = "block";
    $('setprimary_btn').disabled = true;
    $('setprimary_btn').value = "Setting";
    var url = '/index.php?option=com_sitemain&task=setimageprimary&tmpl=component';
    var a = new Request({
         url: url,
         method: 'post',
         onSuccess:function(response){
             $('loadingbar').style.display = "none";
              showMsg('Successfully set primary image');
              $('setprimary_btn').value = "SET PRIMARY";
              $('setprimary_btn').disabled = false;
              //var url = "/index.php?option=com_sitemain&view=artwork&format=raw&artwork_id="+$('hidden_artwork_id').value;
              //getArwork(url);
         },
         onError:function(){
               $('info_alert').style.display = 'block';
               $("info_text").innerHTML = 'Bad';
           }
    }).post({'artwork_primary':getCheckedValue('artwork_primary')});
}
function getCheckedValue(eleName){
    var inputs = document.getElementsByName(eleName);
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].checked) {
        return inputs[i].value;
      }
    }
    return true;
}


function updateArwork(){
    loaderlength = 0;
    $('loadingbar').style.display = "block";
    $('submit_btn').disabled = true;
    $('submit_btn').value = "Updating";
    var url = '/index.php?option=com_sitemain&task=updateartworkinfo&tmpl=component';
    var a = new Request({
         url: url,
         method: 'post',
         onSuccess:function(response){
             $('loadingbar').style.display = "none";
              showMsg('Update successfully');
              $('submit_btn').value = "Update";
              $('submit_btn').disabled = false;
              //var url = "/index.php?option=com_sitemain&view=artwork&format=raw&artwork_id="+$('hidden_artwork_id').value;
              //getArwork(url);
         },
         onError:function(){
               $('info_alert').style.display = 'block';
               $("info_text").innerHTML = 'Bad';
           }
    }).post({'title':$('title').value, 
               'meta_desc':$('meta_desc').value,
               'description':$('description').value,
               'category_id':$('category_id').value,
               'artwork_id':$('hidden_artwork_id').value});
}

function setArtticle(obj, elementid){
    var divs = document.getElementsByClassName("choose_article");
    for (var i = divs.length - 1; i >= 0; i--)
    {
      if(divs[i] == obj){
          divs[i].className = "choose_article a_active";
      }else{
          divs[i].className = "choose_article";
      }
    }
    divs = document.getElementsByClassName("blog_a_c");
    for (i = divs.length - 1; i >= 0; i--)
    {
      if(divs[i] == $(elementid)){
          divs[i].style.display = "block";
      }else{
          divs[i].style.display = "none";
      }
    } 
}

function getUserContent(obj,target_id,url){
    loaderlength = 0;
    $('loadingbar').style.display = "block";
    var ajax_gucccc = new Request({
          url: url,
          method: 'get',
          onSuccess:function(response){
              $('loadingbar').style.display = "none";
               setActive("usermmngr_li",obj.parentNode);
               $(target_id).innerHTML = response;
               window.scroll(0,0);
          },
          onError:function(){
                $('info_alert').style.display = 'block';
                $("info_text").innerHTML = 'Bad';
            }
     }).send();
    return false;
}

function setActive(classname, obj){
    var menus = document.getElementsByClassName(classname);
    for (var i = menus.length - 1; i >= 0; i--)
    {
      if(menus[i] == obj){
          menus[i].className = classname + " active";
      }else{
          menus[i].className = classname + " inactive";
      }
    }
}

function getAccountContent(id,url,item){
    //$("profile_content").innerHTML = $('ajax_loader_gif').innerHTML;
    $('mootool_ajax_loader').style.display = "block";
     var ajax_gac = new Request({
          url: url,
          method: 'get',
          onSuccess:function(response){
              
              setActive("profile_tbs_li",$(id));
              
               $("profile_content").innerHTML = response;
               if(item == 2){
                    getShopAccountCtn('wishlist_content','index.php?option=com_opencart&route=account/wishlist1&format=raw');
                    getShopAccountCtn('orderlist_content','index.php?option=com_opencart&route=account/order1&format=raw');
                    var ctns = document.getElementsByClassName("list_box_content");
                    for (var i = ctns.length - 1; i >= 0; i--)
                    {
                      ctns[i].style.display = "block";
                      
                    }
               }
               $('mootool_ajax_loader').style.display = "none";
          },
          onError:function(){
                $('info_alert').style.display = 'block';
                $("info_text").innerHTML = 'Bad';
            }
     }).send();
}
function getShopAccountCtn(id,url){
    //$("profile_content").innerHTML = $('ajax_loader_gif').innerHTML;
    //$('mootool_ajax_loader').style.display = "block";
     var ajax_gsac = new Request({
          url: url,
          method: 'get',
          onSuccess:function(response){
               //$('mootool_ajax_loader').style.display = "none";
               $(id).innerHTML = response;
          },
          onError:function(){
                $('info_alert').style.display = 'block';
                $("info_text").innerHTML = 'Bad';
            }
     }).send();
}

function getArwork(url){
    $("artwork_main").innerHTML = $('ajax_loader_gif').innerHTML;
     var ajax_ga_alt = new Request({
          url: url,
          method: 'get',
          onSuccess:function(response){
               $("artwork_main").innerHTML = response;
          },
          onError:function(){
                $('info_alert').style.display = 'block';
                $("info_text").innerHTML = 'Bad';
            }
     }).send();
}
function getArwork(obj,url){
    loaderlength = 0;
    $('loadingbar').style.display = "block";
     var ajax_ga = new Request({
          url: url,
          method: 'get',
          onSuccess:function(response){
              var menus = document.getElementsByClassName("image_thumbnail");
                for (var i = menus.length - 1; i >= 0; i--)
                {
                  if(menus[i] == obj.parentNode){
                      menus[i].className += " image_thumbnail_active";
                  }else{
                      menus[i].className = "image_thumbnail";
                  }
                }
               $('loadingbar').style.display = "none";
               $("artwork_main").innerHTML = response;
          },
          onError:function(){
                $('info_alert').style.display = 'block';
                $("info_text").innerHTML = 'Bad';
            }
     }).send();
     return false;
}

function xy(x) {
    var o = document.getElementById(x);
    var l =o.offsetLeft; var t = o.offsetTop;
    while (o=o.offsetParent)
    	l += o.offsetLeft;
    var o = document.getElementById(x);
    while (o=o.offsetParent)
    	t += o.offsetTop;
    return [l,t];
}

function hideStuff(obj){
    if ((event.relatedTarget || event.toElement) == obj)
          obj.style.display = 'none';
}

function updatePorto(){
        loaderlength = 0;
        $('loadingbar').style.display = "block";
        var url = '/index.php?option=com_sitemain&task=updatePortfolio';
        var up = new Request({
             url: url,
             method: 'post',
             onSuccess:function(response){
                 showMsg('Artist profile updated successfully');
                  $('loadingbar').style.display = "none";
             },
             onError:function(){
                   $('info_alert').style.display = 'block';
                   $("info_text").innerHTML = 'Bad';
               }
        }).post({
               'portfolio':$('portfolio').value,
               'websiteurl':$('websiteurl').value,
               'user_id':$('user_id').value
               });
   }
   
function validateEmail(id){
    var e = $(id).value;
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(e)){
        return true;
    }else{
        alert('Email enterred is not valid');
        return false;
    }
}   
function showDesc(obj,status, text){
    if(status==1){
        obj.style.width = "auto";
        obj.style.height = "17px";
        obj.style.paddingTop = "3px";
        obj.style.paddingRight = "5px";
        obj.style.fontSize = "12px";
    }else{
        obj.style.width = "14px";
        obj.style.paddingRight = "0px";
        obj.style.fontSize = "16px";
        obj.style.height = "20px";
        obj.style.paddingTop = "0px";
    }
    obj.innerHTML = text;
}

function formFocus(obj, text,state){
    if(state==1){
        if (obj.value == text)
        {
            if(text=='Password' || text=='Retype Password'){
                obj.type="password";
            }
            obj.value = "";
            jQuery(obj).css('color','#2e2d2d');
         }
    }else{
        if (obj.value == "")
        {
            if(text=='Password' || text=='Retype Password'){
                obj.type="text";
            }
            obj.value = text;
            jQuery(obj).css('color','#ccc');
        }
    }
}