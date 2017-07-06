<?php

namespace BaseAPI\Classes;

class API {
	
	public $parameters;
	
	function __construct() {
		
		if (isset($_GET['params'])) {
			$this->parameters = $this->parseParameters($_GET['params']);
		}
		
		if (isset($_GET['module'])) {
			var_dump($this->loadModule($_GET['module']));
		}
		
	}
	
	#------------------------------------------------------
	#
	#   Parse parameters from GET request and return array
	#
	#------------------------------------------------------
	
	private function parseParameters($string) {
		
		$result = array();
		
		$is_param_name = false;
		$parameters = explode('/', $string);
		foreach ($parameters as $k => $v) {
			$is_param_name = !$is_param_name;
			if (!$is_param_name) continue;
			
			if (isset($parameters[$k + 1]) && $parameters[$k + 1] != '' && $v != '') {
				$result[$v] = $parameters[$k+1];
			}
		}
		
		return $result;
	}
	
	private function loadModule($module) {
		
		$module = preg_replace("/([^a-z0-9\- ])/i", '', $module);
		
		if (file_exists(__DIR__ . "/../modules/{$module}.php")) {
			include(__DIR__ . "/../modules/{$module}.php");
			
			return $data;
		}
		else {
			return false;
		}
		
	}
	
}
	
?>