<?php

Use Api\Request;
use Api\Exception\RequestInvalidException;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /** @var Request */
    private $request;

    public function setUp()
    {
        $this->request = new Request();
    }

    public function testInvalidMethodThrowsException()
    {

    }

    public function testPostRequestWithNoBodyThrowsException()
    {

    }
}