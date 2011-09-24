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