<?php

require_once('includes/init.php');

$user = Model_User::findUserByUsername('sondh');

$app = App::getInstance();
$session = $app->get('session');
$session->rememberUser($user);

$facebook = Api_Facebook::getInstance();
$session->setupFacebook($facebook);

$result = $facebook->api('/me/kthreeusm:kiss', 'post', array(
	'profile' => $app->getFileUrl('profile.php?fb_uid=lotterite'),
	'message' => 'Testing blah blah',
));

var_dump($result);