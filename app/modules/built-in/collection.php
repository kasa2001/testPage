<?php

abstract class Collection implements JsonSerializable, Countable
{
    const WRONG_INDEX = 1;
    const WRONG_OBJECT = 2;
    const WRONG_SORT = 3;

    /**
     * @var $collection array
     * */
    protected $collection = array();

    /**
     * @var $_how int
     * */
    protected $_how = 0;

    /**
     * @var $loader AutoLoader
     */
    protected $loader;

    /*
     * Public methods
     * */

    /**
     * Construct create new Collection object
     * @param $data mixed (default null)
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
    public abstract function copy();

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

    /*
     * Protected methods
     * */

    /**
     * Method get Collection Exception data
     * @param $e CollectionException
     * */
    protected function _getError($e)
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
    protected function _check($data)
    {
        if ($this->_how != 0) {
            $this->_type($data);
        } else if (is_array($data)) {
            $this->_type($data);
        }
    }

    /**
     * Method check type of data when pushed to collection
     * @param $data array
     * */
    protected function _type($data)
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
    protected function _loopObject($data, $type)
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
    protected function _loopVariable($data, $type)
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