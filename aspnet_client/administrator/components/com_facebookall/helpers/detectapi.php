<?php 

if (isset($_GET['apikey'])) {
  $apikey = trim($_GET['apikey']);
  $apisecret = trim($_GET['apisecret']);
  $apicred = $_GET['api_request'];
  if (check_api_settings($apikey, $apicred) == 'https_disabled') {
    echo '<div id="apierror">Openssl not enabled for working fopen on your server.</div>';
  }
  else if (check_api_settings($apikey, $apicred) == false) {
    echo '<div id="apierror">Your '.$apicred.' settings not working try to change API Handler Settings.</div>';
  }
  else if (check_api_settings($apikey, $apicred) == 'handler_ok') {
    echo '<div id="apierror">Can not get any response from facebook. try to insert correct api key and secret</div>';
  }
  else {
    echo '<div id="apisuccess">Your API settings working perfectly. Please Save your current Settings.</div>';
  }
}

/**
 * Check api credential settings.
 */

  function check_api_settings($apikey, $apicred) {
    if (isset($apikey)) {
	   $url = "https://graph.facebook.com/".$apikey;
       if ($apicred == 'curl') {
         if (in_array('curl', get_loaded_extensions ()) AND function_exists('curl_exec')) {
           $curl = curl_init();
	       curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	       curl_setopt( $curl, CURLOPT_URL, $url );
	       curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
           $app_response = curl_exec($curl);
		   $curl_response = curl_getinfo($curl);
		   curl_close( $curl );
           $app_result = json_decode($app_response);
		 }
      }
      else {
        $app_response = @file_get_contents($url);
		$fopen_response = @$http_response_header;
		if (@$http_response_header == NULL) {
          if (!in_array('https', stream_get_wrappers())) {
            return 'https_disabled';
          }
		} 
        else {
          $app_result = json_decode($app_response);
        }
	  }
	  if (isset($app_result->id)) {
        return $app_result;
      }
      else {
	    if (!empty($curl_response['http_code'])  OR !empty($fopen_response[0])) {
		  return 'handler_ok';
		}
		else {
          return false;
		}
      }
    }
  }