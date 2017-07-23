<?php

class SEO
{
    private static $object;
    private $uri;

    use GetInstance;

    private function __construct($config)
    {
        $this->uri = Factory::getInstance("URI",$config);
    }

    /**
     * Method generate beginning links
     * */
    public function addBeginningLink()
    {
        return $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
    }

    /**
     * Method add to head canonical link
     * */
    public function addCanonicalLink()
    {
        echo "<link rel=\"canonical\" href= \"" . $this->addBeginningLink() . $_SERVER["REQUEST_URI"] . "\">";
    }

    /**
     * Method add base page to head
     * */
    public function addBasePage()
    {
        echo "<base href= \"" . $this->uri->getBase(). "\">";
    }

    /**
     * Method add alternate link for mobile
     */
    public function addMobileLink()
    {
        echo "<link rel=\"alternate\" media=\"only screen and (max-width: 640px)\" href=\"\">";
    }

    /**
     * Method add description page
     * @param  $data string
     */
    public function addDescription($data)
    {
        echo "<meta name=\"description\" content=\"" . $data . "\">";
    }

    /**
     * Method add languages page
     * @param  $lang array
     */
    public function addLanguageLink($lang)
    {
        foreach ($lang as $l)
            echo "<link rel=\"alternate\" hreflang=\"" . $l ."\" href=\"" . $this->addBeginningLink() . $_SERVER["REQUEST_URI"] ."\">";
    }

    /**
     * Method add metadata for search bots
     * @param $agree boolean
     * */
    public function addRobotsFollow($agree)
    {
        if ($agree)
            echo "<meta name=\"robots\" content=\"index,follow\">";
        else
            echo "<meta name=\"robots\" content=\"none\">";
    }

    /**
     * Method add h1 element to page
     * @param $words string
     * */
    public function addKeyWords($words)
    {
        echo "<h1>" . $words ."</h1>";
    }
}