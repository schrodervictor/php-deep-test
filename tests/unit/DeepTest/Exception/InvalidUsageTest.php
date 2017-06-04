<?php

namespace DeepTest\Exception;

use Exception;
use Throwable;

use PHPUnit\Framework\TestCase;

class InvalidUsageTest extends TestCase
{
    public function testInvalidUsageShouldBeAThrowableException()
    {
        $error = new InvalidUsage;
        $this->assertInstanceOf(Throwable::class, $error);
        $this->assertInstanceOf(Exception::class, $error);
    }
}
