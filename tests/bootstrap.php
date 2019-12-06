<?php

$basePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

if (!defined('PHPUNIT_COMPOSER_INSTALL')) {
    define('PHPUNIT_COMPOSER_INSTALL', $basePath . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
}

require_once $basePath . '/vendor/autoload.php';