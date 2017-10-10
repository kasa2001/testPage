<?php

namespace Lib\Built\View;
use Lib\Built\Factory\Factory;


class View
{
    use \GetInstance;

    private static $object;
    private $config;
    private $seo;

    private function __construct($config)
    {
        $this->config = $config;
        $this->seo = Factory::getInstance("\Lib\Built\SEO\SEO", $config);
    }

    /**
     * Method which load layout
     * @param $view - add this view
     * @param $data - current information
     * @param $css string
     * @param $js string
     * @param $seo boolean
     * */
    public function display($view, $data = [], $css = null, $js = null, $seo = true)
    {
        require_once 'app/views/layout/layout.php';
    }

    /**
     * Method add element to view
     * @param $name string - file name
     * @param $directory string - directory in folder elements (default - default)
     * @param $data Model
     * */
    public function importElement($name, $directory = "default", $data = null)
    {
        require_once "app/views/elements/" . $directory . "/" . $name . ".php";
    }

    /**
     * Method which load current view
     * @param $view string
     * @param $data array
     * */
    public function content($view, $data = [])
    {
        require_once 'app/views/' . $view . '.php';
    }

    /**
     * Method which add CSS
     * @param $css string
     */
    public function loadCss($css)
    {
        if ($css != "" or $css != null) {
            $table = explode(' ', $css);
            for ($i = 0; $i < (count($table)); $i++)
                echo '<link rel="stylesheet" href="' . $this->config["system"]["default-directory"] . '/public/css/' . $table[$i] . '.css"  type="text/css">';
        }
    }

    /**
     * Method which add JavaScript
     * @param $js string
     */
    public function loadJs($js)
    {
        if ($js != "" or $js != null) {
            $table = explode(' ', $js);
            echo '<script src="' . $this->config["system"]["default-directory"]  . '/public/js/jquery-3.2.1.min.js" type="text/JavaScript"></script>';
            for ($i = 0; $i < (count($table)); $i++)
                echo '<script src="' . $this->config["system"]["default-directory"]  . '/public/js/' . $table[$i] . 'Controller.js" type="text/JavaScript"></script>';
        }
    }

    /**
     * Method load title page
     * */
    public function loadTitle()
    {
        echo "<title>" . $this->config["system"]["default-title"] . "</title>";
    }

    /**
     * Method load charset for page
     * */
    public function loadCharset()
    {
        echo "<meta charset='" . $this->config["system"]["charset"] . "'>";
    }

    /**
     * Method load language for page
     * */
    public function loadLanguage()
    {
        echo "lang='" . $this->config["system"]["default-language"] . "'";
    }

    /**
     * Method creates element a in view
     * @param $name string
     * @param $data string
     * @param $class array string (default null)
     * */
    public function buildLink($name, $data, $class = null)
    {
        echo "<a href='" . $this->baseLink() . $data . "'";
        if (count($class) == 0) echo ">" . $name . "</a>";
        else {
            echo "class='";
            for ($i = 0; $i < count($class); $i++) {
                echo $class[$i] . " ";
            }
            echo "'>" . $name . "</a>";
        }
    }

    /**
     * Method creates attribute href
     * @return string
     * */
    public function baseLink()
    {
        if ($_GET != null) {
            if (count(explode("/", $_GET["url"])) >= 2) {
                $address = explode("/", $_SERVER["REQUEST_URI"]);
                $data = "/";
                for ($i = 1; $i < (count($address) - 2); $i++) $data .= $address[$i] . "/";
                return $data;
            } else return "/" . $this->config["system"]["default-directory"] . "/";
        } else
            return "/" . $this->config["system"]["default-directory"] . "/";
    }

    /**
     * Method open form
     * @param $action string - link to another page
     * @param $method string - method
     * */
    public function startForm($action = null, $method='post')
    {
        echo "<form method='" . $method . "'";
        if ($action == null) echo ">";
        else echo " action='" . $this->baseLink() . $action . "'>";
    }

    /**
     * Method end form
     * */
    public function endForm()
    {
        echo "</form>";
    }

    /**
     * Method creates in page button
     * @param $text string
     * @param $class array
     * */
    public function button($text, $class = [])
    {
        echo "<button ";
        if ($class != null) {
            echo "class='";
            for ($i = 0; $i < count($class); $i++) echo $class[$i] . " ";
        }
        echo ">" . $text . "</button>";
    }

    /**
     * Method check address
     * @return string|null
     */
    public function checkAddress()
    {
        if ($_GET == null)
            return null;
        else
            return $_GET["url"];
    }

    /**
     * Method add mailing link
     * @param $mail string
     */
    public function mailingTo($mail)
    {
        echo "<a href=\"mailto:" . $mail . "\">" . $mail . "</a>";
    }

    /**
     * Method wears data from database to element
     * @param $model Database
     * @param $element array string
     * @param $button boolean
     * @param $name string
     * */
    public function generateDynamic($model, $element = [], $button = false, $name = null)
    {
        while ($result = $model->getData()) {
            if (count($element) != 1)
                echo "<" . $element[0] . ">";
            foreach ($result as $r) {
                if (count($element) == 1) echo "<" . $element . ">" . $r . "</" . $element . ">";
                else echo "<" . $element[1] . ">" . $r . "</" . $element[1] . ">";
            }
            if ($button) echo "<" . $element[1] . "><button data-id = '" . $result["id"] . "'>" . $name . "</button></" . $element[1] . ">";
            if (count($element) != 1)
                echo "</" . $element[0] . ">";
        }
    }

    /**
     * Method get SEO object
     * @return SEO
     * */
    public function getSEO()
    {
        return $this->seo;
    }

    /**
     * Method get data from file without loading all page
     * @param $file string
     * @param $model Database
     * */
    public function getJSON($file, $model)
    {
        require_once "app/views/api/" . $file . ".php";
    }
}