<?php

class Router {
    private $routes = [];

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
        list($file, $class, $method) = explode(':', $handlerInfo);

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

// Example usage
$router = new Router();

// Define routes with file, class, and method separated by ':'
$router->addRoute('/Assignment2/', '400003165/app/controller/indexcontroller.php:indexcontroller:redirect');

// Get the current URL (you might need to adjust this based on your environment)
$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo __DIR__ . "<br>";
// Route the request
$router->route($currentUrl);
?>
