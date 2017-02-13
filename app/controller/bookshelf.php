<?php
class bookshelf {
	public function indexAction($save = false) {
		$db = Database::getDatabase();
		$view = new View();
		$view->setView('bookshelf');

		$db->query("SELECT * FROM Shelves");
		$shelves = $db->getRows();
		$view->assign('shelves', $shelves);

		if(!empty($save)) {
			$view->assign('save', true);
		}

		$view->render();
	}

	public function add() {
		$view = new View();
		$view->setView('bookshelf_add');

		if(!empty($_POST['bookshelfName'])) {
			$db = Database::getDatabase();
			$name = $db->escape($_POST['bookshelfName']);
			$result = $db->query("INSERT INTO Shelves (name) VALUES ('$name')");
			
			if($result) {
				$frontController = new FrontController(array(
									    "controller" => "bookshelf", 
									    "action"     => "", 
									    "params"     => array("save" => true)
									));
				$frontController->redirect();
			}
		}

		$view->render();
	}

	public function edit($id) {
		if(empty($id)) {
			$frontController = new FrontController(array(
								    "controller" => "errorController", 
								    "action"     => "", 
								    "params"     => array()
								));
			$frontController->redirect();
		}

		$view = new View();
		$view->setView('bookshelf_edit');

		$db = Database::getDatabase();
		$db->query("SELECT name FROM Shelves WHERE id = $id");
		$name = $db->getValue();
		$view->assign('name', $name);
		$view->assign('id', $id);

		if(!empty($_POST['bookshelfName'])) {
			$name = $db->escape($_POST['bookshelfName']);
			$result = $db->query("UPDATE Shelves SET name = '$name' WHERE id = $id");
			
			if($result) {
				$frontController = new FrontController(array(
									    "controller" => "bookshelf", 
									    "action"     => "", 
									    "params"     => array("save" => true)
									));
				$frontController->redirect();
			}
		}

		$view->render();
	}

	public function view($id) {
		if(empty($id)) {
			$frontController = new FrontController(array(
								    "controller" => "errorController", 
								    "action"     => "", 
								    "params"     => array()
								));
			$frontController->redirect();
		}

		$view = new View();
		$view->setView('bookshelf_view');

		$db = Database::getDatabase();
		$db->query("SELECT name FROM Shelves WHERE id = $id");
		$name = $db->getValue();
		$view->assign('name', $name);
		$view->assign('shelf_id', $id);

		$db->query("SELECT * FROM Shelf_books WHERE shelf_id = $id");
		$books = $db->getRows();
		$view->assign('books', $books);

		$view->render();
	}

	public function delete($id) {
		if(empty($id)) {
			$frontController = new FrontController(array(
								    "controller" => "errorController", 
								    "action"     => "", 
								    "params"     => array()
								));
			$frontController->redirect();
		}

		$db = Database::getDatabase();
		$result = $db->query("DELETE FROM Shelves WHERE id = $id");
		$result = $db->query("DELETE FROM Shelf_books WHERE shelf_id = $id");
	}

	public function addbook($id) {
		if(empty($id)) {
			$frontController = new FrontController(array(
								    "controller" => "errorController", 
								    "action"     => "", 
								    "params"     => array()
								));
			$frontController->redirect();
		}

		$view = new View();
		$view->setView('bookshelf_addbook');
		$view->assign('id', $id);

		if(!empty($_POST['bookshelfName'])) {
			$db = Database::getDatabase();
			$name = $db->escape($_POST['bookshelfName']);
			$result = $db->query("INSERT INTO Shelf_books (book_name, shelf_id) VALUES ('$name', $id)");
			
			if($result) {
				$frontController = new FrontController(array(
									    "controller" => "bookshelf", 
									    "action"     => "", 
									    "params"     => array("save" => true)
									));
				$frontController->redirect();
			}
		}

		$view->render();
	}

	public function editbook($id) {
		if(empty($id)) {
			$frontController = new FrontController(array(
								    "controller" => "errorController", 
								    "action"     => "", 
								    "params"     => array()
								));
			$frontController->redirect();
		}

		$view = new View();
		$view->setView('bookshelf_editbook');

		$db = Database::getDatabase();
		$db->query("SELECT book_name, shelf_id FROM Shelf_books WHERE id = $id");
		$row = $db->getRow();
		$view->assign('name', $row['book_name']);
		$view->assign('shelf_id', $row['shelf_id']);
		$view->assign('id', $id);

		if(!empty($_POST['bookshelfName'])) {
			$name = $db->escape($_POST['bookshelfName']);
			$result = $db->query("UPDATE Shelf_books SET book_name = '$name' WHERE id = $id");
			
			if($result) {
				$frontController = new FrontController(array(
									    "controller" => "bookshelf", 
									    "action"     => "view", 
									    "params"     => array("id" => $row['shelf_id'])
									));
				$frontController->redirect();
			}
		}

		$view->render();
	}

	public function removebook($id) {
		if(empty($id)) {
			$frontController = new FrontController(array(
								    "controller" => "errorController", 
								    "action"     => "", 
								    "params"     => array()
								));
			$frontController->redirect();
		}

		$db = Database::getDatabase();
		$result = $db->query("DELETE FROM Shelf_books WHERE id = $id");
	}
}
?>