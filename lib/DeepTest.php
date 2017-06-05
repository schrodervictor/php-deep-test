<?php

use DeepTest\Exception\InvalidUsage;


class DeepTest
{
    private static $active = false;

    private static $stubs = [];

    private static $PHPClassFile = __DIR__ . '/PHP/PHP.php';

    private static $PHPLoadedByUs = false;


    public static function invoke($function, $args) {

        if (array_key_exists($function, static::$stubs)) {
            $callable = static::$stubs[$function];
            return call_user_func_array($callable, $args);
        }

        return call_user_func_array($function, $args);
    }


    public static function func($function, $stub)
    {
        static::$stubs[$function] = $stub;
    }


    public static function reset()
    {
        static::$stubs = [];
    }


    public static function activate()
    {
        static::requirePHP();
        static::$active = true;
    }


    private static function requirePHP()
    {
        if (static::$PHPLoadedByUs) return;

        if (class_exists('PHP', false)) {
            throw new InvalidUsage(
                'DeepTest must be required before the PHP class!'
            );
        }

        // This is intentional. We do want to keep the custom PHP class
        // out of the autoloader's reach.
        require_once static::$PHPClassFile;

        static::$PHPLoadedByUs = true;
    }


    public static function deactivate()
    {
        static::$active = false;
    }


    public static function isActive()
    {
        return static::$active;
    }
}
