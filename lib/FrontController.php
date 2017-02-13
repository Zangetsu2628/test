<?php
class FrontController {
	protected $controller = DEFAULT_CONTROLLER;
	protected $action = DEFAULT_ACTION;
	protected $errorController = DEFAULT_ERROR;
	protected $params = array();
	
	public function __construct(array $options = array()) {
		if(empty($options)) {
			$this->parseUri();
		}
		else {
			if(isset($options['controller'])) {
				$this->setController($options['controller']);
			}
			if(isset($options['action'])) {
				$this->setAction($options['action']);
			}
			if(isset($options['params'])) {
				$this->setParams($options['params']);
			}
		}
	}
	
	protected function parseUri() {
		$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
		$path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);
		$parsed_uri = explode('/', $path, 3);
		
		if(isset($parsed_uri[0])) {
			$this->setController($parsed_uri[0]);
		}
		if(isset($parsed_uri[1])) {
			$this->setAction($parsed_uri[1]);
		}
		if(isset($parsed_uri[2])) {
			$this->setParams(explode("/", $parsed_uri[2]));
		}
	}
	
	public function setController($controller) {
		if(!empty($controller)) {
			$this->controller = $controller;
		}

		if(!class_exists($this->controller)) {
			$this->controller = $this->errorController;
		}
	}
	
	public function setAction($action) {
		$reflector = new ReflectionClass($this->controller);
		$this->action = $action;

		if(!$reflector->hasMethod($action)) {
			$this->action = DEFAULT_ACTION;
		}
	}
	
	public function setParams(array $params) {
		$this->params = $params;
	}
	
	public function run() {
		call_user_func_array(array(new $this->controller, $this->action), $this->params);
	}

	public function redirect() {
		$params = NULL;
		if(is_array($this->params)) {
			$params = implode('/', $this->params);
		} else {
			$params = $this->params;
		}

		$url = $_SERVER['HTTP_HOST'].'/'.$this->controller.'/'.$this->action.'/'.$params;
		header("Location: http://$url");
	}
}
?>
