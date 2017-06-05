<?php

class PHP
{
    const INTERPRETER = 'DeepTest';


    public static function __callStatic($function, $args)
    {
        return DeepTest::invoke($function, $args);
    }
}
