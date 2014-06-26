function  showCitiess()
{
    
    var searchForm = document.getElementById('form_ds');
       country_name = escape(searchForm.country.value);
       alert(country_name);
       if (window.XMLHttpRequest)
    {     // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {     // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
        {
            if(xmlhttp.status == 200)
            {
              //    document.getElementById("city_loading").style.display = "none";
                  replace_html('city', xmlhttp.responseText);
            }
            else
            {
                  alert("Error reading data");
            }
        }
    }
xmlhttp.open("GET","index.php?task=listCities&country_name="+country_name, true);
xmlhttp.send();
       
}

function replace_html(id, content)
{
      document.getElementById(id).innerHTML = content;
}

function show_progressbar(id)
{
      replace_html(id, '<img src="./components/com_mycomponent/js/progress.gif" border="0" alt="Loading..." />');
}

 function doRequest(target,url){
     var dr = new Request({
         url: url,
         method: 'get',
         onSuccess:function(response){
           $(target).innerHTML = response;
            
         },
         onError:function(){
               $('info_alert').style.display = 'block';
               $("info_text").innerHTML = 'Bad';
           }
    }).send();
   return false;
}

function showCities(target,url){
    var url= url+"&country="+$('country')[$('country').selectedIndex].value;
    doRequest(target,url);
    return false;
}


 function doPost(target,url){
     var dp = new Request({
         url: url,
         method: 'post',
         onSuccess:function(response){
           $(target).innerHTML = response;
         },
         onError:function(){
               $('info_alert').style.display = 'block';
               $("info_text").innerHTML = 'Bad';
           }
    }).post({
        'country':$('country')[$('country').selectedIndex].value,
                'bla':$('bla').value
    });
   return false;
}
function display_one_feature(target,aidstring,url){
    var dp = new Request({
         url: url,
         method: 'post',
         onSuccess:function(response){
           $(target).innerHTML = response;
         },
         onError:function(){
               $('info_alert').style.display = 'block';
               $("info_text").innerHTML = 'Bad';
           }
    }).post({
        'artwork_id':$('artwork_id'+aidstring).value,
               'category_id':$('category_id'+aidstring).value,
                'product_id':$('product_id'+aidstring).value,
                'username':$('username'+aidstring).value,
                'email':$('email'+aidstring).value,
                'category_name':$('category_name'+aidstring).value,
                'title':$('title'+aidstring).value
              
    });
   return false;
}


