<?php

namespace Api;

class Request
{

    private $allowMethods = ['POST'];
    private $request;

    public function __construct(array $request)
    {
        $this->request = $request;

        if (!$this->allowedMethod()) {
            throw new Exception('Method: ' . $request['REQUEST_METHOD'] . ' invalid');
        }
    }

    private function allowedMethod(): bool
    {
        return in_array($this->request['REQUEST_METHOD'], $this->allowMethods);
    }

}