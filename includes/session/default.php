<?php

class Session_Default extends Session_Abstract {
	protected function _init() {
		session_start();
	}
	
	public function get($key) {
		if (!empty($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}
	
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	public function getSessionId() {
		return session_id();
	}
}