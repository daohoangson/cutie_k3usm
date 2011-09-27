<?php

require_once('includes/init.php');

$user = Model_User::findUserByUsername('sondh');

$app = App::getInstance();
$session = $app->get('session');
$session->rememberUser($user);

$facebook = Api_Facebook::getInstance();
$session->setupFacebook($facebook);

$result = $facebook->api('/me/friends');

if (!empty($result['data'])) {
	$tmp = array('friends' => $result['data']);
} else {
	$tmp = array('friends' => array());
}

echo json_encode($tmp);