<?php
class home {
	public function indexAction() {
		$view = new View();
		$view->setView('home');
		$view->render();
	}
}
?>