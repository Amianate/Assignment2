<?php

class Router
{
    private $routes = [];

    // Add a route and its corresponding handler
    public function addRoute( $path, $handler)
    {
        $this->routes[$path] = $handler;
    }

    // Match the current request to a route and call the handler
    public function route($path)
    {
        if (isset($this->routes[$path])) {
            $handler = $this->routes[$path];
            include $handler;

        } else {
            // Handle 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}

$router = new Router();

// Define routes
$router->addRoute('/Assignment2', "Assignment2/400003165/app/controller/indexcontroller.php");
$router->addRoute('/login', "logincontroller.php");

// Get the current request path
$path = parse_url($_SERVER['REQUEST_URI'])['path'];

echo "this is the path: " . $path . "\n";

// Route the request
$router->route($path);
