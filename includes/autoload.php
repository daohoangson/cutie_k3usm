<?php

function k3usm_autoload($name) {
	static $dir = false;
	
	if ($dir === false) $dir = dirname(__FILE__);
	
	$path = $dir . '/' . implode('/', explode('_', strtolower($name))) . '.php';
	if (file_exists($path)) {
		require($path);
	}
}

spl_autoload_register('k3usm_autoload');