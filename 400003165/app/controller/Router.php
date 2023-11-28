<?php
namespace app\controller;

require_once __DIR__ . '/../../config/autoloader.php';

use framework\abstractRouter;

class Router extends abstractRouter{
    private $routes = [];

    // Initialising the router with some pre-defined routes
    function __construct()
    {
        // Define routes with file, class, and method separated by ':'
        $this->addRoute('/Assignment2/', 'indexcontroller.php');
        // $this->addRoute('/Assignment2/400003165/', '400003165/app/controller/indexcontroller.php:indexcontroller:loadLogin');
        // $this->addRoute('/Assignment2/400003165/app/', '400003165/app/controller/indexcontroller.php:indexcontroller:loadLogin');
        $this->addRoute('/Assignment2/400003165/app/controller/', 'indexcontroller.php');
    }
    // Add a new route
    public function addRoute($url, $handler) {
        $this->routes[$url] = $handler;
    }

    // Route the request to the appropriate handler
    public function route($url) {
        if (array_key_exists($url, $this->routes)) {
            $handlerInfo = $this->routes[$url];
            $this->callHandler($handlerInfo);
        } else {
            echo "404 Not Found";
        }
    }

    // Extract class, method, and include the file, and call the method
    private function callHandler($handlerInfo) {

        // Check if the target is a controller method or a PHP file
        if (strpos($handlerInfo, ':') !== false) {

            // It's a controller method

            list($file, $class, $method) = explode(':', $handlerInfo);
    
            if (file_exists($file)) {
                include_once $file;
    
                if (class_exists($class)) {
                    $instance = new $class();
                    
                    // echo "The class " . $class . " was found <br>";
    
    
                    if (method_exists($instance, $method)) {
    
                        $instance->$method();
                        
                    } else {echo "Method not found: $method";}
    
                } else {echo "Class not found: $class";}
            
            } else {echo "File not found: $file";}
        } else {
            // It's a PHP file
            include $handlerInfo;
        }
    }
}

?>
