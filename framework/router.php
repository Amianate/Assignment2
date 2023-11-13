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
            call_user_func($handler);
        } else {
            // Handle 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}

// Example usage:
$router = new Router();

// Define routes
$router->addRoute('/hello',);

$router->addRoute('/about');

// Get the current request method and path
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($method, $path);