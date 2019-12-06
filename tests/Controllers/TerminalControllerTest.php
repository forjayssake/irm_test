<?php

use Api\Controllers\TerminalController;
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
            'products' => ['ZA','YB','FC','GD','ZA','YB','ZA','ZA']
        ],
        1 => [
            'expected' => 7.25,
            'products' => ['FC','FC','FC','FC','FC','FC','FC']
        ],
        2 => [
            'expected' => 15.40,
            'products' => ['ZA','YB','FC','GD']
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
            $total = $this->terminal->scanItems($basket['products']);
            $this->assertEquals($basket['expected'], $total);
        }
    }


}