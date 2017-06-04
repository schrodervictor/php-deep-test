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

        $this->assertTrue(class_exists('PHP'));
        $this->assertSame('DeepTest', PHP::INTERPRETER);
    }


    /**
     * In a separate state and without global state to avoid any previously
     * loaded classes
     *
     * @preserveGlobalState disabled
     * @runInSeparateProcess
     * @expectedException DeepTest\Exception\InvalidUsage
     */
    public function testShouldThrowExceptionIfPHPClassIsAlreadyLoaded()
    {
        $this->assertFalse(class_exists('PHP', false));

        // Trigger the autoload of the PHP before DeepTest
        $this->assertTrue(class_exists('PHP'));

        // Trigger the autoload for DeepTest
        class_exists('DeepTest');
    }
}
