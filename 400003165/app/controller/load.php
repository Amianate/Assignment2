<?php

namespace root\app\controller;
use framework\templateEngine;

require_once __DIR__ . "/../../autoloader.php";


$index = new \indexcontroller();
$response = $index->response();

$data = [
    'name' => 'John',
    'age' => 25
];

$engine = new templateEngine($response->send());
echo $engine->render($data);