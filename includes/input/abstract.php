<?php

abstract class Input_Abstract {
	
	const TYPE_UINT = 'uint';
	const TYPE_INT = 'int';
	const TYPE_STRING = 'string';
	const TYPE_ARRAY = 'array';
	
	public abstract function get($key);
	
	public function cleanSingle($key, $options) {
		if (!is_array($options)) $options = array('type' => $options);
		
		$value = $this->get($key);

		switch ($options['type']) {
			case self::TYPE_UINT:
			case self::TYPE_INT:
				// number
				$value = intval($value);
				if ($options['type'] == self::TYPE_UINT) {
					// unsigned number only
					$value = max(0, $value);
				}
				break;
			case self::TYPE_STRING:
				$value = trim($value . "");
				break;
			case self::TYPE_ARRAY:
				if (!is_array($value)) {
					$value = array();
				}
				break;
		}
		
		return $value;
	}
}