<?php

namespace Api;

use Api\Exception\RequestInvalidException;

class Request
{
    public const TYPE_POST = 'POST';

    public static $allowedMethods = [
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

    public function getController(): string
    {
        return $this->controller;
    }

    public function getBody(): ?array
    {
        return json_decode($this->body, true);
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
        return in_array($this->request['REQUEST_METHOD'], self::$allowedMethods);
    }

}