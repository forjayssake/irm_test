<?php

Use Api\Request;
use Api\Exception\RequestInvalidException;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testInvalidMethodThrowsException()
    {
        $details = [
            'REQUEST_METHOD' => 'BAD_TYPE'
        ];

        $this->expectException(RequestInvalidException::class);
        $request = new Request($details);
    }

    public function testPostRequestWithNoBodyThrowsException()
    {
        $details = [
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/'
        ];

        $this->expectException(RequestInvalidException::class);
        $request = new Request($details);
    }
}