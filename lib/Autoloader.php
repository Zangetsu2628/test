<?php
class Autoloader {
	private $config = '';

	public function __construct() {
		$this->config = Config::getConfig();
	}

	public function register() {
		spl_autoload_register(array($this, 'autoloadLib'));
		spl_autoload_register(array($this, 'autoloadApp'));
	}

	protected function autoloadLib($className) {
		$fileName = AUTOLOADER_LIB_PATH.$className.".php";

		if(is_readable($fileName)) {
			require_once $fileName;
		}
	}

	protected function autoloadApp($className) {
		$fileName = AUTOLOADER_APP_PATH.$className.".php";

		if(is_readable($fileName)) {
			require_once $fileName;
		}
	}
}
?>
