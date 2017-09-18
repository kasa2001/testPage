<?php

class Server
{
    const ERROR400 = "Bad Request";
    const ERROR401 = "Unauthorized";
    const ERROR402 = "Payment Required";
    const ERROR403 = "Forbidden";
    const ERROR404 = "Page not found";
    const ERROR410 = "Gone";

    private static $object;
    private $uri;

    use \GetInstance;

    private function __construct($data)
    {
        $this->uri = Factory::getInstance('URI', $data);
    }


    /**
     * Method redirecting if someone try go to file with JSON
     * */
    public function checkIsJS()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            if (!isset($_SERVER['HTTP_REFERER']))
                $this->redirect(null, 403);
            else
                $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Method return data about preview page
     * @return string|null
     * */
    public function getPreviewWebSite()
    {
        try {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $loader = AutoLoader::getInstance(null);
                $loader->changeRegister("loadException");
                throw new ServerException("Previous page not exists");
            }


        } catch (ServerException $e) {

        }
        return $_SERVER['HTTP_REFERER'];
    }


    /**
     * Method redirect to another page. If $where is null redirect to preview page
     * @param $where string
     * @param $code int
     * */
    public function redirect($where = null, $code = null)
    {
        if ($where === null) {
            if ($code > 399 && $code < 500) {
                $this->_setError($code);
            } else {
                header("Location: /home/index");
            }
        } else {
            if ($code > 199 && $code < 400) {
                header("Location: " . $where, TRUE, $code);
            } else {
                header("Location: " . $where);
            }
        }
    }

    /**
     * Method set redirect error
     * @param $code int
     * */
    private function _setError($code)
    {
        header("Location: " . $this->uri->getBase() . "/home/error" . $code);

        if ($code == 404)
            header("HTTP/1.1 404 " . self::ERROR404);
        else if ($code == 410)
            header("HTTP/1.1 410 " . self::ERROR410);
        else if ($code == 403)
            header("HTTP/1.1 403 " . self::ERROR403);
        else if ($code == 402)
            header("HTTP/1.1 402 " . self::ERROR402);
        else if ($code == 401)
            header("HTTP/1.1 401 " . self::ERROR401);
        else
            header("HTTP/1.1 400 " . self::ERROR400);
    }
}