<?php
class ErrorController {
	public function __construct() {

	}

	public function indexAction() {
		$this->error404();
	}

	public function error404() {
		$view = new View();
		$view->setView('error404');
		$view->render();
	}
}
?>
