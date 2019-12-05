<?php

namespace Api\Controllers;

use Exception;
use Api\Services\ProductsService;

class TerminalController
{

    private $basket = [];

    public function scanItems(array $items): array
    {
        $this->total = 0;

        foreach($items['items'] as $item) {

            if (!ProductsService::productExists($item)) {
                throw new Exception('Product code: ' .  $item. ' not found');
            }

            $this->scanItem($item);
        }

        return ['total' => $this->calculateTotal()];
    }

    private function scanItem(string $item): void
    {
        if (empty($this->basket[$item])) {
            $this->basket[$item] = 1;
        } else {
            $this->basket[$item]++;
        }
    }

    private function calculateTotal(): float
    {
        $total  = 0;

        foreach($this->basket as $code => $quantity) {
            if(ProductsService::hasBulkPrice($code)) {
                $total += $this->calculateBulkPrice($code, $quantity);
            } else {
                $total += $this->calculateSinglePrice($code, $quantity);
            }
        }

        return $total;
    }

    private function calculateSinglePrice($code, $quantity)
    {
        $price = ProductsService::getPrice($code);
        return ($price * $quantity);
    }

    private function calculateBulkPrice(string $code, int $quantity): float
    {
        [$bulkQuantity, $bulkValue] = ProductsService::getBulkPriceDetails($code);

        $bulkPrice = 0;
        if ($quantity >= $bulkQuantity) {
            $bulkItems = floor($quantity/$bulkQuantity);
            $bulkPrice = $bulkItems*$bulkValue;
        }

        $remaining = $quantity%$bulkQuantity;
        $singlePrice = $this->calculateSinglePrice($code, $remaining);

        return $bulkPrice+$singlePrice;
    }

}