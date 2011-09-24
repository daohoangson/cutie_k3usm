<?php

require_once('includes/init.php');

$app = App::getInstance();
$input = $app->get('input');
$username = $input->cleanSingle('username', Input_Abstract::TYPE_STRING);
$password = $input->cleanSingle('username', Input_Abstract::TYPE_STRING);

$existingUser = Model_User::findUserByUsername($username);
if (!empty($existingUser)) {
	$app->byebye('Existing user found');
}

Model_User::createUser($username, $password);
$app->byebye('Created');