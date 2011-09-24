<?php

require(dirname(__FILE__) . '/../../facebook-sdk/src/facebook.php');

BaseFacebook::$CURL_OPTS[CURLOPT_PROXY] = '127.0.0.1:5011';
BaseFacebook::$CURL_OPTS[CURLOPT_PROXYTYPE] = CURLPROXY_SOCKS5;

class Api_Facebook extends Facebook {
	public static function &getInstance() {
		static $instance = false;
		
		if ($instance === false) {
			$instance = new Api_Facebook(array(
				'appId' => '265976383423652',
				'secret' => '33e86aca3f7af9ab831fb6230b88caa4',
			));
		}
		
		return $instance;
	}
}