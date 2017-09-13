<?php

class Collection implements JsonSerializable, Countable
{
    const WRONG_INDEX = 1;
    const WRONG_OBJECT = 2;
    const WRONG_SORT = 3;

    private $collection = array();
    private $_how = 0;
    private $loader;

    /*
     * Public methods
     * */

    /**
     * Construct create new Collection object
     * @param $data null|array|object (default null)
     * @param $how int (default 0)
     * */
    public function __construct($data = null, $how = 0)
    {
        $this->loader = AutoLoader::getInstance(null);
        if ($data !== null) {
            $this->collection = $data;
            $this->_check($data);
            if ($how == 0)
                $this->_how = count($data);
            else
                $this->_how = $how;

        } else
            $this->_how = $how;
    }

    /**
     * Method push object or another variable to Collection
     * @param $object object|array|int|string|boolean|double
     */
    public function push($object)
    {
        $this->_check($object);
        array_push($this->collection, $object);
        ++$this->_how;
    }

    /**
     * Method pop object from Collection
     * @param $index int
     * @return object|array|int|string|boolean|double
     * */
    public function pop($index)
    {
        $object = null;

        try {
            if (!isset($this->collection[$index])) {
                $this->loader->changeRegister('loadException');
                throw new CollectionException("Wrong index", self::WRONG_INDEX);
            }

        } catch (CollectionException $e) {
            $this->_getError($e);
        }

        $object = $this->collection[$index];
        unset($this->collection[$index]);
        --$this->_how;
        $this->collection = array_values($this->collection);
        return $object;
    }

    /**
     * Method get object from Collection but do not remove it
     * @param $index int
     * @return object|array|int|string|boolean|double
     * */
    public function get($index)
    {
        try {
            if (!isset($this->collection[$index])) {
                $this->loader->changeRegister('loadException');
                throw new CollectionException("Wrong index", self::WRONG_INDEX);
            }

        } catch (CollectionException $e) {
            $this->_getError($e);
        }

        return $this->collection[$index];
    }

    /**
     * Method clear Collection
     * */
    public function clear()
    {
        $this->collection = array();
        $this->_how = 0;
    }

    /**
     * Method copy Collection
     * @return Collection
     * */
    public function copy()
    {
        return new Collection($this->collection, $this->_how);
    }

    /**
     * Method return array of object
     * @return array
     * */
    public function toArray()
    {
        return $this->collection;
    }

    /**
     * Method return array for json serialize
     * @return array
     * */
    public function jsonSerialize()
    {
        return $this->collection;
    }

    /**
     * Method return how many object is in Collection
     * @return int
     * */
    public function count()
    {
        return $this->_how;
    }

    /**
     * Method merge Collection
     * @param $collection Collection
     * */
    public function merge($collection)
    {
        $array = $collection->toArray();
        $this->_check($array);
        $this->collection = array_merge($this->collection, $array);
        $collection->clear();
    }

    /**
     * Method sort data in Collection todo (check sort for object)
     * @param $type string (value "asc" or "desc". Default desc)
     * */
    public function sort($type = "asc")
    {
        try {
            if ($type == "asc") {
                asort($this->collection);
            } else if ($type == "desc") {
                arsort($this->collection);
            } else {
                $this->loader->changeRegister('loadException');
                throw new CollectionException("Wrong type of sort", self::WRONG_SORT);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
    }

    /*
     * Private methods
     * */

    /**
     * Method get Collection Exception data
     * @param $e CollectionException
     * */
    private function _getError($e)
    {
        echo "Collection Exception <br/>";
        echo "Code: " . $e->getCode() . " <br/>";
        echo "Message: " . $e->getMessage() . " <br/>";
        echo "Stack Trace: <br>";
        echo "<pre>";
        print_r($e->getTrace());
        echo "</pre>";

        exit($e->getCode());
    }

    /**
     * Method check type of object
     * @param $data array|object
     * */
    private function _check($data)
    {
        if ($this->_how != 0) {
            $this->_type($data);
        } else if (is_array($data)) {
            $this->_type($data);
        }
    }

    private function _type($data)
    {
        if (gettype($data) == "object") {
            $type = get_class($this->collection[0]);
            $this->_loopObject($data, $type);
        } else {
            $type = gettype($this->collection[0]);
            $this->_loopVariable($data, $type);
        }
    }

    /**
     * Method check all data in array (object)
     * @param $data array
     * @param $type string
     * */
    private function _loopObject($data, $type)
    {
        try {
            if (!is_array($data)) {
                if (get_class($data) != $type) {
                    $this->loader->changeRegister('loadException');
                    throw new CollectionException("Wrong object added to collection", self::WRONG_OBJECT);
                }
            }else {
                foreach ($data as $item) {
                    if (get_class($item) != $type) {
                        $this->loader->changeRegister('loadException');
                        throw new CollectionException("Wrong object added to collection", self::WRONG_OBJECT);
                    }
                }
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
    }

    /**
     * Method check all data in array (another variable)
     * @param $data array
     * @param $type string
     * */
    private function _loopVariable($data, $type)
    {
        try {
            if (!is_array($data)) {
                if (gettype($data) != $type) {
                    $this->loader->changeRegister('loadException');
                    throw new CollectionException("Wrong variable added to collection", self::WRONG_OBJECT);
                }
            } else {
                foreach ($data as $item) {
                    if (gettype($item) != $type) {
                        $this->loader->changeRegister('loadException');
                        throw new CollectionException("Wrong variable added to collection", self::WRONG_OBJECT);
                    }
                }
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
    }


}