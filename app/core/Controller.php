<?php


class Controller extends Config
{
    /**
     * Method where add model and connect whit database if exists $_POST
     * @param $model - how model
     * @return object. Return new model from view
     * */
    public function loadModel($model)
    {
        $model .= "Table";
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Method which load layout
     * @param $view - add this view
     * @param $data - current information
     * @param $css string
     * @param $js string
     * */
    public function view($view, $data = [], $css = null, $js = null)
    {
        require_once '../app/views/layout/layout.php';
    }


    /**
     * Method add element to view
     * @param $name string - file name
     * @param $directory string - directory in folder elements (default - default)
     * @param $data Model
     * */
    public function importElement($name, $directory = "default", $data = null)
    {
        require_once "../app/views/elements/" . $directory . "/" . $name . ".php";
    }

    /**
     * Method which load current view
     * @param $view string
     * @param $data array
     * */

    public function content($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    /**
     * Method which add CSS
     * @param $css string
     */
    public function loadCss($css)
    {
        if ($css != "" or $css != null) {
            $table = explode(' ', $css);
            $address = $this->address();
            for ($i = 0; $i < (count($table)); $i++) {
                echo '<link href="' . $address . 'css/' . $table[$i] . '.css" rel="stylesheet" type="text/css">';
            }
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
            $address = $this->address();
            echo '<script src="' . $address . 'js/jquery-3.2.1.min.js" type="text/JavaScript"></script>';
            for ($i = 0; $i < (count($table)); $i++)
                echo '<script src="' . $address . 'js/' . $table[$i] . 'Controller.js" type="text/JavaScript"></script>';
        }
    }

    /**
     * Method generate main address
     * @return string
     * */
    public function address()
    {
        return "/" . $this->config["system"]["default-directory"] . "/public/";
    }

    public function checkAddress()
    {
        if ($_GET == null)
            return null;
        else
            return $_GET["url"];
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
     * Method create element a in view
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
     * Method create attribute href
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
            } else return "/" . $this->config["system"]["default-directory"] . "/public/";
        } else
            return "/" . $this->config["system"]["default-directory"] . "/public/";
    }

    /**
     * Method open form
     * @param $action string - link to another page
     * */
    public function startForm($action = null)
    {
        echo "<form method='post'";
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
     * Method create in page button
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

    public function getJSON($file, $model)
    {
        require_once "../app/views/API/" . $file . ".php";
    }

    public function redirect($where=null)
    {
        if ($where==null)
            header("Location: " . $_SERVER['HTTP_REFERER']);
        else
            header("Location: " . $this->baseLink() . $where);
    }

    public function checkIsJS(){
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if (!isset($_SERVER['HTTP_REFERER']))
                $this->redirect("home/index");
            else
                $this->redirect();
        }
    }
}