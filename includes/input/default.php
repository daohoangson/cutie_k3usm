<?php

class Input_Default extends Input_Abstract {
	public function get($key) {
		// use $_REQUEST for both $_GET and $_POST
		if (isset($_REQUEST[$key])) {
			return $_REQUEST[$key];
		} else {
			return false;
		}
	}
}