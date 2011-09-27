<?php

class App {
	protected $_dir;
	protected $_session;
	protected $_input;
	
	protected function __construct() {
		$this->_dir = dirname(dirname(__FILE__));
	}
	
	public function getFilePath($path) {
		return $this->_dir . '/' . ltrim($path, '/');
	}
	
	public function getFileUrl($path) {
		if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
			|| isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
		) {
			$protocol = 'https://';
		} else {
			$protocol = 'http://';
		}
	    $url = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . ltrim($path, '/');
	
		return $url;
	}
	
	public function byebye($message) {
		die($message); // simple eh!?
	}
	
	public function redirect($target) {
		header('Location: ' . $target);
		exit;
	}
	
	public function setSession(Session_Abstract $session) {
		$this->_session = $session;
	}
	
	public function setInput(Input_Abstract $input) {
		$this->_input = $input;
	}
	
	public function get($key) {
		switch ($key) {
			case 'session': return $this->_session;
			case 'input': return $this->_input;
			case 'fb_appId': return '265976383423652';
			case 'fb_secret': return '33e86aca3f7af9ab831fb6230b88caa4';
		}
		
		return false;
	}
	
	public function &getInstance() {
		static $instance = false;
		
		if ($instance === false) {
			$instance = new App();
		}
		
		return $instance;
	}
}