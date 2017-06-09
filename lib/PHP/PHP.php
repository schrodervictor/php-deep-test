<?php

class PHP
{
    const INTERPRETER = 'DeepTest';


    public static function preg_match(
        $pattern, $subject, &$matches = null, $flags = 0, $offset = 0
    ) {
        return DeepTest::invoke(
            'preg_match',
            $pattern, $subject, $matches, $flags, $offset
        );
    }


    public static function exec($command, &$output = null, &$return = null)
    {
        return DeepTest::invoke('exec', $command, $output, $return);
    }


    public static function __callStatic($function, $args)
    {
        return DeepTest::invokeArray($function, $args);
    }
}
