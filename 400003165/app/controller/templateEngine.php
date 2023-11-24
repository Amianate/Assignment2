<?php

namespace app\controller;

use framework\abstractTemplateEngine;

class templateEngine extends abstractTemplateEngine{
    private $template;

    function __construct($newTemplate){
        $this->template = $newTemplate;
    }

    public function render($data) {
        $output = $this->template;

        foreach ($data as $key => $value) {
            $placeholder = "{{" . $key . "}}";
            $output = str_replace($placeholder, $value, $output);
        }

        return $output;
    }
}

// // Example usage
// $template = "Hello, {{name}}! You are {{age}} years old.";
// $data = [
//     'name' => 'John',
//     'age' => 25
// ];

// $engine = new templateEngine($template);
// echo $engine->render($data);