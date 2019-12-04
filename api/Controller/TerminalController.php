<?php

namespace Api\Controller;

use Exception;
use Api\Services\ProductsService;

class BasketController
{

    /**
     * @var float
     */
    private $total;
    private $basket = [];


    public function scanItems(array $items)
    {
        $this->total = 0;

        foreach($items as $item) {

            if (!ProductsService::productExists($item)) {
                throw new Exception('Product code: ' .  $item. ' not found');
            }



        }
    }

    private function scanItem(string $item)
    {

    }

    private function calculateTotal()
    {

    }

}