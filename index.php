<?php
require_once 'config.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';

$url = isset($_GET['url']) ? explode('/', $_GET['url']) : [];

$controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'UserController';
$method = isset($url[1]) ? $url[1] : 'register';

require_once 'app/controllers/' . $controllerName . '.php';
$controller = new $controllerName();
$controller->$method();
