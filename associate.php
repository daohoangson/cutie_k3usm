<?php

require_once('includes/init.php');

$app = App::getInstance();
$session = $app->get('session');
$isLoggedIn = $session->isLoggedIn();
if ($isLoggedIn) {
	$facebook = Api_Facebook::getInstance();
	
	$fbPerms = $facebook->api('/me/permissions');
	if (!empty($fbPerms['data'][0]['offline_access'])) {
		$username = $session->getUserInfo('username');
		Model_User::updateUser($username, array(
			'fb_uid' => $facebook->getUser(),
			'fb_access_token' => $facebook->getAccessToken(),
		));
		
		$app->redirect('index.php');
	}
}

$app->byebye('Oops!');