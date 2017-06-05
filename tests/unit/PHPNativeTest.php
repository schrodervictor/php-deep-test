<?php

$phpTheClass = 'vendor/schrodervictor/php-the-class';

require_once __DIR__ . "/../../$phpTheClass/tests/unit/PHPTest.php";


class PHPNativeTest extends PHPTest
{
    public static function setUpBeforeClass()
    {
        DeepTest::activate();
    }
}
