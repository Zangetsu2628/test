<?php
require_once "../lib/Config.php";
require_once "../lib/Autoloader.php";

$autoloader = new Autoloader();
$autoloader->register();

$frontController = new FrontController();
$frontController->run();
?>
