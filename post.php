<?php

require_once('includes/init.php');

$user = Model_User::findUserByUsername('sondh');

$app = App::getInstance();
$session = $app->get('session');
$session->rememberUser($user);

$facebook = Api_Facebook::getInstance();
$session->setupFacebook($facebook);

$result = $facebook->api('/me/kthreeusm:kiss?profile=' . $app->getFileUrl('profile.php?fb_uid=lotterite'), 'post');

var_dump($result);