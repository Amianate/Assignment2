<?php

namespace framework;

abstract class abstractRouter {
    private $routes = [];

    // Initialising the router with some pre-defined routes
    abstract function __construct();
    // Add a new route

    public function addRoute($url, $handler) {
        $this->routes[$url] = $handler;
    }

    // Route the request to the appropriate handler
    abstract public function route($url); 

    // Extract class, method, and include the file, and call the method
    private function callHandler($handlerInfo) {
        list($file, $class, $method) = explode(':', $handlerInfo);
        echo $file . " <br>".$class. " <br>  ". $method;

        if (file_exists($file)) {
            include_once $file;

            if (class_exists($class)) {
                $instance = new $class();
                
                echo "The class " . $class . " was found <br>";


                if (method_exists($instance, $method)) {

                    $instance->$method();
                    
                } else {echo "Method not found: $method";}

            } else {echo "Class not found: $class";}
        
        } else {echo "File not found: $file";}
    }


}

?>
