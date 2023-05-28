<?php

namespace Microit\StoreBase\Traits;

use ReflectionClass;

trait Singleton
{
    private static $instance;

    public static function getInstance()
    {
        if (! isset(self::$instance)) {
            $reflection = new ReflectionClass(__CLASS__);
            self::$instance = $reflection->newInstanceArgs(func_get_args());
        }

        return self::$instance;
    }
}
