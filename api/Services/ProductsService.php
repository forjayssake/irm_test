<?php

namespace Api\Services;

class ProductsService
{
    /**
     * @var array Code | Price
     * --------------------------------------------------
     * ZA | £2.00 each or 4 for £7.00
     * YB | £12.00
     * FC | £1.25 or £6 for a six pack
     * GD | £0.15
     */
    private static $products = [
        'FC' => 1.25,
        'GD' => 0.15,
        'YB' => 12.00,
        'ZA' => 2.00,
    ];

    private static $bulkProducts = [
        'FC' => [
            6, 6.00
        ],
        'ZA' => [
            4, 7.00
        ],
    ];

    public static function productExists(string $code): bool
    {
        return !empty(self::$products[$code]);
    }

    public static function getPrice(string $code): float
    {
        return self::$products[$code];
    }

    public static function hasBulkPrice(string $code): bool
    {
        return !empty(self::$bulkProducts[$code]);
    }

    public function getBulkPriceDetails(string $code): array
    {
        return self::$bulkProducts[$code];
    }
}