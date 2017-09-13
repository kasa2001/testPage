<?php

trait GetInstance
{

    public static function getInstance($config)
    {
        try {
            $className = __CLASS__;
            $class = new ReflectionClass($className);
            if (empty(self::$object)) {
                $construct = $class->getConstructor();
                $construct->setAccessible(true);
                self::$object = new $className($config);
                $construct->setAccessible(false);
            }
        } catch (ReflectionException $exception) {
            echo "<pre>";
            echo $exception;
            echo "</pre>";
        }
        return self::$object;
    }
}