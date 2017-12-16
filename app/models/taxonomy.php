<?php


namespace Models;


use Core\Database;

class Taxonomy extends Database
{
    public function removeTaxonomy($id)
    {
        $this->query = "DELETE FROM `taxonomy` WHERE `id` = $id UNION DELETE FROM `taxonomy_map` WHERE id_taxonomy = $id";
        $this->execute();
    }

    public function addTaxonomy($name)
    {
        $this->query = "INSERT INTO `taxonomy` (`name`) VALUES ('$name')";
        $this->execute();
    }

    public function addItem($item)
    {
        $this->query = "Insert into `link` (`title`, `alias`, `cost`, `firm_id`, `category_id`) values ($item->title, $item->alias, $item->cost, $item->firm_id, $item->category_id)";
        $this->execute();
    }

    public function getTaxonomy($id)
    {
        $this->query = "SELECT * FROM `taxonomy` WHERE `id` = $id";
        $this->execute();
        return $this->loadList();
    }

    public function linkTaxonomy($taxonomy, $link)
    {
        $this->query = "insert into `taxonomy_map` (`id_link`, `id_taxonomy`) values ($link->id, $taxonomy->id)";
        $this->execute();
    }
}