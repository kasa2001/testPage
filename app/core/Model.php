<?php


class Model extends Database
{
    protected $table;
    protected $columns = [];

    public function __construct()
    {
        parent::__construct();
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