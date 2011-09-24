<?php

require_once('includes/init.php');

$app = App::getInstance();
$session = $app->get('session');
$isLoggedIn = $session->isLoggedIn();
if (!$isLoggedIn) {
	// new user
	echo Template::create('register')->render();
	echo Template::create('login')->render();
} else {
	// logged in user
	$facebook = Api_Facebook::getInstance();
	
	$fbUserIdLive = $facebook->getUser();
	if (!empty($fbUserIdLive)) {
		$fbUserInfo = $facebook->api('/me');
		if (empty($fbUserInfo)) $fbUserIdLive = 0; // invalidate the id if we can't get /me from Open Graph
		
		$fbPerms = $facebook->api('/me/permissions');
		if (empty($fbPerms['data'][0]['offline_access'])) $fbUserIdLive = 0; // invalidate the id if permission is missing
	}
	
	$fbUserIdSaved = $session->getUserInfo('fb_uid');
	
	if (empty($fbUserIdSaved) OR $fbUserIdLive != $fbUserIdSaved) {
		if (empty($fbUserIdLive)) {
			// not connected, yet
			echo Template::create('login_to_facebook')->setParams(array(
				'loginUrl' => $facebook->getLoginUrl(array('scope' => array('offline_access'))),
			))->render();
		} else {
			// connected
			echo Template::create('associate_with_facebook')->setParams(array(
				'fbUserInfo' => $fbUserInfo,
				'associateUrl' => 'associate.php',
			))->render();
		}
	} else {
		// associated
		echo Template::create('associated')->setParams(array(
			'fbUserInfo' => $fbUserInfo,
		))->render();
	}
}
