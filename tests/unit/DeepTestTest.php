<?php

use PHPUnit\Framework\TestCase;

class DeepTestTest extends TestCase
{
    public function tearDown()
    {
        DeepTest::reset();
    }


    /**
     * In a separate process and without global state to avoid any previously
     * loaded classes
     *
     * @preserveGlobalState disabled
     * @runInSeparateProcess
     */
    public function testShouldTakeOverThePHPClass()
    {
        $this->assertFalse(class_exists('PHP', false));

        DeepTest::activate();

        $this->assertTrue(class_exists('PHP'));
        $this->assertSame('DeepTest', PHP::INTERPRETER);
    }


    /**
     * In a separate process and without global state to avoid any previously
     * loaded classes
     *
     * @preserveGlobalState disabled
     * @runInSeparateProcess
     *
     * @expectedException DeepTest\Exception\InvalidUsage
     */
    public function testShouldThrowExceptionIfPHPClassIsAlreadyLoaded()
    {
        $this->assertFalse(class_exists('PHP', false));

        // Trigger the autoload of the PHP class before DeepTest
        $this->assertTrue(class_exists('PHP'));

        DeepTest::activate();
    }


    public function testShouldBeAbleToActivateAndDeactivate()
    {
        $this->assertFalse(DeepTest::isActive());

        DeepTest::activate();
        $this->assertTrue(DeepTest::isActive());

        DeepTest::deactivate();
        $this->assertFalse(DeepTest::isActive());
    }


    public function testShouldBeAbleToInjectCustomBehaviorToFunctions()
    {
        DeepTest::activate();

        $existing = 'a-file-that-exists.ext';

        $this->assertFalse(PHP::file_exists($existing));

        DeepTest::func('file_exists', function($filename) use($existing) {
            if ($existing === $filename) {
                return true;
            }
            return file_exists($filename);
        });

        $this->assertTrue(PHP::file_exists($existing));
    }


    public function testShouldBeAbleToResetProgrammendBehaviors()
    {
        DeepTest::activate();

        $filename = 'a-file-that-doesnt-exist.ext';

        $this->assertFalse(PHP::file_exists($filename));

        DeepTest::func('file_exists', function() {
            return true;
        });

        $this->assertTrue(PHP::file_exists($filename));

        DeepTest::reset();

        $this->assertFalse(PHP::file_exists($filename));
    }
}
