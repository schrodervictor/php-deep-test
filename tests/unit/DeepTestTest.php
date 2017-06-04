<?php

use PHPUnit\Framework\TestCase;

class DeepTestTest extends TestCase
{
    /**
     * In a separate state and without global state to avoid any previously
     * loaded classes
     *
     * @preserveGlobalState disabled
     * @runInSeparateProcess
     */
    public function testShouldTakeOverThePHPClass()
    {
        $this->assertFalse(class_exists('PHP', false));

        // This is here only to trigger the autoloader for DeepTest
        class_exists('DeepTest');

        $this->assertTrue(class_exists('PHP', false));
        $this->assertSame('DeepTest', PHP::INTERPRETER);
    }
}
