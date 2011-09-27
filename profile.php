<?php

require_once('includes/init.php');

if (empty($_REQUEST['fb_uid'])) {
	die('Please give me some fb_uid');
}

$fb_uid = $_REQUEST['fb_uid'];
$profile = Api_Facebook::getInstance()->api('/' . $fb_uid);
if (empty($profile['id']) OR empty($profile['name'])) {
	die('Invalid fb_uid?');
}

?>
<html>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# profile: http://ogp.me/ns/profile#">
     <meta property="fb:app_id"               content="<?php echo App::getInstance()->get('fb_appId'); ?>"> 
     <meta property="og:type"                 content="profile"> 
     <meta property="og:url"                  content="https://graph.facebook.com/<?php echo $profile['id']; ?>">
     <meta property="og:image"                content="https://graph.facebook.com/<?php echo $profile['id']; ?>/picture">
     <meta property="og:title"                content="<?php echo $profile['name']; ?>">
     <meta property="og:description"          content="<?php echo $profile['name']; ?>">
     <meta property="profile:first_name"      content="<?php echo $profile['first_name']; ?>">
     <meta property="profile:last_name"       content="<?php echo $profile['last_name']; ?>">
     <meta property="profile:username"        content="<?php echo $profile['username']; ?>">
     <meta property="profile:gender"          content="<?php echo $profile['gender']; ?>">
    </head>
<body>
    <!--a wonderful user profile -->
	<?php echo $profile['name']; ?>
</body>
</html>