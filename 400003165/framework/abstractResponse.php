<?php

namespace framework;

abstract class abstractResponse {
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

    abstract public function send();
}