<?php

class Model_User {
	public static function findUserByUsername($username) {
		$users = self::loadUsers();
		foreach ($users as $user) {
			if ($user['username'] == $username) {
				return $user;
			}
		}
		
		return false;
	}
	
	public static function createUser($username, $password) {
		$salt = substr(md5($username . rand(100, 999)), 0, 3);
		
		$user = array(
			'username' => $username,
			'password' => self::hashPassword($password, $salt),
			'salt' => $salt,
		);
		
		$users = self::loadUsers();
		$users[] = $user;
		self::saveUsers($users);
	}
	
	public static function updateUser($username, array $updateInfo) {
		if (isset($updateInfo['username'])) unset($updateInfo['username']); // do not allow editing username
		
		$users = self::loadUsers();
		
		foreach (array_keys($users) as $key) {
			if ($users[$key]['username'] == $username) {
				$users[$key] = array_merge($users[$key], $updateInfo);
			}
		}
		
		self::saveUsers($users);
	}
	
	public static function hashPassword($password, $salt) {
		return md5(md5($password) . $salt);
	}
	
	public static function loadUsers() {
		$path = App::getInstance()->getFilePath('data/users');
		$users = array();
		
		if (file_exists($path)) {
			$users = unserialize(/* base64_decode */(file_get_contents($path)));
		}
		
		return $users;
	}
	
	public static function saveUsers(array $users) {
		$path = App::getInstance()->getFilePath('data/users');
		file_put_contents($path, /* base64_encode */(serialize($users)));
	}
}