<?php

class Response {
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
    }
}