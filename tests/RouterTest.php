<?php

Use Api\Request;
Use Api\Router;
use Api\Exception\RequestInvalidException;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /** @var Router */
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function tearDown()
    {
        unset($this->router);
    }

    public function testInvalidActionOrControllerThrowsException()
    {
        $this->expectException(RequestInvalidException::class);
        $this->router->post('unknown-route', 'UnknownController@scanItems');
    }
}