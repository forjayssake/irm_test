<?php

use Api\Controllers\TerminalController;
use Api\Exception\RequestInvalidException;
use PHPUnit\Framework\TestCase;

class TerminalControllerTest extends TestCase
{
    /**
     * @var TerminalController
     */
    private $terminal;
    private $baskets = [
        0 => [
            'expected' => 32.40,
            'products' => ['items' => ['ZA','YB','FC','GD','ZA','YB','ZA','ZA']]
        ],
        1 => [
            'expected' => 7.25,
            'products' => ['items' => ['FC','FC','FC','FC','FC','FC','FC']]
        ],
        2 => [
            'expected' => 15.40,
            'products' => ['items' => ['ZA','YB','FC','GD']]
        ],
    ];

    public function setUp()
    {
        $this->terminal = new TerminalController();
    }

    public function tearDown()
    {
        unset($this->terminal);
    }

    public function testBasketsReturnCorrectValues()
    {
        foreach($this->baskets as $basket) {
            $result = $this->terminal->scanItems($basket['products']);
            $this->assertEquals($basket['expected'], $result['total']);
        }
    }

    public function testMalformedItemsListThrowsException()
    {
        $this->expectException(RequestInvalidException::class);
        $result = $this->terminal->scanItems([]);
    }

    public function testEmptyItemsListReturnsZeroTotal()
    {
        $result = $this->terminal->scanItems(['items' => []]);
        $this->assertTrue(is_array($result));
        $this->assertEquals($result['total'], 0);
    }
}