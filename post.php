<?php

require_once('includes/init.php');

$user = Model_User::findUserByUsername('sondh');
if (empty($user)) {
	die('Please login');
}

if (empty($_REQUEST['fb_uid'])) {
	die('Please give me some fb_uid');
}
$fb_uid = $_REQUEST['fb_uid'];

$app = App::getInstance();
$session = $app->get('session');
$session->rememberUser($user);

$facebook = Api_Facebook::getInstance();
$session->setupFacebook($facebook);

$result = $facebook->api('/me/kthreeusm:kiss', 'post', array(
	'profile' => $app->getFileUrl('profile.php?fb_uid=' . $fb_uid),
));

var_dump($result);