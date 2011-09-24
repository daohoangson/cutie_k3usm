<?php

abstract class Session_Abstract {
	
	protected abstract function _init();
	public abstract function get($key);
	public abstract function set($key, $value);
	public abstract function getSessionId();
	
	protected $_userInfo = false;
	
	public function __construct() {
		$this->_init();
		$this->_autoLogin();
	}
	
	public function isLoggedIn() {
		return $this->_userInfo !== false;
	}
	
	public function getUserInfo($key) {
		if (!$this->isLoggedIn()) return false;
		
		if (isset($this->_userInfo[$key])) {
			return $this->_userInfo[$key];
		} else {
			return false;
		}
	}
	
	public function rememberUser(array $userInfo) {
		$this->_userInfo = $userInfo;

		$this->set('username', $userInfo['username']);
		$this->set('password_hash', $this->_hashPassword($userInfo));
	}
	
	protected function _autoLogin() {
		if ($this->get('username') !== false AND $this->get('password_hash') !== false) {
			$userInfo = Model_User::findUserByUsername($this->get('username'));
			if (!empty($userInfo) AND $this->get('password_hash') == $this->_hashPassword($userInfo)) {
				$this->_userInfo = $userInfo;
			}
		}
	}
	
	protected function _hashPassword(array $userInfo) {
		return md5($userInfo['password'] . $userInfo['username'] . $this->getSessionId());
	}
}



