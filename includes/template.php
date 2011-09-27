<?php

class Template {
	
	protected $_path;
	protected $_params = array();
	
	public function __construct($templateName) {
		$this->_path = App::getInstance()->getFilePath('templates/' . $templateName . '.htm');
	}
	
	public function setParams(array $params) {
		$this->_params = array_merge($this->_params, $params);
		
		return $this;
	}
	
	public function render() {
		extract($this->_params);
		$app = App::getInstance();
		
		ob_start();
		include($this->_path);
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
	}
	
	public static function create($templateName) {
		return new Template($templateName);
	}
}