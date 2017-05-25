<?php


class Model extends Database
{
    protected $table;
    protected $columns = [];

    public function __construct($table, $columns = [], $data = [])
    {
        parent::__construct();
        $this->data = $data;
        $this->columns = $columns;
        $this->table = $table;
        $this->query = $this->createQuery($this->table, "SeLeCt", array_merge($this->columns, $this->data), "a");
        $this->data = $this->request();
        $this->getResultRequest();
    }

    /**
     * Method get data from form
     * @param $data array (default null)
     * @param $i int
     * @return array
     * */
    public function getFormData($data = [], $i = 0)
    {
        if ($_POST != null) {
            foreach ($_POST as $value) {
                $data [$i] = $value;
                $i++;
            }
            return Security::slashSQLForm($data);
        } else return null;
    }

}