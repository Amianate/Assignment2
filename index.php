<?php

use app\controller\Router;

require_once "./400003165/config/autoloader.php";
require_once "./400003165/app/controller/Router.php";

$router = new Router();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($path);