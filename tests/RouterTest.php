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

    public function testInvalidRouteTypeThrowsException()
    {

    }

    public function testEmptyTargetThrowsException()
    {

    }

    public function testInvalidActionOrControllerThrowsException()
    {

    }

    public function testValidRequestReturnsRoute()
    {

    }

}