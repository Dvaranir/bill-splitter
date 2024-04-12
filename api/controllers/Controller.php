<?php

class Controller
{
    public $kernel;
    public $className;

    public function __construct($kernel, $className)
    {
        $this->kernel = $kernel;
        $this->className = $className;
        $this->handleRequest();
    }

    public function handleRequest()
    {
        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $method = $requestMethod . $_REQUEST['suffix'];

        if (method_exists($this->className, $method)) {
            $this->{$method}();
        } else {
            $this->kernel->e404();
        }
    }

    public function processBody($fields = [])
    {
        $input = json_decode(file_get_contents('php://input'), true);
        foreach ($fields as $field) {
            if (!array_key_exists($field, $input)) {
                $input[$field] = '';
            }
        }
        return $input;
    }
}
