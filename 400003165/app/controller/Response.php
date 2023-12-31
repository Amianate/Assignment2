<?php

namespace app\controller;

use framework\abstractResponse;

class Response extends abstractResponse{
    private $statusCode;
    private $headers = [];
    private $body;

    public function setStatusCode(int $statusCode) {
        $this->statusCode = $statusCode;
    }

    public function addHeader(string $name, string $value) {
        $this->headers[$name] = $value;
    }

    public function setBody(string $body) {
        $this->body = $body;
    }

    public function send() {
        // Set HTTP status code
        http_response_code($this->statusCode);

        // Set headers
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Send the response body
        echo $this->body;
        // return $this->body;
    }

    public function redirect(string $url, int $statusCode = 302)
    {
        $this->setStatusCode($statusCode);
        $this->addHeader('Location', $url);
        $this->setBody("");

        // Send the redirect response
        $this->send();
        exit();
    }
}