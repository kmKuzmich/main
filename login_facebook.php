<?php

define('YOUR_APP_ID', 'YOUR APP ID');

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
require_once 'lib/facebook/facebook.php';

$facebook = new Facebook(array(
  'appId'  => 411231932265256,
  'secret' => 'e33477b303d2681a9724bc52864ffb78',
));

$userId = $facebook->getUser();
if ($userId) { 
      try {
        $user_profile = $facebook->api('/me','GET');
        echo "<div id='fb-root'></div><br>Name: " . $user_profile['name'] . "Email: ". $user_profile['email'];
		$params = array( 'next' => 'http://www.avtolider.km.ua/login_facebook.php' );
		print "<a href=".$facebook->getLogoutUrl($params).">logout</a>";

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl();
      echo 'Please <a href="' . $login_url . '">login.</a>';
	  
}

?>
<script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '411231932265256', // App ID
            channelUrl : '//www.avtolider.km.ua/login_facebook.php', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
          });
          // Additional initialization code here
        };
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
      </script>