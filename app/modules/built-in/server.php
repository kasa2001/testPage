<?php

class Server
{
    private static $object;
    private $uri;

    use \GetInstance;

    private function __construct($data)
    {
        $this->uri = Factory::getInstance('URI', $data);
    }

    public function setRedirectCode($code)
    {
        $_SERVER["REDIRECT_STATUS"] = $code;
    }

    public function getHttpRequest()
    {
        return $_SERVER['HTTP_X_REQUESTED_WITH'];
    }

    /**
     * Method redirecting if someone try go to file with JSON
     * */
    public function checkIsJS()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            if (!isset($_SERVER['HTTP_REFERER']))
                $this->redirect("home/index");
            else
                $this->redirect();
        }
    }

    /**
     * Method return data about preview page
     * @return string
     * */
    public function checkPreviewWebSite()
    {
        if (isset($_SERVER['HTTP_REFERER'])) return $_SERVER['HTTP_REFERER'];
        else return null;
    }


    /**
     * Method redirect to another page. If $where is null redirect to preview page
     * TODO REBUILD METHOD
     * @param $where string
     * */
    public function redirect($where = null)
    {
        if ($where == null)
            header("Location: " . $this->checkPreviewWebSite());
        else
            header("Location: " . $this->uri->getBase() . "/PTW/public/" . $where);
    }
}