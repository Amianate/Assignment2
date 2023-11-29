<?php

namespace app\controller;

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

use app\controller\sessionController;

// Free all session variables and end session
sessionController::sessionEnd();

// Redirect to the login page
$response = new Response();
$response->redirect("../view/login.php", 301);
exit();