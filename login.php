<?php

require_once('includes/init.php');

$app = App::getInstance();
$input = $app->get('input');
$username = $input->cleanSingle('username', Input_Abstract::TYPE_STRING);
$password = $input->cleanSingle('username', Input_Abstract::TYPE_STRING);

$existingUser = Model_User::findUserByUsername($username);
if (empty($existingUser)) {
	$app->byebye('User not found');
}

if (Model_User::hashPassword($password, $existingUser['salt']) == $existingUser['password']) {
	$app->get('session')->rememberUser($existingUser);
}

$app->redirect('index.php');