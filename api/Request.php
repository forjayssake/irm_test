<?php

namespace Api;

use Api\Exception\RequestInvalidException;

class Request
{
    private const TYPE_POST = 'POST';

    private $allowMethods = [
        self::TYPE_POST,
    ];

    private $request;
    private $type;
    private $controller;
    private $method;
    private $body;

    /**
     * @throws RequestInvalidException
     */
    public function __construct(array $request)
    {
        $this->request = $request;

        if (!$this->allowedMethod()) {
            throw new RequestInvalidException('Method: ' . $request['REQUEST_METHOD'] . ' invalid');
        }

        $this->setRequestParameters();
    }

    public function isPost(): bool
    {
        return self::TYPE_POST === $this->getType();
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    private function getController(): string
    {
        return $this->controller;
    }

    private function getBody(): ?array
    {
        return $this->body;
    }

    private function setRequestParameters()
    {
        $this->type = $this->request['REQUEST_METHOD'];

        $parts = array_reverse(explode('/', $this->request['REQUEST_URI']));
        $this->method = $parts[0];
        $this->controller = $parts[1];

        if (self::TYPE_POST === $this->type) {
            $this->body = file_get_contents('php://input');
            if (empty($this->body)) {
                throw new RequestInvalidException('POST body is empty');
            }
        }
    }

    private function allowedMethod(): bool
    {
        return in_array($this->request['REQUEST_METHOD'], $this->allowMethods);
    }

}