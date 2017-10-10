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
        } catch (ReflectionException $e) {
            echo "Reflection Exception</br>";
            echo "Code: " . $e->getCode() . "</br>";
            echo "Message: " . $e->getMessage() . "</br>";
            echo "Stack trace: ";
            echo "<pre>";
            print_r($e->getTrace());
            echo "</pre>";
            exit();
        }
        return self::$object;
    }
}