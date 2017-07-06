<?php

namespace BaseAPI\Classes;

class API {
	
	public $parameters;
	private $db;
	private $data;
	
	#------------------------------------------------------
	#
	#   Init API
	#
	#------------------------------------------------------
	
	function __construct($db) {
		
		$this->db = $db;
		
		if (isset($_GET['params'])) {
			$this->parameters = $this->parseParameters($_GET['params']);
		}
		
		if (isset($_GET['module'])) {
			$this->data = $this->loadModule($_GET['module']);
		}
		else {
			$this->data = $this->listModules();
		}
		
	}
	
	#------------------------------------------------------
	#
	#   Render JSON to screen
	#
	#------------------------------------------------------
	
	public function outputData() {
		
		header('Content-Type: application/json');
		
		echo json_encode($this->data);
		
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
	
	#------------------------------------------------------
	#
	#   Include external script for generating content
	#
	#------------------------------------------------------
	
	private function loadModule($module) {
		
		$module = preg_replace("/([^a-z0-9\- ])/i", '', $module);
		
		if (file_exists(__DIR__ . "/../modules/{$module}.php")) {
			
			$db = $this->db;
			$parameters = $this->parameters;
			
			$data = array();
			
			include(__DIR__ . "/../modules/{$module}.php");
			
			return $data;
			
		}
		else {
			return false;
		}
		
	}
	
	#------------------------------------------------------
	#
	#   List all available modules
	#
	#------------------------------------------------------
	
	private function listModules() {
		
		$modules = array();
		
		foreach (scandir('modules/') as $file) {
			if ($file == '.' || $file == '..') continue;
			$f = str_replace('.php', '', $file);
			$modules[] = $f;
		}
		
		return $modules;
		
	}
	
}
	
?>