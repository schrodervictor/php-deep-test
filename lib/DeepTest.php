<?php

use DeepTest\Exception\InvalidUsage;

if (class_exists('PHP', false)) {
    throw new InvalidUsage('DeepTest must be required before the PHP class!');
}

// This is intentional.
// We do want to keep the custom PHP class out of the autoloader's reach.
require __DIR__ . '/PHP/PHP.php';

class DeepTest {}
