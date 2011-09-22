<?php
// Copyright 2004-present Facebook. All Rights Reserved.

// Enforce https on production
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == "http" && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

/**
 * This sample app is provided to kickstart your experience using Facebook's
 * resources for developers.  This sample app provides examples of several
 * key concepts, including authentication, the Graph API, and FQL (Facebook
 * Query Language). Please visit the docs at 'developers.facebook.com/docs'
 * to learn more about the resources available to you
 */

// Provides access to Facebook specific utilities defined in 'FBUtils.php'
require_once('FBUtils.php');
// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'
require_once('AppInfo.php');
// This provides access to helper functions defined in 'utils.php'
require_once('utils.php');

/*****************************************************************************
 *
 * The content below provides examples of how to fetch Facebook data using the
 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
 * do so.  You should change this section so that it prepares all of the
 * information that you want to display to the user.
 *
 ****************************************************************************/

// Log the user in, and get their access token
$token = FBUtils::login(AppInfo::getHome());
if ($token) {

  // Fetch the viewer's basic information, using the token just provided
  $basic = FBUtils::fetchFromFBGraph("me?access_token=$token");
  $my_id = assertNumeric(idx($basic, 'id'));

} else {
  // Stop running if we did not get a valid response from logging in
  exit("Invalid credentials");
}
?>

<!-- This following code is responsible for rendering the HTML   -->
<!-- content on the page.  Here we use the information generated -->
<!-- in the above requests to display content that is personal   -->
<!-- to whomever views the page.  You would rewrite this content -->
<!-- with your own HTML content.  Be sure that you sanitize any  -->
<!-- content that you will be displaying to the user.  idx() by  -->
<!-- default will remove any html tags from the value being      -->
<!-- and echoEntity() will echo the sanitized content.  Both of  -->
<!-- these functions are located and documented in 'utils.php'.  -->
<!DOCTYPE html>
<html xmlns:fb="https://www.facebook.com/2008/fbml" lang="en">
  <head>
    <meta charset="utf-8">

    <!-- We get the name of the app out of the information fetched -->
    <title><?php echo(idx($app_info, 'name')) ?></title>
    <link rel="stylesheet" href="stylesheets/screen.css" media="screen">

    <!-- These are Open Graph tags.  They add meta data to your  -->
    <!-- site that facebook uses when your content is shared     -->
    <!-- over facebook.  You should fill these tags in with      -->
    <!-- your data.  To learn more about Open Graph, visit       -->
    <!-- 'https://developers.facebook.com/docs/opengraph/'       -->
    <meta property="og:title" content="K3usm"/>
    <meta property="og:type" content="game"/>
    <meta property="og:url" content="https://falling-cloud-5570.herokuapp.com/"/>
    <meta property="og:image" content=""/>
    <meta property="og:site_name" content="K3usm"/>
    <?php echo('<meta property="fb:app_id" content="' . AppInfo::appID() . '" />'); ?>
    <script>
      function popup(pageURL, title,w,h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var targetWin = window.open(
          pageURL,
          title,
          'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left
          );
      }
    </script>
    <!--[if IE]>
      <script>
        var tags = ['header', 'section'];
        while(tags.length)
          document.createElement(tags.pop());
      </script>
    <![endif]-->
  </head>
  <body>
    <header class="clearfix">
      <!-- By passing a valid access token here, we are able to display -->
      <!-- the user's images without having to download or prepare -->
      <!-- them ahead of time -->
      <p id="picture" style="background-image: url(https://graph.facebook.com/me/picture?type=normal&access_token=<?php echoEntity($token) ?>)"></p>

      <div>
        <h1>Welcome, <strong><?php echo idx($basic, 'name'); ?></strong></h1>
        <p class="tagline">
          Start doing stuff now!
        </p>
        <div id="share-app">
          <p>Share this app:</p>
          <ul>
            <li>
              <a href="#" class="facebook-button" onclick="popup('<?php echo $post_to_wall_url ?>', 'Post to Wall', 580, 400);">
                <span class="plus">Post to Wall</span>
              </a>
            </li>
            <li>
              <a href="#" class="facebook-button speech-bubble" onclick="popup('<?php echo $send_url ?>', 'Send', 580, 400);">
                <span class="speech-bubble">Send to Friends</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </header>
    
    <section>
	
	</section>
  </body>
  </body>
</html>
