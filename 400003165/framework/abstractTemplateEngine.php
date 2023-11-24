<?php

namespace framework;

abstract class abstractTemplateEngine{

    abstract function __construct($newTemplate);

    abstract public function render($data);
}

// // Example usage
// $template = "Hello, {{name}}! You are {{age}} years old.";
// $data = [
//     'name' => 'John',
//     'age' => 25
// ];

// $engine = new templateEngine($template);
// echo $engine->render($data);