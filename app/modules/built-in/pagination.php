<?php

class Pagination
{

   use \GetInstance;

    private static $object;
    private $uri;
    private $allPages;
    private $prevLink;
    private $limit;
    private $visible;
    private $nextLink;
    private $startLink;
    private $endLink;
    private $current;
    private $form;
    private $address;

    private function __construct($data)
    {
        $this->allPages = $data["pages"];
        unset($data["pages"]);
        $this->limit = $data["limit"];
        unset($data["limit"]);
        $this->current = $data["current"];
        unset($data["current"]);
        $this->visible = $data["visible"];
        unset($data["visible"]);
        $this->form = $data["form"];
        unset($data["form"]);
        $this->uri = URI::getInstance($data);
        $this->_prepareLinks();
    }

    private function _prepareLinks()
    {
        $next = $this->current + $this->limit;
        $end = $this->current - $this->limit;
        $all = $this->limit * $this->allPages;

        $this->endLink = $this->uri->toPagination() . ($all);
        $this->startLink = $this->uri->toPagination();
        $this->address = $this->uri->toPagination();

        if ($next > $all)
            $this->nextLink = $this->endLink;
        else
            if ($next === $all)
                $this->nextLink = $this->endLink;
            else
                $this->nextLink = $this->uri->toPagination() . $next;

        if ($end <= 0)
            $this->prevLink = $this->startLink;
        else
            $this->prevLink = $this->uri->toPagination() . $end;
    }

    /**
     * Method add to head element next link
     * */
    public function addNextPageLink()
    {
        if ($this->prevLink !== null) {
            echo '<link rel="next" href=" ' . $this->nextLink . '">';
        }
    }

    /**
     * Method add to head element prev link
     * */
    public function addPreviousPageLink()
    {
        if ($this->prevLink !== null) {
            echo '<link rel="prev" href=" ' . $this->prevLink . '">';
        }
    }

    private function _addLinks($html = null, $start = 0)
    {
        $set = $this->current / $this->limit;

        if (($this->visible / 2) <= $set)
            if ($this->visible % 2 == 0)
                $start = (++$set - ($this->visible / 2)) * $this->limit;
            else
                $start = (++$set - (($this->visible + 1) / 2)) * $this->limit;

        for ($i = 0; $i < $this->visible; $i++, $start += $this->limit) {
            if ($start > ($this->allPages * $this->limit)) break;

            if ($start === 0)
                $html .= $this->_directLink($this->address,(($start/$this->limit)+1));
            else
                $html .= $this->_directLink(($this->address . '/' . $start),(($start/$this->limit)+1));
        }

        return $html;
    }

    public function __toString()
    {
        $html = '<div class="pagination">';

        if ($this->form > 1)
            $html .= $this->_directLink($this->startLink, "First");

        $html .= $this->_directLink($this->prevLink, "Previous");

        if ($this->form > 0)
            $html .= $this->_addLinks();

        $html .= $this->_directLink($this->nextLink, "Next");

        if ($this->form > 1)
            $html .= $this->_directLink($this->endLink, "Last");


        if ($this->form > 2)
            $html .= $this->_directLink(($this->address . 'all'), "See all");

        return $html . '</div>';
    }

    private function _directLink($link, $name)
    {
        if ($this->uri->getRequestURI() == "/" . $link)
            return '<span class="current">' . $name . '</span>';
        else
            return '<a href=" ' . $link . '">' . $name . '</a>';
    }

    public static function checkExist()
    {
        if (self::$object !== null) {
            self::$object->addNextPageLink();
            self::$object->addPreviousPageLink();
        }
    }
}