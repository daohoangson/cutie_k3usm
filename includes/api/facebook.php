<?php

require(dirname(__FILE__) . '/../../facebook-sdk/src/facebook.php');

BaseFacebook::$CURL_OPTS[CURLOPT_PROXY] = '127.0.0.1:5011';
BaseFacebook::$CURL_OPTS[CURLOPT_PROXYTYPE] = CURLPROXY_SOCKS5;

class Api_Facebook extends Facebook {
	public function setAccessToken($accessToken) {
		$this->user = null;
		return parent::setAccessToken($accessToken);
	}
	
	public static function &getInstance() {
		static $instance = false;
		
		if ($instance === false) {
			$app = App::getInstance();
			
			$instance = new Api_Facebook(array(
				'appId' => $app->get('fb_appId'),
				'secret' => $app->get('fb_secret'),
			));
		}
		
		return $instance;
	}
}