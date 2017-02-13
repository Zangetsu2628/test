<?php
class View {
	protected $config;
	protected $layout = 'default';
	protected $view;
	protected $params = array();
	
	public function __construct(array $params = array()) {
		$this->config = Config::getConfig();
		$this->addParams($params);
	}
	
	private function _getContents($fileName) {
		if(is_readable($fileName)) {
			ob_start();
			include $fileName;
			
			return ob_get_clean();
		}
		
		return false;
	}
	
	public function setLayout($layout) {
		$this->layout = $layout;
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
	public function setView($view) {
		$this->view = $view;
	}
	
	public function getView() {
		return $this->view;
	}
	
	public function assign($param, $value) {
		$this->params[$param] = $value;
	}
	
	public function remove($key) {
		if(array_key_exists($key)) {
			unset($this->params[$key]);
		}
	}
	
	public function addParams(array $params) {
		if(!empty($params)) {
			foreach($params as $key => $value) {
				$this->params[$key] = $value;
			}
		}
	}
	
	public function render() {
		$layout = LAYOUT_PATH.$this->getLayout().".php";
		$view = VIEW_PATH.$this->getView().".php";
	
		if(is_readable($layout)) {
			$this->params['content'] = $this->_getContents($view);
			require_once $layout;
		} else {
			die('Missing Layout');
		}
	}
}
?>